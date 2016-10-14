(function(root, factory) {
    'use strict';
    if (typeof define === 'function' && define.amd) {
        define(['jquery', 'underscore', 'moment', 'timepicker'], function($, _, moment) {
            return factory($, _, moment);
        });
    } else {
        root.daterangepicker.timeSupport = factory(root.jQuery, root._, root.moment);
    }
})(this, function($, _, moment) {
    'use strict';

    var TIME_REGEX = /^([01]\d|2[0-3]):([0-5]\d)$/,
        TIME_FORMAT = 'HH:mm';

    function setupTimePanelEvents(panel) {
        panel.$el.on('change.time-panel', panel.$input, function() {
            if (panel.isValidTime()) {
                panel.updateCalendarDate();
            }
        });
    }

    function getTimePanel() {
        return $('<div class="time-support__panel"><input name="time" class="time-support__field field rounded" /></div>');
    }

    function getTimePanelWrapper() {
        var html = '<div class="time-support">' +
            '<div class="time-support__panel-wrapper"></div>' +
            '<label class="time-support__specify-time"><input type="checkbox" name="specifyTime"> Specify time</label>' +
            '</div>';
        return $(html);
    }

    function TimePanel(options) {
        if (!options.calendar) {
            throw new Error('Time panel must be instantiated with options.calendar');
        }

        this.$el = getTimePanel();
        this.$input = this.$el.find('input[name="time"]').timepicker();
        this.calendar = options.calendar;
        this.timezone = options.timezone;

        setupTimePanelEvents(this);
    }

    _.extend(TimePanel.prototype, {
        isValidTime: function() {
            var panel = this,
                time = panel.$input.val();

            panel.$input.removeClass('invalid-time');

            if (!time || !TIME_REGEX.test(time)) {
                panel.$input.addClass('invalid-time');
                return false;
            }

            return true;
        },

        getTime: function() {
            var time = this.$input.val();
            return moment.tz(time, TIME_FORMAT, this.timezone);
        },

        setTime: function(time) {
            this.$input.val(time);
        },

        updateCalendarDate: function(options) {
            var panel = this,
                date,
                hours = 0,
                minutes = 0,
                time = panel.getTime(),
                currentDate = panel.calendar.selectedDate;

            options = options || {};

            if (time) {
                hours = time.hours();
                minutes = time.minutes();
            }

            date = moment.tz([
                currentDate.year(),
                currentDate.month(),
                currentDate.date(),
                hours,
                minutes
            ], this.timezone);

            panel.calendar.updateSelectedDate(date, options);
        },

        destroy: function() {
            var panel = this;

            if (panel.$el) {
                panel.$el.remove();
                panel.$el.off('.time-panel');
            }
        }
    });

    function TimeSupport(options) {
        var plugin = this,
            isSpecifyTimeChecked = (options || {}).specifyTimeChecked;

        plugin.$el = getTimePanelWrapper();

        plugin.$specifyTime = plugin.$el.find('[name=specifyTime]');

        plugin.$specifyTime.prop('checked', isSpecifyTimeChecked);

        plugin.$specifyTime.on('change', _.bind(plugin.setPanelState, plugin));
    }

    TimeSupport.pluginName = 'timeSupport';

    _.extend(TimeSupport.prototype, {
        resetCalendars: function(){
            var plugin = this,
                refreshData = {};

            plugin.startPanel.updateCalendarDate({silent: true});
            refreshData.startDate = plugin.startPanel.calendar.selectedDate;

            plugin.endPanel.updateCalendarDate({silent: true});
            refreshData.endDate = plugin.endPanel.calendar.selectedDate;

            plugin.picker.trigger('refresh', refreshData);
        },

        setPanelState: function () {
            var plugin = this;

            if (plugin.$specifyTime.prop('checked')) {
                plugin.openPanel();
            } else {
                plugin.closePanel();
            }
        },

        render: function(daterangepicker) {
            var plugin = this;

            plugin.$el.insertBefore(daterangepicker.$el.find('.calendar-footer'));

            plugin.$panelWrapper = plugin.$el.find('.time-support__panel-wrapper');

            plugin.$panelWrapper.html(plugin.startPanel.$el);

            plugin.$panelWrapper.append(plugin.endPanel.$el);

            plugin.setPanelState();
        },

        updateStartTime: function(startMoment) {
            this.startPanel.setTime(startMoment.format(TIME_FORMAT));
        },

        updateEndTime: function(endMoment) {
            this.endPanel.setTime(endMoment.format(TIME_FORMAT));
        },

        getStartTimePicker: function () {
            return this.startPanel.$input.data('timepicker');
        },

        setTimezone: function(timezone) {
            var isUTC = timezone.indexOf('UTC') !== -1;
            var tzOffset = isUTC ? '(UTC)' : moment.tz(timezone).format('(UTCZ)');
            this.$timezoneSpan.text(tzOffset);
        },

        getEndTimePicker: function () {
            return this.endPanel.$input.data('timepicker');
        },

        openPanel: function() {
            this.$panelWrapper.addClass('isOpen');

            this.updateStartTime(this.startPanel.calendar.selectedDate.tz(this.picker.timezone));
            this.updateEndTime(this.endPanel.calendar.selectedDate.tz(this.picker.timezone));

            this.resetCalendars();
        },

        closePanel: function() {
            var plugin = this,
                startOfDay = moment().startOf('day');

            plugin.$panelWrapper.removeClass('isOpen');

            plugin.updateStartTime(startOfDay);

            plugin.updateEndTime(startOfDay);

            plugin.resetCalendars();
        },

        attach: function(daterangepicker) {
            var plugin = this,
                startCalendar = daterangepicker.startCalendar,
                endCalendar = daterangepicker.endCalendar,
                timezone = daterangepicker.timezone;

            if (!endCalendar) {
                throw new Error('Timepicker is not supported for single date');
            }

            plugin.picker = daterangepicker;

            plugin.startPanel = new TimePanel({
                calendar: startCalendar,
                timezone: timezone
            });

            $('<label class="time-support__from">From</label>').insertBefore(plugin.startPanel.$input);

            plugin.endPanel = new TimePanel({
                calendar: endCalendar,
                timezone: timezone
            });

            $('<label class="time-support__to">To</label>').insertBefore(plugin.endPanel.$input);
            this.$timezoneSpan = $('<span class="time-support__zone"></span>').insertAfter(plugin.endPanel.$input);

            this.setTimezone(timezone);

            daterangepicker.bind('onRendered', function() {
                plugin.render(daterangepicker);
            });

            daterangepicker.bind('startDateSelected', function(args) {
                plugin.updateEndTime(args.endDate);

                endCalendar.updateSelectedDate(args.endDate, {
                    silent: true
                });
            });

            daterangepicker.bind('endDateSelected', function(args) {
                plugin.updateStartTime(args.startDate);

                startCalendar.updateSelectedDate(args.startDate, {
                    silent: true
                });
            });

            daterangepicker.bind('presetSelected', function(args) {
                var specifyTime = (args.specifyTime === true);

                plugin.$specifyTime.prop('checked', specifyTime).trigger('change');

                plugin.updateStartTime(args.startDate);
                plugin.updateEndTime(args.endDate);

                startCalendar.updateSelectedDate(args.startDate, {
                    silent: true
                });

                endCalendar.updateSelectedDate(args.endDate, {
                    silent: true
                });
            });

            /* calendar.updateSelectedDate is called when a day table cell ('td.day')
             * is clicked and it passes date as a string e.g. "2014-09-12".
             * When that happens the current time entered by the user is lost.
             *
             * This wrapper function ensures that calendar.updateSelectedDate
             * is always called with both date and time if specify time is checked.
             */
            function updateSelectedDateWrapper(panel, originalUpdateSelectedDate, date, options) {
                var time;

                if (plugin.$specifyTime.prop('checked')) {
                    time = panel.getTime();
                    date = moment.tz(date, timezone).hours(time.hours()).minutes(time.minutes());
                }

                originalUpdateSelectedDate.call(panel.calendar, date, options);
            }

            startCalendar.updateSelectedDate = _.wrap(startCalendar.updateSelectedDate, function(originalFunc, date, options) {
                updateSelectedDateWrapper(plugin.startPanel, originalFunc, date, options);
            });

            endCalendar.updateSelectedDate = _.wrap(endCalendar.updateSelectedDate, function(originalFunc, date, options) {
                updateSelectedDateWrapper(plugin.endPanel, originalFunc, date, options);
            });
        },

        detach: function() {
            var plugin = this;

            plugin.$el.remove();

            plugin.startPanel.destroy();

            plugin.endPanel.destroy();
        }
    });

    return TimeSupport;
});
