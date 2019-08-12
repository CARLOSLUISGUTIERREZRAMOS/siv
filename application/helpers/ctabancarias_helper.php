<?php
//ICONOS
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
if (!function_exists('armarSelectCtasBancarias')) {
    function armarSelectCtasBancarias()
    {
        $CI = get_instance();
        $CI->load->model('operaciones/Cuentas_bancarias_model');
        $data['ctasBancarias'] = $CI->Cuentas_bancarias_model->GetCuentasBancarias();
        // $data['id'] = $idCtasBancarias;
        $selectCtasBancarias = $CI->load->view('ctasbancarias/v_select',$data,TRUE);
        return $selectCtasBancarias;
    }
}
