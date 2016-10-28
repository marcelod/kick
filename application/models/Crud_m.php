<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud_m extends MY_Model {

	public function __construct()
    {
        parent::__construct();
    }

    public function getItemDT()
    {
        $this->load->library('Datatables');
        $this->load->helper(array('datatables'));

        $this->datatables
            ->select('id as crud_id, name, description')
            ->from($this->table)
            ->where('deleted', 0)
            ->add_column('actions', '$1', "btnsDatatables('crud_id', 'admin/crud', 1, 1)")
            ->unset_column('crud_id');

        $r = $this->datatables->generate();

        return $r;
    }

}
