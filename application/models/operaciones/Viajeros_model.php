<?php

/**
 * Description of Pedidos_model
 *
 * @author C_GGUTIERREZ
 */
class Viajeros_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function GetAllViajeros() {
        $this->db->select('*');
        $this->db->from('viajeros');
        $this->db->order_by("fecha_envio", "DESC");
        return $this->db->get();
    }

    function RegistrarViajeros($data) {
        $this->db->set($data);
        return (bool) $this->db->insert('viajeros');
//        return $this->db->last_query();
    }

    function ActualizarViajero($data,$id) {
        $this->db->where('id', $id);
        $res_upd = $this->db->update('viajeros', $data);
//        return $this->db->last_query();
        return $res_upd;
        
    }

}
