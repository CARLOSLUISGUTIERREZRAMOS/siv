<div class="box box-primary">
    <div class="box-header with-border">

        <button type="button" class="btn btn-social btn-bitbucket btn_comprar" id="false" data-toggle="modal" data-target="#modal-default">
            <i class="fa fa-opencart"></i> Nueva Compra
        </button>

        <!--        <a class="btn btn-social btn-bitbucket">
                    <i class="fa fa-user-plus"></i>c
                </a>-->
    </div>
    <!-- /.box-header -->
    <!-- form start -->


    <div class="box-body">

        <form class="form-horizontal" id="form_ingreso_compras" style="display: none"  action="<?= base_url() ?>index.php/data/Productos/CargarCompra" method="POST">
            <div class="box-body">
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Fecha</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo (new DateTime())->format('d/m/Y') ?>" class="form-control">
                    </div>
                    <!--</div>-->
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Nombre de productos</label>

                    <div class="col-sm-10">
                        <select class="form-control" name="codigo">
                            <?php foreach ($ProductosObject->Result() as $item) { ?>
                                <option value="<?= $item->codigo ?>"><?= $item->nombre ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Cantidad</label>
                    <div class="col-sm-10">
                        <input type="number" name="cantidad" class="form-control" id="inputPassword3">
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="reset" class="btn btn-default">Borrar</button>
                <button type="submit" class="btn btn-info pull-right">Cargar compra</button>
            </div>
    </div>
    <!-- /.box-footer -->
</form>
<div class="box-body">
    <table id="tbl_clientes" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Codigo Producto</th>
                <th>Nombre</th>
                <th>Stock</th>
                <!--<th>Telefono</th>-->
            </tr>
        </thead>
        <tbody>

            <?php foreach ($ProductosObject->Result() as $producto) { ?>
                <tr>
                    <td><?= $producto->codigo ?></td>
                    <td><?= $producto->nombre ?></td>
                    <td><?= $producto->stock_actual ?></td>
                </tr>

                <?php
            }
            ?>

        </tbody>
    </table>
</div>



</div>

</div>
</div>
</div>