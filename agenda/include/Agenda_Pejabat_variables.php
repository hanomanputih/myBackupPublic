<?php
$strTableName="Agenda Pejabat";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="agenda_bos";

$gPageSize=5;

$gstrOrderBy="ORDER BY Nama";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$g_orderindexes[] = array(3, (1 ? "ASC" : "DESC"), "Nama");
$gsqlHead="SELECT id_bos,  id_unit,  Nama,  Jabatan,  Telp,  Foto,  Alamat_Rumah,  Alamat_Kantor,  HP,  email";
$gsqlFrom="FROM agenda_bos";
$gsqlWhereExpr="";
$gsqlTail="";

include(getabspath("include/Agenda_Pejabat_settings.php"));

// alias for 'SQLQuery' object
$gQuery = &$queryData_Agenda_Pejabat;


$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>