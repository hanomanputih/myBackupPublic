<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");
header("Pragma: no-cache");
header("Cache-Control: no-cache");

include("include/agenda_variables.php");
include("classes/searchcontrol.php");
include("classes/advancedsearchcontrol.php");
include("classes/panelsearchcontrol.php");
include("classes/searchclause.php");

$sessionPrefix = $strTableName;


if(isset($_SESSION[$strTableName.'_advsearch']))
{
	$searchObject = unserialize($_SESSION[$strTableName.'_advsearch']);
}
else
{
	$allSearchFields = GetTableData($strTableName, '.allSearchFields', array());
	$searchObject = new SearchClause($strTableName, $allSearchFields, $sessionPrefix);
}

//Basic includes js files
$includes="";
// predefined fields num
$predefFieldNum = 0;

$chrt_array=array();
$rpt_array=array();
//	check if logged in
if( (!@$_SESSION["UserID"] || !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search") && !@$chrt_array['status'] && !@$rpt_array['status'])
|| (@$rpt_array['status'] == "private" && @$rpt_array['owner'] != @$_SESSION["UserID"])
|| (@$chrt_array['status'] == "private" && @$chrt_array['owner'] != @$_SESSION["UserID"]) )
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}

include('include/xtempl.php');
include('classes/runnerpage.php');
$xt = new Xtempl();

// id that used to add to controls names
if(postvalue("id"))
	$id = postvalue("id");
else
	$id = 1;
	
// for usual page show proccess
$mode=SEARCH_SIMPLE;
$templatefile = "agenda_search.htm";

// for ajax query, used when page buffers new control
if(postvalue("mode")=="inlineLoadCtrl"){
	$mode=SEARCH_LOAD_CONTROL;
	$templatefile = "agenda_inline_search.htm";
}	
	
$xt->assign("id", $id);
$formname = "frmSearch".$id;

$calendar = false;
$calendar = true;

$params = array();
$params["id"] = $id;
$params["mode"] = $mode;
$params["calendar"] = $calendar;
$params['xt'] = &$xt;
$params['shortTableName'] = 'agenda';
$params['origTName'] = $strOriginalTableName;
$params['dataSourceTable'] = "agenda";
$params['sessionPrefix'] = $sessionPrefix;
$params['tName'] = $strTableName;
$params['includes_js']=$includes_js;
$params['includes_jsreq']=$includes_jsreq;
$params['includes_css']=$includes_css;
$params['locale_info']=$locale_info;
$params['pageType']=PAGE_SEARCH;

//PAGE_SEARCH,$id,$calendar

$pageObject = new RunnerPage($params);

// create reusable searchControl builder instance
$searchControllerId = (postvalue('searchControllerId') ? postvalue('searchControllerId') : $pageObject->id);

$searchControlBuilder = new AdvancedSearchControl($searchControllerId, $strTableName, $searchObject, $pageObject);


//	Before Process event
if(function_exists("BeforeProcessSearch"))
	BeforeProcessSearch($conn);

////////////////////// time picker
$pageObject->AddJSFile("ui");
$pageObject->AddJSFile("jquery.utils","ui");
$pageObject->AddJSFile("ui.dropslide","jquery.utils");
$pageObject->AddJSFile("ui.timepickr","ui.dropslide");
$pageObject->AddCSSFile("ui.dropslide");
	
