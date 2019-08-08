<?php

class Permisos_model extends CI_Model {

    public function grupo_getAll(){
        $sql = "SELECT *, 
                        (SELECT COUNT(u.id) FROM usuario u WHERE u.estado = 1 AND u.grupo_id = g.id) AS numeroUsuarios 
                FROM grupo g                        
        ";
        return $this->db->query($sql)->result();
    }

    public function grupo_getPermisos($id){
        $sql="SELECT g_p.id, g_p.grupo_id, g_p.permiso_id, g_p.consultar, g_p.editar, g_p.eliminar,
                        p.descripcion AS nombre_permiso
                FROM grupo_permiso g_p 
                    LEFT JOIN permiso p
                        ON p.id = g_p.permiso_id
                WHERE g_p.grupo_id = {$id}
        ";
        return $this->db->query($sql)->result();
    }

    public function post_updatePer($postData){
        $id_grp = $postData['id'];
        $det_permisos = json_decode($postData['tbl']);
        for ($i=0; $i < count($det_permisos); $i++) { 
            $data = array(
                            'consultar' => $det_permisos[$i]->visualizar, 
                            'editar' => $det_permisos[$i]->editar, 
                            'eliminar' => $det_permisos[$i]->eliminar
            );
            $this->db->where('id',$det_permisos[$i]->id_grp_per);
            $this->db->update('grupo_permiso',$data);
        }
        return array(
                        'status'=>'success',
                        'mensaje'=>'Se actualizaron correctamente los permisos.'
        );         

    }
    public function grupo_getTienePerm($controlador,$tip_op){
        $id_grupo = $this->session->userdata['grupo_id'];
        $sql="SELECT g_p.id, g_p.grupo_id, g_p.permiso_id, g_p.consultar, g_p.editar, g_p.eliminar,
                        p.controlador
                FROM grupo_permiso g_p 
                    LEFT JOIN permiso p
                        ON p.id = g_p.permiso_id
                WHERE g_p.grupo_id = {$id_grupo} AND p.controlador = '{$controlador}' AND g_p.".$tip_op." = 1
        ";
        $query=$this->db->query($sql);
        if($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }

}
