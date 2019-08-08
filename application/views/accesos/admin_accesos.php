<div>
    <!--inicio tabla ordenes de fabricacion-->
    <div class="row">
        <div class="col s12 m10 offset-m1 center-align card-panel">
            <h4>Administrar accesos</h4>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m10 offset-m1 card-panel">
            <div class="">
                <table class="highlight">
                    <thead>
                        <tr>
                            <th >Grupo</th>
                            <th class="center-align">Cantidad de usuarios</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($grupo as $grupo_usuarios): ?>
                            <tr>
                                <td>
                                    <?= $grupo_usuarios->nombre; ?>
                                </td>
                                <td class="center-align">
                                    <?= $grupo_usuarios->numeroUsuarios; ?>
                                </td>
                                <td class="center-align">
                                    <a class="waves-effect waves-light modal-trigger" href="#mdl_grupo" onclick="setDataPopup(<?= $grupo_usuarios->id ?>, '<?= $grupo_usuarios->nombre; ?>');"><i class="material-icons">open_in_new</i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Structure -->
<div id="mdl_grupo" class="modal modal-fixed-footer">
  <div class="modal-content">
    <h4>Permisos</h4>
    <p id="mdl_lbl_grp">ADMINISTRADOR</p>
        <div class="">
            <form id="form_mdl_grupo" action="<?php echo base_url(); ?>grupos/guardar_permisos" method="POST">
                    <div class="form-group" id="mdl_grp_header">
                    </div>
                    <div class="">
                        <table class="table table-hover table-nomargin" id="mdl_permisos_niveles">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>      
                                        Consultar
                                    </th>
                                    <th>
                                        Editar
                                    </th>
                                    <th>
                                        Eliminar
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="mdl_tbl_grp">
                                </tbody>
                        </table>                                
                    </div>
        </div>     
  </div>
  <div class="modal-footer">
    <a href="#!" onclick="update(this);" id="btn-upd" data-name="" data-id=""  class=" modal-action modal-close waves-effect waves-green btn-flat">Guardar</a>
  </div>
</div>
<!-- Modal -->

<script type="text/javascript">
    function getTblDetallePermiso(grp_id){
        $.ajax({
            url:"<?= site_url('accesos/getPermisos_byGrp') ?>",
            type:"POST",
            data:{'grp_id':grp_id},
            success:function(result){
                var result = $.parseJSON(result);
                if(result.status != 'error'){
                    var html = '';
                    $.each(result,function(i,item){
                        var id_mod = item.id;
                        var viz = '';
                        var ed = '';
                        var del = '';

                        viz = (item.consultar == 1? 'checked': '');
                        ed = (item.editar == 1? 'checked': '');
                        del = (item.eliminar == 1? 'checked': '');

                        html += '<tr>\
                                        <td class="font-bold">'+item.nombre_permiso+'<input type="hidden" value="'+id_mod+'"></td>\
                                        <td><label><input type="checkbox" name="view_'+id_mod+'" class="filled-in" '+viz+'><span></span></label></td>\
                                        <td><label><input type="checkbox" name="edit_'+id_mod+'" class="filled-in" '+ed+'><span></span></label></td>\
                                        <td><label><input type="checkbox" name="del_'+id_mod+'" class="filled-in" '+del+'><span></span></label></td>\
                                    </tr>';
                    });
                    $('#mdl_tbl_grp').html(html);
                }
            }
        });
    }
    function setDataPopup(id, name) {
        $('#mdl_lbl_grp').text('GRUPO: '+name);
        $("#btn-upd").attr('data-id', id);
        $("#btn-upd").attr('data-name', name);
        getTblDetallePermiso(id);
    }      
    function update(event) {

        var data = [];
        var filas = $('#mdl_tbl_grp tr');

        $.each(filas,function(i,item){
            var viz = 0;
            var edit = 0;
            var del = 0;

            var id_permiso = $(this).find('td').eq(0).find('input').val();
            if($(this).find('td').eq(1).find('input[type="checkbox"]').is(':checked'))
            {
                viz = 1;
            }
            if($(this).find('td').eq(2).find('input[type="checkbox"]').is(':checked'))
            {
                edit = 1;
            }
            if($(this).find('td').eq(3).find('input[type="checkbox"]').is(':checked'))
            {
                del = 1;
            }

            var item = {};

            item['id_grp_per'] = id_permiso;
            item['visualizar'] = viz;
            item['editar'] = edit;
            item['eliminar'] = del; 

            data.push(item);                                   
        });

        var info = JSON.stringify(data);
        //console.log(info);
        
        $.ajax({
            type: 'POST',
            url: "<?= site_url('accesos/updatePer') ?>",
            data: {'id': $(event).attr('data-id'), 'name': $(event).attr('data-name'), 'tbl':info},
            dataType: 'json',
            success: (result) => {
                if(result.status == 'success'){
                    location.reload()
                } else if(result.status == 'error'){
                    alert('Error!: '+result.mensaje);
                } else{
                    alert('Ups!. Algo salio mal.');
                }
            }
        });
    }    
    $(document).ready(function () {
        $('.modal').modal({opacity: 0.5});
    })

</script>