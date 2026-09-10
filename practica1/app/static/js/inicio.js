// EN JQUERY
$( () => {

    carga_productos();
    carga_promociones();
    
    // Evento de confirmar baja
    $("#btn-confirmar-baja").click(e => {
        alert("secondary", "Borrando promocion...");

        // Llamado a WS que borra
        $.ajax({
            "url" : appData.uri_ws + "back/borrapromo",
            "dataType" : "json",
            "type" : "post", 
            "data" : {
                "idpromocion" : appData.idpromocion
            }
        })
        .done(obj => {
            alert(obj.resultado ? "warning" : "danger", obj.mensaje);
            $("#tr-"+appData.idpromocion).remove(); // borrar elemento html (row)
            $(".alert-secondary").fadeOut(300);

            if ($("#tabla-promociones tbody tr").length == 0) {
                $("#tabla-promociones").fadeOut(1000);
                alert("danger", "No hay promociones");
            }

        })
        .fail(error_ajax);
    });

    // Evento del botón AGREGAR
    $("#btn-agregar").click(e => {
        appData.idpromocion = 0;
        appData.accion = "alta";

        $("#modal-editar-accion")
        .html("")
        .append($("<i>", {
            "class" : "fa fa-solid fa-cart-plus fa-2x me-2"
        }))
        .append("Agregar")

        $("#modal-editar .modal-header")
        .removeClass("bg-primary")
        .addClass("bg-success");

        $("#idproducto").val(0);
        $("#precio").val("0.00");
        $("#existencia").val("0");
        $("#descuento").val("0.0");
        $("#fecinicio").val("");

    });

    // Evento submit del formulario (botón GUARDAR)
    $("#form-promocion").submit(e => {
        e.preventDefault();
        borra_mensajes();

        // VALIDACIÓN DE FORMULARIO
        if( $( "#idproducto" ).val() == 0 ) {
            error_formulario( "idproducto", "Debes seleccionar producto" );
            return false;
        }
        else if( $( "#precio" ).val() <= 0 ) {
            error_formulario( "precio", "Debes escribir precio" );
            return false;
        }
        else if( $( "#fecinicio" ).val() == "" ) {
            error_formulario( "fecinicio", "Debes seleccionar fecha" );
            return false;
        }

        $.ajax({
            "url"      : appData.uri_ws + "back/actualizapromo",
            "dataType" : "json",
            "type"     : "post", 
            "data"     : {
                "accion"      : appData.accion,
                "idpromocion" : appData.idpromocion,
                "idproducto"  : $("#idproducto").val(),
                "precio"      : $("#precio").val(),
                "existencia"  : $("#existencia").val(),
                "descuento"   : $("#descuento").val(),
                "fecinicio"   : $("#fecinicio").val()
            }
        })
        .done(obj => {
            alert(obj.resultado ? "info" : "danger", obj.mensaje);
            carga_promociones();
        })
        .fail(error_ajax);

        $("#modal-editar").modal("toggle");
        return true;
    });

    // Evento botón JSON
    $("#btn-json").click( e => {
        $.ajax({
            "url": appData.uri_ws + "back/promociones",
            "dataType": "json"
        })
        .done(obj => {
            $("#modal-formato-body").html(JSON.stringify(obj.promociones));
        })
        .fail(error_ajax);
    });

    // Evento botón XML
    $("#btn-xml").click( e => {
        $.ajax({
            "url": appData.uri_ws + "back/promociones",
            "dataType": "xml",
            "type" : "post",
            "data" : {
                "formato" : "xml"
            }
        })
        .done(response => {
            $("#modal-formato-body").text(new XMLSerializer().serializeToString(response));
        })
        .fail(error_ajax);
    });

    // Eventos para borrar mensajes
    $("input, select, button")
    .click(borra_mensajes)
    .change(borra_mensajes);


}) // FIN DEL JQUERY

