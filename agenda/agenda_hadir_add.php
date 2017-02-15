<?php 
include("include/dbcommon.php");

@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");
header("Pragma: no-cache");
header("Cache-Control: no-cache");

include("include/agenda_hadir_variables.php");
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
	$templatefile = "agenda_hadir_inline_add.htm";
else
	$templatefile = "agenda_hadir_add.htm";

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
	$mKeys["agenda_hasil"] = GetMasterKeysByDetailTable("agenda_hasil", $strTableName);
	$dpParams['strTableNames'][] = "agenda_hasil";
	$dpParams['ids'][] = ++$ids;
	if($inlineadd==ADD_SIMPLE)
	{
		$pageObject->AddJSCode("window.dpObj = new dpInlineOnAddEdit({
			'mTableName':'".jsreplace($strTableName)."',
			'mShortTableName':'agenda_hadir', 
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
//	processing id_agenda - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_id_agenda_".$id);
	$type=postvalue("type_id_agenda_".$id);
	if (FieldSubmitted("id_agenda_".$id))
	{
		$value=prepare_for_db("id_agenda",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "id_agenda"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["id_agenda"]=$value;
	}
	}
//	processibng id_agenda - end
//	processing Instansi - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_Instansi_".$id);
	$type=postvalue("type_Instansi_".$id);
	if (FieldSubmitted("Instansi_".$id))
	{
		$value=prepare_for_db("Instansi",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "Instansi"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["Instansi"]=$value;
	}
	}
//	processibng Instansi - end
//	processing id_bos - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_id_bos_".$id);
	$type=postvalue("type_id_bos_".$id);
	if (FieldSubmitted("id_bos_".$id))
	{
		$value=prepare_for_db("id_bos",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "id_bos"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["id_bos"]=$value;
	}
	}
//	processibng id_bos - end
//	processing Jabatan - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_Jabatan_".$id);
	$type=postvalue("type_Jabatan_".$id);
	if (FieldSubmitted("Jabatan_".$id))
	{
		$value=prepare_for_db("Jabatan",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "Jabatan"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["Jabatan"]=$value;
	}
	}
//	processibng Jabatan - end
//	processing Jam - start
    
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
	$value = postvalue("value_Jam_".$id);
	$type=postvalue("type_Jam_".$id);
	if (FieldSubmitted("Jam_".$id))
	{
		$value=prepare_for_db("Jam",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		if(1 && "Jam"=="Passw" && $url_page=="admin_users_")
			$value=md5($value);
		$avalues["Jam"]=$value;
	}
	}
//	processibng Jam - end


//	insert masterkey value if exists and if not specified
	if(@$_SESSION[$sessionPrefix."_mastertable"]=="agenda")
	{
		if(!@$_SESSION[$sessionPrefix."_masterkey1"] && postvalue("masterkey1"))
			$_SESSION[$sessionPrefix."_masterkey1"] = postvalue("masterkey1");
		if($avalues["id_agenda"]=="")
			$avalues["id_agenda"]=prepare_for_db("id_agenda",$_SESSION[$sessionPrefix."_masterkey1"]);
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
					$message .='&nbsp;<a href=\'agenda_hadir_edit.php?'.$keylink.'\'>Edit</a>&nbsp;';
				if(GetTableData($strTableName,".view",false) && $permis['search'])
					$message .='&nbsp;<a href=\'agenda_hadir_view.php?'.$keylink.'\'>View</a>&nbsp;';
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
	header("Location: agenda_hadir_".$pageObject->getPageType().".php");
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
		$copykeys["id_hadir"]=postvalue("copyid1");
	}
	else
	{
		$copykeys["id_hadir"]=postvalue("editid1");
	}
	$strWhere=KeyWhere($copykeys);
	$strSQL = gSQLWhere($strWhere);

	LogInfo($strSQL);
	$rs=db_query($strSQL,$conn);
	$defvalues=db_fetch_array($rs);
	if(!$defvalues)
		$defvalues=array();
//	clear key fields
	$defvalues["id_hadir"]="";
//call CopyOnLoad event
	if(function_exists("CopyOnLoad"))
		CopyOnLoad($defvalues,$strWhere);
}
else
{
	$defvalues["Jam"]=now();
}
//	set default values for the foreign keys
if(@$_SESSION[$sessionPrefix."_mastertable"]=="agenda")
{
	if(!@$_SESSION[$sessionPrefix."_masterkey1"] && postvalue("masterkey1"))
			$_SESSION[$sessionPrefix."_masterkey1"] = postvalue("masterkey1");
	$defvalues["id_agenda"]=@$_SESSION[$sessionPrefix."_masterkey1"];	
}

if($readavalues)
{
	$defvalues["id_agenda"]=@$avalues["id_agenda"];
	$defvalues["Instansi"]=@$avalues["Instansi"];
	$defvalues["id_bos"]=@$avalues["id_bos"];
	$defvalues["Jabatan"]=@$avalues["Jabatan"];
	$defvalues["Jam"]=@$avalues["Jam"];
}
//for basic files
$includes="";
if ($inlineadd!==ADD_INLINE && $inlineadd!=ADD_ONTHEFLY)
	$pageObject->addJSCode("AddEventForControl('".jsreplace($strTableName)."', '', ".$id.");\r\n");

		
	
$onsubmit = $pageObject->onSubmitForEditingPage($formname);
	

//////////////////////////////////////////////////////////////////	
$pageObject->AddJSFile("ui");
$pageObject->AddJSFile("ui.core","ui");
$pageObject->AddJSFile('ui.resizable','ui.core');
$pageObject->AddJSFile("onthefly");
////////////////////// time picker
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
	$xt->assign("id_agenda_fieldblock",true);
	$xt->assign("id_agenda_label",true);
	if(isEnableSection508())
		$xt->assign_section("id_agenda_label","<label for=\"".GetInputElementId("id_agenda", $id)."\">","</label>");
	$xt->assign("Instansi_fieldblock",true);
	$xt->assign("Instansi_label",true);
	if(isEnableSection508())
		$xt->assign_section("Instansi_label","<label for=\"".GetInputElementId("Instansi", $id)."\">","</label>");
	$xt->assign("id_bos_fieldblock",true);
	$xt->assign("id_bos_label",true);
	if(isEnableSection508())
		$xt->assign_section("id_bos_label","<label for=\"".GetInputElementId("id_bos", $id)."\">","</label>");
	$xt->assign("Jabatan_fieldblock",true);
	$xt->assign("Jabatan_label",true);
	if(isEnableSection508())
		$xt->assign_section("Jabatan_label","<label for=\"".GetInputElementId("Jabatan", $id)."\">","</label>");
	$xt->assign("Jam_fieldblock",true);
	$xt->assign("Jam_label",true);
	if(isEnableSection508())
		$xt->assign_section("Jam_label","<label for=\"".GetInputElementId("Jam", $id)."\">","</label>");
	
	
	if($inlineadd!=ADD_ONTHEFLY)
	{
		if($onsubmit)
			$onsubmit="onsubmit=\"".htmlspecialchars($onsubmit)."\"";
		
		$pageObject->body["begin"] .= $includes;
		$xt->assign("backbutton_attrs","onclick=\"window.location.href='agenda_hadir_list.php?a=return'\"");
		$xt->assign("back_button",true);
		
		$xt->assign('addForm', array('begin'=>'<form name="'.$formname.'" id="'.$formname.'" encType="multipart/form-data" method="post" action="agenda_hadir_add.php" '.$onsubmit.'>'.		
			'<input type=hidden name="a" value="added">'.
			($isShowDetailTables ? '<input type=hidden name="editType" value="addmaster">' : ''), 'end'=>'</form>'));
	}
	else
	{
		$destroyCtrls = "Runner.controls.ControlManager.unregister('".htmlspecialchars(jsreplace($strTableName))."');";
		$onsubmit="onsubmit=\"".htmlspecialchars($onsubmit.$destroyCtrls)."\"";
		
		$pageObject->body["begin"] .='<form name="'.$formname.'" id="'.$formname.'" encType="multipart/form-data" method="post" action="agenda_hadir_add.php" '.$onsubmit.' target="flyframe'.$id.'">'.
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
	$readonlyfields["Jam"] = htmlspecialchars(GetData($defvalues,"Jam", "Short Date"));
$linkdata="";

$fieldAppear = ($inlineadd!=ADD_INLINE);
//Does control field apper on add page or not?
if($inlineadd==ADD_INLINE)
{
	$categoryFieldAppear=false;
}
else
{
	$categoryFieldAppear=true;
}
if($fieldAppear)
{
	$output = loadSelectContent("id_bos",@$defvalues["Instansi"],$categoryFieldAppear,@$defvalues["id_bos"]);
	$txt = ""; 
	foreach( $output as $value ) 
	{
		$txt .= jsreplace($value)."\\n";
	}
	$pageObject->AddJSCode("var Cntrl = Runner.controls.ControlManager.getAt('".jsreplace($strTableName)."', ".$id.", 'id_bos');	
				Cntrl.preload('".$txt."','".jsreplace(@$defvalues["id_bos"])."');");
}
$fieldAppear = ($inlineadd!=ADD_INLINE);
//Does control field apper on add page or not?
if($inlineadd==ADD_INLINE)
{
	$categoryFieldAppear=false;
}
else
{
	$categoryFieldAppear=true;
}
if($fieldAppear)
{
	$output = loadSelectContent("Jabatan",@$defvalues["id_bos"],$categoryFieldAppear,@$defvalues["Jabatan"]);
	$txt = ""; 
	foreach( $output as $value ) 
	{
		$txt .= jsreplace($value)."\\n";
	}
	$pageObject->AddJSCode("var Cntrl = Runner.controls.ControlManager.getAt('".jsreplace($strTableName)."', ".$id.", 'Jabatan');	
				Cntrl.preload('".$txt."','".jsreplace(@$defvalues["Jabatan"])."');");
}
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
	$masterquery="mastertable=agenda%5Fhadir";
	$masterquery.="&masterkey1=".rawurlencode($data["id_bos"]);
	$showDetailKeys["agenda_hasil"]=$masterquery;

	$showKeys[] = htmlspecialchars($keys["id_hadir"]);

	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["id_hadir"]));

////////////////////////////////////////////
//	id_agenda - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value=DisplayLookupWizard("id_agenda",$data["id_agenda"],$data,$keylink,MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "id_agenda";
				$showRawValues[] = substr($data["id_agenda"],0,100);
	}	
//	Instansi - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value=DisplayLookupWizard("Instansi",$data["Instansi"],$data,$keylink,MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Instansi";
				$showRawValues[] = substr($data["Instansi"],0,100);
	}	
