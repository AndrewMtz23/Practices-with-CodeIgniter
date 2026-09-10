<script>
	var appData = {
		uri_app     : "<?= base_url() ?>",
		uri_ws      : "<?= base_url() ?>../webservice/",
		accion      : "",
		matricula   : ""
	}
</script>

<!-- Tabla para mostrar la lista de alumnos -->
<table class="table table-bordered table-hover" id="tabla-alumnos">
	<thead>
		<tr class="table-dark text-white text-center">
			<th>Matrícula</th>
			<th>Nombre completo</th>
			<th>Sexo</th>
			<th>Edad</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>

<!-- Tabla para mostrar la lista de alumnos -->
<div class="row p-3">
	<button class="btn btn-lg btn-success p-2 col-md-4"
		data-bs-toggle="modal"
		data-bs-target="#modal-editar"
		id="btn-agregar">
		<i class="fas fa-user-plus fa-2x"></i>
		Agregar alumno
	</button>
</div>


<!-- Botones para mostrar diferentes gráficas -->
<div class="row p-3">
	<button class="btn btn-lg btn-outline-primary p-2 col-md-2 me-2"
		data-bs-toggle="modal"
		data-bs-target="#modal-grafica"
		id="btn-graf-calif-todos">
		<i class="fas fa-chart-line fa-2x"></i>
		Calificaciones
	</button>

	<button class="btn btn-lg btn-outline-primary p-2 col-md-2 me-2"
		data-bs-toggle="modal"
		data-bs-target="#modal-grafica"
		id="btn-graf-edad">
		<i class="fas fa-chart-bar fa-2x"></i>
		Rangos de edad
	</button>

	<button class="btn btn-lg btn-outline-primary p-2 col-md-2"
		data-bs-toggle="modal"
		data-bs-target="#modal-grafica"
		id="btn-graf-periodo">
		<i class="fas fa-chart-area fa-2x"></i>
		Periodos
	</button>
</div>

<!-- Tabla para baja del alumnos -->
<div class="modal fade" id="modal-baja" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-header bg-danger bg-opacity-75">
        <h1 class="modal-title fs-5 text-white" id="modal-baja-titulo">Eliminar alumno</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-baja-body">
        ¿Desea elimar al alumno<strong id="modal-baja-nomalumno"></strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btn-confirmar-baja">
        	<i class="fas fa-check"></i>
        	Confirmar
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
        	<i class="fas fa-times"></i>
        	Cancelar
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para editar un alumno -->
<div class="modal fade" id="modal-editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary bg-opacity-75">
        <h1 class="modal-title fs-5 text-white" id="modal-editar-titulo"><span id="modal-editar-accion"></span> alumno</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form-alumno">
      <div class="modal-body" id="modal-editar-body">
        <div class="row">
	        <div class="form-group col-md-4" id="group-matricula">
	        		<label for="matricula"><strong>Matrícula:</strong></label>
	        		<input type="text" class="form-control" id="matricula" />
	        </div>
	        <div class="form-group col-md-4" id="group-appaterno">
	        		<label for="appaterno"><strong>Ap. Paterno:</strong></label>
	        		<input type="text" class="form-control" id="appaterno" />
	        </div>
	        <div class="form-group col-md-4" id="group-apmaterno">
	        		<label for="apmaterno"><strong>Ap. Materno:</strong></label>
	        		<input type="text" class="form-control" id="apmaterno" />
	        </div>
	      </div>
        <div class="row">
	        <div class="form-group col-md-4" id="group-nombre">
	        		<label for="nombre"><strong>Nombre:</strong></label>
	        		<input type="text" class="form-control" id="nombre" />
	        </div>
	        <div class="form-group col-md-4" id="group-sexo">
        		<label><strong>Sexo:</strong></label><br />
		        <div class="form-check form-check-inline">
		        		<input type="radio" class="form-check-input" name="sexo" value="M" id="sexo-m" />
		        		<label for="sexo-m">Masculino</label>
		        </div>
		        <div class="form-check form-check-inline">
	        		<input type="radio" class="form-check-input" name="sexo" value="F" id="sexo-f" />
	        		<label for="sexo-f">Femenino</label>
	        	</div>
	        </div>
	        <div class="form-group col-md-4" id="group-edad">
	        		<label for="edad"><strong>Edad:</strong></label>
	        		<input type="number" min="0" step="1" class="form-control" id="edad" />
	        </div>
	      </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btn-guardar">
        	<i class="fas fa-save"></i>
        	Guardar
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
        	<i class="fas fa-times"></i>
        	Cancelar
        </button>
      </div>
    	</form>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-grafica" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-info bg-opacity-75">
                <h1 class="modal-title fs-5 text-white" id="modal-grafica-titulo"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center" id="modal-grafica-body">
                <figure class="highcharts-figure">
                    <div id="div-grafica" style="width:100%;height:450px;display:inline-block;"></div>
                </figure>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-calif" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-warning bg-opacity-75">
        <h1 class="modal-title fs-5 text-white" id="modal-calif-titulo">Calificaciones<br />
        <small><small><small class="fw-normal mt-1" id="modal-calif-nomalumno"></small></small></small></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="form-calif">
      <div class="modal-body" id="modal-calif-body">
        <div class="d-flex justify-content-between">
	        <div class="form-group col-md-2" id="group-calif-1">
	        		<label for="calif1"><strong>Calif 1:</strong></label>
	        		<input type="number" min="0" max="10" step="0.1" class="form-control input-calif" id="calif1" />
	        </div>
	        <div class="form-group col-md-2" id="group-calif-2">
	        		<label for="calif2"><strong>Calif 2:</strong></label>
	        		<input type="number" min="0" max="10" step="0.1" class="form-control input-calif" id="calif2" />
	        </div>
	        <div class="form-group col-md-2" id="group-calif-3">
	        		<label for="calif3"><strong>Calif 3:</strong></label>
	        		<input type="number" min="0" max="10" step="0.1" class="form-control input-calif" id="calif3" />
	        </div>
	        <div class="form-group col-md-2" id="group-calif-4">
	        		<label for="calif4"><strong>Calif 4:</strong></label>
	        		<input type="number" min="0" max="10" step="0.1" class="form-control input-calif" id="calif4" />
	        </div>
	        <div class="form-group col-md-2" id="group-calif-5">
	        		<label for="calif5"><strong>Calif 5:</strong></label>
	        		<input type="number" min="0" max="10" step="0.1" class="form-control input-calif" id="calif5" />
	        </div>
	      </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btn-guardar-calif">
        	<i class="fas fa-save"></i>
        	Guardar
        </button>

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
        	<i class="fas fa-times"></i>
        	Cancelar
        </button>
      </div>

    	</form>
    </div>
  </div>
</div>