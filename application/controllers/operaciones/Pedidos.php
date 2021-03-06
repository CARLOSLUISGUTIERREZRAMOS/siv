<?php

class Pedidos extends CI_Controller
{

    protected $presupuesto_por_compra;

    public function __construct()
    {

        parent::__construct();
        if (!isset($this->session->username)) :
            redirect('/');
        endif;
        $this->load->model('data/Clientes_model');
        $this->load->helper(array('pedido', 'ctabancarias', 'procesos', 'productos', 'calculos'));
        $this->load->model(array('data/Productos_model', 'data/Cuentas_bancarias_model', 'operaciones/Pedidos_model', 'operaciones/Abono_model', 'finanzas/Tax_model'));
        $this->template->add_js('js/datatables/jquery.dataTables.min.js');
        $this->template->add_js('js/bootstrap-datepicker/bootstrap-datepicker.min.js');
        $this->template->add_js('js/datatables/dataTables.bootstrap.min.js');
        $this->template->add_js('js/app/operaciones/pedido.js',true);
        $this->template->add_js('js/sweetalert2/sweetalert2.min.js', true);
        $this->template->add_js('js/app/operaciones/pedido_detalle.js', true);
        $this->template->add_css('css/sweetalert2/sweetalert2.min.css', true);
        $this->template->add_css('css/sweetalert2/styles.css', true);
        $this->template->add_css('css/app/pedido_detalle.css', true);
        $this->template->add_css('css/bootstrap-datepicker/bootstrap-datepicker.min.css', true);
    }

    public function index()
    {
        $tax_cargado = $this->Tax_model->VerificarExisteTipoCambioDelDia();
        if ($tax_cargado) {

            $this->template->set('titulo', 'SISTEMA');
            $data['Clientes']                   =       $this->Clientes_model->GetAllClientes();
            $data['Productos']                  =       $this->Productos_model->GetAllProductos();
            $data['NewCodPedido']               =       $this->ObtenerNuevoCodigoPedido();
            $data['costo_libra_today']          =       $this->Tax_model->ObtenerCostoLibraDelDia();
            $data['tipo_cambio_compra_today']   =       $this->Tax_model->ObtenerTipoCambioDelDia()->tipo_cambio_compra;
            $this->template->load(1, 'pedidos/v_anadir_producto', $data);
        } else {
            redirect("interno/Main", 'refresh');
        }
    }

    public function RegistrarPedido()
    {
        echo $this->Pedidos_model->IngresarPedido($_POST);
    }

    function CalcularSumatoriaAbonos($abonos_data, $tipo_cambio)
    {

        foreach ($abonos_data->Result() as $abono) {
            //           echo $abono->tipo_moneda;
            //           echo $abono->tipo_moneda;
        }
    }


    public function VerDetallePedido($renderiza = NULL)
    {
        
        $this->template->set('titulo', '');

        $codigo_pedido      =       (!is_null($renderiza)) ? $renderiza : $_GET['codigo_pedido'];
        $data['pedido']     =       $this->Pedidos_model->ObtenerPedido($codigo_pedido);
        $cantidad_abonos    =       $this->Abono_model->ObtenerCantidadDeAbonos($codigo_pedido);

        if ($cantidad_abonos > 0) {

            $data['EXISTE_ABONO']   = TRUE;
            $data['sum_abono_usd']  = $this->Abono_model->SumarAbonosExistentes($codigo_pedido,'monto');
            $data['sum_abono_pen']  = $this->Abono_model->SumarAbonosExistentes($codigo_pedido,'monto_pen');
            $data['SALDO_TOTAL']    = (float) $data['pedido']->precio_total - $data['sum_abono_usd'];

        } 
       
        $fecha_sql                  =               (new DateTime($data['pedido']->fecha_pedido))->format('Y-m-d');
        $data['abonos']             =               $this->Abono_model->ObtenerAbonosPedido($codigo_pedido);
        $data['tipo_cambio']        =               $this->Pedidos_model->ObtenerTipoCambioPedido($fecha_sql)->tipo_cambio_compra;
        $data['tc_today']           =               $this->Tax_model->ObtenerTipoCambioDelDia()->tipo_cambio_compra;
        $data['cuentas_bancarias']  =               $this->Cuentas_bancarias_model->GetCuentasBancarias();
        $data['pedido_detalle']     =               $this->Pedidos_model->ObtenerPedidoDetalle($codigo_pedido);
        $data['presupuestoCompra']  =               $this->obtenerPresupuestoCompra($data['pedido_detalle']);
        $data['presupuestoEnvio']   =               $this->obtenerPresupuestoEnvio($data['pedido_detalle']);
        $data['precioTotalPedido']  =               $this->CalcularPrecioTotalDePedido($data['pedido_detalle']);
        $data['saldoPorCobrar']     =               $this->CalcularSaldoPorCobrar($data['precioTotalPedido'], $data['sum_abono_usd']);

        if (!is_null($renderiza)) {

            $this->load->view('pedidos/v_modal_editar_pedido');
            $this->load->view('pedidos/v_modal_agregar_producto');
            return $this->load->view('pedidos/v_lista_pedido_detalle', $data, true);

        } else {

            $this->load->view('pedidos/v_modal_editar_pedido');
            $this->load->view('pedidos/v_modal_agregar_producto');
            $this->template->load(10, 'pedidos/v_lista_pedido_detalle', $data);

        }
    }

