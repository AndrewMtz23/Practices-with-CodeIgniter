<?php 
    class Alumnos_model extends CI_Model {
        // -> Obtiene todos los alumnos, ordenados por apellido paterno, materno y nombre
        public function get_alumnos () {
            $rs = $this->db
                ->order_by("appaterno, apmaterno, nombre")
                ->get("alumnos");
            return $rs->num_rows() > 0 ? $rs->result() : NULL;
        }

        // -> Obtiene un alumno específico por su número de matrícula
        public function get_alumno ($matricula) {
            $rs = $this->db
                ->where("matricula", $matricula)
                ->get("alumnos");

            return $rs->num_rows() == 1 ? 
                    $rs->row() : NULL;
        }

        // -> Inserta un nuevo registro de alumno en la BD
        public function insert_alumno($data) {
            $this->db->insert('alumnos', $data);

            return $this->db->affected_rows() == 1;
        }

        // -> Actualiza un registro existente de alumno en la BD
        public function update_alumno($data) {
            $this->db
                ->where('matricula', $data["matricula"])
                ->update('alumnos', $data);
    
            return $this->db->affected_rows() > 0;
        }

        // -> Verifica si ya existe un número de matrícula dado
        public function exist_matricula($matricula) {
            $rs = $this->db
                ->where("matricula", $matricula)
                ->get("alumnos");
            return $rs->num_rows() > 0;
        }

        // -> Elimina un registro de alumno y sus calificaciones asociadas
        public function delete_alumno ($matricula) {
            // -> Primero elimina las calificaciones asociadas
            $this->db
                ->where("matricula", $matricula)
                ->delete("calificaciones");

            // -> Luego elimina el registro del alumno
            $this->db
                ->where('matricula', $matricula)
                ->delete('alumnos');

            return $this->db->affected_rows() > 0;
        }

        // -> Obtiene todas las calificaciones de un alumno específico
        public function get_calificaciones ($matricula) {
            $rs = $this->db
                ->where("matricula", $matricula)
                ->order_by("idcalif")
                ->get("calificaciones");

            return $rs->num_rows() > 0 ? $rs->result() : NULL;
        }

        // -> Inserta o actualiza las calificaciones de un alumno
        public function insert_califs($matricula, $acalifs) {
            // -> Elimina las calificaciones existentes del alumno
            $this->db
                ->where("matricula", $matricula)
                ->delete("calificaciones");
            
            // -> Prepara los datos de las nuevas calificaciones
            $data = array();
            for ($idcalif=1; $idcalif <= 5 ; $idcalif++) { 
                $data[] = array(
                    "matricula"    => $matricula,
                    "idcalif"      => $idcalif,
                    "calificacion" => $acalifs[$idcalif - 1]
                );
            }
            
            // -> Inserta las nuevas calificaciones
            $this->db->insert_batch("calificaciones", $data);
            return $this->db->affected_rows() == 5;
        }

        // -> Obtiene el conteo de alumnos dentro de un rango de edad específico y género
        public function get_rangoedad($rango, $sexo) {
            if ($rango > 10) {
                // -> Para edades de 100 años y más
                $rs = $this->db
                    ->where("edad >=", 100)
                    ->where("sexo", $sexo)
                    ->get("alumnos");
            }
            else {
                // -> Para rangos de edad de 0-9, 10-19, 20-29, etc.
                $rs = $this->db
                    ->where("edad >=", ($rango - 1) * 10)
                    ->where("edad <=", $rango * 10 - 1)
                    ->where("sexo", $sexo)
                    ->get("alumnos");
            }
            return $rs->num_rows();
        }
        
        // -> Obtiene el conteo de alumnos con calificaciones por encima de cierto umbral para un período específico
        public function get_periodo($idcalif, $grado) {
            $this->db->select("COUNT(*) as registros")
                      ->where("idcalif", $idcalif);
        
            switch ($grado) {
                case 'AU': // Autónomo
                    $this->db->where("calificacion >=", 9.5);
                    break;
                case 'DE': // Destacado
                    $this->db->where("calificacion >=", 9.0)
                             ->where("calificacion <", 9.5);
                    break;
                case 'SA': // Satisfactorio
                    $this->db->where("calificacion >=", 8.0)
                             ->where("calificacion <", 9.0);
                    break;
                case 'NA': // No acreditado
                    $this->db->where("calificacion <", 8.0);
                    break;
                default:
                    return NULL; // Grado no reconocido
            }
        
            $rs = $this->db->get("calificaciones");
            return $rs->num_rows() == 1 ? $rs->row()->registros : NULL;
        }


        public function insert_acceso($usuario) {
            $this->db
                ->set("fechahora", "now()", FALSE)
                ->insert("re_accesos", array(
                    "nomusuario" => $usuario
            ));
            
            return $this->db->affected_rows() > 0;
        }

        // Nueva función para obtener los registros de acceso
        public function get_accesos() {
            $rs = $this->db
                ->order_by("fechahora desc")
                ->get("re_accesos");
            
            return $rs->num_rows() > 0 ?
                $rs->result() : NULL;
        }
    }
?>