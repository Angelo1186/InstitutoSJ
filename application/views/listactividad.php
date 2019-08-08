<div class="row">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Fecha/Hora</th>
                <th>Actividad</th>
                <th>URL</th>
                <th>Usuario</th>
            </tr>		
        </thead>
        <tbody>
            <?php foreach ($actividades as $actividad) { ?>					 
                <tr>
                    <td><?= $actividad->fecha ?></td>					
                    <td><?= $actividad->actividad ?></td>
                    <td><?= $actividad->url ?></td>
                    <td><?= $actividad->usuario ?></td>
                </tr>
            <?php } ?>		
        </tbody>
    </table>
</div>

