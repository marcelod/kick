<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Charts extends Admin_Lte_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Charts', 'admin_lte/charts');
    }

    public function index()
    {
        $this->chartjs();
    }


	public function chartjs()
    {
        /* Title Page :: Common */
        $this->page_title->push('Charts - ChartJS');
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = 'Charts - ChartJS';

        /* Breadcrumbs :: CHARTJS */
        $this->breadcrumbs->unshift(2, 'ChartJS', 'admin_lte/charts/chartjs');

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin_lte/charts/chartjs', $this->data);
    }


    public function morris()
    {
        /* Title Page :: Common */
        $this->page_title->push('Charts - Morris');
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = 'Charts - Morris';

        /* Breadcrumbs :: MORRIS */
        $this->breadcrumbs->unshift(2, 'Morris', 'admin_lte/charts/morris');

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin_lte/charts/morris', $this->data);
    }


    public function flot()
    {
        /* Title Page :: Common */
        $this->page_title->push('Charts - Flot');
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = 'Charts - Flot';

        /* Breadcrumbs :: FLOT */
        $this->breadcrumbs->unshift(2, 'Flot', 'admin_lte/charts/flot');

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin_lte/charts/flot', $this->data);
    }


    public function chartjs()
    {
        /* Title Page :: Common */
        $this->page_title->push('Charts - Inline');
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = 'Charts - Inline';

        /* Breadcrumbs :: INLINE */
        $this->breadcrumbs->unshift(2, 'Inline', 'admin_lte/charts/inline');

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin_lte/charts/inline', $this->data);
    }


}
