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


    public function profile()
    {
        /* Title Page :: Profile */
        $this->page_title->push('Examples - Profile');
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = 'Examples - Profile';

        /* Breadcrumbs :: PROFILE */
        $this->breadcrumbs->unshift(2, 'Profile', 'admin_lte/examples/profile');

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin_lte/examples/profile', $this->data);
    }


    public function blank()
    {
        /* Title Page Blank Common */
        $this->page_title->push('Examples Blank Invoice');
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = 'Examples Blank Invoice';

        /* Breadcrumbs :: BLANK */
        $this->breadcrumbs->unshift(2, 'Blank', 'admin_lte/examples/blank');

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin_lte/examples/blank', $this->data);
    }


    public function pace()
    {
        /* Title Page Pace Common */
        $this->page_title->push('Examples Pace Invoice');
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = 'Examples Pace Invoice';

        /* Breadcrumbs :: PACE */
        $this->breadcrumbs->unshift(2, 'Pace', 'admin_lte/examples/pace');

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin_lte/examples/pace', $this->data);
    }

}
