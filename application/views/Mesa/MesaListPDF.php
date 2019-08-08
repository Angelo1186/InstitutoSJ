<img src="<?= base_url() ?>/media/blanco.jpg" border="0" height="70" width="400" /> 
<br/>
 <h3 text-align="center" >Listado de Los Mesa</h3> 
<table cellpadding="5px"  border="1" class="table">
                            <thead>
                                <tr bgcolor="#CCCCCC">                                    
                                <th>Fecha Mesa</th>
                                <th>Numero Libro</th>
                                <th>Follio </th>
                                <th>Profe Titular</th>
                                <th>Profe Suplente 1</th>
                                <th>Profe Suplente 2</th>
                                <th>Fecha Inicio Inscr</th>
                                <th>Fecha Fin Inscr</th>
                                <th>Carrera</th>
                                <th>Materia</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($Mesa) > 0) {
                                 foreach ($Mesa as $Mesas): ?>
                                    <tr >                                       
                                    <td><?= $Mesas->FechaMesa?></td>
                                        <td><?= $Mesas->NumeroLibro ?></td>
                                        <td><?= $Mesas->Follio ?></td>
                                        <td><?= $Mesas->IdProfesor->Nombre ?></td>
                                        <td><?= $Mesas->IdProfesor1->Nombre?></td>
                                        <td><?= $Mesas->IdProfesor1->Nombre?></td>
                                        <td><?= $Mesas->FechaInicioHabil?></td>
                                        <td><?= $Mesas->FechaFinHabil?></td>
                                        <td><?= $Mesas->IdCarrera->Nombre?></td>
                                        <td><?= $Mesas->IdMateria->Nombre?></td>
                                    </tr>
                                <?php endforeach; 
                                }
                                else
                                    echo'<tr><td colspan="9" class="alert alert-danger">No se encontraton resultados</td></tr>';
                                    ?>
                            </tbody>
 </table>