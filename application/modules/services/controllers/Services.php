<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation', 'template'));
    	$this->load->helper(array('url','language'));

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load(array('auth', 'services'));
    }

    public function index()
    {
        $this->load->library('template');
        $this->template->set_nav_active('services');

        $this->template->load_view('services/index');
    }


    public function admin()
    {
    	if ( ! $this->ion_auth->logged_in() )
        {
        	redirect('auth/login', 'refresh');
        }
        else
        {
        	// set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['title'] = lang('adm_service_heading');

            //list the groups
            $this->data['groups'] = $this->ion_auth->groups()->result();

            $this->_render_page('services/admin', $this->data);
        }
    }



    private function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;

        if ( ! $render)
        {
            // $this->template->set_layout('pagelet');

            // if ( ! in_array($view, array('')))
            // {
                $this->template->set_base_view('admin_view');
                $this->template->set_header('header_admin');
                $this->template->set_layout('admin');
            // }

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


/* End of file Services.php */
/* Location: ./application/modules/services/controllers/Services.php */