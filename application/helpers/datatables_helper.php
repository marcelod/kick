<?php

/**
 * actionsDataTable
 *
 * Define os elementos, controller para criar as ações para o DataTable
 *
 * @access  public
 * @param   int
 * @param   string
 * @param   boolean
 * @param   boolean
 * @param   boolean
 * @param   mixed       $active default FALSE
 *
 * caso $active seja diferente de FALSE é que tem a opação para ativar/inativar o elemento
 *      podendo ser 1 ou 0, com isso já sei que
 *          caso seja passado 1 o elemento esta ativo e tem que dar a opção para inativar
 *          caso seja passado 0 o elemento esta inativo e tem que dar a opção para ativar
 */
if ( ! function_exists('actionsDataTable'))
{
    function actionsDataTable($id, $controller, $delete = TRUE, $edit = TRUE, $config = TRUE, $active = FALSE, $responsive = TRUE)
    {
        $actions = array();

        if($delete) array_push ($actions, 'delete');
        if($edit)   array_push ($actions, 'edit');
        if($config) array_push ($actions, 'config');
        if ($active !== FALSE AND $active != 'FALSE')  {
            array_push ($actions, array('active' => $active));
        }
        return actionColumn($id, $controller, $actions, $responsive);
    }
}



/**
 * actionColumn
 *
 * Create element to actions on DataTables with component button dropdowns
 * http://getbootstrap.com/components/#btn-dropdowns
 *
 * @access  public
 * @param   int
 * @param   string
 * @param   array
 *
 */
if ( ! function_exists('actionColumn'))
{
    function actionColumn($id, $controller, $actions = array(), $responsive = TRUE)
    {
        $CI = _ci();
        $CI->load->helper('html');

        $html = "";
        $delete = FALSE;
        $edit   = FALSE;
        $conf   = FALSE;
        $active = FALSE;

        if(is_array($actions) && !empty ($actions))
        {
            foreach ($actions as $value) {
                if(is_array($value)) {
                    $active = array_key_exists('active', $value) ? $value['active'] : $active;
                } else {
                    $delete = $value == 'delete' ? TRUE : $delete;
                    $edit = $value == 'edit' ? TRUE : $edit;
                    $conf = $value == 'config' ? TRUE : $conf;
                }
            }
        }

        if($responsive)
        {
            ##########
            ## BOTOES PARA DISPOSITIVOS < 768px (mobile, tablets)
            ##########
            $html .= '<div class="btn-group visible-xs text-left">';
            // $html .= '<div class="btn-group">';

                $html .= '<button type="button" class="btn btn-xs btn-primary btn-block dropdown-toggle" data-toggle="dropdown">';
                $html .= 'Ação <span class="caret"></span>';
                $html .= '</button>';

                $list = array();
                $attr = array('class' => 'dropdown-menu pull-right list-actions', 'role' => 'menu');

                // if($edit)
                    // $list[] = linkBtnDT('Editar', '#', $id , 'edit', 'edit_row_dt', 'glyphicon-edit', FALSE);

                if($edit)
                {
                    $href = $controller .'/edit/' . $id;
                    $text = "Editar";
                    $icon = "glyphicon-edit";

                    $list[] = linkBtnModalDT($text, $href, FALSE , 'edit', 'edit_row_dt', $icon, FALSE);
                }

                if($active !== FALSE)
                {
                    $href = $controller .'/active/' . $id .'/' . $active;
                    $text = "Ativar";
                    $icon = "glyphicon-minus-sign";

                    if($active)
                    {
                        $text = "Inativar";
                        $icon = "glyphicon-plus-sign";
                    }

                    $list[] = linkBtnModalDT($text, $href, FALSE , 'active', 'active_row_dt', $icon, FALSE);
                }

                if($conf)
                    $list[] = linkBtnModalDT('Configurar', '#', $id , 'conf', 'conf_row_dt', 'glyphicon-wrench', FALSE);

                if($delete)
                {
                    if( count($actions) > 1 )
                    {
                        $list[] = '<li class="divider"></li>';
                    }

                    $list[] = linkBtnModalDT('Apagar', '#', $id , 'delete', 'delete_row_dt', 'glyphicon-trash', FALSE);
                }

                $html.= ul($list, $attr);

            $html .= '</div>';
        }

        ##########
        ## BOTOES PARA DISPOSITIVOS >= 768px (desktop)
        ##########

        if($responsive)
        {
            $html .= '<div class="hidden-xs">';
        }
        else
        {
            $html .= '<div>';
        }

            // if($edit)
                // $html.= linkBtnDT('Editar', '#', $id , 'edit', 'edit_row_dt btn btn-xs btn-action-datatable btn-warning', 'glyphicon-edit', FALSE, $responsive);

            if($edit)
            {
                $href = $controller .'/edit/' . $id;
                $text = "Editar";
                $icon = "glyphicon-edit";

                $html.= linkBtnModalDT($text, $href, FALSE , 'edit', 'edit_row_dt btn btn-xs btn-action-datatable btn-warning', $icon, $responsive);
            }

            if($active !== FALSE)
            {
                $href = $controller .'/active/' . $id .'/' . $active;
                $text = "Ativar";
                $icon = "glyphicon-minus-sign";
                $class = "active_row_dt btn btn-xs btn-action-datatable btn-danger";

                if($active)
                {
                    $text = "Inativar";
                    $icon = "glyphicon-plus-sign";
                    $class = "active_row_dt btn btn-xs btn-action-datatable btn-primary";
                }

                $html.= linkBtnModalDT($text, $href, FALSE , 'active', $class, $icon, FALSE, $responsive);
            }

            if($delete)
                $html.= linkBtnModalDT('Apagar', '#', $id , 'delete', 'delete_row_dt btn btn-xs btn-action-datatable btn-danger', 'glyphicon-trash', FALSE, $responsive);

            if($conf)
                $html.= linkBtnModalDT('Configurar', '#', $id , 'conf', 'conf_row_dt btn btn-xs btn-action-datatable btn-success', 'glyphicon-wrench', FALSE, $responsive);

        $html .= '</div>';

        return $html;
    }
}


