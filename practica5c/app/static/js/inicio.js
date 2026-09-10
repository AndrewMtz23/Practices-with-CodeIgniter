var mapa, marcador;

$(() => {
  carga_alumnos();

  // -> Click de GUARDAR
  $("#btn-guardar").click(e => {
    alert("secondary", "Guardando posición...");

    $.ajax({
      url: appData.uri_ws + "back/actualizaposicion",
      dataType: "json",
      type: "post",
      data: {
        matricula: appData.matricula,
        latitud: marcador.getPosition().lat(),
        longitud: marcador.getPosition().lng()
      }
    })
    .done(obj => {
      if (obj.resultado) {
        $("#btn-guardar").prop("disabled", true);
        marcador.setIcon("https://maps.google.com/mapfiles/kml/paddle/purple-circle.png");
        $("#mensaje-mapa").html("Mueve el Globo para Actualizar la posición");
        alert("success", obj.mensaje);
        
        $("#modal-mapa").data('saved', true);
        $("#modal-mapa").data('markerMoved', false);
      } else {
        alert("danger", obj.mensaje);
      }
      $(".alert-secondary").fadeOut(700);
    })
    .fail(error_ajax);
    $(".alert-secondary").fadeOut(700);
  });

  // -> Le Agrego esto para que previene el cierre de la modal si no se ha guardado
  $('#modal-mapa').on('hide.bs.modal', function (e) {
    if ($(this).data('markerMoved') && !$(this).data('saved')) {
      e.preventDefault();
      e.stopImmediatePropagation();
      alert('warning', 'Necesitas guardar la posición antes de cerrar.');
      return false;
    }
    $(this).data('saved', false);
    $(this).data('markerMoved', false);
  });

  // -> Evento para resetear estados al abrir el modal
  $('#modal-mapa').on('show.bs.modal', function (e) {
    $(this).data('saved', true);
    $(this).data('markerMoved', false);
  });

  // -> Evento Borrar Mensajes
  $("input, select, button")
    .click(borra_mensajes)
    .change(borra_mensajes);
});

// -> Funciones externas de usuario
const carga_alumnos = () => {
  $("#tabla-alumnos").hide();
  $("#tabla-alumnos tbody tr").remove();
  alert("secondary", "Cargando alumnos...");
  $.ajax({
    url: appData.uri_ws + "back/alumnos",
    dataType: "json"
  })
  .done(obj => {
    if (obj.resultado) {
      $("#tabla-alumnos").show();
      obj.alumnos.map(row => {
        $("#tabla-alumnos tbody").append(
          '<tr id="tr-' + row.matricula + '">' +
          '<td class="text-center">' + row.matricula + '</td>' +
          '<td class="td-nombre-completo">' + row.appaterno + ' ' + row.apmaterno + ' ' + row.nombre + '</td>' +
          '<td class="text-center">' + row.sexo + '</td>' +
          '<td class="text-center">' + row.edad + '</td>' +
          '<td class="text-center">' +
          '<button class="ms-2 btn btn-info btn-sm btn-mapa-alumno" ' +
          'data-bs-toggle="modal" data-bs-target="#modal-mapa" data-matricula="' + row.matricula + '">' +
          '<i class="fa fa-solid fa-earth fa-2x" data-matricula="' + row.matricula + '"></i>' +
          '</button>' +
          '</td>' +
          '</tr>'
        );
      });

      $(".btn-mapa-alumno").click(e => {
        let matricula = $(e.target).attr("data-matricula");
        let nombre = $("#tr-" + matricula + " .td-nombre-completo").html();
        appData.matricula = matricula;

        $("#modal-mapa-titulo")
          .html("")
          .append($("<i>", {
            class: "fa-solid fa-earth fa-2x me-2"
          }))
          .append("Posición de " + nombre);
        $("#div-grafica").html("");

        alert("secondary", "Cargando Geodatos...");
        $.ajax({
          url: appData.uri_ws + "back/alumno",
          dataType: "json",
          type: "post",
          data: {
            matricula: matricula
          },
          async: true
        })
        .done(obj => {
          if (obj.resultado) {
            mapa.setZoom(13);
            $("#btn-guardar").prop("disabled", true);

            if (marcador != null) {
              marcador.setMap(null);
              marcador = null;
            }

            let latitud = obj.alumno.latitud;
            let longitud = obj.alumno.longitud;

            if (latitud == null || longitud == null) {
              navigator.geolocation.getCurrentPosition(pos => {
                mapa.setCenter({
                  lat: pos.coords.latitude,
                  lng: pos.coords.longitude
                });
                setTimeout(() => {
                  mapa.setZoom(16);
                }, 1000);
              });

              $("#mensaje-mapa").html("Haz Click para crear una Posición en el Mapa");

              mapa.addListener("click", e => {
                creaMarcador(e.latLng);
                google.maps.event.clearListeners(mapa, "click");
              });
            } else {
              let pos = {
                lat: parseFloat(latitud),
                lng: parseFloat(longitud)
              };
              setTimeout(() => {
                mapa.panTo(pos);
                setTimeout(() => {
                  mapa.setZoom(16);
                }, 1000);
              }, 1000);

              creaMarcador(pos);
            }
          } else {
            $("#modal-mapa").modal("hide");
            alert("danger", obj.mensaje);
          }
          $(".alert-secondary").fadeOut(700);
        })
        .fail(error_ajax);
      });

      alert("primary", obj.mensaje);
    } else {
      alert("danger", obj.mensaje);
    }

    $(".alert-secondary").fadeOut(700);
  })
  .fail(error_ajax);
}

var creaMarcador = pos => {
  marcador = new google.maps.Marker({
    map: mapa,
    position: pos,
    icon: "https://maps.google.com/mapfiles/kml/paddle/purple-circle.png",
    draggable: true
  });
  $("#mensaje-mapa").html("Mueve el Globo para Actualizar la Posición");

  marcador.addListener("drag", e => {
    marcador.setIcon("https://maps.google.com/mapfiles/kml/paddle/ylw-circle.png");
    $("#mensaje-mapa").html("Presiona Guardar");
    $("#btn-guardar").prop("disabled", false);
    $("#modal-mapa").data('markerMoved', true);
    $("#modal-mapa").data('saved', false);
  });
}

var cargamapa = () => {
  mapa = new google.maps.Map(
    document.getElementById("mapa"), {
      center: {
        lat: 20.65,
        lng: -100.4
      },
      zoom: 13
    }
  );
}