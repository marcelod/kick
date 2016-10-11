<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailbox extends Admin_Lte_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Mailbox', 'admin_lte/mailbox');
    }

    public function index()
    {
        $this->show();
    }

    public function compose()
    {
        $this->template->add_css('bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');

        $this->template->add_js('bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');
        $this->template->add_js('admin_lte/mailbox/compose.js');

        $this->show();
    }

    public function read_mail()
    {
        $this->show();
    }

}
