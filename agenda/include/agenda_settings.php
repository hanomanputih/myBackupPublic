<?php

//	field labels
$fieldLabelsagenda = array();
$fieldLabelsagenda["Indonesian"]=array();
$fieldLabelsagenda["Indonesian"]["id_agenda"] = "Id Agenda";
$fieldLabelsagenda["Indonesian"]["id_masuk"] = "Surat Masuk";
$fieldLabelsagenda["Indonesian"]["Apa"] = "Agenda";
$fieldLabelsagenda["Indonesian"]["Tgl_mulai"] = "Mulai Tanggal";
$fieldLabelsagenda["Indonesian"]["Tgl_akhir"] = "Berakhir Tanggal";
$fieldLabelsagenda["Indonesian"]["Jam_mulai"] = "Jam";
$fieldLabelsagenda["Indonesian"]["Jam_akhir"] = "Jam";
$fieldLabelsagenda["Indonesian"]["Tempat"] = "Tempat";


$tdataagenda=array();
	$tdataagenda[".ShortName"]="agenda";
	$tdataagenda[".OwnerID"]="";
	$tdataagenda[".OriginalTable"]="agenda";
	$tdataagenda[".NCSearch"]=false;
	

$tdataagenda[".shortTableName"] = "agenda";
$tdataagenda[".dataSourceTable"] = "agenda";
$tdataagenda[".nSecOptions"] = 0;
$tdataagenda[".nLoginMethod"] = 1;
$tdataagenda[".recsPerRowList"] = 1;	
$tdataagenda[".tableGroupBy"] = "0";
$tdataagenda[".dbType"] = 0;
$tdataagenda[".mainTableOwnerID"] = "";
$tdataagenda[".moveNext"] = 1;

$tdataagenda[".listAjax"] = true;

	$tdataagenda[".audit"] = false;

	$tdataagenda[".locking"] = false;
	
$tdataagenda[".listIcons"] = true;
$tdataagenda[".edit"] = true;



$tdataagenda[".delete"] = true;

$tdataagenda[".showSimpleSearchOptions"] = false;

$tdataagenda[".showSearchPanel"] = false;


$tdataagenda[".isUseAjaxSuggest"] = false;

$tdataagenda[".rowHighlite"] = true;

$tdataagenda[".delFile"] = true;

// button handlers file names

// start on load js handlers








// end on load js handlers



$tdataagenda[".arrKeyFields"][] = "id_agenda";

// use datepicker for search panel
$tdataagenda[".isUseCalendarForSearch"] = true;

// use timepicker for search panel
$tdataagenda[".isUseTimeForSearch"] = true;






$tdataagenda[".isUseInlineJs"] = $tdataagenda[".isUseInlineAdd"] || $tdataagenda[".isUseInlineEdit"];

$tdataagenda[".allSearchFields"] = array();

$tdataagenda[".globSearchFields"][] = "id_masuk";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("id_masuk", $tdataagenda[".allSearchFields"]))
{
	$tdataagenda[".allSearchFields"][] = "id_masuk";	
}
$tdataagenda[".globSearchFields"][] = "Apa";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Apa", $tdataagenda[".allSearchFields"]))
{
	$tdataagenda[".allSearchFields"][] = "Apa";	
}
$tdataagenda[".globSearchFields"][] = "Tgl_mulai";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Tgl_mulai", $tdataagenda[".allSearchFields"]))
{
	$tdataagenda[".allSearchFields"][] = "Tgl_mulai";	
}
$tdataagenda[".globSearchFields"][] = "Jam_mulai";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Jam_mulai", $tdataagenda[".allSearchFields"]))
{
	$tdataagenda[".allSearchFields"][] = "Jam_mulai";	
}
$tdataagenda[".globSearchFields"][] = "Tgl_akhir";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Tgl_akhir", $tdataagenda[".allSearchFields"]))
{
	$tdataagenda[".allSearchFields"][] = "Tgl_akhir";	
}
$tdataagenda[".globSearchFields"][] = "Jam_akhir";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Jam_akhir", $tdataagenda[".allSearchFields"]))
{
	$tdataagenda[".allSearchFields"][] = "Jam_akhir";	
}
$tdataagenda[".globSearchFields"][] = "Tempat";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Tempat", $tdataagenda[".allSearchFields"]))
{
	$tdataagenda[".allSearchFields"][] = "Tempat";	
}

