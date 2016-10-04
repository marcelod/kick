<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Calendar', 'admin_lte/calendar');
    }

    public function index()
    {
        /* Title Page :: Common */
        $this->page_title->push('Calendar');
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = 'Calendar';

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin_lte/calendar/index', $this->data);
    }

}
