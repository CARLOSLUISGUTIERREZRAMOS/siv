<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Aerolinea_model
 *
 * @author C_GGUTIERREZ
 */
class Aerolinea_model extends CI_Model{
    
    
    public function __construct() {
        parent::__construct();
        
    }
    
    function GetAllAreolineas(){
        $res_query = $this->db->get('aerolinea');
        return $res_query;
    }
}
