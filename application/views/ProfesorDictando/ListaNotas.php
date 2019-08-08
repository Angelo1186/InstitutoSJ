 <script type="text/javascript">
 function AddNotas()
    {
      $("#IdNotas1").show();
    }
 
</script>   
            <div class="card-body">
               <!-- <=form_open('Materia/SaveGuardarMateriaCarrera', 'id="ListaNotas"') ?>  -->
                <div class="row">
                        <table class="table" id="tabla_clientes">
                                <thead>
                                    <tr>
                                        <th>Numero Parcial</th>
                                        <th>Nota</th>
                                        <th>Fecha</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($ListaNotas) > 0) {
                                        foreach ($ListaNotas as $ListaNota):
                                            ?>
                                            <tr >
                                                <td><?= $ListaNota->IdNumeroParcial->Nombre?></td>
                                                <td><?= $ListaNota->Nota ?></td>
                                                <td><?= $ListaNota->FechaNota ?> </td>
                                                <th> <a href="#"class="btn btn-danger" title="Borrar" onclick="EliminarNotasp(<?= $ListaNota->IdNota ?>)"><i class="fas fa-trash"></i></a> </th>
                                            </tr>
                                            <?php
                                        endforeach;
                                    }
                                    else
                                        echo'<tr><td colspan="3" class="alert alert-danger">No Posee notas</td></tr>';
                                    ?>
                                </tbody>
                         </table>
                </div>
                   <div style="text-align: center">
                   <a  href="#" onclick="AddNotas()" class="btn btn-primary" title="Agregar Nota"><i class="fas fa-plus">Add</i></a>                          
                  </div>    
            </div>

                 <div class="row col-mod-12" id="IdNotas1" style="display: none; background-color: #d4daeb;">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="IdNumeroParcial" class="form-control-label">Parcial</label>
                            <?=form_dropdown('IdNumeroParcial', $listaNumeroParcial,$IdNumeroParcials, 'class="form-control" id="IdNumeroParcial"') ?>                             
                        </div>
                    </div>
                    <div class="col-md-4">
                       <input formControlName="file" id="IdAlumno1" name="IdAlumno1" type="hidden" class="form-control" value="<?=$AddNota->IdAlumno?>"/>  
                      <input formControlName="file" id="IdMateria1" name="IdMateria1" type="hidden" class="form-control" value="<?=$AddNota->IdMateria?>"/>  
                        <div class="form-group">
                            <label for="nota2" class="form-control-label">Nota</label>
                            <input formControlName="nota2" id="nota2" name="nota2" type="text" class="form-control required"   placeholder="Ingrese Nota" value=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <input type="button" onclick="Guardar1()" class="btn btn-primary" id="boton_enviar" value="Guardar"/>  
                    </div>
                    
                 </div>   

