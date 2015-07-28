<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(

  /**
   * validation contact
   */
  'contact/send' => array(
      array('field'=>'name',
            'label'=>'Nome',
            'rules'=>'required|min_length[3]|max_length[255]|trim'),
      array('field'=>'email',
            'label'=>'E-mail',
            'rules'=>'required|min_length[3]|max_length[100]|trim|valid_email'),
      array('field'=>'telephone',
            'label'=>'Telefone',
            'rules'=>'min_length[8]|max_length[25]|trim'),
      array('field'=>'message',
            'label'=>'Mensagem',
            'rules'=>'required|max_length[999]|trim')
  ),

);
