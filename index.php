<?php 
	  echo 'asdasdasa';
	// FRONT CONTROLLER

	// загальні налаштування
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
	

	// підключення файлів системи
	define ('ROOT', dirname(__FILE__));
	require_once(ROOT.'/components/Router.php');
	include_once(ROOT.'/components/Db.php');
		

	// виклик Router 100%
	$router = new Router();
	$router->run();


 ?> 