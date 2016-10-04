<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends Public_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->library('googlemaps');

        // $this->load->model('contact/contact_m');
    }

    public function index()
    {
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        $confGMaps['center']   = '-23.527584,-46.678473';
        $confGMaps['zoom']     = '16';
        $confGMaps['minifyJS'] = true;
        $this->googlemaps->initialize($confGMaps);

        $marker = array();
        $marker['position'] = '-23.527584,-46.678473';
        $this->googlemaps->add_marker($marker);

        $this->data['map'] = $this->googlemaps->create_map();

        $this->_render_page('contact', $this->data);
    }

    public function send()
    {
        $data = array();
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data['name']     	= $this->input->post('name', TRUE);
            $data['email']    	= $this->input->post('email', TRUE);
            $data['telephone'] 	= $this->input->post('telephone', TRUE);
            $data['message'] 	= $this->input->post('message', TRUE);

            // $data['user_id']    = $this->session->userdata('user_id');

            $data['ip_address'] = $this->input->ip_address();
            $data['user_agent'] = $this->input->user_agent();
            $data['created_at'] = date('Y-m-d H:i:s');

            $this->load->library('email');

            $this->email->from($data['email'], $data['name']);
            $this->email->to('send@mail.local');
            $this->email->subject('[Kick] Contato encaminhado pelo site');

            // $message = $this->load->view('email/sendMailContactSite', $data, TRUE);
            $message = $data['name'] .' --- '. $data['email'] .' --- '. $data['telephone'] .' --- '. $data['message'];
            $this->email->message($message);

            // $this->email->send();

            // $this->contact_m->save($data);

            $this->session->set_flashdata('message', 'Obrigado pelo contato!');

            redirect('contact', 'refresh');
        }
    }


}
