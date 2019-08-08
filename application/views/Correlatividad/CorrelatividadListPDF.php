<img src="<?= base_url() ?>/media/blanco.jpg" border="0" height="70" width="400" /> 
<br/>
 <h3 text-align="center" >Listado de Los Correlatividad</h3> 
<table cellpadding="5px"  border="1" class="table">
                            <thead>
                                <tr bgcolor="#CCCCCC">                                    
                                <th>Carrera</th>
                                <th>Materia</th>
                                <th>Su Correlativa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($Correlatividad) > 0) {
                                 foreach ($Correlatividad as $Correlatividads): ?>
                                    <tr >                                       
                                    <td><?= $Correlatividads->IdCarrera->Nombre?></td>
                                    <td><?= $Correlatividads->IdMateria->Nombre?></td>
                                    <td><?= $Correlatividads->IdMateriaCorrelativa->Nombre?></td>
                                    </tr>
                                <?php endforeach; 
                                }
                                else
                                    echo'<tr><td colspan="9" class="alert alert-danger">No se encontraton resultados</td></tr>';
                                    ?>
                            </tbody>
 </table>