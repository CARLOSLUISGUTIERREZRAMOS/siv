<div class="row">
    <div class="col-lg-6 col-xs-6">
        <div class="form-group">
            <label>Rango de Fechas:</label>&nbsp;&nbsp;

            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="rango_fechas">
            </div>
            <!-- /.input group -->
        </div>    
    </div>
    <div class="col-lg-2 col-xs-6">
        <label>&nbsp;</label>
        <button type="button" class="btn btn-block btn-default" id="btn_busqueda"><i class="fa fa-search"></i></button>
    </div>
</div>


<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-gray" style="background-color: #d5dce8">
            <div class="inner">
                <h3 style="font-size: 25px">$ <?= $abono_usd ?></h3>
                <h3 class="timeline-header" style="font-size: 18px;"><a>ABONOS USD</a></h3>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <br>
            <a href="#" class="small-box-footer">
                <label>
                  <input type="checkbox" class="minimal">
                </label>&nbsp;&nbsp;
                 Ver Historial <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-gray">
            <div class="inner">
                <h3 style="font-size: 25px">150</h3>
                <h3 class="timeline-header" style="font-size: 18px;"><a>DEPOSITO USD</a></h3>

            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <br>
            <a href="#" class="small-box-footer"> 
                <label>
                  <input type="checkbox" class="minimal">
                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                  Ver Historial <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-gray">
            <div class="inner">
                <h3 style="font-size: 25px">S/ <?= $abono_pen ?></h3>

                <h3 class="timeline-header" style="font-size: 18px;"><a>ABONOS PEN</a></h3>

<!--              <p>ABONOS PEN</p>-->
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <br>
            <a href="#" class="small-box-footer" id="elmento_pen">
                <label>
                    <input type="checkbox" class="minimal">
                </label>&nbsp;&nbsp;
                Ver Historial <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-gray">
            <div class="inner">
                <h3 style="font-size: 25px">150</h3>
                <h3 class="timeline-header" style="font-size: 18px;"><a>DEPOSITOS PEN</a></h3>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <br>
            <a href="#" class="small-box-footer">
                <label>
                    <input type="checkbox" class="minimal">
                </label>&nbsp;&nbsp;
                 Ver Historial <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
</div>


<div class="modal fade" id="modal-detalle_cajabancos">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>