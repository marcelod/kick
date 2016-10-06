<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Lte_Controller extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();

        $this->data['template'] = 'admin_lte';
    }

}
