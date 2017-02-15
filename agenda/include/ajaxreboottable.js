
function ajaxRebootTable(params)
{this.prm=params;this.isShowErrorHappend=true;this.DisplayTable=function(html,js)
{var id=this.prm.pageId;if(this.prm.mode!='list_ajax')
{if(this.isShowErrorHappend)
this.showErrorHappend("Undefined type of mode");return;}
var gBlock_old=getParentTableObj(id);if(!gBlock_old)
{if(this.isShowErrorHappend)
this.showErrorHappend("Couldn't find old gridBlock");return;}
var idGBlock=$(gBlock_old).attr('id');if(!idGBlock)
{if(this.isShowErrorHappend)
this.showErrorHappend("Couldn't get id of old gridBlock");return;}
var pOf_old=$("#pageOf"+id)[0];var detFound_old=$("#detFound"+id)[0];var pBlock_old=$("#pagination_block"+id)[0];var notFound_old=$('span[@name=notfound_message'+id+']')[0];var showAll_old=$('#showall'+id)[0];var loadedContent=$('#loaded_content'+id)[0];if(loadedContent)
{$(loadedContent).empty();$(loadedContent).html(html);var gBlock_new=$(loadedContent).find('div[@id='+idGBlock+']')[0];var notFound_new=$(loadedContent).find('span[@name=notfound_message'+id+']')[0];if(gBlock_new&&notFound_new)
{html=this.getHtmlNewGridBlock(gBlock_new);notFound_new=this.getCloneNotFoundSpan(id,notFound_new);}
else if(gBlock_new)
{html=this.getHtmlNewGridBlock(gBlock_new);this.hideEditSelectedButton(id,'change');}
else if(notFound_new)
{html='';notFound_new=this.getCloneNotFoundSpan(id,notFound_new);}
else{if(this.isShowErrorHappend)
this.showErrorHappend("Couldn't find new gridBlock and new notFound message");return;}
if(!html&&!notFound_new)
{if(this.isShowErrorHappend)
this.showErrorHappend("Couldn't find new notFound message and empty ajax response");return;}
var pBlock_new=$(loadedContent).find('div[@id=pagination_block'+id+']')[0];if(pBlock_new)
{if(pBlock_old)
var pBlock_html=$(pBlock_new).html();else
var pBlock=$(pBlock_new).clone();}
var pOf_new=$(loadedContent).find('span[@id=pageOf'+id+']')[0];if(pOf_new)
{if(pOf_old)
var pOf_html=$(pOf_new).html();}
var detFound_new=$(loadedContent).find('span[@id=detFound'+id+']')[0];if(detFound_new)
{if(detFound_old)
var detFound_html=$(detFound_new).html();}
$(loadedContent).empty();}
$(gBlock_old).empty();if(html)
$(gBlock_old).html(html);if(!notFound_old&&notFound_new)
$(gBlock_old).parent().parent().append(notFound_new);else if(notFound_old&&notFound_new&&$(notFound_old).css('display')=='none')
$(notFound_old).css('display','inline');else if(notFound_old&&!notFound_new&&$(notFound_old).css('display')!='none')
$(notFound_old).css('display','none');var usedSrch=window['searchController'+id].usedSrch;var showAll='<span id="showall'+id+'" class="buttonborder"><input type="button" class="button" value="'+window.TEXT_SHOW_ALL+'" onClick="runLoading('+id+',getParentTableObj('+id+'),4); searchController'+id+'.showAllSubmit();"></span>'
if(!showAll_old&&usedSrch)
$('#searchPanelHeader'+id).append(showAll);else if(showAll_old&&!usedSrch)
{$(showAll_old).remove();$('#searchOptions'+id).hide();$('#srchCritTop'+id).hide();$('#controlsBlock_'+id).find('div.srchPanelRow').each(function()
{if($(this).css('display')!='none')
{var img=$(this).find('div.srchPanelCell img[id@^=delCtrlButt_]');$(img).click();}});$('#bottomSearchButt'+id).hide();$('#showOptPanel'+id).click();showHideSelectedButtons(id,'show');}
if(pBlock_old)
{$(pBlock_old).empty();$(pBlock_old).html(pBlock_html);}
else
$(gBlock_old).parent().parent().append(pBlock);if(pOf_old)
{$(pOf_old).empty();$(pOf_old).html(pOf_html);}
if(detFound_old)
{$(detFound_old).empty();$(detFound_old).html(detFound_html);}
this.createNewSearchForm(id);if(js.length)
eval(js);}
this.createNewSearchForm=function(id)
{var frmSearch=$('#frmSearch'+id)[0];if(frmSearch)
{var form=$('<form id="frmSearch'+id+'" method="GET" action="'+frmSearch.action+'" name="frmSearch'+id+'"  target="flyframe'+id+'"></form>');$('<input type="hidden" name="mode" value="ajax">').appendTo(form);$(frmSearch).remove();$(form).prependTo('body');window['searchController'+id].srchForm=form;}}
this.getHtmlNewGridBlock=function(gBlock)
{var html='';if($(gBlock).tagName()=='div')
html=$(gBlock).html();else if($(gBlock).tagName()=='table')
html=$(gBlock).parent.html();return html;}
this.getCloneNotFoundSpan=function(id,notFound)
{showHideSelectedButtons(id,'hide');this.hideEditSelectedButton(id,'hide');return $(notFound).clone();}
this.hideEditSelectedButton=function(id,type)
{if(!id)
return;if(!$('#recordcontrols_block'+id).length)
return;var editSelected=$("[@name=edit_selected"+id+"]").parent();if(!$(editSelected).length)
return;var saveAllSpan=$("[@name = saveall_edited"+id+"]").parent();var revertAllSpan=$("[@name = revertall_edited"+id+"]").parent();if(type=='hide')
{if($(editSelected).css("display")!="none")
$(editSelected).css("display","none");else if($(saveAllSpan).css("display")!="none"||$(revertAllSpan).css("display")!="none")
{$(saveAllSpan).css("display","none");$(revertAllSpan).css("display","none");}}
else if(type=='change')
{if($(saveAllSpan).css("display")!="none"||$(revertAllSpan).css("display")!="none")
{$(saveAllSpan).css("display","none");$(revertAllSpan).css("display","none");$(editSelected).css("display","inline");}
else if($(editSelected).css("display")=="none")
$(editSelected).css("display","inline");}
else
return;}
this.processAjaxReturn=function(doc)
{if($("#data",doc).length)
txt=$("#data",doc).text();else
txt="error"+doc.body.innerHTML;if(txt.substr(0,5)=='decli')
{txt=txt.substr(5);$("#data",doc).remove();this.DisplayTable($("#html",doc).text(),txt);}
else
{txt=txt.substr(5);this.DisplayTable(txt,"");}}
this.createAjaxIframe=function()
{var frameId='flyframe'+this.prm.pageId;var reBoot=this;if($('#'+frameId).length)
{delete $('#'+frameId).loadCount;return;}
if(window.ActiveXObject)
{var onload="if(typeof this.loadCount == 'undefined') \n"+"{ \n"+"  this.loadCount = 0; \n"+" return; \n"+"} \n"+"var ioDocument = window.frames['"+frameId+"'].document; \n"+"reBootTable"+this.prm.pageId+".processAjaxReturn(ioDocument);";var iframetxt="<iframe style = \"position:absolute;\""+"onload=\""+onload+"\""+"id = \""+frameId+"\""+"name = \""+frameId+"\""+"frameborder = \"0\" vspace = \"0\" hspace = \"0\" marginwidth = \"0\" marginheight = \"0\" scrolling = \"no\"/>";var io=document.createElement(iframetxt);}
else{var io=document.createElement('iframe');io.id=frameId;io.name=frameId;$(io).load(function()
{if(typeof this.loadCount=='undefined')
{this.loadCount=0;return;}
var ioDocument=$("#"+frameId).get(0).contentDocument;reBoot.processAjaxReturn(ioDocument);});}
io.style.position='absolute';io.style.top='-10000px';io.style.left='-10000px';document.body.appendChild(io);return io;}
this.showErrorHappend=function(txt)
{txt='<b>Error happend</b>: '+txt;var mes=this.getMessageDiv();if(!mes)
return false;$(mes).empty();$(mes).addClass('mes_not');$(mes).html(txt);window.scrollTo(0,0);$(mes).show();setTimeout('$("#usermessage'+this.prm.pageId+'").fadeOut(1000); ',2000);setTimeout('$("#usermessage'+this.prm.pageId+'").empty(); ',3100);}
this.getMessageDiv=function()
{var mes=$("#usermessage"+this.prm.pageId);if(!$(mes).length)
{var table=getTableObj(id);if(!table)
return false;$(table).parent().prepend('<div class="message mes_not" id="usermessage'+this.prm.pageId+'"></div>');return $("#usermessage"+this.prm.pageId);}
else
return mes;}}