<?php

//	field labels
$fieldLabelsadmin_rights = array();
$fieldLabelsadmin_rights["Indonesian"]=array();
$fieldLabelsadmin_rights["Indonesian"]["TableName"] = "Table Name";
$fieldLabelsadmin_rights["Indonesian"]["GroupID"] = "Group ID";
$fieldLabelsadmin_rights["Indonesian"]["AccessMask"] = "Access Mask";


$tdataadmin_rights=array();
	$tdataadmin_rights[".ShortName"]="admin_rights";
	$tdataadmin_rights[".OwnerID"]="";
	$tdataadmin_rights[".OriginalTable"]="agenda_ugrights";
	$tdataadmin_rights[".NCSearch"]=false;
	

$tdataadmin_rights[".shortTableName"] = "admin_rights";
$tdataadmin_rights[".dataSourceTable"] = "admin_rights";
$tdataadmin_rights[".nSecOptions"] = 0;
$tdataadmin_rights[".nLoginMethod"] = 1;
$tdataadmin_rights[".recsPerRowList"] = 1;	
$tdataadmin_rights[".tableGroupBy"] = "0";
$tdataadmin_rights[".dbType"] = 0;
$tdataadmin_rights[".mainTableOwnerID"] = "";
$tdataadmin_rights[".moveNext"] = 1;

$tdataadmin_rights[".listAjax"] = true;

	$tdataadmin_rights[".audit"] = false;

	$tdataadmin_rights[".locking"] = false;
	
$tdataadmin_rights[".listIcons"] = true;




$tdataadmin_rights[".showSimpleSearchOptions"] = false;

$tdataadmin_rights[".showSearchPanel"] = false;


$tdataadmin_rights[".isUseAjaxSuggest"] = false;

$tdataadmin_rights[".rowHighlite"] = true;

$tdataadmin_rights[".delFile"] = true;

// button handlers file names

// start on load js handlers








// end on load js handlers




// use datepicker for search panel
$tdataadmin_rights[".isUseCalendarForSearch"] = false;

// use timepicker for search panel
$tdataadmin_rights[".isUseTimeForSearch"] = false;






$tdataadmin_rights[".isUseInlineJs"] = $tdataadmin_rights[".isUseInlineAdd"] || $tdataadmin_rights[".isUseInlineEdit"];

$tdataadmin_rights[".allSearchFields"] = array();



$tdataadmin_rights[".isDynamicPerm"] = true;

	


$tdataadmin_rights[".isResizeColumns"] = false;


$tdataadmin_rights[".createLoginPage"] = true;


 	




$tdataadmin_rights[".pageSize"] = 5;

$gstrOrderBy = "";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy = "order by ".$gstrOrderBy;
$tdataadmin_rights[".strOrderBy"] = $gstrOrderBy;
	
$tdataadmin_rights[".orderindexes"] = array();

$tdataadmin_rights[".sqlHead"] = "SELECT TableName,   GroupID,   AccessMask";

$tdataadmin_rights[".sqlFrom"] = "FROM agenda_ugrights";

$tdataadmin_rights[".sqlWhereExpr"] = "";

$tdataadmin_rights[".sqlTail"] = "";



	$tableKeys=array();
	$tdataadmin_rights[".Keys"]=$tableKeys;

	
//	TableName
	$fdata = array();
	$fdata["strName"] = "TableName";
	$fdata["ownerTable"] = "agenda_ugrights";
		$fdata["Label"]="Table Name"; 
			$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "TableName";
		$fdata["FullName"]= "TableName";
						$fdata["Index"]= 1;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=50";
		 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataadmin_rights["TableName"]=$fdata;
	
//	GroupID
	$fdata = array();
	$fdata["strName"] = "GroupID";
	$fdata["ownerTable"] = "agenda_ugrights";
		$fdata["Label"]="Group ID"; 
			$fdata["FieldType"]= 3;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "GroupID";
		$fdata["FullName"]= "GroupID";
						$fdata["Index"]= 2;
	
			$fdata["EditParams"]="";
			 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataadmin_rights["GroupID"]=$fdata;
	
