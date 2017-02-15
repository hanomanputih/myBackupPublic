<?php
include(getabspath("include/masuk_settings.php"));

function DisplayMasterTableInfo_masuk($params)
{
	$detailtable=$params["detailtable"];
	$keys=$params["keys"];
	global $conn,$strTableName;
	$xt = new Xtempl();
	$oldTableName=$strTableName;
	$strTableName="masuk";

//$strSQL = "SELECT  no_urut,  link,  `link-out`,  Indeks,  Katagori,  KodeSurat,  NoUrut,  IsiRingkas,  Dari,  TglSurat,  NoSurat,  Lampiran,  Pengolah,  inst_pengolah,  TglDiteruskan,  Catatan,  Catatan2,  Sifat,  NIP,  unit,  Arsipkan,  prop,  id_naskah,  id_bos  FROM masuk  ORDER BY no_urut DESC  ";

$sqlHead="SELECT no_urut,  link,  `link-out`,  Indeks,  Katagori,  KodeSurat,  NoUrut,  IsiRingkas,  Dari,  TglSurat,  NoSurat,  Lampiran,  Pengolah,  inst_pengolah,  TglDiteruskan,  Catatan,  Catatan2,  Sifat,  NIP,  unit,  Arsipkan,  prop,  id_naskah,  id_bos";
$sqlFrom="FROM masuk";
$sqlWhere="";
$sqlTail="";

$where="";
$mKeys = array();
$showKeys = "";

if($detailtable=="agenda")
{
		$where.= GetFullFieldName("no_urut")."=".make_db_value("no_urut",$keys[1-1]);
	$showKeys .= " Nomor: ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
}
	if(!$where)
	{
		$strTableName=$oldTableName;
		return;
	}
	$str = SecuritySQL("Search");
	if(strlen($str))
		$where.=" and ".$str;

	$strWhere=whereAdd($sqlWhere,$where);
	if(strlen($strWhere))
		$strWhere=" where ".$strWhere." ";
	$strSQL= $sqlHead.' '.$sqlFrom.$strWhere.$sqlTail;

//	$strSQL=AddWhere($strSQL,$where);
	LogInfo($strSQL);
	$rs=db_query($strSQL,$conn);
	$data=db_fetch_array($rs);
	if(!$data)
	{
		$strTableName=$oldTableName;
		return;
	}
	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["no_urut"]));
	


//	Indeks - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Indeks", ""),"field=Indeks".$keylink);
			$xt->assign("Indeks_mastervalue",$value);

//	KodeSurat - 
			$value="";
				$value = ProcessLargeText(GetData($data,"KodeSurat", ""),"field=KodeSurat".$keylink);
			$xt->assign("KodeSurat_mastervalue",$value);

//	NoUrut - 
			$value="";
				$value = ProcessLargeText(GetData($data,"NoUrut", ""),"field=NoUrut".$keylink);
			$xt->assign("NoUrut_mastervalue",$value);

//	IsiRingkas - 
			$value="";
				$value = ProcessLargeText(GetData($data,"IsiRingkas", ""),"field=IsiRingkas".$keylink);
			$xt->assign("IsiRingkas_mastervalue",$value);

//	Dari - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Dari", ""),"field=Dari".$keylink);
			$xt->assign("Dari_mastervalue",$value);

//	TglSurat - Long Date
			$value="";
				$value = ProcessLargeText(GetData($data,"TglSurat", "Long Date"),"field=TglSurat".$keylink);
			$xt->assign("TglSurat_mastervalue",$value);

//	NoSurat - 
			$value="";
				$value = ProcessLargeText(GetData($data,"NoSurat", ""),"field=NoSurat".$keylink);
			$xt->assign("NoSurat_mastervalue",$value);

//	Pengolah - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Pengolah", ""),"field=Pengolah".$keylink);
			$xt->assign("Pengolah_mastervalue",$value);

//	TglDiteruskan - Long Date
			$value="";
				$value = ProcessLargeText(GetData($data,"TglDiteruskan", "Long Date"),"field=TglDiteruskan".$keylink);
			$xt->assign("TglDiteruskan_mastervalue",$value);

//	prop - 
			$value="";
				$value = ProcessLargeText(GetData($data,"prop", ""),"field=prop".$keylink);
			$xt->assign("prop_mastervalue",$value);
	$strTableName=$oldTableName;
	$xt->display("masuk_masterlist.htm");
}

// events

?>