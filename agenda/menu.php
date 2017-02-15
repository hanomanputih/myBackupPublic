<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");


include("include/dbcommon.php");

if(!@$_SESSION["UserID"])
{
	header("Location: login.php");
	return;
}


include('include/xtempl.php');
include('classes/runnerpage.php');
$xt = new Xtempl();

$id = postvalue("id")!=="" ? postvalue("id") : 1;
//array of params for classes
$params = array("pageType" => PAGE_MENU,"id" =>$id, "menuTablesArr"=>$menuTablesArr, "isGroupSecurity"=>$isGroupSecurity);
$params["xt"]=&$xt;
$pageObject = new RunnerPage($params);


// button handlers file names
$buttonHandlers = array();
$pageObject->addButtonHandlers($buttonHandlers);


// add onload event

//	Before Process event
if(function_exists("BeforeProcessMenu"))
	BeforeProcessMenu($conn);



$pageObject->body["begin"] .= "<script type=\"text/javascript\" src=\"include/jquery.js\"></script>".
"<script type=\"text/javascript\" src=\"include/jsfunctions.js\"></script>";

if ($pageObject->debugJSMode === true)
{

	$pageObject->body["begin"] .= "<script type=\"text/javascript\" src=\"include/runnerJS/Runner.js\"></script>".
		"<script type=\"text/javascript\" src=\"include/runnerJS/Util.js\"></script>";
}
else
{
	$pageObject->body["begin"] .= "<script type=\"text/javascript\" src=\"include/runnerJS/RunnerBase.js\"></script>";
}


$pageObject->body["end"] .= "<script>".$pageObject->PrepareJS()."</script>";
$xt->assignbyref("body",$pageObject->body);

$xt->assign("username",$_SESSION["UserID"]);
$xt->assign("changepwd_link",$_SESSION["AccessLevel"] != ACCESS_LEVEL_GUEST);
$xt->assign("changepwdlink_attrs","onclick=\"window.location.href='changepwd.php';return false;\"");
$xt->assign("logoutlink_attrs","onclick=\"window.location.href='login.php?a=logout';\"");

$xt->assign("loggedas_block",true);
$xt->assign("logout_link",true);


$menuInfo = $pageObject->createOldMenu();

if($pageObject->isCreateMenu())
	$xt->assign("menustyle_block",true);


if(IsAdmin())
{
	$xt->assign("adminarea_link",true);
	$xt->assign("adminarealink_attrs","onclick=\"window.location.href='admin_rights_list.php';return false;\"");
	$menuInfo['urlForRedirect'] = "admin_rights_list.php";
	$menuInfo['menuTablesCount']++;
}


if($menuInfo['menuTablesCount']<2)
{
	header("Location: ".$menuInfo['urlForRedirect']); 
	exit();
}

$templatefile="menu.htm";
if(function_exists("BeforeShowMenu"))
	BeforeShowMenu($xt, $templatefile);

$xt->display($templatefile);
?>