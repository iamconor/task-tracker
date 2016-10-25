//login-ajax.js
$(document).ready(function () {

	$('.form-signin').submit(function(event) {
		var inputData = {
			'username'	: $('#username').val(),
			'password'		: $('#password').val()
		};
		console.log(inputData);
		$.ajax({
			type	: 'POST',
			url		: 'login_process.php',
			data 	: inputData,
			dataType: 'json',
			encode	: true
		})

			.done(function(data){
				console.log(data);
				if(!data.success)
				{
					$("#alerts").empty();
					if(data.errors.username)
					{
						$("#alerts").append('<div class="alert alert-danger" data-dismiss="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error! </strong>'+data.errors.username+'</div>');
					}
					if(data.errors.password)
					{
						$("#alerts").append('<div class="alert alert-danger" ><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error! </strong>'+data.errors.password+'</div>');
					}
				}
				else
				{
					$("#alerts").empty();
					$(".form-signin").hide();
					$("#alerts").append('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success! </strong>'+data.message+'</div>');
					$( ".alert-success" ).fadeOut( "slow", function() {
					    // Animation complete.
					  });
					init();
				}
			});

		event.preventDefault();

	});

});