<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mesa extends CI_Controller {
    
 
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
        $this->load->model('Mesa_model');
        $this->load->model('General_model');
        $this->id_usuario = $this->session->userdata('id_usuario');

    }

    public function index() {
        $buscado = '';
        if ($this->input->post('buscado')) {
            $buscado = trim($this->input->post('buscado'));
            Fechautil::actividad('Mesa: buscar Persona con patron ' . $buscado);
        }
        $dato['buscado'] = $buscado;
        $Mesas = $this->Mesa_model->listMesaBy($buscado, 'Mesa');
        foreach ($Mesas as $Mesa) {
                $Mesa->IdProfesor= $this->General_model->getProfesor($Mesa->IdProfesor);
                $Mesa->IdProfesor1= $this->General_model->getProfesor($Mesa->IdProfesor1);
                $Mesa->IdProfesor2= $this->General_model->getProfesor($Mesa->IdProfesor2);
                $Mesa->IdMateria= $this->General_model->getMateria($Mesa->IdMateria);
                $Mesa->IdCarrera= $this->General_model->getCarrera($Mesa->IdCarrera);
                $Mesa->FechaMesa= date('d-m-Y',strtotime($Mesa->FechaMesa));
                $Mesa->FechaInicioHabil= date('d-m-Y',strtotime($Mesa->FechaInicioHabil));
                $Mesa->FechaFinHabil= date('d-m-Y',strtotime($Mesa->FechaFinHabil));
        }
        $dato['Mesa'] = $Mesas;
         $data["content"] = $this->load->view("Mesa/Mesa-list", $dato, TRUE); 
        $this->load->view("principal", $data);
   }

    public function agregarMesa($idMesa=0) {
        $Mesa_New = new stdClass;
        $Mesa_New->IdMesa=0;
        $Mesa_New->FechaMesa="";
        $Mesa_New->NumeroLibro="";
        $Mesa_New->Follio="";
        $Mesa_New->IdProfesor="";
        $Mesa_New->IdProfesor1="";
        $Mesa_New->IdProfesor2="";
        $Mesa_New->FechaInicioHabil="";
        $Mesa_New->FechaFinHabil="";
        $Mesa_New->IdCarrera=0;
        $Mesa_New->IdMateria=0;

        $profesor = $this->General_model->getProfesor(0);
        $profesor1 = $this->General_model->getProfesor(0);
        $profesor2 = $this->General_model->getProfesor(0);
        $carreras =$this->General_model->getCarrera(0);
        $materias= $this->General_model->getMateria(0);

        if($idMesa == 0)
        {
            $Mesa =  $Mesa_New;
        } else{
            
            $Mesa =  $this->General_model->getMesa($idMesa);
        }

         $ListaProfesor = array('' => 'Seleccione ...');
         $ListaProfesor1 = array('' => 'Seleccione ...');
         $ListaProfesor2 = array('' => 'Seleccione ...');
         $ListaCarreras = array('' => 'Seleccione ...');
         $ListaMaterias = array('' => 'Seleccione ...');

         if($profesor != null)
         {
            foreach ($profesor as $profesors) {
                $ListaProfesor[$profesors->IdProfesor] = $profesors->Nombre;
            }
         }
         if($profesor1 != null)
         {
            foreach ($profesor1 as $profesors1) {
              //  $ListaProfesor1[$profesors1->IdProfesor] = $profesors1->Nombre."-".$profesor1->Apellido;
              $ListaProfesor1[$profesors1->IdProfesor] = $profesors1->Nombre;
            }
         }
         if($profesor2 != null)
         {
            foreach ($profesor2 as $profesors2) {
                $ListaProfesor2[$profesors2->IdProfesor] = $profesors2->Nombre;
            }
         }

         if($carreras != null)
         {
            foreach ($carreras as $carrera) {
                $ListaCarreras[$carrera->IdCarrera] = $carrera->Nombre;
            }
         }
         if($materias != null)
         {
            foreach ($materias as $materia) {
                $ListaMaterias[$materia->IdMateria] = $materia->Nombre;
            }
         }
         ksort($ListaProfesor);
         ksort($ListaProfesor1);
         ksort($ListaProfesor2);
         ksort($ListaCarreras);
         ksort($ListaMaterias);

         $datos['Mesaes'] = $Mesa; 
        $datos['ListaProfesor'] = $ListaProfesor;
        $datos['ListaProfesor1'] = $ListaProfesor1;
        $datos['ListaProfesor2'] = $ListaProfesor2;
        $datos['ListaCarreras'] = $ListaCarreras;
        $datos['ListaMaterias'] = $ListaMaterias;
        $data["content"] = $this->load->view("Mesa/Mesa-form", $datos, TRUE);
        $this->load->view("principal", $data);
    }

    public function saveMesa() {   
        $estado= $this->Mesa_model->saveMesa(trim($this->input->post('FechaMesa')), trim($this->input->post('NumeroLibro')), trim($this->input->post('Follio')),
        (int) $this->input->post('IdProfesor'),(int) $this->input->post('IdProfesor1'),(int) $this->input->post('IdProfesor2'),trim($this->input->post('FechaInicioHabil'))
        ,trim($this->input->post('FechaFinHabil')), (int) $this->input->post('IdCarrera'),(int) $this->input->post('IdMateria'),
        (int) $this->input->post('IdMesa')); 
         if($estado =="")
         {
            $this->session->set_flashdata('mensaje', '<div class="alert alert-success">La Operacion se Realiza con Éxito.</div>');
            $mensaje_log.=" Guardado Exitosamente"; 
         } else
         {
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">No se pudo ralizar tal Operción.. ('.$estado.').</div>');
            $mensaje_log.=$estado;
         }
        Fechautil::actividad('Mesa:' . $mensaje_log . "|" . serialize($_POST));
        redirect('Mesa');
    }

    public function eliminarMesa($idMesa=0) {
        $exito = $this->General_model->eliminarTabla('mesa','IdMesa',$idMesa);
        if ($exito) {
            $this->session->set_flashdata('mensaje', '<div class="alert alert-success">El Mesa se Elimino Correctamente <b></b></div>');
        }
        else
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">Ocurrio un error al intenar eliminar el Mesa</div>');
        redirect('Mesa');
    }
    

    public function MesaPDF()
    {
        $fecha = date('Y-m-d');
        $this->load->library('pdf');
        $this->load->library('numeroletra');
        ob_clean();
        $pdf = new Pdf('L', 'mm', 'A3', true, 'UTF-8', false);
         $this->load->model('Mesa_model');

        $Mesas = $this->Mesa_model->listMesaBy(NULL, NULL);
        foreach ($Mesas as $Mesa) {
            $Mesa->IdProfesor= $this->General_model->getProfesor($Mesa->IdProfesor);
                $Mesa->IdProfesor1= $this->General_model->getProfesor($Mesa->IdProfesor1);
                $Mesa->IdProfesor2= $this->General_model->getProfesor($Mesa->IdProfesor2);
                $Mesa->IdMateria= $this->General_model->getMateria($Mesa->IdMateria);
                $Mesa->IdCarrera= $this->General_model->getCarrera($Mesa->IdCarrera);
           }
        $datos['Mesa'] = $Mesas;
        $vista  = $this->load->view("Mesa/MesaListPDF", $datos, TRUE);
        $pdf->AddPage();
        $pdf->writeHTML($vista, true, 0, true, 0, true, 'L');
        $pdf->Output('Mesa_'.$fecha .'.pdf', 'I');
    }
    

}

