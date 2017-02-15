<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("include/agenda_variables.php");
include('include/xtempl.php');
include('classes/runnerpage.php');
include("classes/searchclause.php");

/////////////////////////////////////////////////////////////
//	check if logged in
/////////////////////////////////////////////////////////////
if(!@$_SESSION["UserID"] || !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Edit"))
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}

$auditObj = GetAuditObject($strTableName);
$lockingObj = GetLockingObject($strTableName);
if($lockingObj)
{
	$system_attrs = "style='visibility:hidden;'";
	$system_message = "";
}

if($_REQUEST["action"]!="")
{
	if($lockingObj)
	{
		$arrkeys = explode("&",refine($_REQUEST["keys"]));
		foreach($arrkeys as $ind=>$val)
		{
			$arrkeys[$ind]=urldecode($val);
		}
		if($_REQUEST["action"]=="unlock")
		{
			$lockingObj->UnlockRecord($strTableName,$arrkeys,$_REQUEST["sid"]);
			exit();	
		}
		else if($_REQUEST["action"]=="lockadmin" && (IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP))
		{
			$lockingObj->UnlockAdmin($strTableName,$arrkeys,$_REQUEST["startEdit"]=="yes");
			if($_REQUEST["startEdit"]=="no")
				echo "unlock";
			else if($_REQUEST["startEdit"]=="yes")
				echo "lock";
			exit();	
		}
		else if($_REQUEST["action"]=="confirm")
		{
			if(!$lockingObj->ConfirmLock($strTableName,$arrkeys,$message));
				echo $message;
			exit();	
		}
	}
	else
	{
		exit();
	}
}

/////////////////////////////////////////////////////////////
//init variables
/////////////////////////////////////////////////////////////

$filename = "";
$status = "";
$message = "";
$mesClass = "";
$usermessage = "";
$error_happened = false;
$readevalues = false;
$bodyonload = "";
$key = array();
$next = array();
$prev = array();


$showKeys = array();
$showValues = array();
$showRawValues = array();
$showFields = array();
$showDetailKeys = array();
$IsSaved = false;
$HaveData = true;

$strWhereClause = "";
	
$inlineedit = (postvalue("editType")=="inline") ? true : false;
$templatefile = "agenda_edit.htm";

//Get detail table keys	
$detailKeys = array();
$detailKeys = GetDetailKeysByMasterTable($_SESSION[$strTableName."_mastertable"], $strTableName);	

$xt = new Xtempl();

// SearchClause class stuff
if (isset($_SESSION[$strTableName.'_advsearch']))
	$searchClauseObj = unserialize($_SESSION[$strTableName.'_advsearch']);
else
{
	$allSearchFields = GetTableData($strTableName, '.allSearchFields', array());
	$searchClauseObj = new SearchClause($strTableName, $allSearchFields, $strTableName);
}
$searchClauseObj->parseRequest();
$_SESSION[$strTableName.'_advsearch'] = serialize($searchClauseObj);

if(postvalue("recordID"))
	$id = postvalue("recordID");
else 
{
	$id=postvalue("id");
	if(intval($id)==0)
		$id = 1;
}

// assign an id		
$xt->assign("id",$id);
$formname="editform".$id;

//array of params for classes
$params = array("pageType" => PAGE_EDIT,"id" => $id,"mode" => $inlineedit);
$enableCtrlsForEditing = true;

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
if (!$inlineedit)
{
	
}
// end proccess captcha


// add onload event
$onLoadJsCode = GetTableData($pageObject->tName, ".jsOnloadEdit", '');
$pageObject->addOnLoadJsEvent($onLoadJsCode);


if (!$inlineedit)
{
	// add button events if exist
	$buttonHandlers = GetTableData($pageObject->tName, ".buttonHandlers_".$pageObject->getPageType(), array());
	$pageObject->addButtonHandlers($buttonHandlers);
}
//	Before Process event
if(function_exists("BeforeProcessEdit"))
	BeforeProcessEdit($conn);

$keys=array();
$savedKeys=array();
$skeys="";
$keys["id_agenda"]=postvalue("editid1");
$savedKeys["id_agenda"]=postvalue("editid1");
$skeys.=rawurlencode(postvalue("editid1"))."&";
if($skeys!="")
	$skeys=substr($skeys,0,-1);
	
$isShowDetailTables = displayDetailsOn($strTableName,PAGE_EDIT);	
$dpParams = array();
if($isShowDetailTables && !$inlineedit)
{
	$ids = $id;
	$mKeys["agenda_hadir"] = GetMasterKeysByDetailTable("agenda_hadir", $strTableName);
	$dpParams['strTableNames'][] = "agenda_hadir";
	$dpParams['ids'][] = ++$ids;
	$pageObject->AddJSCode("window.dpObj = new dpInlineOnAddEdit({
			'mTableName':'".jsreplace($strTableName)."',
			'mForm':$('#".$formname."'),
			'mPageType':'".PAGE_EDIT."',
			'dMessages':'',
			'dCaptions':[],			
			'dInlineObjs':[]});");		
	$pageObject->AddJSFile("detailspreview");
}	
	
