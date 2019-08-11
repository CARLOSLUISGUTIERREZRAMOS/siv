<?php

/**
 * Description of Pedidos_model
 * LOCAL
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

    function GetAllPedidos($tipo) {
        $this->db->select('P.codigo,C.nombres,P.cliente_codigo,P.presupuesto_x_compra,P.estado,P.saldo,P.precio_total');
        $this->db->from('pedido P');
        $this->db->join('cliente C', 'P.cliente_codigo = C.codigo');
        switch ($tipo) {
            case 'PEDIDO':
                $estado = array('VT', 'EP', 'ET', 'RL', 'EN','RQ');
                $this->db->where_in('P.estado', $estado);
                break;
            case 'ENTREGA':
                $estado = array('EP', 'ET', 'RL', 'EN');
                $this->db->where_in('P.estado', $estado);
                break;
            case 'ENVIO_PARCIAL':
                $estado = array('EP'); // SHEILA DIJO ESTO
                $this->db->where_in('P.estado', $estado);
                break;
        }
        $this->db->order_by("P.codigo", "DESC");
        RETURN $this->db->get();

//        return $this->db->last_query();
    }

    function ObtenerPedidoDetalle($pedido_id) {
        $this->db->select('PD.id,PD.producto_codigo,PR.nombre,PR.stock_actual,PD.cantidad,'
                . 'PD.costo_unitario_producto,PD.peso_libras,PD.shipping_unitario,'
                . 'PD.ganancia_unitaria,'
                . 'PD.precio_unitario_usd,PD.precio_total,PR.estado,'
                . 'PD.pendiente_compra,PD.stock_producto_flag,PD.estado');
        $this->db->from('pedido_detalle PD');
        $this->db->join('producto PR', 'PD.producto_codigo = PR.codigo');
        $this->db->where('pedido_codigo', $pedido_id);
        $this->db->where('estado_registro', 'Y');

//        $this->db->join('cliente C', 'P.cliente_codigo = C.codigo');
//        $this->db->order_by("P.codigo", "DESC");
        return $this->db->get();
    }

    function ObtenerPedidoDetalleViaje() {
        $this->db->select('PR.codigo as cod_prod,PD.pedido_cliente_codigo,P.codigo,PD.id,PD.cantidad,PR.nombre,PD.shipping_unitario,PD.peso_libras,PR.stock_actual');
        $this->db->from('pedido_detalle PD');
        $this->db->join('producto PR', 'PD.producto_codigo = PR.codigo');
        $this->db->join('pedido P', 'P.codigo = PD.pedido_codigo');
        $this->db->where('PD.estado', 'EP');
        $this->db->where_in('P.estado', 'RQ');
        $this->db->where('PR.estado', 'Y');

//        $this->db->join('cliente C', 'P.cliente_codigo = C.codigo');
//        $this->db->order_by("P.codigo", "DESC");
        $res = $this->db->get();
//        $res = $this->db->last_query();
        return $res;
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

    function CambiarEstadoPedidoDetalle($pedido_id, $pedido_detalle_id, $estado) {
        $this->db->set('estado', $estado);
        $this->db->where('id', $pedido_detalle_id);
        $this->db->where('pedido_codigo', $pedido_id);
        $result = $this->db->update('pedido_detalle');
        return $result;
    }
    //agregando costo unitario - repo
    function GetDataEnviosParciales($pedido_codigo) {
        $this->db->select(" `PROD`.`nombre`,PROD.costo_unitario,
        `PD`.`precio_unitario_usd` AS `PUV`,
        `PD`.`cantidad` AS `cant_solic`,
        IFNULL(`VPD`.`cantidad_envio`,0) AS cantidad_envio,
        IFNULL((PD.cantidad - VPD.cantidad_envio),0 ) AS cant_pend_envio,
        `PD`.`estado`,
                IFNULL(((PD.cantidad - VPD.cantidad_envio) * PD.costo_unitario_producto),0.00) AS presupuesto_para_compra");
        $this->db->from('pedido P');
        $this->db->join('pedido_detalle PD', 'PD.pedido_codigo = P.codigo');
        $this->db->join('viaje_has_pedido_detalle VPD', 'PD.id = VPD.pedido_detalle_id', 'LEFT');
        $this->db->join('producto PROD', 'PD.producto_codigo = PROD.codigo');
        $this->db->where('P.codigo', $pedido_codigo);
         return $this->db->get();
//         return $this->db->last_query();
    }


    function GetSumatoriaAbonos($codigo_pedido) {

        $this->db->select_sum('monto');
        $this->db->from('abono');
        $this->db->where('pedido_codigo', $codigo_pedido);
        return $this->db->get()->row()->monto;
    }

    function EliminarProductoPedido($pedido_detalle_id){
        $this->db->set('estado_registro', 'N');
        $this->db->where('id', $pedido_detalle_id);
        $result = $this->db->update('pedido_detalle');
        return $result;
     
    }
    function GetAbono($numAbono, $codigoPedido){
        $this->db->select('A.numero_abono,A.fecha,A.monto,A.monto_pen,CB.numero_cuenta,CB.banco,CB.tipo_moneda');
        $this->db->from('pedido P');        
        $this->db->join('ABONO A', 'P.codigo =  A.pedido_codigo');
        $this->db->join('cuentas_bancarias CB', 'A.cuentas_bancarias_id = CB.id');
        $this->db->where('P.codigo', $codigoPedido);
        $this->db->where('P.estado_registro', 'Y');
        $this->db->where('A.numero_abono', $numAbono);
        $res_query = $this->db->get();
        return $res_query->row();
    }

}
