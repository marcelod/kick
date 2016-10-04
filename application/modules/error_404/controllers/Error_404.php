<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error_404 extends Public_Controller {

    public function index()
    {
        $this->_render_page('error_404');
    }

}