$tdataagenda[".panelSearchFields"][] = "id_masuk";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("id_masuk", $tdataagenda[".allSearchFields"])) 
{
	$tdataagenda[".allSearchFields"][] = "id_masuk";	
}
$tdataagenda[".panelSearchFields"][] = "Apa";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Apa", $tdataagenda[".allSearchFields"])) 
{
	$tdataagenda[".allSearchFields"][] = "Apa";	
}
$tdataagenda[".panelSearchFields"][] = "Tgl_mulai";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Tgl_mulai", $tdataagenda[".allSearchFields"])) 
{
	$tdataagenda[".allSearchFields"][] = "Tgl_mulai";	
}
$tdataagenda[".panelSearchFields"][] = "Jam_mulai";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Jam_mulai", $tdataagenda[".allSearchFields"])) 
{
	$tdataagenda[".allSearchFields"][] = "Jam_mulai";	
}
$tdataagenda[".panelSearchFields"][] = "Tgl_akhir";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Tgl_akhir", $tdataagenda[".allSearchFields"])) 
{
	$tdataagenda[".allSearchFields"][] = "Tgl_akhir";	
}
$tdataagenda[".panelSearchFields"][] = "Jam_akhir";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Jam_akhir", $tdataagenda[".allSearchFields"])) 
{
	$tdataagenda[".allSearchFields"][] = "Jam_akhir";	
}
$tdataagenda[".panelSearchFields"][] = "Tempat";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Tempat", $tdataagenda[".allSearchFields"])) 
{
	$tdataagenda[".allSearchFields"][] = "Tempat";	
}

$tdataagenda[".isDynamicPerm"] = true;

	


$tdataagenda[".isResizeColumns"] = false;


$tdataagenda[".createLoginPage"] = true;


 	
	$tdataagenda[".subQueriesSupAccess"] = true;




$tdataagenda[".pageSize"] = 5;

$gstrOrderBy = "ORDER BY id_agenda";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy = "order by ".$gstrOrderBy;
$tdataagenda[".strOrderBy"] = $gstrOrderBy;
	
$tdataagenda[".orderindexes"] = array();
$tdataagenda[".orderindexes"][] = array(1, (1 ? "ASC" : "DESC"), "id_agenda");

$tdataagenda[".sqlHead"] = "SELECT id_agenda,  id_masuk,  Apa,  Tgl_mulai,  Tgl_akhir,  Jam_mulai,  Jam_akhir,  Tempat";

$tdataagenda[".sqlFrom"] = "FROM agenda";

$tdataagenda[".sqlWhereExpr"] = "";

$tdataagenda[".sqlTail"] = "";



	$tableKeys=array();
	$tableKeys[]="id_agenda";
	$tdataagenda[".Keys"]=$tableKeys;

	
//	id_agenda
	$fdata = array();
	$fdata["strName"] = "id_agenda";
	$fdata["ownerTable"] = "agenda";
		$fdata["Label"]="Id Agenda"; 
			$fdata["FieldType"]= 3;
		$fdata["AutoInc"]=true;
			$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "id_agenda";
		$fdata["FullName"]= "id_agenda";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 1;
	
			$fdata["EditParams"]="";
			
				$fdata["FieldPermissions"]=true;
								$tdataagenda["id_agenda"]=$fdata;
	
