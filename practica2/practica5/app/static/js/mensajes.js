// FUNCIONES EXTERNAS DE JAVASCRIPT
const alert = ( tipo, texto ) => {
	if ( $( "#mensajes" ).length == 0 ) {
		$( "body" ).append( $( "<div>", {
			"id"    : "mensajes",
			"class" : "position-fixed d-flex flex-column-reverse"
		}));
		$( "#mensajes" )
			.css( "bottom", "30px" )
			.css( "right",  "30px" );
	}

	icono = "";
	switch( tipo ) {
		case "primary"   : icono = "circle-play"; 	 		break; 
		case "secondary" : icono = "spinner fa-spin"; 		break; 
		case "success"   : icono = "check-circle"; 	 		break; 
		case "danger"    : icono = "times-circle"; 	 		break; 
		case "warning"   : icono = "triangle-exclamation"; break; 
		case "info"      : icono = "info-circle"; 			break; 
		case "light"     : icono = ""; 							break; 
		case "dark"      : icono = "stop-circle"; 			break; 
		default          : tipo = "light"; 						break;
	}

	$( "#mensajes" ).append( '<div class="alert alert-' + 
		tipo + ' alert-dismissible fade show mt-1 mb-0" role="alert"><i class="fa-solid fa-' + 
		icono + ' fa-2x me-2"></i>' + 
		texto + '.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>' );

	setTimeout( () => {
		$( "#mensajes .alert" ).fadeOut( 2000 );
	}, 5000 );
}

const error_ajax = () => {
	alert( "danger", "Error en AJAX" );
}

const error_formulario = ( campo, mensaje ) => {
	$( "#" + campo ).addClass( "is-invalid" );
	$( "#group-" + campo ).append( $( "<div>", {
		"text"  : mensaje,
		"class" : "invalid-feedback"
	}));
}

const borra_mensajes = () => {
	$( ".is-valid, .is-invalid" ).removeClass( "is-invalid is-invalid" );
	$( ".valid-feedback, .invalid-feedback" ).remove();
}

const fecha_fancy = fecha => {
	// Convierte fecha a formato dd-mm-yyyy

	afecha = fecha.split( "-" );
	ames = ["ene", "feb", "mar", "abr", "may", "jun", "jul", "ago", "sep", "oct", "nov", "nov", "dic"];

	return afecha[2] + "-" + ames [afecha[1] -1]+ "-" + afecha[0];
}