    private function CalcularPrecioTotalDePedido($dataPedidoDetalle)
    {
        $precioTotalPedido = 0;
        foreach ($dataPedidoDetalle->Result() as $campo) {
            $precioTotalPedido += (float) $campo->precio_total;
        }
        return round($precioTotalPedido, 2);
    }


    private function CalcularSaldoPorCobrar($precioTotalPedido, $sumAbonos)
    {
        return $precioTotalPedido - $sumAbonos;
    }

    public function ObtenerAbono()
    {
        // $numAbono = $_POST['numAbono'];
        // $codigoPedido = $_POST['codigoPedido'];
        // $res = $this->Pedidos_model->GetAbono($numAbono,$codigoPedido);
        // $data_vista['dataAbonoPedido'] = $res;
        // $this->template->load(10, 'pedidos/v_modal_editar_pedido', $data_vista);
        $res = $this->load->view('pedidos/v_modal_editar_pedido', false, true);
        var_dump($res);
    }
    function obtenerPresupuestoEnvio($dataPedidoDetalle)
    {
        $presupuestoEnvio = 0;
        foreach ($dataPedidoDetalle->Result() as $row) {
            $presupuestoEnvio += $row->shipping_unitario * $row->stock_producto_flag;
        }
        return $presupuestoEnvio;
    }
    function obtenerPresupuestoCompra($dataPedidoDetalle)
    {
        $presupuestoCompra = 0;
        foreach ($dataPedidoDetalle->Result() as $row) {
            $presupuestoCompra += $row->pendiente_compra * $row->costo_unitario_producto;
        }
        return $presupuestoCompra;
    }


    function GuardarAbonos()
    {
        $data = [];
        $JsonDataAbono      = $_POST['json'];
        $cliente_codigo     = $_POST['pedido_cliente_codigo'];
        $codigo_pedido      = $_POST['codigo_pedido'];
        $saldo_por_cobrar   = $_POST['saldo_por_cobrar'];
        $ObjAbono           = json_decode($JsonDataAbono);

        foreach ($ObjAbono as $abono) {
            $res = $this->Abono_model->VerificarExisteNumeroAbonoRegistrado($abono->numero_abono, $codigo_pedido);
            if ($res === 0) {
                $res_insert = $this->Abono_model->RegistrarAbonoDePedido($abono->numero_abono, $abono->monto, $codigo_pedido, $cliente_codigo, $abono->cuenta_id, $abono->monto_usd, $abono->moneda);
                if ($res_insert) {
                    $this->session->set_flashdata('EXITO', TRUE);
                    $data[] = 'Se registro abono N° ' . $abono->numero_abono;
                } else {
                    $data[] = 'Ocurrió un error en el registro del abono N° ' . $abono->numero_abono . ' con número de pedido ' . $codigo_pedido;
                    $this->session->set_flashdata('EXITO', FALSE);
                }
            }
        }


        $res_upd_saldo_a_cobrar = $this->Pedidos_model->ActualizarSaldoACobrar($codigo_pedido, $saldo_por_cobrar);
        if ($res_upd_saldo_a_cobrar) {
            $this->session->set_flashdata('EXITO', TRUE);
            $data['saldo_a_cobrar'] = 'Se actualizo el saldo a cobrar';
        } else {
            $this->session->set_flashdata('EXITO', FALSE);
            $data['saldo_a_cobrar'] = $res_upd_saldo_a_cobrar;
        }
        $this->session->set_flashdata('data_ingresada', $data);
    }