/////////////////////////////////////////////////////////////
//	process entered data, read and save
/////////////////////////////////////////////////////////////

if(@$_POST["a"] == "edited")
{
	$strWhereClause = whereAdd($strWhereClause,KeyWhere($keys));
		if(function_exists("AfterEdit") || function_exists("BeforeEdit") || $auditObj)
	{
		//	read old values
		$rsold=db_query(gSQLWhere($strWhereClause), $conn);
		$dataold=db_fetch_array($rsold);
	}
	$evalues=array();
	$efilename_values=array();
	$files_delete=array();
	$files_move=array();
	$files_save=array();
	$blobfields=array();

	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_id_agenda_".$id);
	$type=postvalue("type_id_agenda_".$id);
	if(FieldSubmitted("id_agenda_".$id))
	{
		
		$value=prepare_for_db("id_agenda",$value,$type);
	}
	else
	{
		$value=false;
	}
	if($value!==false)
	{	




		$evalues["id_agenda"]=$value;
	}

//	update key value
	if($value!==false)
	{
		$keys["id_agenda"]=$value;
	}

//	processibng id_agenda - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_id_masuk_".$id);
	$type=postvalue("type_id_masuk_".$id);
	if(FieldSubmitted("id_masuk_".$id))
	{
		
		$value=prepare_for_db("id_masuk",$value,$type);
	}
	else
	{
		$value=false;
	}
	if($value!==false)
	{	




		$evalues["id_masuk"]=$value;
	}


//	processibng id_masuk - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Apa_".$id);
	$type=postvalue("type_Apa_".$id);
	if(FieldSubmitted("Apa_".$id))
	{
		
		$value=prepare_for_db("Apa",$value,$type);
	}
	else
	{
		$value=false;
	}
	if($value!==false)
	{	




		$evalues["Apa"]=$value;
	}


//	processibng Apa - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Tgl_mulai_".$id);
	$type=postvalue("type_Tgl_mulai_".$id);
	if(FieldSubmitted("Tgl_mulai_".$id))
	{
		
		$value=prepare_for_db("Tgl_mulai",$value,$type);
	}
	else
	{
		$value=false;
	}
	if($value!==false)
	{	




		$evalues["Tgl_mulai"]=$value;
	}


//	processibng Tgl_mulai - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Tgl_akhir_".$id);
	$type=postvalue("type_Tgl_akhir_".$id);
	if(FieldSubmitted("Tgl_akhir_".$id))
	{
		
		$value=prepare_for_db("Tgl_akhir",$value,$type);
	}
	else
	{
		$value=false;
	}
	if($value!==false)
	{	




		$evalues["Tgl_akhir"]=$value;
	}


//	processibng Tgl_akhir - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Jam_mulai_".$id);
	$type=postvalue("type_Jam_mulai_".$id);
	if(FieldSubmitted("Jam_mulai_".$id))
	{
		
		$value=prepare_for_db("Jam_mulai",$value,$type);
	}
	else
	{
		$value=false;
	}
	if($value!==false)
	{	




		$evalues["Jam_mulai"]=$value;
	}


//	processibng Jam_mulai - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Jam_akhir_".$id);
	$type=postvalue("type_Jam_akhir_".$id);
	if(FieldSubmitted("Jam_akhir_".$id))
	{
		
		$value=prepare_for_db("Jam_akhir",$value,$type);
	}
	else
	{
		$value=false;
	}
	if($value!==false)
	{	




		$evalues["Jam_akhir"]=$value;
	}


//	processibng Jam_akhir - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Tempat_".$id);
	$type=postvalue("type_Tempat_".$id);
	if(FieldSubmitted("Tempat_".$id))
	{
		
		$value=prepare_for_db("Tempat",$value,$type);
	}
	else
	{
		$value=false;
	}
	if($value!==false)
	{	




		$evalues["Tempat"]=$value;
	}


//	processibng Tempat - end
	}

	foreach($efilename_values as $ekey=>$value)
	{
		$evalues[$ekey]=$value;
	}
	
	if($lockingObj )
	{
		$lockmessage="";
		if(!$lockingObj->ConfirmLock($strTableName,$savedKeys,$lockmessage))
		{
			$enableCtrlsForEditing = false;
			$system_attrs = "style='visibility:visible;'";
			if($inlineedit)
			{
				if(IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP)
					echo $lockingObj->GetLockInfo($strTableName,$savedKeys,false,$id);
				else
					echo $lockmessage;
				exit();
			}
			else
			{
				if(IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP)
					$system_message = $lockingObj->GetLockInfo($strTableName,$savedKeys,true,$id);
				else
					$system_message = $lockmessage;
			}
			$status="DECLINED";
			$readevalues=true;
		}
	}
	
	if($readevalues==false)
	{
	//	do event
		$retval=true;
		if(function_exists("BeforeEdit"))
		{
			$retval=BeforeEdit($evalues,$strWhereClause,$dataold,$keys,$usermessage,$inlineedit);
		}
		if($retval && $isCaptchaOk == 1)
		{		
			if(DoUpdateRecord($strOriginalTableName,$evalues,$blobfields,$strWhereClause,$id))
			{
				$IsSaved=true;
				
				//	after edit event
				if($lockingObj && $inlineedit)
				{
					$lockingObj->UnlockRecord($strTableName,$savedKeys,"");
				}
				if($auditObj || function_exists("AfterEdit"))
				{
					foreach($dataold as $idx=>$val)
					{
						if(!array_key_exists($idx,$evalues))
						{
							$evalues[$idx]=$val;
						}
					}
				}

				if($auditObj)
				{
					$auditObj->LogEdit($strTableName,$evalues,$dataold,$keys);
				}
				if(function_exists("AfterEdit"))
				{
					AfterEdit($evalues,KeyWhere($keys),$dataold,$keys,$inlineedit);
				}
				
				if(!$inlineedit)
				{	
					$_SESSION[$strTableName."_count_captcha"] = $_SESSION[$strTableName."_count_captcha"]+1;
					$mesClass = "mes_ok";	
				}
			}
			elseif(!$inlineedit)
				$mesClass = "mes_not";	
		}
		else
		{
			$readevalues=true;
			$message = $usermessage;
			$status="DECLINED";
		}
	}
	if($readevalues)
		$keys=$savedKeys;
}
//else
{
	/////////////////////////
	//Locking recors
	/////////////////////////

	if($lockingObj)
	{
		$enableCtrlsForEditing = $lockingObj->LockRecord($strTableName,$keys);
		if(!$enableCtrlsForEditing)
		{
			if($inlineedit)
			{
				if(IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP)
					echo "lock ".$lockingObj->GetLockInfo($strTableName,$keys,false,$id);
				else
					echo "lock ".$lockingObj->LockUser;
				exit();
			}
			$system_attrs = "style='visibility:visible;'";

			$system_message = $lockingObj->LockUser;
			
			if(IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP)
			{
				$rb = $lockingObj->GetLockInfo($strTableName,$keys,true,$id);
				if($rb!="")
				{
					$system_attrs = "style='visibility:visible;'";
					$system_message = $rb;
				}
			}
		}
	}
}

