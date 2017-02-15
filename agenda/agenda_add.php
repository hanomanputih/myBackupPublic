<?php 
include("include/dbcommon.php");

@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");
header("Pragma: no-cache");
header("Cache-Control: no-cache");

include("include/agenda_variables.php");
include('include/xtempl.php');
include('classes/runnerpage.php');

//	check if logged in
if(@$_SESSION["UserID"] && IsAdmin() && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Add"))
{
	echo "<p>"."Anda tidak punya ijin untuk mengakses tabel ini"."<br>Proceed to <a href=\"admin.php\">Admin Area</a> to set up user permissions</p>";
	return;
}
if(!@$_SESSION["UserID"] || !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Add"))
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}


$filename="";
$status="";
$message="";
$mesClass = "";
$usermessage="";
$error_happened=false;
$readavalues=false;

$keys=array();
$showKeys = array();
$showValues = array();
$showRawValues = array();
$showFields = array();
$showDetailKeys = array();
$IsSaved = false;
$HaveData = true;

$sessionPrefix = $strTableName;

if(@$_REQUEST["editType"]=="inline")
	$inlineadd=ADD_INLINE;
elseif(@$_REQUEST["editType"]=="onthefly")
{
	$inlineadd=ADD_ONTHEFLY;
	$sessionPrefix = $strTableName."_add";	
}
elseif(@$_REQUEST["editType"]=="addmaster")
	$inlineadd=ADD_MASTER;
else
	$inlineadd=ADD_SIMPLE;

if($inlineadd==ADD_INLINE)
	$templatefile = "agenda_inline_add.htm";
else
	$templatefile = "agenda_add.htm";

if($inlineadd==ADD_ONTHEFLY)
	$id=postvalue("id");	
elseif($inlineadd==ADD_INLINE)
	$id=postvalue("recordID");
else
{
	$id=postvalue("id");
	if(intval($id)==0)
		$id = 1;
}
//If undefined session value for mastet table, but exist post value master table, than take second
//It may be happen only when use dpInline mode on page add
if(!@$_SESSION[$sessionPrefix."_mastertable"] && postvalue("mastertable"))
	$_SESSION[$sessionPrefix."_mastertable"] = postvalue("mastertable");
//Get detail table keys	
$detailKeys = array();
$detailKeys = GetDetailKeysByMasterTable($_SESSION[$sessionPrefix."_mastertable"], $strTableName);	

$xt = new Xtempl();
	
// assign an id		
$xt->assign("id",$id);
$formname="editform".$id;
	

$auditObj = GetAuditObject($strTableName);

//array of params for classes
$params = array("pageType" => PAGE_ADD,"id" => $id,"mode" => $inlineadd);

$params["calendar"] = true;
$params['tName'] = $strTableName;
$params['xt'] = &$xt;
$params['includes_js']=$includes_js;
$params['includes_jsreq']=$includes_jsreq;
$params['includes_css']=$includes_css;
$params['locale_info']=$locale_info;

$pageObject = new RunnerPage($params);

$isCaptchaOk=1;
// proccess captcha
if ($inlineadd==ADD_SIMPLE || $inlineadd==ADD_MASTER)
{
	
}
// end proccess captcha

// add onload event
$onLoadJsCode = GetTableData($pageObject->tName, ".jsOnloadAdd", '');
$pageObject->addOnLoadJsEvent($onLoadJsCode);


if ($inlineadd==ADD_SIMPLE)
{
	// add button events if exist
	$buttonHandlers = GetTableData($pageObject->tName, ".buttonHandlers_".$pageObject->getPageType(), array());
	$pageObject->addButtonHandlers($buttonHandlers);
}
$url_page=substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1,12);

$isShowDetailTables = displayDetailsOn($strTableName,PAGE_ADD);
$dpParams = array();
if($isShowDetailTables && ($inlineadd==ADD_SIMPLE || $inlineadd==ADD_MASTER))
{
	$ids = $id;
	$mKeys["agenda_hadir"] = GetMasterKeysByDetailTable("agenda_hadir", $strTableName);
	$dpParams['strTableNames'][] = "agenda_hadir";
	$dpParams['ids'][] = ++$ids;
	if($inlineadd==ADD_SIMPLE)
	{
		$pageObject->AddJSCode("window.dpObj = new dpInlineOnAddEdit({
			'mTableName':'".jsreplace($strTableName)."',
			'mShortTableName':'agenda', 
			'mForm':$('#".$formname."'),
			'mPageType':'".PAGE_ADD."',
			'mMessage':'', 
			'mId':".$id.",
			'ext':'php',
			'dMessages':'', 
			'dCaptions':[],
			'dInlineObjs':[]});
			window.dpInline".$id." = new detailsPreviewInline({'pageId':".$id.",'mode':'add_master'}); 
			window.dpInline".$id.".createPreviewIframe();");
		$pageObject->AddJSFile("detailspreview");
	}
}

