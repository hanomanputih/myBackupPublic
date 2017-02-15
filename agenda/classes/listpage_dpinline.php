<?php

class ListPage_DPInline extends ListPage_Embed
{
	/**
	 * DP params
	 *
	 * @var string
	 */
	var $dpParams = "";
	/**
	 * Array of details preview master key
	 *
	 * @var integer
	 */
	var $dpMasterKey = array ();
	/**
	 * Short name of master table
	 *
	 * @var string
	 */
	var $masterShortTable = "";
	/**
	 * Master's form name
	 *
	 * @var string
	 */	
	var $masterFormName = "";
	/**
	 * Master's id use only for dpInline on list page
	 * (don't confuse with dpInline on add edit pages)
	 * @var string
	 */
	var $masterId = "";
	/**
	 * Constructor, set initial params
	 *
	 * @param array $params
	 */
	function ListPage_DPInline(&$params)
	{
		// copy properties to object
		//RunnerApply($this, $params);
		// call parent constructor
		parent::ListPage_Embed($params);
		$this->initDPInlineParams();
		$this->searchClauseObj->clearSearch();
	}
	/**
      * Assigne Import Links or not
      *
	  * @return boolean
      */
	function importLinksAttrs() 
	{
		return true;
	}
	/**
      * Display master table info or not
      *
	  * @return boolean
      */
	function displayMasterTableInfo() 
	{
		return true;
	}
	/**
      * Process master key value
      * Set master key for create DPInline params
	  */
	function processMasterKeyValue() 
	{
		parent::processMasterKeyValue();
		for($i=1;$i<=count($this->masterKeysReq);$i++)
			$this->dpMasterKey[] = $this->masterKeysReq[$i];
	}
	/**
      * Initialization DPInline params
      * 
      */
	function initDPInlineParams()
	{
		$strkey="";
		for($i=0;$i<count($this->dpMasterKey);$i++)
			$strkey.="&masterkey".($i+1)."=".rawurlencode($this->dpMasterKey[$i]);
		$this->dpParams = "mode=listdetails&id=".$this->id."&mastertable=".rawurlencode($this->masterTable).$strkey.
							($this->masterId ? "&masterid=".$this->masterId : "").
							(($this->masterPageType==PAGE_EDIT || $this->masterPageType==PAGE_VIEW) ? "&masterpagetype=".$this->masterPageType : "");
	}
	/**
	 * Get string of master keys for dpInline on Edit page
	 */
	function getStrMasterKey()
	{
		$strkey = "[";
		for($i=0;$i<count($this->dpMasterKey);$i++)
			$strkey .= "'".jsreplace($this->dpMasterKey[$i])."',";
		$strkey =  substr($strkey, 0, -1);	
		return $strkey."]";	
	}
	
