<div class="box box-primary">


    <div class="box-header with-border">
        <h3 class="box-title">Creación del Pedido</h3>
    </div>


    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="fecha_pedido" class="col-sm-2 col-md-4 control-label">Fecha de Pedido</label>
                        <div class="col-sm-10 col-md-8">
                            <input type="text" class="form-control" id="fecha_pedido" disabled value="<?= (new DateTime())->format("d/m/Y") ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nro_pedido" class="col-sm-2 col-md-4 control-label">Nro de Pedido</label>

                        <div class="col-sm-10 col-md-8">
                            <input type="text" class="form-control" id="nro_pedido" disabled value="<?php printf('%010d', $NewCodPedido); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre_cliente" class="col-sm-2 col-md-4 control-label" >Nombre de Cliente</label>

                        <div class="col-sm-10 col-md-8">

                            <select class="form-control" id="codigo_cliente" name="codigo_cliente">
                                <option disabled selected value>  SELECCIONE CLIENTE  </option>
                                <?php foreach ($Clientes->result() as $cliente) { ?>
                                    <option  value="<?= $cliente->codigo ?>"><?= $cliente->nombres . ' ' . $cliente->apellidos ?></option>

                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="codigo_producto" class="col-sm-2 col-md-4 control-label">Productos</label>

                        <div class="col-sm-10 col-md-8">
                            <select class="form-control" id="producto" name="producto">
                                <option disabled selected value> -- SELECCIONE PRODUCTO -- </option>
                                <?php foreach ($Productos->result() as $productos) { ?>
                                    <option value="<?= $productos->codigo . '|' . $productos->costo_unitario . '|' . $productos->peso ?>"><?= $productos->nombre ?></option>

                                    <?php
                                }
                                ?>
                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="cantidad_pedido" class="col-sm-2 col-md-4 control-label">Cantidad de Productos</label>

                        <div class="col-sm-10 col-md-8">
                            <input type="number" class="form-control" id="cantidad_pedido" placeholder="Cantidad" value="1">
                        </div>

                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="reset" class="btn btn-default">Borrar</button>
                    <button id="anadir" type="button" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Añadir Producto</button>
                </div>
                <!-- /.box-footer -->
            </form>    
            </div>
            <div class="col-md-6">
                
            </div>
        </div>

    </div>




</div>

<?php
$data['costo_libra_today'] = $costo_libra_today;
$data['tipo_cambio_compra_today'] = $tipo_cambio_compra_today;
$this->load->view('pedidos/v_bloque_pedido', $data);
$this->load->view('templates/v_error');
?>