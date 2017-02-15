<?php
$strTableName="admin_users";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="agenda_petugas";

$gPageSize=5;

$gstrOrderBy="ORDER BY Nama_Lengkap";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$g_orderindexes[] = array(4, (1 ? "ASC" : "DESC"), "Nama_Lengkap");
$gsqlHead="SELECT id_user,  Username,  Passw,  Nama_Lengkap,  Instansi,  NIP,  Alamat_Kantor,  Telp_Kantor,  Telp_HP";
$gsqlFrom="FROM agenda_petugas";
$gsqlWhereExpr="";
$gsqlTail="";

include(getabspath("include/admin_users_settings.php"));

// alias for 'SQLQuery' object
$gQuery = &$queryData_admin_users;


$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>