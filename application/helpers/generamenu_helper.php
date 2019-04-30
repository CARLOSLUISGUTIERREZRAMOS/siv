<?php
//ICONOS
if (!defined('BASEPATH')){exit('No direct script access allowed');}
if (!function_exists('armaMenu_Grupo')) {
    //creamos la funcion y no explico mas sobre que es cada linea por que eso ya es otro tema.
        function helpv17Grupo_generaMenuPrincipal($grupos,$id_usuario) {
            $menu = '';
            foreach($grupos->result() as $grupo){
                    $CI = get_instance();
                    $CI->load->model('formulario_model');
                    $formularios = $CI->formulario_model->obtener_formularios($grupo->id_grupo,$id_usuario);
                    
                    $menu.= '<li class="treeview">'."\n";
                    $menu.= '<a href="#">'."\n";
                    $menu.= '<i class="'. $grupo->icon_grupo.'"></i><span>'.$grupo->nombre_grupo.'</span>'."\n";
                    $menu.= '<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>'."\n";
                    $menu.= '</a>'."\n";
                    $menu.= extraeSubmenuForm_nivel1($formularios);
                    $menu.= '</li>'."\n";
            }
            
            return $menu;
    }
}
        function extraeSubmenuForm_nivel1($formularios) {
            $submenu = '';
                    $submenu.= '<ul  class="treeview-menu">'."\n";
                    foreach ($formularios->result() as $formulario){
                        /* SI EN LA DB EL CAMPO 'nivel1' SE ESTABLECE EN '1' Y EL CAMPO 'id_formulario_n1' ESTA EN '(NULL)' 
                           SIGNIFICA QUE ESE FORMULARIO ES LA CABECERA Y PRESENTA OTRO SUBNIVEL, POR LO CUAL ENTRA EN ESTA CONDICION: */
                            
                        if($formulario->nivel1 == 1 && $formulario->id_formulario_n1 == null){
                            $icon = $formulario->icon;
                            $submenu .= '<li class="treeview">';
                            $submenu .= '<a href="'.base_url().$formulario->ubicacion_formulario.'">
                                            <i class="'.$icon.'"></i>
                                              <span class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                              </span>
                                            '. utf8_encode(utf8_decode($formulario->nombre_formulario)).'
                                        </a>';
                            $submenu .= '<ul class="treeview-menu">';
                            $submenu .= '<li>';
                            $submenu .= extraeSubmenuForm_nivel2($formularios,$formulario->id_formulario);
                            $submenu .= '</li>';
                            $submenu .= '</ul>';
                            $submenu .= '</li>';
                        /* SI INGRESA POR ESTA CONDICION SIGNIFICA QUE EL FORMULARIO SOLO PRESENTA UN NIVEL (SOLO PERTENECE AL GRUPO) */
                        }elseif(($formulario->nivel1 == 0 && $formulario->id_formulario_n1 == null ) && ($formulario->nivel2 == 0 && $formulario->id_formulario_n2 == null) && ($formulario->nivel3 == 0 && $formulario->id_formulario_n3 == null)){
                            $submenu .= '<li>';
                            $submenu .= '<a class="ruta" href="'.base_url().$formulario->ubicacion_formulario.'">
                                            <i class="'.$formulario->icon.'"></i>'.utf8_encode(utf8_decode($formulario->nombre_formulario)).'
                                        </a>';
                            $submenu .= '</li>';
                        }
                    }
                            $submenu.= '</ul>'."\n";
            return $submenu;
    }
    
    function extraeSubmenuForm_nivel2($formularios,$id_formulario) {
            
            $submenu = '';
            foreach ($formularios->result() as $formulario){
                if($formulario->id_formulario_n1 == $id_formulario){
                    /* SI ENTRA EN ESTA CONDICION SIGNIFICA QUE ESTA FORMULARIO ES UNA CABECERA DE OTRO SUBNIVEL (3)*/
                    if($formulario->nivel2 == 1 && $formulario->id_formulario_n2 == null ){
                        $submenu .= '<li class="treeview">';
                        $submenu .= '<a href="'.base_url().$formulario->ubicacion_formulario.'">
                                       <i class="fa fa-circle-o text-aqua"></i>
                                        '.utf8_encode(utf8_decode($formulario->nombre_formulario)).'
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>';
                        $submenu .= '<ul class="treeview-menu">';
                        $submenu .= '<li>';
                        $submenu .= extraeSubmenuForm_nivel3($formularios,$formulario->id_formulario);
                        $submenu .= '</li>';
                        $submenu .= '</ul>';
                        $submenu .= '<li class="treeview">';
                    }
                    /* SI ENTRA EN ESTA CONDICION SIGNIFICA QUE SOLO ES UN SUBNIVEL (2)*/
                    elseif($formulario->nivel2 == 0 && $formulario->nivel1 != 0){
                        $icon_submenu2 = $formulario->icon;
                        $submenu.='<a href="'.base_url().$formulario->ubicacion_formulario.'"><i class="'.$icon_submenu2.'"></i>'.utf8_encode(utf8_decode($formulario->nombre_formulario)).'</a>'."\n";
                    }
                           
                }
        }
        return $submenu;
    }
    
    function extraeSubmenuForm_nivel3($formularios,$id_formulario) {
            $submenu = '';
            foreach ($formularios->result() as $formulario){
                if($id_formulario==$formulario->id_formulario_n2){
                        if($formulario->nivel3 == 1 && $formulario->id_formulario_n3 == null){
                            $submenu .= '<li class="treeview">';
                            $submenu .= '<a href="'.base_url().$formulario->ubicacion_formulario.'">
                                          <i class="'.$formulario->icon.'"></i>'.utf8_encode(utf8_decode($formulario->nombre_formulario)).'
                                            <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>';
                            $submenu .= '<ul class="treeview-menu">';
                            $submenu .= '<li>';
                            $submenu .= extraeSubmenuForm_nivel4($formularios,$formulario->id_formulario);
                            $submenu .= '</li>';
                            $submenu .= '</ul>';
                            $submenu .= '<li class="treeview">';
                        }elseif($formulario->nivel3 == 0 &&  $formulario->id_formulario_n2 != 0){
                            $submenu.='<a href="'.base_url().$formulario->ubicacion_formulario.'"><i class="fa fa-circle-o text-yellow"></i>'.utf8_encode(utf8_decode($formulario->nombre_formulario)).'</a>'."\n";
                        }
                        
                }
        }
        return $submenu;
    }
    
    function extraeSubmenuForm_nivel4($formularios,$id_formulario) {
            $submenu = '';
            foreach ($formularios->result() as $formulario){
                if($id_formulario==$formulario->id_formulario_n3){
                        
                            $submenu.='<a href="'.base_url().$formulario->ubicacion_formulario.'"><i class="'.$formulario->icon.'"></i>'.utf8_encode(utf8_decode($formulario->nombre_formulario)).'</a>'."\n";
                        
                }
        }
        return $submenu;
    }
