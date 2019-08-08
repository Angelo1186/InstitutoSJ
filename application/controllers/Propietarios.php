<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Propietarios extends CI_Controller {

    var $vector_iva = array('Monotributo' => 'Monotributo', 'Responsable Inscripto' => 'Responsable Inscripto', 'Responsable NO Inscripto' => 'Responsable NO Inscripto', 'NO Responsable' => 'NO Responsable', 'Consumidor Final' => 'Consumidor Final', 'Sujeto NO Categorizado' => 'Sujeto NO Categorizado');
    var $id_usuario = 0;

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
        $this->load->model('personas_model');
        $this->id_usuario = $this->session->userdata('id_usuario');
    }

    public function index() {
        $buscado = '';
        if ($this->input->post('buscado')) {
            $buscado = trim($this->input->post('buscado'));
            Fechautil::actividad('Propietario: buscar Persona con patron ' . $buscado);
        }
        $dato['buscado'] = $buscado;
        $propietarios = $this->personas_model->listPersonasBy($buscado, 'Propietario');
        foreach ($propietarios as $propietario) {
            $propietario->id_domicilio = $this->personas_model->getDomicilio($propietario->id_domicilio);
            $propietario->id_telefono = $this->personas_model->getTelefono($propietario->id_telefono);
        }
        $dato['propietarios'] = $propietarios;
        $data["content"] = $this->load->view("propietario/propietario-list", $dato, TRUE);
        $this->load->view("principal", $data);
    }

    public function agregarPropietario() {
        $data["content"] = $this->load->view("propietario/propietario-form", '', TRUE);
        $this->load->view("principal", $data);
    }

    public function savePropietario() {
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('apellido', 'Apellido', 'trim|required');
        $this->form_validation->set_rules('direccion', 'Direccion', 'trim|required');        
        $this->form_validation->set_rules('cuil', 'CUIL', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            Fechautil::actividad('Propietario: no completo los campos obligatorios para el propietario|' . serialize($_POST));
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">No se puedo guardar los datos del Propietario.' . validation_errors() . '</div>');
            redirect('propietarios/agregarPropietario');
        }
        ///domicilio
        $fechacarga = Date('Y-m-d H:i:s');
        $direccion = trim($this->input->post('direccion'));
        $ciudad = trim($this->input->post('ciudad'));
        $provincia = trim($this->input->post('provincia'));
        $mensaje_log = '';
        $iddomicilio = $this->personas_model->saveDomicilio($direccion, $ciudad, $provincia, $this->id_usuario, $fechacarga);
        if ($iddomicilio > 0) {
            //telefono
            $telefono = trim($this->input->post('telefono'));
            $celular = trim($this->input->post('celular'));
            $idtelefono = 0;           
            $idtelefono = $this->personas_model->saveTelefono($telefono . "@" . $celular, $this->id_usuario, $fechacarga);
            $apellido = trim($this->input->post('apellido'));
            $nombre = trim($this->input->post('nombre'));
            $cuil = trim($this->input->post('cuil'));
            $email = trim($this->input->post('email'));
            $regimen_impositivo = trim($this->input->post('iva'));
            $sigla = trim($this->input->post('sigla'));
            $idpersona = $this->personas_model->savePersona($nombre, $apellido, '', $cuil, $email, $regimen_impositivo, $iddomicilio, $idtelefono, $this->id_usuario, $fechacarga, $sigla);
            if ($idpersona > 0) {
                $idpersonatipo = $this->personas_model->savePersonaTipo($idpersona, 'Propietario', $regimen_impositivo, Date('Y-m-d'), $this->id_usuario, $fechacarga);
                $this->session->set_flashdata('mensaje', '<div class="alert alert-success">Se guardaron los datos del Propietario.</div>');
                $mensaje_log.=" Persona " . $idpersona . " Nueva::Domicilio " . $iddomicilio . " Nuevo::Telefono " . $idtelefono . " Nuevo::Persona_Tipo " . $idpersonatipo . " Nuevo";
            } else {
                $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">No se puedo guardar los datos del Propietario.</div>');
                $mensaje_log.=' Error al intentar crear la Persona::Domicilio ' . $iddomicilio . " Nuevo";
            }
        } else {
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">Ocurrio un error al intentar guardar los datos del domicilio.</div>');
            $mensaje_log.=' Error al intentar crear el Domicilio';
        }
        Fechautil::actividad('Propietario:' . $mensaje_log . "|" . serialize($_POST));
        redirect('propietarios');
    }

    public function verPropietario($idpersona=0) {
        $propietario = $this->personas_model->getPersona($idpersona);
        if (!isset($propietario->id_persona)) {
            Fechautil::actividad('Propietario: no existe Persona ' . $idpersona);
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">No existe el recurso solicitado</div>');
            redirect('propietarios');
        }
        $this->load->model('contratos_model');
        $this->load->model('inmuebles_model');
        Fechautil::actividad('Propietario: Persona ' . $idpersona . " ingresa a ver detalle");
        $dato['propietario'] = $propietario;
        $dato['domicilio'] = $this->personas_model->getDomicilio($propietario->id_domicilio);
        $dato['telefono'] = $this->personas_model->getTelefono($propietario->id_telefono);
        $dato['contratos'] = $this->contratos_model->listContratosDePersona($propietario->id_persona);
        $dato['inmuebles'] = $this->inmuebles_model->listInmueblesByPropietario($propietario->id_persona);
        $data["content"] = $this->load->view("propietario/propietario-detalle", $dato, TRUE);
        $this->load->view("principal", $data);
    }

    public function editarPropietario($idpersona=0) {
        $propietario = $this->personas_model->getPersona($idpersona);
        if (!isset($propietario->id_persona)) {
            Fechautil::actividad('Propietario: no existe Persona ' . $idpersona);
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">No existe el recurso solicitado</div>');
            redirect('propietarios');
        }
        $dato['propietario'] = $propietario;
        $dato['domicilio'] = $this->personas_model->getDomicilio($propietario->id_domicilio);
        $dato['telefono'] = $this->personas_model->getTelefono($propietario->id_telefono);
        $data["content"] = $this->load->view("propietario/propietario-edit", $dato, TRUE);
        $this->load->view("principal", $data);
    }

    public function updatePropietario() {
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('apellido', 'Apellido', 'trim|required');
        $this->form_validation->set_rules('direccion', 'Direccion', 'trim|required');      
        $this->form_validation->set_rules('cuil', 'CUIL', 'trim|required');
        $idpersona = (int) $this->input->post('idpersona');
        if ($this->form_validation->run() == FALSE) {
            Fechautil::actividad('Propietario: no completo los campos obligatorios para la Persona ' . $idpersona . '|' . serialize($_POST));
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">No se puedo actualizar los datos del Propietario.' . validation_errors() . '</div>');
            redirect('propietarios/agregarPropietario');
        }
        $fechacarga = Date('Y-m-d H:i:s');
        $direccion = trim($this->input->post('direccion'));
        $ciudad = trim($this->input->post('ciudad'));
        $provincia = trim($this->input->post('provincia'));
        $mensaje_log = '';
        $iddomicilio = $this->personas_model->saveDomicilio($direccion, $ciudad, $provincia, $this->id_usuario, $fechacarga);
        $telefono = trim($this->input->post('telefono'));
        $celular = trim($this->input->post('celular'));
        $idtelefono = $this->personas_model->saveTelefono($telefono . "@" . $celular, $this->id_usuario, $fechacarga);
        $apellido = trim($this->input->post('apellido'));
        $nombre = trim($this->input->post('nombre'));
        $cuil = trim($this->input->post('cuil'));
        $email = trim($this->input->post('email'));
        $regimen_impositivo = trim($this->input->post('iva'));
        $sigla = trim($this->input->post('sigla'));
        $exito = $this->personas_model->updatePersona($nombre, $apellido, null, $cuil, $email, $regimen_impositivo, $iddomicilio, $idtelefono, $sigla, $idpersona);
        if ($exito) {
            $this->session->set_flashdata('mensaje', '<div class="alert alert-success">Se actulizaron los datos correctamente.</div>');
            $mensaje_log.=' Actualiza Datos Personales::Telefono ' . $idtelefono . " Nuevo:: Domicilio " . $iddomicilio . " Nuevo";
        } else {
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">Ocurrio un error al intentar actualizar los datos del Propietario.</div>');
            $mensaje_log.=" error al intentar actualizar los datos";
        }
        Fechautil::actividad('Propietario: Persona ' . $idpersona . ' ' . $mensaje_log . "|" . serialize($_POST));
        redirect('propietarios');
    }
    
     public function eliminarPropietario($idpersona=0) {
        $cliente = $this->personas_model->getPersona($idpersona);
        if (!isset($cliente->id_persona)) {
            Fechautil::actividad('Propietario: no existe Persona ' . $idpersona);
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">No existe el recurso solicitado</div>');
            redirect('propietarios');
        }
        $exito = $this->personas_model->eliminarPersona($cliente->id_persona);
        if ($exito) {
            Fechautil::actividad('Propietario: Persona ' . $idpersona . " eliminada");
            $this->session->set_flashdata('mensaje', '<div class="alert alert-success">Se elimino correctamente el Propietario <b>' . $cliente->apellido . '</b></div>');
        }
        else
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">Ocurrio un error al intenar eliminar el Propietario</div>');
        redirect('propietarios');
    }

}
