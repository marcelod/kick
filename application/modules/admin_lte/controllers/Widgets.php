<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Widgets extends Admin_Lte_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Widgets', 'admin_lte/widgets');
    }

    public function index()
    {
        $this->show();
    }

}
