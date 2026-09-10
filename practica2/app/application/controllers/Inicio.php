<?php
    class Inicio extends CI_Controller {

        public function index(){
            $this->load->view("page_header_view", array(
                "titulo" => "Práctica 2 - Highcharts", 
                "css"    => array("grafica")
            ));
            $this->load->view("grafica_view");
            $this->load->view("page_footer_view", array(
                "js" => array("mensajes",
                "../highcharts/highcharts",
                "../highcharts/modules//series-label", 
                "../highcharts/modules/exporting",   
                "../highcharts/modules/export-data",
                "../highcharts/modules/accessibility",      
                "highcharts-lang-ES",
                "grafica",
                "inicio"
                )
            ));
        }
        
    }
?>