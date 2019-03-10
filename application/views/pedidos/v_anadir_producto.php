<section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header"> <a class="btn btn-default btn-social btn-dropbox">
                <i class="fa fa-plus"></i> Pedido Nuevo
              </a>
            <small class="pull-right">Fecha del día: <?=(new DateTime())->format('d/m/Y')?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      
      <div class="box box-body" style="display: ">
            <div class="box-header with-border">
              <h3 class="box-title">Creación del Pedido</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <!--<form class="form-horizontal">-->
            
            <?php
            $atributos = array('class' => 'form-horizontal');
            echo form_open('operaciones/Pedidos/CreaPedido',$atributos)?>
              <div class="box-body">
                <div class="form-group">
                  <label for="fecha_pedido" class="col-sm-2 control-label">Fecha de Pedido</label>

                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="fecha_pedido" disabled value="<?= (new DateTime())->format("d/m/Y")?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="nro_pedido" class="col-sm-2 control-label">Nro de Pedido</label>

                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="nro_pedido" disabled value="<?php printf('%010d',$NewCodPedido);?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="nombre_cliente" class="col-sm-2 control-label">Nombre de Cliente</label>

                  <div class="col-sm-10">
                      
                      <select class="form-control">
                          <?php 
                          foreach ($Clientes->result() as $cliente){ ?>
                          <option  value="<?= $cliente->codigo?>"><?=$cliente->nombres. ' '.$cliente->apellidos?></option>
                          
                          <?php
                          }
                          ?>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="codigo_cliente" class="col-sm-2 control-label">Productos</label>

                  <div class="col-sm-10">
                    <select class="form-control">
                          <?php 
                          foreach ($Productos->result() as $productos){ ?>
                        <option value="<?= $productos->codigo?>"><?=$productos->nombre?></option>
                          
                          <?php
                          }
                          ?>
                      </select>
                  </div>
                  
                </div>
                  <div class="form-group">
                  <label for="cantidad_pedido" class="col-sm-2 control-label">Cantidad de Productos</label>

                  <div class="col-sm-10">
                     <input type="number" class="form-control" id="cantidad_pedido" placeholder="Cantidad">
                  </div>
                  
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                  <button type="reset" class="btn btn-default">Limpiar</button>
                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Añadir Producto</button>
              </div>
              <!-- /.box-footer -->
            <?= form_close()?>
            <!--</form>-->
            
          </div>
      
    </section>

<?php 

$this->load->view('pedidos/v_bloque_pedido');
?>