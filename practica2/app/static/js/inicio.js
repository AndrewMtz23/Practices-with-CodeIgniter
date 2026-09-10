var simbolo = ['circule', 'square', 'diamond', 'triangle', 'triangle-down'];

$( () => { // Ready de JQuery
    
    // CARGA de ciudades
    $.ajax({
        "url" : appData.uri_ws + "back/ciudades",
        "dataType" : "json"
    })
    .done(obj => {
        if (obj.resultado) {
            obj.ciudades.map(row => {
                $("#ciudad").append($("<option>", {
                    value: row.ciudad,
                    text : row.ciudad
                }));
            });
        }
        alert(obj.resultado ? "info" : "danger", obj.mensaje);
    })
    .fail(error_ajax)

    // EVENTO cuando selecciona ciudad
    $("#ciudad").change(e => {
        let ciudad = $(e.target).val();
        let indice = $(e.target).prop("selectedIndex");
        
        $.ajax({
            "url" : appData.uri_ws + "back/temperaturas",
            "dataType" : "json",
            "type" : "post",
            "data" : {
                "ciudad" : ciudad
            }
        })
        .done(obj => {
            if (obj.resultado) {
                //console.log(obj.temperaturas);

                // Crear el arreglo "series" para Highcharts
                let series = [];

                // Ciclo de temperaturas
                let data = [];
                obj.temperaturas.map(row =>{
                    // MUY IMPORTANTE Highcharts sólo acpeta NÚMEROS
                    let temperatura = parseFloat(row.temperatura);
                    if (temperatura >= 25) {
                        data.push({
                            y: temperatura,
                            marker: {
                                symbol: 'url(https://www.highcharts.com/samples/graphics/sun.png)'
                            }
                        });
                    } 
                    else if (temperatura <= 2) {
                        data.push({
                            y: temperatura,
                            marker: {
                                symbol: 'url(https://www.highcharts.com/samples/graphics/snow.png)'
                            }
                        });
                    }
                    else {
                        data.push({
                            y:temperatura,
                            marker: {}
                        });
                    }
                });
                //console.log(data);

                // Agregar la serie de la ciudad elegida
                series.push({
                    name: ciudad,
                    marker: {
                        symbol: simbolo[indice]
                    },
                    data: data
                });

                // ACtualizar el objeto gráfica
                migrafica.update({
                    series: series
                });

                alert("info", obj.mensaje)
            } else {
                alert("danger", obj.mensaje)
            }
        })
        .fail(error_ajax);
    });

}); // Fin del $.ready