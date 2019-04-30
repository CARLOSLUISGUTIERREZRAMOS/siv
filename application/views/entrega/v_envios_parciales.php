<?php
$precio_total = 0;
$precio_total_cant_envio = 0;
$estado = '';
foreach ($items_parcial->Result() as $item) {
    $precio_total += $item->PUV * $item->cant_solic;
    $precio_total_cant_envio += $item->PUV * $item->cantidad_envio;
}
$saldo_a_cobrar = $precio_total_cant_envio - $total_abonos ;
$saldo_a_cobrar_pend_envio = ($precio_total - $precio_total_cant_envio) + $saldo_a_cobrar;
 if ($saldo_a_cobrar_pend_envio <= $precio_total && $saldo_a_cobrar_pend_envio > 0) {
                            $color = 'orange';
                            $estado = "Pago Parcial";
                        } else if ((int) $precio_total_cant_pend_envio > 0) {
                            $color = 'red';
                            $estado = "Pendiente de pago";
                        }
?>

<div class="col-md-12">
    <div class="box">

        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-8">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-black" style="background: url('../dist/img/photo1.png') center center;">
                            <h3 class="widget-user-username"><?= $nombre_cliente ?></h3>
                            <h5 class="widget-user-desc">N° Pedido: <?= $codido_pedido ?></h5>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle" src="<?= base_url() ?>img/usuario_viaje.png" alt="User Avatar">
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header"><?= $precio_total ?></h5>
                                        <span class="description-text">Precio Total</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header"><?= $total_abonos ?></h5>
                                        <span class="description-text">Total Abonos</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3">
                                    <div class="description-block">
                                        <span class="description-percentage text-green"><i class="fa fa-money"></i> <?= ($saldo_a_cobrar < 1) ? "Cancelado" : '' ?></span>
                                        <h5 class="description-header"><?= $saldo_a_cobrar?></h5>
                                        <span class="description-text">Saldo a cobrar de envío</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <div class="col-sm-3">
                                    <div class="description-block">
                                        <span class="description-percentage text-<?=$color?>"><i class="fa fa-money"></i> <?= $estado ?></span>
                                        <h5 class="description-header"><?= $saldo_a_cobrar_pend_envio ?></h5>
                                        <span class="description-text">Saldo a cobrar Pend. Envío</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.widget-user -->
                    <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <?php
                    foreach ($items_parcial->Result() as $item) {
                                  $cant_pend_envio = ((int) $item->cantidad_envio === 0) ? $item->cant_solic : $item->cant_pend_envio;
                        ?>

                        <div class="progress-group">
                            <br>
                            <span class="progress-text"><b><?= $item->nombre ?></b></span>
                            
                            <span class="label label-success pull-right"><?=ObtenerNombreEstado($item->estado) ?></span>
                            <br>

                            <span class="progress-text" data-toggle="tooltip" title="Precio unitario ">USD <?= $item->PUV ?></span>


                            <span class="progress-number"><b><?= $item->cantidad_envio ?></b>/<?= $item->cant_solic ?></span>
                            <?php
                            $res = ($item->cantidad_envio * 100) / $item->cant_solic;
                            ?>

                            <div class="progress sm margin-bottom-none">
                                <div class="progress-bar progress-bar-aqua" style="width: <?= $res ?>%"></div>
                            </div>
                           
                            <span class="progress-text"  data-toggle="tooltip" title="Ppto. Compra = <?= $cant_pend_envio * $item->costo_unitario ?> ">Pend. Envío: <?= $cant_pend_envio = ((int) $item->cantidad_envio === 0) ? $item->cant_solic : $item->cant_pend_envio; ?></span>
                                

                        </div>
                        <?php
                    }
                    ?>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- ./box-body -->

        <!-- /.box-footer -->
    </div>
    <!-- /.box -->
</div>

<div class="row">




    




    <!-- /.box-header -->
    <!-- /.box-body -->    
</div>
