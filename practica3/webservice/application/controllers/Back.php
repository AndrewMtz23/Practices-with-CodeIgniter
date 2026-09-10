<?php
    class Back extends CI_Controller {
        /**
         * Carga el modelo de alumnos y configura el tipo de contenido de salida 
         */
       
         public function __construct() {
            parent::__construct();
            $this->load->model("alumnos_model");
            $this->output->set_content_type("application/json");
        
            // Definir los dominios permitidos
            $allowed_origins = [
                "http://localhost:3000",
                "http://dtai.uteq.edu.mx/~morand218/practica3/webservice/back/"
            ];
        
            // Verificar el origen de la solicitud
            if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $allowed_origins)) {
                header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
            } else {
                header("Access-Control-Allow-Origin: http://localhost:3000"); // Establecer un origen por defecto
            }
        
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
            header("Access-Control-Allow-Headers: Content-Type");
        
            // Manejar solicitudes OPTIONS (preflight)
            if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
                header("HTTP/1.1 200 OK");
                exit();
            }
        }
        

        public function index () {
            echo "Acceso Denegado";
        }
        
        // -> Recupera todos los alumnos y retorna un JSON con los Resultados.
        public function alumnos () {
            $data = $this->alumnos_model->get_alumnos();

            $obj["resultado"] = $data != NULL;
            $obj["mensaje"] = $data != NULL ? "Se recuperaron ".count($data)." alumnos" : "No hay alumnos";
            $obj["alumnos"] = $data;
            echo json_encode($obj);
        }
        
        // -> Recupera los datos de un alumno específico basado en su matrícula y retorna un JSON con los resultados.
        public function alumno() {
            $matricula = null;
        
            if ($this->input->raw_input_stream[0] == "{") { // PETICIÓN FETCH desde REACT
                $input = json_decode($this->input->raw_input_stream);
                $matricula = $input->matricula;
            } else { // PETICIÓN Ajax desde JS
                $matricula = $this->input->post("matricula");
            }
        
            if ($matricula === null) {
                $obj = array(
                    "resultado" => false,
                    "mensaje" => "No se proporcionó una matrícula válida",
                    "alumno" => null
                );
            } else {
                $row = $this->alumnos_model->get_alumno($matricula);
                $obj = array(
                    "resultado" => $row !== NULL,
                    "mensaje" => $row !== NULL ? "Se recuperaron datos del alumno" : "No existe alumno con matrícula $matricula",
                    "alumno" => $row
                );
            }
        
            // Añadir log para depuración
            log_message('debug', 'Matrícula recibida: ' . $matricula);
            log_message('debug', 'Respuesta JSON: ' . json_encode($obj));
        
            echo json_encode($obj);
        }

        // -> Inserta o actualiza los datos de un alumno basado en la acción especificada 
        public function actualizaalumno() {

            if ($this->input->raw_input_stream[0] == "{") { // PETICIÓN FETCH desde REACT
                $input = json_decode($this->input->raw_input_stream);
                if ($this->input->raw_input_stream[0] == "{") { // PETICIÓN FETCH desde REACT
                    $input = json_decode($this->input->raw_input_stream);
                    $accion = $input->accion;
                    $matricula = $input->matricula;
                    $appaterno = $input->appaterno;
                    $apmaterno = $input->apmaterno;
                    $nombre = $input->nombre;
                    $sexo = $input->sexo;
                    $edad = $input->edad;
                }
                
            } else { // PETICIÓN Ajax desde JS
                $accion      = $this->input->post('accion');
                $matricula   = $this->input->post('matricula');
                $appaterno   = $this->input->post('appaterno');
                $apmaterno   = $this->input->post('apmaterno');
                $nombre      = $this->input->post('nombre');
                $sexo        = $this->input->post('sexo');
                $edad        = $this->input->post('edad');
            }
            
            $data = array(
                "matricula" =>  $matricula,
                "appaterno" =>  $appaterno,
                "apmaterno" =>  $apmaterno,
                "nombre"    =>  $nombre,
                "sexo"      =>  $sexo,
                "edad"      =>  $edad,
            );
            if ($accion == "alta") {
                if ($this->alumnos_model->exist_matricula($matricula)) {
                    $obj = array(
                        "resultado" => FALSE,
                        "mensaje"   => "Matrícula ya existente"
                    );
                } else {
                    $obj["resultado"] = $this->alumnos_model->insert_alumno($data);
                    $obj["mensaje"]   = $obj["resultado"] ? "Alumno insertado" : "Imposible insertar alumno";
                }
            } 
            else if ($accion == "cambio") {
                $obj["resultado"] = $this->alumnos_model->update_alumno($data);
                $obj["mensaje" ]  = $obj["resultado"] ? "Datos actualizados" : "No se actualizaron los datos";
            } 
            else {
                $obj = array(
                    "resultado" => FALSE,
                    "mensaje"   => "Acción desconocida"
                );
            }
            echo json_encode($obj);
        }
        
        // -> Elimina un alumno basado en su matrícula y retorna un JSON con el resultado de la operación.
            public function borraalumno() {
                $input = $this->input->raw_input_stream;
                $inputData = json_decode($input, true);

                if ($inputData && isset($inputData['matricula'])) {
                    $matricula = $inputData['matricula'];
                } else {
                    $matricula = $this->input->post("matricula");
                }

                if (!$matricula) {
                    $obj["resultado"] = false;
                    $obj["mensaje"] = "No se recibió la matrícula";
                } else {
                    $obj["resultado"] = $this->alumnos_model->delete_alumno($matricula);
                    $obj["mensaje"] = $obj["resultado"] ? 
                        "Alumno borrado con éxito" : 
                        "Imposible borrar al alumno matricula: $matricula";
                }

                echo json_encode($obj);
            }             

        // -> Recupera las calificaciones de un alumno basado en su matrícula 
        public function calificaciones() {
            if ($this->input->raw_input_stream[0] == "{") {
                $input = json_decode($this->input->raw_input_stream);
                $matricula = $input->matricula;
            } else {
                $matricula = $this->input->post("matricula");
            }
        
            $data = $this->alumnos_model->get_calificaciones($matricula);
            $obj["resultado"] = $data != NULL;
            $obj["mensaje"] = $data != NULL ? "Se recuperaron calificaciones del alumno" : "No existen calificaciones del alumno con matrícula $matricula";
            $obj["calificaciones"] = $data;
            echo json_encode($obj);
        }
        
        // -> nInserta o actualiza las calificaciones de un alumno basado en su matrícula y retorna un JSON con el resultado de la operación.
        public function actualizacalificaciones() {
            //Verificar el origen de la peticion
            if ($this->input->raw_input_stream[0] == "{") { // PETICION FETCH desde REACT
                $input = json_decode($this->input->raw_input_stream);
                $matricula = $input->matricula;
                $calif1 = $input->calif1;
                $calif2 = $input->calif2;
                $calif3 = $input->calif3;
                $calif4 = $input->calif4;
                $calif5 = $input->calif5;
            } else {                                        // PETICION Ajax desde JS
                //Recibe  Calificaciones y matricula
                $matricula = $this->input->post("matricula");
                $calif1 = $this->input->post("calif1") ?? 0;
                $calif2 = $this->input->post("calif2") ?? 0;
                $calif3 = $this->input->post("calif3") ?? 0;
                $calif4 = $this->input->post("calif4") ?? 0;
                $calif5 = $this->input->post("calif5") ?? 0;
            }
        
            if (!$this->alumnos_model->exist_matricula($matricula)) {
                $obj = array(
                    "resultado" => FALSE,
                    "mensaje"   => "No existe alumno con la matrícula $matricula"
                );
            } else {
                $califs = array($calif1, $calif2, $calif3, $calif4, $calif5);
                $obj["resultado"] = $this->alumnos_model->insert_califs($matricula, $califs);
                $obj["mensaje"] =  $obj["resultado"] ? "Calificaciones insertadas exitosamente" : "Imposible insertar calificaciones del alumno $matricula";
            }

            echo json_encode($obj);
        }
        
        // -> Recupera los alumnos en un rango de edad específico y sexo especificado 
        public function rangoedad() {
            if ($this->input->raw_input_stream[0] == "{") { // PETICIÓN FETCH desde REACT
                $input = json_decode($this->input->raw_input_stream);
                $rango = $input->rango;
                $sexo = $input->sexo;
            } else { // PETICIÓN Ajax desde JS
                $rango = $this->input->post("rango");
                $sexo  = $this->input->post("sexo");
            }
            
            echo json_encode(array(
                "resultado" => true,
                "alumnos"   => $this->alumnos_model->get_rangoedad($rango, $sexo)
            ));
        }
        // te quedaste en el minuto 1:01:15/ 1:42:05 2024-07-12 
        // -> Recupera los registros de alumnos en un periodo y grado específico 
        public function periodo() {
            if ($this->input->raw_input_stream[0] == "{") { // PETICIÓN FETCH desde REACT
                $input = json_decode($this->input->raw_input_stream);
                $periodo = $input->periodo;
                $grado = $input->grado;
            } else { // PETICIÓN Ajax desde JS
                $periodo = $this->input->post("periodo");
                $grado = $this->input->post("grado");
                $registros = $this->alumnos_model->get_periodo($periodo, $grado);
                
                log_message('debug', "Periodo: $periodo, Grado: $grado, Registros: $registros");
                
                $obj = array(
                    "resultado" => $registros !== NULL,
                    "registros" => $registros !== NULL ? $registros : 0
                );
                echo json_encode($obj);
            }
            
        }

        // -> Actualiza la posición geográfica de un alumno y Recibe la matrícula, latitud y longitud del alumno a través de POST, 
        // -> Actualiza la información de posición en la base de datos y devuelve un objeto JSON con el resultado de la operación.
        public function actualizaposicion() {
            if ($this->input->raw_input_stream[0] == "{") { // PETICIÓN FETCH desde REACT
                $input = json_decode($this->input->raw_input_stream);
                $matricula = $input->matricula;
            } else { // PETICIÓN Ajax desde JS
                $matricula = $this->input->post("matricula");
            }
            
            $matricula = $this->input->post('matricula');
            $latitud   = $this->input->post('latitud');
            $longitud  = $this->input->post('longitud');

            $data = array(
                "matricula" => $matricula,
                "latitud"   => $latitud,
                "longitud"  => $longitud
            );

            $obj["resultado"] = $this->alumnos_model->update_alumno($data);
            $obj["mensaje" ]  = $obj["resultado"] ? "Posición actualizada" : "No se actualizó la posición";

            echo json_encode($obj);
        }

        public function insertacceso() {
            // Verificar el origen de la petición
            if ( isset($this->input->raw_input_stream) && 
                $this->input->raw_input_stream[0] == "{") {
                // PETICIÓN FETCH desde REACT
                $input = json_decode($this->input->raw_input_stream);
                $usuario = $input->usuario;
            } else {
                // PETICIÓN Ajax desde JS
                $usuario = $this->input->post("usuario");
            }
        
            $obj["resultado"] = $this->alumnos_model->insert_acceso($usuario);
            $obj["mensaje"] = $obj["resultado"] ? "Acceso insertado con éxito" : "Imposible insertar acceso del usuario: $usuario";
        
            echo json_encode($obj);
        }    

        public function accesos() {
            // Registrar el inicio de la función para depuración
            log_message('debug', 'Accediendo a la función accesos');
        
            // Obtener los datos de acceso
            $data = $this->alumnos_model->get_accesos();
        
            // Registrar los datos obtenidos para depuración
            log_message('debug', 'Datos recuperados: ' . print_r($data, true));
        
            // Preparar la respuesta
            $obj = array(
                "resultado" => $data !== NULL,
                "mensaje" => $data !== NULL ?
                    "Se recuperaron " . count($data) . " accesos" :
                    "No hay accesos registrados",
                "accesos" => $data
            );
        
            // Registrar la respuesta que se enviará para depuración
            log_message('debug', 'Respuesta a enviar: ' . json_encode($obj));
        
            // Configurar los encabezados CORS si es necesario
            $this->output->set_header('Access-Control-Allow-Origin: *');
            $this->output->set_header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
            $this->output->set_header('Access-Control-Allow-Headers: Content-Type');
        
            // Enviar la respuesta como JSON
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($obj));
        }
    }
?>
