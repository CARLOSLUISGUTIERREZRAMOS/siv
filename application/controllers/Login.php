<?php

class Login extends CI_Controller {

    private $codUser;
    private $passUser;

    function __construct() {
        parent::__construct();
//        $this->load->model('adm/usuario_model');
        $this->load->library('form_validation');
        $this->load->library('Seguridad/Password');
        $this->load->model("adm/Usuario_model");
    }

    function index() {


        $this->form_validation->set_rules('codigoUsuario', 'CODIGO USUARIO', 'required');
        $this->form_validation->set_rules('password', 'CONTRASEÑA', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login/v_login');
        } else {
            $xss_post = $this->input->post(NULL, TRUE);
            $usuarioValido = $this->Usuario_model->verificaUsuario($xss_post['codigoUsuario']);
            if ($usuarioValido) {
                $pass_db =  $this->Usuario_model->GetPassUser($xss_post['codigoUsuario']);
                $res = $this->password->validarPassword($xss_post['password'], $pass_db);
                if ($res) {
                    $this->setDatosSesion($xss_post['codigoUsuario']);
                    redirect('interno/Main');
                } else {
                    redirect('/');
                }
            }
            redirect('/');
        }
    }

    public function muestraMensajePosRegistro($data) {

        $data['varCondicionModal'] = $data;
        $this->load->view('login/v_login', $data);
    }

    private function setDatosSesion($username) {
        $this->session->name;
        $this->session->set_userdata(array('username' => $username));
    }

}