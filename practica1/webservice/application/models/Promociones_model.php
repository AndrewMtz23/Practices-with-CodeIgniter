<?php 
    class Promociones_model extends CI_Model {
        
        public function get_productos () {
            $rs = $this->db
            ->select("idproducto, nomproducto")
            ->order_by("nomproducto")
            ->get("productos");

            return $rs->num_rows() > 0 ? $rs->result() : NULL;
        }

        public function get_promociones () {
            $rs = $this->db
            ->select("pm.*, nomproducto")
            ->from("promociones AS pm")
            ->join("productos AS pd", "pd.idproducto = pm.idproducto", "left")
            ->order_by("nomproducto")
            ->get();

            //die($this->db->last_query());

            return $rs->num_rows() > 0 ? $rs->result() : NULL;
        }

        public function get_promocion ($idpromocion) {
            $rs = $this->db
            ->select("pm.*, nomproducto")
            ->from("promociones AS pm")
            ->join("productos AS pd", "pd.idproducto = pm.idproducto", "left")
            ->where("idpromocion", $idpromocion)
            ->get();

            //die($this->db->last_query());

            return $rs->num_rows() == 1 ? $rs->row() : NULL;
        }


        public function insert_promocion($data) {
            $this->db->insert('promociones', $data);
            return $this->db->affected_rows() == 1 ? $this->db->insert_id() : 0;
        }

        public function update_promocion($data) {
            $this->db
            ->where('idpromocion', $data["idpromocion"])
            ->update('promociones', $data);
    
            return $this->db->affected_rows() > 0;
        }

        public function exist_producto($idproducto) {
            $rs = $this->db
            ->where("idproducto", $idproducto)
            ->get("promociones");
            return $rs->num_rows() > 0;
        }

        public function delete_promocion ($idpromocion) {
            $this->db
            ->where('idpromocion', $idpromocion)
            ->delete('promociones');

            return $this->db->affected_rows() > 0;
        }

        public function change_vigencia($idpromocion) {
            $this->db
            ->set("vigente", "1-vigente", FALSE)
            ->where("idpromocion", $idpromocion)
            ->update("promociones");
            
            return $this->db->affected_rows() > 0;
        }
    }
?>