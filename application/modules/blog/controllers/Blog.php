<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends MY_Controller {

	public function __construct()
    {
        parent::__construct();

        $this->load->library(array('template'));
    }


    public function index()
    {
        $this->home_1();
    }

    public function home_1()
    {
        $this->data['title'] = 'Blog - Home';

        $this->_render_page('blog/home_1', $this->data);
    }

    public function home_2()
    {
        $this->data['title'] = 'Blog - Home';

        $this->_render_page('blog/home_2', $this->data);
    }

    public function post()
    {
        $this->data['title'] = 'Blog - Post';

        $this->_render_page('blog/post', $this->data);
    }

    private function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;

        if ( ! $render)
        {
            $this->template->set_nav_active('blog');

            if ( ! empty($data['title']))
            {
                $this->template->set_title($data['title']);
            }

            $this->template->load_view($view, $data);
        }
        else
        {
            return $this->load->view($view, $data, TRUE);
        }
    }


}


/* End of file Blog.php */
/* Location: ./application/modules/blog/controllers/Blog.php */