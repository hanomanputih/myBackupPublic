<?php

//	field labels
$fieldLabelsmasuk = array();
$fieldLabelsmasuk["Indonesian"]=array();
$fieldLabelsmasuk["Indonesian"]["no_urut"] = "Nomor";
$fieldLabelsmasuk["Indonesian"]["link"] = "Link";
$fieldLabelsmasuk["Indonesian"]["link_out"] = "Link-out";
$fieldLabelsmasuk["Indonesian"]["Indeks"] = "Indeks";
$fieldLabelsmasuk["Indonesian"]["Katagori"] = "Katagori";
$fieldLabelsmasuk["Indonesian"]["KodeSurat"] = "Kode Surat";
$fieldLabelsmasuk["Indonesian"]["NoUrut"] = "Nomor Urut";
$fieldLabelsmasuk["Indonesian"]["IsiRingkas"] = "Isi Ringkas";
$fieldLabelsmasuk["Indonesian"]["Dari"] = "Dari";
$fieldLabelsmasuk["Indonesian"]["TglSurat"] = "Tanggal Surat";
$fieldLabelsmasuk["Indonesian"]["NoSurat"] = "Nomor Surat";
$fieldLabelsmasuk["Indonesian"]["Lampiran"] = "Lampiran";
$fieldLabelsmasuk["Indonesian"]["Pengolah"] = "Pengolah";
$fieldLabelsmasuk["Indonesian"]["inst_pengolah"] = "Instansi Pengolah";
$fieldLabelsmasuk["Indonesian"]["TglDiteruskan"] = "Tanggal diteruskan";
$fieldLabelsmasuk["Indonesian"]["Catatan"] = "Catatan";
$fieldLabelsmasuk["Indonesian"]["Catatan2"] = "Catatan2";
$fieldLabelsmasuk["Indonesian"]["Sifat"] = "Sifat";
$fieldLabelsmasuk["Indonesian"]["NIP"] = "NIP";
$fieldLabelsmasuk["Indonesian"]["unit"] = "Unit";
$fieldLabelsmasuk["Indonesian"]["Arsipkan"] = "Arsipkan";
$fieldLabelsmasuk["Indonesian"]["prop"] = "Prop";
$fieldLabelsmasuk["Indonesian"]["id_naskah"] = "Id Naskah";
$fieldLabelsmasuk["Indonesian"]["id_bos"] = "Id Bos";


$tdatamasuk=array();
	$tdatamasuk[".ShortName"]="masuk";
	$tdatamasuk[".OwnerID"]="";
	$tdatamasuk[".OriginalTable"]="masuk";
	$tdatamasuk[".NCSearch"]=false;
	

$tdatamasuk[".shortTableName"] = "masuk";
$tdatamasuk[".dataSourceTable"] = "masuk";
$tdatamasuk[".nSecOptions"] = 0;
$tdatamasuk[".nLoginMethod"] = 1;
$tdatamasuk[".recsPerRowList"] = 1;	
$tdatamasuk[".tableGroupBy"] = "0";
$tdatamasuk[".dbType"] = 0;
$tdatamasuk[".mainTableOwnerID"] = "";
$tdatamasuk[".moveNext"] = 1;

$tdatamasuk[".listAjax"] = true;

	$tdatamasuk[".audit"] = false;

	$tdatamasuk[".locking"] = false;
	
$tdatamasuk[".listIcons"] = true;




$tdatamasuk[".showSimpleSearchOptions"] = false;

$tdatamasuk[".showSearchPanel"] = false;


$tdatamasuk[".isUseAjaxSuggest"] = false;

$tdatamasuk[".rowHighlite"] = true;

$tdatamasuk[".delFile"] = true;

// button handlers file names

// start on load js handlers








// end on load js handlers



$tdatamasuk[".arrKeyFields"][] = "no_urut";

// use datepicker for search panel
$tdatamasuk[".isUseCalendarForSearch"] = true;

// use timepicker for search panel
$tdatamasuk[".isUseTimeForSearch"] = false;






$tdatamasuk[".isUseInlineJs"] = $tdatamasuk[".isUseInlineAdd"] || $tdatamasuk[".isUseInlineEdit"];

