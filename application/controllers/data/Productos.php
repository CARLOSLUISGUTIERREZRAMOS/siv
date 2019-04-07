<?php

/**
 * Description of Productos
 *
 * @author C_GGUTIERREZ
 */
class Productos extends CI_Controller {

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
        $this->load->model('data/Productos_model');
    }

    public function index() {

        $this->template->set('titulo', 'INGRESO DE PRODUCTOS');
        $data['ProductosObject'] = $this->Productos_model->GetAllProductos();
//         var_dump($res_clientes);die;
//         echo $res_clientes;die;
        $last_id = (int) $this->Productos_model->GetNextId();
        $data['codigo_nuevo'] = $this->GenerarCodigoNuevo($last_id);

        $this->template->load(6, 'data/v_productos', $data);
    }

    private function GenerarCodigoNuevo($last_id) {
        return $last_id + 1;
    }

    public function Registro() {

        if (!$this->form_validation->run() == FALSE) {
            header("Location: " . base_url());
//             echo "<script>$('#v_modal_error').modal('show')</script>";
        } else {
            $xss_post = $this->input->post(NULL, TRUE);
            $data = array(
                'nombre' => $xss_post['nombre_producto'],
                'costo_unitario' => $xss_post['costo_unitario'],
                'peso' => $xss_post['peso_libras']
            );
            $res = $this->Productos_model->RegistrarNuevoProducto($data);
            if ($res === TRUE) {
                header("Location: " . base_url() . 'index.php/data/Productos');
            } else {
                echo "ERROR EN INSERTAR";
            }
        }
    }

    public function ObtenerCostoUnitario() {
        $codigo_producto = (int) $_POST['codigo_producto'];
        $costo_unitario = $this->Productos_model->GetCostoUnitario($codigo_producto);
        echo $costo_unitario->costo_unitario . '|' . $costo_unitario->peso;
    }

    public function Comprar() {
        $this->template->set('titulo', 'Nueva Compra');
        $data['ProductosObject'] = $this->Productos_model->GetAllProductos();
        
        $this->template->load(9, 'data/v_compras', $data);
    }
    
    public function CargarCompra(){
        
//        print_r($_POST);die;
//        $stock_actual = $this->Productos_model->ObtenerCantidadStockProducto($_POST['cod_producto']);
        $cantidad_producto_agregar = $_POST['cantidad'];
        $cod_producto = $_POST['codigo'];
        $stock_actual = $this->Productos_model->AgregarAStockActual($cantidad_producto_agregar,$cod_producto);
        
//        var_dump($stock_actual);die;
        
        if($stock_actual){
            
            $this->Comprar();
        }
        
    }
    


}