// add constants and files for simple view
if ($mode==SEARCH_SIMPLE)
{
	// add onload event
	$onLoadJsCode = GetTableData($pageObject->tName, ".jsOnloadSearch", '');
	$pageObject->addOnLoadJsEvent($onLoadJsCode);

	// add button events if exist
	$buttonHandlers = GetTableData($pageObject->tName, ".buttonHandlers_".$pageObject->getPageType(), array());
	$pageObject->addButtonHandlers($buttonHandlers);

	$includes .="<script language=\"JavaScript\" src=\"include/jquery.js\"></script>\r\n";
	$includes.="<script language=\"JavaScript\" src=\"include/customlabels.js\"></script>\r\n";
	$includes .="<script language=\"JavaScript\" src=\"include/jsfunctions.js\"></script>\r\n";	
	if ($pageObject->debugJSMode === true)
	{
		$includes.="<script language=\"JavaScript\" src=\"include/runnerJS/Runner.js\"></script>\r\n";
		$includes.="<script language=\"JavaScript\" src=\"include/runnerJS/RunnerEvent.js\"></script>\r\n";
		$includes.= "<script type=\"text/javascript\" src=\"include/runnerJS/Util.js\"></script>";	
	}
	else
	{
		$includes.="<script language=\"JavaScript\" src=\"include/runnerJS/RunnerBase.js\"></script>\r\n";
	}	
		
	$pageObject->AddJSFile("ajaxsuggest");
	if($calendar)
		$pageObject->AddJSFile("calendar");



//---------------------------------------------------------------------------
	$pageObject->AddJsCode("detect = navigator.userAgent.toLowerCase();
		window.checkIt = function(string){
			place = detect.indexOf(string) + 1;
			thestring = string;
			return place;
		};
	");



	// for mode simple submit form on enter
	$runSearch = $searchControlBuilder->createNoSuggestJs();
	$pageObject->AddJsCode($runSearch);	
			
	$fNamesJsArr = $searchControlBuilder->fNamesJSArr(GetTableData($strTableName,".globSearchFields",array()));	
	
	
	$pageObject->addJSCode("searchController".$searchControllerId." = new Runner.search.SearchForm({
		id: ".$id.",
		tName: '".jsreplace($strTableName)."',
		shortTName: '".GetTableData($strTableName, ".shortTableName", '')."',
		fNamesArr:[".$fNamesJsArr."],
		searchType: 'advanced'
	});");
		
//--------------------------------------------------------------------------------------	
	// search panel radio button assign
	$searchRadio = $searchControlBuilder->getSearchRadio();
	$xt->assign_section("all_checkbox_label", $searchRadio['all_checkbox_label'][0], $searchRadio['all_checkbox_label'][1]);
	$xt->assign_section("any_checkbox_label", $searchRadio['any_checkbox_label'][0], $searchRadio['any_checkbox_label'][1]);
	$xt->assignbyref("all_checkbox",$searchRadio['all_checkbox']);
	$xt->assignbyref("any_checkbox",$searchRadio['any_checkbox']);
	
	
	
	$regBlocksJS = '';
	
	// search fields data
	$srchFields = $searchObject->getSearchCtrlParams("id_masuk");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "id_masuk";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control		
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	

	if(isEnableSection508())
		$xt->assign_section("id_masuk_label","<label for=\"".GetInputElementId("id_masuk", $id)."\">","</label>");
	else 
		$xt->assign("id_masuk_label", true);
	
	$xt->assign("id_masuk_fieldblock", true);		
	$xt->assignbyref("id_masuk_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("id_masuk_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("id_masuk_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_id_masuk", $ctrlBlockArr['searchtype']);	
	
	$suggestJS = $searchControlBuilder->createSearchSuggestJS('id_masuk', $id);
	$pageObject->AddJsCode($suggestJS);
	
	$ctrlsMap = $ctrlBlockArr['searchcontrol1'] ? "[0,1]" : "[0]";
	$regBlocksJS .= "searchController".$searchControllerId.".addRegCtrlsBlock('id_masuk', ".$pageObject->id.", ".$ctrlsMap.");";
	// search fields data
	$srchFields = $searchObject->getSearchCtrlParams("Apa");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Apa";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control		
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	

	if(isEnableSection508())
		$xt->assign_section("Apa_label","<label for=\"".GetInputElementId("Apa", $id)."\">","</label>");
	else 
		$xt->assign("Apa_label", true);
	
	$xt->assign("Apa_fieldblock", true);		
	$xt->assignbyref("Apa_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("Apa_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("Apa_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_Apa", $ctrlBlockArr['searchtype']);	
	
	$suggestJS = $searchControlBuilder->createSearchSuggestJS('Apa', $id);
	$pageObject->AddJsCode($suggestJS);
	
	$ctrlsMap = $ctrlBlockArr['searchcontrol1'] ? "[0,1]" : "[0]";
	$regBlocksJS .= "searchController".$searchControllerId.".addRegCtrlsBlock('Apa', ".$pageObject->id.", ".$ctrlsMap.");";
	// search fields data
	$srchFields = $searchObject->getSearchCtrlParams("Tgl_mulai");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Tgl_mulai";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control		
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	

	if(isEnableSection508())
		$xt->assign_section("Tgl_mulai_label","<label for=\"".GetInputElementId("Tgl_mulai", $id)."\">","</label>");
	else 
		$xt->assign("Tgl_mulai_label", true);
	
	$xt->assign("Tgl_mulai_fieldblock", true);		
	$xt->assignbyref("Tgl_mulai_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("Tgl_mulai_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("Tgl_mulai_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_Tgl_mulai", $ctrlBlockArr['searchtype']);	
	
	$suggestJS = $searchControlBuilder->createSearchSuggestJS('Tgl_mulai', $id);
	$pageObject->AddJsCode($suggestJS);
	
	$ctrlsMap = $ctrlBlockArr['searchcontrol1'] ? "[0,1]" : "[0]";
	$regBlocksJS .= "searchController".$searchControllerId.".addRegCtrlsBlock('Tgl_mulai', ".$pageObject->id.", ".$ctrlsMap.");";
	// search fields data
	$srchFields = $searchObject->getSearchCtrlParams("Jam_mulai");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Jam_mulai";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control		
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	

	if(isEnableSection508())
		$xt->assign_section("Jam_mulai_label","<label for=\"".GetInputElementId("Jam_mulai", $id)."\">","</label>");
	else 
		$xt->assign("Jam_mulai_label", true);
	
	$xt->assign("Jam_mulai_fieldblock", true);		
	$xt->assignbyref("Jam_mulai_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("Jam_mulai_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("Jam_mulai_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_Jam_mulai", $ctrlBlockArr['searchtype']);	
	
	$suggestJS = $searchControlBuilder->createSearchSuggestJS('Jam_mulai', $id);
	$pageObject->AddJsCode($suggestJS);
	
	$ctrlsMap = $ctrlBlockArr['searchcontrol1'] ? "[0,1]" : "[0]";
	$regBlocksJS .= "searchController".$searchControllerId.".addRegCtrlsBlock('Jam_mulai', ".$pageObject->id.", ".$ctrlsMap.");";
	// search fields data
	$srchFields = $searchObject->getSearchCtrlParams("Tgl_akhir");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Tgl_akhir";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control		
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	

	if(isEnableSection508())
		$xt->assign_section("Tgl_akhir_label","<label for=\"".GetInputElementId("Tgl_akhir", $id)."\">","</label>");
	else 
		$xt->assign("Tgl_akhir_label", true);
	
	$xt->assign("Tgl_akhir_fieldblock", true);		
	$xt->assignbyref("Tgl_akhir_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("Tgl_akhir_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("Tgl_akhir_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_Tgl_akhir", $ctrlBlockArr['searchtype']);	
	
	$suggestJS = $searchControlBuilder->createSearchSuggestJS('Tgl_akhir', $id);
	$pageObject->AddJsCode($suggestJS);
	
	$ctrlsMap = $ctrlBlockArr['searchcontrol1'] ? "[0,1]" : "[0]";
	$regBlocksJS .= "searchController".$searchControllerId.".addRegCtrlsBlock('Tgl_akhir', ".$pageObject->id.", ".$ctrlsMap.");";
	// search fields data
	$srchFields = $searchObject->getSearchCtrlParams("Jam_akhir");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Jam_akhir";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control		
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	

	if(isEnableSection508())
		$xt->assign_section("Jam_akhir_label","<label for=\"".GetInputElementId("Jam_akhir", $id)."\">","</label>");
	else 
		$xt->assign("Jam_akhir_label", true);
	
	$xt->assign("Jam_akhir_fieldblock", true);		
	$xt->assignbyref("Jam_akhir_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("Jam_akhir_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("Jam_akhir_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_Jam_akhir", $ctrlBlockArr['searchtype']);	
	
	$suggestJS = $searchControlBuilder->createSearchSuggestJS('Jam_akhir', $id);
	$pageObject->AddJsCode($suggestJS);
	
	$ctrlsMap = $ctrlBlockArr['searchcontrol1'] ? "[0,1]" : "[0]";
	$regBlocksJS .= "searchController".$searchControllerId.".addRegCtrlsBlock('Jam_akhir', ".$pageObject->id.", ".$ctrlsMap.");";
	// search fields data
	$srchFields = $searchObject->getSearchCtrlParams("Tempat");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Tempat";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control		
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	

	if(isEnableSection508())
		$xt->assign_section("Tempat_label","<label for=\"".GetInputElementId("Tempat", $id)."\">","</label>");
	else 
		$xt->assign("Tempat_label", true);
	
	$xt->assign("Tempat_fieldblock", true);		
	$xt->assignbyref("Tempat_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("Tempat_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("Tempat_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_Tempat", $ctrlBlockArr['searchtype']);	
	
	$suggestJS = $searchControlBuilder->createSearchSuggestJS('Tempat', $id);
	$pageObject->AddJsCode($suggestJS);
	
	$ctrlsMap = $ctrlBlockArr['searchcontrol1'] ? "[0,1]" : "[0]";
	$regBlocksJS .= "searchController".$searchControllerId.".addRegCtrlsBlock('Tempat', ".$pageObject->id.", ".$ctrlsMap.");";
	$pageObject->AddJsCode($regBlocksJS);
	
	//--------------------------------------------------------
	
	$pageObject->body["begin"] .= $includes;

	$pageObject->addCommonJs();
		
	$xt->assignbyref("body",$pageObject->body);

	$contents_block=array();
	$contents_block["begin"]="<form method=\"POST\" ";
	if(isset( $_GET["rname"]))
	{
		$contents_block["begin"].="action=\"dreport.php?rname=".htmlspecialchars(rawurlencode(postvalue("rname")))."\" ";
	}	
	else if(isset( $_GET["cname"]))
	{
		$contents_block["begin"].="action=\"dchart.php?cname=".htmlspecialchars(rawurlencode(postvalue("cname")))."\" ";
	}	
	else
	{
	$contents_block["begin"].="action=\"agenda_list.php\" ";
	}
	//$contents_block["begin"].='name="'.$formname.'"><input type="hidden" id="a" name="a" value="advsearch">';
	$contents_block["begin"].='name="'.$formname.'" id="'.$formname.'"><input type="hidden" id="a" name="a" value="advsearch"></form>';
	//$contents_block["end"]="</form>";
	$xt->assignbyref("contents_block",$contents_block);
	
	$xt->assign("searchbutton_attrs", "onClick=\"javascript: searchController".$searchControllerId.".submitSearch();\"");
	
	//$xt->assign("searchbutton_attrs","name=\"SearchButton\" onclick=\"javascript:document.forms.".$formname.".submit();\"");
	$xt->assign("resetbutton_attrs","onclick=\"return searchController".$searchControllerId.".resetCtrls();\"");
	
	$xt->assign("backbutton_attrs","onclick=\"searchController".$searchControllerId.".returnSubmit();\"");
	
	$xt->assign("conditions_block",true);
	$xt->assign("search_button",true);
	$xt->assign("reset_button",true);
	$xt->assign("back_button",true);
	
	
	if(function_exists("BeforeShowSearch"))
		BeforeShowSearch($xt,$templatefile);
	// load controls for first page loading	
	$pageObject->body["end"] .= "</form><script>".$pageObject->PrepareJs()."</script>";	
	$xt->assignbyref("body",$pageObject->body);
	$xt->display($templatefile);
	exit();	
}
else if($mode==SEARCH_LOAD_CONTROL)
{	
	$searchControlBuilder = new PanelSearchControl($searchControllerId, $strTableName, $searchObject, $pageObject);
	
	$ctrlField = postvalue('ctrlField');					
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $ctrlField, 0, '', false, true, '', '');
	// add js code
	$searchSuggestJS = $searchControlBuilder->createSearchSuggestJS($ctrlField, $id);
	$pageObject->AddJsCode($searchSuggestJS);
	// build array for encode
	$resArr = array();
	$resArr['control1'] = trim($xt->call_func($ctrlBlockArr['searchcontrol']));
	$resArr['control2'] = trim($xt->call_func($ctrlBlockArr['searchcontrol1']));
	$resArr['comboHtml'] = trim($ctrlBlockArr['searchtype']);
	$resArr['delButt'] = trim($ctrlBlockArr['delCtrlButt']);
	$resArr['delButtId'] =  trim($searchControlBuilder->getDelButtonId($ctrlField, $id));
	$resArr['divInd'] = trim($id);
	$resArr['jsCode'] = trim($pageObject->PrepareJs());
	$resArr['fLabel'] = GetFieldLabel(GoodFieldName($strTableName),GoodFieldName($ctrlField));
	// return JSON
	echo my_json_encode($resArr);
	exit();
}
	

?>
