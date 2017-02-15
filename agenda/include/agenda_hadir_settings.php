<?php

//	field labels
$fieldLabelsagenda_hadir = array();
$fieldLabelsagenda_hadir["Indonesian"]=array();
$fieldLabelsagenda_hadir["Indonesian"]["id_hadir"] = "No";
$fieldLabelsagenda_hadir["Indonesian"]["id_agenda"] = "Agenda";
$fieldLabelsagenda_hadir["Indonesian"]["Instansi"] = "Instansi";
$fieldLabelsagenda_hadir["Indonesian"]["id_bos"] = "Petugas";
$fieldLabelsagenda_hadir["Indonesian"]["Jabatan"] = "Jabatan";
$fieldLabelsagenda_hadir["Indonesian"]["Jam"] = "Jam entri";


$tdataagenda_hadir=array();
	$tdataagenda_hadir[".ShortName"]="agenda_hadir";
	$tdataagenda_hadir[".OwnerID"]="";
	$tdataagenda_hadir[".OriginalTable"]="agenda_hadir";
	$tdataagenda_hadir[".NCSearch"]=false;
	

$tdataagenda_hadir[".shortTableName"] = "agenda_hadir";
$tdataagenda_hadir[".dataSourceTable"] = "agenda_hadir";
$tdataagenda_hadir[".nSecOptions"] = 0;
$tdataagenda_hadir[".nLoginMethod"] = 1;
$tdataagenda_hadir[".recsPerRowList"] = 1;	
$tdataagenda_hadir[".tableGroupBy"] = "0";
$tdataagenda_hadir[".dbType"] = 0;
$tdataagenda_hadir[".mainTableOwnerID"] = "";
$tdataagenda_hadir[".moveNext"] = 1;

$tdataagenda_hadir[".listAjax"] = true;

	$tdataagenda_hadir[".audit"] = false;

	$tdataagenda_hadir[".locking"] = false;
	
$tdataagenda_hadir[".listIcons"] = true;
$tdataagenda_hadir[".edit"] = true;



$tdataagenda_hadir[".delete"] = true;

$tdataagenda_hadir[".showSimpleSearchOptions"] = false;

$tdataagenda_hadir[".showSearchPanel"] = false;


$tdataagenda_hadir[".isUseAjaxSuggest"] = false;

$tdataagenda_hadir[".rowHighlite"] = true;

$tdataagenda_hadir[".delFile"] = true;

// button handlers file names

// start on load js handlers








// end on load js handlers



$tdataagenda_hadir[".arrKeyFields"][] = "id_hadir";

// use datepicker for search panel
$tdataagenda_hadir[".isUseCalendarForSearch"] = false;

// use timepicker for search panel
$tdataagenda_hadir[".isUseTimeForSearch"] = false;






$tdataagenda_hadir[".isUseInlineJs"] = $tdataagenda_hadir[".isUseInlineAdd"] || $tdataagenda_hadir[".isUseInlineEdit"];

$tdataagenda_hadir[".allSearchFields"] = array();

$tdataagenda_hadir[".globSearchFields"][] = "id_agenda";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("id_agenda", $tdataagenda_hadir[".allSearchFields"]))
{
	$tdataagenda_hadir[".allSearchFields"][] = "id_agenda";	
}
$tdataagenda_hadir[".globSearchFields"][] = "Instansi";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Instansi", $tdataagenda_hadir[".allSearchFields"]))
{
	$tdataagenda_hadir[".allSearchFields"][] = "Instansi";	
}
$tdataagenda_hadir[".globSearchFields"][] = "id_bos";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("id_bos", $tdataagenda_hadir[".allSearchFields"]))
{
	$tdataagenda_hadir[".allSearchFields"][] = "id_bos";	
}
$tdataagenda_hadir[".globSearchFields"][] = "Jabatan";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Jabatan", $tdataagenda_hadir[".allSearchFields"]))
{
	$tdataagenda_hadir[".allSearchFields"][] = "Jabatan";	
}

