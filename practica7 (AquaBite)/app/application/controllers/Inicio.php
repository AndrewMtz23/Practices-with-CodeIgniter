<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

    public function index() {
        $this->inicio(); // Redirige al método inicio por defecto
    }

    public function inicio() {
        $this->load->view('inicio');
    }

    public function acerca() {
        $this->load->view('acerca');
    }

    public function login() {
        $this->load->view('login');
    }

    public function registro() {
        $this->load->view('registro');
    }

    public function cia() {
        $this->load->view('cia');
    }

    public function login_admin() {
        $this->load->view('login_admin');
    }

    public function home_admin() {
        $this->load->view('home_admin');
    }
}

class AdminController extends CI_Controller {

    public function login() {
        $this->load->view('admin/login_admin');
    }
}
