//login-ajax.js
$(document).ready(function () {

		$.ajax({
			url		: 'home.php',
			dataType: 'json',
			encode	: true
		})

			.done(function(data){
				console.log(data);
			});

		event.preventDefault();

});