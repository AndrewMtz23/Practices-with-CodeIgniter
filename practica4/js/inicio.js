var mapa;
var marcadores = []; // -> Agregar arreglo para guardar las coordenadas del marcador

var creamapa = () => {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(pos => {
            mapa = new google.maps.Map(
                document.getElementById("divmapa"), {
                    center: {
                        lat: pos.coords.latitude,
                        lng: pos.coords.longitude
                    },
                    zoom: 12 // -> Con 11 se ve muy chiquillo cuando inicio, se la puse en 12 ajsajajd
                }
            );

            mapa.addListener("click", e => { // -> Agregar evento CLICK del mapa
                // -> Dibujar marcador en mapa y agregar objeto al arreglo
                marcadores.push(
                    new google.maps.Marker({
                        map: mapa,
                        position: e.latLng,
                        icon: "https://maps.google.com/mapfiles/kml/pushpin/grn-pushpin.png"
                    })
                );

                // -> Agregar posición al selector
                $("#posiciones").append($("<option>", {
                    text: e.latLng
                }));
            });
        });
    } else {
        alert("danger", "Tu navegador no permite la geolocalización");
    }
}

$(() => { // SE PROGRAMA LA WEA DE EVENTOS DESDE JQUERY

    $("#btn-animar").click(e => { // -> CLICK de Animar
        borra_mensajes();

        // -> Obtener la posición del marcador
        let indice = $("#posiciones").prop("selectedIndex");

        // -> Validar que exista el elemento seleccionado
        if (indice >= 0) {
            // -> Cambiar la animación del marcador
            marcadores[indice].setAnimation(google.maps.Animation.BOUNCE);

            // -> Inhabilita y "deselecciona" la opción seleccionada
            $("#posiciones option:selected").prop("disabled", true).prop("selected", false);
        } else {
            error_formulario("posiciones", "Debes seleccionar alguna posición");
        }
    });

    $("#btn-eliminar").click(e => { // -> CLICK de Eliminar
        borra_mensajes();

        let indice = $("#posiciones").prop("selectedIndex"); // -> Obtener la posición del marcador

        // -> Validar que exista el elemento seleccionado
        if (indice >= 0) {
            marcadores[indice].setMap(null); // -> Borrar marcador del mapa
            marcadores.splice(indice, 1); // -> Eliminar el objeto del arreglo
            $("#posiciones option:selected").remove(); // -> Eliminar la opción del selector
        } else {
            error_formulario("posiciones", "Debes seleccionar Alguna Posición");
        }
    });

    $("#btn-detener").click(e => { // -> CLICK de Detener
        marcadores.map(marcador => { // -> Ciclo por todos los marcadores
            marcador.setAnimation(null);
        });

        $("#posiciones option").prop("disabled", false); // -> Habilitar posiciones inhabilitadas
    });

    $("input", "select").click(borra_mensajes).focus(borra_mensajes);
});
