<?php
$strTableName="agenda_bos";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="agenda_bos";

$gPageSize=5;

$gstrOrderBy="ORDER BY id_bos";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$g_orderindexes[] = array(1, (1 ? "ASC" : "DESC"), "id_bos");
$gsqlHead="SELECT id_bos,  id_unit,  Nama,  Jabatan,  Telp,  Foto,  Alamat_Rumah,  Alamat_Kantor,  HP,  email";
$gsqlFrom="FROM agenda_bos";
$gsqlWhereExpr="";
$gsqlTail="";

include(getabspath("include/agenda_bos_settings.php"));

// alias for 'SQLQuery' object
$gQuery = &$queryData_agenda_bos;


$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>