<?php
/**
 * Description of Clientes_model
 *
 * @author C_GGUTIERREZ
 */
class Productos_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
        
        
    }
    
    public function GetAllProductos(){
        
         $res =  $this->db->get('producto');
         return $res;
//         return $this->db->last_query();
        
    }
    
    public function GetNextId(){
        
        $this->db->select('codigo');
        $this->db->from('producto');
        $this->db->order_by("codigo", "DESC");
        $this->db->limit(1);
        return $this->db->get()->row()->codigo;
    }
    
    public function RegistrarNuevoProducto($data){
        $this->db->set($data);
        return (bool)$this->db->insert('producto');
//        return $this->db->last_query();
    }
    
}
