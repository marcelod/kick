<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class License extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push(lang('menu_license'));
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = lang('menu_license');

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, lang('menu_license'), 'admin/license');
    }


	public function index()
	{
	    /* Breadcrumbs */
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin/license/index', $this->data);
	}
}