$tdataagenda_hadir[".panelSearchFields"][] = "id_agenda";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("id_agenda", $tdataagenda_hadir[".allSearchFields"])) 
{
	$tdataagenda_hadir[".allSearchFields"][] = "id_agenda";	
}
$tdataagenda_hadir[".panelSearchFields"][] = "Instansi";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Instansi", $tdataagenda_hadir[".allSearchFields"])) 
{
	$tdataagenda_hadir[".allSearchFields"][] = "Instansi";	
}
$tdataagenda_hadir[".panelSearchFields"][] = "id_bos";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("id_bos", $tdataagenda_hadir[".allSearchFields"])) 
{
	$tdataagenda_hadir[".allSearchFields"][] = "id_bos";	
}
$tdataagenda_hadir[".panelSearchFields"][] = "Jabatan";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Jabatan", $tdataagenda_hadir[".allSearchFields"])) 
{
	$tdataagenda_hadir[".allSearchFields"][] = "Jabatan";	
}

$tdataagenda_hadir[".isDynamicPerm"] = true;

	


$tdataagenda_hadir[".isResizeColumns"] = false;


$tdataagenda_hadir[".createLoginPage"] = true;


 	
	$tdataagenda_hadir[".subQueriesSupAccess"] = true;




$tdataagenda_hadir[".pageSize"] = 5;

$gstrOrderBy = "ORDER BY id_hadir";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy = "order by ".$gstrOrderBy;
$tdataagenda_hadir[".strOrderBy"] = $gstrOrderBy;
	
$tdataagenda_hadir[".orderindexes"] = array();
$tdataagenda_hadir[".orderindexes"][] = array(1, (1 ? "ASC" : "DESC"), "id_hadir");

$tdataagenda_hadir[".sqlHead"] = "SELECT id_hadir,  id_agenda,  Instansi,  id_bos,  Jabatan,  Jam";

$tdataagenda_hadir[".sqlFrom"] = "FROM agenda_hadir";

$tdataagenda_hadir[".sqlWhereExpr"] = "";

$tdataagenda_hadir[".sqlTail"] = "";



	$tableKeys=array();
	$tableKeys[]="id_hadir";
	$tdataagenda_hadir[".Keys"]=$tableKeys;

	
//	id_hadir
	$fdata = array();
	$fdata["strName"] = "id_hadir";
	$fdata["ownerTable"] = "agenda_hadir";
		$fdata["Label"]="No"; 
			$fdata["FieldType"]= 3;
		$fdata["AutoInc"]=true;
			$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "id_hadir";
		$fdata["FullName"]= "id_hadir";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 1;
	
			$fdata["EditParams"]="";
			
											$tdataagenda_hadir["id_hadir"]=$fdata;
	
//	id_agenda
	$fdata = array();
	$fdata["strName"] = "id_agenda";
	$fdata["ownerTable"] = "agenda_hadir";
		$fdata["Label"]="Agenda"; 
			$fdata["FieldType"]= 3;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Lookup wizard";
	$fdata["ViewFormat"]= "";
	
	

		$fdata["LookupType"]=1;
	
				
					
	$fdata["LinkField"]="id_agenda";
	$fdata["LinkFieldType"]=3;
	$fdata["DisplayField"]="Apa";
				$fdata["LookupTable"]="agenda";
	$fdata["LookupOrderBy"]="";
						
				
										
					
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "id_agenda";
		$fdata["FullName"]= "id_agenda";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 2;
	
			 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataagenda_hadir["id_agenda"]=$fdata;
	
//	Instansi
	$fdata = array();
	$fdata["strName"] = "Instansi";
	$fdata["ownerTable"] = "agenda_hadir";
				$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Lookup wizard";
	$fdata["ViewFormat"]= "";
	
	

		$fdata["LookupType"]=1;
	
				
					
	$fdata["LinkField"]="A5";
	$fdata["LinkFieldType"]=200;
	$fdata["DisplayField"]="Unit_org";
				$fdata["LookupTable"]="unit";
	$fdata["LookupOrderBy"]="";
						
				
										$fdata["SimpleAdd"]=true;
	
				//	dependent dropdowns	
	$fdata["DependentLookups"]=array();
	$fdata["DependentLookups"][]="id_bos";
					
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Instansi";
		$fdata["FullName"]= "Instansi";
						$fdata["Index"]= 3;
	
			 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataagenda_hadir["Instansi"]=$fdata;
	
