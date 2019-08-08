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
            $("#formenviar").submit();
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
                <h4 class="ml-auto">Nuevo Mesa</h4>
            </div>
            <div class="card-body">
                <?= form_open('Mesa/saveMesa', 'id="formenviar"') ?>
                <input formControlName="file" id="IdMesa" name="IdMesa" type="hidden" class="form-control" value="<?=$Mesaes->IdMesa?>"/>  
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="FechaMesa" class="form-control-label">Fecha para la Mesa</label>
                            <input formControlName="FechaMesa" id="FechaMesa" name="FechaMesa" type="date" class="form-control required" value="<?= $Mesaes->FechaMesa ?>"/> 
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="NumeroLibro" class="form-control-label">Numero de Libro</label>
                            <input formControlName="NumeroLibro" id="NumeroLibro" name="NumeroLibro" type="text" class="form-control required"   placeholder="Ingrese Numero Libro" value="<?= $Mesaes->NumeroLibro ?>"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Follio" class="form-control-label">Follio</label>
                            <input formControlName="Follio" id="Follio" name="Follio" type="text" class="form-control required" placeholder="Ingrese Follio"  value="<?= $Mesaes->Follio ?>"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="IdProfesor" class="form-control-label">Profesor Titular</label>
                            <?= form_dropdown('IdProfesor', $ListaProfesor,$Mesaes->IdProfesor, 'class="form-control required" id="IdProfesor"') ?>                             
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="IdProfesor1" class="form-control-label">Profesor Suplente 1</label>
                            <?= form_dropdown('IdProfesor1', $ListaProfesor1,$Mesaes->IdProfesor1, 'class="form-control required" id="IdProfesor1"') ?>                             
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="IdProfesor2" class="form-control-label">Profesor Suplente 2</label>
                            <?= form_dropdown('IdProfesor2', $ListaProfesor2,$Mesaes->IdProfesor2, 'class="form-control required" id="IdProfesor2"') ?>                             
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="FechaInicioHabil" class="form-control-label">Fecha Inicio Inscripción</label>
                            <input formControlName="FechaInicioHabil" id="FechaInicioHabil" name="FechaInicioHabil" type="date" class="form-control  required"  value="<?= $Mesaes->FechaInicioHabil ?>"/>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="FechaFinHabil" class="form-control-label">Fecha Final Inscripción</label>
                            <input formControlName="FechaFinHabil" id="FechaFinHabil" name="FechaFinHabil" type="date" class="form-control  required"  value="<?= $Mesaes->FechaFinHabil ?>"/>
                        </div>
                    </div> 

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="IdCarrera" class="form-control-label">Carrera</label>
                            <?= form_dropdown('IdCarrera', $ListaCarreras,$Mesaes->IdCarrera, 'class="form-control required" id="IdCarrera"') ?>                             
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="IdMateria" class="form-control-label">Materia</label>
                            <?= form_dropdown('IdMateria', $ListaMaterias,$Mesaes->IdMateria, 'class="form-control required" id="IdMateria"') ?>                             
                        </div>
                    </div>  
                </div>

                <div class="card-footer bg-light">
                    <input type="button" onclick="Guardar()" class="btn btn-primary" id="boton_enviar" value="Guardar"/>   
                    <a href="<?= site_url('Mesa') ?>" class="btn btn-danger ml-3"  title="Cancelar"><i class="far fa-times-circle"></i> &nbsp;Cancelar</a>                    
                </div>                
                <?= form_close() ?>
            </div>
        </div>

    </div>
</div>
