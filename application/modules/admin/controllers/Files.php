<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Files extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('file');

        /* Title Page :: Common */
        $this->page_title->push(lang('menu_files'));
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = lang('menu_files');

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, lang('menu_files'), 'admin/files');
    }


	public function index()
	{
        /* Breadcrumbs */
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Data */
        $this->data['error'] = NULL;

        /* Render page*/
        $this->_render_page('admin/files/index', $this->data);
	}


	public function do_upload()
	{
        # create directory to files
        $directory = $this->config->item('path_upload');
        make_folder($directory);

        /* Conf */
        $config['upload_path']      = $directory;
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']         = 2048;
        $config['max_width']        = 1024;
        $config['max_height']       = 1024;
        $config['file_ext_tolower'] = TRUE;

        $this->load->library('upload', $config);

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, lang('menu_files'), 'admin/files');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        if ( ! $this->upload->do_upload('userfile'))
        {
            /* Data */
            $this->data['error'] = $this->upload->display_errors();

            /* Render page*/
            $this->_render_page('admin/files/index', $this->data);
        }
        else
        {
            /* Data */
            $this->data['upload_data'] = $this->upload->data();

            /* Render page*/
            $this->_render_page('admin/files/upload', $this->data);
        }
    }
}
