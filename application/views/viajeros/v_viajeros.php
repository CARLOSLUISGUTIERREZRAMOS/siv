<?php
$msg_viajero = $this->session->flashdata('msg_viajero');
$INSERTO = $this->session->flashdata('INSERTO');
if (isset($_GET['error']) && $_GET['error'] == '1') {
    ?>

    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-warning"></i> Error</h4>

        <p>El viaje ya fue registrado, la duplicidad de información no esta permitida en el sistema.</p>
    </div>
    <?php
}


//if (isset($msg_viajero) || (isset($_GET['error']) && $_GET['error'] != 1)) {
if (isset($msg_viajero)) {
    if ($INSERTO) {
        ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Exito!</h4>
            <p> <i class="fa fa-check-square-o"></i> <?= $msg_viajero ?></p>
        </div>
    <?php } else {
        ?>
         <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i> Error</h4>
            <p>Error al registrar el viaje. Comuniquese con el administrador del sistema.</p>
        </div>

        <?php
    }
}
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <button id="false" type="button" class="btn btn-social btn-bitbucket btn_agregar_viaje" data-toggle="modal" data-target="#modal-default">
            <i class="fa fa-planefa fa-plane"></i> Nuevo Viaje
        </button>

    </div>
    <div class="box-body">
        <form class="form-horizontal" id="form_ingreso_viaje" style="display: none"  action="<?= base_url() ?>index.php/operaciones/Viaje/Registrar" method="POST">
            <div class="box-body">
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Fecha</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo (new DateTime())->format('d/m/Y') ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Fecha de Envío</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control pull-right datepicker" name="fecha_envio" placeholder="Fecha de Envio" autocomplete="off">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Maletas Enviadas</label>
                    <div class="col-sm-10">
                        <input type="number" name="maletas_enviadas" class="form-control" id="inputPassword3" placeholder="Cantidad de maletas">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Nombres del Viajero</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nombres_viajero" placeholder="Nombres del Viajero">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Apellidos del Viajero</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="apellidos_viajero" placeholder="Apellidos del Viajero">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Aerolínea</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="aerolinea_id">
                            <?php foreach ($lista_aerolineas->Result() as $item) { ?>
                                <option value="<?= $item->id ?>"><?= $item->nombre ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-xs-4">
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-block btn-primary btn-sm pull-right">Crear Viaje</button>
                    </div>
                    <div class="col-xs-4">
                    </div>

                </div>
            </div>
        </form>

    </div>

    <?= form_close() ?>
    <div class="box-body">
        <div class="table-responsive">
            <table id="tbl_list_viajes" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Identificador</th>
                        <th>Fecha de envio</th>
                        <th>Nombres de viajero</th>
                        <th>Apellidos de viajero</th>
                        <th>Aerolínea</th>
                        <th>Maletas enviadas</th>
                        <th>Fecha de recepción</th>
                        <th>Maletas recepcionadas</th>
                        <th>Maletas observadas</th>
                        <th>Detalle</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($lista_viajeros->Result() as $viajero) {
                        if (isset($viajero->fecha_recepcion)) {
                            $fecha_recepcion = (new DateTime($viajero->fecha_recepcion))->format('d/m/Y');
                            $disabled = 'disabled';
                        } else {
                            $fecha_recepcion = "";
                            $disabled = '';
                        }
                        $disabled_maletas_recepcionadas = (is_null($viajero->maletas_recepcionadas)) ? '' : 'disabled';
                        echo form_open('operaciones/Viaje/Recepcionar');
                        ?>

                        <tr>
                            <td><?= $viajero->id ?></td>
                            <td><?= $viajero->fecha_envio ?></td>
                            <td><?= $viajero->nombres_viajero ?></td>
                            <td><?= $viajero->apellidos_viajero ?></td>
                            <td><?= $viajero->nombre ?></td>
                            <td id="maleta_num_<?= $viajero->id ?>"><?= $viajero->maletas_enviadas ?></td>
                            <td><div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="fecha_recepcion_<?= $viajero->id ?>" class="form-control pull-right datepicker" name="fecha_recepcion" placeholder="Fecha de recepcion" <?= $disabled ?> value="<?= $fecha_recepcion ?>" autocomplete="off">
                                </div></td>
                            <td><input type="number" id="maletas_recepcionadas_<?= $viajero->id ?>" name="maletas_recepcionadas" class="form form-control maletas_recepcionadas" <?= $disabled_maletas_recepcionadas ?> value="<?= (isset($viajero->maletas_recepcionadas)) ? $viajero->maletas_recepcionadas : '' ?>"></td>
                            <td id="maletas_observadas_<?= $viajero->id ?>">
                                <?= (is_null($viajero->maletas_observadas)) ? '' : $viajero->maletas_observadas ?>
                            </td>
                            <td>
                                <a type="button" class="btn btn-default" href="<?= base_url() ?>operaciones/Viaje/VerDetalleViaje?codigo_viaje=<?= $viajero->id ?>&arg2=<?=$viajero->maletas_enviadas?>&arg3=<?=$viajero->nombre?>&arg4=<?=$viajero->nombres_viajero?>"><i class="fa fa-th-list"></i></button></a>
                                <!--<button type="button" id="<?= $viajero->id ?>" class="btn btn-default btn_verDetalle" title="Ver detalle" data-toggle="modal" data-target="#modal-detalle"><i class="fa fa-list-alt"></i></button>-->
                            </td>
                            <td>
                                <input type="hidden" name="id" value="<?= $viajero->id ?>">
                                <button type="submit" id="<?= $viajero->id ?>" class="btn btn-default btn-flat btn_save"><i class="fa fa-save"></i></button>
                            </td>
                        </tr>

                        <?php
                        echo form_close();
                    }
                    ?>


                </tbody>
            </table>
        </div>
    </div>



</div>