<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    public function register() {
        $postData = json_decode(file_get_contents('php://input'), true);

        if ($postData) {
            $usuario = $postData['usuario'];
            $email = $postData['email'];
            $password = password_hash($postData['password'], PASSWORD_BCRYPT);
            $tipo_usuario = 1;  // Tipo de usuario por defecto
            $estatus = 1;  // Activo por defecto

            $data = array(
                'usuario' => $usuario,
                'email' => $email,
                'password' => $password,
                'tipo_usuario' => $tipo_usuario,
                'estatus' => $estatus
            );

            $this->db->insert('usuario', $data);

            $response = array(
                'status' => 'success',
                'message' => 'Usuario registrado exitosamente'
            );

            echo json_encode($response);
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Datos no válidos'
            );

            echo json_encode($response);
        }
    }
}
