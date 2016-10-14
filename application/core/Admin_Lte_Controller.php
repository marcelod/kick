<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Lte_Controller extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();

        $this->data['template'] = 'admin_lte';
    }


    protected function show()
    {
        $this->load->helper('inflector');

        $name_class  = $this->router->fetch_class();
        $name_method = $this->router->fetch_method();
        $name_compose = $name_method == 'index' ? humanize($name_class) : humanize($name_method);

        $title = humanize($name_class) . ' - ' . $name_compose;
        $name_template = $this->data['template'];

        /* Title Page */
        $this->page_title->push($title);
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = $title;

        /* Breadcrumbs */
        if ($name_method != 'index') {
            $this->breadcrumbs->unshift(2, $name_compose, $name_template . '/' . $name_class . '/' . $name_method);
        }

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page($name_template . '/' . $name_class . '/' . $name_method, $this->data);
    }

}
