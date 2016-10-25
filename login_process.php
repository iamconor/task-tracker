<?php
//login_process.php - process login form

//variable declarations
$errors		= array();
$return 	= array();
$username	= $_POST['username'];
$password	= $_POST['password'];

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
	$file = "users.xml";
	$fp = fopen($file, "rb") or die("Err - can't open file");
	$str = fread($fp, filesize($file));

	$xml = new DOMDocument();
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->loadXML($str) or die("Err - can't load XML data");

	$root	= $xml->documentElement;
	$companies	= $root->childNodes;
	$allUsers = $users->childNodes;
	
	foreach ($companies->childNodes as $company) 
	{
		$users = $company->childNodes->item(1);

		foreach ($users->childNodes as $user) 
		{
			$xmlUsername 	= $user->childNodes->item(0)->nodeValue;
			$xmlPassword 	= $user->childNodes->item(1)->nodeValue;
			$xmlAccessLevel	= $user->childNodes->item(2)->nodeValue;
			var_dump($xmlUsername);
			var_dump($xmlPassword);
			var_dump($xmlAccessLevel);
		}

	}
	die;

	$return['success']	= true;
	$return['message']	= 'Great Success';
}

echo json_encode($return);