//	id_masuk
	$fdata = array();
	$fdata["strName"] = "id_masuk";
	$fdata["ownerTable"] = "agenda";
		$fdata["Label"]="Surat Masuk"; 
			$fdata["FieldType"]= 3;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Lookup wizard";
	$fdata["ViewFormat"]= "";
	
	

		$fdata["LookupType"]=1;
	
				
					
	$fdata["LinkField"]="no_urut";
	$fdata["LinkFieldType"]=3;
	$fdata["DisplayField"]="IsiRingkas";
				$fdata["LookupTable"]="masuk";
	$fdata["LookupOrderBy"]="";
						
				
										
					
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "id_masuk";
		$fdata["FullName"]= "id_masuk";
						$fdata["Index"]= 2;
	
			 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataagenda["id_masuk"]=$fdata;
	
//	Apa
	$fdata = array();
	$fdata["strName"] = "Apa";
	$fdata["ownerTable"] = "agenda";
		$fdata["Label"]="Agenda"; 
			$fdata["FieldType"]= 201;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text area";
	$fdata["ViewFormat"]= "HTML";
	
	

		
			
	$fdata["GoodName"]= "Apa";
		$fdata["FullName"]= "Apa";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 3;
	
		$fdata["EditParams"]="";
			$fdata["EditParams"].= " rows=100";
		$fdata["nRows"] = 100;
			$fdata["EditParams"].= " cols=600";
		$fdata["nCols"] = 600;
		 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataagenda["Apa"]=$fdata;
	
//	Tgl_mulai
	$fdata = array();
	$fdata["strName"] = "Tgl_mulai";
	$fdata["ownerTable"] = "agenda";
		$fdata["Label"]="Mulai Tanggal"; 
			$fdata["FieldType"]= 7;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Date";
	$fdata["ViewFormat"]= "Long Date";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Tgl_mulai";
		$fdata["FullName"]= "Tgl_mulai";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 4;
	 $fdata["DateEditType"]=13; 
			 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataagenda["Tgl_mulai"]=$fdata;
	
//	Tgl_akhir
	$fdata = array();
	$fdata["strName"] = "Tgl_akhir";
	$fdata["ownerTable"] = "agenda";
		$fdata["Label"]="Berakhir Tanggal"; 
			$fdata["FieldType"]= 7;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Date";
	$fdata["ViewFormat"]= "Long Date";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Tgl_akhir";
		$fdata["FullName"]= "Tgl_akhir";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 5;
	 $fdata["DateEditType"]=13; 
			 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataagenda["Tgl_akhir"]=$fdata;
	
//	Jam_mulai
	$fdata = array();
	$fdata["strName"] = "Jam_mulai";
	$fdata["ownerTable"] = "agenda";
		$fdata["Label"]="Jam"; 
			$fdata["FieldType"]= 134;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Time";
	$fdata["ViewFormat"]= "Time";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Jam_mulai";
		$fdata["FullName"]= "Jam_mulai";
						$fdata["Index"]= 6;
	
			$fdata["EditParams"]="";
			 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
				$fdata["FormatTimeAttrs"] = array("useTimePicker" => 1,
										  "hours" => 24,
										  "minutes" => 30,
										  "showSeconds" => 0);
	$tdataagenda["Jam_mulai"]=$fdata;
	
//	Jam_akhir
	$fdata = array();
	$fdata["strName"] = "Jam_akhir";
	$fdata["ownerTable"] = "agenda";
		$fdata["Label"]="Jam"; 
			$fdata["FieldType"]= 134;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Time";
	$fdata["ViewFormat"]= "Time";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Jam_akhir";
		$fdata["FullName"]= "Jam_akhir";
						$fdata["Index"]= 7;
	
			$fdata["EditParams"]="";
			 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
				$fdata["FormatTimeAttrs"] = array("useTimePicker" => 1,
										  "hours" => 24,
										  "minutes" => 30,
										  "showSeconds" => 0);
	$tdataagenda["Jam_akhir"]=$fdata;
	
