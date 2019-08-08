<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Materia extends CI_Controller {
    
 
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
        $this->load->model('Materia_model');
        $this->load->model('General_model');
        $this->id_usuario = $this->session->userdata('id_usuario');

    }

    public function index() {
        $buscado = '';
        if ($this->input->post('buscado')) {
            $buscado = trim($this->input->post('buscado'));
            Fechautil::actividad('Materia: buscar Materia con patron ' . $buscado);
        }
        $dato['buscado'] = $buscado;
        $Materias = $this->Materia_model->listMateriaBy($buscado, 'Materia');
        $dato['Materia'] = $Materias;
         $data["content"] = $this->load->view("Materia/Materia-list", $dato, TRUE);
        $this->load->view("principal", $data);
   }

    public function agregarMateria($idMateria=0) {
        $Materia_New = new stdClass;
        $Materia_New->IdMateria=0;
        $Materia_New->Nombre="";
        $Materia_New->DuracionMeses="";
        $Materia_New->Regimen="";
        $Materia_New->CantidadParcial="";

        if($idMateria == 0)
        {
            $materia =  $Materia_New;
        } else{
            
            $materia =  $this->General_model->getMateria($idMateria);
        }
         $datos['Materiaes'] = $materia; 
        $data["content"] = $this->load->view("Materia/Materia-form", $datos, TRUE);
        $this->load->view("principal", $data);
    }

    public function saveMateria() {
        $IdMateria = (int) $this->input->post('IdMateria');        
        $estado= $this->Materia_model->saveMateria(trim($this->input->post('nombre')), (int) $this->input->post('DuracionMeses'),trim($this->input->post('Regimen')),
        (int) $this->input->post('CantidadParcial'),(int) $this->input->post('IdMateria')); 
         if($estado =="")
         {
            $this->session->set_flashdata('mensaje', '<div class="alert alert-success">La Operacion se Realiza con Éxito.</div>');
            $mensaje_log.=" Guardado Exitosamente"; 
         } else
         {
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">No se pudo ralizar tal Operción.. ('.$estado.').</div>');
            $mensaje_log.=$estado;
         }
        Fechautil::actividad('Materia:' . $mensaje_log . "|" . serialize($_POST));
        redirect('Materia');
    }

    public function eliminarMateria($idMateria=0) {
        $exito = $this->General_model->eliminarTabla('materia','IdMateria',$idMateria);
        if ($exito) {
           /// Fechautil::actividad('Cliente: Persona ' . $idpersona . " eliminada");
            $this->session->set_flashdata('mensaje', '<div class="alert alert-success">El Materia se Elimino Correctamente <b></b></div>');
        }
        else
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">Ocurrio un error al intenar eliminar el Materia</div>');
        redirect('Materia');
    }
    public function getAjaxMateriaCarrera() {
        $idmateria = (int) $this->input->post('idMateria');
        $datos = array();      
        $this->General_model->ActualizarMateriaCarrera($idmateria);
        $carrera = $this->General_model->getMateriaCarrera($idmateria);     
        foreach ($carrera as $carreras) {
            $carreras->IdCarrera= $this->General_model->getCarrera($carreras->IdCarrera);
             
          }  
        $datos["carrera"] = $carrera;
        $datos["IdMateria"] = $idmateria;
       // $data["content"] = $this->load->view("Materia/Materia-carrera", $datos, TRUE);
        $this->load->view("Materia/Materia-carrera", $datos);
    }
    public function SaveGuardarMateriaCarrera()
    {
        $idMateria=$this->input->post('IdMateria');
        $this->General_model->CheckedMateria(0,$idMateria);
        $tags = $this->input->post('check_list');
            foreach ($tags as $t) {
                $this->General_model->CheckedMateria((int) $t,$idMateria);
            }
            redirect('Materia');
    }
    public function MateriaPDF()
    {
        $fecha = date('Y-m-d');
        $this->load->library('pdf');
        $this->load->library('numeroletra');
        ob_clean();
        $pdf = new Pdf('L', 'mm', 'A3', true, 'UTF-8', false);
         $this->load->model('Materia_model');

        $Materias = $this->Materia_model->listMateriaBy(NULL, NULL);
        $datos['Materia'] = $Materias;
        $vista  = $this->load->view("Materia/MateriaListPDF", $datos, TRUE);
        $pdf->AddPage();
        $pdf->writeHTML($vista, true, 0, true, 0, true, 'L');
        $pdf->Output('Materia_'.$fecha .'.pdf', 'I');
    }
}

