<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Charts extends Admin_Lte_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Charts', 'admin_lte/charts');
    }

    public function index()
    {
        redirect('admin_lte/charts/chartjs','refresh');
    }


	public function chartjs()
    {
        $this->template->add_js('bower_components/Chart.js/Chart.js');
        $this->template->add_js('admin_lte/charts/chartjs.js');

        $this->show();
    }


    public function morris()
    {
        $this->template->add_css('bower_components/morris.js/morris.css');

        $this->template->add_js('bower_components/raphael/raphael.min.js');
        $this->template->add_js('bower_components/morris.js/morris.js');
        $this->template->add_js('admin_lte/charts/morris.js');

        $this->show();
    }


    public function flot()
    {
        $this->template->add_js('bower_components/Flot/jquery.flot.js');
        //  FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized
        $this->template->add_js('bower_components/Flot/jquery.flot.resize.js');
         // FLOT PIE PLUGIN - also used to draw donut charts
        $this->template->add_js('bower_components/Flot/jquery.flot.pie.js');
         // FLOT CATEGORIES PLUGIN - Used to draw bar charts
        $this->template->add_js('bower_components/Flot/jquery.flot.categories.js');

        $this->template->add_js('admin_lte/charts/flot.js');

        $this->show();
    }


    public function inline()
    {
        // jQuery Knob
        $this->template->add_js('bower_components/jquery-knob/dist/jquery.knob.min.js');
        // Sparkline
        $this->template->add_js('assets/plugins/sparkline/jquery.sparkline.min.js');

        $this->template->add_js('admin_lte/charts/inline.js');

        $this->show();
    }


}
