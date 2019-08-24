<!-- <div class="col-md-3"> -->
<div class="box box-success box-solid" id="fila_add_producto" style="display: none">
    <div class="box-header with-border">
        <h3 class="box-title">Agregar Producto</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form id="formAddProducto">
            <div class="col-xs-12 col-lg-3 col-md-12">
                <div class="form-group has-success">
                    <label class="control-label" for="inputSuccess"> Seleccione producto:</label>
                        <?= armarSelectProductos() ?>
                </div>
            </div>
            <div class="col-xs-4 col-lg-1 col-sm-3">
                <div class="form-group has-success">
                    <label class="control-label" for="cantidadProducto"> Cant.</label>
                    <input type="text" class="form-control" id="cantidadProducto" name="cantidad" onchange="calcularCostoTotalProducto(document.getElementById('cut').value,document.getElementById('cantidadProducto').value,true) ; calcularPrecioTotal(this.value,document.getElementById('precioUnitarioVenta').value, true)" value="1">
                </div>
            </div>
            <div class="col-xs-4 col-lg-1 col-sm-3">
                <div class="form-group has-success">
                    <label class="control-label" for="cup"> C.U.P</label>
                    <input type="text" class="form-control" id="cup" name="costo_unitario_producto">
                </div>
            </div>
            <div class="col-xs-4 col-lg-1 col-sm-3">
                <div class="form-group has-success">
                    <label class="control-label" for="cantLibras"> Cant. libras</label>
                    <input type="text" class="form-control" id="cantLibras" name="peso_libras" value="1" onchange="calcularCostoUnitarioTotal(document.getElementById('cup').value,<?= $pedido->costo_x_libra ?>,this.value,true) ; calcularShippingUnitario(this.value,<?= $pedido->costo_x_libra ?>,true)">
                </div>
            </div>
            <div class="col-xs-4 col-lg-1 col-sm-3">
                <div class="form-group has-success">
                    <label class="control-label" for="shippingUnitario"> Shipping Unit.</label>
                    <input type="text" class="form-control" id="shippingUnitario" name="shipping_unitario" value="<?= $pedido->costo_x_libra ?>">
                </div>
            </div>
            <div class="col-xs-4 col-lg-1 col-sm-3">
                <div class="form-group has-success">
                    <label class="control-label" for="cut"> C.U.T.</label>
                    <input type="text" class="form-control" id="cut" name="cut">
                </div>
            </div>
            <div class="col-xs-4 col-lg-1 col-sm-3">
                <div class="form-group has-success">
                    <label class="control-label" for="costoTotalProducto"> C.T.P.</label>
                    <input type="text" class="form-control" id="costoTotalProducto" name="costoTotalProducto">
                </div>
            </div>
            <div class="col-xs-4 col-lg-1 col-sm-3">
                <div class="form-group has-success">
                    <label class="control-label" for="inputSuccess"> P.U.V</label>
                    <input type="text" class="form-control" id="precioUnitarioVenta" name="precioUnitarioVenta" onchange="calcularPrecioTotal(document.getElementById('cantidadProducto').value,this.value,true)">
                </div>
            </div>
            <div class="col-xs-4 col-lg-1 col-sm-3">
                <div class="form-group has-success">
                    <label class="control-label" for="inputSuccess"> Precio T.</label>
                    <input type="text" class="form-control" id="precioTotal" name="precioTotal">
                </div>
            </div>
            <!-- <div class="col-xs-">
                <button type="button" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Agregar a la lista de Productos</button>
            </div> -->
            <div class="col-xs-4 col-lg-1 col-sm-3">
                <button type="submit" class="btn btn-success btn-app">
                    <i class="fa fa-save"></i> Guardar
                </button>
            </div>

        </form>
    </div>
    <!-- /.box-body -->
</div>
<!-- </div> -->
<!-- /.box -->