if($lockingObj && !$inlineedit)
{
	$pageObject->body["begin"] .='<div id="system_div'.$id.'" class="admin_message" '.$system_attrs.'>'.$system_message.'</div>';
}

$message = "<div class='message ".$mesClass."'>".$message."</div>";

// PRG rule, to avoid POSTDATA resend
if ($IsSaved && no_output_done() && !$inlineedit )
{
	// saving message
	$_SESSION["message"] = ($message ? $message : "");
	// key get query
	$keyGetQ = "";
		$keyGetQ.="editid1=".rawurldecode($keys["id_agenda"])."&";
	// cut last &
	$keyGetQ = substr($keyGetQ, 0, strlen($keyGetQ)-1);	
	// redirect
	header("Location: agenda_".$pageObject->getPageType().".php?".$keyGetQ);
	// turned on output buffering, so we need to stop script
	exit();
}
// for PRG rule, to avoid POSTDATA resend. Saving mess in session
if (!$inlineedit && isset($_SESSION["message"])){
	$message = $_SESSION["message"];
	unset($_SESSION["message"]);
}



/////////////////////////////////////////////////////////////
//	read current values from the database
/////////////////////////////////////////////////////////////
$query = $queryData_agenda->Copy();



$strWhereClause = KeyWhere($keys);


$searchWhereClause = $searchClauseObj->getWhere(GetListOfFieldsByExprType(false));
$searchHavingClause = $searchClauseObj->getWhere(GetListOfFieldsByExprType(true));

$strWhereClause = whereAdd($strWhereClause,$searchWhereClause);
$strHavingClause = $searchHavingClause;

$strSQL = gSQLWhere($strWhereClause,$strHavingClause);

$strSQLbak = $strSQL;
//	Before Query event
if(function_exists("BeforeQueryEdit"))
	BeforeQueryEdit($strSQL, $strWhereClause);

if($strSQLbak == $strSQL)
{
	$strSQL = gSQLWhere($strWhereClause,$strHavingClause);
}	
LogInfo($strSQL);

$rs=db_query($strSQL, $conn);
$data=db_fetch_array($rs);

if(!$data)
{
	if(!$inlineedit)
	{
		header("Location: agenda_list.php?a=return");
		exit();
	}
	else
		$data=array();
}

$readonlyfields=array();


