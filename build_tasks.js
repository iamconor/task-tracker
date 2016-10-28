function buildTasks(data)
{
	for(var i = 0; i < data.tasks.length; i++)
	{	

		html = '<div class="container">';
		html = html + '<div class="well">';
		html = html + '<strong>Task ID: </strong>'+data.tasks[i].id+'<br>';
		html = html + '<strong>Title: </strong>'+data.tasks[i].title+'<br>';
		html = html + '<strong>Leader: </strong>'+data.tasks[i].leader+'<br>';
		html = html + '<strong>Status: </strong>'+data.tasks[i].status+'<br>';
		html = html + '<strong>Summary: </strong>'+data.tasks[i].summary+'<br>';
		html = html + '<strong>Target Date: </strong>'+data.tasks[i].targetDate+'<br>';
		html = html + '<strong>URL: </strong><a href="http://'+data.tasks[i].url+'">'+data.tasks[i].url+'</a>';
		html = html + '</div></div>	';

		$("#tasks").append(html);
		console.log(html);
		
	}

}	