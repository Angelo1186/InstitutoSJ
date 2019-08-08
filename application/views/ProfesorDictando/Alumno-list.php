<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {   

        $("#submit_buscar").click(function()
        {    
            debugeer;           
            $("#submit_buscar").attr('disabled',true).attr('value','Espere...'); 
            $("#formbusqueda").submit();
        });
        $('#tabla_clientes').dataTable({            
            "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se encontraton resultados",
            "info": "Total",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(Filtrado de _MAX_ Entrada Totales)"
             },
            "paging":   true,
            "ordering": true,
            "order": [[ 0, "asc" ]]
                    
        });
    });
    

    function Guardar1()
  {
      nota=$("#nota2").val();
      idAlumno=$("#IdAlumno1").val();
      idMateria=$("#IdMateria1").val();
      idNumeroParcial=$("#IdNumeroParcial").val(); 
        $.ajax(
            {   type:'post',
                url:"<?= site_url('ProfesorDictando/SaveNotas') ?>" ,
                data:{"idAlumno":idAlumno,"idMateria":idMateria,"nota":nota,"idNumeroParcial":idNumeroParcial}
             }).done(function(data) {
                $("#IdNotas").html('');
                $("#IdNotas").html(data);
            });
  }
    function CargarNotas(idAlumno,idCurso)
    {
        $.ajax(
            {   type:'post',
                url:"<?= site_url('ProfesorDictando/getNotas') ?>" ,
                data:{"idAlumno":idAlumno,"idCurso":idCurso}
             }).done(function(data) {
                $("#IdNotas").html('');
                $("#IdNotas").html(data);
            });
    }
    function EliminarNotasp(IdNotas2)
    {
            if (confirm("Esta seguro de Eliminar la Nota???")) {
                $.ajax(
                    {type:'post',
                     url:"<?= site_url('ProfesorDictando/DeleteNotas') ?>" ,
                     data:{"idNota":IdNotas2}
                    }).done(function(data) {
                        $("#IdNotas").html('');
                        $("#IdNotas").html(data);
                    }).fail(function (jqXHR, textStatus) {
                     alert("Error al queres eliminar la Nota");  
                    });
            } 
    }
</script>
<style type="text/css"> 
 .fullscreen-modal .modal-dialog {
	margin: 0;
	margin-right: auto;
	margin-left: auto;
	width: 100%;
  }
  @media (min-width: 768px) {
	.fullscreen-modal .modal-dialog {
      max-width: 750px;
      /* left: -263px; 
       top: 54px; */
	}
  }
  @media (min-width: 992px) {
	.fullscreen-modal .modal-dialog {
      max-width: 970px;
      /* left: -563px; 
       top: 104px; */
	}
  }
  @media (min-width: 1200px) {
	.fullscreen-modal .modal-dialog {
       max-width: 1200px;
       /* left: -763px; 
       top: 134px; */
	}
  }
</style> 

<?= $this->session->flashdata('mensaje'); ?>
<div class="row col-md-12">
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive mt-3">
                    <h3>Listado de los Alumnos </h3>
                    <table class="table" id="tabla_clientes">
                        <thead>
                            <tr>
                                <th>Nombre Alumno</th>
                                <th>DNI</th>
                                <th>Ver notas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count($cursoAlu) > 0) {
                                foreach ($cursoAlu as $cursoAl):
                                    ?>
                                    <tr >
                                        <td><?= $cursoAl->IdAlumno->Nombre?></td>
                                        <td><?= $cursoAl->IdAlumno->Dni ?></td>
                                        <td>
                                            <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                                    <a  href="#" onclick="CargarNotas(<?=$cursoAl->IdAlumno->IdAlumno?>,<?=$cursoAl->IdCurso?>)" class="btn btn-primary" title="Conocer Sus Notas"><i class="fas fa-file-signature"></i></a>                          
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                            }
                            else
                                echo'<tr><td colspan="4" class="alert alert-danger">No se encontraton Alumnos</td></tr>';
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-light">
                    <a href="<?= site_url('ProfesorDictando/Materias')?>" class="btn btn-danger ml-3"  title="Cancelar"><i class="far fa-times-circle"></i> &nbsp;Atras</a>                    
                </div> 
        </div>
    </div>
    <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div id="IdNotas"></div>
                    </div>
                </div>
        </div>
</div>  