$tdatamasuk[".allSearchFields"] = array();

$tdatamasuk[".globSearchFields"][] = "Indeks";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Indeks", $tdatamasuk[".allSearchFields"]))
{
	$tdatamasuk[".allSearchFields"][] = "Indeks";	
}
$tdatamasuk[".globSearchFields"][] = "KodeSurat";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("KodeSurat", $tdatamasuk[".allSearchFields"]))
{
	$tdatamasuk[".allSearchFields"][] = "KodeSurat";	
}
$tdatamasuk[".globSearchFields"][] = "NoUrut";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("NoUrut", $tdatamasuk[".allSearchFields"]))
{
	$tdatamasuk[".allSearchFields"][] = "NoUrut";	
}
$tdatamasuk[".globSearchFields"][] = "IsiRingkas";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("IsiRingkas", $tdatamasuk[".allSearchFields"]))
{
	$tdatamasuk[".allSearchFields"][] = "IsiRingkas";	
}
$tdatamasuk[".globSearchFields"][] = "Dari";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Dari", $tdatamasuk[".allSearchFields"]))
{
	$tdatamasuk[".allSearchFields"][] = "Dari";	
}
$tdatamasuk[".globSearchFields"][] = "TglSurat";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("TglSurat", $tdatamasuk[".allSearchFields"]))
{
	$tdatamasuk[".allSearchFields"][] = "TglSurat";	
}
$tdatamasuk[".globSearchFields"][] = "NoSurat";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("NoSurat", $tdatamasuk[".allSearchFields"]))
{
	$tdatamasuk[".allSearchFields"][] = "NoSurat";	
}
$tdatamasuk[".globSearchFields"][] = "Pengolah";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Pengolah", $tdatamasuk[".allSearchFields"]))
{
	$tdatamasuk[".allSearchFields"][] = "Pengolah";	
}
$tdatamasuk[".globSearchFields"][] = "TglDiteruskan";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("TglDiteruskan", $tdatamasuk[".allSearchFields"]))
{
	$tdatamasuk[".allSearchFields"][] = "TglDiteruskan";	
}
$tdatamasuk[".globSearchFields"][] = "prop";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("prop", $tdatamasuk[".allSearchFields"]))
{
	$tdatamasuk[".allSearchFields"][] = "prop";	
}

$tdatamasuk[".panelSearchFields"][] = "Indeks";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Indeks", $tdatamasuk[".allSearchFields"])) 
{
	$tdatamasuk[".allSearchFields"][] = "Indeks";	
}
$tdatamasuk[".panelSearchFields"][] = "KodeSurat";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("KodeSurat", $tdatamasuk[".allSearchFields"])) 
{
	$tdatamasuk[".allSearchFields"][] = "KodeSurat";	
}
$tdatamasuk[".panelSearchFields"][] = "NoUrut";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("NoUrut", $tdatamasuk[".allSearchFields"])) 
{
	$tdatamasuk[".allSearchFields"][] = "NoUrut";	
}
$tdatamasuk[".panelSearchFields"][] = "IsiRingkas";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("IsiRingkas", $tdatamasuk[".allSearchFields"])) 
{
	$tdatamasuk[".allSearchFields"][] = "IsiRingkas";	
}
$tdatamasuk[".panelSearchFields"][] = "Dari";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Dari", $tdatamasuk[".allSearchFields"])) 
{
	$tdatamasuk[".allSearchFields"][] = "Dari";	
}
$tdatamasuk[".panelSearchFields"][] = "TglSurat";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("TglSurat", $tdatamasuk[".allSearchFields"])) 
{
	$tdatamasuk[".allSearchFields"][] = "TglSurat";	
}
$tdatamasuk[".panelSearchFields"][] = "NoSurat";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("NoSurat", $tdatamasuk[".allSearchFields"])) 
{
	$tdatamasuk[".allSearchFields"][] = "NoSurat";	
}
$tdatamasuk[".panelSearchFields"][] = "Pengolah";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Pengolah", $tdatamasuk[".allSearchFields"])) 
{
	$tdatamasuk[".allSearchFields"][] = "Pengolah";	
}
$tdatamasuk[".panelSearchFields"][] = "TglDiteruskan";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("TglDiteruskan", $tdatamasuk[".allSearchFields"])) 
{
	$tdatamasuk[".allSearchFields"][] = "TglDiteruskan";	
}
$tdatamasuk[".panelSearchFields"][] = "prop";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("prop", $tdatamasuk[".allSearchFields"])) 
{
	$tdatamasuk[".allSearchFields"][] = "prop";	
}

