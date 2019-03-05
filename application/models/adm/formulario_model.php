<?php

class Formulario_model extends CI_Model {

    protected $table;

    function __construct() {
        parent::__construct();
        $this->table = 'formulario';
    }

    function obtener_formularios($grupo,$id_usuario) {

        $this->db->select('f.id_formulario, f.icon, f.ubicacion_formulario,f.nombre_formulario,fg.nivel1,fg.id_formulario_n1,fg.nivel2,fg.id_formulario_n2,fg.nivel3,fg.id_formulario_n3,fg.nivel4,fg.id_formulario_n4');
        $this->db->join('formulario f', 'u_fg.id_formulario = f.id_formulario');
        $this->db->join('usuario u', 'u_fg.id_usuario = u.id_usuario');
        $this->db->join('formulario_has_grupo fg', 'f.id_formulario = fg.id_formulario');
        $this->db->join('grupo g', 'fg.id_grupo = g.id_grupo');
        $this->db->order_by("f.orden_formulario", "ASC");
        $res_grupos = $this->db->get_where('usuario_has_formulario_grupo u_fg', array('u_fg.id_usuario' => $id_usuario, 'g.id_grupo' => $grupo, 'f.estado' =>'Y' , 'fg.estado' => 'Y' , 'u.estado' => 'Y' ));

//        return $this->db->last_query();
        return $res_grupos;
        
    }
    
    function obtenerSecuenciaRuta($id_formulario){
        
        $this->db->select('G.icon_grupo,G.nombre_grupo,F.nombre_formulario, FG.id_formulario_n1, id_formulario_n2,id_formulario_n3,id_formulario_n4');
        $this->db->join('grupo G', 'FG.id_grupo = G.id_grupo');
        $this->db->join('formulario F', 'FG.id_formulario = F.id_formulario');
        $data = $this->db->get_where('formulario_has_grupo  FG', array('FG.id_formulario' => $id_formulario))->row();
        
        $html_breadcrumb = '';
        $html_breadcrumb .= $data->icon_grupo.'|';
        $html_breadcrumb .= $data->nombre_grupo.'|';
        
        
        if(!is_null($data->id_formulario_n1)){
            $html_breadcrumb .= $this->obtenerNombreFormulario($data->id_formulario_n1).'|';
        }
        if(!is_null($data->id_formulario_n2)){
            $html_breadcrumb .= $this->obtenerNombreFormulario($data->id_formulario_n2).'|';
        }
        if(!is_null($data->id_formulario_n3)){
            $html_breadcrumb .= $this->obtenerNombreFormulario($data->id_formulario_n3).'|';
        }
        if(!is_null($data->id_formulario_n4)){
            $html_breadcrumb .= $this->obtenerNombreFormulario($data->id_formulario_n4).'|';
        }
        if(!is_null($data->id_formulario_n4)){
            $html_breadcrumb .= $this->obtenerNombreFormulario($data->id_formulario_n4).'|';
        }
        $html_breadcrumb .= $data->nombre_formulario;
        
        return $html_breadcrumb;
    }
    
    private function obtenerNombreFormulario($id_formulario){
        
         $this->db->select('nombre_formulario');
         return $this->db->get_where('formulario', array('id_formulario' => $id_formulario))->row()->nombre_formulario;
         
    }
        
    

}
