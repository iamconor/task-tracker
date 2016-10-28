<?php

var_dump($_POST);
$file = "users.xml";
$fp = fopen($file, "rb") or die("Err - can't open file");
$str = fread($fp, filesize($file));

$xml = new DOMDocument();
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->loadXML($str) or die("Err - can't load XML data");

$root	= $xml->documentElement;
$companies	= $root;

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
	return $highestNum;
}