$tdatamasuk[".isDynamicPerm"] = true;

	


$tdatamasuk[".isResizeColumns"] = false;


$tdatamasuk[".createLoginPage"] = true;


 	
	$tdatamasuk[".subQueriesSupAccess"] = true;




$tdatamasuk[".pageSize"] = 5;

$gstrOrderBy = "ORDER BY no_urut DESC";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy = "order by ".$gstrOrderBy;
$tdatamasuk[".strOrderBy"] = $gstrOrderBy;
	
$tdatamasuk[".orderindexes"] = array();
$tdatamasuk[".orderindexes"][] = array(1, (0 ? "ASC" : "DESC"), "no_urut");

$tdatamasuk[".sqlHead"] = "SELECT no_urut,  link,  `link-out`,  Indeks,  Katagori,  KodeSurat,  NoUrut,  IsiRingkas,  Dari,  TglSurat,  NoSurat,  Lampiran,  Pengolah,  inst_pengolah,  TglDiteruskan,  Catatan,  Catatan2,  Sifat,  NIP,  unit,  Arsipkan,  prop,  id_naskah,  id_bos";

$tdatamasuk[".sqlFrom"] = "FROM masuk";

$tdatamasuk[".sqlWhereExpr"] = "";

$tdatamasuk[".sqlTail"] = "";



	$tableKeys=array();
	$tableKeys[]="no_urut";
	$tdatamasuk[".Keys"]=$tableKeys;

	
//	no_urut
	$fdata = array();
	$fdata["strName"] = "no_urut";
	$fdata["ownerTable"] = "masuk";
		$fdata["Label"]="Nomor"; 
			$fdata["FieldType"]= 3;
		$fdata["AutoInc"]=true;
			$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "no_urut";
		$fdata["FullName"]= "no_urut";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 1;
	
			$fdata["EditParams"]="";
			
											$tdatamasuk["no_urut"]=$fdata;
	
//	link
	$fdata = array();
	$fdata["strName"] = "link";
	$fdata["ownerTable"] = "masuk";
		$fdata["Label"]="Link"; 
			$fdata["FieldType"]= 3;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "link";
		$fdata["FullName"]= "link";
						$fdata["Index"]= 2;
	
			$fdata["EditParams"]="";
			
											$tdatamasuk["link"]=$fdata;
	
//	link-out
	$fdata = array();
	$fdata["strName"] = "link-out";
	$fdata["ownerTable"] = "masuk";
		$fdata["Label"]="Link-out"; 
			$fdata["FieldType"]= 3;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "link_out";
		$fdata["FullName"]= "`link-out`";
						$fdata["Index"]= 3;
	
			$fdata["EditParams"]="";
			
											$tdatamasuk["link-out"]=$fdata;
	
//	Indeks
	$fdata = array();
	$fdata["strName"] = "Indeks";
	$fdata["ownerTable"] = "masuk";
				$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Indeks";
		$fdata["FullName"]= "Indeks";
						$fdata["Index"]= 4;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=50";
		 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdatamasuk["Indeks"]=$fdata;
	
//	Katagori
	$fdata = array();
	$fdata["strName"] = "Katagori";
	$fdata["ownerTable"] = "masuk";
				$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Katagori";
		$fdata["FullName"]= "Katagori";
						$fdata["Index"]= 5;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=5";
		
											$tdatamasuk["Katagori"]=$fdata;
	
//	KodeSurat
	$fdata = array();
	$fdata["strName"] = "KodeSurat";
	$fdata["ownerTable"] = "masuk";
		$fdata["Label"]="Kode Surat"; 
			$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "KodeSurat";
		$fdata["FullName"]= "KodeSurat";
						$fdata["Index"]= 6;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=30";
		 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdatamasuk["KodeSurat"]=$fdata;
	
