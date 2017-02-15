<?php
$strTableName="masuk";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="masuk";

$gPageSize=5;

$gstrOrderBy="ORDER BY no_urut DESC";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$g_orderindexes[] = array(1, (0 ? "ASC" : "DESC"), "no_urut");
$gsqlHead="SELECT no_urut,  link,  `link-out`,  Indeks,  Katagori,  KodeSurat,  NoUrut,  IsiRingkas,  Dari,  TglSurat,  NoSurat,  Lampiran,  Pengolah,  inst_pengolah,  TglDiteruskan,  Catatan,  Catatan2,  Sifat,  NIP,  unit,  Arsipkan,  prop,  id_naskah,  id_bos";
$gsqlFrom="FROM masuk";
$gsqlWhereExpr="";
$gsqlTail="";

include(getabspath("include/masuk_settings.php"));

// alias for 'SQLQuery' object
$gQuery = &$queryData_masuk;


$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>