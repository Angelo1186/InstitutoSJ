<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ProfesorDictando extends CI_Controller {
    
 
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
        $this->load->model('ProfesorDictando_model');
        $this->load->model('General_model');
        $this->id_usuario = $this->session->userdata('id_usuario');

    }

    public function Materias() {
        $buscado = '';
        if ($this->input->post('buscado')) {
            $buscado = trim($this->input->post('buscado'));
            Fechautil::actividad('Curso Asignado: buscar Persona con patron ' . $buscado);
        }
        $dato['buscado'] = $buscado;
        $curso = $this->ProfesorDictando_model->listCursorBy($buscado, 'Profesor');
        foreach ($curso as $cursos) {
                $cursos->IdMateria= $this->General_model->getMateria($cursos->IdMateria);
        }

        $dato['materia'] = $curso;
         $data["content"] = $this->load->view("ProfesorDictando/Materia-list", $dato, TRUE);
        $this->load->view("principal", $data);
   }
   public function ListaAlumno($idCurso=0)
   {
    $buscado = '';
        $cursoAlu = $this->ProfesorDictando_model->listAlumnosBy($idCurso);
        foreach ($cursoAlu as $cursoAl) {
                $cursoAl->IdAlumno= $this->General_model->getAlumno($cursoAl->IdAlumno);
        }
        $dato['buscado'] = $buscado;
        $dato['cursoAlu'] = $cursoAlu;
        $dato['idCurso'] = $idCurso;
        $data["content"] = $this->load->view("ProfesorDictando/Alumno-list", $dato, TRUE);
        $this->load->view("principal", $data);
   }
   public function ListaAlumnoMesa($idMesa=0)
   {
    $IdEstadoParcial=0;
        $mesaAlu = $this->ProfesorDictando_model->listAlumnosMesaBy($idMesa);
        $ListaEstados= $this->General_model->getEstadoNota(0);
        foreach ($mesaAlu as $mesaAl) {
                $mesaAl->IdAlumno= $this->General_model->getAlumno($mesaAl->IdAlumno);
        }
        $ListaEstado = array('' => 'Seleccione ...');
        if($ListaEstados != null)
        {
            foreach ($ListaEstados as $ListaEstad) {
                $ListaEstado[$ListaEstad->IdEstado] = $ListaEstad->Nombre;
            }
        }
        $dato['mesaAlu'] = $mesaAlu;
        $dato['ListaEstado'] = $ListaEstado;
        $dato['IdEstadoParcial'] = $IdEstadoParcial;
        $dato['idMesa'] = $idMesa;
        $data["content"] = $this->load->view("ProfesorDictando/AlumnoMesa-list", $dato, TRUE);
        $this->load->view("principal", $data);
   }

        public function MesaAsignadas() {
                $buscado = '';
                
                    if ($this->input->post('buscado')) {
                        $buscado = trim($this->input->post('buscado'));
                        Fechautil::actividad('Materias Asignadas: buscar Persona con patron ' . $buscado);
                    }
                $dato['buscado'] = $buscado;
                $materias = $this->ProfesorDictando_model->listMesaBy($buscado, 'Profesor');
                foreach ($materias as $materia) {
                    $materia->IdMateria= $this->General_model->getMateria($materia->IdMateria);
                    $materia->IdCarrera= $this->General_model->getCarrera($materia->IdCarrera);
                }
                $dato['MesaAsignadas'] = $materias;
                $data["content"] = $this->load->view("ProfesorDictando/MesaAsignada-list", $dato, TRUE);
                $this->load->view("principal", $data);
        }
    public function mostrarNotas($idAlumno,$idMateria)
    {
        $AddNota = new stdClass; 
        $datos = array();   
        $IdNumeroParcials=0;
        $ListaNotas=$this->General_model->ConsultarNotas($idAlumno,$idMateria); 
        $listaNumeroParcial=$this->General_model->ListarNumeroParcial();    
        foreach ($ListaNotas as $ListaNota) {
            $ListaNota->IdNumeroParcial= $this->General_model->getNumeroParcial($ListaNota->IdNumeroParcial);
          }  
          $listaNumeroParcials = array('' => 'Seleccione ...');
          if($listaNumeroParcial != null)
          {
             foreach ($listaNumeroParcial as $listaNumeroParcia) {
                 $listaNumeroParcials[$listaNumeroParcia->IdNumeroParcial] = $listaNumeroParcia->Nombre;
             }
          }
          $AddNota->IdAlumno= $idAlumno;
          $AddNota->IdMateria=$idMateria;
        $datos["ListaNotas"] = $ListaNotas;
        $datos["IdNumeroParcials"] = $IdNumeroParcials;
        $datos["listaNumeroParcial"]=$listaNumeroParcials;
        $datos["AddNota"] =$AddNota;
        $this->load->view("ProfesorDictando/ListaNotas", $datos);
    }

    public function getNotas() {
        $idAlumno=(int) $this->input->post('idAlumno');
        $idCurso=(int) $this->input->post('idCurso');
       $materia=$this->General_model->getCurso($idCurso);  
       $this->mostrarNotas($idAlumno,$materia->IdMateria);
    }
    public function SaveNotas() {
        $idAlumno=(int) $this->input->post('idAlumno');
        $idMateria=(int) $this->input->post('idMateria');
        $datos = array();
        $datos['IdAlumno']=(int) $this->input->post('idAlumno');
        $datos['IdMateria']=(int) $this->input->post('idMateria'); 
        $datos['nota']=(float) $this->input->post('nota');
        $datos['IdNumeroParcial']=(int) $this->input->post('idNumeroParcial');
        $datos['IdCurso']=4;
        $datos['FechaNota']=date('Y-m-d');
        $datos['IdEstado']=2;
        $datos['Activo']=1;
       $this->General_model->SaveNotas($datos); 
       $this->mostrarNotas($idAlumno,$idMateria);
    }
    public function SaveNotasFinal() {
        $idMesaAlumno=(int) $this->input->post('idMesaAlumno');
        $nota=(int) $this->input->post('nota');
        $idEstadoParcial=(int) $this->input->post('idEstadoParcial'); 
        $this->General_model->SaveNotasFinals($idMesaAlumno,$nota);
       
        $mesa=$this->General_model->getMesaAlumno($idMesaAlumno);
        $mes=$this->General_model->getMesa($mesa->IdMesa);
        $idAlumno= $mesa->IdAlumno;
        $IdMateria=$mes->IdMateria;
        $datos = array();
        $datos['IdAlumno']=$idAlumno;
        $datos['IdMateria']=$IdMateria; 
        $datos['nota']=(float) $nota;
        $datos['IdNumeroParcial']=8;
        $datos['IdCurso']=2;
        $datos['FechaNota']=date('Y-m-d');
        $datos['IdEstado']=$idEstadoParcial;
        $datos['Activo']=1;
        $this->General_model->SaveNotas($datos);
        return true;
    }
    
    public function DeleteNotas() {
        $idNota=(int) $this->input->post('idNota');
        $nota=$this->General_model->getNota($idNota);  
        $idAlumno=$nota->IdAlumno;
        $idMateria=$nota->IdMateria;
        $exito = $this->General_model->eliminarTabla('nota','IdNota',$idNota);
        $this->mostrarNotas($idAlumno,$idMateria);
    }
}

