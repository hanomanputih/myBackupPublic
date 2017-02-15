<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("include/agenda_variables.php");

//	check if logged in
if(!@$_SESSION["UserID"] || !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}

include('include/xtempl.php');
include('classes/runnerpage.php');
include("classes/searchclause.php");
$xt = new Xtempl();


$query = $gQuery->Copy();

$filename="";	
$message="";
$key=array();
$next=array();
$prev=array();
$all=postvalue("all");
$pdf=postvalue("pdf");
$mypage=1;

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

if(postvalue("id"))
	$id = postvalue("id");
else
	$id = 1;

// assign an id			
$xt->assign("id",$id);

//array of params for classes
$params = array("pageType" => PAGE_VIEW, "id" =>$id, "tName"=>$strTableName);
$pageObject = new RunnerPage($params);

// proccess big google maps


// add onload event
$onLoadJsCode = GetTableData($pageObject->tName, ".jsOnloadView", '');
$pageObject->addOnLoadJsEvent($onLoadJsCode);


// add button events if exist
$buttonHandlers = GetTableData($pageObject->tName, ".buttonHandlers_".$pageObject->getPageType(), array());
$pageObject->addButtonHandlers($buttonHandlers);


$isShowDetailTables = displayDetailsOn($strTableName,PAGE_VIEW);	
$dpParams = array();
if($isShowDetailTables)
{
	$ids = $id;
	$pageObject->AddJSFile("detailspreview");
}

//	Before Process event
if(function_exists("BeforeProcessView"))
	BeforeProcessView($conn);

$strWhereClause = '';
if(!$all)
{
	$keys=array();
	$strWhereClause="";
	$keys["id_agenda"]=postvalue("editid1");
	
	
	//get current values and show edit controls
	$strWhereClause = KeyWhere($keys);

	$searchWhereClause = $searchClauseObj->getWhere(GetListOfFieldsByExprType(false));
	$searchHavingClause = $searchClauseObj->getWhere(GetListOfFieldsByExprType(true));

	$strWhereClause = whereAdd($strWhereClause,$searchWhereClause);
	$strHavingClause = $searchHavingClause;
	
	$strSQL = gSQLWhere($strWhereClause,$strHavingClause);
}
else
{
	if ($_SESSION[$strTableName."_SelectedSQL"]!="" && @$_REQUEST["records"]=="") 
	{
		$strSQL = $_SESSION[$strTableName."_SelectedSQL"];
		$strWhereClause=@$_SESSION[$strTableName."_SelectedWhere"];
	}
	else
	{
		$strWhereClause=@$_SESSION[$strTableName."_where"];
		$strSQL=gSQLWhere($strWhereClause);
	}
	$strOrderBy=$_SESSION[$strTableName."_order"];
	if(!$strOrderBy)
		$strOrderBy=$gstrOrderBy;
	$strSQL.=" ".trim($strOrderBy);
//	order by
	$strOrderBy=$_SESSION[$strTableName."_order"];
	if(!$strOrderBy)
		$strOrderBy=$gstrOrderBy;
	$strSQL.=" ".trim($strOrderBy);
		$numrows=gSQLRowCount($strWhereClause,0);
}

$strSQLbak = $strSQL;
if(function_exists("BeforeQueryView"))
	BeforeQueryView($strSQL,$strWhereClause);
if($strSQLbak == $strSQL)
	$strSQL=gSQLWhere($strWhereClause);

if(!$all)
{
	LogInfo($strSQL);
	$rs=db_query($strSQL,$conn);
}
else
{
//	 Pagination:
	$nPageSize=0;
	if(@$_REQUEST["records"]=="page" && $numrows)
	{
		$mypage=(integer)@$_SESSION[$strTableName."_pagenumber"];
		$nPageSize=(integer)@$_SESSION[$strTableName."_pagesize"];
		if($numrows<=($mypage-1)*$nPageSize)
			$mypage=ceil($numrows/$nPageSize);
		if(!$nPageSize)
			$nPageSize=$gPageSize;
		if(!$mypage)
			$mypage=1;
		$strSQL.=" limit ".(($mypage-1)*$nPageSize).",".$nPageSize;
	}
	$rs=db_query($strSQL,$conn);
}

$data=db_fetch_array($rs);

$out="";
$first=true;

