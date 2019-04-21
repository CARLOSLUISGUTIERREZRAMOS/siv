<?php

/**
 * Description of Entrega
 *
 * @author CGUTIERREZ
 */
class Entrega extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('operaciones/Pedidos_model');
    }

    function Index() {
        $this->load->helper('pedido');
        $this->template->add_css('css/datatables/dataTables.bootstrap.min.css');
        $this->template->add_js('js/datatables/jquery.dataTables.min.js');
        $this->template->add_js('js/datatables/dataTables.bootstrap.min.js');
        $this->template->set('titulo', 'Listado de Pedidos - Entrega');
        $data['pedidos'] = $this->Pedidos_model->GetAllPedidos('ENTREGA');
        $data['controlador'] = 'Entrega';
        $this->template->load(3, 'pedidos/v_lista_pedidos', $data);
    }
    function VerDetallePedido(){
        
        $this->template->set('titulo', 'Detalle pedido');
        $this->template->load(3, 'entrega/v_entrega');
    }
    

}
