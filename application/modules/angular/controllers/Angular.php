<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Angular extends MY_Controller {

	public function __construct()
    {
        parent::__construct();

        $this->load->library(array('template'));
    }


    public function index()
    {
        $this->sample();
    }

    public function sample()
    {
        $this->data['title'] = 'Angular - Sample';

        $this->_render_page('angular/sample', $this->data);
    }


    private function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;

        if ( ! $render)
        {
            $this->template->set_base_view('base_angular_view');
            $this->template->set_nav_active('other');

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


/* End of file Angular.php */
/* Location: ./application/modules/Angular/controllers/Angular.php */