<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Public_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

        /* Set Template */
        $this->data['template']    = 'default';

        $this->data['admin_link']  = FALSE;
        $this->data['logout_link'] = FALSE;

        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
        {
            $this->data['admin_link'] = TRUE;
        }

        if ($this->ion_auth->logged_in())
        {
            $this->data['logout_link'] = TRUE;
        }
	}


    protected function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;

        if (isset($data['template'])) {

            $this->template->set_layout($this->data['template']);

            $this->template->set_base_view('default_view');
            $this->template->set_header('default_header');
            $this->template->set_footer('default_footer');

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
