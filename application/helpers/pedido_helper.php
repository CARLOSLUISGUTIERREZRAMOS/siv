<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
if (!function_exists('FormaDataInsertPedido')) {
    function FormaDataInsertPedido($DataAjax) {
        return $data_insert_pedido;
    }
}
if (!function_exists('EvaluarConversion_Soles_A_Dolares')) {
    function EvaluarConversion_Soles_A_Dolares($abono,$moneda,$tc_trans) {
        switch ($moneda){
            case 'PEN':
                $res = (float) $abono / (float)$tc_trans;
               
                break;
            case 'USD':
                $res = (float) $abono;
                 return 'DE';
        }
          return $res;
       
    }
}

if (!function_exists('ObtenerNombreEstado')) {
    function ObtenerNombreEstado($cod_estado) {
        switch ($cod_estado) {
            case 'VT':
                $nombres_estado = 'VENTA';
                break;
            case 'RQ':
                $nombres_estado = 'REQUERIMIENTO';
                break;
            case 'EP':
                $nombres_estado = 'ENVÍO PARCIAL';
                break;
            case 'ET':
                $nombres_estado = 'ENVÍO TOTAL';
                break;
            case 'RL':
                $nombres_estado = 'RECEPCIÓN LIMA';
                break;
            case 'EN':
                $nombres_estado = 'ENTREGA';
                break;
            default : 'DESCONOCIDO';
        }
        return $nombres_estado;
    }

}