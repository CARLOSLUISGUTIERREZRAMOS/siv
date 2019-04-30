<?php

/**
 * Description of Gastos_model
 *
 * @author C_GGUTIERREZ
 */
class Gastos_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    //put your code here
    function InsertarGastos($data) {
        $this->db->set($data);
        return (bool) $this->db->insert('gastos');
    }
    
    function ObtenerGastos(){
        $this->db->select('*');
        $this->db->from('gastos');
//        $this->db->where('*');
//        $this->db->order_by('fecha','asc');
        
        return $this->db->get();
    }
    
    function ObtenerTotales($tipo){
        $this->db->select_sum('importe');
        $this->db->where('moneda',$tipo);
//        return $this->db->get('gastos')->row()->SUMA; 
        return $this->db->get('gastos')->row()->importe; 
    }

}
