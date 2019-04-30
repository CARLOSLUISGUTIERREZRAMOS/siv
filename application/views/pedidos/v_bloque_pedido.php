<section class="invoice bloque_pedido" style="display: none">
    <i class="fa fa-refresh fa-spin"></i> Generando Pedido  
    <!-- title row -->
    <div class="row invoice-info">

        <div class="col-sm-4 invoice-col">
            <address>
                <strong><i class="ion ion-clipboard"></i> Numero de Pedido: </strong><span id="span_nro_pedido"></span>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <address>
                <strong>Nombre de Cliente: </strong><span id="span_nombre_cliente"></span>

            </address>
        </div>
        <div class="col-sm-4 invoice-col">
            <address>
                <strong>Codigo de Cliente: </strong><span id="span_codigo_cliente"></span>
            </address>
        </div>
        <!-- /.col -->
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table   -striped"  id="tablapedido">
                <thead>
                    <tr>
                        <th>Codigo de Producto</th>
                        <th>Nombre Producto</th>
                        <th>Cantidad</th>
                        <th>Costo Unitario</th>
                        <th>Peso en libras</th>
                        <th>Shipping unitario</th>
                        <th>COSTO UNIT.TOTAL</th>
                        <th>Costo T. Producto</th>
                        <th>Ganancia Unitaria</th>
                        <th>Precio Unit. de Venta (USD)</th>
                        <th>Precio Unit. de Venta (PEN)</th>
                        <th>Precio total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th class="costo_unitario_total_sumatoria"></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th></th>
                         <th class="precio_total_sumatoria"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <!-- accepted payments column -->
        <!-- /.col -->
        <div class="col-xs-12 col-lg-7">
            <div class="row invoice-info">
                <div class="col-sm-7 invoice-col">
                    <b>PRESUPUESTO POR COMPRA: </b><span id="presupuesto_x_compra"></span><br>
                </div>
                <!-- /.col -->
               
                <!-- /.col -->
            </div>
        </div>
        <br>
        <br>
        <div class="col-xs-12 col-lg-7">
            <div class="row invoice-info">
                <div class="col-sm-7 invoice-col">
                    <b>PRESUPUESTO POR ENVIO: </b><span id="presupuesto_x_envio"></span><br>
                </div>
                <!-- /.col -->
                
                <!-- /.col -->
            </div>
        </div>
        <br>
        <br>
        <div class="col-xs-12 col-lg-7">
            <div class="row invoice-info">
                 <div class="col-sm-6 invoice-col">
                    <b>Costo por libra: </b> <?= $costo_libra_today ?><br>
                </div>
                <!-- /.col -->
                <div class="col-sm-6 invoice-col">
                    <b>Tipo de cambio (Compra): </b> <span id="tc_compra"><?= $tipo_cambio_compra_today ?></span><br>
                </div>
<!--                <div class="col-sm-4 invoice-col">
                    <b>Tipo de cambio(Venta): </b> <span id="tc_venta"><?= $tipo_cambio_venta_today?></span><br>
                </div>-->
            </div>
        </div>
        

        
        <div class="col-xs-12 col-lg-5">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th style="width:50%">PRECIO TOTAL PEDIDO:</th>
                            <td><span id="total_all_pedido"></span></td>
                        </tr>
                        <tr>
                            <th>ABONO:</th>
                            <td><input type="text" class="form-control" name="abono" id="abono" value="0.00" placeholder="Ingrese el abono"></td>
                        </tr>
                        <tr>
                            <th>SALDO:</th>
                            <td><span id="saldo">0.00</td>
                        </tr>
                        <tr>
                            <th>SHIPPING TOTAL PEDIDO:</th>
                            <td><span id="shipping_all_pedido"></span></td>
                        </tr>
                        <tr>
                            <th>COSTOS TOTALES</th>
                            <td><span id="costos_totales_all"></span></td>
                        </tr>
                        <tr>
                            <th>GANANCIA TOTAL</th>
                            <td><span id="ganancia_total_all"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>

    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            <b>Fecha de Pedido: </b> <?= (new DateTime())->format('d/m/Y')?><br>
        </div>
        <div class="col-sm-4 invoice-col">
        </div>
        <div class="col-sm-4 invoice-col">
        </div>
    </div>

    <!-- /.row -->
    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <!--<a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>-->
            <button type="button" class="btn btn-success pull-right btn_crear_pedido"><i class="fa fa-shopping-cart"></i> Crear Pedido</button>
        </div>
    </div>
</section>

