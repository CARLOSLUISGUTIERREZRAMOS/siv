<div class="box">
    <div class="box-header with-border">

        <button id="false" type="button" class="btn btn-social btn-bitbucket btn_agregar_gastos" data-toggle="modal" data-target="#modal-default">
            <i class="fa fa-money"></i> Agregar Gasto
        </button>

    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <form class="form-horizontal" style="display: none" id="form_ingreso_gastos" action="<?= base_url() ?>index.php/finanzas/Gastos/Registrar" method="POST">
            <div class="box-body">
                <div class="form-group">
                    <!--<div class="input-group date">-->
                    <!--                        <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>-->
                    <label for="inputPassword3" class="col-sm-2 control-label">Fecha</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control pull-right datepicker" name="fecha" placeholder="Fecha" autocomplete="off">
                    </div>
                    <!--</div>-->
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Importe</label>

                    <div class="col-sm-10">
                        <input type="text" name="importe" class="form-control" id="inputPassword3">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Moneda</label>

                    <div class="col-sm-10">
                        <select class="form-control" name="moneda">
                            <option value="USD">DOLARES</option>
                            <option value="PEN">SOLES</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Detalle</label>
                    <div class="col-sm-10">
                        <input type="text" name="detalle" class="form-control" id="inputPassword3">
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="reset" class="btn btn-default">Borrar</button>
                <button type="submit" class="btn btn-info pull-right">Cargar gastos</button>
            </div>
            <!-- /.box-footer -->
        </form>


        <table id="tbl_gastos" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Importe</th>
                    <th>Moneda</th>
                    <th>Detalle</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listado_gastos->result() as $item_gasto) { ?>
                <tr>
                    <td><?= $item_gasto->id?></td>
                    <td><?= $item_gasto->fecha?></td>
                    <td><?= $item_gasto->importe?></td>
                    <td><?= $item_gasto->moneda?></td>
                    <td><?= $item_gasto->detalle?></td>
                </tr>
                    <?php
                }
                ?>
            </tbody>

        </table>
    </div>
    <!-- /.box-body -->
    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">DETALLES</p>

          <div class="table-responsive">
            <table class="table">
              <tbody><tr>
                <th style="width:50%">Total Soles:</th>
                <td>S/ <?= (empty($total_soles)) ? 0.00 : $total_soles ?></td>
              </tr>
              <tr>
                <th>Total Dolares:</th>
                <td>$ <?=$total_dolares?></td>
              </tr>
              
            </tbody></table>
          </div>
        </div>
        <!-- /.col -->
      </div>
</div>