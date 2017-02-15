<?php

//	field labels
$fieldLabelsagenda_hasil = array();
$fieldLabelsagenda_hasil["Indonesian"]=array();
$fieldLabelsagenda_hasil["Indonesian"]["id_hasil"] = "No";
$fieldLabelsagenda_hasil["Indonesian"]["id_hadir"] = "Petugas";
$fieldLabelsagenda_hasil["Indonesian"]["Hasil"] = "Laporan Kegiatan";
$fieldLabelsagenda_hasil["Indonesian"]["Catatan"] = "Catatan penting";
$fieldLabelsagenda_hasil["Indonesian"]["Naskah"] = "Naskah Digital";


$tdataagenda_hasil=array();
	$tdataagenda_hasil[".ShortName"]="agenda_hasil";
	$tdataagenda_hasil[".OwnerID"]="";
	$tdataagenda_hasil[".OriginalTable"]="agenda_hasil";
	$tdataagenda_hasil[".NCSearch"]=false;
	

$tdataagenda_hasil[".shortTableName"] = "agenda_hasil";
$tdataagenda_hasil[".dataSourceTable"] = "agenda_hasil";
$tdataagenda_hasil[".nSecOptions"] = 0;
$tdataagenda_hasil[".nLoginMethod"] = 1;
$tdataagenda_hasil[".recsPerRowList"] = 1;	
$tdataagenda_hasil[".tableGroupBy"] = "0";
$tdataagenda_hasil[".dbType"] = 0;
$tdataagenda_hasil[".mainTableOwnerID"] = "";
$tdataagenda_hasil[".moveNext"] = 1;

$tdataagenda_hasil[".listAjax"] = true;

	$tdataagenda_hasil[".audit"] = false;

	$tdataagenda_hasil[".locking"] = false;
	
$tdataagenda_hasil[".listIcons"] = true;
$tdataagenda_hasil[".edit"] = true;



$tdataagenda_hasil[".delete"] = true;

$tdataagenda_hasil[".showSimpleSearchOptions"] = false;

$tdataagenda_hasil[".showSearchPanel"] = false;


$tdataagenda_hasil[".isUseAjaxSuggest"] = false;

$tdataagenda_hasil[".rowHighlite"] = true;

$tdataagenda_hasil[".delFile"] = true;

// button handlers file names

// start on load js handlers








// end on load js handlers



$tdataagenda_hasil[".arrKeyFields"][] = "id_hasil";

// use datepicker for search panel
$tdataagenda_hasil[".isUseCalendarForSearch"] = false;

// use timepicker for search panel
$tdataagenda_hasil[".isUseTimeForSearch"] = false;






$tdataagenda_hasil[".isUseInlineJs"] = $tdataagenda_hasil[".isUseInlineAdd"] || $tdataagenda_hasil[".isUseInlineEdit"];

$tdataagenda_hasil[".allSearchFields"] = array();

$tdataagenda_hasil[".globSearchFields"][] = "id_hadir";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("id_hadir", $tdataagenda_hasil[".allSearchFields"]))
{
	$tdataagenda_hasil[".allSearchFields"][] = "id_hadir";	
}
$tdataagenda_hasil[".globSearchFields"][] = "Hasil";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Hasil", $tdataagenda_hasil[".allSearchFields"]))
{
	$tdataagenda_hasil[".allSearchFields"][] = "Hasil";	
}
$tdataagenda_hasil[".globSearchFields"][] = "Catatan";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Catatan", $tdataagenda_hasil[".allSearchFields"]))
{
	$tdataagenda_hasil[".allSearchFields"][] = "Catatan";	
}
$tdataagenda_hasil[".globSearchFields"][] = "Naskah";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Naskah", $tdataagenda_hasil[".allSearchFields"]))
{
	$tdataagenda_hasil[".allSearchFields"][] = "Naskah";	
}


$tdataagenda_hasil[".isDynamicPerm"] = true;

	


$tdataagenda_hasil[".isResizeColumns"] = false;


$tdataagenda_hasil[".createLoginPage"] = true;


 	




$tdataagenda_hasil[".pageSize"] = 5;

$gstrOrderBy = "ORDER BY id_hasil";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy = "order by ".$gstrOrderBy;
$tdataagenda_hasil[".strOrderBy"] = $gstrOrderBy;
	
$tdataagenda_hasil[".orderindexes"] = array();
$tdataagenda_hasil[".orderindexes"][] = array(1, (1 ? "ASC" : "DESC"), "id_hasil");

$tdataagenda_hasil[".sqlHead"] = "SELECT id_hasil,  id_hadir,  Hasil,  Catatan,  Naskah";

$tdataagenda_hasil[".sqlFrom"] = "FROM agenda_hasil";

