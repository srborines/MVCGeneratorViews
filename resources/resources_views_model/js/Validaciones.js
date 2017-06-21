function comprobarText(campo,size) {
	var element = document.getElementById(campo.name + "_comprobarText_error")
	if (typeof(element) != 'undefined' && element != null){
		campo.classList.remove('red');
		document.getElementById(campo.name + "_comprobarText_error").remove();
	}
	if (campo.value.length>size) {
			campo.classList.add('red');
			var message = 'Longitud incorrecta. El atributo ' + campo.name + 'debe ser maximo ' + size + ' y es ' + campo.value.length;
			campo.outerHTML = campo.outerHTML + "<span id='" + campo.name + "_comprobarText_error' class='span_error' style='color:red;'> " + message + " </span>";
    	campo.focus();
		return false;
	}
	return true;
}

	function comprobarInt(campo,size) {
		var element = document.getElementById(campo.name + "_comprobarInt_error")
		if (typeof(element) != 'undefined' && element != null){
			campo.classList.remove('red');
			document.getElementById(campo.name + "_comprobarInt_error").remove();
		}

		if (campo.value.length>size) {
				campo.classList.add('red');
				valormaximo = (10 ** size) -1;
				var message = 'Longitud incorrecta. El atributo ' + campo.name + 'debe ser maximo ' + valormaximo + ' y es ' + campo.value;
				campo.outerHTML = campo.outerHTML + "<span id='" + campo.name + "_comprobarInt_error' class='span_error' style='color:red;'> " + message + " </span>";
        campo.focus();
				return false;
		}else if(isNaN(campo.value)){
			campo.classList.add('red');
			var message = 'Tipo de valor incorrecto. El atributo ' + campo.name + 'debe ser un número';
			campo.outerHTML = campo.outerHTML + "<span id='" + campo.name + "_comprobarInt_error' class='span_error' style='color:red;'> " + message + " </span>";
			campo.focus();
			return false;
		}
		return true;
	}

	function esVacio(campo){
		if ((campo.value == null) || (campo.value.length == 0)){
			if(!campo.classList.contains('red')){
				campo.classList.add('red');
				campo.outerHTML = campo.outerHTML + "<span id='" + campo.name + "_esVacio_error'class='span_error' style='color:red;'> El atributo "  + campo.name + " no puede ser vacio </span>";
				campo.focus();
			}
			return false;
		}
		var element = document.getElementById(campo.name + "_esVacio_error")
		if (typeof(element) != 'undefined' && element != null){
			campo.classList.remove('red');
			document.getElementById(campo.name + "_esVacio_error").remove();
		}
		return true;
	}
