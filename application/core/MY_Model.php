<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class MY_Model extends CI_Model{

    /**
    * table
    *
    * The database table of the model
    *
    * When extending this class, you should set the table name in the constructor
    *
    * @var string
    * @access protected
    */
    protected $table;

    /**
    * primary_key
    *
    * The primary key of the model's table.
    *
    * When extending this class you may want to change it to fit your tables' primary key field.
    *
    * @var string
    * @access protected
    */
    protected $primary_key = 'id';

    /**
    * return_type
    *
    * Which type of data methods should return.
    * Options are:
    * - 'array'
    * - 'object' (Default)
    *
    * If you want methods to return objects, change this value
    * in your Models' constructors.
    *
    * @var mixed
    * @access protected
    */
    protected $return_type = 'object';


    /**
    * constructor method
    */
    public function __construct()
    {
        parent::__construct();

        $this->table = $this->router->fetch_class();
    }


    /**
    * get
    *
    * Method to retrieve data from database
    * This method tries to return just one record, but if it finds
    * more records, it will return all of them in an array, just like
    * the 'filter' method.
    * Useful when you want just one row. For many rows 'filter' is
    * the best option.
    *
    * Examples:
    *
    * $where :
    * 'id = 1'
    * or
    * array('id' => 1, 'other_id' => 2, 'other_id in' => array(1,2,3))
    *
    *
    * @param array $where Can be an array or a string
    * @param array $fields Can be an array or an string
    * @access public
    * @return void
    */
    public function get($where = '', $fields = '', $order = '')
    {
        $results = $this->filter($where, $fields, $order);

//        if (count($results) == 1) {
//            return $results[0];
//        }

        return $results;
    }

    public function get_alter($id)
    {
        if(is_numeric($id))
        {
            $this->db->where($this->primary_key, $id);
        }
        else if(is_array($id))
        {
            foreach ($id as $f => $w){
                $this->db->where($f, $w);
            }
        }
        else
        {
            return FALSE;
        }

        return $this->db->get($this->table)->row();
    }


    /**
    * save
    *
    * Method to save data to the database.
    *
    * To update data you must have an {$this->primary_key} element in the given array.
    *
    * This method returns the row id (inserted or updated)
    *
    * @param array $data
    * @access public
    * @return mixed
    */
    public function save($data)
    {
        if (isset($data[$this->primary_key]) AND $data[$this->primary_key] != 0) {
            $this->db->where($this->primary_key, $data[$this->primary_key]);
            $this->db->update($this->table, $data);
        }
        else {
            $this->db->insert($this->table, $data);
            $data[$this->primary_key] = $this->db->insert_id();
        }

        return ($this->db->affected_rows() > 0) ? $data[$this->primary_key] : FALSE;
    }


    public function save_batch($data)
    {
        $this->db->insert_batch($this->table, $data);
    }

    /**
    * filter
    *
    * Method to retrieve data from database.
    * This method will always return an array of results,
    * even if it's just one row.
    *
    * @param array $where Can be an array or a string
    * @param array $fields Can be an array or a string
    * @param array $order Can be an array or a string
    * @access public
    * @return array
    */
    public function filter($where = '', $fields = '', $order = '')
    {
        $this->db->from($this->table);

        if (is_array($where)) {
            foreach ($where as $f => $w){
                if(substr($f, -3) === ' in'){
                    $this->db->where_in(substr($f, 0, strlen($f)-3), $w);
                } else {
                    $this->db->where($f, $w);
                }
            }
        } elseif (strlen($where) > 0) {
            $this->db->where($where);
        }


        if (is_array($fields)) {
            foreach ($fields as $field) {
                $this->db->select($field);
            }
        } elseif (strlen($fields) > 0) {
            $this->db->select($fields);
        }

        if (is_array($order)) {
            foreach ($order as $f => $o){
                $this->db->order_by($f, $o);
            }
        } elseif (strlen($order) > 0) {
            $this->db->order_by($order);
        }

        $query = $this->db->get();

        if ($this->return_type == 'array') {
            $results = $query->result_array();
        } else {
            $results = $query->result();
        }

        return $results;
    }

    /**
    * delete
    *
    * removes a row from database
    * or update deleted to true if fake = true
    *
    * @param  integer/array $id
    * @param  boolean
    * @access public
    * @return booelan
    */
    public function delete($id, $fake = false)
    {

        if(is_numeric($id))
        {
            $this->db->where($this->primary_key, $id);
        }
        else if(is_array($id))
        {
            foreach ($id as $f => $w){
                $this->db->where($f, $w);
            }
        }
        else
        {
            return FALSE;
        }

        if($fake)
        {
            $this->db->update($this->table, array(
                    'deleted'         => 1,
                    'user_id_updated' => $this->session->userdata('user_id'),
                    'updated_at'      => date($this->config->item('log_date_format'))
                ));
        }
        else
        {
            $this->db->delete($this->table);
        }

        return TRUE;
    }


    /**
    * count_results
    *
    * Count the number of rows in a table
    *
    * @param array $where
    * @access public
    * @return void
    */
    public function count_results($where = '')
    {
        if (is_array($where)) {
            foreach ($where as $f => $w){
                if(substr($f, -3) === ' in'){
                    $this->db->where_in(substr($f, 0, strlen($f)-3), $w);
                } else {
                    $this->db->where($f, $w);
                }
            }
        }
        elseif (strlen($where) > 0) {
            $this->db->where($where);
        }

        if ($this->db->field_exists('active', $this->table))
        {
            $this->db->where('active', 1);
        }

        if ($this->db->field_exists('deleted', $this->table))
        {
            $this->db->where('deleted', 0);
        }

        return $this->db->count_all_results($this->table);
    }

    /**
    * paginate
    *
    * Function to paginate results from the database. It only retrieve the needed rows
    *
    * @param int $offset
    * @param int $quantity
    * @param array $where Can be an array or a string
    * @access public
    * @return array
    */
    public function paginate($offset, $rows = 10, $where = '', $fields = '')
    {
        if (is_array($where)) {
            foreach ($where as $f => $w){
                $this->db->where($f, $w);
            }
        }
        elseif (strlen($where) > 0) {
            $this->db->where($where);
        }

        if (is_array($fields)) {
            foreach ($fields as $field) {
                $this->db->select($field);
            }
        }
        elseif (strlen($fields) > 0) {
            $this->db->select($fields);
        }

        $this->db->limit($quantity, $offset);

        $this->db->get($this->table);

        if ($this->return_type == 'array') {
            $results = $query->result_array();
        }
        else {
            $results = $query->result();
        }

        return $results;
    }

    /**
    * count
    *
    * Returns the number of results
    *
    * @access public
    * @return integer
    */
    public function count()
    {
        return $this->db->count_all_results($this->table);
    }



    /**
     * active
     *
     * funcao criada para ativar ou inativar um item.
     *
     * @param int $id
     * @param int $active
     * @access public
     * @return booelan
     */
    public function active($id, $active)
    {
        if( !$id )
            return false;

        return $this->save(array(
                'id'              => $id,
                'active'          => $active ? 0 : 1,
                'user_id_updated' => $this->session->userdata('user_id'),
                'updated_at'      => date($this->config->item('log_date_format'))
            ));
    }


    public function liberado($id)
    {
        if( ! $id )
            return false;

        return $this->save(array(
                'id'              => $id,
                'liberado'        => 1,
                'user_id_updated' => $this->session->userdata('user_id'),
                'updated_at'      => date($this->config->item('log_date_format'))
            ));
    }



    public function getDropDown($order, $where = '') {
        if (is_array($order)) {
            foreach ($order as $f => $t){
                $this->db->order_by($f, $t);
            }
        }
        elseif (strlen($order) > 0) {
            $this->db->order_by($order);
        }

        if (is_array($where)) {
            foreach ($where as $f => $w){
                $this->db->where($f, $w);
            }
        }
        elseif (strlen($where) > 0) {
            $this->db->where($where);
        }

        if ($this->db->field_exists('liberado', $this->table))
        {
            $this->db->where('liberado', 1);
        }

        if ($this->db->field_exists('active', $this->table))
        {
            $this->db->where('active', 1);
        }

        if ($this->db->field_exists('deleted', $this->table))
        {
            $this->db->where('deleted', 0);
        }

        $query = $this->db->get($this->table);

        if ($this->return_type == 'array') {
            $results = $query->result_array();
        }
        else {
            $results = $query->result();
        }

        return $results;
    }



    public function truncate()
    {
        $this->db->truncate($this->table);
    }



    public function getMaxId()
    {
        return $this->db->select_max('id')->get($this->table)->row()->id;
    }


    public function valueToId($where)
    {
        $dataInsert = array();

        if (is_array($where)) {
            foreach ($where as $f => $w){
                $this->db->where($f, $w);
                $dataInsert[$f] = $w;
            }
        }

        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {

            if ($query->num_rows() == 1) {
                return $query->row()->id;
            }

            $result = $query->result();
            return $result[0]->id;
        }

        $dataInsert['user_id_created'] = $this->session->userdata('user_id');
        $dataInsert['user_id_updated'] = $this->session->userdata('user_id');
        $dataInsert['created_at']      = date($this->config->item('log_date_format'));
        $dataInsert['updated_at']      = date($this->config->item('log_date_format'));

        $this->db->insert($this->table, $dataInsert);

        return ($this->db->affected_rows() > 0) ? $this->db->insert_id() : FALSE;
    }


    /**
     * SALVA ARRAY DE ITENS A UM ITEM EM UM MODEL AUXILIAR
     *
     * @access public
     *
     * @param array
     * @param array
     * @param string
     * @param boolean
     * @param boolean
     * @param string
     *
     *
     * @return string
     */
    public function saveChecksAux($valueId = array(), $valuesAux = array(), $edit = FALSE, $addNewItens = FALSE, $modelNewItem = '')
    {
        $keyID = key($valueId);
        $valueID = $valueId[$keyID];

        // dd($keyID,0);
        // dd($valueID);

        if ($edit !== FALSE) {
            $this->delete(array($keyID => $valueID));
        }

        $aux = key($valuesAux);
        $valuesAux = $valuesAux[$aux];

        if ($valuesAux !== FALSE && is_array($valuesAux)) {
            // if ($addNewItens !== FALSE) {
            //     $valuesAux = $this->getIdsNewItem($valuesAux[0], $modelNewItem);
            // }

            $arrAuxValues = array();
            $cont = 0;
            foreach ($valuesAux as $valueAuxId) {
                $arrAuxValues[$cont] = array(
                        $keyID => $valueID,
                        $aux   => $valueAuxId
                    );

                if ($this->db->field_exists('created_at', $this->table)) {
                    $arrAuxValues[$cont]['created_at'] = date($this->config->item('log_date_format'));
                }

                $cont++;
            }
            $this->save_batch($arrAuxValues);
        }

        return TRUE;
    }

    /*retorna um array de ids . Exemplo de tabela - hierarquia ( monitoramento_plano_acao ) */
    public function getRecursiveIds($id, $colunaPai = '', $ids = array())
    {
        $idsRecursive = $ids;

        $row = $this->get_alter($id);
        $idsRecursive[] = $row->id;

        if ($row->$colunaPai > 0) {
            return $this->getRecursiveIds($row->$colunaPai, $colunaPai, $idsRecursive);
        }

        return $idsRecursive;
    }


}

/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */