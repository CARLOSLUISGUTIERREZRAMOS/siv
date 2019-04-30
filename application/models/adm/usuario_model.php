<?php

if (!defined('BASEPATH'))
    exit('No permitir el acceso directo al script');

class Usuario_Model extends CI_Model {

    private $id_usuario;
    private $nombre;
    private $apellido;
    private $nombre_cargo;
    private $rol;
    private $email;

    public function __construct() {
        parent::__construct();
        $this->load->library('Seguridad/Password');
    }

    public function GetPassUser($codUsuario) {
        $this->db->select('pass');
        $res = $this->db->get_where('usuario', array('codigo' => $codUsuario), 1);
        return $res->row()->pass;
    }

    public function registra($data) {
        $res = $this->db->insert('usuario', $data);
        if ($res == FALSE) {
            return $this->db->error();
        } else {
            return $res;
        }
    }

    public function ActivaDesactUsuario($codUsuario = NULL, $CharAccion, $id_usuario = NULL) {
        $data = array('estado' => "$CharAccion");
        if (!is_null($id_usuario)) {
            $this->db->where('id_usuario', $id_usuario);
        } else {
            $this->db->where('codigo', $codUsuario);
        }
        $this->db->update('usuario', $data);
    }

    public function verificaUsuario($codigoUsuario) {

        $query = $this->db->get_where('usuario', array('codigo' => $codigoUsuario, 'estado' => 'Y'), 1);
        return (bool) $query->num_rows();
    }

    public function verificaUsuarioAgente_sqlserver($codagente_post) {

        $query = "SELECT TOP 1 Codigo FROM Agentes WHERE Codigo = $codagente_post";
        $resultado = $this->connection_sqlserver->getConexion()->Execute($query);
        return $resultado;
    }

    public function validaPassword($codUser, $pass) {

        $this->db->select('pass');
        return $this->db->get_where('usuario', array('codigo' => $codUser))->row()->pass;
    }

    public function createObjUser($codUsuario) {

        $this->db->select('id_usuario,nombre,apellido,rol,email');
        $res = $this->db->get_where('usuario', array('codigo' => $codUsuario), 1);
        foreach ($res->result() as $user) {
            $this->id_usuario = $user->id_usuario;
            $this->nombre = $user->nombre;
            $this->apellido = $user->apellido;
            $this->rol = $user->rol;
            $this->email = $user->email;
        }
    }

    public function ListaUsuarios() {
        $query = $this->db->get('usuario');
        return $query;
    }

    public function GetUsuarios_in($id_usuarios) {
        $this->db->select('id_usuario,email,nombre,apellido');
        $this->db->from('usuario');
        $where = "id_usuario IN($id_usuarios)";
        $this->db->where($where);
        $this->db->where('estado', 'Y');
        $query = $this->db->get();

        return $query;
    }

    function GetDataUsuario($id) {

        $this->db->select('email');
        $where = "id_usuario IN($id)";
        return $this->db->get_where('usuario', $where)->row()->email;
    }

    public function getEstado($id) {
        $this->db->select('estado');
        $res = $this->db->get_where('usuario', array('id_usuario' => $id), 1)->row()->estado;

        return $res;
    }

    //<editor-fold desc="METODOS GET" defaultstate="collapsed">
    function getId_usuario() {
        return $this->id_usuario;
    }

    function getNombre() {
        return $this->nombre;
//        $this->db->select('codigo');
//        return $this->db->get_where('usuario', array('id_usuario' => $id_usuario), 1)->row()->codigo;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getNombre_cargo() {
        return $this->nombre_cargo;
    }

    function getRol() {
        return $this->rol;
    }

    function getEmail() {
        return $this->email;
    }

    //</editor-fold>
}
