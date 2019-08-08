<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Alumno extends CI_Controller {
    
 
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
        $this->load->model('Alumno_model');
        $this->load->model('General_model');
        $this->id_usuario = $this->session->userdata('id_usuario');

    }

    public function index() {
        $buscado = '';
        if ($this->input->post('buscado')) {
            $buscado = trim($this->input->post('buscado'));
            Fechautil::actividad('Alumno: buscar Persona con patron ' . $buscado);
        }
        $dato['buscado'] = $buscado;
        $Alumnos = $this->Alumno_model->listAlumnoBy($buscado, 'Alumno');
        foreach ($Alumnos as $Alumno) {
                $Alumno->IdBarrio= $this->General_model->getBarrio($Alumno->IdBarrio);
                $Alumno->IdColegio= $this->General_model->getColegio($Alumno->IdColegio);
                $Alumno->IdTituloSecundario= $this->General_model->getTituloSecundario($Alumno->IdTituloSecundario);
        }
        $dato['Alumno'] = $Alumnos;
         $data["content"] = $this->load->view("Alumno/Alumno-list", $dato, TRUE); 
        $this->load->view("principal", $data);
   }


    public function agregarAlumno($idAlumno=0) {
        $Alumno_New = new stdClass;
        $Alumno_New->IdAlumno=0;
        $Alumno_New->LegAlumno="";
        $Alumno_New->Nombre="";
        $Alumno_New->Apellido="";
        $Alumno_New->Dni="";
        $Alumno_New->Telefono="";
        $Alumno_New->Email="";
        $Alumno_New->LugarNacimiento="";
        $Alumno_New->Domicilio="";
        $Alumno_New->IdBarrio=0;
        $Alumno_New->IdColegio=0;
        $Alumno_New->IdTituloSecundario=0;
        $barrios = $this->General_model->getBarrio(0);
        $colegios =$this->General_model->getColegio(0);
        $IdTituloSecundario= $this->General_model->getTituloSecundario(0);
        if($idAlumno == 0)
        {
            $alumno =  $Alumno_New;
        } else{
            
            $alumno =  $this->General_model->getAlumno($idAlumno);
        }

         $ListaBarrios = array('' => 'Seleccione ...');
         $ListaColegios = array('' => 'Seleccione ...');
         $ListaTituloSec = array('' => 'Seleccione ...');
         if($barrios != null)
         {
            foreach ($barrios as $barrio) {
                $ListaBarrios[$barrio->IdBarrio] = $barrio->Nombre;
            }
         }
         if($colegios != null)
         {
            foreach ($colegios as $colegio) {
                $ListaColegios[$colegio->IdColegio] = $colegio->Nombre;
            }
         }
         if($IdTituloSecundario != null)
         {
            foreach ($IdTituloSecundario as $tituloSec) {
                $ListaTituloSec[$tituloSec->IdTituloSec] = $tituloSec->NombreTitulo;
            }
         }
         ksort($ListaBarrios);
         ksort($ListaColegios);
         ksort($ListaTituloSec);
         $datos['Alumnoes'] = $alumno; 
        $datos['ListaBarrio'] = $ListaBarrios;
        $datos['ListaColegio'] = $ListaColegios;
        $datos['ListaTituloSec'] = $ListaTituloSec;
        $data["content"] = $this->load->view("Alumno/Alumno-form", $datos, TRUE);
        $this->load->view("principal", $data);
    }

    public function saveAlumno() {       
        $estado= $this->Alumno_model->saveAlumno(trim($this->input->post('legAlumno')), trim($this->input->post('nombre')), trim($this->input->post('apellido')),
        (int) $this->input->post('Dni'),(int) $this->input->post('Telefono'),trim($this->input->post('Email')), trim($this->input->post('LugarNacimiento'))
        ,trim($this->input->post('Domicilio')), (int) $this->input->post('IdBarrio'),(int) $this->input->post('IdColegio'),(int) $this->input->post('IdTituloSecundario'),
        (int) $this->input->post('IdAlumno')); 
         if($estado =="")
         {
            $this->session->set_flashdata('mensaje', '<div class="alert alert-success">La Operacion se Realiza con Éxito.</div>');
            $mensaje_log.=" Guardado Exitosamente"; 
         } else
         {
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">No se pudo ralizar tal Operción.. ('.$estado.').</div>');
            $mensaje_log.=$estado;
         }
        Fechautil::actividad('Alumno:' . $mensaje_log . "|" . serialize($_POST));
        redirect('Alumno');
    }

    public function eliminarAlumno($idAlumno=0) {
        $exito = $this->General_model->eliminarTabla('alumno','IdAlumno',$idAlumno);
        if ($exito) {
            $this->session->set_flashdata('mensaje', '<div class="alert alert-success">El Alumno se Elimino Correctamente <b></b></div>');
        }
        else
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">Ocurrio un error al intenar eliminar el Alumno</div>');
        redirect('Alumno');
    }
    

    public function AlumnoPDF()
    {
        $fecha = date('Y-m-d');
        $this->load->library('pdf');
        $this->load->library('numeroletra');
        ob_clean();
        $pdf = new Pdf('L', 'mm', 'A3', true, 'UTF-8', false);
         $this->load->model('Alumno_model');

        $Alumnos = $this->Alumno_model->listAlumnoBy(NULL, NULL);
        foreach ($Alumnos as $Alumno) {
            $Alumno->IdBarrio= $this->General_model->getBarrio($Alumno->IdBarrio);
            $Alumno->IdColegio= $this->General_model->getColegio($Alumno->IdColegio);
            $Alumno->IdTituloSecundario= $this->General_model->getTituloSecundario($Alumno->IdTituloSecundario);
           }
        $datos['Alumno'] = $Alumnos;
        $vista  = $this->load->view("Alumno/AlumnoListPDF", $datos, TRUE);
        $pdf->AddPage();
        $pdf->writeHTML($vista, true, 0, true, 0, true, 'L');
        $pdf->Output('Alumno_'.$fecha .'.pdf', 'I');
    }
    

}

