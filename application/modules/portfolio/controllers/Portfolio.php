<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portfolio extends Public_Controller {

	public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $this->item();
    }

    public function item()
    {
        $this->data['title'] = 'Portfolio - Single Item';

        $this->_render_page('single_item', $this->data);
    }

    public function col_1()
    {
        $this->data['title'] = 'Portfolio - 1 Column';

        $this->_render_page('col_1', $this->data);
    }

    public function col_2()
    {
        $this->data['title'] = 'Portfolio - 2 Column';

        $this->_render_page('col_2', $this->data);
    }

    public function col_3()
    {
        $this->data['title'] = 'Portfolio - 3 Column';

        $this->_render_page('col_3', $this->data);
    }

    public function col_4()
    {
        $this->data['title'] = 'Portfolio - 4 Column';

        $this->_render_page('col_4', $this->data);
    }

}
