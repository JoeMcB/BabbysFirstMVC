<?php
require_once("config/settings.php");
require_once("config/autoload.php");
require_once("config/routes.php");

$controller = Router::route($_SERVER['REQUEST_URI']);

try{
	$content = $controller->dispatch();
	}catch(Exception $ex){
		echo $ex->getMessage();
		die();
	}

//Start output buffer
ob_start();
echo $content;
ob_end_flush();