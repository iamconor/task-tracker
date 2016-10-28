function updateModal(id, status)
{
	stati = ["New", "In Progress", "Complete"];
	
	$('#taskStatus').find('option').remove().end();

	for(var i = 0; i < stati.length; i++)
	{
		if(stati[i] !== status)
		{
			$('#taskStatus').append('<option value="'+stati[i]+'"">'+stati[i]+'</option>');
		}
	}

	$("#taskID").val(id);
	$('#updateModal').modal();
	
}