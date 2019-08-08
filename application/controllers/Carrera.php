<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Carrera extends CI_Controller {
    
 
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
        $this->load->model('Carrera_model');
        $this->load->model('General_model');
        $this->id_usuario = $this->session->userdata('id_usuario');

    }

    public function index() {
        $buscado = '';
        if ($this->input->post('buscado')) {
            $buscado = trim($this->input->post('buscado'));
            Fechautil::actividad('Carrera: buscar Carrera con patron ' . $buscado);
        }
        $dato['buscado'] = $buscado;
        $Carreras = $this->Carrera_model->listCarreraBy($buscado, 'Carrera');
        $dato['Carrera'] = $Carreras;
         $data["content"] = $this->load->view("Carrera/Carrera-list", $dato, TRUE);
        $this->load->view("principal", $data);
   }

    public function agregarCarrera($idCarrera=0) {
        $Carrera_New = new stdClass;
        $Carrera_New->IdCarrera=0;
        $Carrera_New->Nombre="";
        $Carrera_New->DuracionAnio="";

        if($idCarrera == 0)
        {
            $Carrera =  $Carrera_New;
        } else{
            
            $Carrera =  $this->General_model->getCarrera($idCarrera);
        }
         $datos['Carreraes'] = $Carrera; 
        $data["content"] = $this->load->view("Carrera/Carrera-form", $datos, TRUE);
        $this->load->view("principal", $data);
    }

    public function saveCarrera() {
        $IdCarrera = (int) $this->input->post('IdCarrera');        
        $estado= $this->Carrera_model->saveCarrera(trim($this->input->post('nombre')), (int) $this->input->post('DuracionAnio'),(int) $this->input->post('IdCarrera')); 
         if($estado =="")
         {
            $this->session->set_flashdata('mensaje', '<div class="alert alert-success">La Operacion se Realiza con Éxito.</div>');
            $mensaje_log.=" Guardado Exitosamente"; 
         } else
         {
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">No se pudo ralizar tal Operción.. ('.$estado.').</div>');
            $mensaje_log.=$estado;
         }
        Fechautil::actividad('Carrera:' . $mensaje_log . "|" . serialize($_POST));
        redirect('Carrera');
    }

    public function eliminarCarrera($idCarrera=0) {
        $exito = $this->General_model->eliminarTabla('carrera','IdCarrera',$idCarrera);
        if ($exito) {
           /// Fechautil::actividad('Cliente: Persona ' . $idpersona . " eliminada");
            $this->session->set_flashdata('mensaje', '<div class="alert alert-success">El Carrera se Elimino Correctamente <b></b></div>');
        }
        else
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">Ocurrio un error al intenar eliminar el Carrera</div>');
        redirect('Carrera');
    }

    public function CarreraPDF()
    {
        $fecha = date('Y-m-d');
        $this->load->library('pdf');
        $this->load->library('numeroletra');
        ob_clean();
        $pdf = new Pdf('L', 'mm', 'A3', true, 'UTF-8', false);
         $this->load->model('Carrera_model');

        $Carreras = $this->Carrera_model->listCarreraBy(NULL, NULL);
        $datos['Carrera'] = $Carreras;
        $vista  = $this->load->view("Carrera/CarreraListPDF", $datos, TRUE);
        $pdf->AddPage();
        $pdf->writeHTML($vista, true, 0, true, 0, true, 'L');
        $pdf->Output('Carrera_'.$fecha .'.pdf', 'I');
    }

   /* public function listDeudores() {
        $this->load->model('contratos_model');
        $this->load->model('inmuebles_model');
        $contratos = $this->contratos_model->listContratosBy(NULL, NULL);
        $deudores = array();
        foreach ($contratos as $contrato) {
            $pago = $this->contratos_model->getUlitmoPagoByContrato($contrato->id_contrato);
            if (isset($pago->id_pago)) {
                if ($pago->periodo_texto < $contrato->fecha_fin) {
                  //  $ano = substr($fecha, -10, 4);
                    $mes = substr($pago->periodo_texto, -5, 2);
                  //  $dia = substr($fecha, -2, 2);
                    $diactual = Date('d');
                    $mesactual = Date('m');
                    $anioactual = Date('Y');
                    if ($mesactual != $mes) {
                        $contrato->id_inmueble = $this->inmuebles_model->getInmueble($contrato->id_inmueble);
                        $contrato->tipo_contrato = $pago;
                        $deudores[] = $contrato;
                        $personas = $this->contratos_model->listPersonaContratosBy($contrato->id_contrato);
                        foreach ($personas as $persona) {
                            if ($persona->tipo == 'Titular') {
                                $contrato->id_usuario = $this->personas_model->getPersona($persona->id_persona);
                            }
                        }
                    }
                }
            }
        }
        $dato['deudores'] = $deudores;
        $data["content"] = $this->load->view("cliente/cliente-deudor", $dato, TRUE);
        $this->load->view("principal", $data);
    }
        */
}

