<img src="<?= base_url() ?>/media/blanco.jpg" border="0" height="70" width="400" /> 
<br/>
 <h3 text-align="center" >Listado de Los Alumno</h3> 
<table cellpadding="5px"  border="1" class="table">
                            <thead>
                                <tr bgcolor="#CCCCCC">                                    
                                <th>Legajo</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>DNI</th>
                                <th>Tel&eacute;fono</th>
                                <th>Email</th>
                                <th>Lugar Nacimiento</th>
                                <th>Direcci&oacute;n</th>
                                <th>Barrio</th>
                                <th>Colegio Secundario</th>
                                <th>Titulo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($Alumno) > 0) {
                                 foreach ($Alumno as $Alumnos): ?>
                                    <tr >                                       
                                    <td><?= $Alumnos->LegAlumno?></td>
                                        <td><?= $Alumnos->Nombre ?></td>
                                        <td><?= $Alumnos->Apellido ?></td>
                                        <td><?= $Alumnos->Dni ?></td>
                                        <td><?= $Alumnos->Telefono?></td>
                                        <td><?= $Alumnos->Email?></td>
                                        <td><?= $Alumnos->LugarNacimiento?></td>
                                        <td><?= $Alumnos->Domicilio?></td>
                                        <td><?= $Alumnos->IdBarrio->Nombre?></td>
                                        <td><?= $Alumnos->IdColegio->Nombre?></td>
                                        <td><?= $Alumnos->IdTituloSecundario->NombreTitulo?></td>
                                    </tr>
                                <?php endforeach; 
                                }
                                else
                                    echo'<tr><td colspan="9" class="alert alert-danger">No se encontraton resultados</td></tr>';
                                    ?>
                            </tbody>
 </table>