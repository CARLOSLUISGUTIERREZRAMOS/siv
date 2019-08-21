<?php
//ICONOS
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
if (!function_exists('calcularCostoUnitarioTotal')) {
    function calcularCostoUnitarioTotal($costoUnitarioProducto,$shippingUnitario)
    {
      return $costoUnitarioProducto + $shippingUnitario;
    }
}
if (!function_exists('calcularCostoTotalProducto')) {
    function calcularCostoTotalProducto($cantidad,$costoUnitarioTotal)
    {
      return $costoUnitarioTotal * $cantidad;
    }
}
