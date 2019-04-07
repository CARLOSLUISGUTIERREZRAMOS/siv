<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Añadir Producto</h4>
            </div>
            <div class="modal-body">
                <?= form_open('clientes_productos/Productos/Registro') ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Codigo de Producto</label>
                            <input type="text" class="form-control" id="cod_producto" value="<?php printf('%010d', $codigo_nuevo);?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nombre de Producto</label>
                            <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" placeholder="Ingrese nombre de producto">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Costo Unitario</label>
                            <input type="text" class="form-control" id="costo_unitario" name="costo_unitario" placeholder="Ingrese costo unitario">
                        </div>
                        
                       <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Registrar producto</button>
                    </div>
                <?= form_close()?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->