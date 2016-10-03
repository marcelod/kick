<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

        /* COMMON :: ADMIN & PUBLIC */
        /* Load */
        $this->load->database();
        $this->load->config('common/dp_config');
        $this->load->config('common/dp_language');
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
}
