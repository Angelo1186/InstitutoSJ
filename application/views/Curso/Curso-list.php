<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {   

        $("#submit_buscar").click(function()
        {    
            debugeer;           
            $("#submit_buscar").attr('disabled',true).attr('value','Espere...'); 
            $("#formbusqueda").submit();
        });
        $('#tabla_clientes').dataTable({            
            "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se encontraton resultados",
            "info": "Total",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(Filtrado de _MAX_ Entrada Totales)"
             },
            "paging":   true,
            "ordering": true,
            "order": [[ 0, "asc" ]]
                    
        });
    });
</script>
<style type="text/css"> 
 .fullscreen-modal .modal-dialog {
	margin: 0;
	margin-right: auto;
	margin-left: auto;
	width: 100%;
  }
  @media (min-width: 768px) {
	.fullscreen-modal .modal-dialog {
      max-width: 750px;
      /* left: -263px; 
       top: 54px; */
	}
  }
  @media (min-width: 992px) {
	.fullscreen-modal .modal-dialog {
      max-width: 970px;
      /* left: -563px; 
       top: 104px; */
	}
  }
  @media (min-width: 1200px) {
	.fullscreen-modal .modal-dialog {
       max-width: 1200px;
       /* left: -763px; 
       top: 134px; */
	}
  }
</style> 

<?= $this->session->flashdata('mensaje'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-light d-flex">
                <h4 class="ml-auto">Curso</h4>
                <a href="<?= site_url('Curso/agregarCurso') ?>" class="btn btn-primary ml-auto"  title="Agregar Curso"><i class="fas fa-plus"></i> &nbsp; Agregar Curso</a>
            </div>
            <div class="card-body">

                <fieldset class="border p-2">
                    <legend class="w-auto text-center">
                        <h5 class="text-center">Filtros para Busquedas <i class="fa fa-search"></i></h5>
                    </legend>
                    <?= form_open_multipart('Curso', 'id="formbusqueda"') ?>
                    <div class="row">                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <input id="buscado" name="buscado" value="<?= $buscado ?>" type="text" placeholder="Ingrese datos a buscar" style="width: 350px"/>
                                <input type="submit" value="Buscar" id="submit_buscar"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="text-align: right;">
                            <a  href="<?= site_url('Curso/CursoPDF') ?>"class="btn btn-info" title="Imprimir" target="_blank" ><i class="fa fa-print">GENERAR LISTADO </i></a>
                            </div>
                        </div>
                    </div>
                    <?= form_close() ?>
                </fieldset>
                <div class="table-responsive mt-3">
                    <h3>Listado de Cursos</h3>
                    <table class="table" id="tabla_clientes">
                        <thead>
                            <tr>
                                <th>Profesor</th>
                                <th>Materia</th>
                                <th>Anio</th>
                                <th>Fecha Inicio de Inscripción </th>
                                <th>Fecha Fin de Inscripción </th>
                                <th>Fecha Finalización</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count($Curso) > 0) {
                                foreach ($Curso as $Cursos):
                                    ?>
                                    <tr >
                                        <td><?= $Cursos->IdProfesor->Nombre ."-".$Cursos->IdProfesor->Apellido ?></td>
                                        <td><?= $Cursos->IdMateria->Nombre ?></td>
                                        <td><?= $Cursos->Anio ?></td>
                                        <td><?= $Cursos->FechaInicioInscripcion ?></td>
                                        <td><?= $Cursos->FechaFinInscripcion ?></td>
                                        <td><?= $Cursos->FechaFin ?></td>
                                        <td>
                                            <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                                    <a  href="<?= site_url('Curso/agregarCurso/' . $Cursos->IdCurso) ?>" class="btn btn-primary" title="Editar"><i class="far fa-edit"></i></a>                                                
                                                   <!-- <a  href="<= site_url('clientes/verCliente/' . $Cursos->IdCurso . '/cliente') ?>"class="btn btn-secondary" title="Detalles"><i class="fa fa-search-plus"></i></a> -->
                                                    <a  href="<?= site_url('Curso/eliminarCurso/' . $Cursos->IdCurso) ?>"class="btn btn-danger" title="Borrar" onclick="return confirm('Esta seguro de Eliminar el Curso???')"><i class="fas fa-trash"></i></a>
                                                   <!-- <= anchor(site_url('facturacion/nuevoPagoCliente/'.$Cursos->IdCurso), '<i class="fa fa-money-bill-alt"></i>',' class="btn btn-secondary" title="Realizar Pago"') ?> -->
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                            }
                            else
                                echo'<tr><td colspan="12" class="alert alert-danger">No se encontraton resultados</td></tr>';
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>  

