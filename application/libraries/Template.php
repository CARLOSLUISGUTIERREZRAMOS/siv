<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {
    
    
    var $styles = "";
    var $scripts = "";
    var $template_data = array();
    var $template_layout = 'templates/layout';
    
    function set($name, $value){
        $this->template_data[$name] = $value;
    }
    
    function add_css($pathfile){
        $this->styles.= link_tag($pathfile);
    }
    function add_js($pathfile){
        $this->scripts.= script_tag($pathfile);
        
    }
    function load($id_formulario, $view = '' , $view_data = array(), $return = FALSE){ 
        
        $this->CI =&get_instance();
        $model = &get_instance();
        $model->load->model('adm/formulario_model');
        $res = (is_null($id_formulario)) ? $id_formulario : $model->formulario_model->obtenerSecuenciaRuta($id_formulario);
        $this->set('contents', $this->CI->load->view($view, $view_data, TRUE));
        $this->set('data_ubicacion', $res);
        $this->template_data['styles'] = $this->styles;
        $this->template_data['scripts'] = $this->scripts;
        return $this->CI->load->view($this->template_layout, $this->template_data, $return);
    }
    
    
    function load_menu($id_usuario){       
        
        $lib = &get_instance();
        $lib->load->helper('generamenu_helper');
        $this->CI =&get_instance();
        $model = &get_instance();
        $model->load->model("adm/grupo_model");
        $model->load->model("adm/formulario_model");
        $grupos = $model->grupo_model->obtener_grupos($id_usuario,$id_usuario);
        $html['menu'] = helpv17Grupo_generaMenuPrincipal($grupos,$id_usuario);
        return $this->CI->load->view("templates/menu",$html);
        
    }
    
     function load_header(){   
//        $this->CI =&get_instance();
//        $model = &get_instance();
//        $model->load->model("login_model");
//        $data_usuario['nombre_usuario'] =$model->login_model->obtener_nombre_usuario();
//        $data_usuario['datos'] =$model->login_model->pintar_datos_usuario();
//        return $this->CI->load->view("templates/header",$data_usuario);
        return $this->CI->load->view("templates/header");
    }
    
    function load_footer(){
        return $this->CI->load->view("templates/footer");
    }

}
?>