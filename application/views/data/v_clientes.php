<div class="box box-primary">
    <div class="box-header with-border">
        <button type="button" class="btn btn-social btn-bitbucket" data-toggle="modal" data-target="#modal-default">
            <i class="fa fa-user-plus"></i> Añadir clientes
        </button>
    </div>
    <div class="box-body table-responsive">
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
    $this->load->view('data/v_modal_formulario_clientes');
    ?>