<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 

include("include/admin_rights_variables.php");


$gsqlHead="select `Username` ";
$gsqlFrom="from `agenda_petugas`";
$gsqlWhereExpr="";
$gsqlTail="";
// $gstrSQL = "SELECT TableName,   GroupID,   AccessMask  FROM agenda_ugrights ";
$gstrSQL = gSQLWhere("");


if(!@$_SESSION["UserID"])
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}
if(!IsAdmin())
{
	echo "<p>"."Anda tidak punya ijin untuk mengakses tabel ini"." <a href=\"login.php\">"."Kembali ke halaman login"."</a></p>";
	return;
}

include('include/xtempl.php');
include('classes/runnerpage.php');
include('classes/listpage.php');
include('classes/rightspage.php');
$xt = new Xtempl();



$options = array();
//array of params for classes
$options["pageType"] = PAGE_LIST;
$options["id"] = postvalue("id") ? postvalue("id") : 1;
$options["mode"] = RIGHTS_PAGE;
$options['xt'] = &$xt;
$nonAdminTablesRightsArr=array();
$nonAdminTablesArr=array();
$nonAdminTablesArr[] = array("agenda","Agenda");
$nonAdminTablesRightsArr["agenda"]=array();
$nonAdminTablesArr[] = array("agenda_bos","Pelaksana Tugas");
$nonAdminTablesRightsArr["agenda_bos"]=array();
$nonAdminTablesArr[] = array("agenda_hadir","Hadir");
$nonAdminTablesRightsArr["agenda_hadir"]=array();
$nonAdminTablesArr[] = array("agenda_hasil","Laporan");
$nonAdminTablesRightsArr["agenda_hasil"]=array();
$nonAdminTablesArr[] = array("masuk","Surat Masuk");
$nonAdminTablesRightsArr["masuk"]=array();
$nonAdminTablesArr[] = array("agenda_petugas","Petugas Agenda");
$nonAdminTablesRightsArr["agenda_petugas"]=array();
$nonAdminTablesArr[] = array("Agenda Pejabat","Agenda Pejabat");
$nonAdminTablesRightsArr["Agenda Pejabat"]=array();

$options["nonAdminTablesArr"] = $nonAdminTablesArr;
$options["nonAdminTablesRightsArr"] = $nonAdminTablesRightsArr;


$pageObject = ListPage::createListPage($strTableName, $options);
$buttonHandlers = array();
 // add button events if exist
$pageObject->addButtonHandlers($buttonHandlers);
// prepare code for build page
$pageObject->prepareForBuildPage();

// show page depends of mode
$pageObject->showPage();
	//$xt->assign_loopsection("grid_row",$rowinfo);
	


?>
