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
                        $data_3[$key][$item->id]['pedido_codigo'] = $item->codigo;
                        $data_3[$key][$item->id]['cantidad'] = $item->cantidad;
                        $data_3[$key][$item->id]['nombre'] = $item->nombre;
                        $data_3[$key][$item->id]['shipping_unitario'] = $item->shipping_unitario;
                        $data_3[$key][$item->id]['cod_prod'] = $item->cod_prod;
                        $data_3[$key][$item->id]['stock_actual'] = $item->stock_actual;
                        $data_3[$key][$item->id]['peso_libras'] = $item->peso_libras;
                        $data_3[$key][$item->id]['pedido_cliente_codigo'] = $item->pedido_cliente_codigo;
                        break;
                }
            }
        }
        return json_decode(json_encode($data_3));
    }

}

if (!function_exists('ObtenerStockProductos')) {

    function ObtenerStockProductos($PedidosDetalle) {

        $data = array();
        foreach ($PedidosDetalle->Result() as $item) {
            $data[$item->cod_prod] = $item->stock_actual;
        }
            return $data;
    }

}

if (!function_exists('FormarInsertTblViajeDetalle')) {

    function FormarInsertTblViajeDetalle($IdViaje, $JsonViajeDetalle) {
        
        $data_insert_viaje_detalle = array();
        
       $data_insert_viaje_detalle['viaje_id'] = $IdViaje;
       $data_insert_viaje_detalle['costo_pasaje'] = $JsonViajeDetalle[0]->costo_pasaje;
       $data_insert_viaje_detalle['comision_viajero'] = $JsonViajeDetalle[0]->comision_viajero;
       $data_insert_viaje_detalle['comision_adn'] = $JsonViajeDetalle[0]->comision_adn;
       $data_insert_viaje_detalle['comision_persona_encargada'] = $JsonViajeDetalle[0]->comision_persona_encargada;
       $data_insert_viaje_detalle['impuesto_aduanas']= $JsonViajeDetalle[0]->impuesto_aduanas;
       $data_insert_viaje_detalle['costo_recojo'] = $JsonViajeDetalle[0]->costo_recojo;
       $data_insert_viaje_detalle['gastos_extras'] = $JsonViajeDetalle[0]->gastos_extras;
       $data_insert_viaje_detalle['costo_total_viaje'] = $JsonViajeDetalle[0]->costo_total_viaje;
       $data_insert_viaje_detalle['saldo_para_gastos'] = $JsonViajeDetalle[0]->saldo_para_gastos;
       $data_insert_viaje_detalle['shipping_total'] = $JsonViajeDetalle[0]->sumatoria_shipping;
       $data_insert_viaje_detalle['pesolibra_total'] = $JsonViajeDetalle[0]->sumatoria_peso_libras;
        
        return $data_insert_viaje_detalle;
    }

}

