<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Widgets extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Widgets', 'admin_lte/widgets');
    }

    public function index()
    {
        /* Title Page :: Common */
        $this->page_title->push('Widgets');
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = 'Widgets';

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin_lte/widgets/index', $this->data);
    }

}