if($readevalues)
{
	$data["id_agenda"]=$evalues["id_agenda"];
	$data["id_masuk"]=$evalues["id_masuk"];
	$data["Apa"]=$evalues["Apa"];
	$data["Tgl_mulai"]=$evalues["Tgl_mulai"];
	$data["Tgl_akhir"]=$evalues["Tgl_akhir"];
	$data["Jam_mulai"]=$evalues["Jam_mulai"];
	$data["Jam_akhir"]=$evalues["Jam_akhir"];
	$data["Tempat"]=$evalues["Tempat"];
}
/////////////////////////////////////////////////////////////
//	assign values to $xt class, prepare page for displaying
/////////////////////////////////////////////////////////////
//Basic includes js files
$includes="";
//javascript code
if (!$inlineedit)
	$pageObject->addJSCode("AddEventForControl('".jsreplace($strTableName)."', prevNextButtonHandler,".$id.");\r\n");
	
//event for onsubmit
$onsubmit = $pageObject->onSubmitForEditingPage($formname);

////////////////////// time picker
$pageObject->AddJSFile("ui");
$pageObject->AddJSFile("jquery.utils","ui");
$pageObject->AddJSFile("ui.dropslide","jquery.utils");
$pageObject->AddJSFile("ui.timepickr","ui.dropslide");
$pageObject->AddCSSFile("ui.dropslide");
//////////////////////
$pageObject->AddJSFile("customlabels");
if(isset($params["calendar"]))
	$pageObject->AddJSFile("calendar");
	
	
