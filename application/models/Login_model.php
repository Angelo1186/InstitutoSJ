<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Login_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function autenticar_login($postData) {
        $username = trim($postData['log_username']);
        $pass = md5(trim($postData['log_pass']));

        $sql = "SELECT usu.id_usuario,usu.id_grupo,usu.usuario,grp.nombre,usu.nombre AS grupo FROM usuarios usu
                       INNER JOIN grupos grp
    					ON grp.id_grupo = usu.id_grupo
    			WHERE usu.activo = 1 AND usu.usuario = '{$username}' AND usu.clave = '{$pass}'
    	";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->first_row();
            return array(
                'status' => 'success',
                'id_usuario' => $row->id_usuario,
                'usuario' => $row->usuario,
                'id_grupo' => $row->id_grupo,
                'nombre' =>$row->nombre,
                'grupo' => $row->grupo,
                'logged_in' => TRUE
            );
        } else {
            return array(
                'status' => 'error'
            );
        }
    }

}

// fin