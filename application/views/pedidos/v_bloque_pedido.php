
<section class="invoice">
    <!-- title row -->
    <div class="row invoice-info">
        
        <div class="col-sm-4 invoice-col">
            <address>
                <strong>Numero de Pedido</strong>00
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <address>
                <strong>Nombre de Cliente</strong
            </address>
        </div>
        <div class="col-sm-4 invoice-col">
            <address>
                <strong>Codigo de Cliente</strong
            </address>
        </div>
        <!-- /.col -->
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Codigo de Producto</th>
                        <th>Nombre Producto</th>
                        <th>Cantidad Requerida</th>
                        <th>Costo Unitario</th>
                        <th>Costo de Envio</th>
                        <th>Costo T. Unitario</th>
                        <th>% de Ganancia</th>
                        <th>Valor de Ganancia</th>
                        <th>Precio unitario</th>
                        <th>Cantidad de venta</th>
                        <th>Precio total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Call of Duty</td>
                        <td>455-981-221</td>
                        <td>El snort testosterone trophy driving gloves handsome</td>
                        <td>$64.50</td>
                        <td>$64.50</td>
                        <td>$64.50</td>
                        <td>$64.50</td>
                        <td>$64.50</td>
                        <td>$64.50</td>
                        <td>$64.50</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
            <div class="row invoice-info">
                <br>
                <br>
                <br>
                <br>
                <div class="col-sm-4 invoice-col">
                    <address>
                        <strong>Fecha de Pedido:</strong>
                        <?= (new DateTime())->format("d/m/Y") ?>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <address>
                        <strong>Fecha de cotización:</strong
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    <address>
                        <strong>Fecha de venta:</strong
                    </address>
                </div>
                <!-- /.col -->
                <!-- /.col -->
            </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <!--<p class="lead">Detalles: </p>-->

            <div class="table-responsive">
                <table class="table">
                    <tbody><tr>
                            <th style="width:50%">Fecha de Pedido:</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Abono </th>
                            <td>$10.34</td>
                        </tr>
                        <tr>
                            <th>Saldo:</th>
                            <td>$5.80</td>
                        </tr>
                    </tbody></table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <!--<a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>-->
            <button type="button" class="btn btn-success pull-right"><i class="fa fa-shopping-cart"></i> Crear Pedido
            </button>
<!--            <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                <i class="fa fa-download"></i> Generate PDF
            </button>-->
        </div>
    </div>
</section>