//	Before Process event
if(function_exists("BeforeProcessAdd"))
	BeforeProcessAdd($conn);

// insert new record if we have to
if(@$_POST["a"]=="added")
{
	$afilename_values=array();
	$avalues=array();
	$blobfields=array();
	$files_move=array();
	$files_save=array();
//	processing id_masuk - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_id_masuk_".$id);
	$type=postvalue("type_id_masuk_".$id);
	if (FieldSubmitted("id_masuk_".$id))
	{
		$value=prepare_for_db("id_masuk",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "id_masuk"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["id_masuk"]=$value;
	}
	}
//	processibng id_masuk - end
//	processing Apa - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_Apa_".$id);
	$type=postvalue("type_Apa_".$id);
	if (FieldSubmitted("Apa_".$id))
	{
		$value=prepare_for_db("Apa",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "Apa"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["Apa"]=$value;
	}
	}
//	processibng Apa - end
//	processing Tgl_mulai - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_Tgl_mulai_".$id);
	$type=postvalue("type_Tgl_mulai_".$id);
	if (FieldSubmitted("Tgl_mulai_".$id))
	{
		$value=prepare_for_db("Tgl_mulai",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "Tgl_mulai"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["Tgl_mulai"]=$value;
	}
	}
//	processibng Tgl_mulai - end
//	processing Jam_mulai - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_Jam_mulai_".$id);
	$type=postvalue("type_Jam_mulai_".$id);
	if (FieldSubmitted("Jam_mulai_".$id))
	{
		$value=prepare_for_db("Jam_mulai",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "Jam_mulai"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["Jam_mulai"]=$value;
	}
	}
//	processibng Jam_mulai - end
//	processing Tgl_akhir - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_Tgl_akhir_".$id);
	$type=postvalue("type_Tgl_akhir_".$id);
	if (FieldSubmitted("Tgl_akhir_".$id))
	{
		$value=prepare_for_db("Tgl_akhir",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "Tgl_akhir"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["Tgl_akhir"]=$value;
	}
	}
//	processibng Tgl_akhir - end
//	processing Jam_akhir - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_Jam_akhir_".$id);
	$type=postvalue("type_Jam_akhir_".$id);
	if (FieldSubmitted("Jam_akhir_".$id))
	{
		$value=prepare_for_db("Jam_akhir",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "Jam_akhir"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["Jam_akhir"]=$value;
	}
	}
//	processibng Jam_akhir - end
//	processing Tempat - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_Tempat_".$id);
	$type=postvalue("type_Tempat_".$id);
	if (FieldSubmitted("Tempat_".$id))
	{
		$value=prepare_for_db("Tempat",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "Tempat"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["Tempat"]=$value;
	}
	}
//	processibng Tempat - end


//	insert masterkey value if exists and if not specified
	if(@$_SESSION[$sessionPrefix."_mastertable"]=="masuk")
	{
		if(!@$_SESSION[$sessionPrefix."_masterkey1"] && postvalue("masterkey1"))
			$_SESSION[$sessionPrefix."_masterkey1"] = postvalue("masterkey1");
		if($avalues["id_masuk"]=="")
			$avalues["id_masuk"]=prepare_for_db("id_masuk",$_SESSION[$sessionPrefix."_masterkey1"]);
	}

	$failed_inline_add=false;
//	add filenames to values
	foreach($afilename_values as $akey=>$value)
		$avalues[$akey]=$value;
	
//	before Add event
	$retval = true;
	if(function_exists("BeforeAdd"))
		$retval=BeforeAdd($avalues,$usermessage,$inlineadd);
	if($retval && $isCaptchaOk == 1)
	{
		if(DoInsertRecord($strOriginalTableName,$avalues,$blobfields,$id))
		{
			$IsSaved=true;
			
//	after edit event
			if($auditObj || function_exists("AfterAdd"))
			{
				foreach($keys as $idx=>$val)
					$avalues[$idx]=$val;
			}
			
			if($auditObj)
				$auditObj->LogAdd($strTableName,$avalues,$keys);

			if(function_exists("AfterAdd"))
				AfterAdd($avalues,$keys,$inlineadd);
				
			if($inlineadd==ADD_SIMPLE || $inlineadd==ADD_MASTER)
			{
				$_SESSION[$strTableName."_count_captcha"] = $_SESSION[$strTableName."_count_captcha"]+1;
				$permis = array();
				$keylink = "";$k = 0;
				foreach($keys as $idx=>$val)
				{
					if($k!=0)
						$keylink .="&";
					$keylink .="editid".(++$k)."=".htmlspecialchars(rawurlencode(@$val));
				}
				$permis = $pageObject->getPermissions();
				$message .="</br>";
				if(GetTableData($strTableName,".edit",false) && $permis['edit'])
					$message .='&nbsp;<a href=\'agenda_edit.php?'.$keylink.'\'>Edit</a>&nbsp;';
				if(GetTableData($strTableName,".view",false) && $permis['search'])
					$message .='&nbsp;<a href=\'agenda_view.php?'.$keylink.'\'>View</a>&nbsp;';
				$mesClass = "mes_ok";	
			}
		}
		else
			$mesClass = "mes_not";	
	}
	else
	{
		$message = $usermessage;
		$status="DECLINED";
		$readavalues=true;
	}
}

