<?php

/**
 * Description of Clientes
 *
 * @author C_GGUTIERREZ
 */
class Clientes extends CI_Controller{
    
    
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper("security");
        $this->template->add_css('css/datatables/dataTables.bootstrap.min.css');
        $this->template->add_js('js/clientes/clientes.js');
        $this->template->add_js('js/datatables/jquery.dataTables.min.js');
        $this->template->add_js('js/datatables/dataTables.bootstrap.min.js');
        $this->load->model('clientes_productos/Clientes_model');
    }
    
    public function index(){
        $this->template->set('titulo', 'INGRESO DE CLIENTES');
         $data['ClientesObject'] = $this->Clientes_model->GetAllClientes();
         $last_id = (int)$this->Clientes_model->GetNextId();
         $data['codigo_nuevo'] = $this->GenerarCodigoNuevo($last_id);
         
         $this->template->load(5, 'clientes_productos/v_clientes',$data);
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
              'nombres'  => $xss_post['nombres_cliente'],
              'apellidos'  => $xss_post['apellido_cliente'],
              'telefono'  => $xss_post['telefono_cliente'],
              'email'  => $xss_post['email_cliente']
            );
            $res = $this->Clientes_model->RegistrarNuevoCliente($data);
            if($res === TRUE){
                header("Location: " . base_url().'clientes_productos/Clientes');
            }else{
                echo "ERROR EN INSERTAR";
            }
            
        }
    }
    
   
}
