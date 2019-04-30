<?php

/**
 * Description of Clientes_model
 *
 * @author C_GGUTIERREZ
 */
class Productos_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function GetAllProductos() {

        $res = $this->db->get('producto');
        return $res;
//         return $this->db->last_query();
    }

    public function GetCostoUnitario($codigo_producto) {
        $this->db->select('costo_unitario,peso');
        $this->db->from('producto');
        $this->db->where("codigo", $codigo_producto);
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    public function GetNextId() {

        $this->db->select('*');
        $this->db->from('producto');
        $this->db->order_by("codigo", "DESC");
        $this->db->limit(1);
        return $this->db->get()->row()->codigo;
    }

    public function RegistrarNuevoProducto($data) {
        $this->db->set($data);
        return (bool) $this->db->insert('producto');
//        return $this->db->last_query();
    }

    public function ObtenerCantidadStockProducto($cod_producto) {
        $res_query = $this->db->get_where('producto', array('codigo' => $cod_producto), 1);
        return $res_query->row()->stock_actual;
    }

    public function AgregarAStockActual($cantidad_agregar, $cod_producto) {
        $stock_actual = $this->ObtenerCantidadStockProducto($cod_producto);
//        return $stock_actual;
        $cantidad_actualizada = (int) $cantidad_agregar + (int) $stock_actual;

        $this->db->where('codigo', $cod_producto);
        return $this->db->update('producto', array('stock_actual' => $cantidad_actualizada));
    }

    public function ActualizarStockActualProducto($cantidad_solicitada, $stock_actual,$cod_producto) {
        $resultado = $stock_actual - $cantidad_solicitada;

        if ($resultado > 0) {
            $stock_set = $resultado;
        } else {
            $stock_set = 0;
        }
        $this->db->where('codigo', $cod_producto);
        return $this->db->update('producto', array('stock_actual' => $stock_set));
//        $this->db->update('producto', array('stock_actual' => $stock_set));
//        return $this->db->last_query();
        
//        return true;
    }
    
    public function GuardarDetalleDeCompra($producto_codigo,$cantidad,$monto,$fecha_compra){
        
        $this->db->set('producto_codigo',$producto_codigo);
        $this->db->set('cantidad',$cantidad);
        $this->db->set('precio',$monto);
        $this->db->set('fecha_compra',$fecha_compra);
        $res_insert = $this->db->insert('compra');
        return $res_insert;
        
    }

}
