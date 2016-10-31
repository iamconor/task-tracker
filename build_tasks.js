function buildTasks(data)
{
	$("#tasks").empty();
	for(var i = 0; i < data.tasks.length; i++)
	{	

		html = '<div class="container">';
		switch(data.tasks[i].status) {
	    case "New":
	        html = html + '<div class="well well-new">';
	        break;
	    case "In Progress":
	        html = html + '<div class="well well-progress">';
	        break;
	    case "Complete":
	        html = html + '<div class="well well-complete">';
	        break;
	    default:
	       html = html + '<div class="well">';
	    }
		html = html + '<strong>Task ID: </strong>'+data.tasks[i].id+'<br>';
		html = html + '<strong>Title: </strong>'+data.tasks[i].title+'<br>';
		html = html + '<strong>Leader: </strong>'+data.tasks[i].leader+'<br>';
		html = html + '<strong>Participants: </strong>'+data.tasks[i].participants.join()+'<br>';
		html = html + '<strong>Status: </strong>'+data.tasks[i].status+'<br>';
		html = html + '<strong>Summary: </strong>'+data.tasks[i].summary+'<br>';
		html = html + '<strong>Target Date: </strong>'+data.tasks[i].targetDate+'<br>';
		html = html + '<strong>URL: </strong><a href="http://'+data.tasks[i].url+'">'+data.tasks[i].url+'</a><br><br>';
	    html = html + '<button class="btn btn-warning" onclick="updateModal('+data.tasks[i].id+',\''+data.tasks[i].status+'\')">Update Status</button></div></form>';
       	html = html + '</div></div>	';

		$("#tasks").append(html);
	}
}	