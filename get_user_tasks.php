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

$titleIndex = '0';
$leaderIndex = '1';
$participantsIndex = '2';
$targetDateIndex = '3';
$summaryIndex = '4';
$statusIndex = '5';
$urlIndex = '6';

function getAllLeaderTasks($companies, $titleIndex, $leaderIndex, $participantsIndex, $targetDateIndex, $summaryIndex, $statusIndex, $urlIndex)
{
	$count = 0;
	$tasksArray = array();
	foreach ($companies->childNodes as $company) {
		if($company->getAttribute('id') == $_SESSION["company-id"])
		{
			$tasks = $company->childNodes->item(2);
			foreach ($tasks->childNodes as $task) 
			{
				if($task->childNodes->item($leaderIndex)->nodeValue == $_POST['name'])
				{
					$tasksArray[$count]["id"] = $task->getAttribute('id');
					$tasksArray[$count]["title"] = $task->childNodes->item($titleIndex)->nodeValue;
					$tasksArray[$count]["leader"] = $task->childNodes->item($leaderIndex)->nodeValue;

					$participants = $task->childNodes->item($participantsIndex);
					$participantCount = 0;
					foreach($participants->childNodes as $participant)
					{					
						$tasksArray[$count]["participants"][$participantCount] = $participant->childNodes->item(0)->nodeValue;
						$participantCount++;
					}

					$tasksArray[$count]["targetDate"] = $task->childNodes->item($targetDateIndex)->nodeValue;
					$tasksArray[$count]["summary"] = $task->childNodes->item($summaryIndex)->nodeValue;
					$tasksArray[$count]["status"] = $task->childNodes->item($statusIndex)->nodeValue;
					$tasksArray[$count]["status"] = $task->childNodes->item($statusIndex)->nodeValue;
					$tasksArray[$count]["url"] = $task->childNodes->item($urlIndex)->nodeValue;

					$count++;
				}
			}
		}
	}
	return $tasksArray;
}

function getAllParticipantTasks($companies, $titleIndex, $leaderIndex, $participantsIndex, $targetDateIndex, $summaryIndex, $statusIndex, $urlIndex)
{
	$count = 0;
	$tasksArray = array();
	foreach ($companies->childNodes as $company) {
		if($company->getAttribute('id') == $_SESSION["company-id"])
		{
			$tasks = $company->childNodes->item(2);
			foreach ($tasks->childNodes as $task) 
			{
					$participantsMatches = $task->childNodes->item($participantsIndex);
					foreach ($participantsMatches->childNodes as $participantsMatch) 
					{
						if($participantsMatch->childNodes->item(0)->nodeValue == $_POST['name'])
						{
							$tasksArray[$count]["id"] = $task->getAttribute('id');
							$tasksArray[$count]["title"] = $task->childNodes->item($titleIndex)->nodeValue;
							$tasksArray[$count]["leader"] = $task->childNodes->item($leaderIndex)->nodeValue;

							$participants = $task->childNodes->item($participantsIndex);
							$participantCount = 0;
							foreach($participants->childNodes as $participant)
							{					
								$tasksArray[$count]["participants"][$participantCount] = $participant->childNodes->item(0)->nodeValue;
								$participantCount++;
							}

							$tasksArray[$count]["targetDate"] = $task->childNodes->item($targetDateIndex)->nodeValue;
							$tasksArray[$count]["summary"] = $task->childNodes->item($summaryIndex)->nodeValue;
							$tasksArray[$count]["status"] = $task->childNodes->item($statusIndex)->nodeValue;
							$tasksArray[$count]["status"] = $task->childNodes->item($statusIndex)->nodeValue;
							$tasksArray[$count]["url"] = $task->childNodes->item($urlIndex)->nodeValue;

							$count++;
						}
					}
			}
		}
	}
	return $tasksArray;
}


if($_POST['role'] == 'leader')
{
	$return['success'] = true;
	$return['tasks'] = getAllLeaderTasks($companies, $titleIndex, $leaderIndex, $participantsIndex, $targetDateIndex, $summaryIndex, $statusIndex, $urlIndex);
}
if($_POST['role'] == 'participant')
{
	$return['success'] = true;
	$return['tasks'] = getAllParticipantTasks($companies, $titleIndex, $leaderIndex, $participantsIndex, $targetDateIndex, $summaryIndex, $statusIndex, $urlIndex);
}
echo json_encode($return);
