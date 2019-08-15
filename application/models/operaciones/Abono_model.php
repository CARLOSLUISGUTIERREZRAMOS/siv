<?php

class Abono_model extends CI_Model {

    protected $date;

    public function __construct() {
        parent::__construct();
        $this->date = (new DateTime())->format('Y-m-d');
    }

    function RegistrarAbonoDePedido($numero_abono, $monto_abono, $pedido_codigo, $pedido_cliente_codigo, $cuentas_bancarias_id, $abono_usd, $moneda) {

        if ($moneda == 'PEN') {
            $this->db->set('monto_pen', $monto_abono);
            $this->db->set('monto', $abono_usd);
        } else {
            //DEFAULT USD
            $this->db->set('monto_pen', 0.00);
            $this->db->set('monto', $abono_usd);
        }
        $this->db->set('numero_abono', $numero_abono);
        $this->db->set('pedido_codigo', $pedido_codigo);
        $this->db->set('pedido_cliente_codigo', $pedido_cliente_codigo);
        $this->db->set('pedido_cliente_codigo', $pedido_cliente_codigo);
        $this->db->set('cuentas_bancarias_id', $cuentas_bancarias_id);
        $this->db->set('fecha', $this->date);
        $result = $this->db->insert('abono');
//        return $this->db->last_query();
        return $result;
    }

    // function ActualizarAbonoDePedido($numero_abono, $pedido_codigo, $cuentas_bancarias_id) {
    function ActualizarAbonoDePedido($numero_abono, $pedido_codigo, $camposSet) {

        $this->db->set($camposSet);
        $this->db->where('numero_abono', $numero_abono);
        $this->db->where('pedido_codigo', $pedido_codigo);
        $result = $this->db->update('abono');
//        return $this->db->last_query();
        return $result;
    }

    function VerificarExisteNumeroAbonoRegistrado($numero_abono, $pedido_codigo) {

        $this->db->select('*');
        $this->db->from('abono');
        $this->db->where('pedido_codigo', $pedido_codigo);
        $this->db->where('numero_abono', $numero_abono);
        $this->db->limit(1);
        return $this->db->get()->num_rows();
    }

    function ObtenerAbono($numero_abono_solicitado = NULL, $pedido_codigo, $condicion) {
        $this->db->select('numero_abono,monto');
        $this->db->from('abono');
        $this->db->where('pedido_codigo', $pedido_codigo);
        switch ($condicion) {
            case 'INICIAL':
                $this->db->limit(1);
                $this->db->where('numero_abono', $numero_abono_solicitado);
                return $this->db->get()->row();
//                return $this->db->last_query();
                break;
        }
    }

    function ObtenerAbonosPedido($pedido_codigo) {
        $this->db->select('abono.*,CB.numero_cuenta,CB.titular,CB.banco,CB.tipo_moneda');
        $this->db->from('abono');
        $this->db->where('pedido_codigo', $pedido_codigo);
        $this->db->where('abono.estado', 'Y');
        $this->db->join('cuentas_bancarias CB', 'abono.cuentas_bancarias_id = CB.id', 'left');
        $this->db->order_by('numero_abono', 'ASC');
        $resultado = $this->db->get();
//        return $this->db->last_query();
        return $resultado;
    }

    function ObtenerUltimoNumeroAbono($pedido_codigo) {
        $this->db->select('numero_abono');
        $this->db->from('abono');
        $this->db->where('pedido_codigo', $pedido_codigo);
        $this->db->order_by('numero_abono', 'DESC');
        $this->db->limit(1);
        return $this->db->get()->row()->numero_abono;
    }

    function ObtenerCantidadDeAbonos($pedido_codigo) {
        $this->db->select('*');
        $this->db->from('abono');
        $this->db->where('pedido_codigo', $pedido_codigo);
        return $this->db->get()->num_rows();
    }

    function SumarAbonosExistentes($pedido_codigo) {
        $this->db->select_sum('monto');
        $this->db->where('pedido_codigo', $pedido_codigo);
        $this->db->where('estado', 'Y');
        $res_suma_abonos = $this->db->get('abono');
        return $res_suma_abonos->row()->monto;
    }

    function GetAbonos($campo) {
        $this->db->select_sum($campo);
        $this->db->from('abono');
        return $this->db->get()->row()->$campo;
    }

    function GetAbonosSumRangoFecha($fecha,$moneda) {
            //SELECT sum(monto) 
            //FROM db_siv.abono
            //where 
            //fecha between '2019-04-19' and '2019-04-20' 
        $this->db->select_sum($moneda);
        $this->db->from('abono');
        $this->db->where('fecha >=',$fecha);
        $this->db->where('abono <=', $fecha);
        return $this->db->get();
    }
   

}
