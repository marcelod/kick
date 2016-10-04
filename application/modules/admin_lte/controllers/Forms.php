<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forms extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Forms', 'admin_lte/forms');
    }

    public function index()
    {
        $this->general();
    }


    public function general()
    {
        /* Title Page :: General */
        $this->page_title->push('Forms - General');
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = 'Forms - General';

        /* Breadcrumbs :: GENERAL */
        $this->breadcrumbs->unshift(2, 'general', 'admin_lte/forms/general');

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin_lte/forms/general', $this->data);
    }


    public function advanced()
    {
        /* Title Page :: Advanced */
        $this->page_title->push('Forms - Advanced');
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = 'Forms - Advanced';

        /* Breadcrumbs :: ADVANCED */
        $this->breadcrumbs->unshift(2, 'advanced', 'admin_lte/forms/advanced');

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin_lte/forms/advanced', $this->data);
    }


    public function editors()
    {
        /* Title Page :: Editors */
        $this->page_title->push('Forms - Editors');
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = 'Forms - Editors';

        /* Breadcrumbs :: EDITORS */
        $this->breadcrumbs->unshift(2, 'editors', 'admin_lte/forms/editors');

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin_lte/forms/editors', $this->data);
    }


}
