<?php
$msg_tipo_cambio = $this->session->flashdata('msg_tipo_cambio');
$INSERTO = $this->session->flashdata('INSERTO');
if (isset($msg_tipo_cambio)) {
    if ($INSERTO) {
        ?>
        <div class="callout callout-success">
            <h4>Exito!</h4>

            <p> <i class="fa fa-check-square-o"></i> Tipo de cambio del día registrado</p>
            <p><i class="fa fa-check-square-o"></i> Costo por libra del día registrado</p>
        </div>
    <?php } else {
        ?>
        <div class="callout callout-danger">
            <h4>Error</h4>

            <p>Error al registrar el tipo de cambio del día. Comuniquese con el Area de Sistemas.</p>
        </div>

        <?php
    }
}
?>
<div class="modal fade" id="modal_tipo_cambio" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-exclamation-circle"></i>El tipo de cambio aún no ha sido establecido..</h4>
            </div>
            <div class="modal-body">
                <?php
                $id = array('class' => 'form-horizontal');
                echo form_open('finanzas/Tax/RegistrarTaxDelDia', $id)
                ?>
                <div class="box-body">
                    <div class="form-group">
                        <label for="tipo_cambio_compra" class="col-sm-5 control-label">Tipo de cambio Compra USD </label>

                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="tipo_cambio_compra" name="tipo_cambio_compra" placeholder="Ingrese el tipo de cambio compra">
                        </div>
                    </div>
<!--                    <div class="form-group">
                        <label for="tipo_cambio_venta" class="col-sm-5 control-label">Tipo de cambio Venta USD </label>

                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="tipo_cambio_venta" name="tipo_cambio_venta" placeholder="Ingrese el tipo de cambio venta">
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label for="costo_libras" class="col-sm-5 control-label">Costo por libra USD</label>

                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="costo_libra" id="costo_libra" placeholder="Ingrese el costo por libra" value="6.58">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="reset" class="btn btn-default">Cancelar</button>
                    <button type="submit" class="btn btn-info pull-right">Guardar</button>
                </div>
                <!-- /.box-footer -->
                <?= form_close() ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<section class="content" id="dashboard">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-balance-scale"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Costo de libra del día</span>
                    <span class="info-box-number"><?= $costo_x_libra ?><small></small></span>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Tipo de cambio del día (Compra)</span>
                    
                    <span class="info-box-number">USD <?= ($tipo_cambio === 'SIN FIJAR') ? $tipo_cambio : $tipo_cambio->tipo_cambio_compra ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

    </div>    
</section>