if(!$inlineedit)
{
	$includes .="<script language=\"JavaScript\" src=\"include/jquery.js\"></script>\r\n";
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
	$includes.="<div id=\"search_suggest".$id."\"></div>\r\n";
	$xt->assign("id_agenda_fieldblock",true);
	$xt->assign("id_agenda_label",true);
	if(isEnableSection508())
		$xt->assign_section("id_agenda_label","<label for=\"".GetInputElementId("id_agenda", $id)."\">","</label>");
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
	
	if(strlen($onsubmit))
		$onsubmit="onSubmit=\"".htmlspecialchars($onsubmit)."\"";
	$pageObject->body["begin"] .= $includes;
	
	
	$hiddenKeys = '';
	$hiddenKeys .= "<input type=\"hidden\" name=\"editid1\" value=\"".htmlspecialchars($keys["id_agenda"])."\">";
	$xt->assign("show_key1", htmlspecialchars(GetData($data,"id_agenda", "")));
	
	$xt->assign('editForm', array('begin'=>'<form name="'.$formname.'" id="'.$formname.'" encType="multipart/form-data" method="post" action="agenda_edit.php" '.$onsubmit.'>'.
		'<input type="hidden" name="a" value="edited">'.$hiddenKeys, 'end'=>'</form>'));
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Begin Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
if(!@$_SESSION[$strTableName."_noNextPrev"])
{
	$where_next="";
	$where_prev="";
	$order_next="";
	$order_prev="";
	$arrFieldForSort=array();
	$arrHowFieldSort=array();
	$where=$_SESSION[$strTableName."_where"];
	
	if(GetFieldIndex("id_agenda"))
		$key[]=GetFieldIndex("id_agenda");
	
//if session mass sorting empty, then create it as a sheet
	if(@$_SESSION[$strTableName."_arrFieldForSort"] && @$_SESSION[$strTableName."_arrHowFieldSort"])
	{
		$arrFieldForSort=$_SESSION[$strTableName."_arrFieldForSort"];
		$arrHowFieldSort=$_SESSION[$strTableName."_arrHowFieldSort"];
		$lenArr=count($arrFieldForSort);
	}
	else
	{
		if(count($g_orderindexes))
		{
			for($i=0;$i<count($g_orderindexes);$i++)
			{
				$arrFieldForSort[]=$g_orderindexes[$i][0];
				$arrHowFieldSort[]=$g_orderindexes[$i][1];
			}
		}
		elseif($gstrOrderBy!='')
		{
			$_SESSION[$strTableName."_noNextPrev"] = 1;
		}
		
		if(count($key))
		{
			for($i=0;$i<count($key);$i++)
			{
				$idsearch=array_search($key[$i],$arrFieldForSort);
				if($idsearch===false)
				{
					$arrFieldForSort[]=$key[$i];
					$arrHowFieldSort[]="ASC";
				}
			}
		}
		
		$_SESSION[$strTableName."_arrFieldForSort"]=$arrFieldForSort;
		$_SESSION[$strTableName."_arrHowFieldSort"]=$arrHowFieldSort;
		$lenArr=count($arrFieldForSort);
	}
//if session order by empty, then create a line order		
	if(@$_SESSION[$strTableName."_order"])
	{
		$order_next=$_SESSION[$strTableName."_order"];
	}
	elseif($lenArr>0)
	{
		for($i=0;$i<$lenArr;$i++)
		{
			$order_next .=(GetFieldByIndex($arrFieldForSort[$i]) ? ($order_next!="" ? ", " : " ORDER BY ").$arrFieldForSort[$i]." ".$arrHowFieldSort[$i] : "");
		}
	}
//create a line where and order for the two queries
	if($lenArr>0 and count($key) and !$_SESSION[$strTableName."_noNextPrev"])
	{
		if($where)
			$where = "(".$where.") and ";
		$scob="";
		$flag=0;
		for($i=0;$i<$lenArr;$i++)
		{
			$fieldName=GetFieldByIndex($arrFieldForSort[$i]);
			if($fieldName)
			{
				$order_prev .=($order_prev!="" ? ", " : " ORDER BY ").$arrFieldForSort[$i].($arrHowFieldSort[$i]=="ASC" ? " DESC" : " ASC");
				$dbg=GetFullFieldName($fieldName);
				if(!is_null($data[$fieldName]))
				{
					$mdv=make_db_value($fieldName,$data[$fieldName]);
					$ga=($arrHowFieldSort[$i]=="ASC" ? ">" : "<");
					$gd=($arrHowFieldSort[$i]=="ASC" ? "<" : ">");
					$gasc=$dbg.$ga.$mdv;
					$gdesc=$dbg.$gd.$mdv;
					$gravn=($i!=$lenArr-1 ? $dbg."=".$mdv : "");
					$ganull=($ga=="<" ? " or ".$dbg." IS NULL" : "");
					$gdnull=($gd=="<" ? " or ".$dbg." IS NULL" : "");
				}
				else
				{
					$gasc=($arrHowFieldSort[$i]=="ASC" ? $dbg." IS NOT NULL" : "");
					$gdesc=($arrHowFieldSort[$i]=="ASC" ? "" : $dbg." IS NOT NULL");
					$gravn=($i!=$lenArr-1 ? $dbg." IS NULL" : "");
					$ganull=$gdnull="";
				}
				
				//create where clause for next sql
				$where_next .= ($where_next!="" ? " and (" : " (");
				if($gasc=="" && $gravn=="") 
					$where_next .= " 1=0 "; 
				else{
						if($gasc!="") 
							$where_next .= $gasc.$ganull;
						if($gasc!="" && $gravn!="")
							$where_next .= " or ";
						$where_next .= $gravn." ";
					}
				
				//create where clause for prev sql
				$where_prev .= ($where_prev!="" ? " and (" : " (");
				if($gdesc=="" && $gravn=="") 
					$where_prev .= " 1=0 ";
				else{
						
						if($gdesc!="")
							$where_prev .= $gdesc.$gdnull;
						if($gdesc!="" && $gravn!="") 
							$where_prev .= " or ";
						$where_prev .= $gravn." ";
					}
				$scob .=")";
			}
			else 
				$flag=1;
		}
		$where_next =$where_next.$scob;
		$where_prev =$where_prev.$scob;
		$where_next=whereAdd($where_next,SecuritySQL("Edit"));
		$where_prev=whereAdd($where_prev,SecuritySQL("Edit"));
		$oWhere = $query->Where();
		$where_next=whereAdd($where_next,$oWhere->toSql($query));
		$where_prev=whereAdd($where_prev,$oWhere->toSql($query));

		if($flag==1)
		{
			$order_next="";
			for($i=0;$i<$lenArr;$i++)
				$order_next .=(GetFieldByIndex($arrFieldForSort[$i]) ? ($order_next!="" ? ", " : " ORDER BY ").$arrFieldForSort[$i]." ".$arrHowFieldSort[$i] : "");
		}
		
		$query->ReplaceFieldsWithDummies(GetBinaryFieldsIndices());
		$sql_next = $query->toSql($where.$where_next, $order_next);
		$sql_prev = $query->toSql($where.$where_prev, $order_prev);
		
		if($where_next!="" and $order_next!="" and $where_prev!="" and $order_prev!="")
		{
					$sql_next.=" limit 1";
			$sql_prev.=" limit 1";
		
			$res_next=db_query($sql_next,$conn);		
			if($row_next=db_fetch_array($res_next))
			{
					$next[1]=$row_next["id_agenda"];
			}
			
			$res_prev=db_query($sql_prev,$conn);	
			if($row_prev=db_fetch_array($res_prev))
			{
					$prev[1]=$row_prev["id_agenda"];
			}
		}
	}
}
	$nextlink=$prevlink="";
	// reset button handler
	$resetEditors="";
	$unblRec="UnlockRecord('agenda_edit.php','".$skeys."','',function(){window.location.href='agenda_edit.php?";
	if(count($next))
	{
		$xt->assign("next_button",true);
				$nextlink .="editid1=".htmlspecialchars(rawurlencode($next[1]));
		$xt->assign("nextbutton_attrs","align=\"absmiddle\" onclick=\"".$unblRec.$nextlink."'});return false;\"");
		$resetEditors.="$('#next".$id."').attr('style','');$('#next".$id."').attr('disabled','');";
	}
	else 
		$xt->assign("next_button",false);
	if(count($prev))
	{
		$xt->assign("prev_button",true);
				$prevlink .="editid1=".htmlspecialchars(rawurlencode($prev[1]));
		$xt->assign("prevbutton_attrs","align=\"absmiddle\" onclick=\"".$unblRec.$prevlink."'});return false;\"");
		$resetEditors.="$('#prev".$id."').attr('style','');$('#prev".$id."').attr('disabled','');";
	}
	else 
		$xt->assign("prev_button",false);
	
	$resetEditors .= "Runner.controls.ControlManager.resetControlsForTable('".htmlspecialchars(jsreplace($strTableName))."');return false;";
	$xt->assign("resetbutton_attrs",'onclick="'.$resetEditors.'" onmouseover="this.focus();"');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//End Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
	$xt->assign("backbutton_attrs","onclick=\"UnlockRecord('agenda_edit.php','".$skeys."','',function(){window.location.href='agenda_list.php?a=return'});return false;\"");
	// onmouseover event, for changing focus. Needed to proper submit form
	$onmouseover = "this.focus();";
	$onmouseover = 'onmouseover="'.$onmouseover.'"';
	
	if(!$enableCtrlsForEditing)
		$xt->assign("savebutton_attrs","disabled=true style='background-color:#dcdcdc' ".$onmouseover);
	else
		$xt->assign("savebutton_attrs",$onmouseover);
	
	$xt->assign("save_button",true);
	$xt->assign("reset_button",true);
	$xt->assign("back_button",true);
}
$showKeys[] = rawurlencode($keys["id_agenda"]);
if($message)
{
	$xt->assign("message_block",true);
	$xt->assign("message",$message);
}
/////////////////////////////////////////////////////////////
//process readonly and auto-update fields
/////////////////////////////////////////////////////////////
//old way to disabled button prev next
	if(!$inlineedit) 
		$pageObject->AddJSCode($bodyonload."\r\n SetToFirstControl('".$formname."');\r\n");
	
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
$control_id_agenda["params"]["value"]=@$data["id_agenda"];
//	Begin Add validation
$arrValidate = array();	
$validatetype = getJsValidatorName("Number");
$arrValidate['basicValidate'][] = $validatetype;

