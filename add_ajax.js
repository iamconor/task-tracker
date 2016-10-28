//add_ajax.js
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
		$.ajax({
			type	: 'POST',
			url		: 'add_task.php',
			data 	: inputData,
			dataType: 'json',
			encode	: true
		})

			.done(function(data){
				console.log(data);
				if(data.success == true)
				{
					$('#myModal').modal("hide");
					$("#alerts").empty();
					$("#alerts").append('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success! </strong>Task successfully added</div>');
					init();
				}
				else
				{
					$('#myModal').modal("hide");
					$("#alerts").empty();
					$("#alerts").append('<div class="alert alert-danger" data-dismiss="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error! </strong>Something went wrong adding the task.</div>');
				}
				init();	
			});

		event.preventDefault();

	});

});