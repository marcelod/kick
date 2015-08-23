<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Options_m extends MY_Model {


    public function __construct()
    {
        parent::__construct();

        $this->table = "options";
    }

}
