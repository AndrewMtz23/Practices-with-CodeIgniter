<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function register() {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['usuario']) && isset($data['password'])) {
            $usuario = $data['usuario'];
            $password = password_hash($data['password'], PASSWORD_BCRYPT); // Hash the password
            $tipo_usuario = isset($data['tipo_usuario']) ? $data['tipo_usuario'] : 0; // Default user type
            $estatus = true; // Default status to active

            $insert_data = array(
                'usuario' => $usuario,
                'password' => $password,
                'tipo_usuario' => $tipo_usuario,
                'estatus' => $estatus
            );

            $this->db->insert('usuario', $insert_data);

            if ($this->db->affected_rows() > 0) {
                $response = array('status' => 'success', 'message' => 'Usuario registrado con éxito');
            } else {
                $response = array('status' => 'error', 'message' => 'No se pudo registrar el usuario');
            }
        } else {
            $response = array('status' => 'error', 'message' => 'Datos incompletos');
        }

        echo json_encode($response);
    }
}
?>
