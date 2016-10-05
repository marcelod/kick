/*global module*/
module.exports = function(grunt) {
    'use strict';

    grunt.initConfig({
        min:{
            'timepicker.min.js': ['lib/timepicker/timepicker.js']
        }
    });

    grunt.registerTask('default', 'min');
};