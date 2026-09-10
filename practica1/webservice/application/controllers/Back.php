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
            $this->load->model("promociones_model");
            // Se establece formato de salida
            $this->output->set_content_type("application/json");

            // Permitir accesos de diversos origenes
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Methods: GET, OPTIONS");
        }

        public function index () {
            
            echo "Acceso Prohibido";
        }

        public function productos () {
            $data = $this->promociones_model->get_productos();

            $obj["resultado"] = $data != NULL;
            $obj["mensaje"] = $data != NULL ? "Se recuperaron ".count($data)." productos" : "No hay productos";
            $obj["productos"] = $data;

            echo json_encode($obj);
        }

        public function promociones () {
            $formato = $this->input->post("formato") ?? "json";
            $data = $this->promociones_model->get_promociones();

            if ($formato == "json") {
                $obj["resultado"] = $data != NULL;
                $obj["mensaje"] = $data != NULL ? "Se recuperaron ".count($data)." promociones" : "No hay promociones";
                $obj["promociones"] = $data;

                echo json_encode($obj);
            } else if ($formato == "xml") {
                $this->output->set_content_type("application/xml");
                // Se evita el uso del navegador
                echo  $this->load->view("promociones_view_xml", array("promociones" => $data), TRUE);
            }
        }

        public function promocion () {
            // Recibir datos por POST
            $idpromocion = $this->input->post( "idpromocion" );

            $row = $this->promociones_model->get_promocion($idpromocion);

            $obj["resultado"] = $row != NULL;
            $obj["mensaje"] = $row != NULL ? "Se recuperaron datos de la promoción" : "No existe promoción ID $idpromocion";
            $obj["promocion"] = $row;

            echo json_encode($obj);
        }

        public function actualizapromo() {
            $accion      = $this->input->post('accion');
            $idpromocion = $this->input->post('idpromocion');
            $idproducto  = $this->input->post('idproducto');
            $precio      = $this->input->post('precio');
            $existencia  = $this->input->post('existencia');
            $descuento   = $this->input->post('descuento');
            $fecinicio   = $this->input->post('fecinicio');

            $data = array(
                "idpromocion" =>  $idpromocion ?? 0,
                "idproducto"  =>  $idproducto,
                "precio"      =>  $precio,
                "existencia"  =>  $existencia,
                "descuento"   =>  $descuento,
                "fecinicio"   =>  $fecinicio,
            );

            if($accion == "alta") {
                if ($this->promociones_model->exist_producto($idproducto)) {
                    $obj = array(
                        "resultado" => FALSE,
                        "mensaje"   => "Producto duplicado no permitido"
                    );
                } else {
                    $idpromocion = $this->promociones_model->insert_promocion($data);
                    $obj["resultado"] = $idpromocion != 0;
                    $obj["mensaje"]   = $idpromocion != 0 ? "Promocion insertada" : "Imposible insertar promoción";
                    $obj["idpromocion"] = $idpromocion;
                }
            } 
            else if ($accion == "cambio") {
                $obj["resultado"] = $this->promociones_model->update_promocion($data);
                $obj["mensaje" ]  = $obj["resultado"] ? "Datos actualizados" : "No se actualizaron los datos";
            } 
            else {
                $obj = array(
                    "resultado" => FALSE,
                    "mensaje"   => "Accion desconocida"
                );
            }

            echo json_encode($obj);
        }

        public function borrapromo () {
            $idpromocion = $this->input->post("idpromocion");

            $result = $this->promociones_model->delete_promocion($idpromocion);

            $obj["resultado"] = $result;
            $obj["mensaje"]   = $result ? "La promocion con ID $idpromocion ha sido eliminada" : "No se pudo eliminar la promocion con ID $idpromocion";

            echo json_encode($obj);
        }

        public function cambiavigencia() {
            $idpromocion = $this->input->post("idpromocion");
    
            $obj["resultado"] = $this->promociones_model->change_vigencia($idpromocion);
            $obj["mensaje"] = $obj["resultado"] ? "Vigencia de la promoción actualizada exitosamente" : "No se pudo actualizar la vigencia";
    
            echo json_encode($obj);
        }

    }
?>