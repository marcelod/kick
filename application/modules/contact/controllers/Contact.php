<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth','form_validation'));
        $this->load->helper(array('language'));

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
    }

    public function index()
    {
        $this->load->library('template');
        $this->template->set_nav_active('contact');

        $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        $this->template->load_view('contact/index', $data);

    }

    public function send()
    {
        $data = array();
        if($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data['name']     	= $this->input->post('name', TRUE);
            $data['email']    	= $this->input->post('email', TRUE);
            $data['telephone'] 	= $this->input->post('telephone', TRUE);
            $data['message'] 	= $this->input->post('message', TRUE);

            $data['user_id']    = $this->session->userdata('user_id');

            $data['ip_address'] = $this->input->ip_address();
            $data['user_agent'] = $this->input->user_agent();
            $data['created_at'] = date('Y-m-d H:i:s');

            $this->load->library('email');

            $this->email->from($data['email'], $data['name']);
            $this->email->to('contato@kick.ci');
            $this->email->subject('[Kick] Contato encaminhado pelo site');

            // $message = $this->load->view('email/sendMailContactSite', $data, TRUE);
            $message = $data['name'] .' --- '. $data['email'] .' --- '. $data['telephone'] .' --- '. $data['message'];
            $this->email->message($message);

            $this->email->send();

            $this->load->model('contact/contact_m');
            $this->contact_m->save($data);

            $this->session->set_flashdata('message', 'Obrigado pelo contato!');

            redirect('contact', 'refresh');
        }
    }

}


/* End of file Contact.php */
/* Location: ./application/modules/contact/controllers/Contact.php */