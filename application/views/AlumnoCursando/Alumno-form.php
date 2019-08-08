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
         var idBa= $("#IdBarrio").val();
         var idCo=$("#IdColegio").val();
         var idTi=$("#IdTituloSecundario").val();

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
                <h4 class="ml-auto">Nuevo Alumno</h4>
            </div>
            <div class="card-body">
                <?= form_open('Alumno/saveAlumno', 'id="formenviar"') ?>
                <input formControlName="file" id="IdAlumno" name="IdAlumno" type="hidden" class="form-control" value="<?=$Alumnoes->IdAlumno?>"/>  
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="legAlumno" class="form-control-label">Legajo</label>
                            <input formControlName="legAlumno" id="legAlumno" name="legAlumno" type="text" class="form-control required"  <?php if($Alumnoes->IdAlumno!=0){ echo "disabled"; } ?> placeholder="Ingrese Legajo"  onkeydown="upperCaseF(this)" value="<?= $Alumnoes->LegAlumno ?>"/> 
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nombre" class="form-control-label">Nombre</label>
                            <input formControlName="nombre" id="nombre" name="nombre" type="text" class="form-control required"   placeholder="Ingrese Nombre" value="<?= $Alumnoes->Nombre ?>"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="apellido" class="form-control-label">Apellido</label>
                            <input formControlName="apellido" id="apellido" name="apellido" type="text" class="form-control required" placeholder="Ingrese Apellido"  value="<?= $Alumnoes->Apellido ?>"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Dni" class="form-control-label">DNI</label>
                            <input formControlName="Dni" id="Dni" name="Dni" type="text" class="form-control solo-numero required" placeholder="Ingrese DNI"  maxlength="9" value="<?= $Alumnoes->Dni ?>"/>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Telefono" class="form-control-label">Tel&eacute;fono</label>
                            <input formControlName="Telefono" id="Telefono" name="Telefono" type="text" class="form-control solo-numero required" placeholder="Ingrese Telefono"  maxlength="15" value="<?= $Alumnoes->Telefono ?>"/>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email" class="form-control-label">Email</label>
                            <input formControlName="email" name="Email" id="Email" type="email" class="form-control required" placeholder="Ingrese Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" value="<?=$Alumnoes->Email ?>"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lugarNacimiento" class="form-control-label">Direcci&oacute;n</label>
                            <input formControlName="lugarNacimiento" name="LugarNacimiento" id="LugarNacimiento" type="text" class="form-control required"  placeholder="Ingrese Lugar Nacimiento" value="<?= $Alumnoes->LugarNacimiento ?>"/>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="direccion" class="form-control-label">Direcci&oacute;n</label>
                            <input formControlName="direccion" name="Domicilio" id="Domicilio" type="text" class="form-control required"  placeholder="Ingrese Direcci&oacute;n"  value="<?= $Alumnoes->Domicilio ?>"/>
                        </div>
                    </div> 

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="IdBarrio" class="form-control-label">Barrio</label>
                            <?= form_dropdown('IdBarrio', $ListaBarrio,$Alumnoes->IdBarrio, 'class="form-control required" id="IdBarrio"') ?>                             
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="IdBarrio" class="form-control-label">Colegio</label>
                            <?= form_dropdown('IdColegio', $ListaColegio,$Alumnoes->IdColegio, 'class="form-control required" id="IdColegio"') ?>                             
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="IdTituloSecundario" class="form-control-label">Titulo Secundario</label>
                            <?= form_dropdown('IdTituloSecundario', $ListaTituloSec,$Alumnoes->IdTituloSecundario, 'class="form-control required" id="IdTituloSecundario"') ?>                             
                        </div>
                    </div>

                    
                </div>

                <div class="card-footer bg-light">
                    <input type="button" onclick="Guardar()" class="btn btn-primary" id="boton_enviar" value="Guardar"/>   
                    <a href="<?= site_url('Alumno') ?>" class="btn btn-danger ml-3"  title="Cancelar"><i class="far fa-times-circle"></i> &nbsp;Cancelar</a>                    
                </div>                
                <?= form_close() ?>
            </div>
        </div>

    </div>
</div>
