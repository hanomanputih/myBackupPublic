<?php
	include('WEB-INF/module/conf/KLogger.php');
	include('WEB-INF/module/conf/session.php');
	include('WEB-INF/lib/axial.command.php');
	include('WEB-INF/lib/axial.urlinterpreter.php');
	include('WEB-INF/lib/axial.commanddispatcher.php');
	include('WEB-INF/template/mini_fw_utils.php');
	
	error_reporting(0);
	Auth::inisiate();
	$urlInterpreter = new Axial_URLInterpreter();
	$command = $urlInterpreter->getCommand();
	$commandDispatcher = new Axial_CommandDispatcher($command);
	$commandDispatcher->Dispatch();
?>