<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error_404 extends MY_Controller {


    public function index()
    {
        $this->load->library('template');
        $this->template->set_nav_active('other');

        $this->template->load_view('error_404/index');
    }

}


/* End of file Error_404.php */
/* Location: ./application/modules/error_404/controllers/Error_404.php */