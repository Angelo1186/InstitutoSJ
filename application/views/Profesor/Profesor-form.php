<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {             
        $("#telefono").mask("9999-999999?999999"); 
        $("#cuil").mask("99-99999999-9"); 
        $("#formenviar").submit(function()
        {            
            $("#boton_enviar").attr('disabled',true).attr('value','Enviando datos por favor espere...');          
        });
        $('.solo-numero').keyup(function (){
        this.value = (this.value + '').replace(/[^0-9]/g, '');
         });
    } );
    function upperCaseF(a){
    setTimeout(function(){
        a.value = a.value.toUpperCase();
    }, 1);
    } 
</script>
<?= $this->session->flashdata('mensaje'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card text-center">
            <div class="card-header bg-light">
                <h4 class="ml-auto">Nuevo Profesor</h4>
            </div>
            <div class="card-body">
                <?= form_open('Profesor/saveProfesor', 'id="formenviar"') ?>
                <input formControlName="file" id="IdProfesor" name="IdProfesor" type="hidden" class="form-control" value="<?=$Profesores->IdProfesor?>"/>  
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="legajo">Legajo</label>
                            <input formControlName="file" id="legajo" name="legajo" type="text" class="form-control"  <?php if($Profesores->IdProfesor!=0){ echo "disabled"; } ?> placeholder="Ingrese Legajo"  onkeydown="upperCaseF(this)" required="required" value="<?= $Profesores->Legajo ?>"/> 
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input formControlName="nombre" id="nombre" name="nombre" type="text" class="form-control"   placeholder="Ingrese Nombre" required="required" value="<?= $Profesores->Nombre ?>"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input formControlName="nombre" id="apellido" name="apellido" type="text" class="form-control" placeholder="Ingrese Apellido" required="required" value="<?= $Profesores->Apellido ?>"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cuil">DNI</label>
                            <input formControlName="Dni" id="Dni" name="Dni" type="text" class="form-control solo-numero" placeholder="Ingrese DNI" required="required" maxlength="9" value="<?= $Profesores->Dni ?>"/>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cuil">Tel&eacute;fono</label>
                            <input formControlName="Telefono" id="Telefono" name="Telefono" type="text" class="form-control solo-numero" placeholder="Ingrese Telefono" required="required" maxlength="15" value="<?= $Profesores->Telefono ?>"/>
                        </div>
                    </div> 

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="IdBarrio" class="form-control-label">Barrio</label>
                            <?= form_dropdown('IdBarrio', $ListaBarrio,$Profesores->IdBarrio, 'class="form-control" id="IdBarrio"') ?>                             
                        </div>
                    </div>

                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="direccion" class="form-control-label">Direcci&oacute;n</label>
                            <input formControlName="address" name="Domicilio" id="Domicilio" type="text" class="form-control"  placeholder="Ingrese Direcci&oacute;n" required="required" value="<?= $Profesores->Domicilio ?>"/>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email" class="form-control-label">Email</label>
                            <input formControlName="email" name="Email" id="Email" type="email" class="form-control" placeholder="Ingrese Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" value="<?=$Profesores->Email ?>"/>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light">
                    <input type="submit" class="btn btn-primary" id="boton_enviar" value="Guardar"/>   
                    <a href="<?= site_url('Profesor') ?>" class="btn btn-danger ml-3"  title="Cancelar"><i class="far fa-times-circle"></i> &nbsp;Cancelar</a>                    
                </div>                
                <?= form_close() ?>
            </div>
        </div>

    </div>
</div>
