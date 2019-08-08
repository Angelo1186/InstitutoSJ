<img src="<?= base_url() ?>/media/blanco.jpg" border="0" height="70" width="400" /> 
<br/>
 <h3 text-align="center" >Listado de Los Cursos</h3> 
<table cellpadding="5px"  border="1" class="table">
                            <thead>
                                <tr bgcolor="#CCCCCC">                                    
                                <th>Profesor</th>
                                <th>Materia</th>
                                <th>Anio</th>
                                <th>Fecha Inicio de Inscripción </th>
                                <th>Fecha Fin de Inscripción </th>
                                <th>Fecha Finalización</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($Curso) > 0) {
                                 foreach ($Curso as $Cursos): ?>
                                    <tr >                                       
                                    <td><?= $Cursos->IdProfesor->Nombre ."-".$Cursos->IdProfesor->Apellido ?></td>
                                    <td><?= $Cursos->IdMateria->Nombre ?></td>
                                    <td><?= $Cursos->Anio ?></td>
                                    <td><?= $Cursos->FechaInicioInscripcion ?></td>
                                        <td><?= $Cursos->FechaFinInscripcion ?></td>
                                        <td><?= $Cursos->FechaFin ?></td>
                                    </tr>
                                <?php endforeach; 
                                }
                                else
                                    echo'<tr><td colspan="9" class="alert alert-danger">No se encontraton resultados</td></tr>';
                                    ?>
                            </tbody>
 </table>