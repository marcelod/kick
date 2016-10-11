<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();

        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Load */
            $this->load->config('dp_admin_config');
            $this->load->library('admin/page_title');
            $this->load->library('admin/breadcrumbs');
            $this->load->model('admin/core_model');
            $this->load->helper('menu');
            $this->lang->load(array('admin/main_header', 'admin/main_sidebar', 'admin/footer', 'admin/actions'));

            /* Load library function  */
            $this->breadcrumbs->unshift(0, $this->lang->line('menu_dashboard'), 'admin/dashboard');

            /* Data */
            $this->data['title']       = $this->config->item('title');
            $this->data['title_lg']    = $this->config->item('title_lg');
            $this->data['title_mini']  = $this->config->item('title_mini');
            $this->data['admin_prefs'] = $this->prefs_model->admin_prefs();
            $this->data['user_login']  = $this->prefs_model->user_info_login($this->ion_auth->user()->row()->id);

            /* Set Template */
            $this->data['template']    = 'admin';

            $this->data['dashboard_alert_file_install'] = NULL;
            $this->data['header_alert_file_install']    = NULL; /* << A MODIFIER !!! */

            if ($this->router->fetch_class() == 'dashboard')
            {
                $this->data['dashboard_alert_file_install'] = $this->core_model->get_file_install();
                $this->data['header_alert_file_install']    = NULL;
            }
        }
    }


    protected function show()
    {
        $name_class  = $this->router->fetch_class();
        $name_method = $this->router->fetch_method();
        $name_compose = $name_method == 'index' ? ucfirst($name_class) : ucfirst($name_method);

        $title = 'Examples - ' . $name_compose;
        $name_template = $this->data['template'];

        /* Title Page */
        $this->page_title->push($title);
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = $title;

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, $name_compose, $name_template . '/' . $name_class . '/' . $name_method);

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page($name_template . '/' . $name_class . '/' . $name_method, $this->data);
    }

}
