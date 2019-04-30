<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SIV</title>
        <link rel="icon" type="image/png" href="<?= base_url() . 'img/compra.ico' ?>">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php echo link_tag('css/bootstrap/bootstrap.min.css'); ?>
        <?php echo link_tag('css/font-awesome/css/font-awesome.min.css'); ?>
        <?php echo link_tag('css/Ionicons/ionicons.min.css'); ?>
        <?php echo link_tag('css/pace/pace.min.css'); ?>
        <?php echo link_tag('css/skins/_all-skins.min.css'); ?>
        <?php echo $styles ?>
        <?php echo link_tag('css/lte/AdminLTE.min.css'); ?>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-blue sidebar-mini fixed">

        <div class="pace  pace-inactive">
            <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
                <div class="pace-progress-inner"></div>
            </div>
            <div class="pace-activity"></div></div>

        <div class="wrapper">

            <!-- CABECERA PRINCIPAL-->
            <?php $this->template->load_header(); ?>

            <!-- MENU DE OPCIONES -->
            <?php $this->template->load_menu($this->session->id_usuario); ?>

            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        <?= $titulo ?>
                        <!--<small>Control panel</small>-->
                    </h1>
                    <!-- breadcrumb finalizado  -->
                    <ol class="breadcrumb"> 

                        <?php if (is_null($data_ubicacion)) { ?>
                            <li><a href="#"><i class="fa fa-home"></i> .</a></li>
                            <li class="active">Principal</li>
                            <?php
                        } else {
                            $data = explode('|', $data_ubicacion);
                            ?>
                            <li><a ><i class="<?= $data[0] ?>"></i><?= $data[1] ?></a></li>
                            <?php for ($i = 2; $i <= (count($data) - 1 ); $i++) { ?>
                                <li class="active"><?= $data[$i] ?></li> 
                            <?php } ?>
                        <?php } ?>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <?= $contents ?>
                </section>
                <!-- /.content -->
            </div>

            <!-- FOOTER -->
            <?php $this->template->load_footer(); ?>
            <!-- .FOOTER -->

            <!-- Control Sidebar Opciones -->
            <aside class="control-sidebar control-sidebar-dark">
                <div class="tab-content">
                    <div class="tab-pane" id="control-sidebar-home-tab">
                    </div>
                </div>
            </aside>
        </div>

        <?php echo script_tag('js/jquery/jquery.min.js'); ?>
        <?php echo script_tag('js/jquery/jquery-ui.min.js'); ?>
<!--        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>-->
        <?php echo script_tag('js/bootstrap/bootstrap.min.js'); ?>
        <!-- INPUT MASK -->
        <!-- .INPUT MASK -->
        <?php echo script_tag('js/pace/pace.min.js'); ?>
        <?php echo $scripts; ?>

        <?php echo script_tag('js/lte/adminlte.min.js'); ?>
        <?php echo script_tag('js/app/layout.js'); ?>
        <?php echo script_tag('js/disenio/plantilla.js'); ?>

    </body>
</html>


