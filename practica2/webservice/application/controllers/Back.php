<?php
    class Back extends CI_Controller {

        /*  
            Constructor del Controlador
            Se usa para cargar modelos, Bilbliotecas, helpers, etc.
            y para establecer formatos de salida
        */

        public function __construct() {
            parent::__construct();
            // Se carga eñ modelo
            $this->load->model("temperaturas_model");
            // Se establece formato de salida
            $this->output->set_content_type("application/json");

            // Permitir accesos de diversos origenes
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Methods: GET, OPTIONS");
        }

        public function index () {
            
            echo "Acceso Prohibido";
        }

        public function ciudades () {
            $data = $this->temperaturas_model->get_ciudades();

            $obj["resultado"] = $data != NULL;
            $obj["mensaje"] = $data != NULL ? "Se recuperaron datos de ".count($data)." ciudades" : "No hay ciudades";
            $obj["ciudades"] = $data;

            echo json_encode($obj);
        }

        public function temperaturas () {
            $ciudad = $this->input->post("ciudad");
            $data = $this->temperaturas_model->get_temperaturas($ciudad);

            $obj["resultado"] = $data != NULL;
            $obj["mensaje"] = $data != NULL ? "Se recuperaron temperaturas de $ciudad" : "No existen temperaturas de $ciudad";
            $obj["temperaturas"] = $data;

            echo json_encode($obj);
        }

    }
?>