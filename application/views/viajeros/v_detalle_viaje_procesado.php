<div class="box box-primary">

    <div class="box-header">
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-xs-12 col-md-8 col-lg-8 col-sm-12">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>ID Viaje: <?=$_GET['codigo_viaje']?></h3>
                        <p>Nombre de viajero: <b> <?=$_GET['arg4']?></b></p>
                    </div>
                    <div class="icon">  
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="#" class="small-box-footer">Nombre de la aerolínea: <b><?=$_GET['arg3']?></b> <i class="fa fa-plane"></i></a>
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
                                        <span><?=$_GET['arg2']?></span>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th>Saldo para gastos: </th>
                                <td>
                                    <div class="col-xs-12">
                                        <span id="saldo_para_gastos"><?=$detalle_viaje->saldo_para_gastos?></span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="row">   
            <!-- accepted payments column -->
            <div class="col-xs-12 col-lg-6 table-responsive">
                    <p class="lead">Comisiones:</p>
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
                            <td><?=$detalle_viaje->costo_pasaje?> </td>
                            <td><?=$detalle_viaje->comision_viajero?> </td>
                            <td><?=$detalle_viaje->comision_adn?> </td>
                            <td><?=$detalle_viaje->comision_persona_encargada?> </td>
                            <td><?=$detalle_viaje->impuesto_aduanas?> </td>
                            <td><?=$detalle_viaje->costo_recojo?> </td>
                            <td><?=$detalle_viaje->gastos_extras?> </td>
                      
                            <td>
                                <span  id="costo_total_viaje"><?=$detalle_viaje->costo_total_viaje?></span>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- /.col -->
            <div class="col-xs-12 col-lg-6">
                <p class="lead">Enviados:</p>
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
                            <?php 
                                foreach($detalle_viaje_list_prod->Result() as $campo){ ?>
                            <tr>
                                <td><?=$campo->pedido_detalle_pedido_codigo?></td>
                                <td><?=$campo->nombre_producto?></td>
                                <td><?=$campo->cantidad_envio?></td>
                                <td><?=$campo->shipping?></td>
                                <td><?=$campo->pesolibra?></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                        <tfoot>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th id="sumatoria_shipping"><?=$detalle_viaje->shipping_total?></th>
                        <th id="sumatoria_peso_libras"><?=$detalle_viaje->pesolibra_total?></th>
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
    </div>
</div>



