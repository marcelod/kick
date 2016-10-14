/*
 * daterangepicker.js, renders lightweight date rangepicker.
 *
 * Dependencies: jQuery, underscore.js, moment.js
 *
 * License: MIT
**/
(function(root, factory){
    'use strict';

    // Full MicroEvents library @ 54e85c036c3f903b963a0e4a671f72c1089ae4d4
    // (added some missing semi-colons etc, that's it)
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

    var MicroEvent  = function(){};
    MicroEvent.prototype    = {
        bind    : function(event, fct){
            this._events = this._events || {};
            this._events[event] = this._events[event]   || [];
            this._events[event].push(fct);
        },
        unbind  : function(event, fct){
            this._events = this._events || {};
            if( event in this._events === false  ) { return; }
            this._events[event].splice(this._events[event].indexOf(fct), 1);
        },
        trigger : function(event /* , args... */){
            this._events = this._events || {};
            if( event in this._events === false  ) { return; }
            for(var i = 0; i < this._events[event].length; i++){
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
    MicroEvent.mixin    = function(destObject){
        var props   = ['bind', 'unbind', 'trigger'];
        for(var i = 0; i < props.length; i ++){
            destObject.prototype[props[i]]  = MicroEvent.prototype[props[i]];
        }
    };
    /// END MicroEvents

    // Work with AMD or plain-ol script tag
    if(typeof define === 'function' && define.amd){
        // If window.jQuery or window._ are not defined, then assume we're using AMD modules
        define(['jquery', 'underscore', 'moment', 'moment-timezone'], function($, _, moment){
            return factory($ || root.jQuery, _ || root._, moment || root.moment, MicroEvent);
        });
    }else{
        root.daterangepicker = factory(root.jQuery, root._, root.moment, MicroEvent);
    }

})(this, function($, _, moment, MicroEvent){

    'use strict';

    if(!$){
        throw new Error('daterangepicker requires jQuery to be loaded');
    }
    if(!_){
        throw new Error('daterangepicker requires underscore to be loaded');
    }
    if(!moment){
        throw new Error('daterangepicker requires moment to be loaded');
    }

    var MILLISECONDS_PER_DAY = 1000 * 60 * 60 * 24,
        DEFAULT_TIMEZONE = 'UTC';

    function Calendar(options){
        var $el = this.$el = $('<div>');
        var className = options.className;
        var timezone = this.timezone = options.timezone;
        var todayString = moment.tz(timezone).format('YYYY-MM-DD');
        var selectedDate = this.selectedDate = moment.tz(options.selectedDate, timezone);
        var monthToDisplay = moment.tz([selectedDate.year(), selectedDate.month(), 1, 12], timezone);

        options = _.defaults(options, {
            selectedDate: todayString
        });

        this.label = options.label;

        this.monthToDisplay = monthToDisplay;

        if(className){
            $el.addClass(className);
        }

        $el.on('click', 'td.day', _.bind(this.onDayClicked, this));
        $el.on('click', 'th.next', _.bind(this.onNextClicked, this));
        $el.on('click', 'th.prev', _.bind(this.onPreviousClicked, this));
    }

    function buildCalendarHtml(data){
        var rowHtml = _(data.rows).map(function(row){
            var columnHtml = _(row.columns).map(function(col){
                return '<td class="day ' + (col.className || '') + '" data-date="' + col.date +'">' + col.dayNumber +'</td>';
            });
            return '<tr class="week">' + columnHtml.join('') + '</tr>';
        });

        return '<table class="calendar">' +
                '<thead>' +
                    '<tr>' +
                        '<th>' + data.label + '</th>' +
                        '<th class="prev"><span class="icon-chevron-left"></span></th>' +
                        '<th class="month-title" colspan="3" style="width: auto">' + data.monthTitle + '</th>' +
                        '<th class="next"><span class="icon-chevron-right"></span></th>' +
                        '<th></th>' +
                    '</tr>' +
                    '<tr>' +
                        '<th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th>' +
                    '</tr>' +
                '</thead>' +
                '<tbody>' +
                    rowHtml.join('') +
                '</tbody>' +
            '</table>';
    }

    _.extend(Calendar.prototype, {
        _getStartDate: function(){
            var startDate = this.monthToDisplay.clone();

            if(startDate.day() !== 1){
                startDate.subtract({
                    d: (startDate.day() || 7) - 1
                });
            }

            return startDate;
        },

        _findCellByDate: function(date){
            return this.$el.find('.day[data-date="' + date.format('YYYY-MM-DD') + '"]');
        },

        render: function(){
            var rowStartDate = this._getStartDate().subtract({
                    d:1
                }),
                selectedDate = this.selectedDate,
                monthToDisplayIndex = this.monthToDisplay.month(),
                lastDayOfMonthToDisplay = this.monthToDisplay.clone().add({M: 1}).subtract({d: 1}),
                getClassName = function(date){
                    var classes = [];

                    if(date.month() !== monthToDisplayIndex){
                        classes.push('grey');
                    } else if (date.date() === selectedDate.date()){
                        classes.push('selected');
                    }

                    if(classes.length){
                        return classes.join(' ');
                    }
                },
                weeksToShow = Math.ceil(lastDayOfMonthToDisplay.diff(rowStartDate, 'days')/7),
                data = {
                    label: this.label ? '<span class="calendar-label">' + this.label + '</span>' : '',
                    monthTitle: this.monthToDisplay.format('MMMM YYYY'),
                    rows: _.map(_.range(weeksToShow), function(weekIdx){
                        return {
                            columns: _.map(_.range(7), function(dayIdx){
                                var date = rowStartDate.clone().add({
                                    d: (weekIdx * 7) + (dayIdx + 1)
                                });

                                return {
                                    date: date.format('YYYY-MM-DD'),
                                    className: getClassName(date),
                                    dayNumber: date.date()
                                };
                            })
                        };
                    })
                };

            this.$el.html(buildCalendarHtml(data));
        },

        destroy: function(){
            var $el = this.$el;

            $el.off('click', 'td.day');
            $el.off('click', 'th.next');
            $el.off('click', 'th.prev');

            $el.remove();
        },

        onDayClicked: function(e){
            e.stopPropagation();

            var target = $(e.target),
                date = target.data('date');

            this.updateSelectedDate(date);
        },

        onNextClicked: function(e){
            e.stopPropagation();

            this.monthToDisplay.add({M: 1});
            this.showMonth();
        },

        onPreviousClicked: function(e){
            e.stopPropagation();

            this.monthToDisplay.subtract({M: 1});
            this.showMonth();
        },

        updateSelectedDate: function(date, options){
            options = options || {};

            var newDate = this.selectedDate = moment.tz(date, this.timezone),
                month = newDate.month(),
                year = newDate.year(),
                monthToDisplay = this.monthToDisplay,
                silent = !!options.silent;

            if(month !== monthToDisplay.month() || year !== monthToDisplay.year()){
                this.showMonth();
            }

            this.addMarker(this.selectedDate);

            if(!silent){
                this.trigger('onDateSelected', { date: date });
            }
        },

        showMonth: function(){
            this.render();

            this.trigger('onMonthDisplayed', { month: this.monthToDisplay });
        },

        addMarker: function(date){
            var selectedClassName = 'selected';

            this.$el.find('.'+selectedClassName).removeClass(selectedClassName);
            this._findCellByDate(date).addClass(selectedClassName);
        },

        highlightCells: function(startDate, endDate){
            var startCell = this._findCellByDate(startDate).not('.grey'),
                endCell = this._findCellByDate(endDate).not('.grey'),
                startRow = startCell.parent(),
                endRow = endCell.parent(),
                inRangeClassName = 'inRange',
                daySelector = '.day',
                greySelector = '.grey',
                dateDiff = startDate.diff(endDate);

            this.$el.find('.'+inRangeClassName).removeClass(inRangeClassName);

            if(dateDiff === 0 || Math.abs(dateDiff) < MILLISECONDS_PER_DAY){
                return;
            }

            if(this.monthToDisplay.diff(startDate.clone().date(1)) < 0){
                if(!startCell.length){
                    return;
                }
            }

            if(this.monthToDisplay.diff(endDate.clone().date(1)) > 0){
                if(!endCell.length){
                    return;
                }
            }

            if(!startCell.length && !endCell.length){
                //fill all
                this.$el.find(daySelector).not(greySelector).addClass(inRangeClassName);
                return;
            }

            if(!startCell.length){
                //fill from start to endDate
                endCell.parent().prevAll().children(daySelector).not(greySelector).addClass(inRangeClassName);
                endCell.prevAll(daySelector).not(greySelector).addClass(inRangeClassName);
                return;
            }

            if(!endCell.length) {
                //fill from startDate to end
                startCell.parent().nextAll().children(daySelector).not(greySelector).addClass(inRangeClassName);
                startCell.nextAll(daySelector).not(greySelector).addClass(inRangeClassName);
                return;
            }

            //fill from startDate to endDate
            if(startRow.is(endRow)){
                startCell.nextUntil(endCell).addClass(inRangeClassName);
            } else {
                startRow.nextUntil(endRow).children(daySelector).not(greySelector).addClass(inRangeClassName);
                startCell.nextAll(daySelector).not(greySelector).addClass(inRangeClassName);
                endCell.prevAll(daySelector).not(greySelector).addClass(inRangeClassName);
            }

            endCell.addClass(inRangeClassName);
            startCell.addClass(inRangeClassName);
        }
    });

    function DateRangePicker(options){
        var todayString;
        var $el = this.$el = $('<div/>');

        options = _.defaults(options, {
            startDate: todayString,
            endDate: todayString,
            zIndex: 9999,
            singleDate: false
        });

        this.timezone = options.timezone || DEFAULT_TIMEZONE;
        todayString = moment.tz(this.timezone).format('YYYY-MM-DD');

        // required to catch "empty string" cases
        options.startDate = options.startDate || todayString;
        options.endDate = options.endDate || todayString;

        this.closeButtonCssClass = options.closeButtonCssClass || '';
        this.doneButtonCssClass = options.doneButtonCssClass || '';

        $el.on('click', '.presets li', _.bind(this.onPresetClick, this));
        $el.on('click', '.close a, .done', _.bind(this.onCloseClick, this));
        $el.on('click', 'table,div', function(e){ e.stopPropagation(); });


        this.startCalendar = this._createCalendar({
            selectedDate: options.startDate,
            timezone: this.timezone,
            className: 'startCalendar',
            label: options.singleDate?'':'From'
        });

        if (!options.singleDate){
            this.endCalendar = this._createCalendar({
                selectedDate: options.endDate,
                timezone: this.timezone,
                className: 'endCalendar',
                label: 'To'
            });
        }

        if(options.presets){
            this.presets = options.presets;
            this.$el.addClass('withPresets');
        }

        this.startCalendar.bind('onDateSelected', _.bind(this.onStartDateSelected, this));
        this.startCalendar.bind('onMonthDisplayed', _.bind(this._updateStartCalendarHighlight, this));

        if (!options.singleDate){
            this.endCalendar.bind('onDateSelected', _.bind(this.onEndDateSelected, this));
            this.endCalendar.bind('onMonthDisplayed', _.bind(this._updateEndCalendarHighlight, this));
        }

        this.zIndex = options.zIndex;
        this._plugins = [];
    }

    DateRangePicker.create = function(options){
        options = options || {};

        var plugins;
        var i;
        var $input = options.$input;
        var className = options.className;
        var picker;

        plugins = (options && options.plugins) || [];

        delete options.className;

        picker = new DateRangePicker(options);

        for(i = 0; i < plugins.length; i++){
            picker.addPlugin(plugins[i], options[plugins[i].pluginName]);
        }

        if(className){
            picker.$el.addClass(className);
        }

        picker.$input = $input;
        $input.data('picker', picker);

        return picker;
    };

    _.extend(DateRangePicker.prototype, {

        _createCalendar: function(options){
            return new Calendar(options);
        },

        _updateStartCalendarHighlight: function(){
            var startDate = this.getStartDate();

            if (this.endCalendar){
                this.startCalendar.highlightCells(startDate, this.getEndDate());
            }
            this.startCalendar.addMarker(startDate);
        },

        _updateEndCalendarHighlight: function(){
            var endDate = this.getEndDate();

            this.endCalendar.highlightCells(this.getStartDate(), endDate);
            this.endCalendar.addMarker(endDate);
        },

        _highlightRange: function(startDate, endDate){
            if(startDate.diff(endDate) > 0){
                return;
            }

            if (this.endCalendar){
                this.startCalendar.highlightCells(startDate, endDate);
                this.endCalendar.highlightCells(startDate, endDate);
            }
        },

        buildPresetsList: function(){
            var presets = this.presets,
                lis;

            if(!presets){
                return;
            }

            lis = _(presets).map(function(val, key){
                return [
                    '<li',
                        'data-startdate="' + val.startDate + '"',
                        'data-enddate="' + (val.endDate || val.startDate) + '"',
                        'data-time="' + ((val.specifyTime) ? 'true' : 'false') + '">' +
                        key +
                    '</li>'
                ].join(' ');
            });

            return [
                '<div class="presets-wrapper">',
                    '<div class="close">',
                        '<a class="' + _.escape(this.closeButtonCssClass) + '"></a>',
                    '</div>',
                    '<nav class="presets">',
                        '<h1>Quick Select</h1>',
                        '<ul>' + lis.join('') + '</ul>',
                    '</nav>',
                '</div>'
            ].join(' ');
        },

        render: function(){
            var startCalendar = this.startCalendar,
                endCalendar = this.endCalendar,
                presetsList = this.buildPresetsList(),
                calendarWrapper = $('<div class="calendar-wrapper">'),
                calendarWrapperInner = $('<div class="calendar-wrapper-inner"/>'),
                footer = $('<div class="calendar-footer">' +
                            '<button class="done ' + _.escape(this.doneButtonCssClass) + '">Done</button>' +
                            '</div>');

            startCalendar.render();
            this._updateStartCalendarHighlight();
            if (endCalendar){
                endCalendar.render();
                this._updateEndCalendarHighlight();
            }

            calendarWrapperInner.append(startCalendar.$el);
            if (endCalendar){
                calendarWrapperInner.append(endCalendar.$el);
            }

            calendarWrapperInner.appendTo(calendarWrapper);

            this.$el.addClass('picker')
                .append(presetsList)
                .append(calendarWrapper)
                .append(footer);

            this.trigger('onRendered');
        },

        show: function($target){
            var $el = this.$el,
                targetOffset = $target.offset(),
                windowWidth = $(window).width(),
                zIndex = this.zIndex,
                left;

            if( (targetOffset.left + $el.outerWidth()) > windowWidth ){
                left = windowWidth - $el.outerWidth() - 10;
            } else {
                left = targetOffset.left;
            }

            this.trigger('onBeforeShown', this);

            $el.show();
            
            $el.css({
                top: targetOffset.top + $target.outerHeight(),
                left: left,
                zIndex: zIndex
            });

            $(document).on('click.daterangepicker', _.bind(this.hide, this));
        },

        hide: function(){
            this.$el.hide();
            $(document).off('click.daterangepicker', this.hide);
        },

        destroy: function(){
            var pluginName;

            this.startCalendar.destroy();
            if (this.endCalendar){
                this.endCalendar.destroy();
            }

            while (pluginName = this._plugins.shift()) {
                if (this[pluginName].detach) {
                    this[pluginName].detach(this);
                }
                this[pluginName] = undefined;
            }
            this._plugins = [];

            this.$input.removeData('picker');
            this.$el.remove();
        },

        getStartDate: function(){
            return this.startCalendar.selectedDate;
        },

        getEndDate: function(){
            if (this.endCalendar){
                return this.endCalendar.selectedDate;
            }
            return this.startCalendar.selectedDate;
        },

        setDateRange: function(startDate, endDate){
            startDate = moment.tz(startDate, this.timezone);
            if (this.endCalendar){
                endDate = moment.tz(endDate, this.timezone);
                if(startDate.diff(endDate) > 0){
                    return;
                }
            }

            this.startCalendar.updateSelectedDate(startDate);

            if (this.endCalendar){
                this.endCalendar.updateSelectedDate(endDate);
            }
        },

        onStartDateSelected: function(args){
            var startDate = moment.tz(args.date, this.timezone),
                endDate = this.getEndDate();

            if(moment.tz(startDate, this.timezone).diff(endDate) > 0){
                this.endCalendar.updateSelectedDate(startDate, {silent: true});
                endDate = startDate;
            }

            this._highlightRange(startDate, endDate);

            this.trigger('startDateSelected', {
                startDate: startDate,
                endDate: endDate
            });
        },

        onEndDateSelected: function(args){
            var endDate = moment.tz(args.date, this.timezone),
                startDate = this.getStartDate();

            if(moment.tz(startDate, this.timezone).diff(endDate) > 0){
                this.startCalendar.updateSelectedDate(endDate, {silent: true});
                startDate = endDate;
            }

            this._highlightRange(startDate, endDate);

            this.trigger('endDateSelected', {
                startDate: startDate,
                endDate: endDate
            });
        },

        onPresetClick: function(e){
            e.stopPropagation();

            var target = $(e.target),
                startDate = moment.tz(target.data('startdate'), this.timezone),
                endDate = moment.tz(target.data('enddate'), this.timezone),
                specifyTime = target.data('time');

            this.startCalendar.updateSelectedDate(startDate, { silent : true });
            if (this.endCalendar){
                this.endCalendar.updateSelectedDate(endDate, { silent : true });
            }

            this._updateStartCalendarHighlight();
            if (this.endCalendar){
                this._updateEndCalendarHighlight();
            }

            this.trigger('presetSelected', {
                startDate: startDate,
                endDate: endDate,
                specifyTime: specifyTime
            });
        },

        onCloseClick: function(e) {
            e.stopPropagation();

            this.hide();
        },

        /*
         * Registers a plugin with this daterangepicker instance
         *
         * Plugin: The Plugins constructor
         * options: An options hash unique to the plugin (or undefined)
        **/
        addPlugin: function(Plugin, options){
            if(!Plugin.pluginName){
                throw new Error('Plugin ' + Plugin + ' must have a pluginName property');
            }

            var plugin = new Plugin(options);
            plugin.attach(this);

            this[Plugin.pluginName] = plugin;
            this._plugins.push(Plugin.pluginName);
        }
    });

    MicroEvent.mixin(Calendar);
    MicroEvent.mixin(DateRangePicker);

    $.fn.daterangepicker = function(options) {
        options = options || {};

        var updateValue = function(formatter, args){
            var startDate = args.startDate,
                endDate = args.endDate,
                formattedValue = formatter(startDate, endDate);

            this.val(formattedValue);
        };

        return this.each(function() {
            var $self = $(this),
                picker = $self.data('picker'),
                formatter = options.dateFormatter || function(startDate, endDate){
                    return startDate.format('DD MMM YYYY') + ' - ' + endDate.format('DD MMM YYYY');
                },
                boundUpdate = _.bind(updateValue, $self, formatter);

            if(!picker){
                options.$input = $self;
                picker = DateRangePicker.create(options);

                picker.render();

                picker.bind('startDateSelected', boundUpdate);
                picker.bind('endDateSelected', boundUpdate);
                picker.bind('presetSelected', boundUpdate);
                picker.bind('refresh', boundUpdate);

                $('body').append(picker.$el.hide());
            }

            $self.on('click', function(e){
                e.stopPropagation();

                picker.show($self);
            });
        });
    };

    return DateRangePicker;
});
