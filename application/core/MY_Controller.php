<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load the MX_Controller class
require APPPATH . 'third_party/MX/Controller.php';

class MY_Controller extends MX_Controller {

    public function __construct()
	{
		parent::__construct();

        /* COMMON :: ADMIN & PUBLIC */
        /* Load */
        $this->load->database();
        $this->load->config('dp_config');
        $this->load->config('dp_language');
        $this->load->config('assets');
        $this->load->library(array('form_validation', 'ion_auth', 'template', 'common/mobile_detect'));
        $this->load->helper(array('array', 'language', 'url'));
        $this->load->model('common/prefs_model');

        /* Data */
        $this->data['lang']           = element($this->config->item('language'), $this->config->item('language_abbr'));
        $this->data['charset']        = $this->config->item('charset');
        $this->data['frameworks_dir'] = $this->config->item('frameworks_dir');
        $this->data['plugins_dir']    = $this->config->item('plugins_dir');
        $this->data['avatar_dir']     = $this->config->item('avatar_dir');

        $this->data['mobile']    = FALSE;
        $this->data['ios']       = FALSE;
        $this->data['android']   = FALSE;
        $this->data['mobile_ie'] = FALSE;

        /* Any mobile device (phones or tablets) */
        if ($this->mobile_detect->isMobile())
        {
            $this->data['mobile'] = TRUE;

            if ($this->mobile_detect->isiOS())
            {
                $this->data['ios'] = TRUE;
            }

            if ($this->mobile_detect->isAndroidOS())
            {
                $this->data['android'] = TRUE;
            }

            if ($this->mobile_detect->getBrowsers('IE'))
            {
                $this->data['mobile_ie'] = TRUE;
            }
        }
	}


    public function index()
    {
        $this->_render_page();
    }


    public function _render_page($view = '', $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;

        $view = $view !== '' ? $view : $this->router->fetch_class();

        if (isset($data['template'])) {

            $this->template->set_layout($this->data['template']);

            $this->template->set_base_view($this->data['template']);

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
