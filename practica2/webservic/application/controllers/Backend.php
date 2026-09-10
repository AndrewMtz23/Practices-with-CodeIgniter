<?php
class Backend extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("alumnos_model");
		header("Access-Control-Allow-Origin: * ");
		header("Access-Control-Allow-Methods: GET,OPTIONS");
	}

	public function index()
	{
		echo "Acceso no permitido";
	}

	public function alumno()
	{
		if ($this->input->raw_input_stream[0] == "{") {
			$input = json_decode($this->input->raw_input_stream);	// Petición REACT
			$matricula = $input->matricula;
		} else {
			$matricula = $this->input->post("matricula");				// Petición App Móvil / Web
		}

		$row = $this->alumnos_model->get_alumno($matricula);

		$obj["resultado"] = $row != NULL;
		$obj["mensaje"]   = $obj["resultado"] ?
			"Alumno/a recuperado/a" : "No existe alumno $matricula";
		$obj["alumno"]    = $row;

		echo json_encode($obj);
	}

	public function alumnos()
	{
		// Invocar función del modelo
		$data = $this->alumnos_model->get_alumnos();

		// Construcción del objeto SOAP (Simple Object Access Protocol)
		$obj["resultado"] = $data != NULL;
		$obj["mensaje"]   = $obj["resultado"] ?
			"Se recuperaron " . count($data) . " alumno(s)" : "No hay alumnos";
		$obj["alumnos"]   = $data;

		echo json_encode($obj);
	}

	public function actualizaalumno()
	{
		if ($this->input->raw_input_stream[0] == "{") {
			$input = json_decode($this->input->raw_input_stream);	// Petición REACT
			$accion    = $input->accion;
			$matricula = $input->matricula;
			$nombre    = mb_strtoupper($input->nombre);
			$appaterno = mb_strtoupper($input->appaterno);
			$apmaterno = mb_strtoupper($input->apmaterno);
			$sexo      = $input->sexo;
			$edad      = $input->edad;
		} else {
			$accion    = $this->input->post("accion");					// Petición App Móvil / Web
			$matricula = $this->input->post("matricula");
			$nombre    = mb_strtoupper($this->input->post("nombre"));
			$appaterno = mb_strtoupper($this->input->post("appaterno"));
			$apmaterno = mb_strtoupper($this->input->post("apmaterno"));
			$sexo      = $this->input->post("sexo");
			$edad      = $this->input->post("edad");
		}

		$data = array(
			"matricula" => $matricula,
			"nombre"    => $nombre,
			"appaterno" => $appaterno,
			"apmaterno" => $apmaterno,
			"sexo"      => $sexo,
			"edad"      => $edad
		);

		if ($accion == "alta") {

			$row = $this->alumnos_model->get_alumno($matricula);
			if ($row != NULL) {
				$obj = array(
					"resultado" => false,
					"mensaje"   => "Matrícula duplicada"
				);
			} else {
				$obj["resultado"] = $this->alumnos_model->insert_alumno($data);
				$obj["mensaje"]   = $obj["resultado"] ?
					"Alumno insertado" : "Imposible insertar alumno";
			}
		} else if ($accion == "cambio") {
			$obj["resultado"] = $this->alumnos_model->update_alumno($data);
			$obj["mensaje"]   = $obj["resultado"] ?
				"Alumno actualizado" : "Datos no actualizados";
		}
		echo json_encode($obj);
	}

	public function borraalumno()
	{

		if ($this->input->raw_input_stream[0] == "{") {
			$input = json_decode($this->input->raw_input_stream);	// Petición REACT
			$matricula = $input->matricula;
		} else {
			$matricula = $this->input->post("matricula");				// Petición App Móvil / Web
		}

		$obj["resultado"] = $this->alumnos_model->delete_alumno($matricula);
		$obj["mensaje"]   = $obj["resultado"] ?
			"Alumno eliminado" : "Imposble borrar alumno: $matricula";
		echo json_encode($obj);
	}

	public function calificaciones()
	{
		$matricula = $this->input->post("matricula");
		$data = $this->alumnos_model->get_califs($matricula);

		$obj["resultado"] = $data != NULL;
		$obj["mensaje"]   = $obj["resultado"] ?
			"Calificaciones recuperadas" : "No existen calificaciones del alumno $matricula";
		$obj["calificaciones"] = $data;

		echo json_encode($obj);
	}

	public function actualizacalificaciones()
	{
		$matricula = $this->input->post("matricula");
		$calif1 = $this->input->post("calif1");
		$calif2 = $this->input->post("calif2");
		$calif3 = $this->input->post("calif3");
		$calif4 = $this->input->post("calif4");
		$calif5 = $this->input->post("calif5");

		$obj["resultado"] = $this->alumnos_model->update_califs($matricula, array(
			1 => $calif1,
			2 => $calif2,
			3 => $calif3,
			4 => $calif4,
			5 => $calif5
		)) == 5;
		$obj["mensaje"]   = $obj["resultado"] ?
			"Calificaciones insertadas" : "No fue posible insertar calificaciones";
		echo json_encode($obj);
	}

	public function grafcalifalumno()
	{
		$matricula = $this->input->post("matricula");
		$row = $this->alumnos_model->get_alumno($matricula);

		$obj["resultado"] = $row != NULL;
		$obj["mensaje"]   = $obj["resultado"] ?
			"Se recuperaron los datos" : "No existe el alumno $matricula";

		$series = array();
		$califs = array();

		$datacalif = $this->alumnos_model->get_califs($matricula);

		if ($datacalif != NULL) {
			foreach ($datacalif as $rowcalif) {
				$califs[] = (float)$rowcalif->calificacion;
			}
		}

		$series[] = array(
			"name" => $row->appaterno . " " . $row->apmaterno . " " . $row->nombre,
			"data" => $califs
		);

		$obj["series"]   = $series;

		echo json_encode($obj);
	}

	public function grafedad()
	{
		$series = array();

		$aserie = array(
			"M" => "MASCULINO",
			"F" => "FEMENINO"
		);

		foreach ($aserie as $sexo => $nomserie) {
			$data = array();
			for ($rango = 1; $rango <= 11; $rango++) {
				$data[] = (int)$this->alumnos_model->get_sexo_rango($sexo, $rango) *
					($sexo == "M" ? -1 : 1);
			}

			$series[] = array(
				"name" => $nomserie,
				"data" => $data
			);
		}

		echo json_encode(array(
			"resultado" => true,
			"mensaje"   => "Datos recuperados",
			"series"    => $series
		));
	}

	public function grafperiodo()
	{
		$series = array();

		$agrado = array(
			"AU" => "AUTÓNOMO",
			"DE" => "DESTACADO",
			"SA" => "SATISFACTORIO",
			"NA" => "NO ACREDITADO"
		);

		foreach ($agrado as $grado => $nomserie) {
			$data = array();

			for ($idcalif = 1; $idcalif <= 5; $idcalif++) {
				$data[] = $this->alumnos_model->get_grado_periodo($grado, $idcalif);
			}

			$series[] = array(
				"name" => $nomserie,
				"data" => $data
			);
		}

		echo json_encode(array(
			"resultado" => true,
			"mensaje"   => "Datos recuperados",
			"series"    => $series
		));
	}

	public function grafcalif()
	{
		$data = $this->alumnos_model->get_alumnos();

		$obj["resultado"] = $data != NULL;
		$obj["mensaje"]   = $obj["resultado"] ?
			"Se recuperaron " . count($data) . " alumno(s)" : "No hay alumnos";

		$series =  array();

		if ($data != NULL) {
			foreach ($data as $alumno) {
				$califs = array();

				$datacalif = $this->alumnos_model->get_califs($alumno->matricula);
				if ($datacalif != NULL) {
					foreach ($datacalif as $rowcalif) {
						$califs[] = (float)$rowcalif->calificacion;
					}
				} else
					$califs = array(0, 0, 0, 0, 0);

				$series[] = (object)array(
					"name" => $alumno->appaterno . " " . $alumno->apmaterno . " " . $alumno->nombre,
					"data" => $califs
				);
			}
		}
		$obj["series"]   = $series;
		echo json_encode($obj);
	}

	public function accesos()
	{
		$data = $this->alumnos_model->get_accesos();

		$obj["resultado"] = $data != NULL;
		$obj["mensajes"]  = $obj["resultado"] ?
			"Se recuperaron " . count($data) . "
			acceso(s)" : "No hay accesos";
		$obj["accesos"] = $data;

		echo json_encode($obj);
	}

	public function insertaacceso(/*$nomusuario*/){
		// Si la petición es por React
		if ($this->input->raw_input_stream[0] == "{") {
			$input = json_decode($this->input->raw_input_stream);
			$nomusuario = $input->nomusuario;
		} else { // De lo  contrario, es una petición JQuery
			$nomusuario = $this->input->post("nomusuario");
		}
		$obj["resultado"] = $this->alumnos_model->insert_acceso($nomusuario);
		$obj["mensajes"]  = $obj["resultado"] ?
			"Acceso insertado" : "Imposible insertar accesos";

		echo json_encode($obj);
	}
}
