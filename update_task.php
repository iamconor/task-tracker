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

function editTask($companies, $xml)
{
	foreach ($companies->childNodes as $company) 
	{
		if($company->getAttribute('id') == $_SESSION['company-id'])
		{
			$tasks = $company->childNodes->item(2);

			foreach ($tasks->childNodes as $task) 
			{
				if($task->getAttribute('id') == $_POST['id'])
				{
					$task->getElementsByTagName("status")->item(0)->nodeValue = $_POST['status'];
					$xml->save("users.xml");
					return true;
				}
			}

		}
	}

}

$return['success'] = editTask($companies, $xml);
echo json_encode($return);
