<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * return instance ci
 *
 * @access public
 *
 * @return object
 */
if ( ! function_exists('_ci'))
{
    function _ci()
    {
        $CI =& get_instance();
        return $CI;
    }
}

/**
 * debug and die
 * dd - usado para debugar a aplicação durante o desenvolvimento
 */
if ( ! function_exists('dd'))
{
    function dd($content, $die = TRUE, $print = 'var_dump') {
        echo "<pre>";
        $print($content);
        echo "</pre>";

        if ($die == TRUE) {
            die();
        }
    }
}
