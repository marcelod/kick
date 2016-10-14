<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Examples extends Admin_Lte_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Examples', 'admin_lte/examples');
    }

    public function index()
    {
        redirect('admin_lte/examples/invoice','refresh');
    }


    public function invoice()
    {
        $this->show();
    }


    public function profile()
    {
        $this->show();
    }


    public function blank()
    {
        $this->show();
    }


    public function pace()
    {
        $this->template->add_css('bower_components/PACE/themes/green/pace-theme-barber-shop.css');
        $this->template->add_js('bower_components/PACE/pace.min.js');
        $this->template->add_js('admin_lte/examples/pace.js');

       $this->show();
    }


}
