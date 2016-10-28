//add_ajax.js
$(document).ready(function () {

	$('.form-update').submit(function(event) {
		var inputData = {
			'id'			: $('#taskID').val(),
			'status'		: $("#taskStatus").val()
		};
		$.ajax({
			type	: 'POST',
			url		: 'update_task.php',
			data 	: inputData,
			dataType: 'json',
			encode	: true
		})

			.done(function(data){
				console.log(data);
				if(data.success == true)
				{
					init();
					$('#updateModal').modal("hide");
				}
					
			});

		event.preventDefault();

	});

});