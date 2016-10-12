<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dash extends Admin_Lte_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Dashboard', 'admin_lte/dash');
    }

    public function index()
    {
        redirect('admin_lte/dash/v1','refresh');
    }


	public function v1()
    {
        // Morris chart
        $this->template->add_css('bower_components/morris.js/morris.css');
        // jvectormap
        $this->template->add_css('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.css');
        // Date Picker
        $this->template->add_css('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css');
        // Daterange picker
        $this->template->add_css('bower_components/bootstrap-daterangepicker/daterangepicker.css');
        // bootstrap wysihtml5 - text editor
        $this->template->add_css('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');

        // jQuery UI 1.11.4
        // $this->template->add_js('bower_components/https://code.jquery.com/ui/1.11.4/jquery-ui.min.js');
        // Resolve conflict in jQuery UI tooltip with Bootstrap tooltip
        // <script>
        //   $.widget.bridge('uibutton', $.ui.button);
        // </script>
        // Morris.js charts
        $this->template->add_js('bower_components/raphael/raphael.min.js');
        $this->template->add_js('bower_components/morris.js/morris.min.js');
        // Sparkline
        // $this->template->add_js('bower_components/sparkline/jquery.sparkline.min.js');
        // jvectormap
        $this->template->add_js('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js');
        $this->template->add_js('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js');
        // jQuery Knob Chart
        // $this->template->add_js('bower_components/plugins/knob/jquery.knob.js');
        // daterangepicker
        // $this->template->add_js('bower_components/https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js');
        $this->template->add_js('bower_components/bootstrap-daterangepicker/daterangepicker.js');
        // datepicker
        $this->template->add_js('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        // Bootstrap WYSIHTML5
        $this->template->add_js('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');
        // Slimscroll
        $this->template->add_js('bower_components/jquery.slimscroll/jquery.slimscroll.min.js');

        $this->template->add_js('admin_lte/dash/v1.js');

        $this->show();
    }


    public function v2()
    {
        $this->template->add_css('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css');

        $this->template->add_js('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js');
        $this->template->add_js('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js');
        $this->template->add_js('bower_components/Chart.js/Chart.js');
        $this->template->add_js('admin_lte/dash/v2.js');

        $this->show();
    }


}
