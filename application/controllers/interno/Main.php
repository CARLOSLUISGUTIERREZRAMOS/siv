<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct() {

        parent::__construct();
        
        $this->template->add_js('js/app/finanzas/tipo_cambio.js');
        $this->load->model('adm/usuario_model');
        $this->load->model('adm/usuario_model');
        $this->load->model('finanzas/Tax_model');
        isset($this->session->username) ? $this->createObjUserSess($this->session->username) : redirect('/');
    }

    public function index() {

        $this->template->set('titulo', 'PRINCIPAL');
        $data['tipo_cambio'] = $this->ObtenerTipoCambioDelDia();
        
//        var_dump($data['tipo_cambio']);die;
        $data['costo_x_libra'] = $this->ObtenerCostoPorLibraDelDia();
        $this->template->load(null, 'main/v_main',$data);
        
    }

    public function ObtenerTipoCambioDelDia(){
        $existe_tipo_cambio_del_dia =  $this->Tax_model->VerificarExisteTipoCambioDelDia();
        if($existe_tipo_cambio_del_dia){
            $tipo_cambio = $this->Tax_model->ObtenerTipoCambioDelDia();
        }else{
           $tipo_cambio = 'SIN FIJAR';
        }
        return $tipo_cambio;
       
    }
    public function ObtenerCostoPorLibraDelDia(){
        $existe_tipo_cambio_del_dia =  $this->Tax_model->VerificarExisteTipoCambioDelDia();
        if($existe_tipo_cambio_del_dia){
            $costo_x_libra = $this->Tax_model->ObtenerCostoPorLibraDelDia();
        }else{
           $costo_x_libra = 'SIN FIJAR';
        }
        return $costo_x_libra;
    }
    
    public function logout() {

        $this->session->unset_userdata('username');
        redirect('/');
    }

    private function createObjUserSess($codUser) {
        $this->usuario_model->createObjUser($codUser);
        $this->session->set_userdata(array('id_usuario' => $this->usuario_model->getId_usuario()));
        $this->session->set_userdata(array('nombre' => $this->usuario_model->getNombre()));
        $this->session->set_userdata(array('apellido' => $this->usuario_model->getApellido()));
        $this->session->set_userdata(array('rol' => $this->usuario_model->getRol()));
        $this->session->set_userdata(array('email' => $this->usuario_model->getEmail()));
    }

}
