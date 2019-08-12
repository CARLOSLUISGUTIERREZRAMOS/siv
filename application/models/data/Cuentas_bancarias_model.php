<?php

class Cuentas_bancarias_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    function GetCuentasBancarias(){
        return  $this->db->get_where('cuentas_bancarias', array('estado' => 'Y'));
    }
    
    public function GetDetalleCtaBancaria($condiciones)
    {
        $query = $this->db->get_where('cuentas_bancarias', $condiciones);
        return $query->row();
    }

}
