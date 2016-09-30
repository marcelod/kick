<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Public_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
        {
            $this->data['admin_link'] = TRUE;
        }
        else
        {
            $this->data['admin_link'] = FALSE;
        }

        if ($this->ion_auth->logged_in())
        {
            $this->data['logout_link'] = TRUE;
        }
        else
        {
            $this->data['logout_link'] = FALSE;
        }
	}
}
