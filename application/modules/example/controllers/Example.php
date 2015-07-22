<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Example extends MY_Controller {

	public function __construct()
    {
        parent::__construct();

        $this->load->library(array('ion_auth','template'));

        if ( ! $this->ion_auth->logged_in() )
        {
            redirect('auth/login', 'refresh');
        }
    }


    public function index()
    {
        $this->blank_page();
    }

    public function blank_page()
    {
        $this->data['title'] = 'Sample Pages - Blank Page';
        $this->data['template'] = 'sb_admin_2';

        $this->_render_page('example/blank_page', $this->data);
    }

    private function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;

        if (isset($data['template'])) {

            $this->load->library('template');

            $this->template->set_layout($data['template']);

            if ( $data['template'] == 'sb_admin_2') {
                $this->template->set_base_view('sb_admin_2_view');
                $this->template->set_header('header_sb_admin_2');
            }

            if ( ! empty($data['title'])) {
                $this->template->set_title($data['title']);
            }

            $this->template->load_view($view, $data);
        }
        else {
            $this->viewdata = (empty($data)) ? $this->data: $data;

            $view_html = $this->load->view($view, $this->viewdata, $render);

            if (!$render) return $view_html;
        }
    }


}


/* End of file Ui_elements.php */
/* Location: ./application/modules/Ui_elements/controllers/Ui_elements.php */