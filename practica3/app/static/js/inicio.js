$( () => {
    // -> Carga la lista de alumnos al iniciar la página
    carga_alumnos();

    // -> Manejamos la wea dl evento de confirmar la baja de un alumno
    $("#btn-confirmar-baja").click(e => {
        alert("secondary", "Borrando alumno");
        $.ajax({
            "url" : appData.uri_ws + "back/borraalumno",
            "dataType" : "json",
            "type" : "post", 
            "data" : {
                "matricula" : appData.matricula
            }
        })
        .done(obj => {
            alert(obj.resultado ? "warning" : "danger", obj.mensaje);
            $("#tr-"+appData.matricula).remove();
            $(".alert-secondary").fadeOut(300);

            // -> Verifica si no quedan alumnos después de borrar
            if ($("#tabla-alumnos tbody tr").length == 0) {
                $("#tabla-alumnos").fadeOut(1000);
                alert("danger", "No hay alumnos");
            }
        })
        .fail(error_ajax);
    });

    // -> Maneja el evento de agregar un nuevo alumno
    $("#btn-agregar").click(e => {
        appData.matricula = "";
        appData.accion = "alta";
        // -> Configura la interfaz para agregar un nuevo alumno
        $("#modal-editar-accion")
        .html("")
        .append($("<i>", {
            "class" : "fa fa-solid fa-user-plus fa-2x me-2"
        }))
        .append("Agregar")
        $("#modal-editar .modal-header")
        .removeClass("bg-primary")
        .addClass("bg-success");
        // -> Limpiamos los campos del formu
        $("#matricula").val("").prop("disabled", false);
        $("#appaterno").val("");
        $("#apmaterno").val("");
        $("#nombre").val("");
        $("#edad").val(0);
        $("#sexo-m, #sexo-f").prop("checked", false);
    });

    // -> Maneja el envío del formulario de alumno (alta o edición)
    $("#form-alumno").submit(e => {
        e.preventDefault();
        borra_mensajes();
        // -> Le metemos una validacion muy insana
        if( $( "#matricula" ).val() == 0 ) {
            error_formulario( "matricula", "Debes escribir matricula" );
            return false;
        }

        else if( $( "#appaterno" ).val() <= 0 ) {
            error_formulario( "appaterno", "Debes escribir apellido paterno" );
            return false;
        }

        else if( $( "#nombre" ).val() == "" ) {
            error_formulario( "nombre", "Debes escribir nombre" );
            return false;
        }

        else if( !$( "#sexo-m" ).prop("checked") && !$( "#sexo-f" ).prop("checked") ) {
            alert("danger", "Debes seleccionar sexo");
            return false;
        }
        // -> Envía los datos del alumno al servidor
        $.ajax({
            "url"      : appData.uri_ws + "back/actualizaalumno",
            "dataType" : "json",
            "type"     : "post", 
            "data"     : {
                "accion"    : appData.accion,
                "matricula" : $("#matricula").val(),
                "appaterno" : $("#appaterno").val(),
                "apmaterno" : $("#apmaterno").val(),
                "nombre"    : $("#nombre").val(),
                "sexo"      : $("#sexo-m").prop("checked") ? "M" : "F",
                "edad"      : $("#edad").val()
            }
        })
        .done(obj => {
            alert(obj.resultado ? "info" : "danger", obj.mensaje);
            carga_alumnos();
        })
        .fail(error_ajax);
        $("#modal-editar").modal("toggle");
        return true;
    });

    // -> Maneja el envío del formulario de calificaciones
    $("#form-calif").submit(e => {
        e.preventDefault();
        $.ajax({
            "url" : appData.uri_ws + "back/actualizacalificaciones",
            "dataType" : "json",
            "type"     : "post", 
            "data"     : {
                "matricula" : appData.matricula,
                "calif1" : $("#calif1").val(),
                "calif2" : $("#calif2").val(),
                "calif3" : $("#calif3").val(),
                "calif4" : $("#calif4").val(),
                "calif5" : $("#calif5").val()
            } //ya me canse de escribir xdd
        })
        .done(obj => {
            alert(obj.resultado ? "success" : "danger", obj.mensaje);
        })
        .fail(error_ajax)
        $("#modal-calif").modal("toggle");
        return true;
    });

    // -> Maneja el evento de mostrar gráfica de calificaciones de todos los alumnos
    $("#btn-graf-calif-todos").click(e => {
        $("#modal-grafica-titulo").html("Calificaciones de todos los alumnos");
        $("#div-grafica").html("");
        alert("secondary", "Cargando datos");
        let series = []
        // -> Obtiene datos de todos los alumnos
        $.ajax({
            url : appData.uri_ws + "back/alumnos",
            dataType: "json",
            async: false
        })
        .done(obj => {
            if (obj.resultado) {
                obj.alumnos.map(row => {
                    let data = []
                    // -> Obtiene calificaciones de cada alumno
                    $.ajax({
                        url: appData.uri_ws + "back/calificaciones",
                        dataType: "json",
                        type: "post",
                        data: {
                            matricula: row.matricula
                        },
                        async: false 
                    })
                    .done(obj => {
                        if (obj.resultado) {
                            obj.calificaciones.map(rowcalif => {
                                data.push(parseFloat(rowcalif.calificacion));
                            });
                        }
                    })
                    .fail(error_ajax)
                    series.push({
                        name: row.appaterno+" "+row.apmaterno+" "+row.nombre,
                        data: data
                    });
                });
            }
        })
        .fail(error_ajax)
        grafica_calificaciones("Calificaciones de todos", series);
        $(".alert-secondary").fadeOut(300);
    });

    // -> Maneja el Evento de mostrar gráfica de rangos de edad por sexo
    $("#btn-graf-edad").click(e => {
        $("#modal-grafica-titulo").html("Rangos de edad por sexo");
        $("#div-grafica").html("");
        alert("secondary", "Cargando gráfica");
        let aseries = [{
            nombre: "Masculino",
            valor: "M"
        },{
            nombre: "Femenino",
            valor: "F"
        }];
        let series = []
        aseries.map(serie => {
            let data = [];
            for (let rango = 1; rango <= 11; rango++) {
                // -> Obtiene datos de rango de edad por sexo
                $.ajax({
                    url: appData.uri_ws + "back/rangoedad",
                    dataType: "json",
                    type: "post",
                    data: {
                        rango: rango,
                        sexo: serie.valor
                    },
                    async: false
                })
                .done(obj => {
                    let numalu = parseInt(obj.alumnos);
                    data.push(numalu * (serie.valor == "M" ? -1 : 1));
                })
                .fail(error_ajax);
            }
            series.push({
                name: serie.nombre,
                data: data
            });
        });
        $( "#mensajes .alert-secondary" ).fadeOut( 700 );
        grafica_rangos(series);
    });

    // -> Maneja el evento de mostrar gráfica de periodos de calificaciones
    $("#btn-graf-periodo").click(e => {
        $("#modal-grafica-titulo").html("Periodos de Calificaciones");
        $("#div-grafica").html("");
        alert("secondary", "Cargando gráfica...");
        
        let series = [{
            name: "Autónomo",
            data: []
        }, {
            name: "Destacado",
            data: []
        }, {
            name: "Satisfactorio",
            data: []
        }, {
            name: "No acreditado",
            data: []
        }];
        
        let labels = ["AU", "DE", "SA", "NA"];
        let promises = [];
        
        for (let idcalif = 1; idcalif <= 5; idcalif++) {
            labels.forEach((grado, index) => {
                promises.push(
                    $.ajax({
                        url: appData.uri_ws + "back/periodo/",
                        dataType: "json",
                        type: "post",
                        data: {
                            periodo: idcalif,
                            grado: grado
                        }
                    }).done(obj => {
                        console.log(`Periodo: ${idcalif}, Grado: ${grado}, Datos:`, obj);
                        if (obj.resultado) {
                            series[index].data[idcalif - 1] = parseInt(obj.registros);
                        } else {
                            series[index].data[idcalif - 1] = 0;
                        }
                    })
                );
            });
        }
        
        Promise.all(promises).then(() => {
            $("#mensajes .alert-secondary").fadeOut(700);
            grafica_periodos(series);
        }).catch(error_ajax);
    });

    // -> Borra mensajes al interactuar con elementos de la interfaz
    $("input, select, button")
    .click(borra_mensajes)
    .change(borra_mensajes);
}) 

