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

    function Recepcionar_model($data,$id) {

        $this->db->where('id', $id);
        return $this->db->update('viaje', $data);
    }
    
    public function ObtenerMaletasEnviadas($id){
        $query = $this->db->get_where('viaje', array('id' => $id), 1);
        return $query->row()->maletas_enviadas;
    }
    
    public function ObtenerDataDetalleViaje($id){
        $this->db->select('nombres_viajero,apellidos_viajero,A.nombre');
        $this->db->from('viaje V');
        $this->db->join('aerolinea A', 'A.id = V.aerolinea_id');
        $this->db->where('id', $id);
        return $this->db->get()->row();
        
        
    }

}
