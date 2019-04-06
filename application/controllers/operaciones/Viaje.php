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
        $this->template->add_css('css/bootstrap-datepicker/bootstrap-datepicker.min.css');
        //ACTIVANDO EL CHECKBOX CSS
        $this->template->add_css('css/skins/all.css');
        $this->template->add_css('css/skins/_all-skins.min.css');
        $this->template->add_css('css/lte/AdminLTE.min.css');
        //FIN ACTIVANDO EL CHECKBOX CSS

        $this->template->add_js('js/bootstrap-datepicker/bootstrap-datepicker.min.js');
        $this->template->add_js('js/lte/dashboard.js');
        $this->template->add_js('js/datatables/jquery.dataTables.min.js');
        $this->template->add_js('js/datatables/dataTables.bootstrap.min.js');
        $this->template->add_js('js/ichecked/icheck.min.js');
        $this->template->add_js('js/jquery/jquery.slimscroll.min.js');
        $this->template->add_js('js/app/operaciones/viajeros.js');
        $this->load->library('form_validation');
        $this->load->helper("security");
        $this->load->helper("tiempos");
        $this->load->helper("viaje");
        $this->template->add_css('css/datatables/dataTables.bootstrap.min.css');
        $this->load->model('operaciones/Viaje_model');
        $this->load->model('data/Aerolinea_model');
        $this->load->model('operaciones/Pedidos_model');
    }

    public function index() {
        $this->template->set('titulo', 'VIAJE');


        $data['lista_viajeros'] = $this->Viaje_model->GetAllViaje();
        $data['lista_aerolineas'] = $this->Aerolinea_model->GetAllAreolineas();
        $PedidosDetalle = $this->Pedidos_model->ObtenerPedidoDetalleViaje();

        $JsonPedidosViaje = ArmarJsonPedidosDetalles($PedidosDetalle);
        foreach($JsonPedidosViaje as $key => $value){
            echo $key ;
            echo $value->nombre;
        }
        

        $this->template->load(null, 'viajeros/v_viajeros', $data);
        $this->load->view('viajeros/v_detalle', $data);
    }

    public function Registrar() {

        $xss_post = $this->input->post(NULL, TRUE);
        $fecha_post = $xss_post['fecha_envio'];
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

    //Funcion solo ejecutada por un usuario con rol de administrador
    public function VerDetalle() {
        $id = $_POST['id'];
//        $this->Viaje_model->ObtenerDataDetalleViaje($id);
    }

}
