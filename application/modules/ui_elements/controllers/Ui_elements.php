<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ui_elements extends MY_Controller {

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
        $this->panels_wells();
    }

    public function panels_wells()
    {
        $this->data['title'] = 'UI Elements - Panels and Wells';
        $this->data['template'] = 'sb_admin_2';

        $this->_render_page('ui_elements/panels_wells', $this->data);
    }

    public function buttons()
    {
        $this->data['title'] = 'UI Elements - Buttons';
        $this->data['template'] = 'sb_admin_2';

        $this->template->add_css('bootstrap-social.min.css');

        $this->_render_page('ui_elements/buttons', $this->data);
    }

    public function notifications()
    {
        $this->data['title'] = 'UI Elements - Notifications';
        $this->data['template'] = 'sb_admin_2';

        $this->_render_page('ui_elements/notifications', $this->data);
    }

    public function typography()
    {
        $this->data['title'] = 'UI Elements - Typography';
        $this->data['template'] = 'sb_admin_2';

        $this->_render_page('ui_elements/typography', $this->data);
    }

    public function icons()
    {
        $this->data['title'] = 'UI Elements - Icons';
        $this->data['template'] = 'sb_admin_2';

        $this->_render_page('ui_elements/icons', $this->data);
    }

    public function grid()
    {
        $this->data['title'] = 'UI Elements - Grid';
        $this->data['template'] = 'sb_admin_2';

        $this->_render_page('ui_elements/grid', $this->data);
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