//	id_bos - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value=DisplayLookupWizard("id_bos",$data["id_bos"],$data,$keylink,MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "id_bos";
				$showRawValues[] = substr($data["id_bos"],0,100);
	}	
//	Jabatan - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value = ProcessLargeText(GetData($data,"Jabatan", ""),"field=Jabatan".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Jabatan";
				$showRawValues[] = substr($data["Jabatan"],0,100);
	}	
//	Jam - Short Date
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE)
		$display = true;
	if($display)
	{	
		$value="";
				$value = ProcessLargeText(GetData($data,"Jam", "Short Date"),"field=Jam".$keylink,"",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Jam";
				$showRawValues[] = substr($data["Jam"],0,100);
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
//	control - id_agenda
$control_id_agenda=array();
$control_id_agenda["func"]="xt_buildeditcontrol";
$control_id_agenda["params"] = array();
$control_id_agenda["params"]["field"]="id_agenda";
$control_id_agenda["params"]["value"]=@$defvalues["id_agenda"];

//	Begin Add validation
$arrValidate = array();	
$arrValidate['basicValidate'][] = "IsRequired";
$control_id_agenda["params"]["validate"]=$arrValidate;
//	End Add validation

$control_id_agenda["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_id_agenda["params"]["mode"]="inline_add";
else
	$control_id_agenda["params"]["mode"]="add";
if(!$detailKeys || !in_array("id_agenda", $detailKeys))
	$xt->assignbyref("id_agenda_editcontrol",$control_id_agenda);
else if(array_key_exists("id_agenda", $defvalues))
{
				$value=DisplayLookupWizard("id_agenda",$defvalues["id_agenda"],$defvalues,"",MODE_VIEW);
		$xt->assignbyref("id_agenda_editcontrol",$value);
}
// add prevent submit on enter js if only one text record
//	control - Instansi
$control_Instansi=array();
$control_Instansi["func"]="xt_buildeditcontrol";
$control_Instansi["params"] = array();
$control_Instansi["params"]["field"]="Instansi";
$control_Instansi["params"]["value"]=@$defvalues["Instansi"];

//	Begin Add validation
$arrValidate = array();	
$control_Instansi["params"]["validate"]=$arrValidate;
//	End Add validation

$control_Instansi["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_Instansi["params"]["mode"]="inline_add";
else
	$control_Instansi["params"]["mode"]="add";
if(!$detailKeys || !in_array("Instansi", $detailKeys))
	$xt->assignbyref("Instansi_editcontrol",$control_Instansi);
else if(array_key_exists("Instansi", $defvalues))
{
				$value=DisplayLookupWizard("Instansi",$defvalues["Instansi"],$defvalues,"",MODE_VIEW);
		$xt->assignbyref("Instansi_editcontrol",$value);
}
// add prevent submit on enter js if only one text record
//	control - id_bos
$control_id_bos=array();
$control_id_bos["func"]="xt_buildeditcontrol";
$control_id_bos["params"] = array();
$control_id_bos["params"]["field"]="id_bos";
$control_id_bos["params"]["value"]=@$defvalues["id_bos"];

//	Begin Add validation
$arrValidate = array();	
$arrValidate['basicValidate'][] = "IsRequired";
$control_id_bos["params"]["validate"]=$arrValidate;
//	End Add validation

$control_id_bos["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_id_bos["params"]["mode"]="inline_add";
else
	$control_id_bos["params"]["mode"]="add";
if(!$detailKeys || !in_array("id_bos", $detailKeys))
	$xt->assignbyref("id_bos_editcontrol",$control_id_bos);
else if(array_key_exists("id_bos", $defvalues))
{
				$value=DisplayLookupWizard("id_bos",$defvalues["id_bos"],$defvalues,"",MODE_VIEW);
		$xt->assignbyref("id_bos_editcontrol",$value);
}
// add prevent submit on enter js if only one text record
//	control - Jabatan
$control_Jabatan=array();
$control_Jabatan["func"]="xt_buildeditcontrol";
$control_Jabatan["params"] = array();
$control_Jabatan["params"]["field"]="Jabatan";
$control_Jabatan["params"]["value"]=@$defvalues["Jabatan"];

//	Begin Add validation
$arrValidate = array();	
$arrValidate['basicValidate'][] = "IsRequired";
$control_Jabatan["params"]["validate"]=$arrValidate;
//	End Add validation

$control_Jabatan["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_Jabatan["params"]["mode"]="inline_add";
else
	$control_Jabatan["params"]["mode"]="add";
if(!$detailKeys || !in_array("Jabatan", $detailKeys))
	$xt->assignbyref("Jabatan_editcontrol",$control_Jabatan);
else if(array_key_exists("Jabatan", $defvalues))
{
				$value=DisplayLookupWizard("Jabatan",$defvalues["Jabatan"],$defvalues,"",MODE_VIEW);
		$xt->assignbyref("Jabatan_editcontrol",$value);
}
// add prevent submit on enter js if only one text record
//	control - Jam
$control_Jam=array();
$control_Jam["func"]="xt_buildeditcontrol";
$control_Jam["params"] = array();
$control_Jam["params"]["field"]="Jam";
$control_Jam["params"]["value"]=@$defvalues["Jam"];

//	Begin Add validation
$arrValidate = array();	
$control_Jam["params"]["validate"]=$arrValidate;
//	End Add validation

$control_Jam["params"]["id"]=$id;
if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY)
	$control_Jam["params"]["mode"]="inline_add";
else
	$control_Jam["params"]["mode"]="add";
if(!$detailKeys || !in_array("Jam", $detailKeys))
	$xt->assignbyref("Jam_editcontrol",$control_Jam);
else if(array_key_exists("Jam", $defvalues))
{
				$value = ProcessLargeText(GetData($defvalues,"Jam", "Short Date"),"field=Jam","",MODE_VIEW);
		$xt->assignbyref("Jam_editcontrol",$value);
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
	$strTableName = "agenda_hadir";
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
