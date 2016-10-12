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