//	NoUrut
	$fdata = array();
	$fdata["strName"] = "NoUrut";
	$fdata["ownerTable"] = "masuk";
		$fdata["Label"]="Nomor Urut"; 
			$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "NoUrut";
		$fdata["FullName"]= "NoUrut";
						$fdata["Index"]= 7;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=10";
		 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdatamasuk["NoUrut"]=$fdata;
	
//	IsiRingkas
	$fdata = array();
	$fdata["strName"] = "IsiRingkas";
	$fdata["ownerTable"] = "masuk";
		$fdata["Label"]="Isi Ringkas"; 
			$fdata["FieldType"]= 201;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text area";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IsiRingkas";
		$fdata["FullName"]= "IsiRingkas";
						$fdata["Index"]= 8;
	
		$fdata["EditParams"]="";
			$fdata["EditParams"].= " rows=200";
		$fdata["nRows"] = 200;
			$fdata["EditParams"].= " cols=100";
		$fdata["nCols"] = 100;
		 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdatamasuk["IsiRingkas"]=$fdata;
	
//	Dari
	$fdata = array();
	$fdata["strName"] = "Dari";
	$fdata["ownerTable"] = "masuk";
				$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Dari";
		$fdata["FullName"]= "Dari";
						$fdata["Index"]= 9;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=100";
		 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdatamasuk["Dari"]=$fdata;
	
//	TglSurat
	$fdata = array();
	$fdata["strName"] = "TglSurat";
	$fdata["ownerTable"] = "masuk";
		$fdata["Label"]="Tanggal Surat"; 
			$fdata["FieldType"]= 7;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Date";
	$fdata["ViewFormat"]= "Long Date";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "TglSurat";
		$fdata["FullName"]= "TglSurat";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 10;
	 $fdata["DateEditType"]=13; 
			 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdatamasuk["TglSurat"]=$fdata;
	
//	NoSurat
	$fdata = array();
	$fdata["strName"] = "NoSurat";
	$fdata["ownerTable"] = "masuk";
		$fdata["Label"]="Nomor Surat"; 
			$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "NoSurat";
		$fdata["FullName"]= "NoSurat";
						$fdata["Index"]= 11;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=50";
		 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdatamasuk["NoSurat"]=$fdata;
	
//	Lampiran
	$fdata = array();
	$fdata["strName"] = "Lampiran";
	$fdata["ownerTable"] = "masuk";
				$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Lampiran";
		$fdata["FullName"]= "Lampiran";
						$fdata["Index"]= 12;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=30";
		
											$tdatamasuk["Lampiran"]=$fdata;
	
//	Pengolah
	$fdata = array();
	$fdata["strName"] = "Pengolah";
	$fdata["ownerTable"] = "masuk";
				$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Pengolah";
		$fdata["FullName"]= "Pengolah";
						$fdata["Index"]= 13;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=50";
		 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdatamasuk["Pengolah"]=$fdata;
	
//	inst_pengolah
	$fdata = array();
	$fdata["strName"] = "inst_pengolah";
	$fdata["ownerTable"] = "masuk";
		$fdata["Label"]="Instansi Pengolah"; 
			$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "inst_pengolah";
		$fdata["FullName"]= "inst_pengolah";
						$fdata["Index"]= 14;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=4";
		
											$tdatamasuk["inst_pengolah"]=$fdata;
	
//	TglDiteruskan
	$fdata = array();
	$fdata["strName"] = "TglDiteruskan";
	$fdata["ownerTable"] = "masuk";
		$fdata["Label"]="Tanggal diteruskan"; 
			$fdata["FieldType"]= 7;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Date";
	$fdata["ViewFormat"]= "Long Date";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "TglDiteruskan";
		$fdata["FullName"]= "TglDiteruskan";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 15;
	 $fdata["DateEditType"]=13; 
			 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdatamasuk["TglDiteruskan"]=$fdata;
	
