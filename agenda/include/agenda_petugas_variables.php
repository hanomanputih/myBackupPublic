<?php
$strTableName="agenda_petugas";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="agenda_petugas";

$gPageSize=5;

$gstrOrderBy="ORDER BY id_user";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$g_orderindexes[] = array(1, (1 ? "ASC" : "DESC"), "id_user");
$gsqlHead="SELECT id_user,  Username,  Passw,  Nama_Lengkap,  Instansi,  NIP,  Alamat_Kantor,  Telp_Kantor,  Telp_HP";
$gsqlFrom="FROM agenda_petugas";
$gsqlWhereExpr="";
$gsqlTail="";

include(getabspath("include/agenda_petugas_settings.php"));

// alias for 'SQLQuery' object
$gQuery = &$queryData_agenda_petugas;


$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>