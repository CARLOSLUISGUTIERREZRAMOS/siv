<?php
$data_ingresada = $this->session->flashdata('data_ingresada');
if (isset($data_ingresada)) {
    $EXITO = $this->session->flashdata('EXITO');
    $alert = ($EXITO) ? 'succes' : 'danger';
    ?>
<br>
<div class="alert alert-success <?= $alert ?>">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Exito!</h4>
    <?php
        foreach ($data_ingresada as $item) {
            echo $item . "<br>";
        }
        ?>
</div>
<?php
}
?>

<section class="invoice" id="bloque_pedido_detalle">
    <!-- title row -->
    <?php
    $msg_proccess = $this->session->flashdata('msg');

    ?>
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <!--                <i class="fa fa-globe"></i> Detalle de Pedido-->
                <?= img('img/pedido_detalle_search.png') ?> Detalle de Pedido #<?= $pedido->codigo ?>
                <small class="pull-right"><i class="fa fa-calendar"></i> Fecha Pedido: <?= (new DateTime($pedido->fecha_pedido))->format('d/m/Y') ?></small>
            </h2>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            <address>
                <b>Costo por libra: </b><?= $pedido->costo_x_libra ?><br>
                <b>Tipo de cambio: </b> <?= $tipo_cambio ?><br>
                <b>Tipo de cambio del día: </b> <?= $tc_today ?><br>
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <address>
                <b>Presupuesto para compra: </b>$ <?= $presupuestoCompra ?><br>
                <b>Presupuesto para envío: </b>$ <?= $presupuestoEnvio ?> <br>
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <address>
                <b>Saldo por cobrar: $ </b><span class="<?= ($saldoPorCobrar < 0) ? 'text-red' : ''; ?>"><?= $saldoPorCobrar ?></span><br>
            </address>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Costos</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped tbl_detalle_pedido">
                        <thead>
                            <tr>
                                <th>Cod. Producto</th>
                                <th>Producto</th>
                                <th>Cant.</th>
                                <th>C.U.P</th>
                                <th>Cant. libras</th>
                                <th>Shipping Unit.</th>
                                <th>Ganancia Unit.</th>
                                <th>P.U.V</th>
                                <th>Precio T.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sumatoria_costo_unitario_total = 0;
                            foreach ($pedido_detalle->Result() as $item) {

                                $sumatoria_costo_unitario_total = $item->costo_unitario_producto + $sumatoria_costo_unitario_total;
                                ?>
                            <tr>
                                <td><?= $item->producto_codigo ?></td>
                                <td><?= $item->nombre ?></td>
                                <td><?= $item->cantidad ?></td>
                                <td><?= $item->costo_unitario_producto ?></td>
                                <td><?= $item->peso_libras ?></td>
                                <td><?= $item->shipping_unitario ?></td>
                                <td><?= $item->ganancia_unitaria ?></td>
                                <td><?= $item->precio_unitario_usd ?></td>
                                <td><?= $item->precio_total ?></td>
                                <td><i class="fa fa-trash-o del_prodpedido" style="color: red" id="<?= $item->id ?>" title="Retirar <?= $item->nombre ?>"></i></td>
                            </tr>
                            <?php
                            }
                            ?>


                        </tbody>

                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>$ <span id="costo_unit_tot"><?= $sumatoria_costo_unitario_total ?></span></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>$<span id="precio_total_sumatoria"><?= $precioTotalPedido ?></span> </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>

        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-12 col-lg-6">
            <p class="lead"><span class="label bg-light-blue">Compras: </span></p>
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cant.</th>
                            <th>Stock</th>
                            <th>Pend.Compra</th>
                            <th>C.U.</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pedido_detalle->Result() as $item) { ?>
                        <tr id="<?= $item->id ?>">
                            <td><?= $item->nombre ?></td>
                            <td><?= $item->cantidad ?></td>
                            <td><?= $item->stock_producto_flag ?></td>
                            <td><?php
                                    $pendiente_compra = 0;
                                    if ((float) $item->pendiente_compra > 0) {
                                        $pendiente_compra = $item->pendiente_compra;
                                    } else if ($item->stock_producto_flag > $item->cantidad) {
                                        $pendiente_compra;
                                    } else {
                                        $pendiente_compra = (int) $item->cantidad - (int) $item->stock_actual;
                                    }
                                    ?><?= $pendiente_compra ?></td>
                            <td><?= $item->costo_unitario_producto ?></td>
                            <?php
                                if ($pendiente_compra === 0) {
                                    $fondo = "bg-yellow";
                                    $msg = 'PDT. ENVIO';
                                } else {
                                    $fondo = "bg-red";
                                    $msg = 'PDT. COMPRA';
                                }
                                ?>
                            <td><span class="badge <?= $fondo ?>"><?= $msg ?></span></td>

                        </tr>
                        <?php
                        }
                        ?>


                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-12 col-lg-6">
            <p class="lead"><span class="label bg-light-blue">Abonos: </span></p>
            <div class="table-responsive">

                <table class="table" id="tbl_lista_pedido_detalle">
                    <tbody>
                        <tr>
                            <th><button type="button" title="Agregar abono" class="btn btn-dropbox btn-sm btn-flat" id="btn_agregar_abono"  onclick="agregarAbono()"><i id="btnAbonoAdd" class="fa fa-plus"></i></button></th>
                            <th style="width:15%">N° Abono:</th>
                            <th style="width:20%">Monto:</th>
                            <th>Cuenta de Abono:</th>
                            <th></th>
                        </tr>
                        <tr style="display: none" id="fila_add_abono">
                            <td colspan="7">
                                <?php
                                $this->load->view('pedidos/v_anadir_abono');
                                ?>
                            </td>
                        </tr>
                        <?php
                        if (isset($msg_proccess)) {
                            $res = MostrarBloqueAviso($msg_proccess, NULL);
                            echo $res;
                        }
                        //SUMATARIA TOTAL ABONO
                        if ($EXISTE_ABONO) {
                            $i = 1;
                            foreach ($abonos->Result() as $abono) {
                                //LOGICA PARA CONVERTIR EL ABONO REGISTRADO A USD CON EL TIPO DE CAMBIO DE ESE DÍA
                                ?>
                        <tr>
                            <td></td>
                            <td><?=$i?></td>
                            <td>
                                <?= $abono->monto ?>
                            </td>


                            <td id="bloque_select_cuentas">
                                <select class="form-control select_cuentas" id="<?= $abono->id ?>" disabled>
                                    <?php
                                            foreach ($cuentas_bancarias->Result() as $cuenta) {
                                                $selected = ($abono->cuentas_bancarias_id === $cuenta->id) ? 'selected' : '';
                                                ?>
                                    <option id="<?= $cuenta->id ?>" value="<?= $cuenta->tipo_moneda ?>" <?= $selected ?>><?= $cuenta->banco . "-" . $cuenta->tipo_moneda ?></option>
                                    <?php
                                            }
                                            ?>
                                </select>
                            </td>
                            <td><input type="hidden" id="<?= $abono->id ?>" class="monto_usd" value="<?= $abono->monto ?>"></td>
                            <td>
                                <div class="text-center">
                                    <button type="button" class="btn btn-sm" title="Editar abono <?= $abono->id ?>" data-toggle="modal" data-target="#editaAbonoModal" data-idabono="<?= $abono->id ?>" data-codigopedido="<?= $pedido->codigo ?>" data-titular="<?= $abono->titular ?>" data-moneda="<?= $abono->tipo_moneda ?>" data-numcuenta="<?= $abono->numero_cuenta ?>" data-montousd="<?= $abono->monto ?>" data-montopen="<?= $abono->monto_pen ?>" data-tipocambio="<?= $tipo_cambio ?>" data-cuentabancaria="<?= $abono->cuentas_bancarias_id ?>"><i class="fa fa-pencil"></i></button>
                                    <button type="button" class="btn btn-sm" title="Eliminar abono <?= $abono->id ?>" onclick="eliminarAbono(this)" data-idabono="<?= $abono->id ?>" data-codigopedido="<?= $pedido->codigo ?>"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </td>





                        </tr>

                        <?php
                        $i++;   
                        }
                        } else {
                            ?>
                        <tr>
                            <td></td>
                            <td id="bloque_select_cuentas">
                                <select class="form-control select_cuentas" id="1">
                                    <?php
                                        foreach ($cuentas_bancarias->Result() as $cuenta) {
                                            ?>
                                    <option id="<?= $cuenta->id ?>" value="<?= $cuenta->tipo_moneda ?>"><?= $cuenta->banco . "-" . $cuenta->tipo_moneda ?></option>
                                    <?php
                                        }
                                        ?>
                                </select>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                    <tfoot>

                        <tr>
                            <td></td>
                            <td>TOTAL ABONOS: </td>
                            <td><span id="monto_total_cal"><?= $sum_abono ?></span></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        
                    </tfoot>
                </table>

            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <a href="<?= base_url() ?>operaciones/Pedidos/ListarPedidos" target="_self" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Volver</a>
            <button type="button" class="btn btn-success pull-right btn_guardar"><i class="fa fa-save"></i> Guardar
            </button>
            <!--            <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                            <i class="fa fa-download"></i> Limp
                        </button>-->
        </div>
    </div>
</section>
<!--CAMPOS OCULTOS NECESARIOS PARA EL CALCULO-->
<input type="hidden" value="<?= $tc_today ?>" id="tc_today">
<input type="hidden" value="<?= $pedido->codigo ?>" id="codigo_pedido">
<input type="hidden" value="<?= $pedido->cliente_codigo ?>" id="cliente_codigo">
