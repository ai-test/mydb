<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2014/11/28
 * Time: 22:24
 */

$theFile = MODULE_PATH . 'Lang/' . LANG_SET . '/public.php';

if (file_exists($theFile)) {
    require_once $theFile;
} else {
    $theMenuTrans = array();
}

$theTrans = array(

    'GLOBALS_WEBSITE' => 'My Database',

    'TITLE_BACKEND_MANAGER' => '后台管理',

    'COPYRIGHT_COMPANY' => 'aizerla'

);

return array_merge($theTrans, $theMenuTrans);