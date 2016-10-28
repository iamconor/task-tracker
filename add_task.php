<?php

session_start();
$file = "users.xml";
$fp = fopen($file, "rb") or die("Err - can't open file");
$str = fread($fp, filesize($file));

$xml = new DOMDocument();
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->loadXML($str) or die("Err - can't load XML data");

$root	= $xml->documentElement;
$companies	= $root;
$return = array();

function getNewID($companies)
{
	$highestNum = 0;
	foreach ($companies->childNodes as $company) 
	{
		$tasks = $company->childNodes->item(2);
		$companyID = $company->getAttribute('id');
		$companyName = $company->childNodes->item(0)->nodeValue;

		foreach ($tasks->childNodes as $task) 
		{	
			if($task->getAttribute('id') > $highestNum)
			{
				$highestNum = $task->getAttribute('id');
			}
		}
	}
	return $highestNum+1;
}

function addTask($companies, $newID, $xml)
{
	$title = $_POST['title'];
	$leader = $_POST['leader'];
	$participants = $_POST['participants'];
	$date = $_POST['date'];
	$summary = $_POST['summary'];
	$status = 'New';
	$url = $_POST['url'];

	foreach ($companies->childNodes as $company) 
	{
		if($company->getAttribute('id') == $_SESSION['company-id'])
		{
			$tasks = $company->childNodes->item(2);
			$firstTask = $tasks->childNodes->item(0);
			$participantNode;

			//title node
			$titleNode=$xml->createElement("title");
			$titleTextNode=$xml->createTextNode($title);
			$titleNode->appendChild($titleTextNode);

			//leader node
			$leaderNode=$xml->createElement("leader");
			$leaderTextNode=$xml->createTextNode($leader);
			$leaderNode->appendChild($leaderTextNode);

			//participants node
			$participantsNode=$xml->createElement("participants");
			$participantNode=$xml->createElement("participant");
			$participantTextNode=$xml->createTextNode($participants[0]);
			$participantNode->appendChild($participantTextNode);
			$participantsNode->appendChild($participantNode);
			

			//date node
			$dateNode=$xml->createElement("date");
			$dateTextNode=$xml->createTextNode("$date");
			$dateNode->appendChild($dateTextNode);

			//summary node
			$summaryNode=$xml->createElement("summary");
			$summaryTextNode=$xml->createTextNode("$summary");
			$summaryNode->appendChild($summaryTextNode);

			//status node
			$statusNode=$xml->createElement("status");
			$statusTextNode=$xml->createTextNode("$status");
			$statusNode->appendChild($statusTextNode);

			//url node
			$urlNode=$xml->createElement("url");
			$urlTextNode=$xml->createTextNode("$url");
			$urlNode->appendChild($urlTextNode);

			$newTaskNode=$xml->createElement("task");
			$newTaskNode->setAttribute("id",$newID);
			$newTaskNode->appendChild($titleNode);
			$newTaskNode->appendChild($leaderNode);
			$newTaskNode->appendChild($participantsNode);
			$newTaskNode->appendChild($dateNode);
			$newTaskNode->appendChild($summaryNode);
			$newTaskNode->appendChild($statusNode);
			$newTaskNode->appendChild($urlNode);

			$tasks->insertBefore($newTaskNode,$firstTask);

			$xml->save("users.xml");

		}
	}

}

$newID = getNewID($companies);
addTask($companies, $newID, $xml);
$return['success'] = true;
echo json_encode($return);