//	Tempat
	$fdata = array();
	$fdata["strName"] = "Tempat";
	$fdata["ownerTable"] = "agenda";
				$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Tempat";
		$fdata["FullName"]= "Tempat";
		$fdata["IsRequired"]=true; 
					$fdata["Index"]= 8;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=250";
			$fdata["EditParams"].= " size=70";
	 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataagenda["Tempat"]=$fdata;

	
$tables_data["agenda"]=&$tdataagenda;
$field_labels["agenda"] = &$fieldLabelsagenda;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["agenda"] = array();
$dIndex = 1-1;
			$strOriginalDetailsTable="agenda_hadir";
	$detailsTablesData["agenda"][$dIndex] = array(
		  "dDataSourceTable"=>"agenda_hadir"
		, "dOriginalTable"=>$strOriginalDetailsTable
		, "dShortTable"=>"agenda_hadir"
		, "masterKeys"=>array()
		, "detailKeys"=>array()
		, "dispChildCount"=> "1"
		, "hideChild"=>"0"
		, "sqlHead"=>"SELECT id_hadir,  id_agenda,  Instansi,  id_bos,  Jabatan,  Jam"	
		, "sqlFrom"=>"FROM agenda_hadir"	
		, "sqlWhere"=>""
		, "sqlTail"=>""
		, "groupBy"=>"0"
		, "previewOnList" => 0
		, "previewOnAdd" => 1
		, "previewOnEdit" => 1
		, "previewOnView" => 0
	);	
		$detailsTablesData["agenda"][$dIndex]["masterKeys"][]="id_agenda";
		$detailsTablesData["agenda"][$dIndex]["detailKeys"][]="id_agenda";


	
// tables which are master tables for current table (detail)
$masterTablesData["agenda"] = array();