//	id_bos
	$fdata = array();
	$fdata["strName"] = "id_bos";
	$fdata["ownerTable"] = "agenda_hadir";
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
						
				$fdata["UseCategory"]=true; 
	$fdata["CategoryControl"]="Instansi"; 
	$fdata["CategoryFilter"]="id_unit"; 
	
							$fdata["AllowToAdd"]=true; 
				
				//	dependent dropdowns	
	$fdata["DependentLookups"]=array();
	$fdata["DependentLookups"][]="Jabatan";
					
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "id_bos";
		$fdata["FullName"]= "id_bos";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 4;
	
			 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataagenda_hadir["id_bos"]=$fdata;
	
//	Jabatan
	$fdata = array();
	$fdata["strName"] = "Jabatan";
	$fdata["ownerTable"] = "agenda_hadir";
				$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Lookup wizard";
	$fdata["ViewFormat"]= "";
	
	

		$fdata["LookupType"]=1;
	
				
					
	$fdata["LinkField"]="Jabatan";
	$fdata["LinkFieldType"]=200;
	$fdata["DisplayField"]="Jabatan";
				$fdata["LookupTable"]="agenda_bos";
	$fdata["LookupOrderBy"]="";
						
				$fdata["UseCategory"]=true; 
	$fdata["CategoryControl"]="id_bos"; 
	$fdata["CategoryFilter"]="id_bos"; 
	
										
					
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Jabatan";
		$fdata["FullName"]= "Jabatan";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 5;
	
			 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataagenda_hadir["Jabatan"]=$fdata;
	
//	Jam
	$fdata = array();
	$fdata["strName"] = "Jam";
	$fdata["ownerTable"] = "agenda_hadir";
		$fdata["Label"]="Jam entri"; 
			$fdata["FieldType"]= 135;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Readonly";
	$fdata["ViewFormat"]= "Short Date";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Jam";
		$fdata["FullName"]= "Jam";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 6;
	
			 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataagenda_hadir["Jam"]=$fdata;

	
$tables_data["agenda_hadir"]=&$tdataagenda_hadir;
$field_labels["agenda_hadir"] = &$fieldLabelsagenda_hadir;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["agenda_hadir"] = array();
$dIndex = 1-1;
			$strOriginalDetailsTable="agenda_hasil";
	$detailsTablesData["agenda_hadir"][$dIndex] = array(
		  "dDataSourceTable"=>"agenda_hasil"
		, "dOriginalTable"=>$strOriginalDetailsTable
		, "dShortTable"=>"agenda_hasil"
		, "masterKeys"=>array()
		, "detailKeys"=>array()
		, "dispChildCount"=> "1"
		, "hideChild"=>"0"
		, "sqlHead"=>"SELECT id_hasil,  id_hadir,  Hasil,  Catatan,  Naskah"	
		, "sqlFrom"=>"FROM agenda_hasil"	
		, "sqlWhere"=>""
		, "sqlTail"=>""
		, "groupBy"=>"0"
		, "previewOnList" => 0
		, "previewOnAdd" => 1
		, "previewOnEdit" => 1
		, "previewOnView" => 0
	);	
		$detailsTablesData["agenda_hadir"][$dIndex]["masterKeys"][]="id_bos";
		$detailsTablesData["agenda_hadir"][$dIndex]["detailKeys"][]="id_hadir";


	
// tables which are master tables for current table (detail)
$masterTablesData["agenda_hadir"] = array();

