<?php

class ListPage_Lookup extends ListPage_Embed
{
	/**
      * String where for query
      *
      * @var string
      */
	var $strLookupWhere = "";
	/**
      * Field of category
      *
      * @var string
      */
	var $categoryField = "";
	/**
      * Field of link
      *
      * @var string
      */
	var $linkField = "";
	/**
      * Parent id
      *
      * @var integer
      */
	var $parId =0;
	/**
      * Field of lookup
      *
      * @var string
      */
	var $lookupField = "";
	/**
      * Control of lookup
      *
      * @var string
      */
	var $lookupControl = "";
	/**
      * Categoru of lookup
      *
      * @var string
      */
	var $lookupCategory = "";
	/**
      * Table of lookup
      *
      * @var string
      */
	var $lookupTable = "";
	/**
      * Params of lookup
      *
      * @var string
      */
	var $lookupParams = "";
	/**
      * Select field of lookup
      *
      * @var string
      */
	var $lookupSelectField = "";
	/**
      * Field customed
      *
      * @var string
      */
	var $customField = "";
	/**
      * Field displayed
      *
      * @var string
      */
	var $dispField = "";
	var $mainTable = "";
	var $mainField = "";
	
	var $dispFieldAlias = "";
	
	var $lookupValuesArr = array();
	
	/**
      * Constructor, set initial params
      *
      * @param array $params
      */
    
     
	function ListPage_Lookup(&$params)
	{
		// copy properties to object
		RunnerApply($this, $params);
		// init params
		$this->initLookupParams();	
		// call parent constructor
		parent::ListPage_Embed($params);
		$this->isUseAjaxSuggest = false;	
	}
	
	function initLookupParams()
	{
		$this->parId = postvalue("parId");
		$this->firstTime = postvalue("firsttime");
		$this->mainField = postvalue("field");
		$this->lookupControl = postvalue("control");
		$this->lookupCategory = postvalue("category");
		$this->mainTable = postvalue("table");
		
		global $tables_data;
		include_once getabspath('include/'.GetTableURL($this->mainTable).'_settings.php');
		
		
		$this->lookupParams = "mode=lookup&id=".$this->id."&parId=".$this->parId."&field=".rawurlencode($this->mainField)
			."&control=".rawurlencode($this->lookupControl)."&category=".rawurlencode($this->lookupCategory)
			."&table=".rawurlencode($this->mainTable)."&editMode=".postvalue('editMode');
			
		$this->sessionPrefix = $this->tName."_lookup_".$this->mainTable.'_'.$this->mainField;	
	
		
		$this->linkField = GetLWLinkField($this->mainField, $this->mainTable, false);
		$this->dispField = GetLWDisplayField($this->mainField, $this->mainTable, false);
		if (GetFieldData($this->mainTable, $this->mainField, 'CustomDisplay', false))
		{
			$this->customField = $this->linkField;
			$this->dispFieldAlias = 'dispField1';
		}
		$this->outputFieldValue($this->linkField, 2);			
		$this->outputFieldValue($this->dispField, 2);
		
		if (UseCategory($this->mainField, $this->mainTable))
		{
			$this->categoryField = GetFieldData($this->mainTable, $this->mainField, 'CategoryFilter', '');
		}
		$this->strLookupWhere = LookupWhere($this->mainField,$this->mainTable);		
		
		
		if ($this->dispFieldAlias && AppearOnListPage($this->dispField))
		{
			$this->lookupSelectField=$this->linkField;	
		}
		elseif(AppearOnListPage($this->dispField))
		{
			$this->lookupSelectField=$this->dispField;
		}
		else 
		{
			$this->lookupSelectField = $this->listFields[0]['fName'];			
		}
		
			
		if($this->categoryField)
		{
			if(!strlen(GetFullFieldName($this->categoryField)))
				$this->categoryField="";
		}
		
		if(!$this->categoryField)
			$this->lookupCategory="";
	}
// clear lookup session data, while loading at first time
	function clearLookupSessionData()
	{
		if($this->firstTime)
		{
			$sessLookUpUnset = array();
			foreach($_SESSION as $key=>$value)
				if(strpos($key, "_lookup_")!== false)
					$sessLookUpUnset[] = $key;
					
			foreach($sessLookUpUnset as $key)
				unset($_SESSION[$key]);			
		}
	}
	
	/**
	 * Add common html code for simple mode on list page
	 */	
	function addCommonHtml() 
	{
		//add parent common html code
		parent::addCommonHtml();
		
		if($this->permis[$this->tName]['search'])
			$this->body["begin"].= $this->getSeachFormHTML();
	}
	