$mIndex = 1-1;
			$strOriginalDetailsTable="masuk";
	$masterTablesData["agenda"][$mIndex] = array(
		  "mDataSourceTable"=>"masuk"
		, "mOriginalTable" => $strOriginalDetailsTable
		, "mShortTable" => "masuk"
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
		$masterTablesData["agenda"][$mIndex]["masterKeys"][]="no_urut";
		$masterTablesData["agenda"][$mIndex]["detailKeys"][]="id_masuk";

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










$proto148=array();
$proto148["m_strHead"] = "SELECT";
$proto148["m_strFieldList"] = "id_agenda,  id_masuk,  Apa,  Tgl_mulai,  Tgl_akhir,  Jam_mulai,  Jam_akhir,  Tempat";
$proto148["m_strFrom"] = "FROM agenda";
$proto148["m_strWhere"] = "";
$proto148["m_strOrderBy"] = "ORDER BY id_agenda";
$proto148["m_strTail"] = "";
$proto149=array();
$proto149["m_sql"] = "";
$proto149["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto149["m_column"]=$obj;
$proto149["m_contained"] = array();
$proto149["m_strCase"] = "";
$proto149["m_havingmode"] = "0";
$proto149["m_inBrackets"] = "0";
$proto149["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto149);

$proto148["m_where"] = $obj;
$proto151=array();
$proto151["m_sql"] = "";
$proto151["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto151["m_column"]=$obj;
$proto151["m_contained"] = array();
$proto151["m_strCase"] = "";
$proto151["m_havingmode"] = "0";
$proto151["m_inBrackets"] = "0";
$proto151["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto151);

$proto148["m_having"] = $obj;
$proto148["m_fieldlist"] = array();
						$proto153=array();
			$obj = new SQLField(array(
	"m_strName" => "id_agenda",
	"m_strTable" => "agenda"
));

$proto153["m_expr"]=$obj;
$proto153["m_alias"] = "";
$obj = new SQLFieldListItem($proto153);

$proto148["m_fieldlist"][]=$obj;
						$proto155=array();
			$obj = new SQLField(array(
	"m_strName" => "id_masuk",
	"m_strTable" => "agenda"
));

$proto155["m_expr"]=$obj;
$proto155["m_alias"] = "";
$obj = new SQLFieldListItem($proto155);

$proto148["m_fieldlist"][]=$obj;
						$proto157=array();
			$obj = new SQLField(array(
	"m_strName" => "Apa",
	"m_strTable" => "agenda"
));

$proto157["m_expr"]=$obj;
$proto157["m_alias"] = "";
$obj = new SQLFieldListItem($proto157);

$proto148["m_fieldlist"][]=$obj;
						$proto159=array();
			$obj = new SQLField(array(
	"m_strName" => "Tgl_mulai",
	"m_strTable" => "agenda"
));

$proto159["m_expr"]=$obj;
$proto159["m_alias"] = "";
$obj = new SQLFieldListItem($proto159);

$proto148["m_fieldlist"][]=$obj;
						$proto161=array();
			$obj = new SQLField(array(
	"m_strName" => "Tgl_akhir",
	"m_strTable" => "agenda"
));

$proto161["m_expr"]=$obj;
$proto161["m_alias"] = "";
$obj = new SQLFieldListItem($proto161);

$proto148["m_fieldlist"][]=$obj;
						$proto163=array();
			$obj = new SQLField(array(
	"m_strName" => "Jam_mulai",
	"m_strTable" => "agenda"
));

$proto163["m_expr"]=$obj;
$proto163["m_alias"] = "";
$obj = new SQLFieldListItem($proto163);

$proto148["m_fieldlist"][]=$obj;
						$proto165=array();
			$obj = new SQLField(array(
	"m_strName" => "Jam_akhir",
	"m_strTable" => "agenda"
));

$proto165["m_expr"]=$obj;
$proto165["m_alias"] = "";
$obj = new SQLFieldListItem($proto165);

$proto148["m_fieldlist"][]=$obj;
						$proto167=array();
			$obj = new SQLField(array(
	"m_strName" => "Tempat",
	"m_strTable" => "agenda"
));

$proto167["m_expr"]=$obj;
$proto167["m_alias"] = "";
$obj = new SQLFieldListItem($proto167);

$proto148["m_fieldlist"][]=$obj;
$proto148["m_fromlist"] = array();
												$proto169=array();
$proto169["m_link"] = "SQLL_MAIN";
			$proto170=array();
$proto170["m_strName"] = "agenda";
$proto170["m_columns"] = array();
$proto170["m_columns"][] = "id_agenda";
$proto170["m_columns"][] = "id_masuk";
$proto170["m_columns"][] = "Apa";
$proto170["m_columns"][] = "Tgl_mulai";
$proto170["m_columns"][] = "Tgl_akhir";
$proto170["m_columns"][] = "Jam_mulai";
$proto170["m_columns"][] = "Jam_akhir";
$proto170["m_columns"][] = "Tempat";
$obj = new SQLTable($proto170);

$proto169["m_table"] = $obj;
$proto169["m_alias"] = "";
$proto171=array();
$proto171["m_sql"] = "";
$proto171["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto171["m_column"]=$obj;
$proto171["m_contained"] = array();
$proto171["m_strCase"] = "";
$proto171["m_havingmode"] = "0";
$proto171["m_inBrackets"] = "0";
$proto171["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto171);

$proto169["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto169);

$proto148["m_fromlist"][]=$obj;
$proto148["m_groupby"] = array();
$proto148["m_orderby"] = array();
												$proto173=array();
						$obj = new SQLField(array(
	"m_strName" => "id_agenda",
	"m_strTable" => "agenda"
));

$proto173["m_column"]=$obj;
$proto173["m_bAsc"] = 1;
$proto173["m_nColumn"] = 0;
$obj = new SQLOrderByItem($proto173);

$proto148["m_orderby"][]=$obj;					
$obj = new SQLQuery($proto148);

$queryData_agenda = $obj;
$tdataagenda[".sqlquery"] = $queryData_agenda;



?>