$mIndex = 1-1;
			$strOriginalDetailsTable="agenda";
	$masterTablesData["agenda_hadir"][$mIndex] = array(
		  "mDataSourceTable"=>"agenda"
		, "mOriginalTable" => $strOriginalDetailsTable
		, "mShortTable" => "agenda"
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
		$masterTablesData["agenda_hadir"][$mIndex]["masterKeys"][]="id_agenda";
		$masterTablesData["agenda_hadir"][$mIndex]["detailKeys"][]="id_agenda";

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










$proto94=array();
$proto94["m_strHead"] = "SELECT";
$proto94["m_strFieldList"] = "id_hadir,  id_agenda,  Instansi,  id_bos,  Jabatan,  Jam";
$proto94["m_strFrom"] = "FROM agenda_hadir";
$proto94["m_strWhere"] = "";
$proto94["m_strOrderBy"] = "ORDER BY id_hadir";
$proto94["m_strTail"] = "";
$proto95=array();
$proto95["m_sql"] = "";
$proto95["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto95["m_column"]=$obj;
$proto95["m_contained"] = array();
$proto95["m_strCase"] = "";
$proto95["m_havingmode"] = "0";
$proto95["m_inBrackets"] = "0";
$proto95["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto95);

$proto94["m_where"] = $obj;
$proto97=array();
$proto97["m_sql"] = "";
$proto97["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto97["m_column"]=$obj;
$proto97["m_contained"] = array();
$proto97["m_strCase"] = "";
$proto97["m_havingmode"] = "0";
$proto97["m_inBrackets"] = "0";
$proto97["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto97);

$proto94["m_having"] = $obj;
$proto94["m_fieldlist"] = array();
						$proto99=array();
			$obj = new SQLField(array(
	"m_strName" => "id_hadir",
	"m_strTable" => "agenda_hadir"
));

$proto99["m_expr"]=$obj;
$proto99["m_alias"] = "";
$obj = new SQLFieldListItem($proto99);

$proto94["m_fieldlist"][]=$obj;
						$proto101=array();
			$obj = new SQLField(array(
	"m_strName" => "id_agenda",
	"m_strTable" => "agenda_hadir"
));

$proto101["m_expr"]=$obj;
$proto101["m_alias"] = "";
$obj = new SQLFieldListItem($proto101);

$proto94["m_fieldlist"][]=$obj;
						$proto103=array();
			$obj = new SQLField(array(
	"m_strName" => "Instansi",
	"m_strTable" => "agenda_hadir"
));

$proto103["m_expr"]=$obj;
$proto103["m_alias"] = "";
$obj = new SQLFieldListItem($proto103);

$proto94["m_fieldlist"][]=$obj;
						$proto105=array();
			$obj = new SQLField(array(
	"m_strName" => "id_bos",
	"m_strTable" => "agenda_hadir"
));

$proto105["m_expr"]=$obj;
$proto105["m_alias"] = "";
$obj = new SQLFieldListItem($proto105);

$proto94["m_fieldlist"][]=$obj;
						$proto107=array();
			$obj = new SQLField(array(
	"m_strName" => "Jabatan",
	"m_strTable" => "agenda_hadir"
));

$proto107["m_expr"]=$obj;
$proto107["m_alias"] = "";
$obj = new SQLFieldListItem($proto107);

$proto94["m_fieldlist"][]=$obj;
						$proto109=array();
			$obj = new SQLField(array(
	"m_strName" => "Jam",
	"m_strTable" => "agenda_hadir"
));

$proto109["m_expr"]=$obj;
$proto109["m_alias"] = "";
$obj = new SQLFieldListItem($proto109);

$proto94["m_fieldlist"][]=$obj;
$proto94["m_fromlist"] = array();
												$proto111=array();
$proto111["m_link"] = "SQLL_MAIN";
			$proto112=array();
$proto112["m_strName"] = "agenda_hadir";
$proto112["m_columns"] = array();
$proto112["m_columns"][] = "id_hadir";
$proto112["m_columns"][] = "id_agenda";
$proto112["m_columns"][] = "Instansi";
$proto112["m_columns"][] = "id_bos";
$proto112["m_columns"][] = "Jabatan";
$proto112["m_columns"][] = "Jam";
$obj = new SQLTable($proto112);

$proto111["m_table"] = $obj;
$proto111["m_alias"] = "";
$proto113=array();
$proto113["m_sql"] = "";
$proto113["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto113["m_column"]=$obj;
$proto113["m_contained"] = array();
$proto113["m_strCase"] = "";
$proto113["m_havingmode"] = "0";
$proto113["m_inBrackets"] = "0";
$proto113["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto113);

$proto111["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto111);

$proto94["m_fromlist"][]=$obj;
$proto94["m_groupby"] = array();
$proto94["m_orderby"] = array();
												$proto115=array();
						$obj = new SQLField(array(
	"m_strName" => "id_hadir",
	"m_strTable" => "agenda_hadir"
));

$proto115["m_column"]=$obj;
$proto115["m_bAsc"] = 1;
$proto115["m_nColumn"] = 0;
$obj = new SQLOrderByItem($proto115);

$proto94["m_orderby"][]=$obj;					
$obj = new SQLQuery($proto94);

$queryData_agenda_hadir = $obj;
$tdataagenda_hadir[".sqlquery"] = $queryData_agenda_hadir;



?>
