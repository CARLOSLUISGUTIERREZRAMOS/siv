<div class="box box-primary">
    <div class="box-header with-border">
        
        <button type="button" class="btn btn-social btn-bitbucket" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-cubes"></i> Añadir producto
              </button>
        
<!--        <a class="btn btn-social btn-bitbucket">
            <i class="fa fa-user-plus"></i>c
        </a>-->
    </div>
    <div class="box-body">
        <table id="tbl_clientes" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Codigo Producto</th>
                    <th>Nombre</th>
                    <th>Costo unitario</th>
                    <th>Peso</th>
                    <th>Estado</th>
                    <!--<th>Telefono</th>-->
                </tr>
            </thead>
            <tbody>

                <?php foreach ($ProductosObject->Result() as $producto) { ?>
                    <tr>
                        <td><?= $producto->codigo ?></td>
                        <td><?= $producto->nombre ?></td>
                        <td>USD <?= $producto->costo_unitario ?></td>
                        <td><i class="fa fa-balance-scale"></i> <?= (is_null($producto->peso)) ? 0 : $producto->peso?></td>
                        <td><?= ($producto->estado === 'Y') ? 'ACTIVO' : 'DESACTIVADO' ?></td>
                    </tr>

                    <?php
                }
                ?>

            </tbody>
        </table>

   
    </div>
    
    <?php 
    
    $this->load->view('data/v_modal_formulario_productos');
    ?>