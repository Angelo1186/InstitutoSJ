<img src="<?= base_url() ?>/media/blanco.jpg" border="0" height="70" width="400" /> 
<br/>
 <h3 text-align="center" >Listado de Los Materias</h3> 
<table cellpadding="5px"  border="1" class="table">
                            <thead>
                                <tr bgcolor="#CCCCCC">                                    
                                <th>Nombre</th>
                                <th>Duración Meses</th>
                                <th>Regimen</th>
                                <th>Cantidad de Parciales</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($Materia) > 0) {
                                 foreach ($Materia as $Materias): ?>
                                    <tr >                                       
                                    <td><?= $Materias->Nombre ?></td>
                                        <td><?= $Materias->DuracionMeses ?></td>
                                        <td><?= $Materias->Regimen ?></td>
                                        <td><?= $Materias->CantidadParcial?></td>
                                    </tr>
                                <?php endforeach; 
                                }
                                else
                                    echo'<tr><td colspan="9" class="alert alert-danger">No se encontraton resultados</td></tr>';
                                    ?>
                            </tbody>
 </table>