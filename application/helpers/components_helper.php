<?php

/**
 * cAlerts
 *
 * Generates an HTML to Component Alerts twitterBootstrap
 * http://getbootstrap.com/components#alerts
 *
 * @access  public
 * @param   string
 * @param   string
 * @param   boolean
 * @param   mixed
 * @return  string
 */
if ( ! function_exists('cAlerts'))
{
    function cAlerts($msg, $tipo = "alert-success", $close = true, $icon = "&times;")
    {
        $box = "<div class='alert " . $tipo . "'>";

        if ($close)
            $box .= "<button type='button' class='close' data-dismiss='alert'>" . $icon . "</button>";

        $box .= $msg;

        $box .= "</div>";

        return $box;
    }
}


/**
 * cLabel
 *
 * Generates an HTML to Component Label twitterBootstrap
 * http://getbootstrap.com/components/#labels
 *
 * @access  public
 * @param   string
 * @param   string
 * @return  string
 */
if ( ! function_exists('cLabel'))
{
    function cLabel($text, $class = "label-default", $id = NULL, $element = "span" )
    {
        if ($id != NULL) {
            $id = " id ='" . $id . "'";
        }

        if ($class == "") {
            $class = "label-default";
        }

        if ($element == "") {
            $element = "span";
        }

        $label = "<" . $element . " class='label " . $class . "'" . $id . ">";
        $label.= $text;
        $label.= "</" . $element . ">";

        return $label;
    }
}


if ( ! function_exists('cLabelDataTime'))
{
    function cLabelDataTime($dateTime, $classLabel = "label-default")
    {
        $CI = _ci();
        $CI->load->helper('datetime_format');

        list($date, $time) = explode(" ", trim($dateTime));
        $date = cLabel(data_us_to_br($date), $classLabel);
        $time = cLabel($time, $classLabel);

        return $date . " " . $time;
    }
}



if ( ! function_exists('cLabelDate'))
{
    function cLabelDate($date, $classLabel = "label-default")
    {
        $CI = _ci();
        $CI->load->helper('datetime_format');

        return cLabel(data_us_to_br($date), $classLabel);
    }
}

if ( ! function_exists('linkDownload'))
{
    function linkDownload($file, $file_name_original = false, $folder = '')
    {
        $CI = _ci();
        $CI->load->helper('datetime_format');

        $link = '';

        if (checkFile($file, $folder)) {
            $link.= "<a href='download/file/" . $folder . "/" . $file ."' title='baixar arquivo " . $file_name_original . " '>";
            $link.= "<span class='glyphicon glyphicon-paperclip'></span>";
            $link.= "</a>";
        }

        return $link;
    }
}




/**
 * pageHeader
 *
 * Generates an HTML to pageHeader
 * http://getbootstrap.com/css/#type
 *
 * @access  public
 * @param   string
 * @param   string
 * @return  string
 */
if ( ! function_exists('pageHeader'))
{
    function pageHeader($descryption, $header = "h1")
    {
        $box = "<div>";
        $box .= "<" . $header . ">" . $descryption . "</" . $header . ">";
        $box .= "</div><hr>";

        return $box;
    }
}


if ( ! function_exists('lineHeaderBt'))
{
    function lineHeaderBt($text, $header = "h3", $bt = array())
    {
        $textHeader = $text;
        if($bt !== FALSE)
        {
            $textHeader.= '<span class="pull-right">' . linkButton($bt) . '</span>';
        }

        return pageHeader($textHeader, $header);
    }
}

/**
 * cria um link com role button conforme itens passados
 */
if ( ! function_exists('linkButton'))
{
    function linkButton($itensButton = array())
    {
        $textHeader = "";
        if(empty($itensButton))
        {
            $itensButton = array(
                'data-target' => '#create',
                'class'       => 'btn-success',
                'id'          => 'new',
                'icon'        => 'glyphicon-plus-sign',
                'text'        => 'Novo'
              );
        }

        if(is_array($itensButton))
        {
            $toogle = 'data-toggle="modal"';
            if(isset($itensButton['title']))
            {
                $toogle = 'title="' . $itensButton['title'] . '" data-toogle="tooltip modal"';
            }

            $textHeader.= '<a
                data-target="' . $itensButton['data-target'] . '"
                role="button"
                class="btn ' . $itensButton['class'] . '"
                id="' . $itensButton['id'] . '"
                ' . $toogle . '>';
            $textHeader.= '<span class="glyphicon ' . $itensButton['icon'] . '"></span> ' . $itensButton['text'] . '</a>';
        }

        return $textHeader;
    }
}



if ( ! function_exists('tableDT'))
{
    function tableDT($id, $arColHeader = array(), $arColBody = array())
    {
        $tb = '<table id="'.$id.'" class="table table-striped table-bordered table-hover table-condensed">';
        $tb.= '<thead>';
        if( ! empty($arColHeader) && is_array($arColHeader))
        {
            $tb.= '<tr>';
            foreach ($arColHeader as $key => $vl)
            {
                $tb.= '<th>';
                $tb.= $key !== 'icon' ? $vl : '<span class="glyphicon ' . $vl . '"></span>';
                $tb.= '</th>';
            }
            $tb.= '</tr>';
        }
        $tb.= '</thead>';
        $tb.= '<tbody>';
        if( ! empty($arColBody) && is_array($arColHeader))
        {
            // $tb.= '<tr>';
            // foreach ($arColBody as $vl)
            // {
            //     $tb.= '<td>' . $vl . '</td>';
            // }
            // $tb.= '</tr>';
        }
        $tb.= '</tbody>';
        $tb.= '</table>';


        return $tb;
    }
}


/**
 * bread
 *
 * Generates an HTML to Component breadcrumb twitterBootstrap
 * http://getbootstrap.com/components/#breadcrumbs
 *
 * @access  public
 * @param   array
 */
if ( ! function_exists('cBreadcrumb'))
{
    function cBreadcrumb($list = array())
    {
        $nav = "";

        if (is_array($list) && count($list) > 0) {

            $nav = "<ol class='breadcrumb'>";

            foreach ($list as $li) {
                $class = isset($li['class']) ? 'class="' . $li['class'] . '"' : '';
                $nav .= "<li {$class}>";

                if (isset($li['href'])) {
                    $nav .= '<a href="'. $li['href'] .'">' . textCharLimit($li['text']) . '</a>';
                }
                else {
                    $nav .= textCharLimit($li['text']);
                }

                $nav.= "</li>";
            }

            $nav.= "</ol>";

        }

        return $nav;
    }
}


if ( ! function_exists('linkExport'))
{
    function linkExport($href = "#", $text = "Exportar")
    {
        $link = "<a href='" . $href . "' class='btn btn-default'>";
        $link.= "<i class='fa fa-file-excel-o'></i> " . $text;
        $link.= "</a>";

        return $link;
    }
}


function textCharLimit($text='', $limit = 45)
{
    $CI = _ci();
    $CI->load->helper('text');
    if (mb_strlen($text) <= $limit) {
        return $text;
    }

    return '<span title="' . $text . '">' . character_limiter($text, $limit, '&#8230;') .  '</span>';
}