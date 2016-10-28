<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->lang->load('admin/crud');

        $this->load->model('crud_m');

        /* Title Page :: Common */
        $this->page_title->push(lang('crud_title'));
        $this->data['pagetitle'] = $this->page_title->show();

        $this->data['title'] = lang('menu_crud');

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, lang('crud_title'), 'admin/crud');
    }


	public function index()
	{
        /* Breadcrumbs */
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        $this->template->add_css('bower_components/datatables/media/css/dataTables.bootstrap.min.css');

        $this->template->add_js('bower_components/datatables/media/js/jquery.dataTables.min.js');
        $this->template->add_js('bower_components/datatables/media/js/dataTables.bootstrap.min.js');
        $this->template->add_js('admin/crud/dtCrud.js');

        /* Render page*/
    	$this->_render_page('admin/crud/index', $this->data);
    }


    public function getDataItem()
    {
    	$items = $this->crud_m->getItemDT();

		if ($this->input->is_ajax_request())
		{
			$this->load->view('includes/list_items_datatables', array('items' => $items));
		}
    }


	public function create()
	{
		/* Breadcrumbs */
        $this->breadcrumbs->unshift(2, lang('menu_crud_create'), 'admin/crud/create');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Validate form input */
		$this->form_validation->set_rules('crud_name', 'lang:create_crud_validation_name_label', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
                'name'              => $this->input->post('crud_name'),
                'description'       => $this->input->post('description'),
                'user_id_created'	=> $this->session->userdata('user_id'),
                'user_id_updated'	=> $this->session->userdata('user_id'),
                'created_at'        => date($this->config->item('log_date_format')),
                'updated_at'        => date($this->config->item('log_date_format'))
            );

           	$save = $this->crud_m->save($data);
            if ($save)
            {
	            $this->session->set_flashdata('message', 'Ok');
				redirect('admin/crud', 'refresh');
            }
		}
		else
		{
            // $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
            $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

			$this->data['crud_name'] = array(
				'name'  => 'crud_name',
				'id'    => 'crud_name',
				'type'  => 'text',
                'class' => 'form-control',
                'required' => 'required',
				'value' => $this->form_validation->set_value('crud_name')
			);
			$this->data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('description')
			);

			$this->template->add_js('bower_components/jquery-validation/dist/jquery.validate.min.js');
			$this->template->add_js('bower_components/jquery-validation/src/localization/messages_pt_BR.js');
			$this->template->add_js('admin/crud/create.js');

        	/* Render page*/
			$this->_render_page('admin/crud/create', $this->data);
		}
	}


	public function edit($id)
	{
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin() OR ! $id OR empty($id))
		{
			redirect('auth', 'refresh');
		}

		
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, lang('menu_crud_edit'), 'admin/crud/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Variables */
		$crud = $this->crud_m->get_alter($id);

		/* Validate form input */
        $this->form_validation->set_rules('crud_name', $this->lang->line('edit_crud_validation_name_label'), 'required');

		if (isset($_POST) && ! empty($_POST))
		{
			if ($this->form_validation->run() == TRUE)
			{
				$data = array(
	                'id'                => $id,
	                'name'              => $this->input->post('crud_name'),
	                'description'       => $this->input->post('crud_description'),
	                'user_id_updated'	=> $this->session->userdata('user_id'),
	                'updated_at'        => date($this->config->item('log_date_format'))
	            );

	            $update = $this->crud_m->save($data);

				if ($update)
				{
					$this->session->set_flashdata('message', 'Ok.');
				}
				else
				{
					$this->session->set_flashdata('message', 'Nok');
				}

				redirect('admin/crud', 'refresh');
			}
		}

        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        $this->data['crud']    = $crud;

		$this->data['crud_name'] = array(
			'type'    => 'text',
			'name'    => 'crud_name',
			'id'      => 'crud_name',
			'value'   => $this->form_validation->set_value('crud_name', $crud->name),
            'class'   => 'form-control',
			'required' => 'required'
		);
		$this->data['crud_description'] = array(
			'type'  => 'text',
			'name'  => 'crud_description',
			'id'    => 'crud_description',
			'value' => $this->form_validation->set_value('crud_description', $crud->description),
            'class' => 'form-control'
		);

		$this->template->add_js('bower_components/jquery-validation/dist/jquery.validate.min.js');
		$this->template->add_js('bower_components/jquery-validation/src/localization/messages_pt_BR.js');
		$this->template->add_js('admin/crud/edit.js');

        /* Render page*/
		$this->_render_page('admin/crud/edit', $this->data);
	}


	public function _delete()
	{
        if ( ! $this->ion_auth->is_admin())
		{
            return show_error('You must be an administrator to view this page.');
        }
        else
        {
            $this->load->view('admin/crud/delete');
        }
	}



	/**
	 * generate view to confirm delete item
	 *
	 * @return html
	*/
	public function delete()
	{
		if ( ! $this->ion_auth->is_admin())
		{
            return show_error('You must be an administrator to view this page.');
        }

        
        $item_id = $this->input->post('item_id');
        $data['crud'] = $this->crud_m->get_alter($item_id);

		$data_modal = array(
			'title_modal'   => "Apagar item de crud",
			'content_modal' => $this->load->view('admin/crud/delete', $data, TRUE),
			'buttons_modal' => array('close' => 'Cancelar', 'delete')
		);

		$this->load->view('includes/modal', $data_modal);
	}

	/**
	 * remove item in database
	 */
	public function deleteRow()
	{
		/* Validate form input */
        $this->form_validation->set_rules('id', 'Identifier', 'required');

		if (isset($_POST) && ! empty($_POST))
		{
			if ($this->form_validation->run() == TRUE)
			{
				$item_id = $this->input->post('id');

				$delete = $this->crud_m->delete($item_id, TRUE);

				$return['success'] = $delete;

				if ($delete)
				{
					$this->session->set_flashdata('message', 'Ok.');
				}
				else
				{
					$this->session->set_flashdata('message', 'Nok');
				}

				$this->load->view('includes/print_json_encode', array('data' => $return));

				return;
			}
		}
	}

}
