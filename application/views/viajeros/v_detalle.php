<div class="modal fade" id="modal-detalle" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">DETALLE DEL VIAJE</h4>
            </div>
            <div class="modal-body">

                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <b>Id Viaje: </b><span id="id_viaje"></span>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Viajero: </b><span id="nombres_viajero"></span>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Aerolínea: </b> <span id="aerolinea"></span>
                    </div>
                    <!-- /.col -->
                </div>
                <br>

                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Costo del Pasaje</th>
                                <th>Comisión del Viajero</th>
                                <th>Comisión ADN</th>
                                <th>Comisión Elvira</th>
                                <th>Impuesto Aduanas</th>
                                <th>Costo de Recojo</th>
                                <th>Gastos extras</th>
                                <th>COSTO TOTAL VIAJE </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="col-lg-4">
                                        <input type="text" value="" size="4">
                                    </div>
                                </td>
                                <td>
                                    <div class="col-xs-4">
                                        <input type="text" value=""  size="4">
                                    </div>
                                </td>
                                <td>
                                    <div class="col-xs-4">
                                        <input type="text" value="" size="4">
                                    </div>
                                </td>
                                <td>
                                    <div class="col-xs-4">
                                        <input type="text" value="" size="4">
                                    </div>
                                </td>
                                <td>
                                    <div class="col-xs-4">
                                        <input type="text" value="" size="4">
                                    </div>
                                </td>
                                <td>
                                    <div class="col-xs-4">
                                        <input type="text" value="" size="4">
                                    </div>
                                </td>
                                <td>
                                    <div class="col-xs-4">
                                        <input type="text" value="" size="4">
                                    </div>
                                </td>
                                <td>
                                    <div class="col-xs-4">
                                        <input type="text" value="" size="4" disabled>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-xs-7">
                        <p class="lead">Lista de productos enviados:</p>
                        <div class="table-responsive">

                            <div class="col-md-12">
                                <div class="box box-default box-solid collapsed-box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Pedido 0000000001</h3>

                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body" style="display: none;">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Pedido</th>
                                                    <th>Cantidad</th>
                                                    <th>Producto</th>
                                                    <th>Shipping</th>
                                                    <th>Peso libras</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>
                                                            <input type="checkbox" class="flat-red" checked>
                                                        </label>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>$ 250.00</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>





                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-5">

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Total libras enviadas: </td>
                                        <td>
                                            <div class="col-xs-12">
                                                <input type="text" value="" class="form-control input-sm">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total maletas enviadas: </td>
                                        <td>
                                            <div class="col-xs-12">
                                                <input type="number" value="" class="form-control input-sm">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Saldo para gastos: </th>
                                        <td>
                                            <div class="col-xs-12">
                                                <input type="text" value="" class="form-control input-sm">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- /.col -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>