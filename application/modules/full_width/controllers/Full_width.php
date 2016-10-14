<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Full_width extends Public_Controller {


    public function index()
    {
    	$this->template->add_css('full-width-pics.css');

        $this->_render_page('full_width');
    }

}
