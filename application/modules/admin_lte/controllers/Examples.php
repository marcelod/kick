<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Examples extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Examples', 'admin_lte/examples');
    }

    public function index()
    {
        $this->invoice();
    }


	public function invoice()
	{
        /* Title Page :: Common */
        $this->page_title->push('Examples - Invoice');
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = 'Examples - Invoice';

        /* Breadcrumbs :: INVOICE */
        $this->breadcrumbs->unshift(2, 'Invoice', 'admin_lte/examples/invoice');

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin_lte/examples/invoice', $this->data);
	}
}