$message = "<div class='message ".$mesClass."'>".$message."</div>";

// PRG rule, to avoid POSTDATA resend
if (no_output_done() && $inlineadd==ADD_SIMPLE && $IsSaved)
{
	// saving message
	$_SESSION["message"] = ($message ? $message : "");
	// redirect
	header("Location: agenda_".$pageObject->getPageType().".php");
	// turned on output buffering, so we need to stop script
	exit();
}

if($inlineadd==ADD_MASTER && $IsSaved)
	$_SESSION["message"] = ($message ? $message : "");
	
// for PRG rule, to avoid POSTDATA resend. Saving mess in session
if($inlineadd==ADD_SIMPLE && isset($_SESSION["message"]))
{
	$message = $_SESSION["message"];
	unset($_SESSION["message"]);
}

$defvalues=array();

//	copy record
if(array_key_exists("copyid1",$_REQUEST) || array_key_exists("editid1",$_REQUEST))
{
	$copykeys=array();
	if(array_key_exists("copyid1",$_REQUEST))
	{
		$copykeys["id_agenda"]=postvalue("copyid1");
	}
	else
	{
		$copykeys["id_agenda"]=postvalue("editid1");
	}
	$strWhere=KeyWhere($copykeys);
	$strSQL = gSQLWhere($strWhere);

	LogInfo($strSQL);
	$rs=db_query($strSQL,$conn);
	$defvalues=db_fetch_array($rs);
	if(!$defvalues)
		$defvalues=array();
//	clear key fields
	$defvalues["id_agenda"]="";
//call CopyOnLoad event
	if(function_exists("CopyOnLoad"))
		CopyOnLoad($defvalues,$strWhere);
}
else
{
	$defvalues["Tgl_mulai"]=now();
	$defvalues["Tgl_akhir"]=now();
}
//	set default values for the foreign keys
if(@$_SESSION[$sessionPrefix."_mastertable"]=="masuk")
{
	if(!@$_SESSION[$sessionPrefix."_masterkey1"] && postvalue("masterkey1"))
			$_SESSION[$sessionPrefix."_masterkey1"] = postvalue("masterkey1");
	$defvalues["id_masuk"]=@$_SESSION[$sessionPrefix."_masterkey1"];	
}

if($readavalues)
{
	$defvalues["id_masuk"]=@$avalues["id_masuk"];
	$defvalues["Apa"]=@$avalues["Apa"];
	$defvalues["Tgl_mulai"]=@$avalues["Tgl_mulai"];
	$defvalues["Tgl_akhir"]=@$avalues["Tgl_akhir"];
	$defvalues["Jam_mulai"]=@$avalues["Jam_mulai"];
	$defvalues["Jam_akhir"]=@$avalues["Jam_akhir"];
	$defvalues["Tempat"]=@$avalues["Tempat"];
}
//for basic files
$includes="";
if ($inlineadd!==ADD_INLINE && $inlineadd!=ADD_ONTHEFLY)
	$pageObject->addJSCode("AddEventForControl('".jsreplace($strTableName)."', '', ".$id.");\r\n");

		
	
$onsubmit = $pageObject->onSubmitForEditingPage($formname);
	

//////////////////////////////////////////////////////////////////	
////////////////////// time picker
$pageObject->AddJSFile("ui");
$pageObject->AddJSFile("jquery.utils","ui");
$pageObject->AddJSFile("ui.dropslide","jquery.utils");
$pageObject->AddJSFile("ui.timepickr","ui.dropslide");
$pageObject->AddCSSFile("ui.dropslide");
//////////////////////

$pageObject->AddJSFile('customlabels');
if(isset($params["calendar"]))
	$pageObject->AddJSFile("calendar");
