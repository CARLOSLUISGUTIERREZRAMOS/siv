<?php

class Pedidos extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('clientes_productos/Clientes_model');
        $this->load->model('clientes_productos/Productos_model');
        $this->load->model('clientes_productos/Pedidos_model');
    }

    public function index() {
        $this->template->set('titulo', 'SISTEMA');

        $data['Clientes'] = $this->Clientes_model->GetAllClientes();
        $data['Productos'] = $this->Productos_model->GetAllProductos();
        $data['NewCodPedido'] = $this->ObtenerNuevoCodigoPedido();
        
        $this->template->load(1, 'pedidos/v_anadir_producto', $data);
    }

    public function ObtenerNuevoCodigoPedido() {

        $ResModel_IdPedido = $this->Pedidos_model->GetLastId();
        foreach ($ResModel_IdPedido->result() as $pedido) {

            $id_codigo = (empty($pedido->id)) ? 0 : (int) $pedido->id;
//            var_dump($id_codigo);
        }
        
        $id_codigo = (isset($id_codigo)) ? $id_codigo : 0;
        return $id_codigo + 1;
    }
    public function CreaPedido() {

        $ResModel_IdPedido = $this->Pedidos_model->GetLastId();
        foreach ($ResModel_IdPedido->result() as $pedido) {

            $id_codigo = (empty($pedido->id)) ? 0 : (int) $pedido->id;
//            var_dump($id_codigo);
        }
        
        return $id_codigo = (isset($id_codigo)) ? $id_codigo : 0;
    }

}
