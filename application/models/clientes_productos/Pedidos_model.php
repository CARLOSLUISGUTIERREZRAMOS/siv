<?php

/**
 * Description of Pedidos_model
 *
 * @author C_GGUTIERREZ
 */
class Pedidos_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function GetLastId() {
        $this->db->select('id');
        $this->db->from('pedido');
        $this->db->order_by("id", "DESC");
        $this->db->limit(1);
        return $this->db->get();
    }

}
