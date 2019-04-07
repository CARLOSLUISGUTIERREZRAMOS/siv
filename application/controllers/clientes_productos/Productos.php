<?php

/**
 * Description of Productos
 *
 * @author C_GGUTIERREZ
 */
class Productos extends CI_Controller{
    
    
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper("security");
        $this->template->add_css('css/datatables/dataTables.bootstrap.min.css');
        $this->template->add_js('js/clientes/clientes.js');
        $this->template->add_js('js/datatables/jquery.dataTables.min.js');
        $this->template->add_js('js/datatables/dataTables.bootstrap.min.js');
        $this->load->model('clientes_productos/Productos_model');
    }
    
    public function index(){
        
        
        
        
        $this->template->set('titulo', 'INGRESO DE PRODUCTOS');
         $data['ProductosObject'] = $this->Productos_model->GetAllProductos();
//         var_dump($res_clientes);die;
//         echo $res_clientes;die;
         $last_id = (int)$this->Productos_model->GetNextId();
         $data['codigo_nuevo'] = $this->GenerarCodigoNuevo($last_id);
         
         $this->template->load(5, 'clientes_productos/v_productos',$data);
    }
    
    private function GenerarCodigoNuevo($last_id){
        return $last_id+1;
    }
    
    public function Registro(){
        
        
        if (!$this->form_validation->run() == FALSE) {
               header("Location: " . base_url());
//             echo "<script>$('#v_modal_error').modal('show')</script>";
        } else {
            $xss_post = $this->input->post(NULL, TRUE);
            $data = array(
              'nombre'  => $xss_post['nombre_producto'],
              'costo_unitario'  => $xss_post['costo_unitario'],
            );
            $res = $this->Productos_model->RegistrarNuevoProducto($data);
            if($res === TRUE){
                header("Location: " . base_url().'clientes_productos/Productos');
            }else{
                echo "ERROR EN INSERTAR";
            }
            
        }
    }
    
   
}
