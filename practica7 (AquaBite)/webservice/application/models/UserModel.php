<?php
class UserModel extends CI_Model {

    public function register($usuario, $password, $tipo_usuario) {
        $data = array(
            'usuario' => $usuario,
            'password' => $password,
            'tipo_usuario' => $tipo_usuario,
            'estatus' => 1 // Establece el estatus por defecto a activo
        );

        return $this->db->insert('usuario', $data);
    }
}
?>