$arrValidate['basicValidate'][] = "IsRequired";

$control_id_agenda["params"]["validate"]=$arrValidate;
//	End Add validation
$control_id_agenda["params"]["id"]=$id;
$additionalCtrlParams = array();
$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
$control_id_agenda["params"]["additionalCtrlParams"]=$additionalCtrlParams;
if($inlineedit)
	$control_id_agenda["params"]["mode"]="inline_edit";
else
	$control_id_agenda["params"]["mode"]="edit";
if(!$detailKeys || !in_array("id_agenda", $detailKeys))	
	$xt->assignbyref("id_agenda_editcontrol",$control_id_agenda);
else if(array_key_exists("id_agenda",$data))
{
				$value = ProcessLargeText(GetData($data,"id_agenda", ""),"field=id%5Fagenda","",MODE_VIEW);
		$xt->assignbyref("id_agenda_editcontrol",$value);
}


// add prevent submit on enter js if only one text record
//	control - id_masuk
$control_id_masuk=array();
$control_id_masuk["func"]="xt_buildeditcontrol";
$control_id_masuk["params"] = array();
$control_id_masuk["params"]["field"]="id_masuk";
$control_id_masuk["params"]["value"]=@$data["id_masuk"];
//	Begin Add validation
$arrValidate = array();	


$control_id_masuk["params"]["validate"]=$arrValidate;
//	End Add validation
$control_id_masuk["params"]["id"]=$id;
$additionalCtrlParams = array();
$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
$control_id_masuk["params"]["additionalCtrlParams"]=$additionalCtrlParams;
if($inlineedit)
	$control_id_masuk["params"]["mode"]="inline_edit";
else
	$control_id_masuk["params"]["mode"]="edit";
if(!$detailKeys || !in_array("id_masuk", $detailKeys))	
	$xt->assignbyref("id_masuk_editcontrol",$control_id_masuk);
else if(array_key_exists("id_masuk",$data))
{
				$value=DisplayLookupWizard("id_masuk",$data["id_masuk"],$data,"",MODE_VIEW);
		$xt->assignbyref("id_masuk_editcontrol",$value);
}


// add prevent submit on enter js if only one text record
//	control - Apa
$control_Apa=array();
$control_Apa["func"]="xt_buildeditcontrol";
$control_Apa["params"] = array();
$control_Apa["params"]["field"]="Apa";
$control_Apa["params"]["value"]=@$data["Apa"];
//	Begin Add validation
$arrValidate = array();	

