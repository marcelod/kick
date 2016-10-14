<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ui extends Admin_Lte_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'UI', 'admin_lte/ui');
    }

    public function index()
    {
        redirect('admin_lte/ui/general','refresh');
    }

    public function general()
    {
        $this->show();
    }

    public function icons()
    {
        $this->show();
    }

    public function buttons()
    {
        $this->show();
    }

    public function timeline()
    {
        $this->show();
    }

    public function modals()
    {
        $this->show();
    }

}