$templatefile="";
$fieldsArr = array();
$arr = array();
$arr['fName'] = "id_masuk";
$arr['viewFormat'] = ViewFormat("id_masuk", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Apa";
$arr['viewFormat'] = ViewFormat("Apa", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Tgl_mulai";
$arr['viewFormat'] = ViewFormat("Tgl_mulai", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Jam_mulai";
$arr['viewFormat'] = ViewFormat("Jam_mulai", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Tgl_akhir";
$arr['viewFormat'] = ViewFormat("Tgl_akhir", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Jam_akhir";
$arr['viewFormat'] = ViewFormat("Jam_akhir", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Tempat";
$arr['viewFormat'] = ViewFormat("Tempat", $strTableName);
$fieldsArr[] = $arr;

$pageObject->setGoogleMapsParams($fieldsArr);


while($data)
{
	$xt->assign("show_key1", htmlspecialchars(GetData($data,"id_agenda", "")));

	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["id_agenda"]));

////////////////////////////////////////////
//id_masuk - 
	$value="";
	$value=DisplayLookupWizard("id_masuk",$data["id_masuk"],$data,$keylink,MODE_VIEW);
	$xt->assign("id_masuk_value",$value);
	$xt->assign("id_masuk_fieldblock",true);
////////////////////////////////////////////
//Apa - HTML
	$value="";
	$value = GetData($data,"Apa", "HTML");
	$xt->assign("Apa_value",$value);
	$xt->assign("Apa_fieldblock",true);
////////////////////////////////////////////
//Tgl_mulai - Short Date
	$value="";
	$value = ProcessLargeText(GetData($data,"Tgl_mulai", "Short Date"),"","",MODE_VIEW);
	$xt->assign("Tgl_mulai_value",$value);
	$xt->assign("Tgl_mulai_fieldblock",true);
////////////////////////////////////////////
//Jam_mulai - Time
	$value="";
	$value = ProcessLargeText(GetData($data,"Jam_mulai", "Time"),"","",MODE_VIEW);
	$xt->assign("Jam_mulai_value",$value);
	$xt->assign("Jam_mulai_fieldblock",true);
////////////////////////////////////////////
//Tgl_akhir - Short Date
	$value="";
	$value = ProcessLargeText(GetData($data,"Tgl_akhir", "Short Date"),"","",MODE_VIEW);
	$xt->assign("Tgl_akhir_value",$value);
	$xt->assign("Tgl_akhir_fieldblock",true);
////////////////////////////////////////////
//Jam_akhir - Time
	$value="";
	$value = ProcessLargeText(GetData($data,"Jam_akhir", "Time"),"","",MODE_VIEW);
	$xt->assign("Jam_akhir_value",$value);
	$xt->assign("Jam_akhir_fieldblock",true);
////////////////////////////////////////////
//Tempat - 
	$value="";
	$value = ProcessLargeText(GetData($data,"Tempat", ""),"","",MODE_VIEW);
	$xt->assign("Tempat_value",$value);
	$xt->assign("Tempat_fieldblock",true);
 


$jsKeysObj = 'window.recKeysObj = {';
	$jsKeysObj .= "'".jsreplace("id_agenda")."': '".(jsreplace(@$data["id_agenda"]))."', ";
$jsKeysObj = substr($jsKeysObj, 0, strlen($jsKeysObj)-2);
$jsKeysObj .= '};';
$pageObject->AddJsCode($jsKeysObj);	

/////////////////////////////////////////////////////////////
if($isShowDetailTables)
{
	$options = array();
	//array of params for classes
	$options["mode"] = LIST_DETAILS;
	$options["pageType"] = PAGE_LIST;
	$options["masterPageType"] = PAGE_VIEW;
	$options['masterTable'] = $strTableName;
	$options['firstTime'] = 1;
	
	$detailTables = array();
	
	for($d=0;$d<count($dpParams['ids']);$d++)
	{
		include("include/".$dpParams['shortTableNamesS'][$d]."_settings.php");
		$strTableName = $dpParams['strTableNames'][$d];
		if(!$d)
		{
			include('classes/listpage.php');
			include('classes/listpage_embed.php');
			include('classes/listpage_dpinline.php');
		}
		$options['xt'] = new Xtempl();
		$options['id'] = $dpParams['ids'][$d];
		$mkr=1;
		foreach($mKeys[$dpParams['shortTableNamesS'][$d]] as $mk)
			$options['masterKeysReq'][$mkr++] = $data[$mk];

		$listPageObject = ListPage::createListPage($strTableName, $options);
		// prepare code
		$listPageObject->prepareForBuildPage();
		// show page
		if(!$pdf && $listPageObject->isDispGrid())
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
		$detailTables[] = array("displayDetailTable_".$dpParams['shortTableNamesG'][$d] => array("func" => "showDetailTable","params" => array("dpObject" => $listPageObject, "dpParams" => $strTableName)));
	}	
	$xt->assign_loopsection("detail_tables",$detailTables);	
	$strTableName = "agenda";		
}
/////////////////////////////////////////////////////////////	


	
if(!$pdf || $isShowDetailTables)
{
	$pageObject->body["begin"] .="<script type=\"text/javascript\" src=\"include/jquery.js\"></script>\r\n";
	$pageObject->body["begin"].="<script language=\"JavaScript\" src=\"include/jsfunctions.js\"></script>\r\n";
	if ($pageObject->debugJSMode === true)
	{
		$pageObject->body["begin"].="<script language=\"JavaScript\" src=\"include/runnerJS/Runner.js\"></script>\r\n";
		$pageObject->body["begin"].="<script language=\"JavaScript\" src=\"include/runnerJS/Util.js\"></script>\r\n";
	}
	else
	{
		$pageObject->body["begin"].="<script language=\"JavaScript\" src=\"include/runnerJS/RunnerBase.js\"></script>\r\n";
	}
	
	if ($pageObject->googleMapCfg['isUseGoogleMap'])
	{
		$pageObject->initGmaps();
		$pageObject->body["begin"] .= '<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key='.$pageObject->googleMapCfg['APIcode'].'" type="text/javascript"></script>';
	}
	if(!$pdf)
		$pageObject->AddJsCode("\n window.TEXT_PDF_BUILD1='".jsreplace("")."';".
								"\n window.TEXT_PDF_BUILD2='".jsreplace("")."';");
		
	$pageObject->body["end"].="<script>".$pageObject->PrepareJS()."</script>";	
}	

$xt->assignbyref("body",$pageObject->body);
$xt->assign("style_block",true);
$xt->assign("stylefiles_block",true);


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Begin prepare for Next Prev button
if(!@$_SESSION[$strTableName."_noNextPrev"])
{
	$where_next=$where_prev="";
	$order_next=$order_prev="";
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
			$_SESSION[$strTableName."_noNextPrev"] = 1;
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
		$order_next=$_SESSION[$strTableName."_order"];
	elseif($lenArr>0)
	{
		for($i=0;$i<$lenArr;$i++)
			$order_next .=(GetFieldByIndex($arrFieldForSort[$i]) ? ($order_next!="" ? ", " : " ORDER BY ").$arrFieldForSort[$i]." ".$arrHowFieldSort[$i] : "");
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
				else{
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
			else $flag=1;
		}
		$where_next =$where_next.$scob;
		$where_prev =$where_prev.$scob;
		$where_next=whereAdd($where_next,SecuritySQL("Search"));
		$where_prev=whereAdd($where_prev,SecuritySQL("Search"));
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
//End prepare for Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!$pdf && !$all)
{
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Begin show Next Prev button
    $nextlink=$prevlink="";
	if(count($next))
    {
		$xt->assign("next_button",true);
	 		$nextlink .="editid1=".htmlspecialchars(rawurlencode($next[1]));
		$xt->assign("nextbutton_attrs","onclick=\"window.location.href='agenda_view.php?".$nextlink."'\"");
	}
	else 
		$xt->assign("next_button",false);	
	if(count($prev))
	{
		$xt->assign("prev_button",true);
			$prevlink .="editid1=".htmlspecialchars(rawurlencode($prev[1]));
		$xt->assign("prevbutton_attrs","onclick=\"window.location.href='agenda_view.php?".$prevlink."'\"");
	}
    else 
		$xt->assign("prev_button",false);
//Begin show Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$xt->assign("back_button",true);
	$xt->assign("backbutton_attrs","onclick=\"window.location.href='agenda_list.php?a=return'\"");
}

$oldtemplatefile=$templatefile;
$templatefile = "agenda_view.htm";

if(!$all)
{
	if(function_exists("BeforeShowView"))
		BeforeShowView($xt,$templatefile,$data);
	if(!$pdf)
		$xt->display($templatefile);
	break;
}
}


?>
