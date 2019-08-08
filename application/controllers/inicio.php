<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class inicio extends CI_Controller {
    
 
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
        $this->id_usuario = $this->session->userdata('id_usuario');

    }

    public function index() {
       //  $data["content"] = $this->load->view("inicio");
       $data["content"] = " ";
        $this->load->view("principal", $data);
   }
}
?>