<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Añadir Cliente</h4>
            </div>
            <div class="modal-body">
                <?= form_open('clientes_productos/Clientes/Registro') ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Codigo Cliente</label>
                            <input type="text" class="form-control" id="cod_cliente" disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nombres</label>
                            <input type="text" class="form-control" id="nombres_cliente" name="nombres_cliente" placeholder="Ingrese nombre">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Apellidos</label>
                            <input type="text" class="form-control" id="apellido_cliente" name="apellido_cliente" placeholder="Ingrese apellidos">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Email</label>
                            <input type="text" class="form-control" id="email_cliente" name="email_cliente" placeholder="Ingrese email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Telefono</label>
                            <input type="text" class="form-control" id="telefono_cliente" name="telefono_cliente" placeholder="Ingrese telefono">
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Registrar cliente</button>
                    </div>
                <?= form_close()?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->