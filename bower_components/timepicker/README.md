timepicker
==========

[![Build Status](https://travis-ci.org/BrandwatchLtd/timepicker.svg?branch=master)](https://travis-ci.org/BrandwatchLtd/timepicker)

very simple time picker, using [moment.js](http://momentjs.com/)

## Running the demos

Pull down the repo then execute:

    npm start

and open `http://localhost:9009/demo`

## Running the tests

Run

    ./unitTests

Or pull down the repo then execute:

    npm start

and open `http://localhost:9009/test`

## Documentation

In your web page:

```html
<script src="jquery.js"></script>
<script src="underscore.js"></script>
<script src="moment.js"></script>

<script src="timepicker.js"></script>
<script>
jQuery(function($) {
  $('input').timepicker();
});
</script>
```

`$.timepicker()` enhances an input field by showing a list of preset times. Clicking an option updates the input field value.

### Defaults

```
$.timepicker.defaults = {
    // append the picker to the body
    pickerContainer: 'body',

    // class name to add to the picker list
    pickerClassName: 'time-picker',

    // class name to add to the currently selected time
    pickerSelectedClassName: 'time-picker--selected',

     // use 1 hour intervals when generating the list
    interval: '01:00'
};
```
You can change these defaults globally by setting the value before calling ```$.timepicker```.

```
// set the time interval to every 30 minutes
$.timepicker.defaults.interval = '00:30';

$('input').timepicker();
```

Or for each specific time picker at setup.

```
// set this picker to use 10 minute intervals
$('input').timepicker({
    interval: '00:10'
});
```

## API

The time picker uses the jQuery UI ```$.plugin('method', 'arg')``` style of API.

### Examples
Setup two time pickers with custom options.

```
$('input[name="from_time"]').timepicker({
    interval: '00:10'
});

$('input[name="to_time"]').timepicker({
    pickerClassName: 'my-picker'
});
```
The plugin methods are also chainable.

Setup, open and select 4:30am.

```
// setup a time picker with 30 minute intervals, open and select 4:30
$('input')
    .timepicker({
        interval: '00:30'
    })
    .timepicker('open')
    .timepicker('select', '04:30');
```

__Other methods__

```
// closes the time picker
$('input').timepicker('close');

// returns the input element to it's initial state
$('input').timepicker('destroy');
```

__Selector__

You can use the `:timepicker` custom selector to find all active time pickers.

```
// close all timepickers
$(':timepicker').timepicker('close')
```


__Events__

You can supply a callback to hook into timepicker events.

**onOpen** is triggered when the timepicker is opened.

```
    picker.bind('onOpen', function(){
        console.log('timepicker opened')
    });
    picker.open(); // logs "timepicker opened"
```

**onSelect** is triggered when a preset time is selected, the callback receives the selected time.

```
    picker.bind('onSelect', function(time){
        console.log('time selected', time);
    });

    picker.select('03:00'); // logs "time selected 03:00"
```

## Release History
_(Nothing yet)_
