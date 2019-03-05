<?php

class Grupo_model extends CI_Model{
    
    private $id_grupo;
    private $nombre_grupo;
    private $icon_grupo;
    private $orden_grupo;
    private $estado;
    
    public function __construct() {
        parent::__construct();
        
    }
    
    public function obtener_grupos($id_usuario){
        
        $this->db->distinct();
        $this->db->select('G.id_grupo,nombre_grupo,icon_grupo');
        $this->db->join('usuario_has_formulario_grupo as UFG','G.id_grupo = UFG.id_grupo');
        $this->db->order_by("orden_grupo", "ASC");
        $res_grupos = $this->db->get_where('grupo G',array('UFG.id_usuario' => $id_usuario,'G.estado' => 'Y'));
        
        return $res_grupos;
        
    }
    
}