<script>
	var appData = {
		uri_app     : "<?= base_url() ?>",
		uri_ws      : "<?= base_url() ?>../../practica3/webservice/", // -> Importamos el Webservice de la Practica3 pa que jale datos
	}
</script>

<!-- La Tabla Coqueta pa que se vean los Datos xd-->
<table class="table table-bordered table-hover" id="tabla-alumnos">
  <thead>
    <tr class="table-dark text-white text-center">
      <th>Matricula</th>
      <th>Nombre Completo</th>
      <th>Sexo</th>
      <th>Edad</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>

<!-- -> VENTANAS MODALES <- -->
<!-- Modal Gráfica -->
<div class="modal fade" id="modal-mapa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-info bg-opacity-75">
        <h1 class="modal-title fs-5 text-white" id="modal-mapa-titulo"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close-x"></button>
      </div>

      <div class="modal-body text-center" id="modal-mapa-body"> 
        <!-- Aquí va el mapa -->
        <div id="mapa" class="border border-dark rounded" style="height: 400px;"></div>
        <div id="mensaje-mapa" class="fw-bold text-danger"></div>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=cargamapa"></script>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btn-guardar">
          <i class="fas fa-save"></i> Guardar
        </button>
        <button type="button" class="btn btn-secondary" id="btn-cerrar" data-bs-dismiss="modal">
          <i class="fas fa-times"></i> Cerrar
        </button>
      </div>
    </div>
  </div>
</div>