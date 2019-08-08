<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {       
        $('.solo-numero').keyup(function (){
        this.value = (this.value + '').replace(/[^0-9]/g, '');
         });

         $("#IdCarrera").change(function () {
            var idCarrera = $("#IdCarrera").val();
            $.ajax(
            {type: 'post',
                url: "<?= site_url('correlatividad/getMaterias') ?>",
                data: {"idCarrera": idCarrera},
                dataType: 'json',
                success: function (datos) {
                    $("#IdMateria").html(datos.select);
                    $("#IdMateriaCorrelativa").html(datos.select);
                    
                }
            });

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
                <h4 class="ml-auto">Nuevo Correlatividad</h4>
            </div>
            <div class="card-body">
                <?= form_open('Correlatividad/saveCorrelatividad', 'id="formenviar"') ?>
                <input formControlName="file" id="IdCorrelatividad" name="IdCorrelatividad" type="hidden" class="form-control" value="<?=$Correlatividades->IdCorrelatividad?>"/>  
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="IdCarrera" class="form-control-label">Carrera</label>
                            <?= form_dropdown('IdCarrera', $ListaCarrera,$Correlatividades->IdCarrera, 'class="form-control required" id="IdCarrera"') ?>                             
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="IdMateria" class="form-control-label">Materia</label>
                            <?= form_dropdown('IdMateria', $ListaMateria,$Correlatividades->IdMateria, 'class="form-control required" id="IdMateria"') ?>                             
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="IdMateriaCorrelativa" class="form-control-label">Su Correlativa</label>
                            <?= form_dropdown('IdMateriaCorrelativa', $ListaMateriaCorrelatividad,$Correlatividades->IdMateriaCorrelativa, 'class="form-control required" id="IdMateriaCorrelativa"') ?>                             
                        </div>
                    </div>

                    
                </div>

                <div class="card-footer bg-light">
                    <input type="button" onclick="Guardar()" class="btn btn-primary" id="boton_enviar" value="Guardar"/>   
                    <a href="<?= site_url('Correlatividad') ?>" class="btn btn-danger ml-3"  title="Cancelar"><i class="far fa-times-circle"></i> &nbsp;Cancelar</a>                    
                </div>                
                <?= form_close() ?>
            </div>
        </div>

    </div>
</div>
