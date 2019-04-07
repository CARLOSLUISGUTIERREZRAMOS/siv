<div class="box box-primary">
    <div class="box-header with-border">
        
        <button type="button" class="btn btn-social btn-bitbucket" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-user-plus"></i> Añadir clientes
              </button>
        
<!--        <a class="btn btn-social btn-bitbucket">
            <i class="fa fa-user-plus"></i>c
        </a>-->
    </div>
    <!-- /.box-header -->
    <!-- form start -->


    <div class="box-body">
        <table id="tbl_clientes" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Codigo Cliente</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($ClientesObject->Result() as $cliente) { ?>
                    <tr>
                        <td><?= $cliente->codigo ?></td>
                        <td><?= $cliente->nombres ?></td>
                        <td><?= $cliente->apellidos ?></td>
                        <td><?= $cliente->email ?></td>
                        <td><?= $cliente->telefono ?></td>
                    </tr>

                    <?php
                }
                ?>

            </tbody>
        </table>

   
    </div>
    
    <?php 
    
    $this->load->view('clientes_productos/v_modal_formulario_clientes');
    ?>