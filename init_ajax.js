//login-ajax.js
function init()
{
			$.ajax({
			url		: 'home.php',
			dataType: 'json',
			encode	: true
		})

			.done(function(data){
				if(!data.session.username)
				{
					$(".navbar").hide();
				}
				else
				{
					$(".form-signin").hide();
					$(".navbar").show();
				}
			});

		event.preventDefault();	
}

$(document).ready(function() {

	init();

});
