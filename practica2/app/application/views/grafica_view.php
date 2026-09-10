<script>
	var appData = {
		uri_app     : "<?= base_url() ?>",
		uri_ws      : "<?= base_url() ?>../webservice/"
	}
</script>

<div class="d-flex">

    <div class="form-group">
        <label for="ciudad"><strong>Ciudad:</strong></label>
        <select class="form-select" id="ciudad">
            <option value="">-- Selecciona ciudad --</option>
        </select>
    </div>

    <figure class="highcharts-figure">
        <div id="container"></div>
        <p class="highcharts-description">
            Este gráfico muestra cómo pueden utilizarse los símbolos y las formas en los gráficos.
            Highcharts incluye varias formas de símbolos comunes, como cuadrados
            círculos y triángulos, pero también es posible añadir sus propios
            símbolos personalizados. En este gráfico, se utilizan símbolos meteorológicos personalizados en
            puntos de datos para resaltar que ciertas temperaturas son cálidas
            otras son frías.
        </p>
    </figure>

</div>