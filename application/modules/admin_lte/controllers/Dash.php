<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dash extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Dashboard', 'admin_lte/dash');
    }

    public function index()
    {
        $this->v1();
    }


	public function v1()
    {
        /* Title Page :: Common */
        $this->page_title->push('Dashboard - V1');
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = 'Dashboard - V1';

        /* Breadcrumbs :: V1 */
        $this->breadcrumbs->unshift(2, 'V1', 'admin_lte/dash/v1');

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin_lte/dash/v1', $this->data);
    }


    public function v2()
    {
        /* Title Page :: Common */
        $this->page_title->push('Dashboard - V2');
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = 'Dashboard - V2';

        /* Breadcrumbs :: V2 */
        $this->breadcrumbs->unshift(2, 'V2', 'admin_lte/dash/v2');

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin_lte/dash/v2', $this->data);
    }


}
