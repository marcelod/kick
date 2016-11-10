<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * verifica se o diretorio existe, caso nao exista ira criar
 *
 * @access public
 *
 * @param string folder_name
 * @param int mode
 * @param bool recursive
 *
 * @return bool
 */
if ( ! function_exists('make_folder'))
{
    function make_folder($folder_name, $mode = 0777, $recursive = TRUE)
    {
        // verifica se foi passado algum folder_name, caso nao tenha ira retornar falso
        if (is_null($folder_name) || $folder_name == "") {
            return false;
        }

        if ( ! is_dir($folder_name))
        {
            // create folder
            mkdir($folder_name, $mode, $recursive);

            // copy file index.html into new folder
            copy('assets/index.html', $folder_name.'/index.html');

            // add permission in new folder
            chmod($folder_name, $mode);
        }

        return true;
    }
}
