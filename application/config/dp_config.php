<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$config['assets_dir']     = 'assets';
$config['frameworks_dir'] = $config['assets_dir'] . '/frameworks';
$config['plugins_dir']    = $config['assets_dir'] . '/plugins';

$config['upload_dir']     = 'upload';
$config['avatar_dir']     = $config['upload_dir'] . '/avatar';

$config['path_format_date'] = date('Y'. DIRECTORY_SEPARATOR .'m' . DIRECTORY_SEPARATOR . 'd');
$config['path_upload']      = $config['upload_dir']. DIRECTORY_SEPARATOR . $config['path_format_date'];