if($inlineadd!=ADD_INLINE)
{
	if($inlineadd!=ADD_ONTHEFLY)
	{
		$includes .="<script language=\"JavaScript\" src=\"include/jquery.js\"></script>\r\n";
		$includes .="<script language=\"JavaScript\" src=\"include/jsfunctions.js\"></script>\r\n";	
		if ($pageObject->debugJSMode===true)
		{
			$includes .= "<script type=\"text/javascript\" src=\"include/runnerJS/Runner.js\"></script>";
			$includes .= "<script type=\"text/javascript\" src=\"include/runnerJS/Util.js\"></script>";
		}
		else 
		{
			$includes .= "<script type=\"text/javascript\" src=\"include/runnerJS/RunnerBase.js\"></script>";
		}
		$pageObject->AddJSFile("ajaxsuggest");		
		$includes.="<script language=\"JavaScript\" src=\"include/jsfunctions.js\"></script>\r\n";
		$includes.="<div id=\"search_suggest\"></div>\r\n";
	}
	$xt->assign("id_masuk_fieldblock",true);
	$xt->assign("id_masuk_label",true);
	if(isEnableSection508())
		$xt->assign_section("id_masuk_label","<label for=\"".GetInputElementId("id_masuk", $id)."\">","</label>");
	$xt->assign("Apa_fieldblock",true);
	$xt->assign("Apa_label",true);
	if(isEnableSection508())
		$xt->assign_section("Apa_label","<label for=\"".GetInputElementId("Apa", $id)."\">","</label>");
	$xt->assign("Tgl_mulai_fieldblock",true);
	$xt->assign("Tgl_mulai_label",true);
	if(isEnableSection508())
		$xt->assign_section("Tgl_mulai_label","<label for=\"".GetInputElementId("Tgl_mulai", $id)."\">","</label>");
	$xt->assign("Tgl_akhir_fieldblock",true);
	$xt->assign("Tgl_akhir_label",true);
	if(isEnableSection508())
		$xt->assign_section("Tgl_akhir_label","<label for=\"".GetInputElementId("Tgl_akhir", $id)."\">","</label>");
	$xt->assign("Jam_mulai_fieldblock",true);
	$xt->assign("Jam_mulai_label",true);
	if(isEnableSection508())
		$xt->assign_section("Jam_mulai_label","<label for=\"".GetInputElementId("Jam_mulai", $id)."\">","</label>");
	$xt->assign("Jam_akhir_fieldblock",true);
	$xt->assign("Jam_akhir_label",true);
	if(isEnableSection508())
		$xt->assign_section("Jam_akhir_label","<label for=\"".GetInputElementId("Jam_akhir", $id)."\">","</label>");
	$xt->assign("Tempat_fieldblock",true);
	$xt->assign("Tempat_label",true);
	if(isEnableSection508())
		$xt->assign_section("Tempat_label","<label for=\"".GetInputElementId("Tempat", $id)."\">","</label>");
	
	
	if($inlineadd!=ADD_ONTHEFLY)
	{
		if($onsubmit)
			$onsubmit="onsubmit=\"".htmlspecialchars($onsubmit)."\"";
		
		$pageObject->body["begin"] .= $includes;
		$xt->assign("backbutton_attrs","onclick=\"window.location.href='agenda_list.php?a=return'\"");
		$xt->assign("back_button",true);
		
		$xt->assign('addForm', array('begin'=>'<form name="'.$formname.'" id="'.$formname.'" encType="multipart/form-data" method="post" action="agenda_add.php" '.$onsubmit.'>'.		
			'<input type=hidden name="a" value="added">'.
			($isShowDetailTables ? '<input type=hidden name="editType" value="addmaster">' : ''), 'end'=>'</form>'));
	}
	else
	{
		$destroyCtrls = "Runner.controls.ControlManager.unregister('".htmlspecialchars(jsreplace($strTableName))."');";
		$onsubmit="onsubmit=\"".htmlspecialchars($onsubmit.$destroyCtrls)."\"";
		
		$pageObject->body["begin"] .='<form name="'.$formname.'" id="'.$formname.'" encType="multipart/form-data" method="post" action="agenda_add.php" '.$onsubmit.' target="flyframe'.$id.'">'.
		'<input type=hidden name="a" value="added">'.
		'<input type=hidden name="editType" value="onthefly">'.
		'<input type=hidden name="table" value="'.postvalue('table').'">'.
		'<input type=hidden name="field" value="'.postvalue('field').'">'.
		'<input type=hidden name="category" value="'.postvalue('category').'">'.
		'<input type=hidden name="id" value="'.$id.'">';

		$xt->assign("cancelbutton_attrs", "onclick=\"RemoveFlyDiv('".$id."');".$destroyCtrls."\"");
		$xt->assign("cancel_button",true);
		$xt->assign("header","");
		// destroy controls befor destroy win		
		//$xt->assign("savebutton_attrs","onclick=\"$destroyCtrls\"");		
	}
	$xt->assign("save_button",true);
}

if($message)
{
	$xt->assign("message_block",true);
	$xt->assign("message",$message);
}
//$xt->assign("status",$status);

$readonlyfields=array();

//	show readonly fields
$linkdata="";

if(!$inlineadd==ADD_INLINE) 
	$pageObject->AddJSCode("SetToFirstControl('".$formname."');");
	
