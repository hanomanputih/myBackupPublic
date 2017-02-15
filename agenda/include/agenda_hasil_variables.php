<?php
$strTableName="agenda_hasil";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="agenda_hasil";

$gPageSize=5;

$gstrOrderBy="ORDER BY id_hasil";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$g_orderindexes[] = array(1, (1 ? "ASC" : "DESC"), "id_hasil");
$gsqlHead="SELECT id_hasil,  id_hadir,  Hasil,  Catatan,  Naskah";
$gsqlFrom="FROM agenda_hasil";
$gsqlWhereExpr="";
$gsqlTail="";

include(getabspath("include/agenda_hasil_settings.php"));

// alias for 'SQLQuery' object
$gQuery = &$queryData_agenda_hasil;


$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>