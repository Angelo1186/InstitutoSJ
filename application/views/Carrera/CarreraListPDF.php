<img src="<?= base_url() ?>/media/blanco.jpg" border="0" height="70" width="400" /> 
<br/>
 <h3 text-align="center" >Listado de Los Carreras</h3> 
<table cellpadding="5px"  border="1" class="table">
                            <thead>
                                <tr bgcolor="#CCCCCC">                                    
                                <th>Nombre</th>
                                <th>Duración Anio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($Carrera) > 0) {
                                 foreach ($Carrera as $Carreras): ?>
                                    <tr >                                       
                                    <td><?= $Carreras->Nombre ?></td>
                                        <td><?= $Carreras->DuracionAnio ?></td>
                                    </tr>
                                <?php endforeach; 
                                }
                                else
                                    echo'<tr><td colspan="9" class="alert alert-danger">No se encontraton resultados</td></tr>';
                                    ?>
                            </tbody>
 </table>