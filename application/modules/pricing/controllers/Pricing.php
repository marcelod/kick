<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pricing extends MY_Controller {


    public function index()
    {
        $this->load->library('template');
        $this->template->set_nav_active('other');

        $this->template->load_view('pricing/index');
    }

}


/* End of file Pricing.php */
/* Location: ./application/modules/pricing/controllers/Pricing.php */