<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Curso extends CI_Controller {
    
 
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
        $this->load->model('Curso_model');
        $this->load->model('General_model');
        $this->id_usuario = $this->session->userdata('id_usuario');

    }

    public function index() {
        $buscado = '';
        if ($this->input->post('buscado')) {
            $buscado = trim($this->input->post('buscado'));
            Fechautil::actividad('Curso: buscar Persona con patron ' . $buscado);
        }
        $dato['buscado'] = $buscado;
        $Cursos = $this->Curso_model->listCursoBy($buscado, 'Curso');
        foreach ($Cursos as $Curso) {
                $Curso->IdMateria= $this->General_model->getMateria($Curso->IdMateria);
                $Curso->IdProfesor= $this->General_model->getProfesor($Curso->IdProfesor);
                $Curso->FechaInicioInscripcion= date('d-m-Y',strtotime($Curso->FechaInicioInscripcion));
                $Curso->FechaFinInscripcion=date('d-m-Y',strtotime($Curso->FechaFinInscripcion));
                $Curso->FechaFin=date('d-m-Y',strtotime($Curso->FechaFin));
        }
        $dato['Curso'] = $Cursos;
         $data["content"] = $this->load->view("Curso/Curso-list", $dato, TRUE); 
        $this->load->view("principal", $data);
   }


    public function agregarCurso($idCurso=0) {
        $Curso_New = new stdClass;
        $Curso_New->IdCurso=0;
        $Curso_New->Anio="";
        $Curso_New->IdMateria=0;
        $Curso_New->IdProfesor=0;
        $Curso_New->FechaInicioInscripcion="";
        $Curso_New->FechaFinInscripcion="";
        $Curso_New->FechaFin="";
        $materias = $this->General_model->getMateria(0);
        $Profesors =$this->General_model->getProfesor(0);
        if($idCurso == 0)
        {
            $Curso =  $Curso_New;
        } else{
            
            $Curso =  $this->General_model->getCurso($idCurso);
        }

         $ListaMaterias = array('' => 'Seleccione ...');
         $ListaProfesors = array('' => 'Seleccione ...');
         if($materias != null)
         {
            foreach ($materias as $materia) {
                $ListaMaterias[$materia->IdMateria] = $materia->Nombre;
            }
         }
         if($Profesors != null)
         {
            foreach ($Profesors as $Profesor) {
                $ListaProfesors[$Profesor->IdProfesor] = $Profesor->Nombre;
            }
         }
         ksort($ListaMaterias);
         ksort($ListaProfesors);

         $datos['Cursoes'] = $Curso; 
        $datos['ListaMaterias'] = $ListaMaterias;
        $datos['ListaProfesors'] = $ListaProfesors;
        $data["content"] = $this->load->view("Curso/Curso-form", $datos, TRUE);
        $this->load->view("principal", $data);
    }

    public function saveCurso() {  
        $FechaInicioInscripcion =new DateTime(trim($this->input->post('FechaInicioInscripcion')));   
        $FechaFinInscripcion =new DateTime(trim($this->input->post('FechaFinInscripcion')));   
        $FechaFin =new DateTime(trim($this->input->post('FechaFin')));  

        $estado= $this->Curso_model->saveCurso((int) $this->input->post('IdProfesor'),(int) $this->input->post('IdMateria'),(int) $this->input->post('Anio'),
        $FechaInicioInscripcion, $FechaFinInscripcion,$FechaFin,(int) $this->input->post('IdCurso')); 
         if($estado =="")
         {
            $this->session->set_flashdata('mensaje', '<div class="alert alert-success">La Operacion se Realiza con Éxito.</div>');
            $mensaje_log.=" Guardado Exitosamente"; 
         } else
         {
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">No se pudo ralizar tal Operción.. ('.$estado.').</div>');
            $mensaje_log.=$estado;
         }
        Fechautil::actividad('Curso:' . $mensaje_log . "|" . serialize($_POST));
        redirect('Curso');
    }

    public function eliminarCurso($idCurso=0) {
        $exito = $this->General_model->eliminarTabla('curso','IdCurso',$idCurso);
        if ($exito) {
            $this->session->set_flashdata('mensaje', '<div class="alert alert-success">El Curso se Elimino Correctamente <b></b></div>');
        }
        else
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">Ocurrio un error al intenar eliminar el Curso</div>');
        redirect('Curso');
    }
    

    public function CursoPDF()
    {
        $fecha = date('Y-m-d');
        $this->load->library('pdf');
        $this->load->library('numeroletra');
        ob_clean();
        $pdf = new Pdf('L', 'mm', 'A3', true, 'UTF-8', false);
         $this->load->model('Curso_model');

        $Cursos = $this->Curso_model->listCursoBy(NULL, NULL);
        foreach ($Cursos as $Curso) {
            $Curso->IdMateria= $this->General_model->getMateria($Curso->IdMateria);
            $Curso->IdProfesor= $this->General_model->getProfesor($Curso->IdProfesor);
           }
        $datos['Curso'] = $Cursos;
        $vista  = $this->load->view("Curso/CursoListPDF", $datos, TRUE);
        $pdf->AddPage();
        $pdf->writeHTML($vista, true, 0, true, 0, true, 'L');
        $pdf->Output('Curso_'.$fecha .'.pdf', 'I');
    }
    

}

