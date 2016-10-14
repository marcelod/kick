<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tables extends Admin_Lte_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Tables', 'admin_lte/tables');
    }

    public function index()
    {
        redirect('admin_lte/tables/simple','refresh');
    }

	public function simple()
    {
        $this->show();
    }

    public function data_tables()
    {
        $this->template->add_css('bower_components/datatables/media/css/dataTables.bootstrap.min.css');

        $this->template->add_js('bower_components/datatables/media/js/jquery.dataTables.min.js');
        $this->template->add_js('bower_components/datatables/media/js/dataTables.bootstrap.min.js');
        $this->template->add_js('admin_lte/data_tables/example.js');

        $this->show();
    }

}
