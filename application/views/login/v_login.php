<!DOCTYPE html>
<html>
    <head>
        <style>
            
        body {

	background: url(img/img.gif) no-repeat center top;

}
        </style>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SIS.STARPERU | Log in</title>
        <link rel="icon" type="image/png" href="<?= base_url() . 'img/compra.ico' ?>">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php echo link_tag('css/bootstrap/bootstrap.min.css'); ?>
        <?php echo link_tag('css/font-awesome/css/font-awesome.min.css'); ?> 
        <?php echo link_tag('css/Ionicons/ionicons.min.css'); ?>
        <?php echo link_tag('css/lte/AdminLTE.min.css'); ?>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <b>SIV</b>SISTEMA
            </div>

            <div class="login-box-body">
                <?= validation_errors(); ?>
                <?= form_open('login'); ?>
                <div class="form-group has-feedback">
                    <?= form_input(array('class' => 'form-control', 'type' => 'txt', 'placeholder' => "CODIGO USUARIO", 'name' => 'codigoUsuario')); ?>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <?= form_input(array('class' => 'form-control', 'type' => 'password', 'placeholder' => "CONTRASEÑA", 'name' => 'password')); ?>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <?= form_input(array('class' => 'btn btn-danger btn-block btn-flat', 'type' => 'submit', 'value' => "INGRESAR")) ?>
                    </div>
                </div>
                <?= form_hidden(array('validar' => '1')); ?>

            </div>
           


            <footer class="footer">
                <div class="text-right">
                    <b>Sistema de Inventarios y Ventas</b> v1.6
                </div>

            </footer>  
        </div>
        <?php echo script_tag('js/jquery/jquery.min.js'); ?>
        <?php echo script_tag('js/bootstrap/bootstrap.min.js'); ?>
<?php // echo script_tag('js/plugins/icheck.min.js');  ?>
    </body>
</html>