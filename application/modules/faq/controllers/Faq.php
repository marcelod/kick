<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends MY_Controller {


    public function index()
    {
        $this->load->library('template');
        $this->template->set_nav_active('other');

        $this->template->load_view('faq/index');
    }

}


/* End of file Faq.php */
/* Location: ./application/modules/faq/controllers/Faq.php */