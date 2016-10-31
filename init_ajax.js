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
					$("#masternav").toggleClass('hidden');
				}
				else
				{
					$("#masternav").toggleClass('show');
					$(".form-signin").hide();
					$(".navbar").show();
					$("#allBadge").text(data.status.All);
					$("#newBadge").text(data.status.New);
					$("#completeBadge").text(data.status.Complete);
					$("#progressBadge").text(data.status.InProgress);
					$("#leaderDropdown").empty();
					$("#participantsDropdown").empty();
					$("#leaderForm").empty();
					$("#participantsForm").empty();

					for (var i = 0; i < data.users.length; i++) {
						$("#leaderDropdown").append('<option>'+data.users[i]+'</option>');
						$("#participantsDropdown").append('<option>'+data.users[i]+'</option>');
						$("#leaderForm").append('<option>'+data.users[i]+'</option>');
						$("#participantsForm").append('<option>'+data.users[i]+'</option');						
					}

					buildTasks(data);

				}
				
			});

		
}

function userTasks(name, role)
{
		var inputData = {
			'name'		: name,
			'role'		: role
		};
			$.ajax({
			type	: 'POST',
			url		: 'get_user_tasks.php',
			data 	: inputData,
			dataType: 'json',
			encode	: true
		})

			.done(function(data){
				console.log(data);
				if(data.success == true)
				{
					console.log(data);
					buildTasks(data);
				}
					
			});

		event.preventDefault();

}

$(document).ready(function(){
    $("#leaderDropdown").change(function(){
        userTasks(this.value, "leader");
    });
});

$(document).ready(function(){
    $("#participantsDropdown").change(function(){
        userTasks(this.value, "participant");
    });
});

$(document).ready(function() {

	init();

});