	function addCommonJs()
	{
		parent::addCommonJs();
		
		$fieldAsDisplay = $this->dispField;
		if ($this->customField)
		{
			$fieldAsDisplay = $this->lookupSelectField;
		}
		if($this->isUseInlineAdd)
			$this->addJSCode('inlineEditing'.$this->id.'.addListener("add_saved",function(id, shortTName, values, fields)
			{
				var linkFieldInd = -1, dispFieldInd = -1;
				for(var i=0;i<fields.length;i++){
					if (fields[i] == this.linkField){
						linkFieldInd = i;					
					}
					if (this.dispFieldAlias && fields[i] == this.dispFieldAlias){
						dispFieldInd = i;					
					}
					if (this.dispField && fields[i] == this.dispField){
						dispFieldInd = i;					
					}				
				}
				
				var ctrl = Runner.controls.ControlManager.getAt("'.$this->mainTable.'", '.$this->parId.', "'.$this->mainField.'");
				
				var newInd = ctrl.addLookupVal(values[linkFieldInd], values[dispFieldInd]);
				var links = $(\'a[@type="lookupSelect'.$this->id.'"]\');
				var link = $(links[0]);
				
				
				ctrl.initLink(link, newInd, '.$this->id.');
			});');
		
			
		$this->addJSCode('
			var ctrl = Runner.controls.ControlManager.getAt("'.$this->mainTable.'", '.$this->parId.', "'.$this->mainField.'");
			ctrl.initLinks('.$this->id.');
			ctrl.lookupSelectField = "'.jsreplace($this->lookupSelectField).'";
			ctrl.dispFieldAlias = "'.jsreplace($this->dispFieldAlias).'";
			ctrl.linkField = "'.jsreplace($this->linkField).'";
			ctrl.dispField = "'.jsreplace($this->dispField).'";
		');
		
		if($this->isUseInlineAdd)
			$this->addJSCode("
				window.inlineEditing".$this->id.".lookupSelectField = '".jsreplace($this->lookupSelectField)."';
				window.inlineEditing".$this->id.".dispField = '".jsreplace($this->dispField)."';
				window.inlineEditing".$this->id.".linkField = '".jsreplace($this->linkField)."';
				window.inlineEditing".$this->id.".dispFieldAlias = '".jsreplace($this->dispFieldAlias)."';");
		
		if(strlen($this->lookupCategory))
		{
			if($this->isUseInlineAdd)
				$this->addJSCode('
					window.inlineEditing'.$this->id.'.lookupfield = \''.jsreplace($this->mainField).'\';'.
					'window.inlineEditing'.$this->id.'.lookuptable = \''.jsreplace($this->mainTable).'\';'.
					'window.inlineEditing'.$this->id.'.categoryvalue = \''.jsreplace($this->lookupCategory).'\';');
		}	
	}
	
	function addJSPagination()
	{
		$this->addJSCode("window.GotoPage".$this->id." = function(nPageNumber){".$this->getLocation($this->shortTableName."_list.php?".$this->lookupParams."&goto='+nPageNumber+'",false)."};");
	}
		
	function getFormInputsHTML()
	{
		return '<input type="Hidden" name="mode" value="lookup">
				<input type="Hidden" name="parId" value="'.$this->parId.'">
				<input type="Hidden" name="field" value="'.htmlspecialchars($this->mainField).'">
				<input type="Hidden" name="control" value="'.htmlspecialchars($this->lookupControl).'">
				<input type="Hidden" name="category" value="'.htmlspecialchars($this->lookupCategory).'">
				'.(postvalue('editMode') !== '' ? '<input type="Hidden" name="editMode" value="'.postvalue('editMode').'">' : '').'
				<input type="Hidden" name="table" value="'.htmlspecialchars($this->mainTable).'">';
	}

	/**
	 * Set order links attribute for order on list page
	 *
	 * @param {string} $field - name field, which is ordering
	 * @param {string} $sort - how is filed ordering, "a" - asc or "d" - desc, default is "a"
	 */
	function setLinksAttr($field,$sort="")
	{
		$href=$this->shortTableName."_list.php?orderby=".($sort!="" ?($sort=="a" ? "d" : "a"): "a").$field."&".$this->lookupParams;
		$orderlinkattrs="onclick=\"".$this->getLocation($href)."\" href=\"".$href."\"";
		return $orderlinkattrs;
	}
	
	function addSpanVal($fName, &$data) 
	{		
		if ($this->dispFieldAlias && @$this->arrFieldSpanVal[$fName] == 2)
		{
			return "val=\"".htmlspecialchars($data[$this->dispFieldAlias])."\" ";
		}
		else
		{
			return parent::addSpanVal($fName, $data);
		}				
	}
	
	function buildLookupWhereClause()
	{
		if(strlen($this->lookupCategory))
		{
			$this->strWhereClause = whereAdd($this->strWhereClause,GetFullFieldName($this->categoryField)."=".make_db_value($this->categoryField,$this->lookupCategory));
		}
		if(strlen($this->strLookupWhere))
		{
			$this->strWhereClause = whereAdd($this->strWhereClause,$this->strLookupWhere);
		}
		// add 1=0 if parent control contain empty value and no search used	
		if(UseCategory($this->mainField, $this->mainTable) && postvalue('editMode') != MODE_SEARCH && !strlen($this->lookupCategory)/* && !$this->searchClauseObj->isUsedSrch()*/)
		{
			$this->strWhereClause = whereAdd($this->strWhereClause, "1=0");
		}
	}
	
	function buildSQL()
	{
		$this->buildLookupWhereClause();
		if ($this->dispFieldAlias)
		{
			$this->gsqlHead.=", ".$this->dispField." ";
			$this->gsqlHead .= "as ".AddFieldWrappers($this->dispFieldAlias)." ";
		}
		parent::buildSQL();		
	}
	
	function buildSearchPanel() 
	{
		$params = array();
		$params['pageObj'] = &$this;
		$params['globSearchFields'] = $this->globSearchFields;
		$params['panelSearchFields'] = $this->panelSearchFields;
		$this->searchPanel = new SearchPanelLookup($params);
		$this->searchPanel->buildSearchPanel();
		
	}
	
	/**
      * Display blocks after loaded template of page
      *
      */
	function displayAfterLoadTempl() 
	{
		
		$lookupSearchControls = $this->xt->fetch_loaded('searchform_text').$this->xt->fetch_loaded('searchform_search').$this->xt->fetch_loaded('searchform_showall');
		$this->xt->assign("lookupSearchControls", $lookupSearchControls);
		parent::displayAfterLoadTempl();
		$this->xt->display_loaded("body");
	}
		
	/**
	 * If use list icons instead list of links
	 * Then count width for td, which contains icons
	 */
	function countWidthListIcons($row)
	{
		return;
	}	
	
	function addLookupValsJS()
	{
		$this->addJSCode("
			var cntrl = Runner.controls.ControlManager.getAt('".$this->mainTable."', ".$this->parId.", '".$this->mainField."');
			cntrl.lookupVals = JSON.parse('".jsreplace(my_json_encode($this->lookupValuesArr))."');
		");
	}
		
	function prepareForBuildPage()
	{	
		//Sorting fields
		$this->buildOrderParams();
		
		// delete record
		$this->deleteRecords();
		
		// build search panel
		$this->buildSearchPanel();
		
		// build sql query
		$this->buildSQL();
		
		// build pagination block
		$this->buildPagination();
		
		// seek page must be executed after build pagination
		$this->seekPageInRecSet($this->querySQL);
		
		$this->setGoogleMapsParams($this->listFields);
		
		// fill grid data
		$this->fillGridData();
		
		$this->addLookupValsJS();
		
		// add common js code
		$this->addCommonJs();
		
		// add common html code
		$this->addCommonHtml();
		
		// Set common assign
		$this->commonAssign();
		
	}
	
		// stroit checkbox, esli eto vozmogno
	function fillCheckAttr(&$record,$data,$keyblock)
	{
		$checkbox_attrs="name=\"selection[]\" value=\"".htmlspecialchars(@$data[$this->linkField])."\" id=\"check".$this->recId."\"";
		$record["checkbox"]=array("begin"=>"<input type='checkbox' ".$checkbox_attrs.">", "data"=>array());
	}
	
	function callJSCodeAfterRecordEdited()
	{
		if($this->lookupSelectField && $this->isUseInlineAdd)
			$this->addJSCode("inlineEditing".$this->id.".callAfterRecordEdited([".implode(",",$this->recIds)."]);");
	}
	/**
	 * Name of function came from listpage class, but on listpage_lookup it used for collection link and display field data
	 * Spans not needed any more, and in future they will disappear on list page 
	 *
	 * @param link $record
	 * @param link $data
	 */
	function addSpansForGridCells(&$record, &$data) 
	{
		if ($this->dispFieldAlias)
		{
			$dispVal = $data[$this->dispFieldAlias];
		}
		else 
		{
			$dispVal = $data[$this->dispField];
		}
		$this->lookupValuesArr[] = array('linkVal' => $data[$this->linkField], 'dispVal' => $dispVal);
	}
	
	function proccessRecordValue(&$data, &$keylink, $listFieldInfo)
	{		
		if(NeedEncode($listFieldInfo['fName'], $this->tName)&& $this->customField == $listFieldInfo['fName'])
		{					
			$value = ProcessLargeText(GetData($data, $this->linkField, $listFieldInfo['viewFormat']), "field=".rawurlencode($listFieldInfo['fName']).$keylink, "", MODE_LIST);				
		}
		else 
		{		
			$value = parent::proccessRecordValue($data, $keylink, $listFieldInfo);
		}
		if ($this->lookupSelectField == $listFieldInfo['fName'])
		{
			$value = '<a href="#" type="lookupSelect'.$this->id.'">'.$value."</a>";
		}	
		return $value;

		
	}
	
}
?>
