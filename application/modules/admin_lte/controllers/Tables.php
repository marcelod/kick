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
        $this->simple();
    }


	public function simple()
    {
        /* Title Page :: Simple */
        $this->page_title->push('Tables - Simple');
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = 'Tables - Simple';

        /* Breadcrumbs :: SIMPLE */
        $this->breadcrumbs->unshift(2, 'Simple', 'admin_lte/tables/simple');

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin_lte/tables/simple', $this->data);
    }


    public function data()
    {
        /* Title Page :: Common */
        $this->page_title->push('Tables - Data');
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = 'Tables - Data';

        /* Breadcrumbs :: DATA */
        $this->breadcrumbs->unshift(2, 'Data', 'admin_lte/tables/data');

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin_lte/tables/data', $this->data);
    }


}
