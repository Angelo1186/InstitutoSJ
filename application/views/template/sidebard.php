<div class="sidebar">
    <nav class="sidebar-nav sidebar-bg">
        <ul class="nav">
            <li class="nav-title">Menu</li>

            <li class="nav-item">
                <a class="nav-link active" >
                    <i class="fas fa-home"></i> Inicio
                </a>
            </li>
            <?php
            if ($this->session->userdata('id_grupo') == "1")
            {  ?>
            <li class="nav-item nav-dropdown" >
                <span class="nav-link nav-dropdown-toggle">
                    <i class="fas fa-user-tie"></i>Gesti&oacute;n ABM <i class="fa fa-caret-left"></i>
                </span>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('Profesor') ?>">
                            <i class="fas fa-user-tie"></i> Profesores
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('Alumno') ?>">
                            <i class="fas fa-user-tie"></i> Alumnos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('Materia') ?>">
                            <i class="fas fa-user-tie"></i> Materias
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('Carrera') ?>">
                            <i class="fas fa-user-tie"></i> Carreras
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('Correlatividad') ?>">
                            <i class="fas fa-user-tie"></i> Materias Correlativas
                        </a>
                    </li>
                    
                </ul>
            </li>
            <li class="nav-item nav-dropdown" >
                <span class="nav-link nav-dropdown-toggle">
                    <i class="fas fa-file-signature"></i>Gesti&oacute;n Cursos <i class="fa fa-caret-left"></i>
                </span>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('Curso') ?>">
                            <i class="far fa-file-alt"></i> Curso
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('Mesa') ?>">
                            <i class="far fa-file-alt"></i>Mesa
                        </a>
                    </li>
                </ul>
            </li>
            <?php  }  
            if($this->session->userdata('id_grupo') == "2")
            {?>
            <div>
           <li class="nav-item nav-dropdown" >
                <span class="nav-link nav-dropdown-toggle">
                    <i class="fas fa-file-signature"></i>Gesti&oacute;n Profesor <i class="fa fa-caret-left"></i>
                </span>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('ProfesorDictando/Materias') ?>">
                            <i class="far fa-file-alt"></i> Mis Materias
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('ProfesorDictando/MesaAsignadas') ?>">
                            <i class="far fa-file-alt"></i>Mesas Asignadas
                        </a>
                    </li>
                </ul> 
             </li> 
             </div>
             <?php } 
              if($this->session->userdata('id_grupo') == "3")
              {?>
               <div>
           <li class="nav-item nav-dropdown" >
                <span class="nav-link nav-dropdown-toggle">
                    <i class="fas fa-file-signature"></i>Gesti&oacute;n Alumno <i class="fa fa-caret-left"></i>
                </span>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="<= site_url('AlumnoCursando/Notas') ?>">
                            <i class="far fa-file-alt"></i> Mis Notas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<= site_url('AlumnoCursando/InscripcionMaterias') ?>">
                            <i class="far fa-file-alt"></i>Inscripción Materias
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<= site_url('AlumnoCursando/FechaExamen') ?>">
                            <i class="far fa-file-alt"></i>Fecha Examen Final
                        </a>
                    </li>
                </ul> 
             </li> 
             </div>
             <?php } ?>
           

        </ul>
    </nav>
</div>