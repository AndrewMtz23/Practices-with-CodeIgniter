<?php
    class Inicio extends CI_Controller {

        public function index(){
            $this->load->view("page_header_view", array(
                "titulo" => "Práctica 1 - API Rest con CodeIgniter"
            ));
            $this->load->view("promociones_view");
            $this->load->view("page_footer_view", array(
                "js" => array("mensajes", "inicio")
            ));
        }
        
    }
?>