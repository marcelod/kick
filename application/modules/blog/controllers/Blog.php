<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends Public_Controller {

    public function index()
    {
        $this->home_1();
    }

    public function home_1()
    {
        $this->data['title'] = 'Blog - Home';

        $this->_render_page('home_1', $this->data);
    }

    public function home_2()
    {
        $this->data['title'] = 'Blog - Home';

        $this->_render_page('home_2', $this->data);
    }

    public function post()
    {
        $this->data['title'] = 'Blog - Post';

        $this->_render_page('post', $this->data);
    }

}
