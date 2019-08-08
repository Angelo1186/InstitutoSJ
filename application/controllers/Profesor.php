<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profesor extends CI_Controller {
    
 
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
        $this->load->model('Profesor_model');
        $this->load->model('General_model');
        $this->id_usuario = $this->session->userdata('id_usuario');

    }

    public function index() {
        $buscado = '';
        if ($this->input->post('buscado')) {
            $buscado = trim($this->input->post('buscado'));
            Fechautil::actividad('Profesor: buscar Persona con patron ' . $buscado);
        }
        $dato['buscado'] = $buscado;
        $Profesors = $this->Profesor_model->listProfesorBy($buscado, 'Profesor');
        foreach ($Profesors as $profesor) {
                $profesor->IdBarrio= $this->General_model->getBarrio($profesor->IdBarrio);
        }
        $dato['profesor'] = $Profesors;
         $data["content"] = $this->load->view("Profesor/Profesor-list", $dato, TRUE);
        $this->load->view("principal", $data);
   }

  /*  public function verCliente($idpersona=0, $vista='cliente') {
        $cliente = $this->personas_model->getPersona($idpersona);
        if (!isset($cliente->id_persona)) {
            Fechautil::actividad('Cliente: no existe Persona ' . $idpersona);
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">No existe el recurso solicitado</div>');
            redirect('clientes');
        }
        $this->load->model('contratos_model');
        Fechautil::actividad('Cliente: Persona ' . $idpersona . " ingresa a ver detalle");
        $vista = $vista == 'cliente' ? 'clientes' : 'clientes/listDeudores';
        $dato['url'] = $vista;
        $dato['cliente'] = $cliente;
        $dato['domicilio'] = $this->personas_model->getDomicilio($cliente->id_domicilio);
        $dato['telefono'] = $this->personas_model->getTelefono($cliente->id_telefono);
        $dato['contratos'] = $this->contratos_model->listContratosDePersona($cliente->id_persona);
        $data["content"] = $this->load->view("cliente/cliente-detalle", $dato, TRUE);
        $this->load->view("principal", $data);
    }

    public function updateCliente() {
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('apellido', 'Apellido', 'trim|required');
        $this->form_validation->set_rules('direccion', 'Direccion', 'trim|required');
        $this->form_validation->set_rules('cuil', 'CUIL', 'trim|required');
        $idpersona = (int) $this->input->post('idpersona');
        if ($this->form_validation->run() == FALSE) {
            Fechautil::actividad('Cliente: no completo los campos obligatorios para la Persona ' . $idpersona . '|' . serialize($_POST));
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">No se puedo actualizar los datos del Cliente.' . validation_errors() . '</div>');
            redirect('clientes/agregarCliente');
        }
        $fechacarga = Date('Y-m-d H:i:s');
        $direccion = trim($this->input->post('direccion'));
        $ciudad = trim($this->input->post('ciudad'));
        $provincia = trim($this->input->post('provincia'));
        $mensaje_log = '';
        $iddomicilio = $this->personas_model->saveDomicilio($direccion, $ciudad, $provincia, $this->id_usuario, $fechacarga);
        $telefono = trim($this->input->post('telefono'));
        $idtelefono = $this->personas_model->saveTelefono($telefono, $this->id_usuario, $fechacarga);
        $apellido = trim($this->input->post('apellido'));
        $nombre = trim($this->input->post('nombre'));
        $cuil = trim($this->input->post('cuil'));
        $email = trim($this->input->post('email'));
        $regimen_impositivo = trim($this->input->post('iva'));
        $exito = $this->personas_model->updatePersona($nombre, $apellido, null, $cuil, $email, $regimen_impositivo, $iddomicilio, $idtelefono, NULL, $idpersona);
        if ($exito) {
            $this->session->set_flashdata('mensaje', '<div class="alert alert-success">Se actulizaron los datos correctamente.</div>');
            $mensaje_log.=' Actualiza Datos Personales::Telefono ' . $idtelefono . " Nuevo:: Domicilio " . $iddomicilio . " Nuevo";
        } else {
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">Ocurrio un error al intentar actualizar los datos del Cliente.</div>');
            $mensaje_log.=" error al intentar actualizar los datos";
        }
        Fechautil::actividad('Cliente: Persona ' . $idpersona . ' ' . $mensaje_log . "|" . serialize($_POST));
        redirect('clientes');
    } */

    public function agregarProfesor($idProfesor=0) {
        $Profesor_New = new stdClass;
        $Profesor_New->IdProfesor=0;
        $Profesor_New->Legajo="";
        $Profesor_New->Nombre="";
        $Profesor_New->Apellido="";
        $Profesor_New->Dni="";
        $Profesor_New->Telefono="";
        $Profesor_New->Domicilio="";
        $Profesor_New->Email="";
        $Profesor_New->IdBarrio=0;

        $barrios = $this->General_model->getBarrio(0);
        if($idProfesor == 0)
        {
            $profes =  $Profesor_New;
        } else{
            
            $profes =  $this->General_model->getProfesor($idProfesor);
        }
         $ListaBarrios = array(0 => 'Seleccione ...');
         if($barrios != null)
         {
            foreach ($barrios as $barrio) {
                $ListaBarrios[$barrio->IdBarrio] = $barrio->Nombre;
            }
         }
         ksort($ListaBarrios);
         $datos['Profesores'] = $profes; 
        $datos['ListaBarrio'] = $ListaBarrios;
        $data["content"] = $this->load->view("Profesor/Profesor-form", $datos, TRUE);
        $this->load->view("principal", $data);
    }
    public function enviarCorreo($email,$usuario,$clave){
    
         $this->load->library('email');
       /*   $config['protocol'] = 'smtp';
          $config["smtp_host"] = 'smtp.gmail.com';
          $config["smtp_user"] = 'correo@gmail.com';
          $config["smtp_pass"] = 'contraseña';   
          $config["smtp_port"] = '587';
          $config['charset'] = 'utf-8';
          $config['wordwrap'] = TRUE;
          $config['mailtype'] = 'html';
         $config['validate'] = true;
          $this->email->initialize($config);*/
          $this->email->from('angelotc@gmail.com', 'Angel cruz');
          $this->email->to($email, 'Angelo Thiago');
          $this->email->subject('Configuración de Credenciales');
          $this->email->message('Hola!! Ahi estan las credencailes usuario: '.$usuario.'   passrod:'.$clave);
          if($this->email->send()){
              $this->session->set_flashdata('envio', 'Email enviado correctamente');
              return true;
          }else{
              $this->session->set_flashdata('envio', 'No se a enviado el email');
              return false;
          }
        
     }   
  

    public function saveProfesor() {
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('apellido', 'Apellido', 'trim|required');
        $this->form_validation->set_rules('Domicilio', 'Direccion', 'trim|required');
        $this->form_validation->set_rules('Dni', 'DNI', 'trim|required');
        $IdProfesor = (int) $this->input->post('IdProfesor');

        if ($this->form_validation->run() == FALSE) {
            Fechautil::actividad('Profesor: no completo los campos obligatorios para el Profesor|' . serialize($_POST));
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">No se puedo guardar los datos del Profesor.' . validation_errors() . '</div>');
            redirect('Profesor/agregarProfesor');
        }
        
        $estado= $this->Profesor_model->saveProfesor(trim($this->input->post('legajo')), trim($this->input->post('nombre')), trim($this->input->post('apellido')),
        (int) $this->input->post('Dni'),(int) $this->input->post('Telefono'),(int) $this->input->post('IdBarrio'),trim($this->input->post('Domicilio')),
        trim($this->input->post('Email')), (int) $this->input->post('IdProfesor')); 
         if($estado !=0)
         {
             $profe= $this->General_model->getProfesor($estado);
           $usuario=$this->General_model->getUsuario($profe->IdUsuario);
          if($this->enviarCorreo($usuario->email,$usuario->usuario,$usuario->clave)){
            $this->session->set_flashdata('mensaje', '<div class="alert alert-success">La Operacion se Realiza con Éxito. Pero el E-Mail No fue enviado, por favor corregir su correo o volver a Intenter </div>');
            $mensaje_log.=" Guardado Exitosamente"; 
          } else{
            $this->session->set_flashdata('mensaje', '<div class="alert alert-success">La Operacion se Realiza con Éxito.</div>');
            $mensaje_log.=" Guardado Exitosamente"; 
          }
         } else
         {
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">No se pudo ralizar tal Operción.. ('.$estado.').</div>');
            $mensaje_log.=$estado;
         }
        Fechautil::actividad('Profesor:' . $mensaje_log . "|" . serialize($_POST));
        redirect('Profesor');
    }

    public function eliminarProfesor($idProfesor=0) {
        $exito = $this->General_model->eliminarTabla('profesor','IdProfesor',$idProfesor);
        if ($exito) {
           /// Fechautil::actividad('Cliente: Persona ' . $idpersona . " eliminada");
            $this->session->set_flashdata('mensaje', '<div class="alert alert-success">El Profesor se Elimino Correctamente <b></b></div>');
        }
        else
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">Ocurrio un error al intenar eliminar el Profesor</div>');
        redirect('Profesor');
    }

    public function ProfesorPDF()
    {
        $fecha = date('Y-m-d');
        $this->load->library('pdf');
        $this->load->library('numeroletra');
        ob_clean();
        $pdf = new Pdf('L', 'mm', 'A3', true, 'UTF-8', false);
         $this->load->model('Profesor_model');

        $profesors = $this->Profesor_model->listProfesorBy(NULL, NULL);
        foreach ($profesors as $profesor) {
                $profesor->IdBarrio= $this->General_model->getBarrio($profesor->IdBarrio);
           }
        $datos['profesor'] = $profesors;
        $vista  = $this->load->view("Profesor/ProfesorListPDF", $datos, TRUE);
        $pdf->AddPage();
        $pdf->writeHTML($vista, true, 0, true, 0, true, 'L');
        $pdf->Output('Profesor_'.$fecha .'.pdf', 'I');
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

