<?php

class Pedidos extends CI_Controller {

    protected $presupuesto_por_compra;

    public function __construct() {

        parent::__construct();
        if (!isset($this->session->username)):
            redirect('/');
        endif;
        $this->load->model('data/Clientes_model');
        $this->load->helper('pedido');
        $this->load->model('data/Productos_model');
        $this->load->model('data/Cuentas_bancarias_model');
        $this->load->model('operaciones/Pedidos_model');
        $this->load->model('operaciones/Abono_model');
        $this->load->model('finanzas/Tax_model');
        $this->template->add_js('js/app/operaciones/pedido.js');
        $this->template->add_js('js/bootstrap-datepicker/bootstrap-datepicker.min.js');
        $this->template->add_js('js/datatables/jquery.dataTables.min.js');
        $this->template->add_js('js/datatables/dataTables.bootstrap.min.js');
    }

    public function index() {
        $tax_cargado = $this->Tax_model->VerificarExisteTipoCambioDelDia();
        if ($tax_cargado) {

            $this->template->set('titulo', 'SISTEMA');
            $data['Clientes'] = $this->Clientes_model->GetAllClientes();
            $data['Productos'] = $this->Productos_model->GetAllProductos();
            $data['NewCodPedido'] = $this->ObtenerNuevoCodigoPedido();
            $data['costo_libra_today'] = $this->Tax_model->ObtenerCostoLibraDelDia();
            $data['tipo_cambio_compra_today'] = $this->Tax_model->ObtenerTipoCambioDelDia()->tipo_cambio_compra;
            $this->template->load(1, 'pedidos/v_anadir_producto', $data);
        } else {
            redirect("interno/Main", 'refresh');
        }
    }

    public function RegistrarPedido() {

//        var_dump($_POST);
        echo $this->Pedidos_model->IngresarPedido($_POST);
    }

    function CalcularSumatoriaAbonos($abonos_data, $tipo_cambio) {

        foreach ($abonos_data->Result() as $abono) {
//           echo $abono->tipo_moneda;
//           echo $abono->tipo_moneda;
        }
    }

    public function VerDetallePedido() {
        $this->template->set('titulo', '');
        $codigo_pedido = $_GET['codigo_pedido'];
        $data['pedido'] = $this->Pedidos_model->ObtenerPedido($codigo_pedido);
        $cantidad_abonos = $this->Abono_model->ObtenerCantidadDeAbonos($codigo_pedido);
        if ($cantidad_abonos > 0) {
            $data['EXISTE_ABONO'] = TRUE;
            $data['last_abono'] = $this->Abono_model->ObtenerUltimoNumeroAbono($codigo_pedido);
            $data['sum_abono'] = $this->Abono_model->SumarAbonosExistentes($codigo_pedido);
            $data['SALDO_TOTAL'] = (float) $data['pedido']->precio_total - $data['sum_abono'];
        } else {
            $data['EXISTE_ABONO'] = FALSE;
            $data['last_abono'] = 1;
            $data['sum_abono'] = 0;
            $data['SALDO_TOTAL'] = (float) $data['pedido']->precio_total - $data['sum_abono'];
        }

        $data['abonos'] = $this->Abono_model->ObtenerAbonosPedido($codigo_pedido);
        $fecha_sql = (new DateTime($data['pedido']->fecha_pedido))->format('Y-m-d');
//        echo $fecha_sql;die;
        $data['tipo_cambio'] = $this->Pedidos_model->ObtenerTipoCambioPedido($fecha_sql)->tipo_cambio_compra;
        $data['tc_today'] = $this->Tax_model->ObtenerTipoCambioDelDia()->tipo_cambio_compra;
//        echo $data['tipo_cambio'];die;
        $data['cuentas_bancarias'] = $this->Cuentas_bancarias_model->GetCuentasBancarias();
        $data['pedido_detalle'] = $this->Pedidos_model->ObtenerPedidoDetalle($codigo_pedido);

        $this->template->load(10, 'pedidos/v_lista_pedido_detalle', $data);
    }

