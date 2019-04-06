<?php

class Cuentas_bancarias_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    function GetCuentasBancarias(){
        return $this->db->get('cuentas_bancarias');
    }
}
