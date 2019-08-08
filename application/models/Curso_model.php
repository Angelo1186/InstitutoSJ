<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Curso_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function saveCurso($IdProfesor,$IdMateria,$Anio,$FechaInicioInscripcion,$FechaFinInscripcion,$FechaFin,$IdCurso) {
         $error="";
        $datos = array();
        $datos['IdProfesor']=$IdProfesor;
        $datos['IdMateria']=$IdMateria;
        $datos['Anio']=$Anio;
        $datos['FechaInicioInscripcion']=date_format($FechaInicioInscripcion,'Y-m-d');
        $datos['FechaFinInscripcion']=date_format($FechaFinInscripcion,'Y-m-d');
        $datos['FechaFin']= date_format($FechaFin,'Y-m-d');
        $datos['Activo']= 1;
        try {
            if($IdCurso == 0)
            {
                $this->db->insert('curso', $datos);
              
            } else{
                $this->db->update('curso', $datos, array('IdCurso' => $IdCurso)); 
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                throw new Exception("Database error:");
                $error= "Error!!! No se pudo Agregar el Curso";
            }
        } catch (Exception $e) {
            log_message('error: ',$e->getMessage());
            $error="Error!!! No se pudo Agregar el Curso";
        }
        return $error;
    }


    public function listCursoBy($campo_buscar='', $tipo=NULL) {
        $resultados = array();
        $sql = "SELECT * FROM curso WHERE Activo=1";
        if ($campo_buscar != '' && isset($campo_buscar)) {
            if (is_numeric($campo_buscar) || strpos($campo_buscar, "-")!==false) {
                $sql.=" AND ( Anio LIKE'%" . $campo_buscar . "%')";
                
            } 
        }
        $objeto = $this->db->query($sql);
        $resultados = $objeto->result();
        return $resultados;
    }

 

/*
    public function saveDomicilio($direccion='', $ciudad='', $provincia='', $idusuario=0, $fechacarga='0000-00-00 00:00:00') {
        $this->db->insert('domicilios', array('direccion' => $direccion, 'ciudad' => $ciudad, 'provincia' => $provincia, 'id_usuario' => $idusuario, 'fecha_carga' => $fechacarga, 'activo' => 1));
        return $this->db->insert_id();
    }

    public function getDomicilio($iddomicilio=0) {
        if (!is_numeric($iddomicilio) || !isset($iddomicilio))
            return FALSE;
        $sql = "SELECT * FROM domicilios WHERE id_domicilio=" . (int) $iddomicilio;
        $objeto = $this->db->query($sql);
        if ($objeto)
            return $objeto->row();
        return FALSE;
    }

    public function saveTelefono($numero='', $idusuario=0, $fechacarga='0000-00-00 00:00:00') {
        $this->db->insert('telefonos', array('numero' => $numero, 'id_usuario' => $idusuario, 'fecha_carga' => $fechacarga, 'activo' => 1));
        return $this->db->insert_id();
    }

    public function getTelefono($idtelefono=0) {
        if (!is_numeric($idtelefono) || !isset($idtelefono))
            return FALSE;
        $sql = "SELECT * FROM telefonos WHERE id_telefono=" . (int) $idtelefono;
        $objeto = $this->db->query($sql);
        if ($objeto)
            return $objeto->row();
        return FALSE;
    }

    public function savePersonaTipo($idpersona=0, $tipo='', $regimen_impositivo='', $fecha='0000-00-00', $idusuario=0, $fechacarga='0000-00-00 00:00:00') {
        $this->db->insert('personas_tipos', array('id_persona' => $idpersona, 'tipo' => $tipo, 'regimen_impositivo' => $regimen_impositivo, 'fecha' => $fecha, 'id_usuario' => $idusuario, 'fecha_carga' => $fechacarga, 'activo' => 1));
        return $this->db->insert_id();
    }

    public function getPersonaTipo($idpersonatipo=0) {
        if (!is_numeric($idpersonatipo) || !isset($idpersonatipo))
            return FALSE;
        $sql = "SELECT * FROM personas_tipos WHERE id_persona_tipo=" . (int) $idpersonatipo;
        $objeto = $this->db->query($sql);
        if ($objeto)
            return $objeto->row();
        return FALSE;
    }

    public function savePersonaContrato($idpersona=0, $idcontrato=0, $idinmueble=0, $tipo='', $iddomicilio=0, $idusuario=0, $fechacarga='0000-00-00 00:00:00') {
        $this->db->insert('personas_contratos', array('id_persona' => $idpersona, 'id_contrato' => $idcontrato, 'id_inmueble' => $idinmueble, 'tipo' => $tipo, 'id_domicilio' => $iddomicilio, 'id_usuario' => $idusuario, 'fecha_carga' => $fechacarga, 'activo' => 1));
        return $this->db->insert_id();
    }

    public function getPersonaContrato($idpersonacontrato=0) {
        if (!is_numeric($idpersonacontrato) || !isset($idpersonacontrato))
            return FALSE;
        $sql = "SELECT * FROM personas_contratos WHERE id_persona_contrato=" . (int) $idpersonacontrato;
        $objeto = $this->db->query($sql);
        if ($objeto)
            return $objeto->row();
        return FALSE;
    }

    public function getPersonaDomicilioTelefono($idpersona=0) {
        if (!is_numeric($idpersona) || !isset($idpersona))
            return FALSE;
        $sql = "SELECT p.*,d.*,t.* FROM personas AS p
                INNER JOIN domicilios AS d ON p.id_domicilio=d.id_domicilio
                INNER JOIN telefonos AS t ON p.id_telefono=t.id_telefono
                WHERE id_persona=" . (int) $idpersona;
        $objeto = $this->db->query($sql);
        if ($objeto)
            return $objeto->row();
        return FALSE;
    }
*/
}