<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {


    public function index()
    {
        $this->load->library('template');
        $this->template->set_nav_active('contact');

        $this->template->load_view('contact/index');
    }

    public function enviar()
    {
        $data = array();

        if($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data['nome']     	  = $this->input->post('nome', TRUE);
            $data['email']    	  = $this->input->post('email', TRUE);
            $data['telefone'] 	  = $this->input->post('telefone', TRUE);
            $data['mensagem'] 	  = $this->input->post('mensagem', TRUE);

            $data['ip_address'] = $this->input->ip_address();
            $data['user_agent'] = $this->input->user_agent();
            $data['created_at']  = date('Y-m-d H:i:s');

            $this->load->library('email');

            $this->email->from($data['email'], $data['nome']);
            $this->email->to('mar-advogados@mar-advogados.com.br');
            $this->email->subject('[Mar-advogados] Contato encaminhado pelo site');

            $message = $this->load->view('email/sendMailContactSite', $data, TRUE);
            $this->email->message($message);

            $this->email->send();

            $this->load->model('contato_m');
            $this->contato_m->save($data);

        	$this->index(cAlerts('Obrigado pelo contato!', 'alert-success'));
            return FALSE;
        }

    }

}


/* End of file Contact.php */
/* Location: ./application/modules/contact/controllers/Contact.php */