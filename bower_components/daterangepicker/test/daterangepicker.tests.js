define([
    'sinon',
    'moment',
    'lib/daterangepicker/daterangepicker'
], function(
    sinon,
    moment,
    daterangepicker
){
    'use strict';

    describe('daterangepicker', function(){
        var picker;
        var timezone = 'Australia/Canberra';
        var christmas2012Str = moment.tz([2012,11,25], timezone).format('YYYY-MM-DD');
        var nye2012Str = moment.tz([2012,11,31], timezone).format('YYYY-MM-DD');
        var $testInput = $('<input type="text">');

        afterEach(function(){
            if(picker){
                picker.destroy();
                picker = undefined;
            }
        });

        describe('a datepicker calendar', function(){
            var calendar;

            beforeEach(function(){
                picker = daterangepicker.create({
                    $input: $testInput
                });
                calendar = picker._createCalendar({
                    selectedDate: '2012-12-25',
                    className: 'myCalendar',
                    timezone: timezone
                });
            });

            it('calculates the start date as the first monday', function(){
                var startDate = calendar._getStartDate();

                expect(startDate.year()).toEqual(2012);
                expect(startDate.month()).toEqual(10);
                expect(startDate.date()).toEqual(26);
                expect(startDate.day()).toEqual(1);
            });

            describe('initialization', function(){
                it('stores the selected date', function(){
                    expect(calendar.selectedDate.toString()).toEqual(moment.tz([2012,11,25], timezone).toString());
                });

                it('stores the selected month', function(){
                    expect(calendar.monthToDisplay.toString()).toEqual(moment.tz([2012,11,1,12], timezone).toString());
                });

                it('sets this.$el to be an empty div', function(){
                    expect(calendar.$el).toBeDefined();
                    expect(calendar.$el.is('div')).toEqual(true);
                    expect(calendar.$el.children().length).toEqual(0);
                });

                it('sets the className of this.$el', function(){
                    expect(calendar.$el.hasClass('myCalendar')).toEqual(true);
                });
            });

            describe('rendering', function(){
                beforeEach(function(){
                    calendar.render();
                });

                it('renders the table with 6 "week" rows', function(){
                    expect(calendar.$el.find('tr.week').length).toEqual(6);
                });

                it('renders the table with 6 "week" rows for months with 30 days that start on a Sunday', function(){
                    calendar = picker._createCalendar({
                        selectedDate: '2013-09-30',
                    });
                    calendar.render();
                    expect(calendar.$el.find('tr.week').length).toEqual(6);
                });

                it('renders the table with 6 "week" rows for months with 31 days that start on a Saturday', function(){
                    calendar = picker._createCalendar({
                        selectedDate: '2011-10-31',
                    });
                    calendar.render();
                    expect(calendar.$el.find('tr.week').length).toEqual(6);
                });

                it('renders the table with 42 "day" cells', function(){
                    expect(calendar.$el.find('td.day').length).toEqual(42);
                });

                it('adds the date to the day cells as "data-date"', function(){
                    expect(calendar.$el.find('td.day').first().data('date')).toEqual('2012-11-26');
                });

                it('adds a class of "grey" to the days not in the current month', function(){
                    expect(calendar.$el.find('td.day.grey').length).toEqual(11);
                });

                it('adds a class of "selected" to the selected date', function(){
                    expect(calendar.$el.find('td.day.selected').length).toEqual(1);
                    expect(calendar.$el.find('td.day.selected').data('date')).toEqual('2012-12-25');
                });

                it('renders the month title', function(){
                    expect(calendar.$el.find('th.month-title').text()).toEqual('December 2012');
                });

                it('does not render the close button when no presets specified', function(){
                    picker.render();
                    expect(picker.$el.find('.close').length).toEqual(0);
                });

                it('renders the close button when presets specified', function(){
                    picker = daterangepicker.create({
                        $input: $testInput,
                        presets: {
                            'christmas 2012': {
                                startDate: christmas2012Str
                            },
                            'new years eve 2012': {
                                startDate: nye2012Str
                            }
                        }
                    });
                    picker.render();
                    expect(picker.$el.find('.close').length).toEqual(1);
                });

                it('renders the close button with custom css class', function(){
                    picker = daterangepicker.create({
                        $input: $testInput,
                        presets: {
                            'christmas 2012': {
                                startDate: christmas2012Str
                            },
                            'new years eve 2012': {
                                startDate: nye2012Str
                            }
                        },
                        closeButtonCssClass: 'testClass'
                    });
                    picker.render();
                    expect(picker.$el.find('.close .testClass').length).toEqual(1);
                });

                it('triggers an "onRendered" event on the daterangepicker', function() {
                    picker = daterangepicker.create({
                        $input: $testInput
                    });

                    sinon.spy(picker, 'trigger');

                    picker.render();

                    expect(picker.trigger.calledOnce).toEqual(true);
                    expect(picker.trigger.calledWith('onRendered')).toEqual(true);
                });
            });

            describe('events', function(){
                beforeEach(function(){
                    calendar.render();
                });

                it('triggers an onDateSelected event with the date clicked when a day is clicked', function(done){
                    calendar.bind('onDateSelected', function(args){
                        expect(args).toBeDefined();
                        expect(args.date).toEqual('2012-12-25');

                        done();
                    });

                    calendar.$el.find('td.day.selected').click();
                });

                it('updates the month if the date clicked is not on this.monthToDisplay', function(){
                    var previousMonthDate = calendar.$el.find('.day[data-date="2012-11-30"]'),
                        showMonthSpy = sinon.spy(calendar, 'showMonth');

                    previousMonthDate.click();

                    expect(showMonthSpy.calledOnce).toEqual(true);
                    expect(calendar.monthToDisplay.year()).toEqual(2012);
                    expect(calendar.monthToDisplay.month()).toEqual(11);
                });

                it('updates this.selectedDate when a day is clicked', function(){
                    var newDate = calendar.$el.find('.day[data-date="2012-12-01"]');

                    newDate.click();

                    expect(calendar.selectedDate.year()).toEqual(2012);
                    expect(calendar.selectedDate.month()).toEqual(11);
                    expect(calendar.selectedDate.date()).toEqual(1);
                });

                it('updates this.monthToDisplay when next is clicked', function(){
                    calendar.$el.find('.next').click();

                    expect(calendar.monthToDisplay.month()).toEqual(0);
                    expect(calendar.monthToDisplay.year()).toEqual(2013);
                });

                it('re-renders when next is clicked', function(){
                    var renderStub = sinon.stub(calendar, 'render');

                    calendar.$el.find('.next').click();

                    expect(renderStub.calledOnce).toEqual(true);
                });

                it('updates this.monthToDisplay when previous is clicked', function(){
                    calendar.$el.find('.prev').click();

                    expect(calendar.monthToDisplay.month()).toEqual(10);
                    expect(calendar.monthToDisplay.year()).toEqual(2012);
                });

                it('re-renders when previous is clicked', function(){
                    var renderStub = sinon.stub(calendar, 'render');

                    calendar.$el.find('.prev').click();

                    expect(renderStub.calledOnce).toEqual(true);
                });

                it('closes the picker when clicking close button', function(){
                    var hideSpy;
                    picker = daterangepicker.create({
                        $input: $testInput,
                        presets: {
                            'christmas 2012': {
                                startDate: christmas2012Str
                            },
                            'new years eve 2012': {
                                startDate: nye2012Str
                            }
                        }
                    });
                    picker.render();

                    hideSpy = sinon.spy(picker, 'hide');
                    picker.$el.find('.close a').click();

                    expect(hideSpy.calledOnce).toEqual(true);
                });
            });

            describe('showing a month', function(){
                beforeEach(function(){
                    calendar.render();
                });

                it('re-renders', function(){
                    var renderSpy = sinon.spy(calendar, 'render');

                    calendar.showMonth();

                    expect(renderSpy.calledOnce).toEqual(true);
                });
            });

            describe('highlighting cells', function(){
                beforeEach(function(){
                    calendar.render();
                });

                it('highlights from the start to the end of the month if the end date is next month', function(){
                    var startDate = moment.tz([2012,11,30], timezone);
                    var endDate = moment.tz([2013,0,2], timezone);

                    calendar.highlightCells(startDate, endDate);

                    expect(calendar.$el.find('.inRange').length).toEqual(1);
                    expect(calendar.$el.find('.inRange').eq(0).data('date')).toEqual('2012-12-31');
                });

                it('highlights from the end date to the start of the month if the start date is previous month', function(){
                    var startDate = moment.tz([2012,10,30], timezone);
                    var endDate = moment.tz([2012,11,2], timezone);

                    calendar.highlightCells(startDate, endDate);

                    expect(calendar.$el.find('.inRange').length).toEqual(1);
                    expect(calendar.$el.find('.inRange').eq(0).data('date')).toEqual('2012-12-01');
                });

                it('highlights the range if both start and end are in the displayed month', function(){
                    var startDate = moment.tz([2012,11,24], timezone);
                    var endDate = moment.tz([2012,11,30], timezone);

                    calendar.highlightCells(startDate, endDate);

                    expect(calendar.$el.find('.inRange').length).toEqual(7);
                    expect(calendar.$el.find('.inRange').eq(0).data('date')).toEqual('2012-12-24');
                    expect(calendar.$el.find('.inRange').eq(1).data('date')).toEqual('2012-12-25');
                    expect(calendar.$el.find('.inRange').eq(2).data('date')).toEqual('2012-12-26');
                    expect(calendar.$el.find('.inRange').eq(3).data('date')).toEqual('2012-12-27');
                    expect(calendar.$el.find('.inRange').eq(4).data('date')).toEqual('2012-12-28');
                    expect(calendar.$el.find('.inRange').eq(5).data('date')).toEqual('2012-12-29');
                    expect(calendar.$el.find('.inRange').eq(6).data('date')).toEqual('2012-12-30');
                });
            });
        });

        describe('a DateRangePicker with single date', function(){

            describe('initialization', function(){

                describe('defaults', function(){
                    beforeEach(function(){
                        picker = daterangepicker.create({
                            $input: $testInput,
                            singleDate: true
                        });
                    });

                    it('creates a calendar for the current month as this.startCalendar', function(){
                        var now = moment();

                        expect(picker.startCalendar).toBeDefined();
                        expect(picker.startCalendar.monthToDisplay.month()).toEqual(now.month());
                    });

                    it('uses the current date as the startCalendar\'s selectedDate', function(){
                        var now = moment();

                        expect(picker.startCalendar.selectedDate.year()).toEqual(now.year());
                        expect(picker.startCalendar.selectedDate.month()).toEqual(now.month());
                        expect(picker.startCalendar.selectedDate.date()).toEqual(now.date());
                    });

                    it('parses dates in UTC if a timezone is not supplied', function(){
                        expect(picker.timezone).toEqual('UTC');
                    });
                });

                describe('custom date supplied in options', function(){
                    beforeEach(function(){
                        picker = daterangepicker.create({
                            $input: $testInput,
                            startDate: '2013-01-01',
                            singleDate: true
                        });
                    });

                    it('creates a calendar for the specified month as this.startCalendar', function(){
                        expect(picker.startCalendar).toBeDefined();
                        expect(picker.startCalendar.monthToDisplay.month()).toEqual(0);
                    });

                    it('uses the specified date as the startCalendar\'s selectedDate', function(){
                        expect(picker.startCalendar.selectedDate.year()).toEqual(2013);
                        expect(picker.startCalendar.selectedDate.month()).toEqual(0);
                        expect(picker.startCalendar.selectedDate.date()).toEqual(1);
                    });
                });

                describe('date range presets supplied in options', function(){
                    it('stores the presets hash as this.presets', function(){
                        var presets = {
                            foo: {
                                startDate: '2013-01-01'
                            },
                            bar: {
                                startDate: '2014-01-01'
                            }
                        };

                        picker = daterangepicker.create({
                            $input: $testInput,
                            presets: presets,
                            singleDate: true
                        });

                        expect(picker.presets).toEqual(presets);
                    });
                });
            });

            describe('rendering', function(){
                var startCalendarRenderSpy;

                beforeEach(function(){
                    picker = daterangepicker.create({
                        $input: $testInput,
                        singleDate: true
                    });

                    startCalendarRenderSpy = sinon.spy(picker.startCalendar, 'render');

                    picker.render();
                });

                afterEach(function(){
                    startCalendarRenderSpy = undefined;
                });

                it('does not create an end calendar', function(){
                    expect(picker.endCalender).not.toBeDefined();
                });

                it('renders the startCalendar into this.$el', function(){
                    expect(startCalendarRenderSpy.calledOnce).toEqual(true);
                    expect(picker.$el.find(picker.startCalendar.$el).length).toEqual(1);
                });

                it('does not render the calendar label', function(){
                    expect(picker.startCalendar.$el.find('.calendar-label').length).toEqual(0);
                });
            });

            describe('events', function(){
                beforeEach(function(){
                    picker = daterangepicker.create({
                        $input: $testInput,
                        startDate: '2012-12-25',
                        singleDate: true,
                        timezone: timezone
                    });
                    picker.render();
                });

                it('calls this.highlightRange when the startCalendar raises an onDateSelected event', function(){
                    var highlightRangeSpy = sinon.spy(picker, '_highlightRange');

                    picker.startCalendar.trigger('onDateSelected', { date: '2012-12-01' });

                    expect(highlightRangeSpy.calledOnce).toEqual(true);
                    expect(highlightRangeSpy.args[0][0].toString()).toEqual(moment.tz([2012,11,1], timezone).toString());
                    expect(highlightRangeSpy.args[0][1].toString()).toEqual(picker.getEndDate().toString());
                });

                it('triggers a startDateSelected event when the startCalendar date changes', function(){
                    var spy = sinon.spy();

                    picker.bind('startDateSelected', spy);

                    picker.startCalendar.$el.find('.day[data-date="2012-12-01"]').click();

                    expect(spy.calledOnce).toEqual(true);
                    expect(spy.args[0][0].startDate.toString()).toEqual(moment.tz([2012,11,1], timezone).toString());
                });
            });

            describe('presets', function(){
                beforeEach(function(){
                    picker = daterangepicker.create({
                        $input: $testInput,
                        presets: {
                            'christmas 2012': {
                                startDate: christmas2012Str
                            },
                            'new years eve 2012': {
                                startDate: nye2012Str,
                                specifyTime: true
                            }
                        },
                        singleDate: true,
                        timezone: timezone
                    });

                    picker.render();
                });

                it('renders the presets list', function(){
                    expect(picker.$el.find('.presets').length).toEqual(1);

                    expect(picker.$el.find('.presets li').eq(0).text()).toEqual('christmas 2012');
                    expect(picker.$el.find('.presets li').eq(0).data('startdate')).toEqual('2012-12-25');
                    expect(picker.$el.find('.presets li').eq(0).data('enddate')).toEqual('2012-12-25');

                    expect(picker.$el.find('.presets li').eq(1).text()).toEqual('new years eve 2012');
                    expect(picker.$el.find('.presets li').eq(1).data('startdate')).toEqual('2012-12-31');
                    expect(picker.$el.find('.presets li').eq(1).data('enddate')).toEqual('2012-12-31');
                });

                it('selects the corresponding date when a preset is clicked', function(){
                    var christmas2012 = moment.tz([2012,11,25], timezone);

                    picker.$el.find('.presets li').eq(0).click();

                    expect(picker.getStartDate().toString()).toEqual(christmas2012.toString());
                    expect(picker.getEndDate().toString()).toEqual(christmas2012.toString());
                });

                it('triggers a presetSelected event when a preset is chosen', function(){
                    var spy = sinon.spy(),
                        christmas2012 = moment.tz([2012,11,25], timezone);

                    picker.bind('presetSelected', spy);

                    picker.$el.find('.presets li').eq(0).click();

                    expect(spy.calledOnce).toEqual(true);
                    expect(spy.args[0][0].startDate.toString()).toEqual(christmas2012.toString());
                    expect(spy.args[0][0].endDate.toString()).toEqual(christmas2012.toString());
                });

                it('passes specifyTime as true if set to true on the preset', function() {
                    var spy = sinon.spy(),
                        nye2012Str = moment.tz([2012,11,31], timezone);

                    picker.bind('presetSelected', spy);

                    picker.$el.find('.presets li').eq(1).click();

                    expect(spy.calledOnce).toEqual(true);
                    expect(spy.args[0][0].startDate.toString()).toEqual(nye2012Str.toString());
                    expect(spy.args[0][0].endDate.toString()).toEqual(nye2012Str.toString());
                    expect(spy.args[0][0].specifyTime).toEqual(true);
                });

                it('passes specifyTime as false if set to false on the preset', function() {
                    var spy = sinon.spy(),
                        christmas2012 = moment.tz([2012,11,25], timezone);

                    picker.bind('presetSelected', spy);

                    picker.$el.find('.presets li').eq(0).click();

                    expect(spy.calledOnce).toEqual(true);
                    expect(spy.args[0][0].startDate.toString()).toEqual(christmas2012.toString());
                    expect(spy.args[0][0].endDate.toString()).toEqual(christmas2012.toString());
                    expect(spy.args[0][0].specifyTime).toEqual(false);
                });
            });
        });

        describe('a DateRangePicker', function(){

            describe('initialization', function(){

                describe('defaults', function(){
                    beforeEach(function(){
                        picker = daterangepicker.create({
                            $input: $testInput
                        });
                    });

                    it('creates a calendar for the current month as this.startCalendar', function(){
                        var now = moment();

                        expect(picker.startCalendar).toBeDefined();
                        expect(picker.startCalendar.monthToDisplay.month()).toEqual(now.month());
                    });

                    it('creates a calendar for the current month as this.endCalendar', function(){
                        var now = moment();

                        expect(picker.endCalendar).toBeDefined();
                        expect(picker.endCalendar.monthToDisplay.month()).toEqual(now.month());
                    });

                    it('uses the current date as the startCalendar\'s selectedDate', function(){
                        var now = moment();

                        expect(picker.startCalendar.selectedDate.year()).toEqual(now.year());
                        expect(picker.startCalendar.selectedDate.month()).toEqual(now.month());
                        expect(picker.startCalendar.selectedDate.date()).toEqual(now.date());
                    });

                    it('uses the current date as the endCalendar\'s selectedDate', function(){
                        var now = moment();

                        expect(picker.endCalendar.selectedDate.year()).toEqual(now.year());
                        expect(picker.endCalendar.selectedDate.month()).toEqual(now.month());
                        expect(picker.endCalendar.selectedDate.date()).toEqual(now.date());
                    });

                    it('parses dates in UTC if a timezone is not supplied', function(){
                        expect(picker.timezone).toEqual('UTC');
                    });
                });

                describe('custom range supplied in options', function(){
                    beforeEach(function(){
                        picker = daterangepicker.create({
                            $input: $testInput,
                            startDate: '2013-01-01',
                            endDate: '2013-02-14'
                        });
                    });

                    it('creates a calendar for the specified month as this.startCalendar', function(){
                        expect(picker.startCalendar).toBeDefined();
                        expect(picker.startCalendar.monthToDisplay.month()).toEqual(0);
                    });

                    it('creates a calendar for the specified month as this.endCalendar', function(){
                        expect(picker.endCalendar).toBeDefined();
                        expect(picker.endCalendar.monthToDisplay.month()).toEqual(1);
                    });

                    it('uses the specified date as the startCalendar\'s selectedDate', function(){
                        expect(picker.startCalendar.selectedDate.year()).toEqual(2013);
                        expect(picker.startCalendar.selectedDate.month()).toEqual(0);
                        expect(picker.startCalendar.selectedDate.date()).toEqual(1);
                    });

                    it('uses the specified date as the endCalendar\'s selectedDate', function(){
                        expect(picker.endCalendar.selectedDate.year()).toEqual(2013);
                        expect(picker.endCalendar.selectedDate.month()).toEqual(1);
                        expect(picker.endCalendar.selectedDate.date()).toEqual(14);
                    });
                });

                describe('date range presets supplied in options', function(){
                    it('stores the presets hash as this.presets', function(){
                        var presets = {
                            foo: {
                                startDate: '2013-01-01',
                                endDate: '2013-01-31'
                            },
                            bar: {
                                startDate: '2014-01-01',
                                endDate: '2014-01-31'
                            }
                        };

                        picker = daterangepicker.create({
                            $input: $testInput,
                            presets: presets
                        });

                        expect(picker.presets).toEqual(presets);
                    });
                });
            });

            describe('rendering', function(){
                var startCalendarRenderSpy,
                    endCalendarRenderSpy;

                beforeEach(function(){
                    picker = daterangepicker.create({
                        $input: $testInput,
                        doneButtonCssClass: 'customDoneButtonCss'
                    });

                    startCalendarRenderSpy = sinon.spy(picker.startCalendar, 'render');
                    endCalendarRenderSpy = sinon.spy(picker.endCalendar, 'render');

                    picker.render();
                });

                afterEach(function(){
                    startCalendarRenderSpy = undefined;
                    endCalendarRenderSpy = undefined;
                });

                it('renders the startCalendar into this.$el', function(){
                    expect(startCalendarRenderSpy.calledOnce).toEqual(true);
                    expect(picker.$el.find(picker.startCalendar.$el).length).toEqual(1);
                });

                it('renders the correct label for the startCalendar', function(){
                    expect(picker.startCalendar.$el.find('.calendar-label').length).toEqual(1);
                    expect(picker.startCalendar.$el.find('.calendar-label').text()).toEqual('From');
                });

                it('renders the endCalendar into this.$el', function(){
                    expect(endCalendarRenderSpy.calledOnce).toEqual(true);
                    expect(picker.$el.find(picker.endCalendar.$el).length).toEqual(1);
                });

                it('renders the correct label for the endCalendar', function(){
                    expect(picker.endCalendar.$el.find('.calendar-label').length).toEqual(1);
                    expect(picker.endCalendar.$el.find('.calendar-label').text()).toEqual('To');
                });

                it('renders the footer and done button', function(){
                    var $footer = picker.$el.find('.calendar-footer');
                    expect($footer.length).toEqual(1);
                    expect($footer.find('button.done').length).toEqual(1);
                    expect($footer.find('button.done').hasClass('customDoneButtonCss')).toEqual(true);
                });
            });

            describe('showing the picker', function() {
                var startCalendarRenderSpy,
                    endCalendarRenderSpy,
                    showStub;

                beforeEach(function(){
                    picker = daterangepicker.create({
                        $input: $testInput,
                        doneButtonCssClass: 'customDoneButtonCss'
                    });

                    startCalendarRenderSpy = sinon.spy(picker.startCalendar, 'render');
                    endCalendarRenderSpy = sinon.spy(picker.endCalendar, 'render');

                    picker.render();

                    showStub = sinon.stub(picker.$el, 'show');
                });

                afterEach(function(){
                    startCalendarRenderSpy.restore();
                    endCalendarRenderSpy.restore();
                    showStub.restore();
                });

                it('triggers an "onBeforeShown" event', function(){
                    picker.show($('body'));

                    expect(showStub.calledOnce).toEqual(true);
                });
            });

            describe('events', function(){
                beforeEach(function(){
                    picker = daterangepicker.create({
                        $input: $testInput,
                        startDate: '2012-12-25',
                        endDate: '2012-12-31',
                        timezone: timezone
                    });
                    picker.render();
                });

                it('changes the this.endCalendar.selectedDate if a later date is clicked on this.startCalendar', function(){
                    picker.startCalendar.updateSelectedDate('2014-01-01');

                    expect(picker.endCalendar.selectedDate.toString()).toEqual(picker.startCalendar.selectedDate.toString());
                });

                it('changes the this.startCalendar.selectedDate if an earlier date is clicked on this.endCalendar', function(){
                    picker.endCalendar.updateSelectedDate('2011-01-01');

                    expect(picker.endCalendar.selectedDate.toString()).toEqual(picker.startCalendar.selectedDate.toString());
                });

                it('calls this.highlightRange when the startCalendar raises an onDateSelected event', function(){
                    var highlightRangeSpy = sinon.spy(picker, '_highlightRange');

                    picker.startCalendar.trigger('onDateSelected', { date: '2012-12-01' });

                    expect(highlightRangeSpy.calledOnce).toEqual(true);
                    expect(highlightRangeSpy.args[0][0].toString()).toEqual(moment.tz([2012,11,1], timezone).toString());
                    expect(highlightRangeSpy.args[0][1].toString()).toEqual(picker.getEndDate().toString());
                });

                it('calls this.highlightRange when the endCalendar raises an onDateSelected event', function(){
                    var highlightRangeSpy = sinon.spy(picker, '_highlightRange');

                    picker.endCalendar.trigger('onDateSelected', { date: '2012-12-30' });

                    expect(highlightRangeSpy.calledOnce).toEqual(true);
                    expect(highlightRangeSpy.args[0][0].toString()).toEqual(moment.tz([2012,11,25], timezone).toString());
                    expect(highlightRangeSpy.args[0][1].toString()).toEqual(moment.tz([2012,11,30], timezone).toString());
                });

                it('triggers a startDateSelected event when the startCalendar date changes', function(){
                    var spy = sinon.spy();

                    picker.bind('startDateSelected', spy);

                    picker.startCalendar.$el.find('.day[data-date="2012-12-01"]').click();

                    expect(spy.calledOnce).toEqual(true);
                    expect(spy.args[0][0].startDate.toString()).toEqual(moment.tz([2012,11,1], timezone).toString());
                });

                it('triggers a endDateSelected event when the endCalendar date changes', function(){
                    var spy = sinon.spy();

                    picker.bind('endDateSelected', spy);

                    picker.endCalendar.$el.find('.day[data-date="2012-12-30"]').click();

                    expect(spy.calledOnce).toEqual(true);
                    expect(spy.args[0][0].endDate.toString()).toEqual(moment.tz([2012,11,30], timezone).toString());
                });

                it('triggers endDateSelected with corrected date when end date before start date', function(){
                    var spy = sinon.spy();

                    picker.bind('endDateSelected', spy);

                    picker.endCalendar.$el.find('.day[data-date="2012-12-20"]').click();

                    expect(spy.calledOnce).toEqual(true);
                    expect(spy.args[0][0].startDate.toString()).toEqual(moment.tz([2012,11,20], timezone).toString());
                    expect(spy.args[0][0].endDate.toString()).toEqual(moment.tz([2012,11,20], timezone).toString());
                });

                it('triggers startDateSelected with corrected date when start date after end date', function(){
                    var spy = sinon.spy();

                    picker.endCalendar.$el.find('.day[data-date="2012-12-30"]').click();

                    picker.bind('startDateSelected', spy);

                    picker.startCalendar.$el.find('.day[data-date="2012-12-31"]').click();

                    expect(spy.calledOnce).toEqual(true);
                    expect(spy.args[0][0].startDate.toString()).toEqual(moment.tz([2012,11,31], timezone).toString());
                    expect(spy.args[0][0].endDate.toString()).toEqual(moment.tz([2012,11,31], timezone).toString());
                });

                it('does not trigger onDateSelected on the other calendar when fixing start date', function(){
                    var dateSelectedEventStub = sinon.stub();

                    picker.startCalendar.$el.find('.day[data-date="2012-12-31"]').click();

                    picker.startCalendar.bind('onDateSelected', dateSelectedEventStub);

                    picker.endCalendar.$el.find('.day[data-date="2012-12-30"]').click();

                    expect(dateSelectedEventStub.callCount).toEqual(0);
                });

                it('does not trigger onDateSelected on the other calendar when fixing end date', function(){
                    var dateSelectedEventStub = sinon.stub();

                    picker.endCalendar.$el.find('.day[data-date="2012-12-30"]').click();

                    picker.endCalendar.bind('onDateSelected', dateSelectedEventStub);

                    picker.startCalendar.$el.find('.day[data-date="2012-12-31"]').click();

                    expect(dateSelectedEventStub.callCount).toEqual(0);
                });

                it('hides picker when done button is clicked', function(){
                    var hideSpy = sinon.spy(picker, 'hide');
                    picker.$el.find('button.done').click();
                    expect(hideSpy.calledOnce).toEqual(true);
                });
            });

            describe('highlighting cells', function(){
                var startCalendarHighlightCellsSpy,
                    endCalendarHighlightCellsSpy;

                beforeEach(function(){
                    picker = daterangepicker.create({
                        $input: $testInput,
                        startDate: '2012-12-01',
                        endDate: '2012-12-31',
                        timezone: timezone
                    });
                    picker.render();

                    startCalendarHighlightCellsSpy = sinon.spy(picker.startCalendar, 'highlightCells');
                    endCalendarHighlightCellsSpy = sinon.spy(picker.endCalendar, 'highlightCells');
                });

                it('calls this.startCalendar.highlightCells with the correct dates', function(){
                    var startDate = moment.tz([2012,11,1], timezone),
                        endDate = moment.tz([2012,11,31], timezone);

                    picker._highlightRange(startDate, endDate);

                    expect(startCalendarHighlightCellsSpy.calledOnce).toEqual(true);
                    expect(startCalendarHighlightCellsSpy.args[0][0]).toEqual(startDate);
                    expect(startCalendarHighlightCellsSpy.args[0][1]).toEqual(endDate);
                });

                it('calls this.endCalendar.highlightCells with the correct dates', function(){
                    var startDate = moment.tz([2012,11,1], timezone),
                        endDate = moment.tz([2012,11,31], timezone);

                    picker._highlightRange(startDate, endDate);

                    expect(endCalendarHighlightCellsSpy.calledOnce).toEqual(true);
                    expect(endCalendarHighlightCellsSpy.args[0][0]).toEqual(startDate);
                    expect(endCalendarHighlightCellsSpy.args[0][1]).toEqual(endDate);
                });

                it('does not call either calendar\'s highlight cells method if an invalid date range is used', function(){
                    var startDate = moment.tz([2012,11,31], timezone),
                        endDate = moment.tz([2012,11,1], timezone);

                    picker._highlightRange(startDate, endDate);

                    expect(startCalendarHighlightCellsSpy.called).toEqual(false);
                    expect(endCalendarHighlightCellsSpy.called).toEqual(false);
                });
            });

            describe('presets', function(){
                beforeEach(function(){
                    var christmas2012Str = moment.tz([2012,11,25], timezone).format('YYYY-MM-DD'),
                        nye2012Str = moment.tz([2012,11,31], timezone).format('YYYY-MM-DD');

                    picker = daterangepicker.create({
                        $input: $testInput,
                        presets: {
                            'christmas 2012': {
                                startDate: christmas2012Str,
                                endDate: christmas2012Str
                            },
                            'new years eve 2012': {
                                startDate: nye2012Str,
                                endDate: nye2012Str,
                                specifyTime: true
                            }
                        },
                        timezone: timezone
                    });

                    picker.render();
                });

                it('renders the presets list', function(){
                    expect(picker.$el.find('.presets').length).toEqual(1);

                    expect(picker.$el.find('.presets li').eq(0).text()).toEqual('christmas 2012');
                    expect(picker.$el.find('.presets li').eq(0).data('startdate')).toEqual('2012-12-25');
                    expect(picker.$el.find('.presets li').eq(0).data('enddate')).toEqual('2012-12-25');
                    expect(picker.$el.find('.presets li').eq(0).data('time')).toEqual(false);

                    expect(picker.$el.find('.presets li').eq(1).text()).toEqual('new years eve 2012');
                    expect(picker.$el.find('.presets li').eq(1).data('startdate')).toEqual('2012-12-31');
                    expect(picker.$el.find('.presets li').eq(1).data('enddate')).toEqual('2012-12-31');
                    expect(picker.$el.find('.presets li').eq(1).data('time')).toEqual(true);
                });

                it('selects the corresponding date range when a preset is clicked', function(){
                    var christmas2012 = moment.tz([2012,11,25], timezone);

                    picker.$el.find('.presets li').eq(0).click();

                    expect(picker.getStartDate().toString()).toEqual(christmas2012.toString());
                    expect(picker.getEndDate().toString()).toEqual(christmas2012.toString());
                });

                it('triggers a presetSelected event when a preset is chosen', function(){
                    var spy = sinon.spy(),
                        christmas2012 = moment.tz([2012,11,25], timezone);

                    picker.bind('presetSelected', spy);

                    picker.$el.find('.presets li').eq(0).click();

                    expect(spy.calledOnce).toEqual(true);
                    expect(spy.args[0][0].startDate.toString()).toEqual(christmas2012.toString());
                    expect(spy.args[0][0].endDate.toString()).toEqual(christmas2012.toString());
                });
            });
        });

        describe('as a jquery plugin', function(){
            var input,
                christmas2012Str = moment.tz([2012,11,25], timezone).format('YYYY-MM-DD'),
                nye2012Str = moment.tz([2012,11,31], timezone).format('YYYY-MM-DD');

            beforeEach(function(){
                input = $('<input id="pickerInput"/>');
                $('#testArea').append(input);

                input.daterangepicker({
                    zIndex: 1234,
                    startDate: '2013-01-01',
                    endDate: '2013-02-14',
                    presets: {
                        'christmas 2012': {
                            startDate: christmas2012Str,
                            endDate: christmas2012Str
                        },
                        'new years eve 2012': {
                            startDate: nye2012Str,
                            endDate: nye2012Str
                        }
                    },
                    timezone: timezone
                });
            });

            afterEach(function(){
                var picker = input.data('picker');

                if (picker) {
                    picker.destroy();
                }

                $('#testArea').empty();
            });

            it('attaches a picker instance to the target element', function(){
                expect(input.data('picker')).toBeDefined();
            });

            it('attaches a reference to the target element on the picker', function(){
                var picker = input.data('picker');

                expect(picker.$input.data('picker')).toEqual(input.data('picker'));
            });

            it('removes the reference to the target element when destroyed', function() {
                var picker = input.data('picker');

                picker.destroy();

                expect(input.data('picker')).not.toBeDefined();
            });

            it('passes supplied options through to the picker', function(){
                input.click();

                var picker = input.data('picker');

                expect(picker.startCalendar.selectedDate.toString()).toEqual(moment.tz([2013,0,1], timezone).toString());
                expect(picker.endCalendar.selectedDate.toString()).toEqual(moment.tz([2013,1,14], timezone).toString());
            });

            it('shows the picker when the target element is clicked', function(){
                var showStub = sinon.stub(daterangepicker.prototype, 'show');

                input.click();

                expect(showStub.calledOnce).toEqual(true);

                showStub.restore();
            });

            it('shows the picker with a custom z-index', function(){
                var jqShowStub = sinon.stub($.prototype, 'show', function(){ return this; }),
                    jqCssStub = sinon.stub($.prototype, 'css', function(){ return this; });

                input.click();

                expect(jqShowStub.calledOnce).toEqual(true);

                expect(jqCssStub.calledOnce).toEqual(true);
                expect(jqCssStub.args[0][0].zIndex).toEqual(1234);

                jqShowStub.restore();
                jqCssStub.restore();
            });

            it('hides the picker when a click occurs outside the picker area', function(){
                var hideStub = sinon.stub(daterangepicker.prototype, 'hide');

                input.click();
                $('body').click();

                expect(hideStub.calledOnce).toEqual(true);

                hideStub.restore();
            });

            it('updates the target element when a start date is selected', function(){
                input.click();

                var picker = input.data('picker');

                picker.startCalendar.$el.find('[data-date="2013-01-01"]').click();

                expect(input.val()).toEqual('01 Jan 2013 - 14 Feb 2013');
            });

            it('updates the target element when an end date is selected', function(){
                input.click();

                var picker = input.data('picker');

                picker.endCalendar.$el.find('[data-date="2013-03-01"]').click();

                expect(input.val()).toEqual('01 Jan 2013 - 01 Mar 2013');
            });

            it('updates the target element when a preset date is selected', function(){
                input.click();

                var picker = input.data('picker');

                picker.$el.find('.presets li').eq(0).click();

                expect(input.val()).toEqual('25 Dec 2012 - 25 Dec 2012');
            });

            it('updates the target element when a "refresh" event is triggered', function(){
                var picker = input.data('picker');

                picker.trigger('refresh', {
                    startDate: moment.tz([2014, 10, 12], timezone),
                    endDate: moment.tz([2014, 11, 12], timezone)
                });

                expect(input.val()).toEqual('12 Nov 2014 - 12 Dec 2014');
            });
        });

        describe('plugin support', function(){
            it('can be created with plugins', function(){
                function TestPlugin(options){
                    this.options = options;
                }
                TestPlugin.pluginName = 'testPlugin';
                TestPlugin.prototype.attach = sinon.spy();

                picker = daterangepicker.create({
                    $input: $testInput,
                    plugins: [TestPlugin],
                    testPlugin: {
                        property1: true
                    }
                });

                expect(picker.testPlugin).toBeDefined();
                expect(TestPlugin.prototype.attach.calledOnce).toEqual(true);
                expect(TestPlugin.prototype.attach.args[0][0]).toEqual(picker);
                expect(picker.testPlugin.options).toEqual({property1: true});
            });

            it('can add plugins', function(){
                picker = daterangepicker.create({
                    $input: $testInput
                });

                function TestPlugin(options){
                    this.options = options;
                }
                TestPlugin.pluginName = 'testPlugin';
                TestPlugin.prototype.attach = sinon.spy();

                picker.addPlugin(TestPlugin, {config: 'value'});

                expect(picker.testPlugin).toBeDefined();
                expect(picker.testPlugin.options).toEqual({config: 'value'});
                expect(TestPlugin.prototype.attach.calledOnce).toEqual(true);
                expect(TestPlugin.prototype.attach.args[0][0]).toEqual(picker);
            });

            it('properly disposes of plugins on destroy', function(){
                var attachSpy = sinon.spy(),
                    detachSpy = sinon.spy();

                picker = daterangepicker.create({
                    $input: $testInput,
                    plugins: [
                        _.extend(function TestPlugin(){
                            return {attach: attachSpy, detach: detachSpy};
                        }, {pluginName: 'test'})
                    ]
                });

                expect(picker._plugins).toEqual(['test']);
                expect(picker.test).toEqual({attach: attachSpy, detach: detachSpy});

                picker.destroy();

                expect(attachSpy.calledOnce).toEqual(true);
                expect(detachSpy.calledOnce).toEqual(true);
                expect(picker._plugins.length).toEqual(0);
            });
        });
    });
});
