     
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SISTSTAR | MENSAJE DE RESPUESTA</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <?php echo link_tag('css/bootstrap/bootstrap.min.css'); ?>
        <?php echo link_tag('css/lte/AdminLTE.min.css'); ?>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="modal-open">
        <!--       <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-success">
                        Launch Success Modal
                      </button>-->

        <div class="modal <?= $tipoModal ?> fade" id="modal-success">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <img src="<?= base_url() ?>img/logo_starperu.png">
                        <!--<h4 class="modal-title">Success Modal</h4>-->
                    </div>
                    <div class="modal-body">
                        <p style="text-align: center"><?= $mensaje ?></p>
                    </div>
                    <div class="modal-footer">
                        <?php
                        if ($botonBack) {
                            ?>
                            <a type="button" class="btn btn-outline pull-left" href="javascript:history.back()">Volver</a>
                            <?php
                        }else{ ?>
                            <a type="button" class="btn btn-outline pull-right" href="<?= base_url() ?>">Entiendo</a>
                         <?php   
                        }
                        ?>
                        <!--<button type="button" class="btn btn-outline pull-left" id="modalVolver">Volver</button>-->
                        <!--<button type="button" class="btn btn-outline">Save changes</button>-->
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


        <?php echo script_tag('js/jquery/jquery.min.js'); ?>
        <?php echo script_tag('js/bootstrap/bootstrap.min.js'); ?>
        <?php echo script_tag('js/login/registro.js'); ?>

    </body>
</html>



