<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Correlatividad extends CI_Controller {
    
 
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
        $this->load->model('Correlatividad_model');
        $this->load->model('General_model');
        $this->id_usuario = $this->session->userdata('id_usuario');

    }

    public function index() {
        $buscado = '';
        if ($this->input->post('buscado')) {
            $buscado = trim($this->input->post('buscado'));
            Fechautil::actividad('Correlatividad: buscar Persona con patron ' . $buscado);
        }
        $dato['buscado'] = $buscado;
        $Correlatividads = $this->Correlatividad_model->listCorrelatividadBy($buscado, 'Correlatividad');
        foreach ($Correlatividads as $Correlatividad) {
                $Correlatividad->IdCarrera= $this->General_model->getCarrera($Correlatividad->IdCarrera);
                $Correlatividad->IdMateria= $this->General_model->getMateria($Correlatividad->IdMateria);
                $Correlatividad->IdMateriaCorrelativa= $this->General_model->getMateria($Correlatividad->IdMateriaCorrelativa);
        }
        $dato['Correlatividad'] = $Correlatividads;
         $data["content"] = $this->load->view("Correlatividad/Correlatividad-list", $dato, TRUE); 
        $this->load->view("principal", $data);
   }


    public function agregarCorrelatividad($idCorrelatividad=0) {
        $Correlatividad_New = new stdClass;
        $Correlatividad_New->IdCorrelatividad=0;
        $Correlatividad_New->IdCarrera=0;
        $Correlatividad_New->IdMateria=0;
        $Correlatividad_New->IdMateriaCorrelativa=0;

        $carreras = $this->General_model->getCarrera(0);
  //      $materias =$this->General_model->getMateria(0);
  //      $materiasCorrelativas =$this->General_model->getMateria(0);

        $ListaCarrera = array('' => 'Seleccione ...');
        $ListaMateria= array('' => 'Seleccione ...');
        $ListaMateriaCorrelatividad = array('' => 'Seleccione ...');


        if($idCorrelatividad == 0)
        {
            $Correlatividad =  $Correlatividad_New;
        } else{
              $Correlatividad =  $this->General_model->getCorrelatividad($idCorrelatividad);
              $idcarrera= $Correlatividad->IdCarrera;
              $materias =$this->General_model->GetCorrelativa($idcarrera);
              $materiasCorrelativas =$this->General_model->GetCorrelativa($idcarrera);
                        if($materias != null)
                    {
                        foreach ($materias as $materia) {
                            $ListaMateria[$materia->IdMateria] = $materia->Nombre;
                        }
                    }
                    if($materiasCorrelativas != null)
                    {
                        foreach ($materiasCorrelativas as $materiasCorrelativa) {
                            $ListaMateriaCorrelatividad[$materiasCorrelativa->IdMateria] = $materiasCorrelativa->Nombre;
                        }
                    } 
        }

        
         if($carreras != null)
         {
            foreach ($carreras as $carrera) {
                $ListaCarrera[$carrera->IdCarrera] = $carrera->Nombre;
            }
         }
         ksort($ListaCarrera);
         ksort($ListaMateria);
         ksort($ListaMateriaCorrelatividad);
         $datos['Correlatividades'] = $Correlatividad; 
        $datos['ListaCarrera'] = $ListaCarrera;
        $datos['ListaMateria'] = $ListaMateria;
        $datos['ListaMateriaCorrelatividad'] = $ListaMateriaCorrelatividad;
        $data["content"] = $this->load->view("Correlatividad/Correlatividad-form", $datos, TRUE);
        $this->load->view("principal", $data);
    }

    public function saveCorrelatividad() {       
        $estado= $this->Correlatividad_model->saveCorrelatividad((int) $this->input->post('IdCarrera'),(int) $this->input->post('IdMateria'),
        (int) $this->input->post('IdMateriaCorrelativa'),(int) $this->input->post('IdCorrelatividad')); 
         if($estado =="")
         {
            $this->session->set_flashdata('mensaje', '<div class="alert alert-success">La Operacion se Realiza con Éxito.</div>');
            $mensaje_log.=" Guardado Exitosamente"; 
         } else
         {
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">No se pudo ralizar tal Operción.. ('.$estado.').</div>');
            $mensaje_log.=$estado;
         }
        Fechautil::actividad('Correlatividad:' . $mensaje_log . "|" . serialize($_POST));
        redirect('Correlatividad');
    }

    public function eliminarCorrelatividad($idCorrelatividad=0) {
        $exito = $this->General_model->eliminarTabla('correlatividad','IdCorrelatividad',$idCorrelatividad);
        if ($exito) {
            $this->session->set_flashdata('mensaje', '<div class="alert alert-success">El Correlatividad se Elimino Correctamente <b></b></div>');
        }
        else
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">Ocurrio un error al intenar eliminar el Correlatividad</div>');
        redirect('Correlatividad');
    }
    
    public function getMaterias() {
        $idCarrera = (int) $this->input->post('idCarrera'); 
        $listaMateria = $this->General_model->GetCorrelativa($idCarrera);
        $select = '';
        foreach ($listaMateria as $ma) {
                $select.='<option value="' . $ma->IdMateria . '">' . $ma->Nombre . '</option>';
        }
        $datos["select"] = $select;
        echo json_encode($datos);
    }

    public function CorrelatividadPDF()
    {
        $fecha = date('Y-m-d');
        $this->load->library('pdf');
        $this->load->library('numeroletra');
        ob_clean();
        $pdf = new Pdf('L', 'mm', 'A3', true, 'UTF-8', false);
         $this->load->model('Correlatividad_model');

        $Correlatividads = $this->Correlatividad_model->listCorrelatividadBy(NULL, NULL);
        foreach ($Correlatividads as $Correlatividad) {
            $Correlatividad->IdCarrera= $this->General_model->getCarrera($Correlatividad->IdCarrera);
            $Correlatividad->IdMateria= $this->General_model->getMateria($Correlatividad->IdMateria);
            $Correlatividad->IdMateriaCorrelativa= $this->General_model->getMateria($Correlatividad->IdMateriaCorrelativa);
           }
        $datos['Correlatividad'] = $Correlatividads;
        $vista  = $this->load->view("Correlatividad/CorrelatividadListPDF", $datos, TRUE);
        $pdf->AddPage();
        $pdf->writeHTML($vista, true, 0, true, 0, true, 'L');
        $pdf->Output('Correlatividad_'.$fecha .'.pdf', 'I');
    }
    

}