//	Catatan
	$fdata = array();
	$fdata["strName"] = "Catatan";
	$fdata["ownerTable"] = "masuk";
				$fdata["FieldType"]= 201;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text area";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Catatan";
		$fdata["FullName"]= "Catatan";
						$fdata["Index"]= 16;
	
		$fdata["EditParams"]="";
			$fdata["EditParams"].= " rows=200";
		$fdata["nRows"] = 200;
			$fdata["EditParams"].= " cols=100";
		$fdata["nCols"] = 100;
		
											$tdatamasuk["Catatan"]=$fdata;
	
//	Catatan2
	$fdata = array();
	$fdata["strName"] = "Catatan2";
	$fdata["ownerTable"] = "masuk";
				$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Catatan2";
		$fdata["FullName"]= "Catatan2";
						$fdata["Index"]= 17;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=50";
		
											$tdatamasuk["Catatan2"]=$fdata;
	
//	Sifat
	$fdata = array();
	$fdata["strName"] = "Sifat";
	$fdata["ownerTable"] = "masuk";
				$fdata["FieldType"]= 3;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Sifat";
		$fdata["FullName"]= "Sifat";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 18;
	
			$fdata["EditParams"]="";
			
											$tdatamasuk["Sifat"]=$fdata;
	
//	NIP
	$fdata = array();
	$fdata["strName"] = "NIP";
	$fdata["ownerTable"] = "masuk";
				$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "NIP";
		$fdata["FullName"]= "NIP";
						$fdata["Index"]= 19;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=9";
		
											$tdatamasuk["NIP"]=$fdata;
	
//	unit
	$fdata = array();
	$fdata["strName"] = "unit";
	$fdata["ownerTable"] = "masuk";
		$fdata["Label"]="Unit"; 
			$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "unit";
		$fdata["FullName"]= "unit";
						$fdata["Index"]= 20;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=4";
		
											$tdatamasuk["unit"]=$fdata;
	
//	Arsipkan
	$fdata = array();
	$fdata["strName"] = "Arsipkan";
	$fdata["ownerTable"] = "masuk";
				$fdata["FieldType"]= 3;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Arsipkan";
		$fdata["FullName"]= "Arsipkan";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 21;
	
			$fdata["EditParams"]="";
			
											$tdatamasuk["Arsipkan"]=$fdata;
	
//	prop
	$fdata = array();
	$fdata["strName"] = "prop";
	$fdata["ownerTable"] = "masuk";
		$fdata["Label"]="Prop"; 
			$fdata["FieldType"]= 3;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "prop";
		$fdata["FullName"]= "prop";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 22;
	
			$fdata["EditParams"]="";
			 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdatamasuk["prop"]=$fdata;
	
//	id_naskah
	$fdata = array();
	$fdata["strName"] = "id_naskah";
	$fdata["ownerTable"] = "masuk";
		$fdata["Label"]="Id Naskah"; 
			$fdata["FieldType"]= 3;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "id_naskah";
		$fdata["FullName"]= "id_naskah";
						$fdata["Index"]= 23;
	
			$fdata["EditParams"]="";
			
											$tdatamasuk["id_naskah"]=$fdata;
	
//	id_bos
	$fdata = array();
	$fdata["strName"] = "id_bos";
	$fdata["ownerTable"] = "masuk";
		$fdata["Label"]="Id Bos"; 
			$fdata["FieldType"]= 3;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "id_bos";
		$fdata["FullName"]= "id_bos";
						$fdata["Index"]= 24;
	
			$fdata["EditParams"]="";
			
											$tdatamasuk["id_bos"]=$fdata;

	
$tables_data["masuk"]=&$tdatamasuk;
$field_labels["masuk"] = &$fieldLabelsmasuk;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["masuk"] = array();
$dIndex = 1-1;
			$strOriginalDetailsTable="agenda";
	$detailsTablesData["masuk"][$dIndex] = array(
		  "dDataSourceTable"=>"agenda"
		, "dOriginalTable"=>$strOriginalDetailsTable
		, "dShortTable"=>"agenda"
		, "masterKeys"=>array()
		, "detailKeys"=>array()
		, "dispChildCount"=> "1"
		, "hideChild"=>"0"
		, "sqlHead"=>"SELECT id_agenda,  id_masuk,  Apa,  Tgl_mulai,  Tgl_akhir,  Jam_mulai,  Jam_akhir,  Tempat"	
		, "sqlFrom"=>"FROM agenda"	
		, "sqlWhere"=>""
		, "sqlTail"=>""
		, "groupBy"=>"0"
		, "previewOnList" => 0
		, "previewOnAdd" => 1
		, "previewOnEdit" => 1
		, "previewOnView" => 0
	);	
		$detailsTablesData["masuk"][$dIndex]["masterKeys"][]="no_urut";
		$detailsTablesData["masuk"][$dIndex]["detailKeys"][]="id_masuk";


	