// FUNCIONES EXTERNAS DE USUARIOS
const carga_promociones = () => {
    $("#tabla-promociones").hide;
    $("#tabla-promociones tbody tr").remove();
    alert("secondary", "cargando promociones...");

    $.ajax({
        "url": appData.uri_ws + "back/promociones",
        "dataType": "json"

    })
    .done(obj => {
        //console.log(obj);

        if (obj.resultado) {
            $("#tabla-promociones").show;
            // llenar la tabla
            obj.promociones.map(row => {
                $("#tabla-promociones tbody").append(
                    '<tr id ="tr-'+ row.idpromocion +'" class="'+ (row.vigente == 1 ? 'table-success' : '') +'">'  +
                    '<td>'  + row.nomproducto + '</td>' +
                    '<td class="text-end">$' + parseFloat(row.precio).toLocaleString("es-MX", {minimumFractionDigits:2}) + '</td>' +
                    '<td class="text-end">'  + parseFloat(row.existencia).toLocaleString("es-MX") + '</td>' +
                    '<td class="text-end">'  + parseFloat(row.descuento).toLocaleString("es-MX", {minimumFractionDigits:1}) + '%</td>' +
                    '<td class="text-center">'  + fecha_fancy(row.fecinicio) + '</td>' +
                    '<td class="text-center">'  + '<div class="form-check form-switch"> <input data-idpromocion="'+ row.idpromocion +'" type="checkbox" role="switch" class="form-check-input switch-vigencia" ' + (row.vigente == 1 ? 'checked' : '')  +' />  </div>' + '</td>' +
                    '<td class="text-center">'  + 
                        '<button class="btn btn-primary btn-sm btn-editar" data-bs-toggle="modal" data-bs-target="#modal-editar"   data-idpromocion="'+ row.idpromocion +'"> <i class="fa fa-solid fa-edit"  data-idpromocion="'+ row.idpromocion +'"></i> </button>' +
                        '<button class="ms-2 btn btn-danger btn-sm btn-borrar" data-bs-toggle="modal" data-bs-target="#modal-baja" data-idpromocion="'+ row.idpromocion +'"> <i class="fa fa-solid fa-trash" data-idpromocion="'+ row.idpromocion +'"></i> </button>' + 
                    '</td>' +
                    '</tr>'
                );

            }); // Fin del map que llena la tabla


            // Crear eventos de objetos creados "al vuelo"

            // Evento click botones borrar
            $(".btn-borrar").click(e => {
                let idpromocion = $(e.target).attr("data-idpromocion");
                appData.idpromocion = idpromocion;
            });
            // Evento click botones editar
            $(".btn-editar").click(e => {
                let idpromocion = $(e.target).attr("data-idpromocion");
                appData.idpromocion = idpromocion;
                appData.accion = "cambio";

                $("#modal-editar-accion")
                .html("")
                .append($("<i>", {
                    "class" : "fa fa-solid fa-edit fa-2x me-2"
                }))
                .append("Editar")

                $("#modal-editar .modal-header")
                .removeClass("bg-success")
                .addClass("bg-primary")

                // Recuperar datos de UN registro
                $.ajax({
                    "url" : appData.uri_ws + "back/promocion",
                    "dataType" : "json",
                    "type" : "post", 
                    "data" : {
                        "idpromocion" : idpromocion
                    }
                })
                .done(obj => {
                    if (obj.resultado) {
                        // Llenar formulario
                        $("#idproducto").val(obj.promocion.idproducto);
                        $("#precio").val(obj.promocion.precio);
                        $("#existencia").val(obj.promocion.existencia);
                        $("#descuento").val(obj.promocion.descuento);
                        $("#fecinicio").val(obj.promocion.fecinicio);

                    } else {
                        alert("danger", obj.mensaje);
                        $("#modal-editar").modal("toggle");
                    }
                })
                .fail(error_ajax);

            });

            // Evento clcik switch cambiar vigencia
            $(".switch-vigencia").click(e => {
                alert("secondary", "Actualizando...");
                let boton = $(e.target)
                boton.prop("disabled", true);
                let idpromocion = $(e.target).attr("data-idpromocion");
                $.ajax({
                    "url" : appData.uri_ws + "back/cambiavigencia",
                    "dataType" : "json",
                    "type" : "post",
                    "data" : {
                        "idpromocion" : idpromocion
                    }
                })
                .done(obj => {
                    if (obj.resultado) {
                        let renglon = $("#tr-"+idpromocion);
                        if ( renglon.hasClass("table-success") ) {
                            renglon.removeClass("table-success");
                        } else {
                            renglon.addClass("table-success");
                        }
                        alert("success", obj.mensaje);
                    } else {
                        alert("danger", obj.mensaje);
                    }
                    $(".alert-secondary").fadeOut(300);
                    boton.prop("disabled", false);
                })
                .fail(error_ajax);

                $(".alert-secondary").fadeOut(300);
                boton.prop("disabled", false);
            });

            alert("primary", obj.mensaje)
        } else {
            alert("danger", obj.mensaje);
        }

        $(".alert-secondary").fadeOut(300);
    })
    .fail(error_ajax);
}


const carga_productos = () => {
    $.ajax({
        "url" : appData.uri_ws + "back/productos",
        "dataType" : "json"
    })
    .done(obj => {
        if (obj.resultado) {
            obj.productos.map(row => {
                $("#idproducto").append($("<option>",{
                    "value" : row.idproducto,
                    "text" : row.nomproducto
                }));
            });
        }
    })
    .fail(error_ajax);
}