<?php

/**
 * Description of Viaje
 *
 * @author C_GGUTIERREZ
 */
class Viaje extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!isset($this->session->username)):
            redirect('/');
        endif;
        $this->template->add_js('js/jquery/jquery.slimscroll.min.js');
        $this->template->add_css('css/bootstrap-datepicker/bootstrap-datepicker.min.css');
        //ACTIVANDO EL CHECKBOX CSS
        $this->template->add_css('css/skins/_all-skins.min.css');
        $this->template->add_css('css/skins/all.css');
        $this->template->add_css('css/lte/AdminLTE.min.css');
        //FIN ACTIVANDO EL CHECKBOX CSS

        $this->template->add_js('js/bootstrap-datepicker/bootstrap-datepicker.min.js');
        $this->template->add_js('js/lte/dashboard.js');
        $this->template->add_js('js/datatables/jquery.dataTables.min.js');
        $this->template->add_js('js/datatables/dataTables.bootstrap.min.js');
        $this->template->add_js('js/ichecked/icheck.min.js');
        $this->template->add_js('js/app/operaciones/viajeros.js');
        $this->template->add_js('js/plugins/input-mask/jquery.inputmask.js');
        $this->template->add_js('js/plugins/input-mask/jquery.inputmask.numeric.extensions.js');
        $this->load->library('form_validation');
        $this->load->helper("security");
        $this->load->helper("tiempos");
        $this->load->helper("viaje");
        $this->template->add_css('css/datatables/dataTables.bootstrap.min.css');
        $this->load->model('operaciones/Viaje_model');
        $this->load->model('data/Aerolinea_model');
        $this->load->model('operaciones/Pedidos_model');
        $this->load->model('data/Productos_model');
    }

    public function index() {
        $this->template->set('titulo', 'VIAJE');

        $data['lista_aerolineas'] = $this->Aerolinea_model->GetAllAreolineas();
        $data['lista_viajeros'] = $this->Viaje_model->GetAllViaje();

//        $JsonPedidosViaje = ArmarJsonPedidosDetalles($PedidosDetalle);
//        echo "<pre>";
//        var_dump($JsonPedidosViaje);
//        echo "</pre>";die;
        $this->template->load(null, 'viajeros/v_viajeros', $data);
    }

    public function VerDetalleViaje() {


        $codigo_viaje = $_GET['codigo_viaje'];
        $viaje_procesado_isset = $this->Viaje_model->ComprobarExisteViajeProcesado($codigo_viaje);
        if ($viaje_procesado_isset) {
            $this->template->set('titulo', 'Detalle de viaje procesado');

            $data['detalle_viaje'] = $this->Viaje_model->ObtenerListaTuPedidoViajeProcesado($codigo_viaje);
            $data['detalle_viaje_list_prod'] = $this->Viaje_model->GetDetalleProductosViajeProcesado($codigo_viaje);


            $this->template->load(2, 'viajeros/v_detalle_viaje_procesado', $data);
        } else {
            $this->template->set('titulo', 'Detalle de viaje');
            $data['lista_aerolineas'] = $this->Aerolinea_model->GetAllAreolineas();
            $data['DetalleViaje'] = $this->Viaje_model->GetDetalleViaje($codigo_viaje);
            $PedidosDetalle = $this->Pedidos_model->ObtenerPedidoDetalleViaje();
            $data['JsonPedidosViaje'] = ArmarJsonPedidosDetalles($PedidosDetalle);
            $data['StockProducto'] = ObtenerStockProductos($PedidosDetalle);
            $this->template->load(2, 'viajeros/v_detalle', $data);
        }
    }

    public function Registrar() {

        $xss_post = $this->input->post(NULL, TRUE);
        $fecha_post = fecha_iso_8601($xss_post['fecha_envio']);
        $xss_post['fecha_envio'] = (new DateTime($fecha_post))->format('Y-m-d');
        $resultado_insert = $this->Viaje_model->RegistrarViaje($xss_post);

        if ((bool) $resultado_insert === TRUE) {
            $this->session->set_flashdata('msg_viajero', 'Se registro la recepcion');
            $this->session->set_flashdata('INSERTO', $resultado_insert);
            redirect("/operaciones/Viaje");
        } else {
            $this->session->set_flashdata('msg_viajero', 'Ocurrio un error');
            $this->session->set_flashdata('INSERTO', $resultado_insert);
            redirect("/operaciones/Viaje");
        }
    }

    public function Recepcionar() {

        $xss_post = $this->input->post(NULL, TRUE);

        $id = $xss_post['id'];

        $fecha_recepcion = fecha_iso_8601($xss_post['fecha_recepcion']);
        $maletas_recepcionadas = $xss_post['maletas_recepcionadas'];
        $cant_maletas_enviadas = $this->Viaje_model->ObtenerMaletasEnviadas($id);

        $maletas_observadas = $cant_maletas_enviadas - $maletas_recepcionadas;

        $data = array('fecha_recepcion' => $fecha_recepcion,
            'maletas_recepcionadas' => $maletas_recepcionadas,
            'maletas_observadas' => $maletas_observadas);

        $resultado_upd = $this->Viaje_model->Recepcionar_model($data, $id);
        if ($resultado_upd) {
            $this->session->set_flashdata('msg_viajero', 'Se registro la recepcion');
            $this->session->set_flashdata('INSERTO', $resultado_upd);
            redirect("/operaciones/Viaje");
        }
    }

    function RecibirData() {

        $viaje_id = $_POST['viaje_id'];
        $JsonViajePedidoDetalle = json_decode($_POST['json_viaje_has_pedido_detalle']);
        $JsonViajeDetalle = json_decode($_POST['json_viaje_detalle']);

        $data_insert_viaje_detalle = FormarInsertTblViajeDetalle($viaje_id, $JsonViajeDetalle);
//        var_dump($data_insert_viaje_detalle);
        $this->Viaje_model->RegistrarViajeDetalle($data_insert_viaje_detalle);
        foreach ($JsonViajePedidoDetalle as $item) {
            $data_insert_viaje_has_pedido_detalle = array();
            $data_insert_viaje_has_pedido_detalle['viaje_id'] = $viaje_id;
            $data_insert_viaje_has_pedido_detalle['pedido_detalle_id'] = $item->pedido_detalle_id;
            $data_insert_viaje_has_pedido_detalle['pedido_detalle_pedido_codigo'] = $item->pedido_codigo;
            $data_insert_viaje_has_pedido_detalle['pedido_detalle_pedido_cliente_codigo'] = $item->cliente_codigo;
            $data_insert_viaje_has_pedido_detalle['pedido_detalle_producto_codigo'] = $item->producto_codigo;
            $data_insert_viaje_has_pedido_detalle['cantidad_envio'] = $item->cantidad;
            $data_insert_viaje_has_pedido_detalle['shipping'] = $item->shipping;
            $data_insert_viaje_has_pedido_detalle['pesolibra'] = $item->pesolibra;

            $cantidad_stock_actual = $this->Productos_model->ObtenerCantidadStockProducto($item->producto_codigo);
            $this->Productos_model->ActualizarStockActualProducto($item->cantidad, $cantidad_stock_actual, $item->producto_codigo);

            $res_insert = $this->Viaje_model->RegistrarViajeHasPedidoDetalle($data_insert_viaje_has_pedido_detalle);

            $cantidad_requerida = (int) $item->cantidad_requerida;
            $cantidad_envio = (int) $item->cantidad;
            echo $cantidad_requerida . ' ...' . $cantidad_envio;
            if ($cantidad_requerida === $cantidad_envio) {
                $estado_pedido_detalle = 'EN';
            } else if ($cantidad_envio < $cantidad_requerida) {
                $estado_pedido_detalle = 'EP';
            }
            $this->Pedidos_model->CambiarEstadoPedidoDetalle($item->pedido_codigo, $item->pedido_detalle_id, $estado_pedido_detalle);
            $this->Pedidos_model->CambiarEstadoPedido($item->pedido_codigo, 'EP');

            if ($res_insert) {
                $this->session->set_flashdata('INSERTO', TRUE);
                $this->session->set_flashdata('msg_viajero', 'Se registro la informacion ingresada para el viaje ' . $viaje_id);
            }
        }
    }

}
