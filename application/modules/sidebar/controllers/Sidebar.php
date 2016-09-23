<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sidebar extends MY_Controller {


    public function index()
    {
        $this->load->library('template');
        $this->template->set_nav_active('other');

        $this->template->load_view('sidebar/index');
    }

}


/* End of file Sidebar.php */
/* Location: ./application/modules/sidebar/controllers/Sidebar.php */