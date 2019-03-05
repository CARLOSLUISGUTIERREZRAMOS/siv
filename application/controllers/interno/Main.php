<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->load->model('adm/usuario_model');
        isset($this->session->username) ? $this->createObjUserSess($this->session->username) : redirect('/');
    }

    public function index() {

        $this->template->set('titulo', 'PRINCIPAL');
        $this->template->load(null, 'main/v_main');
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
