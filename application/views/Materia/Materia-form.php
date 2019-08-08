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
                <h4 class="ml-auto">Nuevo Materia</h4>
            </div>
            <div class="card-body">
                <?= form_open('Materia/saveMateria', 'id="formenviar"') ?>
                <input formControlName="file" id="IdMateria" name="IdMateria" type="hidden" class="form-control" value="<?=$Materiaes->IdMateria?>"/>  
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nombre" class="form-control-label">Nombre</label>
                            <input formControlName="nombre" id="nombre" name="nombre" type="text" class="form-control required"   placeholder="Ingrese Nombre" value="<?= $Materiaes->Nombre ?>"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="DuracionMeses" class="form-control-label">Duracion en Meses</label>
                            <input formControlName="DuracionMeses" id="DuracionMeses" name="DuracionMeses" type="text" class="form-control solo-numero required" placeholder="Ingrese Duracion mese"  maxlength="2" value="<?= $Materiaes->DuracionMeses ?>"/>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Regimen" class="form-control-label">Regimen</label>
                            <input formControlName="Regimen" id="Regimen" name="Regimen" type="text" class="form-control required" placeholder="Ingrese Regimen"  value="<?= $Materiaes->Regimen ?>"/>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="CantidadParcial" class="form-control-label">Cantidad Parcial</label>
                            <input formControlName="CantidadParcial" id="CantidadParcial" name="CantidadParcial" type="text" class="form-control solo-numero required" placeholder="Ingrese Regimen"  maxlength="2" value="<?= $Materiaes->CantidadParcial ?>"/>
                        </div>
                    </div> 
                </div>

                <div class="card-footer bg-light">
                    <input type="button" onclick="Guardar()" class="btn btn-primary" id="boton_enviar" value="Guardar"/>   
                    <a href="<?= site_url('Materia') ?>" class="btn btn-danger ml-3"  title="Cancelar"><i class="far fa-times-circle"></i> &nbsp;Cancelar</a>                    
                </div>                
                <?= form_close() ?>
            </div>
        </div>

    </div>
</div>
