<?php
/**
 * Description of Clientes_model
 *
 * @author C_GGUTIERREZ
 */
class Clientes_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
        
        
    }
    
    public function GetAllClientes(){
        
         $res =  $this->db->get('cliente');
         return $res;
//         return $this->db->last_query();
        
    }
    
    public function RegistrarNuevoCliente($data){
        $this->db->set($data);
        return (bool)$this->db->insert('cliente');
//        return $this->db->last_query();
    }
    
}