//	AccessMask
	$fdata = array();
	$fdata["strName"] = "AccessMask";
	$fdata["ownerTable"] = "agenda_ugrights";
		$fdata["Label"]="Access Mask"; 
			$fdata["FieldType"]= 200;
				$fdata["UseiBox"] = false;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	

		
			$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "AccessMask";
		$fdata["FullName"]= "AccessMask";
						$fdata["Index"]= 3;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=10";
		 $fdata["bListPage"]=true; 
				$fdata["FieldPermissions"]=true;
							$fdata["ListPage"]=true;
			$tdataadmin_rights["AccessMask"]=$fdata;

	
$tables_data["admin_rights"]=&$tdataadmin_rights;
$field_labels["admin_rights"] = &$fieldLabelsadmin_rights;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["admin_rights"] = array();

	
// tables which are master tables for current table (detail)
$masterTablesData["admin_rights"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










$proto29=array();
$proto29["m_strHead"] = "SELECT";
$proto29["m_strFieldList"] = "TableName,   GroupID,   AccessMask";
$proto29["m_strFrom"] = "FROM agenda_ugrights";
$proto29["m_strWhere"] = "";
$proto29["m_strOrderBy"] = "";
$proto29["m_strTail"] = "";
$proto30=array();
$proto30["m_sql"] = "";
$proto30["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto30["m_column"]=$obj;
$proto30["m_contained"] = array();
$proto30["m_strCase"] = "";
$proto30["m_havingmode"] = "0";
$proto30["m_inBrackets"] = "0";
$proto30["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto30);

$proto29["m_where"] = $obj;
$proto32=array();
$proto32["m_sql"] = "";
$proto32["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto32["m_column"]=$obj;
$proto32["m_contained"] = array();
$proto32["m_strCase"] = "";
$proto32["m_havingmode"] = "0";
$proto32["m_inBrackets"] = "0";
$proto32["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto32);

$proto29["m_having"] = $obj;
$proto29["m_fieldlist"] = array();
						$proto34=array();
			$obj = new SQLField(array(
	"m_strName" => "TableName",
	"m_strTable" => "agenda_ugrights"
));

$proto34["m_expr"]=$obj;
$proto34["m_alias"] = "";
$obj = new SQLFieldListItem($proto34);

$proto29["m_fieldlist"][]=$obj;
						$proto36=array();
			$obj = new SQLField(array(
	"m_strName" => "GroupID",
	"m_strTable" => "agenda_ugrights"
));

$proto36["m_expr"]=$obj;
$proto36["m_alias"] = "";
$obj = new SQLFieldListItem($proto36);

$proto29["m_fieldlist"][]=$obj;
						$proto38=array();
			$obj = new SQLField(array(
	"m_strName" => "AccessMask",
	"m_strTable" => "agenda_ugrights"
));

$proto38["m_expr"]=$obj;
$proto38["m_alias"] = "";
$obj = new SQLFieldListItem($proto38);

$proto29["m_fieldlist"][]=$obj;
$proto29["m_fromlist"] = array();
												$proto40=array();
$proto40["m_link"] = "SQLL_MAIN";
			$proto41=array();
$proto41["m_strName"] = "agenda_ugrights";
$proto41["m_columns"] = array();
$proto41["m_columns"][] = "TableName";
$proto41["m_columns"][] = "GroupID";
$proto41["m_columns"][] = "AccessMask";
$obj = new SQLTable($proto41);

$proto40["m_table"] = $obj;
$proto40["m_alias"] = "";
$proto42=array();
$proto42["m_sql"] = "";
$proto42["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto42["m_column"]=$obj;
$proto42["m_contained"] = array();
$proto42["m_strCase"] = "";
$proto42["m_havingmode"] = "0";
$proto42["m_inBrackets"] = "0";
$proto42["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto42);

$proto40["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto40);

$proto29["m_fromlist"][]=$obj;
$proto29["m_groupby"] = array();
$proto29["m_orderby"] = array();
$obj = new SQLQuery($proto29);

$queryData_admin_rights = $obj;
$tdataadmin_rights[".sqlquery"] = $queryData_admin_rights;



?>
