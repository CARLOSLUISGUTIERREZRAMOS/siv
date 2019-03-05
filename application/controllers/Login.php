<?php

class Login extends CI_Controller {

    private $codUser;
    private $passUser;

    function __construct() {
        parent::__construct();
//        $this->load->model('adm/usuario_model');
        $this->load->library('form_validation');
        $this->load->library('Seguridad/Password');
        $this->load->model("adm/usuario_model");
    }

    function index() {


        $this->form_validation->set_rules('codigoUsuario', 'CODIGO USUARIO', 'required');
        $this->form_validation->set_rules('password', 'CONTRASEÑA', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login/v_login');
        } else {
            $xss_post = $this->input->post(NULL, TRUE);
            $usuarioValido = $this->usuario_model->verificaUsuario($xss_post['codigoUsuario']);
            if ($usuarioValido) {
                $res = $this->password->validarPassword($xss_post['password'], '$2y$10$3ogGt6bedniV5zZ17ggd.eFWd9kC6QXJjbK0n5Z1T9ni73.Cc9hg.');
                if ($res) {
                    $this->setDatosSesion($xss_post['codigoUsuario']);
                    redirect('interno/main');
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
