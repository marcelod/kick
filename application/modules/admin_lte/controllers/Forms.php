<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forms extends Admin_Lte_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Forms', 'admin_lte/forms');
    }

    public function index()
    {
        redirect('admin_lte/forms/general','refresh');
    }


    public function general()
    {
        $this->show();
    }


    public function advanced()
    {
        // daterange picker
        $this->template->add_css('bower_components/bootstrap-daterangepicker/daterangepicker.css');
        // bootstrap datepicker
        $this->template->add_css('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css');
        // iCheck for checkboxes and radio inputs
        $this->template->add_css('bower_components/iCheck/skins/all.css');
        // Bootstrap Color Picker
        $this->template->add_css('assets/plugins/colorpicker/bootstrap-colorpicker.min.css');
        // Bootstrap time Picker
        $this->template->add_css('bower_components/bootstrap-timepicker/css/bootstrap-timepicker.min.css');
        // Select2
        $this->template->add_css('bower_components/select2/dist/css/select2.min.css');

        // Select2
        $this->template->add_js('bower_components/select2/dist/js/select2.full.min.js');
        // InputMask
        $this->template->add_js('bower_components/jquery.inputmask/dist/min/inputmask/jquery.inputmask.min.js');
        $this->template->add_js('bower_components/jquery.inputmask/dist/min/inputmask/inputmask.date.extensions.min.js');
        $this->template->add_js('bower_components/jquery.inputmask/dist/min/inputmask/inputmask.extensions.min.js');
        // date-range-picker
        $this->template->add_js('bower_components/moment/min/moment.min.js');
        $this->template->add_js('bower_components/bootstrap-daterangepicker/daterangepicker.js');
        // bootstrap datepicker
        $this->template->add_js('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        // bootstrap color picker
        $this->template->add_js('assets/plugins/colorpicker/bootstrap-colorpicker.min.js');
        // bootstrap time picker
        $this->template->add_js('bower_components/bootstrap-timepicker/js/bootstrap-timepicker.js');
        // SlimScroll 1.3.0
        $this->template->add_js('bower_components/jquery-slimscroll/jquery.slimscroll.min.js');
        // iCheck
        $this->template->add_js('bower_components/iCheck/icheck.min.js');

        $this->template->add_js('admin_lte/forms/advanced.js');

        $this->show();
    }


    public function editors()
    {
        $this->show();
    }


}
