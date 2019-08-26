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
if (!function_exists('calcularPrecioTotal')) {
  function calcularPrecioTotal($cantidad,$precioUnitarioDeVenta)
  {
    return $cantidad * $precioUnitarioDeVenta;
  }
}
if (!function_exists('calcularSaldoPorCobrar')) {
  function calcularSaldoPorCobrar($sumatoriaPrecioTotal,$totalAbonos)
  {
    return $sumatoriaPrecioTotal - $totalAbonos;
  }
}
