<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth','form_validation', 'template'));
    	$this->load->helper(array('url','language'));

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
    }


    public function index()
    {
        $this->template->set_nav_active('home');

        $this->template->load_view('home/home');
    }


    public function logged()
    {
		if ( ! $this->ion_auth->logged_in() ) {
        	redirect('auth/login', 'refresh');
        }
        else {
        	// set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['count_users'] = $this->_count_users();
            $this->data['count_groups'] = $this->_count_groups();

            $this->_render_page('home/dash', $this->data);
        }
    }

    private function _count_users()
    {
        return $this->ion_auth->users()->num_rows();
    }

    private function _count_groups()
    {
        return $this->ion_auth->groups()->num_rows();
    }


    private function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;

        if ( ! $render)
        {
            $this->template->set_layout('pagelet');

            if ( in_array($view, array('home/dash')) )
            {
                $this->template->set_base_view('sb_admin_2_view');
                $this->template->set_header('header_sb_admin_2');
                $this->template->set_layout('sb_admin_2');
            }

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


/* End of file Home.php */
/* Location: ./application/modules/home/controllers/Home.php */