<?php

/**
 * Description of EnviosParciales
 *
 * @author CGUTIERREZ
 */
class EnviosParciales extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('pedido');
        $this->load->model('operaciones/Pedidos_model');
        $this->template->add_js('js/app/operaciones/pedido.js');
        $this->template->add_css('css/datatables/dataTables.bootstrap.min.css');
        $this->template->add_js('js/datatables/jquery.dataTables.min.js');
        $this->template->add_js('js/datatables/dataTables.bootstrap.min.js');
        $this->load->helper('pedido');
    }

    function Index() {

        $this->template->set('titulo', 'Listado de Pedidos Parciales');

        $data['pedidos'] = $this->Pedidos_model->GetAllPedidos('ENVIO_PARCIAL');
        $data['vincula_env_parciales'] = TRUE;
        $this->template->load(15, 'pedidos/v_lista_pedidos', $data);
    }

   public function EnvioParcialDetalle() {

        $data['codido_pedido'] = $_GET['codigo_pedido'];
        $data['nombre_cliente'] = $_GET['nombre_cliente'];
        $this->template->set('titulo', 'Detalle de Pedido Parcial');
        $data['items_parcial'] = $this->Pedidos_model->GetDataEnviosParciales($data['codido_pedido']);
        
        
//        echo $data['items_parcial'];die;
        $data['total_abonos'] = $this->Pedidos_model->GetSumatoriaAbonos($data['codido_pedido']);
        
        
        $this->template->load(15, 'entrega/v_envios_parciales',$data);

    }

}