    function CrearPedido()
    {
        $calculo_presupuesto_para_compra = 0;
        //        $presupuesto_para_compra = 0;
        $JsonDataPedido = $_POST['json'];
        $ObjPedido = json_decode($JsonDataPedido);

        $data_insert_pedido = array(
            'cliente_codigo'        => $ObjPedido->cliente_codigo,
            'shipping_total'        => $ObjPedido->shipping_total,
            'costos_totales'        => $ObjPedido->costos_totales,
            'precio_total'          => $ObjPedido->precio_total,
            'saldo'                 => $ObjPedido->saldo,
            'costo_x_libra'         => $ObjPedido->costo_x_libra,
            'presupuesto_x_compra'  => $ObjPedido->presupuesto_x_compra,
            'presupuesto_x_envio'   => $ObjPedido->presupuesto_x_envio,
            'tax_id'                => $this->Tax_model->ObtenerTipoCambioDelDia()->id
        );

        $pedido_codigo = $this->Pedidos_model->IngresarPedido($data_insert_pedido);

        foreach ($ObjPedido->detalle_pedido as $producto) {
            $stock_act_producto = $this->Productos_model->ObtenerCantidadStockProducto($producto->codigo_producto);
            $pendiente_compra = $this->ObtenerPendienteDeCompra($stock_act_producto, $producto->cantidad);

            $data_insert_pedido_detalle = array(
                'pedido_codigo'             => $pedido_codigo,
                'pedido_cliente_codigo'     => $ObjPedido->cliente_codigo,
                'producto_codigo'           => $producto->codigo_producto,
                'cantidad'                  => $producto->cantidad,
                'costo_unitario_producto'   => $producto->costo_unitario_producto,
                'peso_libras'               => $producto->peso_libras,
                'shipping_unitario'         => $producto->shipping_unitario,
                'pendiente_compra'          => $pendiente_compra,
                'ganancia_unitaria'         => $producto->ganancia_unitaria,
                'precio_unitario_usd'       => $producto->precio_unitario_usd,
                'precio_unitario_pen'       => $producto->precio_unitario_pen,
                'precio_total'              => $producto->precio_total,
                'stock_producto_flag'       => $stock_act_producto
            );

            $res_insert_pedido_detalle = $this->Pedidos_model->RegistrarPedidoDetalle($data_insert_pedido_detalle);
            $calculo_presupuesto_para_compra += $this->CalcularPresupuestoParaCompra($pendiente_compra, $producto->costo_unitario_producto);
            //            $this->Productos_model->ActualizarStockActualProducto($producto->cantidad, $stock_act_producto, $producto->codigo_producto);
        }

        $REGISTRO_DE_ABONO = ((float) $ObjPedido->abono > 0) ? TRUE : FALSE;
        if ($REGISTRO_DE_ABONO) {
            $res_registro_abono_pedido = $this->Abono_model->RegistrarAbonoDePedido($ObjPedido->abono, $pedido_codigo, $ObjPedido->cliente_codigo, 2, $ObjPedido->abono, 'USD');
            echo "RegAbono" . var_dump($res_registro_abono_pedido);
        }
        $res_registro_presupuesto_para_compra = $this->Pedidos_model->RegistrarPresupuestoParaCompra($pedido_codigo, $calculo_presupuesto_para_compra);
        $this->session->set_flashdata('nuevo_pedido', $pedido_codigo);
    }

    public function CalcularPresupuestoParaCompra($pendiente_compra, $costo_unitario_producto)
    {

        return ((float) $costo_unitario_producto * $pendiente_compra);
    }

    public function EliminarAbono()
    {
        $id_pedido = $_POST['codigopedido'];
        $id_abono = $_POST['idabono'];
        $camposSet = array('estado' => 'N');
        $this->Abono_model->ActualizarAbonoDePedido($id_abono, $id_pedido, $camposSet);
        // $this->session->set_flashdata('msg', 'Abono eliminado. ');
        $vista = $this->VerDetallePedido($id_pedido);
        echo $vista;
    }

    public function ObtenerPendienteDeCompra($stock_act_producto, $cant_producto_req)
    {

        if ((int) $stock_act_producto < (int) $cant_producto_req) {
            return $cant_producto_req - $stock_act_producto;
        }
        return 0;
    }

    public function ObtenerNuevoCodigoPedido()
    {

        $ResModel_IdPedido = $this->Pedidos_model->GetLastId();
        foreach ($ResModel_IdPedido->result() as $pedido) {

            $id_codigo = (empty($pedido->codigo)) ? 0 : (int) $pedido->codigo;
            //            var_dump($id_codigo);
        }

        $id_codigo = (isset($id_codigo)) ? $id_codigo : 0;
        return $id_codigo + 1;
    }

    //Genera un numero de pedido ficticio.
    public function CreaPedido()
    {

        $ResModel_IdPedido = $this->Pedidos_model->GetLastId();
        foreach ($ResModel_IdPedido->result() as $pedido) {
            $id_codigo = (empty($pedido->codigo)) ? 0 : (int) $pedido->codigo;
        }
        return $id_codigo = (isset($id_codigo)) ? $id_codigo : 0;
    }

    public function ListarPedidos($renderiza = FALSE)
    {

        $this->template->set('titulo', 'Listado de Pedidos');
        $data['pedidos']        =       $this->Pedidos_model->GetAllPedidos('PEDIDO');
        $data['controlador']    =       'Pedidos';
        
        if($renderiza){
            
            return $this->load->view('pedidos/v_lista_pedidos', $data, true);

        }else{
            $this->template->load(10, 'pedidos/v_lista_pedidos', $data);
        }
    }

