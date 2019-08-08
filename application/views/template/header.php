<nav class="navbar navbar-dark page-header fixed-top shadow page-header-custom ">

    <span class="sidebar-mobile-toggle d-lg-none mr-auto">
        <i class="fas fa-bars fa-lg mr-3 mb-2"></i>
    </span>
    <span class="sidebar-toggle d-md-down-none">
        <i class="fas fa-bars fa-lg mx-3 mb-2"></i>
    </span>
    <a class="navbar-brand mx-3">
        
        <img class="image-logo"src="<?php echo base_url(); ?>media/images/Icono.jpg" alt="logo">
        <span>Instituto Superior Jujuy </span>
    </a>

    <ul class="navbar-nav ml-auto">
        <!-- Campana para notificaciones
        <li class="nav-item d-md-down-none">
            <a href="#">
                <i class="fas fa-bell"></i>
                <span class="badge badge-pill badge-danger">5</span>
            </a>
        </li>
        -->

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle fa-2x mr-1"></i>
                    <!--<img src="<?php echo base_url(); ?>media/images/avatar-1.png" class="avatar avatar-sm" alt="logo">-->
                    <span class="small ml-1 d-md-down-none"><?=$this->session->userdata('nombre')?></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">Ajustes</div>
<!--                <a href="#" class="dropdown-item">
                    <i class="fas fa-bell"></i> Notificaciones
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-user-cog"></i> Cuenta
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-key"></i> Cambiar Contrase&ntilde;a
                </a>-->
                <a href="<?=  site_url('login/logout')?>" class="dropdown-item">
                    <i class="fas fa-sign-out-alt"></i> Cerrar sesi&oacute;n
                </a>
            </div>
        </li>
    </ul>
</nav>