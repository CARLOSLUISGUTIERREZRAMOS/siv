<?php
//ICONOS
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
if (!function_exists('armarSelectProductos')) {
    function armarSelectProductos()
    {
        $CI = get_instance();
        $CI->load->model('data/Productos_model');
        $data['allProductos'] = $CI->Productos_model->GetAllProductos();
        // $data['id'] = $idCtasBancarias;
        $selectProductos = $CI->load->view('productos/v_select',$data,TRUE);
        return $selectProductos;
    }
}
