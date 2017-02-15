<?php
$strTableName="agenda_hadir";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="agenda_hadir";

$gPageSize=5;

$gstrOrderBy="ORDER BY id_hadir";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$g_orderindexes[] = array(1, (1 ? "ASC" : "DESC"), "id_hadir");
$gsqlHead="SELECT id_hadir,  id_agenda,  Instansi,  id_bos,  Jabatan,  Jam";
$gsqlFrom="FROM agenda_hadir";
$gsqlWhereExpr="";
$gsqlTail="";

include(getabspath("include/agenda_hadir_settings.php"));

// alias for 'SQLQuery' object
$gQuery = &$queryData_agenda_hadir;


$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>