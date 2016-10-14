/*global module*/
module.exports = function(grunt) {
    'use strict';

    grunt.initConfig({
        min:{
            'daterangepicker.min.js': ['lib/daterangepicker/daterangepicker.js']
        }
    });

    grunt.registerTask('default', 'min');
};