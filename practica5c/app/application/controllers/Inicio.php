<?php
    class Inicio extends CI_Controller {

        public function index(){
            $this->load->view("page_header_view", array(
                "titulo" => "Práctica 5 - API Google Maps con BD"
            ));
            $this->load->view("alumnos_view");
            $this->load->view("page_footer_view", array(
                "js" => array(
                "mensajes", 
                "inicio" )
            ));
        }
        
    }
?>