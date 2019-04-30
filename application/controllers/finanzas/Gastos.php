<?php
/**
 * Description of Gastos
 *
 * @author C_GGUTIERREZ
 */
class Gastos extends CI_Controller{
    
    
    public function __construct() {
        parent::__construct();
        if(!isset($this->session->username)):
             redirect('/');
         endif;
        $this->load->model('finanzas/Gastos_model');
        $this->template->add_css('css/datatables/dataTables.bootstrap.min.css');
        $this->template->add_js('js/datatables/jquery.dataTables.min.js');
        $this->template->add_js('js/datatables/dataTables.bootstrap.min.js');
    }
    
    function index(){
        
        $this->template->add_js('js/bootstrap-datepicker/bootstrap-datepicker.min.js');
        $this->template->add_css('css/bootstrap-datepicker/bootstrap-datepicker.min.css');
        $this->template->add_js('js/app/finanzas/gastos.js');
        $this->template->set('titulo', 'GASTOS');
        
        $data['listado_gastos'] = $this->Gastos_model->ObtenerGastos();
        $data['total_dolares'] = $this->Gastos_model->ObtenerTotales('USD');
//        var_dump($data['total_dolares']);die;
        $data['total_soles'] = $this->Gastos_model->ObtenerTotales('PEN');
        
        
        
        $this->template->load(7, 'finanzas/v_gastos',$data);
        
    }
    
    
    function Registrar(){
        $_POST['fecha'] = (new DateTime($_POST['fecha']))->format('Y-m-d');
        $res =  $this->Gastos_model->InsertarGastos($_POST);
        if($res === TRUE){
              header("Location: " . base_url() . 'index.php/finanzas/Gastos');
        }else{
              header("Location: " . base_url());
        }
    }
}
