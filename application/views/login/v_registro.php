
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 2 | Registration Page</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <?php echo link_tag('css/bootstrap/bootstrap.min.css'); ?>
        <?php echo link_tag('css/font-awesome/css/font-awesome.min.css'); ?> 
        <?php echo link_tag('css/Ionicons/ionicons.min.css'); ?>
        <?php echo link_tag('css/select2/select2.min.css'); ?>
        <?php echo link_tag('css/lte/AdminLTE.min.css'); ?>

        <!--<link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">-->
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition register-page">
        <div class="register-box">
            <div class="register-logo">
                <a href="<?= base_url() ?>"><b>SISTSTAR</b></a> REGISTRO
            </div>

            <div class="register-box-body">
                <p class="login-box-msg">Registro de un nuevo usuario</p>
                <?= validation_errors(); ?>
                <?= form_open('interno/RegUsuario/valida'); ?>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Nombres" name="regNombre">
                    <span class="glyphicon glyphicon-italic form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Apellidos" name="regApellido">
                    <span class="glyphicon glyphicon-italic form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email (usuario@starperu.com)" name="regEmail">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" name="regCelular" class="form-control" data-inputmask='"mask": "999-999-999"' data-mask>
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" name="regAnexo" placeholder="ANEXO OFICINA" class="form-control" data-inputmask='"mask": " 999 "' data-mask>
                    <span class="glyphicon glyphicon-paperclip form-control-feedback"></span>
                </div>

                <div class="form-group">
                    <select name="regCiudad" class="form-control" required>
                        <option disabled selected value>  SELECCIONE CIUDAD  </option>
                        <?php
                        foreach ($ciudad->result() as $ciudad) {
                            echo "<option value=\"$ciudad->cod_ciudad\">$ciudad->nombre_ciudad</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <select name="regCargo" class="form-control select2" required>
                        <option disabled selected value>  SELECCIONE CARGO  </option>
                        <?php
                        foreach ($cargo->result() as $cargo) {
                            echo "<option value=\"$cargo->id_cargo\">$cargo->nombre_cargo</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <select name="regAreaTrabajo" class="form-control select2" required>
                        <option disabled selected value>  SELECCIONE SU AREA DE TRABAJO</option>
                        <?php
                        foreach ($area_trabajo->result() as $area_trabajo) {
                            echo "<option value=\"$area_trabajo->codigo_area\">$area_trabajo->nombre_area</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="row">

                    <div class="col-xs-12">
                        <?= form_input(array('class' => 'btn btn-success btn-block btn-flat', 'type' => 'submit', 'value' => "REGISTRARME")) ?>
                    </div>
                    <!-- /.col -->
                </div>

            </div>
            <!-- /.form-box -->
        </div>

   


        <!-- /.register-box -->

        <?php echo script_tag('js/jquery/jquery.min.js'); ?>
        <?php echo script_tag('js/bootstrap/bootstrap.min.js'); ?>
        <?php echo script_tag('js/login/registro.js'); ?>
        <?php echo script_tag('js/select2/select2.full.min.js'); ?>
        <?php echo script_tag('js/plugins/input-mask/jquery.inputmask.js'); ?>
        <!-- iCheck -->
        <!--<script src="../../plugins/iCheck/icheck.min.js"></script>-->



    </body>
</html>


