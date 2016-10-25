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
$URLindex = '6';

function countStatus($companies, $statusIndex)
{
	$status = array();
	$status['All'] = 0;
	$status['New'] = 0;
	$status['In Progress'] = 0;
	$status['Complete'] = 0;

	foreach ($companies->childNodes as $company) 
	{
		if($company->getAttribute('id') == $_SESSION["company-id"])
		{
			$tasks = $company->childNodes->item(2);
			foreach ($tasks->childNodes as $task) {
				$status['All']++;
				if($task->childNodes->item($statusIndex)->nodeValue == 'New')
				{
					$status['New']++;
				}
				if($task->childNodes->item($statusIndex)->nodeValue == 'Complete')
				{
					$status['Complete']++;
				}
				if($task->childNodes->item($statusIndex)->nodeValue == 'In Progress')
				{
					$status['In Progress']++;
				}
			}
		}
	}

	return $status;
}

function getUsers($companies)
{
	$usersArray = array();
	foreach ($companies->childNodes as $company) 
	{
		if($company->getAttribute('id') == $_SESSION["company-id"])
		{
			$users = $company->childNodes->item(1);
			foreach ($users->childNodes as $user) 
			{
				array_push($usersArray, $user->childNodes->item(3)->nodeValue);
			}
		}
	}
	return $usersArray;
}

$return['status'] = countStatus($companies, $statusIndex);
$return['users'] = getUsers($companies);
$return['session'] = $_SESSION;
echo json_encode($return);