<?php
 /*if ($dialogos == 1 )
 { ?>
 <!-------------------------------------------------------------------------------------------------------------------------------------------------------------------->
 <div class="modal fullscreen-modal fade" id="proximoVencer" tabindex="-1" role="dialog" aria-labelledby="proximoVencer">
  <div class="modal-dialog" role="document">
    <div class="modal-content" >
      <div class="modal-header" style="background-color:#007bff; color:#FFFFFF">
        <h5 class="col-12 modal-title text-center">LISTADO DE CONTRATOS VENCIDOS Y PROXIMO A VENCER</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <!-- el listado de los contratos proximos a vencer-->
         <div class="row">
            <div class="col-md-12">
                <div class="card" style="background-color:#eaf0f5">
                    <div class="card-body">
                        <div class="table-responsive mt-12">
                        <div style="text-align: center;"> <a  href="<?= site_url('Contratos/ContratoVencerPDF') ?>"class="btn btn-primary" title="Imprimir" target="_blank" ><i class="fa fa-print">GENERAR PDF </i></a>   </div> 
                            <table class="table">
                                <thead>
                                    <tr>                               
                                        <th>Propietario</th>
                                        <th>T&iacute;tular</th>
                                        <th>CUIL</th>                                
                                        <th>Inmueble</th>
                                        <th>Edificio</th>
                                        <th>Desde</th>
                                        <th>Hasta</th>
                                        <th>D&iacute;as</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (count($contratos) > 0) {
                                            foreach ($contratos as $contrato):
                                                $estilo = '';
                                                if ($contrato->fecha_fin < Date('Y-m-d'))
                                                    $estilo = 'class="alert alert-danger"';
                                                ?>
                                                <tr <?= $estilo ?>>                                       
                                                    <td><?= $contrato->propietario->apellido . ' ' . $contrato->propietario->nombre ?></td>
                                                    <td><?= $contrato->titular->apellido . ' ' . $contrato->titular->nombre ?></td>
                                                    <td><?= $contrato->titular->cuil ?></td>
                                                    <td><?= $contrato->id_inmueble->nombre ?></td>
                                                    <td><?= $contrato->id_inmueble->edificio ?></td>
                                                    <td><?= Fechautil::format($contrato->fecha_inicio) ?></td>
                                                    <td><?= Fechautil::format($contrato->fecha_fin) ?></td>  
                                                    <td><?= round(Fechautil::diferenciaEnDias(date('Y-m-d'), $contrato->fecha_fin)) ?></td>
                                                </tr>
                                                <?php
                                            endforeach;
                                        }
                                    else
                                        echo'<tr><td colspan="7" class="alert alert-danger">No se encontraton resultados</td></tr>';
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<div class="modal fullscreen-modal fade" id="inmueblesDesocupado" tabindex="-1" role="dialog" aria-labelledby="inmueblesDesocupado">
  <div class="modal-dialog" role="document">
    <div class="modal-content" >
      <div class="modal-header" style="background-color:#007bff; color:#FFFFFF">
        <h5 class="col-12 modal-title text-center">LISTADO DE INMUEBLES DESOCUPADO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <!-- el listado de los inmuebles desocupado-->
          <div class="row">
            <div class="col-md-12">
                <div class="card" style="background-color:#eaf0f5">
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                        <div style="text-align: center;"> <a  href="<?= site_url('Inmuebles/inmueblesLibresPDF') ?>"class="btn btn-primary" title="Imprimir" target="_blank" ><i class="fa fa-print">GENERAR PDF </i></a>   </div> 
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Legajo</th>
                                        <th>Nombre</th>
                                        <th>Direcci&oacute;n</th>
                                        <th>Tipo</th>
                                        <th>Piso</th>
                                        <th>Dpto</th>
                                        <th>Edificio</th>
                                        <th>Estado</th>
                                        <th>Propietario</th>                               
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($inmuebles) > 0) {
                                        foreach ($inmuebles as $inmueble):
                                            ?>
                                            <tr>
                                                <td><?= $inmueble->id_inmueble ?></td>
                                                <td><?= $inmueble->nombre ?></td>
                                                <td><?= $inmueble->direccion ?></td>
                                                <td><?= $inmueble->id_tipo_inmueble->descripcion ?></td>
                                                <td><?= $inmueble->piso ?></td>
                                                <td><?= $inmueble->departamento ?></td>
                                                <td><?= $inmueble->edificio ?></td>
                                                <td><?= $inmueble->estado ?></td>
                                                <td><?= $inmueble->id_persona_propietario ?></td>                                        
                                            </tr>
                                            <?php
                                        endforeach;
                                    }
                                    else
                                        echo'<tr><td colspan="9" class="alert alert-danger">No se encontraton resultados</td></tr>';
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<div class="modal fullscreen-modal fade" id="clientesDeudores" tabindex="-1" role="dialog" aria-labelledby="clientesDeudores" >
  <div class="modal-dialog" role="document" >
    <div class="modal-content" >
      <div class="modal-header" style="background-color:#007bff; color:#FFFFFF">
        <h5 class="col-12 modal-title text-center">LISTADO DE LOS CLIENTES DEUDORES</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <!-- el listado de los deudores-->
             <div class="row">
                <div class="col-md-12">
                    <div class="card" style="background-color:#eaf0f5">
                        <div class="card-body">              
                            <div class="">
                                <div class="table-responsive mt-3 ">
                                <div class="col-md-6" style="text-align: right;"> <a  href="<?= site_url('Clientes/ClientesDeudoresPDF') ?>"class="btn btn-primary" title="Imprimir" target="_blank" ><i class="fa fa-print">GENERAR PDF </i></a>   </div> 
                                    <table class="table" id="tabla_deudores">
                                        <thead>
                                            <tr>                                    
                                                <th>Titular</th>
                                                <th>CUIL</th>
                                                <th>Inmueble</th>
                                                <th>Pagar entre el</t>
                                                <th>&Uacute;ltimo Pago</th>
                                                <th>Opci&oacute;n</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($deudores as $deudor): ?>
                                                <tr >                                       
                                                    <td><?= $deudor->id_usuario->apellido."  ".$deudor->id_usuario->nombre ?></td>
                                                    <td><?= $deudor->id_usuario->cuil ?></td>
                                                    <td><?= $deudor->id_inmueble->nombre?></td>
                                                    <td><?= $deudor->dia_desde . "-" . $deudor->dia_hasta ?></td>
                                                    <td><?= $deudor->tipo_contrato->periodo_texto ?></td>
                                                    <td>
                                                        <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                                                            <div class="btn-group mr-2" role="group" aria-label="First group">                                                    
                                                                <a  href="<?= site_url('clientes/verCliente/' . $deudor->id_usuario->id_persona . '/deudor') ?>"class="btn btn-secondary" title="Detalles"><i class="fa fa-search-plus"></i></a>                                                    
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php 
} */
?>  
