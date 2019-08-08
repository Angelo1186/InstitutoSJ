<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {   

        $("#submit_buscar").click(function()
        {    
            debugeer;           
            $("#submit_buscar").attr('disabled',true).attr('value','Espere...'); 
            $("#formbusqueda").submit();
        });
        $('#tabla_AlumnoMesa').dataTable({            
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
    

    function GuardarFinal()
  {
      idMesaAlumno=$("#IdMesaAlumno").val();   
      nota=$("#notafin").val(); 
      idEstadoParcial=$("#IdEstadoParcial").val();
        $.ajax(
            {   type:'post',
                url:"<?= site_url('ProfesorDictando/SaveNotasFinal') ?>" ,
                data:{"idMesaAlumno":idMesaAlumno,"nota":nota,"idEstadoParcial":idEstadoParcial}
             }).done(function(data) {   
                 alert("La Nota se Guardo con Éxito!!!");
                $("#notasFinales").html("");
                $("#notasFinales").hide();
                $("#thing-" + idMesaAlumno + " td.nota").html(nota);
            }).fail(function (jqXHR, textStatus) {
              alert("Error al querer guardar la nota");  
             });
  }
    function CargarNotasFinal(idMesaAlumno)
    {
       $("#notasFinales").show(); 
       $("#notafin").val("");      
       $("#IdMesaAlumno").val(idMesaAlumno);
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
                    <h3>Listado de los Alumnos para rendir la Mesa </h3>
                    <table class="table" id="tabla_AlumnoMesa">
                        <thead>
                            <tr id="thing-0">
                                <th>Nombre Alumno</th>
                                <th>DNI</th>
                                <th Class="nota">Nota</th>
                                <th> Agregar notas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count($mesaAlu) > 0) {
                                foreach ($mesaAlu as $mesaAl):
                                    ?>
                                    <tr id="thing-<?=$mesaAl->IdMesaAlumno?>"  >
                                        <td><?= $mesaAl->IdAlumno->Nombre?></td>
                                        <td><?= $mesaAl->IdAlumno->Dni ?></td>
                                        <td Class="nota"><?= $mesaAl->Nota?></td>
                                        <td>
                                            <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                                    <a  href="#" onclick="CargarNotasFinal(<?=$mesaAl->IdMesaAlumno?>)" class="btn btn-primary" title="Conocer los alumnnos"><i class="fas fa-file-signature"></i></a>                          
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
                    <a href="<?= site_url('ProfesorDictando/MesaAsignadas')?>" class="btn btn-danger ml-3"  title="Cancelar"><i class="far fa-times-circle"></i> &nbsp;Atras</a>                    
                </div> 
        </div>
    </div>
    <div class="col-md-5" id="notasFinales" style="display: none; background-color: #d4daeb;">
                <div class="card">
                    <div class="card-body">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="IdEstadoParcial" class="form-control-label">Parcial</label>
                                        <?=form_dropdown('IdEstadoParcial', $ListaEstado,$IdEstadoParcial, 'class="form-control" id="IdEstadoParcial"') ?>                             
                                    </div>
                                </div>
                                    <div class="col-md-4"> 
                                    <input formControlName="file" id="IdMesaAlumno" name="IdMesaAlumno" type="hidden" class="form-control" value=""/>  
                                        <div class="form-group">
                                            <label for="notafin" class="form-control-label">Nota</label>
                                            <input formControlName="notafin" id="notafin" name="notafin" type="text" class="form-control required" placeholder="Ingrese Nota" value=""/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                    <input type="button" onclick="GuardarFinal()" class="btn btn-primary" id="boton_enviar" value="Guardar"/>  
                                    </div>
                       
                    </div>
                </div>
     </div>
</div>  

