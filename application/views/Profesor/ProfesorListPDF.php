<img src="<?= base_url() ?>/media/blanco.jpg" border="0" height="70" width="400" /> 
<br/>
 <h3 text-align="center" >Listado de Los Profesores</h3> 
<table cellpadding="5px"  border="1" class="table">
                            <thead>
                                <tr bgcolor="#CCCCCC">                                    
                                <th>Legajo</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>DNI</th>
                                <th>Tel&eacute;fono</th>
                                <th>Barrio</th>
                                <th>Direcci&oacute;n</th>  
                                <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($profesor) > 0) {
                                 foreach ($profesor as $profeso): ?>
                                    <tr >                                       
                                        <td><?= $profeso->Legajo ?></td>
                                        <td><?= $profeso->Nombre?></td>
                                        <td><?= $profeso->Apellido?></td>
                                        <td><?= $profeso->Dni ?></td>
                                        <td><?= $profeso->Telefono ?></td>
                                        <td><?= $profeso->IdBarrio->Nombre?></td>
                                        <td><?= $profeso->Domicilio ?></td> 
                                        <td><?= $profeso->Email ?></td>
                                    </tr>
                                <?php endforeach; 
                                }
                                else
                                    echo'<tr><td colspan="9" class="alert alert-danger">No se encontraton resultados</td></tr>';
                                    ?>
                            </tbody>
 </table>