    function GuardarAbonos() {
        $data = [];
        $JsonDataAbono = $_POST['json'];
        $cliente_codigo = $_POST['pedido_cliente_codigo'];
        $codigo_pedido = $_POST['codigo_pedido'];
        $saldo_por_cobrar = $_POST['saldo_por_cobrar'];
        $ObjAbono = json_decode($JsonDataAbono);
        foreach ($ObjAbono as $abono) {
            $res = $this->Abono_model->VerificarExisteNumeroAbonoRegistrado($abono->numero_abono, $codigo_pedido);
//            // SI NO EXISTE REGSITRO ENTRA A LA VALIDACION Y SE REGISTRA ABONO
            if ($res === 0) {
                $res_insert = $this->Abono_model->RegistrarAbonoDePedido($abono->numero_abono, $abono->monto, $codigo_pedido, $cliente_codigo, $abono->cuenta_id,$abono->monto_usd,$abono->moneda);
                if ($res_insert) {
                    $this->session->set_flashdata('EXITO', TRUE);
                    $data[] = 'Se registro abono N° ' . $abono->numero_abono;
                } else {
                    $data[] = 'Ocurrió un error en el registro del abono N° ' . $abono->numero_abono . ' con número de pedido ' . $codigo_pedido;
                    $this->session->set_flashdata('EXITO', FALSE);
                }
            } 
//            else {
//                $res_upd = $this->Abono_model->ActualizarAbonoDePedido($abono->numero_abono, $codigo_pedido, $abono->cuenta_id);
//
//                if ($res_upd) {
//                    $data[] = 'Se actualizo el abono N° ' . $abono->numero_abono . ' del pedido ' . $codigo_pedido . ' exitosamente';
//                } else {
//                    $data[] = 'Ocurrió un error en la actualización del abono N° ' . $abono->numero_abono . ' con número de pedido ' . $codigo_pedido;
//                    $this->session->set_flashdata('EXITO', TRUE);
//                }
//            }
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

    function CrearPedido() {
        $calculo_presupuesto_para_compra = 0;
//        $presupuesto_para_compra = 0;
        $JsonDataPedido = $_POST['json'];
        $ObjPedido = json_decode($JsonDataPedido);

        $data_insert_pedido = array(
            'cliente_codigo' => $ObjPedido->cliente_codigo,
            'shipping_total' => $ObjPedido->shipping_total,
            'costos_totales' => $ObjPedido->costos_totales,
            'precio_total' => $ObjPedido->precio_total,
            'saldo' => $ObjPedido->saldo,
            'costo_x_libra' => $ObjPedido->costo_x_libra,
            'presupuesto_x_compra' => $ObjPedido->presupuesto_x_compra,
            'presupuesto_x_envio' => $ObjPedido->presupuesto_x_envio,
            'tax_id' => $this->Tax_model->ObtenerTipoCambioDelDia()->id
        );

        $pedido_codigo = $this->Pedidos_model->IngresarPedido($data_insert_pedido);

//        $data_json = (array)$JsonDataPedido;

        foreach ($ObjPedido->detalle_pedido as $producto) {
            $stock_act_producto = $this->Productos_model->ObtenerCantidadStockProducto($producto->codigo_producto);
            $pendiente_compra = $this->ObtenerPendienteDeCompra($stock_act_producto, $producto->cantidad);

            $data_insert_pedido_detalle = array(
                'pedido_codigo' => $pedido_codigo,
                'pedido_cliente_codigo' => $ObjPedido->cliente_codigo,
                'producto_codigo' => $producto->codigo_producto,
                'cantidad' => $producto->cantidad,
                'costo_unitario_producto' => $producto->costo_unitario_producto,
                'peso_libras' => $producto->peso_libras,
                'shipping_unitario' => $producto->shipping_unitario,
                'pendiente_compra' => $pendiente_compra,
                'ganancia_unitaria' => $producto->ganancia_unitaria,
                'precio_unitario_usd' => $producto->precio_unitario_usd,
                'precio_unitario_pen' => $producto->precio_unitario_pen,
                'precio_total' => $producto->precio_total,
                'stock_producto_flag' => $stock_act_producto
            );
            $this->Pedidos_model->RegistrarPedidoDetalle($data_insert_pedido_detalle);
//            var_dump($res);
            $calculo_presupuesto_para_compra += $this->CalcularPresupuestoParaCompra($pendiente_compra, $producto->costo_unitario_producto);
//            $this->Productos_model->ActualizarStockActualProducto($producto->cantidad, $stock_act_producto, $producto->codigo_producto);
        }
        $REGISTRO_DE_ABONO = ((double) $ObjPedido->abono > 0) ? TRUE : FALSE;
        if ($REGISTRO_DE_ABONO) {
            $this->Abono_model->RegistrarAbonoDePedido(1, $ObjPedido->abono, $pedido_codigo, $ObjPedido->cliente_codigo, 2,$ObjPedido->abono,'USD');
        }
        $this->Pedidos_model->RegistrarPresupuestoParaCompra($pedido_codigo, $calculo_presupuesto_para_compra);
        $this->session->set_flashdata('nuevo_pedido', $pedido_codigo);
    }

    public function CalcularPresupuestoParaCompra($pendiente_compra, $costo_unitario_producto) {

        return ((float) $costo_unitario_producto * $pendiente_compra);
    }

    public function ObtenerPendienteDeCompra($stock_act_producto, $cant_producto_req) {

        if ((int) $stock_act_producto < (int) $cant_producto_req) {
            return $cant_producto_req - $stock_act_producto;
        }
        return 0;
    }

    public function ObtenerNuevoCodigoPedido() {

        $ResModel_IdPedido = $this->Pedidos_model->GetLastId();
        foreach ($ResModel_IdPedido->result() as $pedido) {

            $id_codigo = (empty($pedido->codigo)) ? 0 : (int) $pedido->codigo;
//            var_dump($id_codigo);
        }

        $id_codigo = (isset($id_codigo)) ? $id_codigo : 0;
        return $id_codigo + 1;
    }

    //Genera un numero de pedido fiticio.
    public function CreaPedido() {  

        $ResModel_IdPedido = $this->Pedidos_model->GetLastId();
        foreach ($ResModel_IdPedido->result() as $pedido) {
            $id_codigo = (empty($pedido->codigo)) ? 0 : (int) $pedido->codigo;
        }
        return $id_codigo = (isset($id_codigo)) ? $id_codigo : 0;
    }

    public function ListarPedidos() {
        $this->template->add_css('css/datatables/dataTables.bootstrap.min.css');
        $this->template->add_js('js/datatables/jquery.dataTables.min.js');
        $this->template->add_js('js/datatables/dataTables.bootstrap.min.js');
        $this->template->set('titulo', 'Listado de Pedidos');
        $data['pedidos'] = $this->Pedidos_model->GetAllPedidos('PEDIDO');
        $data['controlador'] = 'Pedidos';
        $this->template->load(10, 'pedidos/v_lista_pedidos', $data);
    }

}
