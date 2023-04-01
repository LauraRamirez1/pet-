function validateContact() {
	var nombre = $('#nombre').val();
	var apellido= $('#apellido').val();
	var email = $('#email').val();
	var phone = $('#telefono').val();
	var pais = $('#pais').val();
	var contrasena = $('#password').val();

	var emailRgx = /^([a-zA-ZñÑ0-9_.+-])+\@(([a-zA-ZñÑ0-9-])+\.)+([a-zA-ZñÑ0-9]{2,4})+$/
	var phoneRgx = /[^0-9\+]/g

	if( !emailRgx.test(email) || phoneRgx.test(phone) || apellido.length < 1 || nombre.length < 1 || contrasena.length < 1 || pais.length < 1 ) {
		$('#field-error').css({display: 'block'})
		$('#submit').css({
			pointerEvents: 'initial',
			opacity: 1
		})
		return false;
	} else {
		$('#field-error').css({display: 'none'})
		return true;
	}

}

$('#submit').click(function(e) {

	e.preventDefault();

	$('#submit').css({
		pointerEvents: 'none',
		opacity: 0.7
	})

	if( !validateContact() ) {
		return false;
	}

});