$arrValidate['basicValidate'][] = "IsRequired";

$control_Apa["params"]["validate"]=$arrValidate;
//	End Add validation
$control_Apa["params"]["id"]=$id;
$additionalCtrlParams = array();
$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
$control_Apa["params"]["additionalCtrlParams"]=$additionalCtrlParams;
if($inlineedit)
	$control_Apa["params"]["mode"]="inline_edit";
else
	$control_Apa["params"]["mode"]="edit";
if(!$detailKeys || !in_array("Apa", $detailKeys))	
	$xt->assignbyref("Apa_editcontrol",$control_Apa);
else if(array_key_exists("Apa",$data))
{
				$value = GetData($data,"Apa", "HTML");
		$xt->assignbyref("Apa_editcontrol",$value);
}


// add prevent submit on enter js if only one text record
//	control - Tgl_mulai
$control_Tgl_mulai=array();
$control_Tgl_mulai["func"]="xt_buildeditcontrol";
$control_Tgl_mulai["params"] = array();
$control_Tgl_mulai["params"]["field"]="Tgl_mulai";
$control_Tgl_mulai["params"]["value"]=@$data["Tgl_mulai"];
//	Begin Add validation
$arrValidate = array();	

$arrValidate['basicValidate'][] = "IsRequired";

$control_Tgl_mulai["params"]["validate"]=$arrValidate;
//	End Add validation
$control_Tgl_mulai["params"]["id"]=$id;
$additionalCtrlParams = array();
$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
$control_Tgl_mulai["params"]["additionalCtrlParams"]=$additionalCtrlParams;
if($inlineedit)
	$control_Tgl_mulai["params"]["mode"]="inline_edit";
else
	$control_Tgl_mulai["params"]["mode"]="edit";
if(!$detailKeys || !in_array("Tgl_mulai", $detailKeys))	
	$xt->assignbyref("Tgl_mulai_editcontrol",$control_Tgl_mulai);
else if(array_key_exists("Tgl_mulai",$data))
{
				$value = ProcessLargeText(GetData($data,"Tgl_mulai", "Long Date"),"field=Tgl%5Fmulai","",MODE_VIEW);
		$xt->assignbyref("Tgl_mulai_editcontrol",$value);
}


// add prevent submit on enter js if only one text record
//	control - Tgl_akhir
$control_Tgl_akhir=array();
$control_Tgl_akhir["func"]="xt_buildeditcontrol";
$control_Tgl_akhir["params"] = array();
$control_Tgl_akhir["params"]["field"]="Tgl_akhir";
$control_Tgl_akhir["params"]["value"]=@$data["Tgl_akhir"];
//	Begin Add validation
$arrValidate = array();	

$arrValidate['basicValidate'][] = "IsRequired";

$control_Tgl_akhir["params"]["validate"]=$arrValidate;
//	End Add validation
$control_Tgl_akhir["params"]["id"]=$id;
$additionalCtrlParams = array();
$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
$control_Tgl_akhir["params"]["additionalCtrlParams"]=$additionalCtrlParams;
if($inlineedit)
	$control_Tgl_akhir["params"]["mode"]="inline_edit";
else
	$control_Tgl_akhir["params"]["mode"]="edit";
if(!$detailKeys || !in_array("Tgl_akhir", $detailKeys))	
	$xt->assignbyref("Tgl_akhir_editcontrol",$control_Tgl_akhir);
else if(array_key_exists("Tgl_akhir",$data))
{
				$value = ProcessLargeText(GetData($data,"Tgl_akhir", "Long Date"),"field=Tgl%5Fakhir","",MODE_VIEW);
		$xt->assignbyref("Tgl_akhir_editcontrol",$value);
}


// add prevent submit on enter js if only one text record
//	control - Jam_mulai
$control_Jam_mulai=array();
$control_Jam_mulai["func"]="xt_buildeditcontrol";
$control_Jam_mulai["params"] = array();
$control_Jam_mulai["params"]["field"]="Jam_mulai";
$control_Jam_mulai["params"]["value"]=@$data["Jam_mulai"];
//	Begin Add validation
$arrValidate = array();	

$control_Jam_mulai["params"]["validate"]=$arrValidate;
//	End Add validation
$control_Jam_mulai["params"]["id"]=$id;
$additionalCtrlParams = array();
$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
$control_Jam_mulai["params"]["additionalCtrlParams"]=$additionalCtrlParams;
if($inlineedit)
	$control_Jam_mulai["params"]["mode"]="inline_edit";
else
	$control_Jam_mulai["params"]["mode"]="edit";
if(!$detailKeys || !in_array("Jam_mulai", $detailKeys))	
	$xt->assignbyref("Jam_mulai_editcontrol",$control_Jam_mulai);
else if(array_key_exists("Jam_mulai",$data))
{
				$value = ProcessLargeText(GetData($data,"Jam_mulai", "Time"),"field=Jam%5Fmulai","",MODE_VIEW);
		$xt->assignbyref("Jam_mulai_editcontrol",$value);
}


