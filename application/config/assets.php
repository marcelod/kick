<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// $base_url = $this->config->item('base_url');
$config['assets_url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$config['assets_url'].= "://" . $_SERVER['HTTP_HOST'];
$config['assets_url'].= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
$config['assets_url'].= 'assets/';

/* End of file assets.php */
/* Location: ./application/config/assets.php */