//login-ajax.js
$(document).ready(function () {

	$('.form-task').submit(function(event) {
		var inputData = {
			'title'			: $('#title').val(),
			'leader'		: $("#leaderForm").val(),
			'participants'	: $("#participantsForm").val(),
			'summary'		: $('#summary').val(),
			'date'			: $('#date').val(),
			'url'			: $('#url').val()
		};
		console.log(inputData);
		$.ajax({
			type	: 'POST',
			url		: 'add_task.php',
			data 	: inputData,
			dataType: 'json',
			encode	: true
		})

			.done(function(data){
				console.log(data);
				if(!data.success)
				{
				}
				else
				{
				}
			});

		event.preventDefault();

	});

});