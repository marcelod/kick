define(['jquery'], function($){
    'use strict';

    // noop plugin
    $.fn.timepicker = $.each(function(){
        return this;
    });
});