if(@$_POST["a"]=="added" && $inlineadd==ADD_ONTHEFLY && !$error_happened && $status!="DECLINED")
{
	$LookupSQL="";
	if($LookupSQL)
		$LookupSQL.=" from ".AddTableWrappers($strOriginalTableName);

	$data=0;
	if(count($keys) && $LookupSQL)
	{
		$where=KeyWhere($keys);
		$LookupSQL.=" where ".$where;
		$rs=db_query($LookupSQL,$conn);
		$data=db_fetch_numarray($rs);
	}
	if(!$data)
	{
		$data=array(@$avalues[$linkfield],@$avalues[$dispfield]);
	}
	echo "<textarea id=\"data\">";
	echo "added";
	print_inline_array($data);
	echo "</textarea>";
	exit();
}

if(@$_POST["a"]=="added" && ($inlineadd==ADD_INLINE || $inlineadd==ADD_MASTER)) 
{
	//Preparation   view values
	//	get current values and show edit controls
	$dispFieldAlias = "";
	$data=0;
	if(count($keys))
	{
		$where=KeyWhere($keys);
			
		$sqlHead = $gQuery->HeadToSql();
		$sqlGroupBy = $gQuery->GroupByToSql();
		$oHaving = $gQuery->Having();
		$sqlHaving = $oHaving->toSql($gQuery);
		
		$dispFieldAlias = postvalue('dispFieldAlias');
		$dispField = postvalue('dispField');
		
		if ($dispFieldAlias)
		{
			$sqlHead.=", ".($dispField)." as ".AddFieldWrappers($dispFieldAlias)." ";
		}
		$strSQL = gSQLWhere_having($sqlHead, $gsqlFrom, $gsqlWhereExpr, $sqlGroupBy, $sqlHaving, $where, '');		
		
		LogInfo($strSQL);
		$rs=db_query($strSQL,$conn);
		$data=db_fetch_array($rs);
	}
	if(!$data)
	{
		$data=$avalues;
		$HaveData=false;
	}
	//check if correct values added
	$masterquery="mastertable=agenda";
	$masterquery.="&masterkey1=".rawurlencode($data["id_agenda"]);
	$showDetailKeys["agenda_hadir"]=$masterquery;

	$showKeys[] = htmlspecialchars($keys["id_agenda"]);

	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["id_agenda"]));

////////////////////////////////////////////
//	id_masuk - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value=DisplayLookupWizard("id_masuk",$data["id_masuk"],$data,$keylink,MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "id_masuk";
				$showRawValues[] = substr($data["id_masuk"],0,100);
	}	
//	Apa - HTML
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value = GetData($data,"Apa", "HTML");
		$showValues[] = $value;
		$showFields[] = "Apa";
				$showRawValues[] = substr($data["Apa"],0,100);
	}	
//	Tgl_mulai - Long Date
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value = ProcessLargeText(GetData($data,"Tgl_mulai", "Long Date"),"field=Tgl%5Fmulai".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Tgl_mulai";
				$showRawValues[] = substr($data["Tgl_mulai"],0,100);
	}	
//	Tgl_akhir - Long Date
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value = ProcessLargeText(GetData($data,"Tgl_akhir", "Long Date"),"field=Tgl%5Fakhir".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Tgl_akhir";
				$showRawValues[] = substr($data["Tgl_akhir"],0,100);
	}	
//	Jam_mulai - Time
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value = ProcessLargeText(GetData($data,"Jam_mulai", "Time"),"field=Jam%5Fmulai".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Jam_mulai";
				$showRawValues[] = substr($data["Jam_mulai"],0,100);
	}	
//	Jam_akhir - Time
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value = ProcessLargeText(GetData($data,"Jam_akhir", "Time"),"field=Jam%5Fakhir".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Jam_akhir";
				$showRawValues[] = substr($data["Jam_akhir"],0,100);
	}	
//	Tempat - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value = ProcessLargeText(GetData($data,"Tempat", ""),"field=Tempat".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Tempat";
				$showRawValues[] = substr($data["Tempat"],0,100);
	}	
	
	// for custom expression for display field
	if ($dispFieldAlias)
	{
		$showValues[] = $data[$dispFieldAlias];	
		$showFields[] = $dispFieldAlias;
		$showRawValues[] = substr($data[$dispFieldAlias],0,100);
	}		
	
	if($inlineadd==ADD_INLINE)
	{	
		echo "<textarea id=\"data\">";
		if($IsSaved && count($showValues))
		{
			if($HaveData)
				echo "saved";
			else
				echo "savnd";
			print_inline_array($showKeys);
			echo "\n";
			print_inline_array($showValues);
			echo "\n";
			print_inline_array($showFields);
			echo "\n";
			print_inline_array($showRawValues);
			echo "\n";
			print_inline_array($showDetailKeys,true);
			echo "\n";
			print_inline_array($showDetailKeys);
			echo "\n";
			echo str_replace(array("&","<","\\","\r","\n"),array("&amp;","&lt;","\\\\","\\r","\\n"),$usermessage);
		}
		else
		{
			if($status=="DECLINED")
				echo "decli";
			else
				echo "error";
			echo str_replace(array("&","<","\\","\r","\n"),array("&amp;","&lt;","\\\\","\\r","\\n"),$message);
		}
		echo "</textarea>";
		exit();
	}	
} 

