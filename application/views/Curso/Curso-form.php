<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {       
        $('.solo-numero').keyup(function (){
        this.value = (this.value + '').replace(/[^0-9]/g, '');
         });
    } );
    function upperCaseF(a){
    setTimeout(function(){
        a.value = a.value.toUpperCase();
    }, 1);
    } 
     function Guardar()
     {
      var mr=  $('#formenviar').validate({
            errorClass: "my-error-class"
         //   validClass: "my-valid-class"
            });
      //   if(idBa!=0 && idCo!=0 && idTi!=0 )
       //  {
            $("#formenviar").submit();
          //  $("#boton_enviar").attr('disabled',true).attr('value','Enviando datos por favor espere...');   
       //  } else
       //  {
       //    alert("ERROR!!!!!!!!! HAY CAMPOS VACIOS");
       //  }
     }
</script>
 <style type="text/css">
  .my-error-class {
    color:#FF0000;  /* red */
}
.my-valid-class {
    color:#00CC00; /* green */
}
  </style>
<?= $this->session->flashdata('mensaje'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card text-center">
            <div class="card-header bg-light">
                <h4 class="ml-auto">Nuevo Curso</h4>
            </div>
            <div class="card-body">
                <?= form_open('Curso/saveCurso', 'id="formenviar"') ?>
                <input formControlName="file" id="IdCurso" name="IdCurso" type="hidden" class="form-control" value="<?=$Cursoes->IdCurso?>"/>  
                <div class="row">
                   
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="IdProfesor" class="form-control-label">Profesor</label>
                            <?= form_dropdown('IdProfesor', $ListaProfesors,$Cursoes->IdProfesor, 'class="form-control required" id="IdProfesor"') ?>                             
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="IdMateria" class="form-control-label">Materia</label>
                            <?= form_dropdown('IdMateria', $ListaMaterias,$Cursoes->IdMateria, 'class="form-control required" id="IdMateria"') ?>                             
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Anio" class="form-control-label">Año</label>
                            <input formControlName="Anio" id="Anio" name="Anio" type="text" class="form-control solo-numero required" placeholder="Ingrese Año"  maxlength="4" value="<?= $Cursoes->Anio ?>"/>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="FechaInicioInscripcion" class="form-control-label">Fecha Inicio de Inscripción</label>
                            <input id="FechaInicioInscripcion" name="FechaInicioInscripcion" type="date" class="form-control required" formControlName="FechaInicioInscripcion" value="<?=$Cursoes->FechaInicioInscripcion?>"/>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="FechaFinInscripcion" class="form-control-label">Fecha Fin de Inscripción</label>
                            <input id="FechaFinInscripcion" name="FechaFinInscripcion" type="date" class="form-control required" formControlName="FechaFinInscripcion" value="<?=$Cursoes->FechaFinInscripcion ?>" />
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="FechaFin" class="form-control-label">Fecha Finalización de Curso</label>
                            <input id="FechaFin" name="FechaFin" type="date" class="form-control required" value="<?=$Cursoes->FechaFin ?>" formControlName="FechaFin"/>
                        </div>
                    </div> 
                </div>

                <div class="card-footer bg-light">
                    <input type="button" onclick="Guardar()" class="btn btn-primary" id="boton_enviar" value="Guardar"/>   
                    <a href="<?= site_url('Curso') ?>" class="btn btn-danger ml-3"  title="Cancelar"><i class="far fa-times-circle"></i> &nbsp;Cancelar</a>                    
                </div>                
                <?= form_close() ?>
            </div>
        </div>

    </div>
</div>
