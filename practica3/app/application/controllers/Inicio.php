<?php
    class Inicio extends CI_Controller {
        public function index(){
            $this->load->view("page_header_view", array(
                "titulo" => "Práctica 3 - Single View App con Highcharts",
                "css" => array("estilos")
            ));
            $this->load->view("alumnos_view");
            $this->load->view("page_footer_view", array(
                "js" => array( "mensajes", 
                    "../highcharts/highcharts", 
                    "../highcharts/modules/series-label", 
                    "../highcharts/modules/exporting", 
                    "../highcharts/modules/export-data", 
                    "../highcharts/modules/accessibility", 
                    "highcharts-lang-ES",
                    "graficas",
                    "inicio" )
            ));
        }
    }
?>