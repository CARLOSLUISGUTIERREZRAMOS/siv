<!-- <div class="col-md-3"> -->
<div class="box box-success box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Agregar abono</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <!-- <form id="agregarAbono" method="POST"> -->
        <form id="agregarAbono" method="POST" class="form-horizontal">
            <div class="box-body">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Monto</label>

                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="entradaAddAbono" placeholder="monto" name="montoAddAbono">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-4 control-label">Cta. Bancaria</label>

                    <div class="col-sm-8">
                        <?= armarSelectCtasBancarias() ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-4 control-label">Fecha de Abono</label>

                    <div class="col-sm-8">
                        <input type="text" class="form-control pull-right" id="datepicker">
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <input type="hidden" value="<?= $pedido->codigo ?>" id="codigo_pedido" name="codigo_pedido">
                <input type="hidden" value="<?= $tc_today ?>" id="tc_today">
                <input type="hidden" value="<?= $pedido->cliente_codigo ?>" id="cliente_codigo" name="cliente_codigo">
                <button type="submit" class="btn btn-info pull-right" title="Guardar cambios"><i class="fa fa-save"></i> Guardar</button>
            </div>
            <!-- /.box-footer -->
        </form>


        <!-- <form id="agregarAbono" method="POST">
            <div class="row">
                <div class="col-xs-4 input-group">
                    <input type="text" class="form-control" id="entradaAddAbono" placeholder="monto" name="montoAddAbono">
                </div>
                <div class="col-xs-8 input-group">
                    <?= armarSelectCtasBancarias() ?>
                </div>
                <div class="col-xs-8">
                    <input type="text" class="form-control pull-right" id="datepicker">
                </div>
                <div class="col-xs-4">
                    <input type="hidden" value="<?= $pedido->codigo ?>" id="codigo_pedido" name="codigo_pedido">
                    <input type="hidden" value="<?= $tc_today ?>" id="tc_today">
                    <input type="hidden" value="<?= $pedido->cliente_codigo ?>" id="cliente_codigo" name="cliente_codigo">
                    <button type="submit" class="btn btn-success" title="Guardar cambios"><i class="fa fa-save"></i></button>
                </div>
            </div>
        </form> -->
    </div>
    <!-- /.box-body -->
</div>
<!-- </div> -->
<!-- /.box -->