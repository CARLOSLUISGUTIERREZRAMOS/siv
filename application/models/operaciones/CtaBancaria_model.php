<?php

class CtaBancaria_model extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
    }

    public function GetDataCtasBancarias()
    {
        $query = $this->db->get_where('cuentas_bancarias', array('estado' => 'Y'));
        return $query;
    }
}