$tdataagenda_hasil[".sqlWhereExpr"] = "";

$tdataagenda_hasil[".sqlTail"] = "";



	$tableKeys=array();
	$tableKeys[]="id_hasil";
	$tdataagenda_hasil[".Keys"]=$tableKeys;

	
//	id_hasil
	$fdata = array();
	$fdata["strName"] = "id_hasil";
	$fdata["ownerTable"] = "agenda_hasil";
		$fdata["Label"]="No"; 
			$fdata["FieldType"]= 3;
		$fdata["AutoInc"]=true;
			$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "id_hasil";
		$fdata["FullName"]= "id_hasil";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 1;
	
			$fdata["EditParams"]="";
			
											$tdataagenda_hasil["id_hasil"]=$fdata;
	
//	id_hadir
	$fdata = array();
	$fdata["strName"] = "id_hadir";
	$fdata["ownerTable"] = "agenda_hasil";
		$fdata["Label"]="Petugas"; 
			$fdata["FieldType"]= 3;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Lookup wizard";
	$fdata["ViewFormat"]= "";
	
	

		$fdata["LookupType"]=1;
	
				
					
	$fdata["LinkField"]="id_bos";
	$fdata["LinkFieldType"]=3;
	$fdata["DisplayField"]="Nama";
				$fdata["LookupTable"]="agenda_bos";
	$fdata["LookupOrderBy"]="";
						
				
							$fdata["AllowToAdd"]=true; 
				
					
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "id_hadir";
		$fdata["FullName"]= "id_hadir";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 2;
	
			 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataagenda_hasil["id_hadir"]=$fdata;
	
//	Hasil
	$fdata = array();
	$fdata["strName"] = "Hasil";
	$fdata["ownerTable"] = "agenda_hasil";
		$fdata["Label"]="Laporan Kegiatan"; 
			$fdata["FieldType"]= 201;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text area";
	$fdata["ViewFormat"]= "HTML";
	
	

		
			
	$fdata["GoodName"]= "Hasil";
		$fdata["FullName"]= "Hasil";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 3;
	
		$fdata["EditParams"]="";
			$fdata["EditParams"].= " rows=200";
		$fdata["nRows"] = 200;
			$fdata["EditParams"].= " cols=600";
		$fdata["nCols"] = 600;
		 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataagenda_hasil["Hasil"]=$fdata;
	
//	Catatan
	$fdata = array();
	$fdata["strName"] = "Catatan";
	$fdata["ownerTable"] = "agenda_hasil";
		$fdata["Label"]="Catatan penting"; 
			$fdata["FieldType"]= 201;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text area";
	$fdata["ViewFormat"]= "HTML";
	
	

		
			
	$fdata["GoodName"]= "Catatan";
		$fdata["FullName"]= "Catatan";
						$fdata["Index"]= 4;
	
		$fdata["EditParams"]="";
			$fdata["EditParams"].= " rows=50";
		$fdata["nRows"] = 50;
			$fdata["EditParams"].= " cols=600";
		$fdata["nCols"] = 600;
		 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataagenda_hasil["Catatan"]=$fdata;
	
//	Naskah
	$fdata = array();
	$fdata["strName"] = "Naskah";
	$fdata["ownerTable"] = "agenda_hasil";
		$fdata["Label"]="Naskah Digital"; 
			$fdata["LinkPrefix"]="hasilrapat/"; 
	$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Document upload";
	$fdata["ViewFormat"]= "Document Download";
	
	

		
			
	$fdata["GoodName"]= "Naskah";
		$fdata["FullName"]= "Naskah";
				$fdata["UseTimestamp"]=true; 
		$fdata["UploadFolder"]="hasilrapat"; 
		$fdata["Index"]= 5;
	
			 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataagenda_hasil["Naskah"]=$fdata;

	
$tables_data["agenda_hasil"]=&$tdataagenda_hasil;
$field_labels["agenda_hasil"] = &$fieldLabelsagenda_hasil;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["agenda_hasil"] = array();

	
// tables which are master tables for current table (detail)
$masterTablesData["agenda_hasil"] = array();

$mIndex = 1-1;
			$strOriginalDetailsTable="agenda_hadir";
	$masterTablesData["agenda_hasil"][$mIndex] = array(
		  "mDataSourceTable"=>"agenda_hadir"
		, "mOriginalTable" => $strOriginalDetailsTable
		, "mShortTable" => "agenda_hadir"
		, "masterKeys" => array()
		, "detailKeys" => array()
		, "dispChildCount" => "1"
		, "hideChild" => "0"	
		, "dispInfo" => "1"								
		, "previewOnList" => 0
		, "previewOnAdd" => 1
		, "previewOnEdit" => 1
		, "previewOnView" => 0
	);	
		$masterTablesData["agenda_hasil"][$mIndex]["masterKeys"][]="id_bos";
		$masterTablesData["agenda_hasil"][$mIndex]["detailKeys"][]="id_hadir";

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










