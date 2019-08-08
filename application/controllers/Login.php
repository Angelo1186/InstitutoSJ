<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Login extends CI_Controller {

    public function __Construct() {
        parent::__Construct();
        $this->load->model('login_model');
        $this->load->library('control_permisos');
    }

    private function ajax_checking() {
        if (!$this->input->is_ajax_request()) {
            redirect(base_url());
        }
    }

    public function index() {

        if ($this->session->userdata('id_usuario')) {
            redirect('Profesor/index');
        } else {
            $this->load->view('login');
        }
    }

    public function autenticar() {
        $postData = $this->input->post();
        $query = $this->login_model->autenticar_login($postData);
        if ($query['status'] == 'success') {
            $data = array(
                'id_usuario' => $query['id_usuario'],
                'usuario' => $query['usuario'],
                'id_grupo' => $query['id_grupo'],
                'nombre' => $query['nombre'],
                'grupo' => $query['grupo'],
                'logged_in' => TRUE,
                'dialogo'=>1
            );
            $this->session->set_userdata($data);
            Fechautil::actividad('Inicio Session');
            redirect('inicio/index');
        } else {
            redirect('login');
        }
    }

    public function logout() {
        Fechautil::actividad('Finaliza Session');
        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function listactividad() {
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
        $dato['actividades'] = $this->db->query("SELECT usuario,actividad,url,date_format(fecha_hora,'%d-%m-%Y %H:%i:%s') as fecha FROM actividad LEFT JOIN usuarios ON actividad.id_usuario=usuarios.id_usuario ORDER BY fecha_hora DESC")->result();
        $data['content'] = $this->load->view('listactividad', $dato, TRUE);
        $this->load->view("principal", $data);
    }

}