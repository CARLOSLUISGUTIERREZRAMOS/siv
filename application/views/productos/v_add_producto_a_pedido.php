<!-- <div class="col-md-3"> -->
<div class="box box-success box-solid" id="fila_add_producto" style="display: none" >
    <div class="box-header with-border">
        <h3 class="box-title">Agregar Producto</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form id="agregarAbono" method="POST">
            <div class="col-xs-3">
                <div class="form-group has-success">
                    <label class="control-label" for="inputSuccess"> Seleccione producto:</label>
                    <div class="input-group">
                        <?= armarSelectProductos() ?>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Confirmar</button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-xs-1">
                <div class="form-group has-success">
                    <label class="control-label" for="inputSuccess"> Cant.</label>
                    <input type="text" class="form-control" id="inputSuccess" onchange="Calcular">
                </div>
            </div>
            <div class="col-xs-1">
                <div class="form-group has-success">
                    <label class="control-label" for="inputSuccess"> C.U.P</label>
                    <input type="text" class="form-control" id="cup">
                </div>
            </div>
            <div class="col-xs-1">
                <div class="form-group has-success">
                    <label class="control-label" for="inputSuccess"> Cant. libras</label>
                    <input type="text" class="form-control" id="cantLibras">
                </div>
            </div>
            <div class="col-xs-1">
                <div class="form-group has-success">
                    <label class="control-label" for="inputSuccess"> Shipping Unit.</label>
                    <input type="text" class="form-control" id="shippingUnitario">
                </div>
            </div>
            <div class="col-xs-1">
                <div class="form-group has-success">
                    <label class="control-label" for="inputSuccess"> Gan Unit.</label>
                    <input type="text" class="form-control" id="inputSuccess">
                </div>
            </div>
            <div class="col-xs-1">
                <div class="form-group has-success">
                    <label class="control-label" for="inputSuccess"> P.U.V</label>
                    <input type="text" class="form-control" id="inputSuccess">
                </div>
            </div>
            <div class="col-xs-1">
                <div class="form-group has-success">
                    <label class="control-label" for="inputSuccess"> Precio T.</label>
                    <input type="text" class="form-control" id="inputSuccess">
                </div>
            </div>
            <!-- <div class="col-xs-">
                <button type="button" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Agregar a la lista de Productos</button>
            </div> -->
            <div class="col-xs-1">
            <a class="btn btn-success btn-app">
                <i class="fa fa-save"></i> Guardar
              </a>
            </div>

        </form>
    </div>
    <!-- /.box-body -->
</div>
<!-- </div> -->
<!-- /.box -->