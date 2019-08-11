<?php
//ICONOS
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
if (!function_exists('armarSelectCtasBancarias')) {
    function armarSelectCtasBancarias()
    {
        $CI = get_instance();
        $CI->load->model('operaciones/CtaBancaria_model');
        $data['ctasBancarias'] = $CI->CtaBancaria_model->GetDataCtasBancarias();
        $selectCtasBancarias = $CI->load->view('ctasbancarias/v_select',$data,TRUE);
        return $selectCtasBancarias;
    }
}
