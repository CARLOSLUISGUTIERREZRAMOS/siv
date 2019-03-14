<header class="main-header">
    <!-- Logo -->
    <a href="<?= base_url() . 'interno/main' ?>" class="logo">
        <span class="logo-mini">SIV</span>
    
        <span class="logo-lg"><b>    <img src="<?= base_url() . 'img/logo_ventas.png'; ?>">SIV</b>ADMIN</span>
        
<!--        <div class="pull-left image">
            <img width="25%" height="25%" src="<?= base_url() . 'img/logo_ventas.png'; ?>" class="img-responsive" alt="STARPERU">
        </div>-->
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= base_url() . 'img/user.png' ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?= $this->session->nombre . ' ' . $this->session->apellido ?> </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= base_url() . 'img/user.png' ?>" class="img-circle" alt="User Image">

                            <p>
                                <?= explode(' ', $this->session->nombre)[0] . ' ' . explode(' ', $this->session->apellido)[0] ?> - <?= $this->session->rol ?>
                                <!--<small>Member since Oct. 2017</small>-->
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <!--<a href="#" class="btn btn-default btn-flat">Profile</a>-->
                            </div>
                            <div class="pull-right">
                                <a href="<?= base_url('interno/main/logout') ?>" class="btn btn-default btn-flat">Cerrar sesión</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button | Boton de opciones-->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>