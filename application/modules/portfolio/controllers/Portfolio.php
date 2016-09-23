<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portfolio extends MY_Controller {

	public function __construct()
    {
        parent::__construct();

        $this->load->library(array('template'));
    }


    public function index()
    {
        $this->item();
    }

    public function item()
    {
        $this->data['title'] = 'Portfolio - Single Item';

        $this->_render_page('portfolio/single_item', $this->data);
    }

    public function col_1()
    {
        $this->data['title'] = 'Portfolio - 1 Column';

        $this->_render_page('portfolio/col_1', $this->data);
    }

    public function col_2()
    {
        $this->data['title'] = 'Portfolio - 2 Column';

        $this->_render_page('portfolio/col_2', $this->data);
    }

    public function col_3()
    {
        $this->data['title'] = 'Portfolio - 3 Column';

        $this->_render_page('portfolio/col_3', $this->data);
    }

    public function col_4()
    {
        $this->data['title'] = 'Portfolio - 4 Column';

        $this->_render_page('portfolio/col_4', $this->data);
    }


    private function _render_page($view, $data=null, $render=false)
    {
        $data = (empty($data)) ? $this->data : $data;

        if ( ! $render)
        {
            $this->template->set_nav_active('portfolio');

            if ( ! empty($data['title']))
            {
                $this->template->set_title($data['title']);
            }

            $this->template->load_view($view, $data);
        }
        else
        {
            return $this->load->view($view, $data, TRUE);
        }
    }


}


/* End of file Portfolio.php */
/* Location: ./application/modules/portfolio/controllers/Portfolio.php */