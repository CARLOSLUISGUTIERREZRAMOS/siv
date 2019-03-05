<?php
class Pedidos extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
       $this->template->set('titulo', 'SISTEMA');
        $this->template->load(1, 'pedidos/v_pedidos');
    }
    
}