/**
 * btnOpenClose
 *
 * create btn open/close
 */
if ( ! function_exists('btnOpenClose'))
{
    function btnOpenClose($id = 0, $title = 'Exibir')
    {
        $btn = '';
        if ($id != 0) {
            $btn.= '<a data-id="' . $id . '" class="open_close_details_dt btn btn-xs btn-success" href="#" title="'.$title.'">';
            $btn.= '<span class="glyphicon glyphicon-plus-sign"></span>';
            $btn.= '</a>';
        }

        return $btn;
    }
}


if ( ! function_exists('iconDefault'))
{
    function iconDefault($value = 0)
    {
        if ($value > 0) {
            return '<span class="glyphicon glyphicon-ok text-primary"></span>';
        }

        return '<span class="glyphicon glyphicon-minus text-danger"></span>';
    }
}




if ( ! function_exists('btnsDatatables'))
{
    function btnsDatatables($id, $controller, $edit = 0, $delete = 0)
    {
        $btn = '';

        if ($id != 0 && ($edit != 0 || $delete != 0))
        {

            if ($edit)
            {
                $btn.= '<a href="'.$controller . '/edit/' . $id .'" class="btn btn-xs btn-action-datatable btn-warning" href="#" title="Editar">';
                    $btn.= '<span class="glyphicon glyphicon-edit"></span><span class="visible-xs">&nbsp;Editar</span>';
                $btn.= '</a>&nbsp;';

            }

            if ($delete)
            {
                $btn.= '<a data-target="#delete" data-id="' . $id . '" data-toggle="modal" class="delete_row_dt btn btn-xs btn-action-datatable btn-danger" href="#" title="Apagar">';
                    $btn.= '<span class="glyphicon glyphicon-trash"></span><span class="visible-xs">&nbsp;Apagar</span>';
                $btn.= '</a>';
            }

        }

        return $btn;
    }
}