// add prevent submit on enter js if only one text record
//	control - Jam_akhir
$control_Jam_akhir=array();
$control_Jam_akhir["func"]="xt_buildeditcontrol";
$control_Jam_akhir["params"] = array();
$control_Jam_akhir["params"]["field"]="Jam_akhir";
$control_Jam_akhir["params"]["value"]=@$data["Jam_akhir"];
//	Begin Add validation
$arrValidate = array();	

$control_Jam_akhir["params"]["validate"]=$arrValidate;
//	End Add validation
$control_Jam_akhir["params"]["id"]=$id;
$additionalCtrlParams = array();
$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
$control_Jam_akhir["params"]["additionalCtrlParams"]=$additionalCtrlParams;
if($inlineedit)
	$control_Jam_akhir["params"]["mode"]="inline_edit";
else
	$control_Jam_akhir["params"]["mode"]="edit";
if(!$detailKeys || !in_array("Jam_akhir", $detailKeys))	
	$xt->assignbyref("Jam_akhir_editcontrol",$control_Jam_akhir);
else if(array_key_exists("Jam_akhir",$data))
{
				$value = ProcessLargeText(GetData($data,"Jam_akhir", "Time"),"field=Jam%5Fakhir","",MODE_VIEW);
		$xt->assignbyref("Jam_akhir_editcontrol",$value);
}


// add prevent submit on enter js if only one text record
//	control - Tempat
$control_Tempat=array();
$control_Tempat["func"]="xt_buildeditcontrol";
$control_Tempat["params"] = array();
$control_Tempat["params"]["field"]="Tempat";
$control_Tempat["params"]["value"]=@$data["Tempat"];
//	Begin Add validation
$arrValidate = array();	

$arrValidate['basicValidate'][] = "IsRequired";

$control_Tempat["params"]["validate"]=$arrValidate;
//	End Add validation
$control_Tempat["params"]["id"]=$id;
$additionalCtrlParams = array();
$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
$control_Tempat["params"]["additionalCtrlParams"]=$additionalCtrlParams;
if($inlineedit)
	$control_Tempat["params"]["mode"]="inline_edit";
else
	$control_Tempat["params"]["mode"]="edit";
if(!$detailKeys || !in_array("Tempat", $detailKeys))	
	$xt->assignbyref("Tempat_editcontrol",$control_Tempat);
else if(array_key_exists("Tempat",$data))
{
				$value = ProcessLargeText(GetData($data,"Tempat", ""),"field=Tempat","",MODE_VIEW);
		$xt->assignbyref("Tempat_editcontrol",$value);
}


// add prevent submit on enter js if only one text record
$pageObject->addCommonJs();


if($lockingObj && $enableCtrlsForEditing)
	$pageObject->AddJSCode("window.timeid".$id."=setInterval( function() {ConfirmLock('agenda_edit.php','".jsreplace($strTableName)."','".$skeys."',".$id.",'".$inlineedit."');},".($lockingObj->ConfirmTime*1000).");");

/////////////////////////////////////////////////////////////
if($isShowDetailTables)
{
	$options = array();
	//array of params for classes
	$options["mode"] = LIST_DETAILS;
	$options["pageType"] = PAGE_LIST;
	$options["masterPageType"] = PAGE_EDIT;
	$options['masterTable'] = $strTableName;
	$options['firstTime'] = 1;
	
	$detailTables = array();
	
	for($d=0;$d<count($dpParams['ids']);$d++)
	{
		$strTableName = $dpParams['strTableNames'][$d];
		include("include/".GetTableUrl($strTableName)."_settings.php");
		if(!$d)
		{
			include('classes/listpage.php');
			include('classes/listpage_embed.php');
			include('classes/listpage_dpinline.php');
		}
		$options['xt'] = new Xtempl();
		$options['id'] = $dpParams['ids'][$d];
		$mkr=1;
		foreach($mKeys[$strTableName] as $mk)
			$options['masterKeysReq'][$mkr++] = $data[$mk];

		$listPageObject = ListPage::createListPage($strTableName, $options);
		// prepare code
		$listPageObject->prepareForBuildPage();
		// show page
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

if($inlineedit)
{
	$jscode = str_replace(array("&","<",">"),array("&amp;","&lt;","&gt;"),$jscode);
	$xt->assignbyref("linkdata",$jscode);
}
else{
	$pageObject->body["end"] .= "<script>".$jscode."</script>";	
	$xt->assignbyref("body",$pageObject->body);
}

$pageObject->xt->assign("legend", true);


/////////////////////////////////////////////////////////////
//display the page
/////////////////////////////////////////////////////////////
if(function_exists("BeforeShowEdit"))
	BeforeShowEdit($xt,$templatefile);

$xt->display($templatefile);

?>
