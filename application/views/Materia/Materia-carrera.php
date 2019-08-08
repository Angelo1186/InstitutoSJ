<!-- <script type="text/javascript">
 function Calcular(idCarrera)
    {
        var 
      alert(idCarrera);
    }
</script>   -->
            <div class="card-body">
                <?= form_open('Materia/SaveGuardarMateriaCarrera', 'id="formenviars"') ?>
                <div class="row">
                <?php
                if (count($carrera) > 0) {
                    foreach ($carrera as $carreras):
                        ?>
                         <div class="col-md-4" style="background-color: #d0dcf5;">
                           <div class="form-check mb-2">
                          <!-- <=form_checkbox('check_list[]',$carreras->IdCarrera->IdCarrera,$carreras->Activo,'onchange="Calcular('.$carreras->IdCarrera->IdCarrera.')"') ?> -->
                                  <?=form_checkbox('check_list[]',$carreras->IdCarrera->IdCarrera,$carreras->Activo) ?>
                                        <label class="form-check-label" for="gas_contrato">
                                        <?=$carreras->IdCarrera->Nombre?>
                                        </label>
                            </div>  
                         </div>
                        <?php
                    endforeach;
                }
                else
                    echo'<div class="alert alert-danger">No se encontraton materias</div>';
                ?>
                </div>
                <input formControlName="IdMateria" id="IdMateria" name="IdMateria" type="hidden" class="form-control" value="<?=$IdMateria?>" />
                <div class="card-footer bg-light text-center">
                    <input  type="submit" class="btn btn-primary" id="boton_enviar" value="Guardar"/>   
                    <a href="#" class="btn btn-danger ml-3 " data-dismiss="modal" title="Cancelar"><i class="far fa-times-circle"></i> &nbsp;Cancelar</a> 
                </div>                
                <?= form_close() ?>
            </div>

