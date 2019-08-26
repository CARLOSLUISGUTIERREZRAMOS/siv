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
                <b>Costo por libra: </b><span id="costo_x_libra"><?= $pedido->costo_x_libra ?></span><br>
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
        
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <button type="button" class="btn btn-sm margin" title="Agregar Producto al listado" data-toggle="modal" id="btn_agregar_producto"  onclick="agregar('producto')"><i class="fa fa-plus"></i></button>
                <?php $this->load->view('productos/v_add_producto_a_pedido')?>
                <h3 class="box-title">AGREGAR PRODUCTO</h3>
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
                                <th>C.U.T</th>
                                <th>C.T.P</th>
                                <th>Ganancia Unit.</th>
                                <th>P.U.V</th>
                                <th>Precio T.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sumatoria_costo_unitario_total = 0;
                            $sumatoria_precio_total = 0;
                            foreach ($pedido_detalle->Result() as $item) {

                                $cut=calcularCostoUnitarioTotal($item->costo_unitario_producto,$item->shipping_unitario);
                                $precio_total               =               calcularPrecioTotal($item->cantidad, $item->precio_unitario_usd);
                                $sumatoria_precio_total += $precio_total;
                                
                                $sumatoria_costo_unitario_total = $cut + $sumatoria_costo_unitario_total;
                                ?>
                            <tr>
                                <td><?= $item->producto_codigo ?></td>
                                <td><?= $item->nombre ?></td>
                                <td>
                                <span class="modificarCantidadProd" style="cursor: pointer;" id="<?= $item->id ?>" name="<?=$item->cantidad?>" title="Doble click para modificar cantidad"><?= $item->cantidad ?></span>
                                    
                                </td>
                                <td><?= $item->costo_unitario_producto ?></td>
                                <td><?= $item->peso_libras ?></td>
                                <td><?= $item->shipping_unitario ?></td>
                                <td><?= $cut ?></td>
                                <td><?= calcularCostoTotalProducto($item->cantidad,$cut) ?></td>
                                <td><?= $item->ganancia_unitaria ?></td>
                                <td><?= $item->precio_unitario_usd ?></td>
                                <td><?= $precio_total?></td>
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
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>$ <span id="costo_unit_tot"><?= $sumatoria_costo_unitario_total ?></span></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>$<span id="precio_total_sumatoria"><?= $sumatoria_precio_total ?></span> </td>
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
                            <th><button type="button" title="Agregar abono" class="btn btn-dropbox btn-sm btn-flat" id="btn_agregar_abono"  onclick="agregar('abono')"><i id="btn_add_abono" class="fa fa-plus"></i></button></th>
                            <th style="width:15%">N° Abono:</th>
                            <th style="width:20%">Monto USD</th>
                            <th style="width:20%">Monto S/.</th>
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
                            <td>
                                <?= $abono->monto_pen ?>
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
                            <td><span id="monto_total_cal"><?= $sum_abono_usd ?></span></td>
                            <td><span id="monto_total_cal"><?= $sum_abono_pen ?></span></td>
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
                <div class="col-sm-4 invoice-col">
            <address>
                <?php
            $saldoxCobrar = calcularSaldoPorCobrar($sumatoria_precio_total,$sum_abono_usd);
            ?>
                <b>Saldo por cobrar: $ </b><span class="<?= ($saldoPorCobrar < 0) ? 'text-red' : ''; ?>"><?= $saldoxCobrar?></span><br>
            </address>
        </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <a href="<?= base_url() ?>operaciones/Pedidos/ListarPedidos" target="_self" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Volver</a>
            </button>
            
        </div>
    </div>
</section>
<!--CAMPOS OCULTOS NECESARIOS PARA EL CALCULO-->
<input type="hidden" value="<?= $tc_today ?>" id="tc_today">
<input type="hidden" value="<?= $pedido->codigo ?>" id="codigo_pedido">
<input type="hidden" value="<?= $pedido->cliente_codigo ?>" id="cliente_codigo">
