<?php

class ListPage_Embed extends ListPage
{
	/**
	 * Which type of master page was called detail table
	 *
	 * @var string
	 */
	var $masterPageType = "";
	/**
	 * View PDF on view page or not
	 *
	 * @var integer
	 */
	var $viewPDF = 0;
	/**
	 * Constructor, set initial params
	 *
	 * @param array $params
	 */
	function ListPage_Embed(&$params)
	{
		// copy properties to object
		//RunnerApply($this, $params);
		// call parent constructor
		parent::ListPage($params);
	}
	/**
	 * Add common html code for curent mode
	 *
	 */
	function addCommonHtml()
	{
		parent::addCommonHtml();
		$this->xt->assign("footer","");
		if($this->firstTime)
		{	
			if(!$this->viewPDF)
				$this->getStopLoading();
			elseif($this->masterPageType!=PAGE_VIEW)
				$this->getStopLoading();
		}
	}
	
	/**
	 * Add common javascript code
	 *
	 */
	function addCommonJs() 
	{
		parent::addCommonJs();
		
		if ($this->isUseInlineAdd && $this->permis[$this->tName]['add'] && ! $this->numRowsFromSQLFromSQL) 			
			$this->addJSCode ( "$('[@name=maintable]',$('#fly" . $this->id . "')).hide();" );		
	}
	
	/**
	 * Add common assign for simple mode on list page
	 */	
	function commonAssign() 
	{
		parent::commonAssign();	
		if ($this->isDispGrid())
			$this->xt->assign_section ("grid_block", '', '');
	}	
	
	/**
	 * Get search form target html for lookup or dp-inline
	 *
	 * @return string
	 */
	function getFormTargetHTML()
	{
		return  'target="flyframe'.$this->id.'"';
	}	
		
	/**
      * Show page method
      *
      */
	function showPage()
	{
		$this->BeforeShowList();
		$jscode = $this->PrepareJs();		
		if($this->firstTime)
		{
			if($this->masterPageType!=PAGE_EDIT && $this->masterPageType!=PAGE_ADD && $this->masterPageType!=PAGE_VIEW)
			{
				echo "<jscode>";
				echo str_replace(array("\\","\r","\n"),array("\\\\","\\r","\\n"),$jscode);
				echo "</jscode>";
			}	
		}
		else
		{		
			echo "<textarea id=data>decli";
			echo htmlspecialchars($jscode);
			echo "</textarea>";
		}
		if(!$this->firstTime)
			echo "<textarea id=\"html\">";	
		
		if($this->firstTime && ($this->masterPageType==PAGE_EDIT || $this->masterPageType==PAGE_ADD || $this->masterPageType==PAGE_VIEW))
		{
			echo'<br><div id="dpShowHide'.$this->id.'" class="dpDiv" onClick = "dpInline'.$this->id.'.hideShowDetailPreview(this);">
						<img id="dpMinus'.$this->id.'" class="dpImg" border="0" src="include/img/minus.gif" valign="middle" alt="*" />
						<a name="dt'.$this->id.'" class="dt">'.$this->strCaption.'</a>
					</div>
				<div id="detailPreview'.$this->id.'" class="dpStyle">';
			if(!$this->viewPDF)
				echo'<script>runLoading('.$this->id.',$("#detailPreview'.$this->id.'"),'.$this->mode.')</script>'.$this->addLoadedContentDiv();
			elseif($this->masterPageType!=PAGE_VIEW)
				echo'<script>runLoading('.$this->id.',$("#detailPreview'.$this->id.'"),'.$this->mode.')</script>'.$this->addLoadedContentDiv();
		}		
		$this->xt->load_template($this->templatefile);
		$this->displayAfterLoadTempl();		
		
		if($this->firstTime && ($this->masterPageType==PAGE_EDIT || $this->masterPageType==PAGE_ADD || $this->masterPageType==PAGE_VIEW))
			echo'<s'.'cript>'.$jscode.'</script></div></div>';
		
		if(!$this->firstTime)
			echo "</textarea>";
	}
	/**
      * Display blocks after loaded template of page
      *
      */
	function displayAfterLoadTempl() 
	{
		$this->xt->display_loaded("style_block");
		$this->xt->display_loaded("iestyle_block");
	}
	
	function addWhereWithMasterTable() 
	{
		if($this->masterPageType==PAGE_ADD)
			return "1=0";
		return ListPage::addWhereWithMasterTable();
	}
	
}
?>