// tables which are master tables for current table (detail)
$masterTablesData["masuk"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










$proto60=array();
$proto60["m_strHead"] = "SELECT";
$proto60["m_strFieldList"] = "no_urut,  link,  `link-out`,  Indeks,  Katagori,  KodeSurat,  NoUrut,  IsiRingkas,  Dari,  TglSurat,  NoSurat,  Lampiran,  Pengolah,  inst_pengolah,  TglDiteruskan,  Catatan,  Catatan2,  Sifat,  NIP,  unit,  Arsipkan,  prop,  id_naskah,  id_bos";
$proto60["m_strFrom"] = "FROM masuk";
$proto60["m_strWhere"] = "";
$proto60["m_strOrderBy"] = "ORDER BY no_urut DESC";
$proto60["m_strTail"] = "";
$proto61=array();
$proto61["m_sql"] = "";
$proto61["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto61["m_column"]=$obj;
$proto61["m_contained"] = array();
$proto61["m_strCase"] = "";
$proto61["m_havingmode"] = "0";
$proto61["m_inBrackets"] = "0";
$proto61["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto61);

$proto60["m_where"] = $obj;
$proto63=array();
$proto63["m_sql"] = "";
$proto63["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto63["m_column"]=$obj;
$proto63["m_contained"] = array();
$proto63["m_strCase"] = "";
$proto63["m_havingmode"] = "0";
$proto63["m_inBrackets"] = "0";
$proto63["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto63);

$proto60["m_having"] = $obj;
$proto60["m_fieldlist"] = array();
						$proto65=array();
			$obj = new SQLField(array(
	"m_strName" => "no_urut",
	"m_strTable" => "masuk"
));

$proto65["m_expr"]=$obj;
$proto65["m_alias"] = "";
$obj = new SQLFieldListItem($proto65);

$proto60["m_fieldlist"][]=$obj;
						$proto67=array();
			$obj = new SQLField(array(
	"m_strName" => "link",
	"m_strTable" => "masuk"
));

$proto67["m_expr"]=$obj;
$proto67["m_alias"] = "";
$obj = new SQLFieldListItem($proto67);

$proto60["m_fieldlist"][]=$obj;
						$proto69=array();
			$obj = new SQLField(array(
	"m_strName" => "link-out",
	"m_strTable" => "masuk"
));

$proto69["m_expr"]=$obj;
$proto69["m_alias"] = "";
$obj = new SQLFieldListItem($proto69);

$proto60["m_fieldlist"][]=$obj;
						$proto71=array();
			$obj = new SQLField(array(
	"m_strName" => "Indeks",
	"m_strTable" => "masuk"
));

$proto71["m_expr"]=$obj;
$proto71["m_alias"] = "";
$obj = new SQLFieldListItem($proto71);

$proto60["m_fieldlist"][]=$obj;
						$proto73=array();
			$obj = new SQLField(array(
	"m_strName" => "Katagori",
	"m_strTable" => "masuk"
));

$proto73["m_expr"]=$obj;
$proto73["m_alias"] = "";
$obj = new SQLFieldListItem($proto73);

$proto60["m_fieldlist"][]=$obj;
						$proto75=array();
			$obj = new SQLField(array(
	"m_strName" => "KodeSurat",
	"m_strTable" => "masuk"
));

$proto75["m_expr"]=$obj;
$proto75["m_alias"] = "";
$obj = new SQLFieldListItem($proto75);

$proto60["m_fieldlist"][]=$obj;
						$proto77=array();
			$obj = new SQLField(array(
	"m_strName" => "NoUrut",
	"m_strTable" => "masuk"
));

$proto77["m_expr"]=$obj;
$proto77["m_alias"] = "";
$obj = new SQLFieldListItem($proto77);

$proto60["m_fieldlist"][]=$obj;
						$proto79=array();
			$obj = new SQLField(array(
	"m_strName" => "IsiRingkas",
	"m_strTable" => "masuk"
));

$proto79["m_expr"]=$obj;
$proto79["m_alias"] = "";
$obj = new SQLFieldListItem($proto79);

$proto60["m_fieldlist"][]=$obj;
						$proto81=array();
			$obj = new SQLField(array(
	"m_strName" => "Dari",
	"m_strTable" => "masuk"
));

$proto81["m_expr"]=$obj;
$proto81["m_alias"] = "";
$obj = new SQLFieldListItem($proto81);

$proto60["m_fieldlist"][]=$obj;
						$proto83=array();
			$obj = new SQLField(array(
	"m_strName" => "TglSurat",
	"m_strTable" => "masuk"
));

$proto83["m_expr"]=$obj;
$proto83["m_alias"] = "";
$obj = new SQLFieldListItem($proto83);

$proto60["m_fieldlist"][]=$obj;
						$proto85=array();
			$obj = new SQLField(array(
	"m_strName" => "NoSurat",
	"m_strTable" => "masuk"
));

$proto85["m_expr"]=$obj;
$proto85["m_alias"] = "";
$obj = new SQLFieldListItem($proto85);

$proto60["m_fieldlist"][]=$obj;
						$proto87=array();
			$obj = new SQLField(array(
	"m_strName" => "Lampiran",
	"m_strTable" => "masuk"
));

$proto87["m_expr"]=$obj;
$proto87["m_alias"] = "";
$obj = new SQLFieldListItem($proto87);

$proto60["m_fieldlist"][]=$obj;
						$proto89=array();
			$obj = new SQLField(array(
	"m_strName" => "Pengolah",
	"m_strTable" => "masuk"
));

$proto89["m_expr"]=$obj;
$proto89["m_alias"] = "";
$obj = new SQLFieldListItem($proto89);

$proto60["m_fieldlist"][]=$obj;
						$proto91=array();
			$obj = new SQLField(array(
	"m_strName" => "inst_pengolah",
	"m_strTable" => "masuk"
));

$proto91["m_expr"]=$obj;
$proto91["m_alias"] = "";
$obj = new SQLFieldListItem($proto91);

$proto60["m_fieldlist"][]=$obj;
						$proto93=array();
			$obj = new SQLField(array(
	"m_strName" => "TglDiteruskan",
	"m_strTable" => "masuk"
));

$proto93["m_expr"]=$obj;
$proto93["m_alias"] = "";
$obj = new SQLFieldListItem($proto93);

$proto60["m_fieldlist"][]=$obj;
						$proto95=array();
			$obj = new SQLField(array(
	"m_strName" => "Catatan",
	"m_strTable" => "masuk"
));

$proto95["m_expr"]=$obj;
$proto95["m_alias"] = "";
$obj = new SQLFieldListItem($proto95);

$proto60["m_fieldlist"][]=$obj;
						$proto97=array();
			$obj = new SQLField(array(
	"m_strName" => "Catatan2",
	"m_strTable" => "masuk"
));

$proto97["m_expr"]=$obj;
$proto97["m_alias"] = "";
$obj = new SQLFieldListItem($proto97);

$proto60["m_fieldlist"][]=$obj;
						$proto99=array();
			$obj = new SQLField(array(
	"m_strName" => "Sifat",
	"m_strTable" => "masuk"
));

$proto99["m_expr"]=$obj;
$proto99["m_alias"] = "";
$obj = new SQLFieldListItem($proto99);

$proto60["m_fieldlist"][]=$obj;
						$proto101=array();
			$obj = new SQLField(array(
	"m_strName" => "NIP",
	"m_strTable" => "masuk"
));

$proto101["m_expr"]=$obj;
$proto101["m_alias"] = "";
$obj = new SQLFieldListItem($proto101);

$proto60["m_fieldlist"][]=$obj;
						$proto103=array();
			$obj = new SQLField(array(
	"m_strName" => "unit",
	"m_strTable" => "masuk"
));

$proto103["m_expr"]=$obj;
$proto103["m_alias"] = "";
$obj = new SQLFieldListItem($proto103);

$proto60["m_fieldlist"][]=$obj;
						$proto105=array();
			$obj = new SQLField(array(
	"m_strName" => "Arsipkan",
	"m_strTable" => "masuk"
));

$proto105["m_expr"]=$obj;
$proto105["m_alias"] = "";
$obj = new SQLFieldListItem($proto105);

$proto60["m_fieldlist"][]=$obj;
						$proto107=array();
			$obj = new SQLField(array(
	"m_strName" => "prop",
	"m_strTable" => "masuk"
));

$proto107["m_expr"]=$obj;
$proto107["m_alias"] = "";
$obj = new SQLFieldListItem($proto107);

$proto60["m_fieldlist"][]=$obj;
						$proto109=array();
			$obj = new SQLField(array(
	"m_strName" => "id_naskah",
	"m_strTable" => "masuk"
));

$proto109["m_expr"]=$obj;
$proto109["m_alias"] = "";
$obj = new SQLFieldListItem($proto109);

$proto60["m_fieldlist"][]=$obj;
						$proto111=array();
			$obj = new SQLField(array(
	"m_strName" => "id_bos",
	"m_strTable" => "masuk"
));

$proto111["m_expr"]=$obj;
$proto111["m_alias"] = "";
$obj = new SQLFieldListItem($proto111);

$proto60["m_fieldlist"][]=$obj;
$proto60["m_fromlist"] = array();
												$proto113=array();
$proto113["m_link"] = "SQLL_MAIN";
			$proto114=array();
$proto114["m_strName"] = "masuk";
$proto114["m_columns"] = array();
$proto114["m_columns"][] = "no_urut";
$proto114["m_columns"][] = "link";
$proto114["m_columns"][] = "link-out";
$proto114["m_columns"][] = "Indeks";
$proto114["m_columns"][] = "Katagori";
$proto114["m_columns"][] = "KodeSurat";
$proto114["m_columns"][] = "NoUrut";
$proto114["m_columns"][] = "IsiRingkas";
$proto114["m_columns"][] = "Dari";
$proto114["m_columns"][] = "TglSurat";
$proto114["m_columns"][] = "NoSurat";
$proto114["m_columns"][] = "Lampiran";
$proto114["m_columns"][] = "Pengolah";
$proto114["m_columns"][] = "inst_pengolah";
$proto114["m_columns"][] = "TglDiteruskan";
$proto114["m_columns"][] = "Catatan";
$proto114["m_columns"][] = "Catatan2";
$proto114["m_columns"][] = "Sifat";
$proto114["m_columns"][] = "NIP";
$proto114["m_columns"][] = "unit";
$proto114["m_columns"][] = "Arsipkan";
$proto114["m_columns"][] = "prop";
$proto114["m_columns"][] = "id_naskah";
$proto114["m_columns"][] = "id_bos";
$obj = new SQLTable($proto114);

$proto113["m_table"] = $obj;
$proto113["m_alias"] = "";
$proto115=array();
$proto115["m_sql"] = "";
$proto115["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto115["m_column"]=$obj;
$proto115["m_contained"] = array();
$proto115["m_strCase"] = "";
$proto115["m_havingmode"] = "0";
$proto115["m_inBrackets"] = "0";
$proto115["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto115);

$proto113["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto113);

$proto60["m_fromlist"][]=$obj;
$proto60["m_groupby"] = array();
$proto60["m_orderby"] = array();
												$proto117=array();
						$obj = new SQLField(array(
	"m_strName" => "no_urut",
	"m_strTable" => "masuk"
));

$proto117["m_column"]=$obj;
$proto117["m_bAsc"] = 0;
$proto117["m_nColumn"] = 0;
$obj = new SQLOrderByItem($proto117);

$proto60["m_orderby"][]=$obj;					
$obj = new SQLQuery($proto60);

$queryData_masuk = $obj;
$tdatamasuk[".sqlquery"] = $queryData_masuk;



?>
