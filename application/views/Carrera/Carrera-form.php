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
                <h4 class="ml-auto">Nueva Carrera</h4>
            </div>
            <div class="card-body">
                <?= form_open('Carrera/saveCarrera', 'id="formenviar"') ?>
                <input formControlName="file" id="IdCarrera" name="IdCarrera" type="hidden" class="form-control" value="<?=$Carreraes->IdCarrera?>"/>  
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nombre" class="form-control-label">Nombre</label>
                            <input formControlName="nombre" id="nombre" name="nombre" type="text" class="form-control required"   placeholder="Ingrese Nombre" value="<?= $Carreraes->Nombre ?>"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="DuracionAnio" class="form-control-label">Duracion en Anio</label>
                            <input formControlName="DuracionAnio" id="DuracionAnio" name="DuracionAnio" type="text" class="form-control solo-numero required" placeholder="Ingrese Duracion mese"  maxlength="2" value="<?= $Carreraes->DuracionAnio ?>"/>
                        </div>
                    </div> 
                </div>

                <div class="card-footer bg-light">
                    <input type="button" onclick="Guardar()" class="btn btn-primary" id="boton_enviar" value="Guardar"/>   
                    <a href="<?= site_url('Carrera') ?>" class="btn btn-danger ml-3"  title="Cancelar"><i class="far fa-times-circle"></i> &nbsp;Cancelar</a>                    
                </div>                
                <?= form_close() ?>
            </div>
        </div>

    </div>
</div>
