<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class General_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    public function getProfesor($idProfesor=0) {
        if($idProfesor ==0)
        {
            $resultados = array();
            $sql = "SELECT * FROM profesor where Activo = 1";
            $objeto = $this->db->query($sql);
            if ($objeto)
                $resultados = $objeto->result();
            return $resultados;
        }
        if (!is_numeric($idProfesor) || !isset($idProfesor))
            return FALSE;
        $sql = "SELECT * FROM Profesor WHERE IdProfesor=" . (int) $idProfesor;
        $objeto = $this->db->query($sql);
        if ($objeto)
            return $objeto->row();
       return FALSE;
    }
    public function getUsuario($idUsuario=0) {
        if($idUsuario ==0)
        {
            $resultados = array();
            $sql = "SELECT * FROM usuarios where activo = 1";
            $objeto = $this->db->query($sql);
            if ($objeto)
                $resultados = $objeto->result();
            return $resultados;
        }
        if (!is_numeric($idUsuario) || !isset($idUsuario))
            return FALSE;
        $sql = "SELECT * FROM usuarios WHERE id_usuario=" . (int) $idUsuario;
        $objeto = $this->db->query($sql);
        if ($objeto)
            return $objeto->row();
       return FALSE;
    }
    public function getAlumno($idAlumno=0) {
        if($idAlumno ==0)
        {
            $resultados = array();
            $sql = "SELECT * FROM alumno where Activo = 1";
            $objeto = $this->db->query($sql);
            if ($objeto)
                $resultados = $objeto->result();
            return $resultados;
        }

        if (!is_numeric($idAlumno) || !isset($idAlumno))
            return FALSE;
        $sql = "SELECT * FROM alumno WHERE IdAlumno=" . (int) $idAlumno;
        $objeto = $this->db->query($sql);
        if ($objeto)
            return $objeto->row();
       return FALSE;
    }
    public function getBarrio($idbarrio=0) {
        if($idbarrio ==0)
        {
            $resultados = array();
            $sql = "SELECT * FROM barrio where Activo = 1";
            $objeto = $this->db->query($sql);
            if ($objeto)
                $resultados = $objeto->result();
            return $resultados;
        }
        if (!is_numeric($idbarrio) || !isset($idbarrio))
            return FALSE;
        $sql = "SELECT * FROM barrio WHERE IdBarrio=" . (int) $idbarrio;
        $objeto = $this->db->query($sql);
        if ($objeto)
            return $objeto->row();
        return FALSE;
    }
    public function getColegio($idColegio=0) {
        if($idColegio ==0)
        {
            $resultados = array();
            $sql = "SELECT * FROM colegiosecundario where Activo = 1";
            $objeto = $this->db->query($sql);
            if ($objeto)
                $resultados = $objeto->result();
            return $resultados;
        }
        if (!is_numeric($idColegio) || !isset($idColegio))
            return FALSE;
        $sql = "SELECT * FROM colegiosecundario WHERE IdColegio=" . (int) $idColegio;
        $objeto = $this->db->query($sql);
        if ($objeto)
            return $objeto->row();
        return FALSE;
    }
    public function getTituloSecundario($idTituloSecu=0) {
        if($idTituloSecu ==0)
        {
            $resultados = array();
            $sql = "SELECT * FROM titulosecundario where Activo = 1";
            $objeto = $this->db->query($sql);
            if ($objeto)
                $resultados = $objeto->result();
            return $resultados;
        }
        if (!is_numeric($idTituloSecu) || !isset($idTituloSecu))
            return FALSE;
        $sql = "SELECT * FROM titulosecundario WHERE IdTituloSec=" . (int) $idTituloSecu;
        $objeto = $this->db->query($sql);
        if ($objeto)
            return $objeto->row();
        return FALSE;
    }
    public function eliminarTabla($tabla='',$idPrimary=0, $idAlumno=0) {
        if($this->db->delete($tabla, array($idPrimary => $idAlumno)))
        return true;
         else
            return false;
    }
    public function getMateria($idMateria=0) {
        if($idMateria ==0)
        {
            $resultados = array();
            $sql = "SELECT * FROM materia where Activo = 1";
            $objeto = $this->db->query($sql);
            if ($objeto)
                $resultados = $objeto->result();
            return $resultados;
        }
        if (!is_numeric($idMateria) || !isset($idMateria))
            return FALSE;
        $sql = "SELECT * FROM materia WHERE IdMateria=" . (int) $idMateria;
        $objeto = $this->db->query($sql);
        if ($objeto)
            return $objeto->row();
       return FALSE;
    }
    public function getCarrera($idCarrera=0) {
        if($idCarrera ==0)
        {
            $resultados = array();
            $sql = "SELECT * FROM carrera where Activo = 1";
            $objeto = $this->db->query($sql);
            if ($objeto)
                $resultados = $objeto->result();
            return $resultados;
        }
        if (!is_numeric($idCarrera) || !isset($idCarrera))
            return FALSE;
        $sql = "SELECT * FROM carrera WHERE IdCarrera=" . (int) $idCarrera;
        $objeto = $this->db->query($sql);
        if ($objeto)
            return $objeto->row();
       return FALSE;
    }
    public function ActualizarMateriaCarrera($idmateria)
    {
        $resultados = array();
        $sql = "SELECT c.* FROM carrera as c where c.IdCarrera not in (SELECT IdCarrera from materia_carrera where IdMateria =".(int) $idmateria.")";
        $objeto = $this->db->query($sql);
        if ($objeto->num_rows() > 0)
        {
            $resultados = $objeto->result();
            foreach ($resultados as $res){
                $datos = array();
                $datos['IdCarrera']=$res->IdCarrera;
                $datos['IdMateria']=$idmateria;
                $datos['Activo']=0;
                $this->db->insert('materia_carrera', $datos);
            }
        }
    }
    public function CheckedMateria($idCarrera, $idMateria) // me perimite conocer que materia esta asignada para que materia
    {
        if($idCarrera ==0)
        {
            $sql = "update materia_carrera set Activo=0 where IdMateria=".(int) $idMateria;
          
        } else{
            $sql = "update materia_carrera set Activo=1 where IdMateria=".(int) $idMateria." and IdCarrera =".(int) $idCarrera;
        }
        $this->db->query($sql);
        return;
    }

    public function getMateriaCarrera($idmateria=0) {
      /*  if($idmateria ==0)
        {
            $resultados = array();
            $sql = "SELECT * FROM materia_carrera where Activo = 1";
            $objeto = $this->db->query($sql);
            if ($objeto)
                $resultados = $objeto->result();
            return $resultados;
        } */
        if (!is_numeric($idmateria) || !isset($idmateria))
            return FALSE;
        $sql = "SELECT mc.* FROM materia_carrera as mc 
                              INNER JOIN carrera as c on mc.IdCarrera = c.IdCarrera
                              INNER JOIN materia as m on mc.IdMateria = m.IdMateria
                               WHERE c.Activo=1 and m.Activo =1 and mc.IdMateria=" . (int) $idmateria;
        $objeto = $this->db->query($sql);
        if ($objeto)
        $resultados = $objeto->result();
        return $resultados;
    }
    public function getCurso($idCurso=0) {
        if($idCurso ==0)
        {
            $resultados = array();
            $sql = "SELECT * FROM curso where Activo = 1";
            $objeto = $this->db->query($sql);
            if ($objeto)
                $resultados = $objeto->result();
            return $resultados;
        }
        if (!is_numeric($idCurso) || !isset($idCurso))
            return FALSE;
        $sql = "SELECT * FROM curso WHERE IdCurso=" . (int) $idCurso;
        $objeto = $this->db->query($sql);
        if ($objeto)
            return $objeto->row();
       return FALSE;
    }
    public function getMesa($idMesa=0) {
        if($idMesa ==0)
        {
            $resultados = array();
            $sql = "SELECT * FROM mesa where Activo = 1";
            $objeto = $this->db->query($sql);
            if ($objeto)
                $resultados = $objeto->result();
            return $resultados;
        }
        if (!is_numeric($idMesa) || !isset($idMesa))
            return FALSE;
        $sql = "SELECT * FROM mesa WHERE IdMesa=" . (int) $idMesa;
        $objeto = $this->db->query($sql);
        if ($objeto)
            return $objeto->row();
       return FALSE;
    }
    public function getCorrelatividad($idCorrelatividad=0) {
        if($idCorrelatividad ==0)
        {
            $resultados = array();
            $sql = "SELECT * FROM correlatividad where Activo = 1";
            $objeto = $this->db->query($sql);
            if ($objeto)
                $resultados = $objeto->result();
            return $resultados;
        }
        if (!is_numeric($idCorrelatividad) || !isset($idCorrelatividad))
            return FALSE;
        $sql = "SELECT * FROM correlatividad WHERE IdCorrelatividad=" . (int) $idCorrelatividad;
        $objeto = $this->db->query($sql);
        if ($objeto)
            return $objeto->row();
       return FALSE;
    }
    public function GetCorrelativa($idCarrera=0) {
        $resultados = array();
        $sql = "SELECT m.* FROM materia as m 
                inner join materia_carrera as mc on mc.IdMateria = m.IdMateria
                 WHERE mc.IdCarrera=".$idCarrera; 
        $objeto = $this->db->query($sql);
        $resultados = $objeto->result();
        return $resultados;
    }
    public function ConsultarNotas($idAlumno, $idMateria){
        $resultados = array();
        $sql = "SELECT n.* FROM nota as n WHERE n.IdAlumno=".$idAlumno." and n.IdMateria=".$idMateria; 
        $objeto = $this->db->query($sql);
        $resultados = $objeto->result();
        return $resultados;
    }
    public function ListarNumeroParcial()
    {
        $resultados = array();
        $sql = "SELECT n.* FROM numeroparcial as n WHERE n.Activo=1"; 
        $objeto = $this->db->query($sql);
        $resultados = $objeto->result();
        return $resultados;
    }
    public function SaveNotas($datos){
        $this->db->insert('nota', $datos);

        $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                throw new Exception("Database error:");
                $error= "Error!!! No se pudo Agregar el Alumno";
            }
     return true;
    }
    public function SaveNotasFinals($idMesaAlumno,$nota)
    {
        $sql = "update mesa_alumno set Nota=".$nota." where IdMesaAlumno=".$idMesaAlumno; 
        $this->db->query($sql);
        return true;
    }
    public function getMesaAlumno($idMesaAlumno=0)
    {
        if($idMesaAlumno ==0)
        {
            $resultados = array();
            $sql = "SELECT * FROM mesa_alumno where Activo = 1";
            $objeto = $this->db->query($sql);
            if ($objeto)
                $resultados = $objeto->result();
            return $resultados;
        }
        if (!is_numeric($idMesaAlumno) || !isset($idMesaAlumno))
            return FALSE;
        $sql = "SELECT * FROM mesa_alumno WHERE IdMesaAlumno=" . (int) $idMesaAlumno;
        $objeto = $this->db->query($sql);
        if ($objeto)
            return $objeto->row();
       return FALSE;
    }
    
    public function getNumeroParcial($idNumeroParcial=0) {
        if($idNumeroParcial ==0)
        {
            $resultados = array();
            $sql = "SELECT * FROM numeroparcial where Activo = 1";
            $objeto = $this->db->query($sql);
            if ($objeto)
                $resultados = $objeto->result();
            return $resultados;
        }
        if (!is_numeric($idNumeroParcial) || !isset($idNumeroParcial))
            return FALSE;
        $sql = "SELECT * FROM numeroparcial WHERE IdNumeroParcial=" . (int) $idNumeroParcial;
        $objeto = $this->db->query($sql);
        if ($objeto)
            return $objeto->row();
       return FALSE;
    } 
    public function getEstadoNota($idEstado=0) {
        if($idEstado ==0)
        {
            $resultados = array();
            $sql = "SELECT * FROM estado where Activo = 1";
            $objeto = $this->db->query($sql);
            if ($objeto)
                $resultados = $objeto->result();
            return $resultados;
        }
        if (!is_numeric($idEstado) || !isset($idEstado))
            return FALSE;
        $sql = "SELECT * FROM estado WHERE IdEstado=" . (int) $idEstado;
        $objeto = $this->db->query($sql);
        if ($objeto)
            return $objeto->row();
       return FALSE;
    }
    public function getNota($idNota=0) {
        if($idNota ==0)
        {
            $resultados = array();
            $sql = "SELECT * FROM nota where Activo = 1";
            $objeto = $this->db->query($sql);
            if ($objeto)
                $resultados = $objeto->result();
            return $resultados;
        }
        if (!is_numeric($idNota) || !isset($idNota))
            return FALSE;
        $sql = "SELECT * FROM nota WHERE IdNota=" . (int) $idNota;
        $objeto = $this->db->query($sql);
        if ($objeto)
            return $objeto->row();
       return FALSE;
    }
    
}