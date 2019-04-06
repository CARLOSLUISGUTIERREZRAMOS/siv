<?php

/**
 * Description of Pedidos_model
 *
 * @author C_GGUTIERREZ
 */
class Pedidos_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function GetLastId() {
        $this->db->select('codigo');
        $this->db->from('pedido');
        $this->db->order_by("codigo", "DESC");
        $this->db->limit(1);
        return $this->db->get();
    }

    function IngresarPedido($data) {
        $hora_sistema = (new DateTime())->format('Y-m-d h:i:s');
        $this->db->set('fecha_pedido', $hora_sistema);
        $this->db->set($data);
        $this->db->insert('pedido');
        $insert_id = $this->db->insert_id();
        return $insert_id;
//        return $this->db->last_query();
    }

    function ObtenerTipoCambioPedido($fecha_pedido) {
        $this->db->select('tipo_cambio_compra');
        $this->db->from('tax');
        $this->db->where('fecha_ingreso', $fecha_pedido);
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    function ObtenerPedido($codigo) {
        $this->db->select('pedido.*,tax.tipo_cambio_compra');
        $this->db->from('pedido');
        $this->db->where('codigo', $codigo);
        $this->db->join('tax', 'tax.id = pedido.tax_id');
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    function GetAllPedidos() {
        $this->db->select('P.codigo,C.nombres,P.cliente_codigo,P.presupuesto_x_compra,P.estado,P.saldo,P.precio_total');
        $this->db->from('pedido P');
        $this->db->join('cliente C', 'P.cliente_codigo = C.codigo');
        $this->db->order_by("P.codigo", "DESC");
        return $this->db->get();
    }

    function ObtenerPedidoDetalle($pedido_id) {
        $this->db->select('PD.producto_codigo,PR.nombre,PR.stock_actual,PD.cantidad,'
                . 'PD.costo_unitario_producto,PD.peso_libras,PD.shipping_unitario,'
                . 'PD.ganancia_unitaria,'
                . 'PD.precio_unitario_usd,PD.precio_total,PR.estado,'
                . 'PD.pendiente_compra,PD.stock_producto_flag');
        $this->db->from('pedido_detalle PD');
        $this->db->join('producto PR', 'PD.producto_codigo = PR.codigo');
        $this->db->where('pedido_codigo', $pedido_id);

//        $this->db->join('cliente C', 'P.cliente_codigo = C.codigo');
//        $this->db->order_by("P.codigo", "DESC");
        return $this->db->get();
    }

    function ObtenerPedidoDetalleViaje() {
        $this->db->select('P.codigo,PD.cantidad,PR.nombre,PD.shipping_unitario,PD.peso_libras');
        $this->db->from('pedido_detalle PD');
        $this->db->join('producto PR', 'PD.producto_codigo = PR.codigo');
        $this->db->join('pedido P', 'P.codigo = PD.pedido_codigo');
        $this->db->where('PD.estado', 'EP');
        $this->db->where('P.estado', 'VT');
        $this->db->where('PR.estado', 'Y');

//        $this->db->join('cliente C', 'P.cliente_codigo = C.codigo');
//        $this->db->order_by("P.codigo", "DESC");
        return $this->db->get();
    }

    function RegistrarPresupuestoParaCompra($cod_pedido, $presupuesto_para_compra) {
        $this->db->where('codigo', $cod_pedido);
        return $this->db->update('pedido', array('presupuesto_x_compra' => $presupuesto_para_compra));
    }

    function RegistrarPedidoDetalle($data) {
        $this->db->set($data);
        $this->db->insert('pedido_detalle');
//        return $this->db->last_query();
    }

    function ActualizarSaldoACobrar($pedido_id, $saldo_a_cobrar) {
        $this->db->set('saldo', $saldo_a_cobrar);
        $this->db->where('codigo', $pedido_id);
        $result = $this->db->update('pedido');
        return $result;
    }

}
