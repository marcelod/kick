<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailbox extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Mailbox', 'admin_lte/mailbox');
    }

    public function index()
    {
        /* Title Page :: Common */
        $this->page_title->push('Mailbox');
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = 'Mailbox';

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin_lte/mailbox/index', $this->data);
    }

}
