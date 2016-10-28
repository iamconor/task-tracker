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
					$("#allBadge").text(data.status.All);
					$("#newBadge").text(data.status.New);
					$("#completeBadge").text(data.status.Complete);
					$("#progressBadge").text(data.status.InProgress);

					for (var i = 0; i < data.users.length; i++) {
						$("#leader").append('<li><a href="#">'+data.users[i]+'</a></li>');
						$("#participants").append('<li><a href="#">'+data.users[i]+'</a></li>');
						$("#leaderForm").append('<option>'+data.users[i]+'</option>');
						$("#participantsForm").append('<option>'+data.users[i]+'</option');						
					}

					buildTasks(data);

				}
				console.log(data);
			});

		event.preventDefault();	
}

$(document).ready(function() {

	init();

});
