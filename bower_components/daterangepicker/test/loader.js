mocha.setup({
    ui: 'bdd',
    globals: ['jQuery']
});
require(['jquery', 'daterangepicker.tests.js', 'daterangepicker.timesupport.tests.js'], function(){
    'use strict';
    mocha.run();
});