/////////////////////////////////////////////////////////////
if($inlineadd==ADD_MASTER)
{
	echo "<textarea id=\"data\">";
	$code = "";
	if(($_POST["a"]=="added" && $IsSaved))
	{
		$code .= "window.dpObj.Opts.mSavedValues = {";
		for($i=0;$i<count($showFields);$i++)
			$code .= "'".jsreplace($showFields[$i])."':'".jsreplace($showValues[$i])."'".($i!=(count($showFields)-1) ? "," : "")." ";
		$code .= "};";
		for($i=0;$i<count($dpParams['ids']);$i++)
		{
			$data=0;
			if(count($keys))
			{
				$where=KeyWhere($keys);
							$strSQL = gSQLWhere($where);
				LogInfo($strSQL);
				$rs=db_query($strSQL,$conn);
				$data=db_fetch_array($rs);
			}
			if(!$data)
				$data=$avalues;
				
			$code .= "var obj = window.inlineEditing".$dpParams['ids'][$i].";
					  if(obj && obj.isSbmSuc){obj.mKeys = [";
			foreach($mKeys[$dpParams['strTableNames'][$i]] as $mk)
				$code .= "'".jsreplace($data[$mk])."',";
			$code = substr($code, 0, -1);
			$code .= "];}";
		}
		if((isset($_SESSION[$strTableName."_count_captcha"])) or ($_SESSION[$strTableName."_count_captcha"]>0) or ($_SESSION[$strTableName."_count_captcha"]<5))
			$code .= "window.dpObj.hideCaptcha();";	
		$code .= "window.dpObj.saveAllDetail();";
	}
	elseif(@$_REQUEST["isSbmSuc"]==='0')
		$code .= "window.dpObj.saveAllDetail();";
	elseif(!$isCaptchaOk)
		$code .= "window.dpObj.showHideInvalidCaptcha('show');";
	else
		$code .= "window.dpObj.Opts.mMessage =\"".$message."\";
				  window.dpObj.showMessage();
				  window.dpObj.showHideInvalidCaptcha('hide');";	
	echo $code."</textarea>";
	exit();
}


/////////////////////////////////////////////////////////////
//	prepare Edit Controls
/////////////////////////////////////////////////////////////
//	validation stuff
$regex='';
$regexmessage='';
$regextype = '';
//	control - id_masuk
$control_id_masuk=array();
$control_id_masuk["func"]="xt_buildeditcontrol";
$control_id_masuk["params"] = array();
$control_id_masuk["params"]["field"]="id_masuk";
$control_id_masuk["params"]["value"]=@$defvalues["id_masuk"];

//	Begin Add validation
$arrValidate = array();	
$control_id_masuk["params"]["validate"]=$arrValidate;
//	End Add validation

$control_id_masuk["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_id_masuk["params"]["mode"]="inline_add";
else
	$control_id_masuk["params"]["mode"]="add";
if(!$detailKeys || !in_array("id_masuk", $detailKeys))
	$xt->assignbyref("id_masuk_editcontrol",$control_id_masuk);
else if(array_key_exists("id_masuk", $defvalues))
{
				$value=DisplayLookupWizard("id_masuk",$defvalues["id_masuk"],$defvalues,"",MODE_VIEW);
		$xt->assignbyref("id_masuk_editcontrol",$value);
}
// add prevent submit on enter js if only one text record
//	control - Apa
$control_Apa=array();
$control_Apa["func"]="xt_buildeditcontrol";
$control_Apa["params"] = array();
$control_Apa["params"]["field"]="Apa";
$control_Apa["params"]["value"]=@$defvalues["Apa"];

//	Begin Add validation
$arrValidate = array();	
$arrValidate['basicValidate'][] = "IsRequired";
$control_Apa["params"]["validate"]=$arrValidate;
//	End Add validation

$control_Apa["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_Apa["params"]["mode"]="inline_add";
else
	$control_Apa["params"]["mode"]="add";
if(!$detailKeys || !in_array("Apa", $detailKeys))
	$xt->assignbyref("Apa_editcontrol",$control_Apa);
else if(array_key_exists("Apa", $defvalues))
{
				$value = GetData($defvalues,"Apa", "HTML");
		$xt->assignbyref("Apa_editcontrol",$value);
}
// add prevent submit on enter js if only one text record
//	control - Tgl_mulai
$control_Tgl_mulai=array();
$control_Tgl_mulai["func"]="xt_buildeditcontrol";
$control_Tgl_mulai["params"] = array();
$control_Tgl_mulai["params"]["field"]="Tgl_mulai";
$control_Tgl_mulai["params"]["value"]=@$defvalues["Tgl_mulai"];

//	Begin Add validation
$arrValidate = array();	
$arrValidate['basicValidate'][] = "IsRequired";
$control_Tgl_mulai["params"]["validate"]=$arrValidate;
//	End Add validation

$control_Tgl_mulai["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_Tgl_mulai["params"]["mode"]="inline_add";
else
	$control_Tgl_mulai["params"]["mode"]="add";
if(!$detailKeys || !in_array("Tgl_mulai", $detailKeys))
	$xt->assignbyref("Tgl_mulai_editcontrol",$control_Tgl_mulai);
else if(array_key_exists("Tgl_mulai", $defvalues))
{
				$value = ProcessLargeText(GetData($defvalues,"Tgl_mulai", "Long Date"),"field=Tgl%5Fmulai","",MODE_VIEW);
		$xt->assignbyref("Tgl_mulai_editcontrol",$value);
}
// add prevent submit on enter js if only one text record
//	control - Tgl_akhir
$control_Tgl_akhir=array();
$control_Tgl_akhir["func"]="xt_buildeditcontrol";
$control_Tgl_akhir["params"] = array();
$control_Tgl_akhir["params"]["field"]="Tgl_akhir";
$control_Tgl_akhir["params"]["value"]=@$defvalues["Tgl_akhir"];

//	Begin Add validation
$arrValidate = array();	
$arrValidate['basicValidate'][] = "IsRequired";
$control_Tgl_akhir["params"]["validate"]=$arrValidate;
//	End Add validation

$control_Tgl_akhir["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_Tgl_akhir["params"]["mode"]="inline_add";
else
	$control_Tgl_akhir["params"]["mode"]="add";
if(!$detailKeys || !in_array("Tgl_akhir", $detailKeys))
	$xt->assignbyref("Tgl_akhir_editcontrol",$control_Tgl_akhir);
else if(array_key_exists("Tgl_akhir", $defvalues))
{
				$value = ProcessLargeText(GetData($defvalues,"Tgl_akhir", "Long Date"),"field=Tgl%5Fakhir","",MODE_VIEW);
		$xt->assignbyref("Tgl_akhir_editcontrol",$value);
}
// add prevent submit on enter js if only one text record
//	control - Jam_mulai
$control_Jam_mulai=array();
$control_Jam_mulai["func"]="xt_buildeditcontrol";
$control_Jam_mulai["params"] = array();
$control_Jam_mulai["params"]["field"]="Jam_mulai";
$control_Jam_mulai["params"]["value"]=@$defvalues["Jam_mulai"];

//	Begin Add validation
$arrValidate = array();	
$control_Jam_mulai["params"]["validate"]=$arrValidate;
//	End Add validation

$control_Jam_mulai["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_Jam_mulai["params"]["mode"]="inline_add";
else
	$control_Jam_mulai["params"]["mode"]="add";
if(!$detailKeys || !in_array("Jam_mulai", $detailKeys))
	$xt->assignbyref("Jam_mulai_editcontrol",$control_Jam_mulai);
else if(array_key_exists("Jam_mulai", $defvalues))
{
				$value = ProcessLargeText(GetData($defvalues,"Jam_mulai", "Time"),"field=Jam%5Fmulai","",MODE_VIEW);
		$xt->assignbyref("Jam_mulai_editcontrol",$value);
}
// add prevent submit on enter js if only one text record
//	control - Jam_akhir
$control_Jam_akhir=array();
$control_Jam_akhir["func"]="xt_buildeditcontrol";
$control_Jam_akhir["params"] = array();
$control_Jam_akhir["params"]["field"]="Jam_akhir";
$control_Jam_akhir["params"]["value"]=@$defvalues["Jam_akhir"];

//	Begin Add validation
$arrValidate = array();	
$control_Jam_akhir["params"]["validate"]=$arrValidate;
//	End Add validation

$control_Jam_akhir["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_Jam_akhir["params"]["mode"]="inline_add";
else
	$control_Jam_akhir["params"]["mode"]="add";
if(!$detailKeys || !in_array("Jam_akhir", $detailKeys))
	$xt->assignbyref("Jam_akhir_editcontrol",$control_Jam_akhir);
else if(array_key_exists("Jam_akhir", $defvalues))
{
				$value = ProcessLargeText(GetData($defvalues,"Jam_akhir", "Time"),"field=Jam%5Fakhir","",MODE_VIEW);
		$xt->assignbyref("Jam_akhir_editcontrol",$value);
}
// add prevent submit on enter js if only one text record
//	control - Tempat
$control_Tempat=array();
$control_Tempat["func"]="xt_buildeditcontrol";
$control_Tempat["params"] = array();
$control_Tempat["params"]["field"]="Tempat";
$control_Tempat["params"]["value"]=@$defvalues["Tempat"];

//	Begin Add validation
$arrValidate = array();	
$arrValidate['basicValidate'][] = "IsRequired";
$control_Tempat["params"]["validate"]=$arrValidate;
//	End Add validation

$control_Tempat["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_Tempat["params"]["mode"]="inline_add";
else
	$control_Tempat["params"]["mode"]="add";
if(!$detailKeys || !in_array("Tempat", $detailKeys))
	$xt->assignbyref("Tempat_editcontrol",$control_Tempat);
else if(array_key_exists("Tempat", $defvalues))
{
				$value = ProcessLargeText(GetData($defvalues,"Tempat", ""),"field=Tempat","",MODE_VIEW);
		$xt->assignbyref("Tempat_editcontrol",$value);
}
// add prevent submit on enter js if only one text record
$pageObject->addCommonJs();
/////////////////////////////////////////////////////////////
if($isShowDetailTables)
{
	$options = array();
	//array of params for classes
	$options["mode"] = LIST_DETAILS;
	$options["pageType"] = PAGE_LIST;
	$options["masterPageType"] = PAGE_ADD;
	$options['masterTable'] = $strTableName;
	$options['firstTime'] = 1;

	$detailTables = array();
	for($d=0;$d<count($dpParams['ids']);$d++)
	{
		$strTableName = $dpParams['strTableNames'][$d];
		include("include/".GetTableURL($strTableName)."_settings.php");
		if(!$d)
		{
			include('classes/listpage.php');
			include('classes/listpage_embed.php');
			include('classes/listpage_dpinline.php');
			include("classes/searchclause.php");
		}
		$options['xt'] = new Xtempl();
		$options['id'] = $dpParams['ids'][$d];

		$listPageObject = ListPage::createListPage($strTableName,$options);
		// prepare code
		$listPageObject->prepareForBuildPage();
		
		if($listPageObject->isDispGrid())
		{
			$listJsFiles = array();
			$listCssFiles = array();
			
			//Add Detail's js code to master's code
			$pageObject->AddJSCode("\n /*---Begin code for detailsPreview_".$options['id']."---*/ \n".
									$listPageObject->grabAllJsCode().
									"\n /*---End code for detailsPreview_".$options['id']."---*/ \n");
			
			//Add detail's js files to master's files
			$listJsFiles = $listPageObject->grabAllJSFiles();
			for($i=0;$i<count($listJsFiles);$i++)
				$pageObject->AddJSFile($listJsFiles[$i]);
			
			//Add detail's css files to master's files	
			$listCssFiles = $listPageObject->grabAllCSSFiles();	
			for($i=0;$i<count($listCssFiles);$i++)
				$pageObject->AddCSSFile($listCssFiles[$i]);
		}
		$detailTables[] = array("displayDetailTable_".GoodFieldName($strTableName) => array("func" => "showDetailTable","params" => array("dpObject" => $listPageObject, "dpParams" => $strTableName)));
	}
	$xt->assign_loopsection("detail_tables",$detailTables);	
	$strTableName = "agenda";
}
/////////////////////////////////////////////////////////////

$jscode = $pageObject->PrepareJS();
if($inlineadd!=ADD_ONTHEFLY && $inlineadd!=ADD_MASTER)
{
	if($inlineadd==ADD_INLINE)
	{
		$jscode=str_replace(array("&","<",">"),array("&amp;","&lt;","&gt;"),$jscode);
		$xt->assignbyref("linkdata",$jscode);
	}
	$pageObject->body["end"] .= "<script>".$jscode."</script>";
	$xt->assign("body",$pageObject->body);
	$xt->assign("flybody",true);
}
else
{
	if(!@$_POST["a"]=="added")
	{
		echo "<jscode>";
		echo str_replace(array("\\","\r","\n"),array("\\\\","\\r","\\n"),$jscode);;
		echo "</jscode>";
	}
	else if(@$_POST["a"]=="added" && ($error_happened || $status=="DECLINED"))
	{
		echo "<textarea id=\"data\">decli";
		//$jscode = "\n\rwindow.Runner = window.opener.Runner;console.log(window.Runner, window.opener.Runner);".$jscode;
		echo htmlspecialchars($jscode);
		echo "</textarea>";
	}
	$pageObject->body["end"] .= "</form>";
	$xt->assign("footer","");
	$xt->assign("flybody",$pageObject->body);
	$xt->assign("body",true);
}	



$xt->assign("style_block",true);
$pageObject->xt->assign("legend", true);


if(function_exists("BeforeShowAdd"))
	BeforeShowAdd($xt,$templatefile);

if($inlineadd==ADD_ONTHEFLY)
{
	$xt->load_template($templatefile);
	if(@$_POST["a"]=="added" && ($error_happened || $status=="DECLINED"))
	{
		echo "<textarea id=\"html\">";		
		$xt->display_loaded("style_block");
		$xt->display_loaded("flybody");
		echo "</textarea>";
	}
	else
	{		
		$xt->display_loaded("style_block");
		$xt->display_loaded("flybody");
	}
	
}
else
	$xt->display($templatefile);
?>
