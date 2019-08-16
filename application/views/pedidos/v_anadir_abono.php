<!-- <div class="col-md-3"> -->
<div class="box box-success box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Agregar abono</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form id="agregarAbono">
            <div class="row">
                <div class="col-xs-3">
                    <input type="text" class="form-control" placeholder="monto" name="montoAddAbono">

                </div>
                <div class="col-xs-7">
                    <?= armarSelectCtasBancarias() ?>
                </div>
                <div class="col-xs-2">
                    <input type="hidden" value="<?= $pedido->codigo ?>" id="codigo_pedido" name="codigo_pedido">
                    <input type="hidden" value="<?= $tc_today ?>" id="tc_today">
                    <input type="hidden" value="<?= $pedido->cliente_codigo ?>" id="cliente_codigo" name="cliente_codigo">
                    <button type="submit" class="btn btn-success" title="Guardar cambios"><i class="fa fa-save"></i></button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.box-body -->
</div>
<!-- </div> -->
<!-- /.box -->