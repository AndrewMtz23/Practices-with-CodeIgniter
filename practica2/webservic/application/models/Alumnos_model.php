<?php
class Alumnos_model extends CI_Model {

	public function get_alumnos() {
		$rs = $this->db
					->order_by( "appaterno, apmaterno, nombre" )
					->get( "alumnos" );
		return $rs->num_rows() > 0 ? $rs->result() : NULL;
	}

	public function get_alumno( $matricula ) {
		$rs = $this->db
					->where( "matricula", $matricula )
					->get( "alumnos" );
		return $rs->num_rows() > 0 ? $rs->row() : NULL;
	}

	public function insert_alumno( $data ) {
		$this->db->insert( "alumnos", $data );
		return $this->db->affected_rows() > 0;
	}

	public function delete_alumno( $matricula ) {
		$this->db
				->where( "matricula", $matricula )
				->delete( "alumnos" );
		return $this->db->affected_rows() > 0;
	}

	public function update_alumno( $data ) {
		$this->db
				->where( "matricula", $data[ "matricula" ] )
				->update( "alumnos", $data );
		return $this->db->affected_rows() > 0;
	}

	public function get_califs( $matricula ) {
		$rs = $this->db
				->where( "matricula", $matricula )
				->order_by( "idcalif" )
				->get( "calificaciones" );
		return $rs->num_rows() > 0 ? $rs->result() : NULL;
	}

	public function update_califs( $matricula, $acalifs ) {
		// Borrar califs anteriores
		$this->db
				->where( "matricula", $matricula )
				->delete( "calificaciones" );

		// Insertar nuevas calificaciones
		$insertados = 0;
		foreach ( $acalifs as $idcalif => $calificacion ) {
			$this->db->insert( "calificaciones", array(
				"matricula"    => $matricula,
				"idcalif"      => $idcalif,
				"calificacion" => $calificacion
			));
			if ( $this->db->affected_rows() == 1 ) {
				$insertados++;
			}
		}
		return $insertados;
	}

	public function get_sexo_rango( $sexo, $rango ) {
		$rs = $this->db
					->where( "sexo", $sexo )
					->where( "edad >=", "( $rango - 1 ) * 10", false )
					->where( "edad <=", "$rango * 10 - 1", false )
					->get( "alumnos" );
		return $rs->num_rows();
	}

	public function get_grado_periodo( $grado, $idcalif ) {
		switch( $grado ) {
			case "AU":
				$limsup = 10;
				$liminf = 9.5;
				break;
			case "DE":
				$limsup = 9.4;
				$liminf = 8.5;
				break;
			case "SA":
				$limsup = 8.4;
				$liminf = 8;
				break;
			case "NA":
				$limsup = 7.9;
				$liminf = 0;
				break;
		}
		$rs = $this->db
					->where( "idcalif", $idcalif )
					->where( "calificacion <=", $limsup )
					->where( "calificacion >=", $liminf )
					->get( "calificaciones" );
		
		return $rs->num_rows();
	}

	public function get_accesos() {
		$rs = $this -> db
		->select("nomusuario, fechahora")
		->order_by("fechahora desc" )
		->get( "re_accesos" );

		return $rs->num_rows() > 0 ?
			   $rs->result() : NULL;
	}

	public function insert_acceso( $nomusuario ) {
		$this->db
			->insert( "re_accesos", array(
				"nomusuario" => "'$nomusuario'",
				"fechahora"  => "now()"
			), FALSE );

		return $this->db->affected_rows() > 0;	
	}

}
?>
