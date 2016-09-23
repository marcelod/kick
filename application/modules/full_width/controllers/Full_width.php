<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Full_width extends MY_Controller {


    public function index()
    {
        $this->load->library('template');
        $this->template->set_nav_active('other');
        $this->template->add_css('full-width-pics.css');

        $this->template->load_view('full_width/index');
    }

}


/* End of file Full_width.php */
/* Location: ./application/modules/full_width/controllers/Full_width.php */