    public function EliminarProductoPedido()
    {
        $id = $_POST['pedido_detalle_id'];
        $codigo_pedido = $_POST['codigo_pedido'];
        $res_upd = $this->Pedidos_model->EliminarProductoPedido($id);

        echo $this->VerDetallePedido($codigo_pedido);
    }
    public function ModificarAbono()
    {
        $setMonto           =       [];

        $pedidoCodigo       =       $_POST['pedidoCodigo'];
        $idAbono            =       $_POST['idabono'];
        $cuentaBancaria     =       $_POST['select_cuentas'];
        $montoAbono         =       $_POST['montoAbono'];
        $tipoCambio         =       $_POST['tipoCambio'];

        $condiciones_modelo_ctasBancarias = array('id' => $cuentaBancaria);
        $resDataCtaBancaria = $this->Cuentas_bancarias_model->GetDetalleCtaBancaria(
                                                            $condiciones_modelo_ctasBancarias);
        if ($resDataCtaBancaria->tipo_moneda === 'PEN') {
            //APLICAMOS EL CAMBIO
            $setMonto['monto_pen']      =       $montoAbono;
            $montoAbono                 =       (float) $montoAbono / $tipoCambio;
            $setMonto['monto']          =       round($montoAbono, 2);
        } else {
            $setMonto['monto']          =       $montoAbono;
            $montoAbonoPen              =       (float) $montoAbono * (float) $tipoCambio;
            $setMonto['monto_pen']      =       round($montoAbonoPen, 2);
        }
        $setMonto['cuentas_bancarias_id']   =       $cuentaBancaria;
        $bool_upd                           =       $this->Abono_model->ActualizarAbonoDePedido($idAbono, 
                                                                                                $pedidoCodigo, $setMonto);

        $vista                              =       $this->VerDetallePedido($_POST['pedidoCodigo']);

        echo $vista;
        
    }

    public function AgregarAbono()
    {

        $monto = $_POST['montoAddAbono'];
        $id_ctabancaria = $_POST['select_cuentas'];
        $codigo_pedido = $_POST['codigo_pedido'];
        $cliente_codigo = $_POST['cliente_codigo'];
        $condicion = array('id' => $id_ctabancaria);
        $data_ctaBancaria = $this->Cuentas_bancarias_model->GetDetalleCtaBancaria($condicion);
        $tipoMoneda = $data_ctaBancaria->tipo_moneda;
        $data_insert = array(
            'pedido_codigo' => $codigo_pedido, 'pedido_cliente_codigo' => $cliente_codigo,
            'cuentas_bancarias_id' => $id_ctabancaria, 'fecha' => date('Y-m-d H:i:s')
        );
        switch ($tipoMoneda) {
            case 'USD':
                $data_insert['monto']  = $monto;
                break;
            case 'PEN':
                $data_insert['monto_pen']  = $monto;
                break;
        }

        $res_insert_abono = $this->Abono_model->InsertarAbono($data_insert);

        if ($res_insert_abono) {
            $vista = $this->VerDetallePedido($codigo_pedido);
            echo $vista;
        } else {
            echo 'error!';
        }
    }

    public function AgregarProductoPedido()
    {
        $_POST['producto_codigo'] = explode('|',$_POST['producto_codigo'])[0];
        $stockProducto = $this->Productos_model->ObtenerCantidadStockProducto($_POST['producto_codigo']);
        $pendienteCompra = $this->ObtenerPendienteDeCompra($stockProducto,$_POST['cantidad']);
        $_POST['pendiente_compra'] = $pendienteCompra;
        $_POST['stock_producto_flag'] = $stockProducto;
        $this->Pedidos_model->AgregarProductoPedido($_POST);
        $vista                  =               $this->VerDetallePedido($_POST['pedido_codigo']);
        echo $vista;
    }
    public function ModificarCantidadDeProducto()
    {
        $pedido_codigo                  =               $_POST['pedido_codigo'];
        $id_pedido_detalle              =               $_POST['idPedidoDetalle'];
        $cant_productos                 =               $_POST['cantidad'];

        $this->Pedidos_model->ActualizarCantidadDeProducto($id_pedido_detalle,$cant_productos);
        $vista                  =               $this->VerDetallePedido($pedido_codigo);
        echo $vista;
    }

    public function EliminarPedido()
    {

        $codigo_pedido          =           $_POST['codigo_pedido_ajax'];
        $res_del                =           $this->Pedidos_model->EliminarPedido($codigo_pedido);
        
        if($res_del)
        {

            $renderiza          =           TRUE;
            $vista_ajax         =           $this->ListarPedidos($renderiza);
            echo $vista_ajax;

        }
        else{

            echo FALSE;

        }

    }

}
