<script>
	var appData = {
		uri_app     : "<?= base_url() ?>",
		uri_ws      : "<?= base_url() ?>../webservice/",
		accion      : "",
		idpromocion : 0
	}
</script>

<table class="table table-bordered table-hover" id="tabla-promociones">
	<thead>
		<tr class="table-dark text-white text-center">
			<th>Producto</th>
			<th>Precio</th>
			<th>Existencia</th>
			<th>Descuento</th>
			<th>Fecha</th>
			<th>Vigencia</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>

<div class="row p-3">
	<button class="btn btn-lg btn-success p-2 col-md-4"
		data-bs-toggle="modal"
		data-bs-target="#modal-editar"
		id="btn-agregar">
		<i class="fas fa-cart-plus fa-2x"></i>
		Agregar promoción
	</button>
</div>
<div>
	<button class="btn btn-light bg-opacity-50"
		data-bs-toggle="modal"
		data-bs-target="#modal-formato"
		id="btn-json">
		<i class="fa-solid fa-file-code"></i>
		JSON
	</button>
	<button class="btn btn-light bg-opacity-50"
		data-bs-toggle="modal"
		data-bs-target="#modal-formato"
		id="btn-xml">
		<i class="fa-solid fa-file-code"></i>
		XML
	</button>
</div>

<!-- VENTANAS MODALES -->

<!-- Modal JSON / XML -->
<div class="modal fade" id="modal-formato" tabindex="-1" 
		aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-secondary bg-opacity-75">
        <h1 class="modal-title fs-5 text-white" id="modal-formato-titulo"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-formato-body">
        
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

<!-- Modal Baja -->
<div class="modal fade" id="modal-baja" tabindex="-1" 
		aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-header bg-danger bg-opacity-75">
        <h1 class="modal-title fs-5 text-white" id="modal-baja-titulo">Eliminar promoción</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-formato-body">
        ¿Realmente desea eliminar la promoción?
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

<!-- Modal Editar -->
<div class="modal fade" id="modal-editar" tabindex="-1" 
		aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary bg-opacity-75">
        <h1 class="modal-title fs-5 text-white" id="modal-editar-titulo"><span id="modal-editar-accion"></span> promoción</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="form-promocion">

      <div class="modal-body" id="modal-editar-body">
        <div class="row">
	        <div class="form-group col-md-8" id="group-idproducto">
	        		<label for="idproducto"><strong>Producto:</strong></label>
	        		<select class="form-select" id="idproducto">
	        			<option value="0">-- Seleccione producto --</option>
	        		</select>
	        </div>
	        <div class="form-group col-md-4" id="group-precio">
	        		<label for="precio"><strong>Precio:</strong></label>
	        		<input type="number" min="0" step="0.01" class="form-control" id="precio" />
	        </div>
	     </div>
        <div class="row">
	        <div class="form-group col-md-4" id="group-existencia">
	        		<label for="existencia"><strong>Existencia:</strong></label>
	        		<input type="number" class="form-control" id="existencia" min="0" />
	        </div>
	        <div class="form-group col-md-4" id="group-descuento">
	        		<label for="descuento"><strong>Descuento:</strong></label>
	        		<input type="number" class="form-control" id="descuento" min="0" step="0.1" />
	        </div>
	        <div class="form-group col-md-4" id="group-fecinicio">
	        		<label for="fecinicio"><strong>Inicio:</strong></label>
	        		<input type="date" class="form-control" id="fecinicio" />
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
