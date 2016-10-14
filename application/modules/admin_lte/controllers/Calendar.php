<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends Admin_Lte_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Calendar', 'admin_lte/calendar');
    }

    public function index()
    {

        $this->template->add_css('bower_components/fullcalendar/dist/fullcalendar.min.css');
        // $this->template->add_css('bower_components/fullcalendar/dist/fullcalendar.print.css');
        // fix = ver como adicionar um css com media=print

        $this->template->add_js('bower_components/jquery-ui/jquery-ui.min.js');
        $this->template->add_js('bower_components/moment/min/moment.min.js');
        $this->template->add_js('bower_components/fullcalendar/dist/fullcalendar.min.js');
        $this->template->add_js('admin_lte/fullcalendar/example.js');

        $this->show();
    }

}
