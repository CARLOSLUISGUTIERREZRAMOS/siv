<div class="box box-primary">
    
    <div class="box-header">
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-8 col-sm-8">
                    <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>ID Viaje: <?= $DetalleViaje->id ?></h3>
                        <p>Nombre de viajero: <b><?= $DetalleViaje->nombres_viajero ?></b></p>
                    </div>
                    <div class="icon">  
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="#" class="small-box-footer">Nombre de la aerolínea: <b><?=$DetalleViaje->nombre?></b> <i class="fa fa-plane"></i></a>
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
                        <th>Comisión Elvira</th>
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
            <div class="col-xs-7 bloque_pedidos">
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
                                                <th>Cantidad</th>
                                                <th>Producto</th>
                                                <th>Shipping</th>
                                                <th>Peso libras</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($campo as $key_en => $row) {
                                                ?>
                                                <tr>

                                                </tr>

                                                <tr>

                                                    <td>
                                                        <label>
                                                            <input type="checkbox" class="flat-red pedido_detalle">
                                                        </label>
                                                    </td>
                                                    <td class="cantidad" id="<?= $key_en ?>"><?= $row->cantidad ?></td>
                                                    <td class="nombre" id="<?= $key_en ?>"><?= $row->nombre ?></td>
                                                    <td class="shipping_unitario" id="<?= $key_en ?>"><?= $row->shipping_unitario ?></td>
                                                    <td class="peso_libras" id="<?= $key_en ?>"><?= $row->peso_libras ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
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
            <div class="col-xs-5">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Total libras enviadas: </td>
                                <td>
                                    <div class="col-xs-12">
                                        <input type="text" value="" class="form-control input-sm">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Total maletas enviadas: </td>
                                <td>
                                    <div class="col-xs-12">
                                        <span><?=$DetalleViaje->maletas_enviadas?></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <th>Saldo para gastos: </th>
                                <td>
                                    <div class="col-xs-12">
                                        <input type="text" value="" class="form-control input-sm">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- /.col -->
        </div>

    </div>
    <div class="box-footer">
        <button type="reset" class="btn btn-default">Cancel</button>
        <button type="button" class="btn btn-primary">Guardar Cambios</button>
    </div>
</div>

</div>

