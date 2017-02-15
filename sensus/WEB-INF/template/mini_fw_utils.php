<?php
function show_template_index($Command) {
	Auth::authenticate();
	
	include_once 'WEB-INF/controller/todo_aksi.php';
	include_once 'WEB-INF/controller/notice_aksi.php';
	
	$menu_aksi = new menu_aksi($Command);
	$todo_aksi = new todo_aksi($Command);
	$notice_aksi = new notice_aksi($Command);
	
	$menu = $menu_aksi->menu();

	include('template_index.php');
}

function show_template_report($Command) {
	include_once 'WEB-INF/controller/todo_aksi.php';
	include_once 'WEB-INF/controller/notice_aksi.php';
	
	$menu_aksi = new menu_aksi($Command);
	$menu = $menu_aksi->menu();
	Auth::authenticate();
	include ('template_report.php');
}

function show_template_login() {
	Auth::authenticateIsAlreadyLogged();
	$message = "";
	
	if(isset($_GET['fail']))
		$message=web_constant::$LOGIN_MESSAGE_WRONG; 
	else if(isset($_GET['timeout']))
		$message=web_constant::$LOGIN_MESSAGE_TIMEOUT;

	include('template_login.php');
}

// A utility function to get the url leading up to the current script.
// Used to make the example portable to other locations.
function getScriptUrl() {
	$scriptName = explode('/',$_SERVER['SCRIPT_NAME']);
        unset($scriptName[sizeof($scriptName)-1]);
	$scriptName = array_values($scriptName);
	
	return 'http://'.$_SERVER['SERVER_NAME'].implode('/',$scriptName).'/';
}

// get all url
function getActualUrl() {
	return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}
?>