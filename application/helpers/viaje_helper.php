<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
if (!function_exists('ArmarJsonPedidosDetalles')) {

    function ArmarJsonPedidosDetalles($PedidosDetalle) {
        $data_2 = [];
        $data_3 = array();
        foreach ($PedidosDetalle->Result() as $item) {
            $data_2[$item->codigo] = $item->codigo;
        }
        foreach ($data_2 as $key) {
            foreach ($PedidosDetalle->Result() as $item) {
                switch ($key) {
                    case $item->codigo:
                        $data_3[$key]['cantidad'] = $item->cantidad;
                        $data_3[$key]['nombre'] = $item->nombre;
                        $data_3[$key]['shipping_unitario'] = $item->shipping_unitario;
                        $data_3[$key]['peso_libras'] = $item->peso_libras;
                        break;
                }
            }
        }
        return json_decode(json_encode($data_3));
    }
}