$proto73=array();
$proto73["m_strHead"] = "SELECT";
$proto73["m_strFieldList"] = "id_hasil,  id_hadir,  Hasil,  Catatan,  Naskah";
$proto73["m_strFrom"] = "FROM agenda_hasil";
$proto73["m_strWhere"] = "";
$proto73["m_strOrderBy"] = "ORDER BY id_hasil";
$proto73["m_strTail"] = "";
$proto74=array();
$proto74["m_sql"] = "";
$proto74["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto74["m_column"]=$obj;
$proto74["m_contained"] = array();
$proto74["m_strCase"] = "";
$proto74["m_havingmode"] = "0";
$proto74["m_inBrackets"] = "0";
$proto74["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto74);

$proto73["m_where"] = $obj;
$proto76=array();
$proto76["m_sql"] = "";
$proto76["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto76["m_column"]=$obj;
$proto76["m_contained"] = array();
$proto76["m_strCase"] = "";
$proto76["m_havingmode"] = "0";
$proto76["m_inBrackets"] = "0";
$proto76["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto76);

$proto73["m_having"] = $obj;
$proto73["m_fieldlist"] = array();
						$proto78=array();
			$obj = new SQLField(array(
	"m_strName" => "id_hasil",
	"m_strTable" => "agenda_hasil"
));

$proto78["m_expr"]=$obj;
$proto78["m_alias"] = "";
$obj = new SQLFieldListItem($proto78);

$proto73["m_fieldlist"][]=$obj;
						$proto80=array();
			$obj = new SQLField(array(
	"m_strName" => "id_hadir",
	"m_strTable" => "agenda_hasil"
));

$proto80["m_expr"]=$obj;
$proto80["m_alias"] = "";
$obj = new SQLFieldListItem($proto80);

$proto73["m_fieldlist"][]=$obj;
						$proto82=array();
			$obj = new SQLField(array(
	"m_strName" => "Hasil",
	"m_strTable" => "agenda_hasil"
));

$proto82["m_expr"]=$obj;
$proto82["m_alias"] = "";
$obj = new SQLFieldListItem($proto82);

$proto73["m_fieldlist"][]=$obj;
						$proto84=array();
			$obj = new SQLField(array(
	"m_strName" => "Catatan",
	"m_strTable" => "agenda_hasil"
));

$proto84["m_expr"]=$obj;
$proto84["m_alias"] = "";
$obj = new SQLFieldListItem($proto84);

$proto73["m_fieldlist"][]=$obj;
						$proto86=array();
			$obj = new SQLField(array(
	"m_strName" => "Naskah",
	"m_strTable" => "agenda_hasil"
));

$proto86["m_expr"]=$obj;
$proto86["m_alias"] = "";
$obj = new SQLFieldListItem($proto86);

$proto73["m_fieldlist"][]=$obj;
$proto73["m_fromlist"] = array();
												$proto88=array();
$proto88["m_link"] = "SQLL_MAIN";
			$proto89=array();
$proto89["m_strName"] = "agenda_hasil";
$proto89["m_columns"] = array();
$proto89["m_columns"][] = "id_hasil";
$proto89["m_columns"][] = "id_hadir";
$proto89["m_columns"][] = "Hasil";
$proto89["m_columns"][] = "Catatan";
$proto89["m_columns"][] = "Naskah";
$obj = new SQLTable($proto89);

$proto88["m_table"] = $obj;
$proto88["m_alias"] = "";
$proto90=array();
$proto90["m_sql"] = "";
$proto90["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto90["m_column"]=$obj;
$proto90["m_contained"] = array();
$proto90["m_strCase"] = "";
$proto90["m_havingmode"] = "0";
$proto90["m_inBrackets"] = "0";
$proto90["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto90);

$proto88["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto88);

$proto73["m_fromlist"][]=$obj;
$proto73["m_groupby"] = array();
$proto73["m_orderby"] = array();
												$proto92=array();
						$obj = new SQLField(array(
	"m_strName" => "id_hasil",
	"m_strTable" => "agenda_hasil"
));

$proto92["m_column"]=$obj;
$proto92["m_bAsc"] = 1;
$proto92["m_nColumn"] = 0;
$obj = new SQLOrderByItem($proto92);

$proto73["m_orderby"][]=$obj;					
$obj = new SQLQuery($proto73);

$queryData_agenda_hasil = $obj;
$tdataagenda_hasil[".sqlquery"] = $queryData_agenda_hasil;



?>
