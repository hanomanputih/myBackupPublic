<?php
$strTableName="agenda";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="agenda";

$gPageSize=5;

$gstrOrderBy="ORDER BY id_agenda";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$g_orderindexes[] = array(1, (1 ? "ASC" : "DESC"), "id_agenda");
$gsqlHead="SELECT id_agenda,  id_masuk,  Apa,  Tgl_mulai,  Tgl_akhir,  Jam_mulai,  Jam_akhir,  Tempat";
$gsqlFrom="FROM agenda";
$gsqlWhereExpr="";
$gsqlTail="";

include(getabspath("include/agenda_settings.php"));

// alias for 'SQLQuery' object
$gQuery = &$queryData_agenda;


$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>