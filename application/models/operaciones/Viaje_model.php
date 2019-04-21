<?php

/**
 * Description of Pedidos_model
 *
 * @author C_GGUTIERREZ 
 */
class Viaje_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function GetAllViaje() {
        $this->db->select('viaje.*,aerolinea.nombre');
        $this->db->from('viaje');
        $this->db->join('aerolinea', 'viaje.aerolinea_id = aerolinea.id');
        $this->db->order_by("id", "DESC");
        return $this->db->get();
    }

    function RegistrarViaje($data) {
        $this->db->set($data);
        return (bool) $this->db->insert('viaje');
//        return $this->db->last_query();
    }

    function Recepcionar_model($data, $id) {

        $this->db->where('id', $id);
        return $this->db->update('viaje', $data);
    }

    public function ObtenerMaletasEnviadas($id) {
        $query = $this->db->get_where('viaje', array('id' => $id), 1);
        return $query->row()->maletas_enviadas;
    }

    public function GetDetalleViaje($id) {
        $this->db->select('V.id,nombres_viajero,apellidos_viajero,A.nombre,maletas_enviadas');
        $this->db->from('viaje V');
        $this->db->join('aerolinea A', 'A.id = V.aerolinea_id');
        $this->db->where('V.id', $id);
        return $this->db->get()->row();
    }

    function RegistrarViajeDetalle($data) {
        $this->db->set($data);
        return (bool) $this->db->insert('viaje_detalle');
//        $this->db->insert('viaje_detalle');
//           return $this->db->last_query();
    }

    function RegistrarViajeHasPedidoDetalle($data) {
        $this->db->set($data);
//        return (bool) $this->db->insert('viaje_has_pedido_detalle');
        $this->db->insert('viaje_has_pedido_detalle');
//         $this->db->insert('viaje_has_pedido_detalle');
         return $this->db->last_query();
    }

    function ComprobarExisteViajeProcesado($viaje_id) {
        $query = $this->db->get_where('viaje_detalle', array('viaje_id' => $viaje_id), 1);

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    
    function ObtenerListaTuPedidoViajeProcesado($id_viaje){
          $this->db->select('*');
          $this->db->from('viaje_detalle');
          $this->db->where('viaje_id', $id_viaje);
          $this->db->limit(1);
          return $this->db->get()->row();
    }
    function GetDetalleProductosViajeProcesado($id_viaje) {
        $this->db->select('VHD.*,P.nombre as nombre_producto');
        $this->db->from('viaje_has_pedido_detalle VHD');
        $this->db->join('producto P','VHD.pedido_detalle_producto_codigo=codigo');
        $this->db->where('viaje_id', $id_viaje);
        return $this->db->get();
    }

}
