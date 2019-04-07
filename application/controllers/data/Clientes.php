<?php

/**
 * Description of Clientes
 *
 * @author C_GGUTIERREZ
 */
class Clientes extends CI_Controller{
    
    
    public function __construct() {
        parent::__construct();
        if(!isset($this->session->username)):
             redirect('/');
         endif;
        $this->load->library('form_validation');
        $this->load->helper("security");
        $this->template->add_css('css/datatables/dataTables.bootstrap.min.css');
        $this->template->add_js('js/clientes/clientes.js');
        $this->template->add_js('js/datatables/jquery.dataTables.min.js');
        $this->template->add_js('js/datatables/dataTables.bootstrap.min.js');
        $this->load->model('data/Clientes_model');
    }
    
    public function index(){
        $this->template->set('titulo', 'INGRESO DE CLIENTES');
         $data['ClientesObject'] = $this->Clientes_model->GetAllClientes();
//         var_dump($res_clientes);die;
//         echo $res_clientes;die;
         $this->template->load(5, 'data/v_clientes',$data);
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
                header("Location: " . base_url().'index.php/data/Clientes');
            }else{
                echo "ERROR EN INSERTAR";
            }
            
        }
    }
    
   
}