	/**
	 * Set order links attribute for order on list page
	 *
	 * @param {string} $field - name field, which is ordering
	 * @param {string} $sort - how is filed ordering, "a" - asc or "d" - desc, default is "a"
	 */
	function setLinksAttr($field,$sort="")
	{
		if($this->masterPageType!=PAGE_ADD)
		{
			$href=$this->shortTableName."_list.php?orderby=".($sort!="" ? ($sort=="a" ? "d" : "a") : "a").$field."&".$this->dpParams;
			$orderlinkattrs="onclick=\"".$this->getLocation($href)."\" href=\"".$href."\"";
			return $orderlinkattrs;
		}
	}
	/**
	 * Add common js files and code
	 */
	function addCommonJs() 
	{
		parent::addCommonJs();
		$strKey = $this->getStrMasterKey();
		if($this->firstTime && ($this->masterPageType==PAGE_EDIT || $this->masterPageType==PAGE_ADD || $this->masterPageType==PAGE_VIEW))
		{
			if($this->useDetailsPreview)
				//create iframe for list details on page add, edit or view
				$this->addJSCode("\ndpInline".$this->id.".createPreviewIframe({'mode':'list_details_edit_add'});");
			else
				//create new dpInline object for list details on page add, edit or view
				$this->addJSCode("\nwindow.dpInline".$this->id." = new detailsPreviewInline(
								{'pageId':".$this->id.",
								 'mode':'list_details_edit_add',
								 'ext':'php',
								 'mTable':'".jsreplace($this->masterTable)."'}); 
								 dpInline".$this->id.".createPreviewIframe();");
			
			//if master page edit, then create form for deleting records from list details on page edit
			if($this->masterPageType==PAGE_EDIT)
				$this->addJSCode("\ndpInline".$this->id.".createPreviewForm({'id':".$this->id.",'dTable':'".$this->shortTableName."','mTable':'".jsreplace($this->masterTable)."','mKeys':".$strKey.",'mPageType':'".PAGE_EDIT."'});");
			
			if($this->masterPageType!=PAGE_VIEW)
			{
				$this->addJSCode("\nvar opts =  window.dpObj.Opts;
								  len = opts.dInlineObjs.length;
								  opts.dCaptions[len] = '".jsreplace($this->strCaption)."';");	
								  
				if($this->masterPageType==PAGE_ADD && $this->isUseInlineAdd)
					$this->addJSCode("\nvar obj = window.inlineEditing".$this->id.";
									  opts.dInlineObjs[len] = obj; obj.inlineAdd(flyid++,true);");
				elseif($this->masterPageType==PAGE_EDIT && $this->isUseInlineJs)
					$this->addJSCode("\nopts.dInlineObjs[len] = window.inlineEditing".$this->id.";");
			}		
		}
		elseif(!$this->firstTime && $this->masterPageType==PAGE_EDIT)
			$this->addJSCode("\nvar opts =  window.dpObj.Opts;
							  len = opts.dInlineObjs.length;
							  if(!len)
								opts.dInlineObjs[len] = window.inlineEditing".$this->id.";
							  else		
								for(var i=0;i<len;i++)
									if(opts.dInlineObjs[i].pageid == ".$this->id.")
										opts.dInlineObjs[i] = window.inlineEditing".$this->id.";");
										
		//for recalculation detail records after add new record on list page only
		$this->prepareForRecalculate('add');
	}	
	/**
	 * Prepare for recalculate details count records
	 * @param {string} type - type of editing add or edit
	 */	
	function prepareForRecalculate($type="")
	{
		if(!$this->masterPageType && $type)
		{
			$allMasterTablesArr = GetMasterTablesArr($this->tName);
			for($i = 0; $i < count($allMasterTablesArr); $i ++) 
			{
				if($allMasterTablesArr[$i]['mDataSourceTable'] == $this->masterTable && $allMasterTablesArr[$i]['dispChildCount'])
				{
					if($type=="add")
						$this->addJSCode("\ninlineEditing".$this->id.".addListener('add_saved',function(pageid,dTable){updateCntRecsDetail(pageid,dTable,0,'".$type."')});");									
					elseif($type=="delete")
						$this->addJSCode("\nupdateCntRecsDetail(".$this->id.",'".$this->shortTableName."',".$this->recordsDeleted.",'".$type."');");	
				}
			}									
		}
	}
	/**
	 * Delete selected records
	 */
	function deleteRecords() 
	{
		parent::deleteRecords();
		//for recalculation detail records after delete records on list page only
		if($this->recordsDeleted)
			$this->prepareForRecalculate('delete');
	}
	/**
      * Add javascript pagination code for current mode
      *
	  */
	function addJSPagination()
	{
		$this->addJSCode("\nwindow.GotoPage".$this->id." = function (nPageNumber){".$this->getLocation($this->shortTableName."_list.php?".$this->dpParams."&goto='+nPageNumber+'",false)."};");
	}
	/**
	 * show inline add link
	 * Add inline add attributes
	 */
	function inlineAddLinksAttrs()
	{
		//inline add link and attr
		if($this->masterPageType!=PAGE_VIEW)
		{
			$this->xt->assign("inlineadd_link", $this->permis[$this->tName]['add']);
			$this->xt->assign("inlineaddlink_attrs", "href='".$this->shortTableName."_add.php' onclick=\"return inlineEditing".$this->id.".inlineAdd(flyid++);\"");
		}
	}
	
	/**
      * Add common assign for current mode
      *
	  */
	function commonAssign()
	{
		parent::commonAssign();
			
		$this->xt->assign("left_block", false);
		//select all link and attr	
		if($this->masterPageType==PAGE_ADD || $this->masterPageType==PAGE_VIEW)
		{
			$this->xt->assign("selectall_link",false);
			$this->xt->assign("checkbox_column",false);
			$this->xt->assign("checkbox_header",false);
			$this->xt->assign("editselected_link",false);
			$this->xt->assign("delete_link",false);
			$this->xt->assign("saveall_link",false);
			if($this->masterPageType==PAGE_VIEW)
				$this->xt->assign("recordcontrols_block",false);
		}
		else{	
				//selectall link attrs
				$this->selectAllLinkAttrs();		
				
				//checkbox column	
				$this->checkboxColumnAttrs();
					
				//edit selected link and attr	
				$this->editSelectedLinkAttrs();	
				
				//save all link, attr, span	
				$this->saveAllLinkAttrs();
				
				//delete link and attr	
				$this->deleteSelectedLink();	
					
				if($this->masterPageType!=PAGE_EDIT)
				{	
					$searchPermis = $this->permis[$this->tName]['search'];
					$this->xt->assign("details_block", $searchPermis && $this->rowsFound );
					$this->xt->assign("pages_block", $searchPermis && $this->rowsFound );
				}	
			}
			
			if($this->masterPageType!=PAGE_VIEW)
			{
				//inline edit column	
				$editPermis = $this->permis[$this->tName]['edit'];
				$this->xt->assign("inlineedit_column",$editPermis);
				
				//for list icons instead of list links
				$this->assignListIconsColumn($editPermis);
						
				//cancel all link, attr, span	
				$this->cancelAllLinkAttrs();
			}
			
			$allDetailsTablesArr = GetDetailTablesArr($this->tName);
			for($i=0;$i<count($allDetailsTablesArr);$i++) 
			{
				$permis = ($this->isGroupSecurity && $this->permis[$allDetailsTablesArr[$i]['dDataSourceTable']]['add'] && $this->permis[$allDetailsTablesArr[$i]['dDataSourceTable']]['search'])||(!$this->isGroupSecurity);	
				if($permis)
				{
					$this->xt->assign(GoodFieldName($this->tName)."_dtable_column", $permis);
					break;
				}
			}
	}
	
	/**
	 * Assign delete selected attrs
	 * 
	 */
	function deleteSelectedAttrs()
	{
		//$href = $this->shortTableName."_list.php?".$this->dpParams;
		$this->xt->assign("deleteselectedlink_attrs","name=\"delete_selected".$this->id."\"  
							onclick=\"dpInline".($this->masterId ? $this->masterId : $this->id).".submitPreviewForm(".($this->masterId ? $this->id : "").")\"");	
	}
	
	/**
      * Display blocks after loaded template of page
      *
      */
	function displayAfterLoadTempl() 
	{
		parent::displayAfterLoadTempl();
		if($this->masterPageType!=PAGE_EDIT && $this->masterPageType!=PAGE_ADD && $this->masterPageType!=PAGE_VIEW)
		{
			echo'<div style="padding-top:2px;">&nbsp;&nbsp;&nbsp;&nbsp;';
			$this->xt->display_loaded("details_block");
			echo '&nbsp;&nbsp;';
			$this->xt->display_loaded("pages_block");
			echo'</div>';
		}
		echo '<div style="margin:10px 0;">';
		$this->xt->display_loaded("newrecord_controls");
		$this->xt->display_loaded("record_controls");
		echo'</div>';
		$this->xt->display_loaded("grid_block");
		$this->xt->display_loaded("pagination_block");
	}
	
	/**
      * Final build page
      *
	  */
	function prepareForBuildPage() 
	{	
		//orderlinkattrs for fields
		$this->orderLinksAttr();
		
		//Sorting fields
		if($this->masterPageType!=PAGE_ADD)
			$this->buildOrderParams();
		
		// delete record
		$this->deleteRecords();
		
		// build sql query
		$this->buildSQL();
		
		// build pagination block
		$this->buildPagination();
		
		// seek page must be executed after build pagination
		$this->seekPageInRecSet($this->querySQL);
		
		$this->setGoogleMapsParams($this->listFields);
		
		// fill grid data
		$this->fillGridData();
		
		// add common js code
		$this->addCommonJs();
		
		// add common html code
		$this->addCommonHtml();
		
		// Set common assign
		$this->commonAssign();
	}
	
}
?>
