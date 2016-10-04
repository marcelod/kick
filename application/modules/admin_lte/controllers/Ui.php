<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ui extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'UI', 'admin_lte/ui');
    }

    public function index()
    {
        $this->general();
    }

    public function general()
    {
        /* Title Page :: General */
        $this->page_title->push('UI - General');
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = 'UI - General';

        /* Breadcrumbs :: GENERAL */
        $this->breadcrumbs->unshift(2, 'General', 'admin_lte/ui/general');

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin_lte/ui/general', $this->data);
    }


    public function icons()
    {
        /* Title Page :: Icons */
        $this->page_title->push('UI - Icons');
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = 'UI - Icons';

        /* Breadcrumbs :: ICONS */
        $this->breadcrumbs->unshift(2, 'Icons', 'admin_lte/ui/icons');

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin_lte/ui/icons', $this->data);
    }


    public function buttons()
    {
        /* Title Page :: Buttons */
        $this->page_title->push('UI - Buttons');
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = 'UI - Buttons';

        /* Breadcrumbs :: BUTTONS */
        $this->breadcrumbs->unshift(2, 'Buttons', 'admin_lte/ui/buttons');

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin_lte/ui/buttons', $this->data);
    }


    public function sliders()
    {
        /* Title Page :: Sliders */
        $this->page_title->push('UI - Sliders');
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = 'UI - Sliders';

        /* Breadcrumbs :: SLIDERS */
        $this->breadcrumbs->unshift(2, 'Sliders', 'admin_lte/ui/sliders');

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin_lte/ui/sliders', $this->data);
    }


    public function timeline()
    {
        /* Title Page :: Timeline */
        $this->page_title->push('UI - Timeline');
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = 'UI - Timeline';

        /* Breadcrumbs :: TIMELINE */
        $this->breadcrumbs->unshift(2, 'Timeline', 'admin_lte/ui/timeline');

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin_lte/ui/timeline', $this->data);
    }


    public function modals()
    {
        /* Title Page :: Modals */
        $this->page_title->push('UI - Modals');
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = 'UI - Modals';

        /* Breadcrumbs :: MODALS */
        $this->breadcrumbs->unshift(2, 'Modals', 'admin_lte/ui/modals');

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Render page*/
        $this->_render_page('admin_lte/ui/modals', $this->data);
    }


}
