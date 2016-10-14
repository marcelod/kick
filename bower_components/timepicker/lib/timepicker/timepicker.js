/* global define */
/*
 * TimePicker - Enhances an input field with a time picker dropdown
 * https://github.com/BrandwatchLtd/timepicker
 *
 * Dependencies: jQuery, underscore.js, moment.js
 *
 * License: MIT
 **/
(function (root, factory) {
    'use strict';

    /**
     * MicroEvent - to make any js object an event emitter (server or browser)
     *
     * - pure javascript - server compatible, browser compatible
     * - dont rely on the browser doms
     * - super simple - you get it immediatly, no mistery, no magic involved
     *
     * - create a MicroEventDebug with goodies to debug
     *   - make it safer to use
     */

    var MicroEvent = function () {};
    MicroEvent.prototype = {
        bind: function (event, fct) {
            this._events = this._events || {};
            this._events[event] = this._events[event] || [];
            this._events[event].push(fct);
        },
        unbind: function (event, fct) {
            this._events = this._events || {};
            if (event in this._events === false) {
                return;
            }
            this._events[event].splice(this._events[event].indexOf(fct), 1);
        },
        trigger: function (event /* , args... */ ) {
            this._events = this._events || {};
            if (event in this._events === false) {
                return;
            }
            for (var i = 0; i < this._events[event].length; i++) {
                this._events[event][i].apply(this, Array.prototype.slice.call(arguments, 1));
            }
        }
    };

    /**
     * mixin will delegate all MicroEvent.js function in the destination object
     *
     * - require('MicroEvent').mixin(Foobar) will make Foobar able to use MicroEvent
     *
     * @param {Object} the object which will support MicroEvent
     */
    MicroEvent.mixin = function (destObject) {
        var props = ['bind', 'unbind', 'trigger'];
        for (var i = 0; i < props.length; i++) {
            if (typeof destObject === 'function') {
                destObject.prototype[props[i]] = MicroEvent.prototype[props[i]];
            } else {
                destObject[props[i]] = MicroEvent.prototype[props[i]];
            }
        }
    };
    /// END MicroEvents

    // Work with AMD or plain-ol script tag
    if (typeof define === 'function' && define.amd) {
        // If window.jQuery or window._ are not defined, then assume we're using AMD modules
        define(['jquery', 'underscore', 'moment'], function ($, _, moment) {
            return factory($ || root.jQuery, _ || root._, moment || root.moment, MicroEvent);
        });
    } else {
        root.timepicker = factory(root.jQuery, root._, root.moment, MicroEvent);
    }

})(this, function ($, _, moment, MicroEvent) {
    'use strict';

    if (!$) {
        throw new Error('timepicker requires jQuery to be loaded');
    }

    if (!_) {
        throw new Error('timepicker requires underscore to be loaded');
    }

    if (!moment) {
        throw new Error('timepicker requires moment to be loaded');
    }

    // TimePicker
    var TIME_REGEX = /^([01]\d|2[0-3]):?([0-5]\d)$/,
        DOWN_ARROW_CODE = 40,
        MAX_MINUTES_CHECKED = 60,
        PUBLIC_METHODS = [
            'destroy',
            'open',
            'close',
            'select',
            'deselect',
            'reset'
        ],
        findNearestPresetTimeMemo = _.memoize(findNearestPresetTime);

    function buildTimePickerList(presetTimes) {
        return presetTimes.map(function (time) {
            return '<li data-time="' + time + '">' + time + '</li>';
        }).join('');
    }

    function buildPicker(options) {
        var $ul = $('<ul/>');

        $ul
            .addClass(options.pickerClassName)
            .html(buildTimePickerList(options.presetTimes));

        return $ul;
    }

    function getPresetTimes(intervalDuration) {
        var presetTimes = [],
            interval = moment(intervalDuration, 'HH:mm'),
            start = moment().startOf('day'),
            end = moment(start).add({
                'days': 1
            }),
            duration = moment.duration({
                'hours': interval.hours(),
                'minutes': interval.minutes()
            });

        while (start.diff(end) < 0) {
            presetTimes.push(start.format('HH:mm'));
            start = start.add(duration);
        }

        return presetTimes;
    }

    function setupEvents(timepicker) {
        timepicker.$input.on('click.timepicker', function (e) {
            e.stopPropagation();
            e.preventDefault();

            timepicker.open();
        });

        timepicker.$input.on('blur.timepicker', function () {
            timepicker.close();
        });

        timepicker.$input.on('focus.timepicker', function () {
            timepicker.open();
        });

        timepicker.$picker.on('click.timepicker', 'li', function (e) {
            e.preventDefault();
            e.stopPropagation();

            timepicker._preventClose = false;
            timepicker.select($(e.target).data('time'));
            timepicker.close();
        });

        timepicker.$picker.on('mousedown.timepicker', 'li', function () {
            timepicker._preventClose = true;

            $('body').one('mouseup', function () {
                timepicker.$picker.hide();
            });
        });

        timepicker.$input.on('keydown.timepicker', function (e) {
            if (e.keyCode === DOWN_ARROW_CODE) {
                timepicker.open();
                return;
            }
            timepicker.close();
            timepicker.reset();
        });
    }

    function isPresetTime(timeStr, presetTimes) {
        return presetTimes.indexOf(timeStr) >= 0;
    }

    function findNearestPresetTime(timeStr, presetTimes) {
        var time,
            minutesChecked = 0;

        time = moment(timeStr, 'HH:mm');

        function direction() {
            return (minutesChecked % 2) ? minutesChecked : -minutesChecked;
        }

        function seek(time) {
            var attemptTimeStr = time.format('HH:mm');

            if (isPresetTime(attemptTimeStr, presetTimes)) {
                return attemptTimeStr;
            }

            if (minutesChecked > MAX_MINUTES_CHECKED) {
                return;
            }

            minutesChecked += 1;

            time.add('minutes', direction());

            return seek(time);
        }

        return seek(time);
    }

    function TimePicker($input) {
        this.presetTimes = getPresetTimes(this.custom.interval);

        this.$input = $input;

        this.$picker = buildPicker({
            pickerClassName: this.custom.pickerClassName,
            presetTimes: this.presetTimes
        });

        this._preventClose = false;
        this._preventOpen = false;

        setupEvents(this);
    }

    TimePicker.prototype.isOpen = function() {
        return this.$picker.is(':visible');
    };

    TimePicker.prototype.open = function () {
        if(this._preventOpen || this.isOpen()) {
           return;
        }

        var inputPosition = this.$input.offset(),
            currentTime = this.$input.val();

        this.$picker
            .appendTo(this.custom.pickerContainer)
            .css({
                top: inputPosition.top + this.$input.outerHeight(),
                left: inputPosition.left
            })
            .show();

        if (isPresetTime(currentTime, this.presetTimes)) {
            this.select(currentTime, {silent: true});
        }
        scrollToShowTime(this, currentTime, this.presetTimes);

        this.trigger('onOpen');
    };

    TimePicker.prototype.findOptionByTime = function (time) {
        return this.$picker.find('[data-time="' + time + '"]');
    };

    TimePicker.prototype.close = function () {
        if (this._preventClose) {
            return;
        }
        this.$picker.hide();
    };

    TimePicker.prototype.select = function (time, options) {
        var $option = this.findOptionByTime(time),
            isSilent = (options || {}).silent === true;

        this.deselect();

        if (this.$input.val() !== time) {
            this.$input.val(time);
        }
        $option.addClass(this.custom.pickerSelectedClassName);

        this._preventOpen = true;

        if (!isSilent) {
            this.$input.trigger('change').trigger('focus');
            this.trigger('onSelect', time);
        }

        this._preventOpen = false;
    };

    TimePicker.prototype.reset = function () {
        this.deselect();
    };

    TimePicker.prototype.destroy = function () {
        this.$picker.remove();
        this.$input.off('.timepicker');
        this.$input.removeData('timepicker');
    };

    TimePicker.prototype.deselect = function () {
        this.$picker.find('li').removeClass(this.custom.pickerSelectedClassName);
    };

    function scrollToShowTime(picker, time, presetTimes) {
        var timePickerHeight,
            itemHeight,
            idealPosition,
            selectedTimePosition,
            scrollAdjustment = 0,
            needsAdjustment,
            nearestPresetTime,
            $selectedTime;

        if (!time) {
            picker.$picker.scrollTop(scrollAdjustment);
            return;
        }

        nearestPresetTime = findNearestPresetTimeMemo(time, presetTimes);

        if (!nearestPresetTime) {
            picker.$picker.scrollTop(scrollAdjustment);
            return;
        }

        $selectedTime = picker.findOptionByTime(nearestPresetTime);

        timePickerHeight = picker.$picker.outerHeight();
        itemHeight = $selectedTime.outerHeight();
        selectedTimePosition = $selectedTime.index() * itemHeight;

        // ideally should be in the middle of the time picker
        idealPosition = timePickerHeight / 2 - itemHeight / 2;

        // only adjust if the selected item is outside the ideal position
        needsAdjustment = selectedTimePosition > idealPosition;

        if (needsAdjustment) {
            scrollAdjustment = Math.abs(selectedTimePosition - idealPosition);
        }

        picker.$picker.scrollTop(scrollAdjustment);
    }

    function isValidMethod(method) {
        if (PUBLIC_METHODS.indexOf(method) === -1) {
            throw new Error('Invalid timepicker method');
        }
        return true;
    }

    function isValidInterval(interval) {
        if (!TIME_REGEX.exec(interval)) {
            throw new Error('Invalid interval, must be a valid time');
        }
    }

    function isValidOptions(options) {
        if (options.interval) {
            isValidInterval(options.interval);
        }
        return true;
    }

    MicroEvent.mixin(TimePicker);

    function setupPlugin($inputs, options) {
        options = $.extend({}, $.timepicker.defaults, options);

        return $inputs.each(function () {
            var $input = $(this),
                instance,
                currentInstance = $input.data('timepicker');

            // destroy the existing time picker
            if (currentInstance) {
                currentInstance.destroy();
                currentInstance = undefined;
            }

            // extend prototype with customisable options
            $.extend(TimePicker.prototype, {
                custom: options
            });

            instance = new TimePicker($input);

            // store reference to timepicker instance on elements $.data
            $input.data('timepicker', instance);
        });
    }

    function runPluginMethod($inputs, method, args) {
        return $inputs.each(function () {
            var $input = $(this),
                timepicker;

            timepicker = $input.data('timepicker');
            timepicker[method].apply(timepicker, args);
        });
    }

    function isInstantiation(options) {
        return _.isObject(options) && isValidOptions(options);
    }

    function isMethodCall(options) {
        return _.isString(options) && isValidMethod(options);
    }

    $.fn.timepicker = function (value) {
        var options = value || {};

        if (isInstantiation(options)) {
            return setupPlugin(this, options);
        } else if (isMethodCall(options)) {
            return runPluginMethod(this, options, Array.prototype.slice.call(arguments, 1));
        } else {
            throw new Error('Invalid timepicker call');
        }
    };

    // static methods
    $.timepicker = {};

    // default options
    $.timepicker.defaults = {
        pickerContainer: 'body',
        pickerClassName: 'time-picker',
        pickerSelectedClassName: 'time-picker--selected',
        interval: '01:00'
    };


    // custom selector
    $.expr.pseudos.timepicker = function (elem) {
        return $(elem).data('timepicker') !== undefined;
    };

    return TimePicker;
});
