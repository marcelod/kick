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
        $this->show();
    }


}
