<?php
//login_process.php - process login form

//variable declarations
$usernameFound	= false;
$passwordFail	= false;
$errors			= array();
$return 		= array();
$username		= $_POST['username'];
$password		= $_POST['password'];

//server side validation
if(empty($username))
{
	$errors['username'] = 'Please enter a username';
}

if(empty($password))
{
	$errors['password'] = 'Please enter a password';
}

if(!empty($errors))
{
	$return['success']	= false;
	$return['errors']	= $errors;
}
else
{
	$file = "tasks.xml";
	$fp = fopen($file, "rb") or die("Err - can't open file");
	$str = fread($fp, filesize($file));

	$xml = new DOMDocument();
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->loadXML($str) or die("Err - can't load XML data");

	$root	= $xml->documentElement;
	$companies	= $root;
	
	foreach ($companies->childNodes as $company) 
	{
		$users = $company->childNodes->item(1);
		$companyID = $company->getAttribute('id');
		$companyName = $company->childNodes->item(0)->nodeValue;

		foreach ($users->childNodes as $user) 
		{	
			$xmlUsername 	= $user->childNodes->item(0)->nodeValue;
			$xmlPassword 	= $user->childNodes->item(1)->nodeValue;
			$xmlAccessLevel	= $user->childNodes->item(2)->nodeValue;
			$xmlName 		= $user->childNodes->item(3)->nodeValue;

			if ($xmlUsername == $username) {
				$usernameFound = true;
				if($xmlPassword !== $password)
				{
					$passwordFail = true;
				}
				else
				{
					session_start();
					$_SESSION["username"] = $username;
					$_SESSION["company-id"] = $companyID;
					$_SESSION["access-level"] = $xmlAccessLevel;
					$_SESSION["name"] = $xmlName;
					$_SESSION["company-name"] = $companyName;
				}
				break 2;
			}

		}

	}

	if(!$usernameFound)
	{
		$errors['username'] = 'That user does not exist';
	}

	if($passwordFail)
	{
		$errors['password'] = 'Wrong password, enter again';
	}

	if(!empty($errors))
	{
		$return['success'] = false;
		$return['errors'] = $errors;
	}

	if(($usernameFound) && (!$passwordFail))
	{
		$return['success']	= true;
		$return['message']	= 'You are logged in';
	}
}

echo json_encode($return);