// -> Función para cargar la lista de alumnos
const carga_alumnos = () => {
    $("#tabla-alumnos").hide;
    $("#tabla-alumnos tbody tr").remove();
    alert("secondary", "cargando alumnos");
    $.ajax({
        "url": appData.uri_ws + "back/alumnos",
        "dataType": "json"

    })
    .done(obj => {
        if (obj.resultado) {
            $("#tabla-alumnos").show;
            obj.alumnos.map(row => {
                $("#tabla-alumnos tbody").append(
                    '<tr id ="tr-'+ row.matricula +'">'  +
                    '<td class="text-center">'  + row.matricula  + '</td>' +
                    '<td class="text-center">'  + row.appaterno + ' ' + row.apmaterno + ' ' + row.nombre + '</td>' +
                    '<td class="text-center">'  + row.sexo + '</td>' +
                    '<td class="text-center">'  + row.edad + '</td>' +

                    '<td class="text-center">'  + 
                        '<button class="btn btn-primary btn-sm btn-editar" data-bs-toggle="modal" data-bs-target="#modal-editar"   data-matricula="'+ row.matricula +'"> <i class="fa fa-solid fa-edit"  data-matricula="'+ row.matricula +'"></i> </button>' +
                        '<button class="ms-2 btn btn-danger btn-sm btn-borrar" data-bs-toggle="modal" data-bs-target="#modal-baja" data-matricula="'+ row.matricula +'"> <i class="fa fa-solid fa-trash" data-matricula="'+ row.matricula +'"></i> </button>' +
                        
                        '<button class="ms-2 btn btn-warning btn-sm btn-calif" data-bs-toggle="modal" data-bs-target="#modal-calif" data-matricula="'         + row.matricula +'"> <i class="fa fa-solid fa-graduation-cap" data-matricula="'+ row.matricula +'"></i> </button>' + 
                        '<button class="ms-2 btn btn-info btn-sm btn-grafica-alumno" data-bs-toggle="modal" data-bs-target="#modal-grafica" data-matricula="' + row.matricula +'"> <i class="fa fa-solid fa-chart-line" data-matricula="'+ row.matricula +'"></i> </button>' +  
                    '</td>' +
                    '</tr>'
                );

            }); 

            // -> Maneja el evento de borrar un alumno
            $(".btn-borrar").click(e => {
                let matricula = $(e.target).attr("data-matricula");
                appData.matricula = matricula;
            });

            // -> Maneja el evento de editar un alumno
            $(".btn-editar").click(e => {
                let matricula = $(e.target).attr("data-matricula");
                appData.matricula = matricula;
                appData.accion = "cambio";

                // -> Configura la interfaz para editar un alumno
                $("#modal-editar-accion")
                .html("")
                .append($("<i>", {
                    "class" : "fa fa-solid fa-edit fa-2x me-2"
                }))
                .append("Editar")
                $("#modal-editar .modal-header")
                .removeClass("bg-success")
                .addClass("bg-primary")

                // -> Obtiene los datos del alumno para editar
                $.ajax({
                    "url" : appData.uri_ws + "back/alumno",
                    "dataType" : "json",
                    "type" : "post", 
                    "data" : {
                        "matricula" : matricula
                    }
                })
                .done(obj => {
                    if (obj.resultado) {
                        // -> Rellena el formulario con los datos del alumno
                        $("#matricula").val(obj.alumno.matricula).prop("disabled", true);
                        $("#appaterno").val(obj.alumno.appaterno);
                        $("#apmaterno").val(obj.alumno.apmaterno);
                        $("#nombre").val(obj.alumno.nombre);
                        $("#edad").val(obj.alumno.edad);
                        $("#sexo-m").prop("checked", obj.alumno.sexo == "M");
                        $("#sexo-f").prop("checked", obj.alumno.sexo == "F");
                    } else {
                        alert("danger", obj.mensaje);
                        $("#modal-editar").modal("toggle");
                    }
                })
                .fail(error_ajax);
            });

            // -> Maneja el evento de mostrar calificaciones de un alumno
            $(".btn-calif").click(e => { 
                let matricula = $(e.target).attr("data-matricula");
                appData.matricula = matricula;
                $.ajax({
                    "url" : appData.uri_ws + "back/calificaciones",
                    "dataType" : "json",
                    "type" : "post",
                    "data" : {
                        "matricula" : matricula
                    }
                })
                .done(obj => {
                    if (obj.resultado) {
                        // -> che pibe Rellenamos los campos de calificaciones
                        obj.calificaciones.map(row => {
                            $("#calif" + row.idcalif).val(row.calificacion);
                        });
                    }
                    else {
                        $(".input-calif").val("0.0");
                        alert("warning", obj.mensaje);
                    }
                })
                .fail(error_ajax)
            });
            
            // -> Maneja el evento de mostrar gráfica de calificaciones de un alumno
            $(".btn-grafica-alumno").click(e => {
                let matricula = $(e.target).attr("data-matricula");
                let nombre = $("#tr-" + matricula + " td:nth-child(2)").text().trim(); 
                $("#modal-grafica-titulo").html("Calificaciones de "+nombre);
                $("#div-grafica").html("");
                $.ajax({
                    url : appData.uri_ws + "back/calificaciones",
                    dataType: "json",
                    type: "post",
                    data: {
                        matricula: matricula
                    }
                })
                .done(obj => {
                    let data = []
                    
                    if (obj.resultado) {
                        obj.calificaciones.map(row => {
                            data.push(parseFloat(row.calificacion));
                        });
                    }

                    let series = [{
                        name: nombre,
                        data: data
                    }];
                    grafica_calificaciones(
                        $("#modal-grafica-titulo").html(),series);
                    })
                .fail(error_ajax)
            });

            alert("primary", obj.mensaje)
        } else {
            alert("danger", obj.mensaje);
        }

        $(".alert-secondary").fadeOut(300);
    })
    .fail(error_ajax);
}