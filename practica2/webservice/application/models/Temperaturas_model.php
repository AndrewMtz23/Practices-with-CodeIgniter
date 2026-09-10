<?php 
    class Temperaturas_model extends CI_Model {
        
        public function get_ciudades () {
            $rs = $this->db
            ->select("ciudad")
            ->distinct("ciudad")
            ->order_by("ciudad")
            ->get("temperaturas");

            return $rs->num_rows() > 0 ? $rs->result() : NULL;
        }

        public function get_temperaturas ($ciudad) {
            $rs = $this->db
            ->select("idmes, temperatura")
            ->where("ciudad", $ciudad)
            ->order_by("idmes")
            ->get("temperaturas");

            return $rs->num_rows() > 0 ? $rs->result() : NULL;
        }

    }
?>