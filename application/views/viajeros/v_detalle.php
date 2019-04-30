<div class="box box-primary">

    <div class="box-header">
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-xs-12 col-md-8 col-lg-8 col-sm-12">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>ID Viaje: <?= $DetalleViaje->id ?></h3>
                        <p>Nombre de viajero: <b><?= $DetalleViaje->nombres_viajero ?></b></p>
                    </div>
                    <div class="icon">  
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="#" class="small-box-footer">Nombre de la aerolínea: <b><?= $DetalleViaje->nombre ?></b> <i class="fa fa-plane"></i></a>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 col-lg-4 col-sm-12">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Total maletas enviadas: </th>
                                <td>
                                    <div class="col-xs-12">
                                        <span><?= $DetalleViaje->maletas_enviadas ?></span>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th>Saldo para gastos: </th>
                                <td>
                                    <div class="col-xs-12">
                                        <span id="saldo_para_gastos"></span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Costo del Pasaje</th>
                        <th>Comisión del Viajero</th>
                        <th>Comisión ADN</th>
                        <th>Comisión Luis</th>
                        <th>Impuesto Aduanas</th>
                        <th>Costo de Recojo</th>
                        <th>Gastos extras</th>
                        <th>COSTO TOTAL VIAJE </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="text" id="costo_pasaje" class="form-control input-sm  decimal" value="0">   
                        </td>
                        <td>
                            <input type="text" id="comision_viajero" class="form-control input-sm  decimal" value="0">   
                        </td>
                        <td>
                            <input type="text" id="comision_adn" class="form-control input-sm  decimal" value="0" >   
                        </td>
                        <td>
                            <input type="text" id="comision_elvira" class="form-control input-sm  decimal" value="0">   
                        </td>
                        <td>
                            <input type="text" id="impuesto_aduanas" class="form-control input-sm  decimal" value="0">   
                        </td>
                        <td>
                            <input type="text" id="costo_recojo" class="form-control input-sm decimal" value="0" >   
                        </td>
                        <td>
                            <input type="text" id="gastos_extras" class="form-control input-sm decimal" value="0">   
                        </td>
                        <td>
                            <span  id="costo_total_viaje"></span>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="row">   
            <!-- accepted payments column -->
            <div class="col-xs-12 col-lg-7 bloque_pedidos">
                <p class="lead">Lista de productos disponibles:</p>
                <div class="table-responsive">

                    <?php
                    foreach ($JsonPedidosViaje as $key => $campo) {
                        ?>


                        <div class="col-md-12">
                            <div class="box box-default box-solid collapsed-box margin">
                                <div></div>
                                <div class="box-header with-border">

                                    <h3 class="box-title">Pedido N°<?= $key ?></h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body" style="display: none;">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Producto</th>
                                                <th>Cant.Req</th>
                                                <th>Stock</th>
                                                <th style="width: 40px">Cant.Envío</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($campo as $key_en => $row) {
                                                ?>
                                                <tr>

                                                </tr>

                                                <tr id="<?= $key_en ?>">

                                                    <td>
                                                        <label>
                                                            <input type="checkbox" class="pedido_detalle <?= $row->cod_prod ?>" id="<?= $key_en ?>" <?= ($row->stock_actual == '0') ? 'disabled' : '' ?>>
                                                        </label>
                                                    </td>
                                                    <td class="nombre" id="<?= $key_en ?>"><?= $row->nombre ?></td>
                                                    <td class="cantidad" id="<?= $key_en ?>"><?= $row->cantidad ?></td>
                                                    <td class="stock_actual" id="<?= $row->cod_prod ?>"><?= $row->stock_actual ?></td>
                                                    <td><input class="form-control input-sm cantidad_envio decimal" type="text" id="<?= $row->cod_prod ?>" name="<?= $key_en ?>" <?= ($row->stock_actual == '0') ? 'disabled' : '' ?> value="0"></td>
                                                    <td id="shipping_unitario" style="display: none"><?= $row->shipping_unitario ?></td>
                                                    <td id="peso_libras"  style="display: none"><?= $row->peso_libras ?></td>
                                                    <td id="pedido_cliente_codigo"  style="display: none"><?= $row->pedido_cliente_codigo ?></td>
                                                    <td id="pedido_codigo"  style="display: none"><?= $key ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>

                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>

                        <?php
                    }
                    ?>

                </div>
            </div>

            <!-- /.col -->
            <div class="col-xs-12 col-lg-5">
                <p class="lead">Tu lista:</p>
                <div class="table-responsive">
                    <table class="table table-striped table table-condensed" id="tbl_tupedido">
                        <thead>
                            <tr>
                                <th>Pedido</th>
                                <th>Producto</th>
                                <th>Cant.Env</th>
                                <th>Shipping</th>
                                <th>Peso libr.</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th id="sumatoria_shipping"></th>
                        <th id="sumatoria_peso_libras"></th>
                        </tfoot>
                    </table>
                    <!-- /.box -->
                </div>

            </div>
            <!-- /.col -->
        </div>
    </div>
    <div class="box-footer">
        <a type="button" title="Volver" class="btn btn-default" href="<?= base_url() ?>operaciones/Viaje/"><i class="fa fa-chevron-left"></i> Volver</a>
        <button type="button" class="btn btn-success pull-right"  id="btn_guardar_detalle_viaje">Guardar Cambios</button>
    </div>
    <?php foreach ($StockProducto as $key => $value) { ?>
        <input type="hidden" value="<?= $value ?>" id="<?= $key ?>" class="producto_hidden">
        <?php
    }
    ?>
    <input type="hidden" value="<?= $DetalleViaje->id ?>" id="viaje_id">
</div>
<?php
$this->load->view('viajeros/v_error');
?>



