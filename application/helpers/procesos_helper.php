<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
if (!function_exists('MostrarBloqueAviso')) {
    function MostrarBloqueAviso($title,$msg_descripcion) {
        $CI = get_instance();
        $data['title'] = $title;
        $data['msg'] = $msg_descripcion;
        $res = $CI->load->view('templates/v_show_msg',$data,TRUE);
        return $res;
    }
}