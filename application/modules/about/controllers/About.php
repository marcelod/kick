<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends MY_Controller {


    public function index()
    {
        $this->load->library('template');
        $this->template->set_nav_active('about');

        $this->template->load_view('about/index');
    }

}


/* End of file About.php */
/* Location: ./application/modules/about/controllers/About.php */