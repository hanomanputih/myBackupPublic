
function detailsPreviewInline(params)
{this.prm=params;this.isShowErrorHappend=true;this.getRowId=function(rPrm)
{var tr=this.getCurrentTr(rPrm);if(!tr)
return;if($(tr).attr("rowid"))
return $(tr).attr("rowid");else
return $(tr).attr("id").substring(7);}
this.getCurrentTr=function(rPrm)
{var trParents=$(rPrm.linkId).parents("tr");if(!trParents.length)
{if(this.isShowErrorHappend)
this.showErrorHappend(rPrm,"Couldn't get parent elements TR for clicked link preview");return;}
for(var i=0;i<trParents.length;i++)
if($(trParents[i]).attr("rowid")||$(trParents[i]).attr("id"))
break;if(i==trParents.length)
{if(this.isShowErrorHappend)
this.showErrorHappend(rPrm,"Couldn't find parent element TR for clicked link preview");return;}
return trParents[i];}
this.createPreviewTr=function(rPrm)
{var rowId=this.getRowId(rPrm);var dpInline=this;if(!rowId)
return false;if(!$("#dpreviewrow_"+this.prm.mSTable+"_"+rowId)[0])
{var colsCount=new Array();var start=0,myplace=0;;var tr=this.getCurrentTr(rPrm);if(!tr)
return false;var trChildren=$(tr).children("td");var tdParents=$(rPrm.linkId).parents("td");if(!tdParents.length)
{if(this.isShowErrorHappend)
this.showErrorHappend(rPrm,"Couldn't get parent elements TD for clicked link preview");return false;}
var tdParent=tdParents[0];for(i=0;i<trChildren.length;i++)
{if(tdParent==trChildren[i])
myplace=colsCount.length;if($(trChildren[i]).attr("colid")=="endrecord")
{colsCount[colsCount.length]=i-start;start=i+1;}}
colsCount[colsCount.length]=i-start;var previewTr=$(tr).clone();$(previewTr).attr("id","dpreviewrow_"+this.prm.mSTable+"_"+rowId);$(previewTr).insertAfter(tr);previewTr=$("#dpreviewrow_"+this.prm.mSTable+"_"+rowId)[0];$("td[@colid!=endrecord]",previewTr).remove();trChildren=$(previewTr).children("td");var recId=parseInt(rPrm.recId);for(i=0;i<trChildren.length;i++)
$(trChildren[i]).before("<td id=\"dpreview_"+this.prm.mSTable+"_"+(recId+i-myplace)+"\" colspan="+colsCount[i]+"></td>");if(i)
$(trChildren[i-1]).after("<td id=\"dpreview_"+this.prm.mSTable+"_"+(recId+i-myplace)+"\" colspan="+colsCount[i]+"></td>");else
$(previewTr).html("<td id=\"dpreview_"+this.prm.mSTable+"_"+(recId+i-myplace)+"\" colspan="+colsCount[i]+"></td>");}
else{$("a[id$=_preview"+rPrm.recId+"]").each(function()
{if(this!=$(rPrm.linkId)[0])
{var pos=this.id.lastIndexOf("_preview");if(pos<0)
return false;var dTable=this.id.substring(0,pos);this.onclick=function()
{dpInline.showDPInline(dTable,rPrm.recId,this);return false;};}});}
return true;}
this.showDPInline=function(dTable,recId,link)
{var linkId="#"+link.id;var dCaption=$(link).attr('caption');var id=++flyid;var rPrm={'id':id,'recId':recId,'link':link,'linkId':linkId,'dTable':dTable,'dCaption':dCaption};if(!this.createPreviewTr(rPrm))
return;var tdPreview=$("#dpreview_"+this.prm.mSTable+"_"+recId)[0];var mData=this.getMasterData(link);if(!mData)
{if(this.isShowErrorHappend)
this.showErrorHappend(rPrm,"Couldn't get master's data");return false;}
var url=dTable+"_list.php"+mData.query;tdPreview.style.borderWidth="1px";tdPreview.style.borderStyle="solid";tdPreview.style.borderColor="darkgray";$(tdPreview).css('text-align','left');$(tdPreview).parent().attr('class','');$(tdPreview).empty();runLoading(id,tdPreview,1);this.setLinkForHide(rPrm,rPrm.linkId);$(tdPreview).ajaxError(function(event,request,settings)
{$(this).html("<span class='error'>Error requesting page "+settings.url+"</span>");});var dpInline=this;$.get(url,{counter:0,id:id,masterid:dpInline.prm.pageId,mode:"listdetails",firsttime:1,rndVal:(new Date().getTime())},function(xml)
{var pos=xml.indexOf("<jscode>");var pos1=xml.indexOf("</jscode>");var js="";if(pos>=0&&pos1>=0)
{js=slashdecode(xml.substr(pos+8,pos1-pos-8));txt=xml.substr(pos1+9);}
dpInline.DisplayPreview(txt,js,rPrm);});}
this.DisplayPreview=function(html,js,rPrm)
{var hide="";if(this.prm.mode=='list_details_edit_add'||rPrm.mode=='list_details_edit_add')
{var dPreview=$("#detailPreview"+this.prm.pageId)[0];if(!dPreview)
return;}
else if(this.prm.mode=='list_details')
{var dPreview=$("#dpreview_"+this.prm.mSTable+"_"+rPrm.recId)[0];if(dPreview)
{hide=this.getHtmlForHide(rPrm);var io=this.createPreviewIframe(rPrm);var form=this.createPreviewForm(rPrm);}
else{if(this.isShowErrorHappend)
this.showErrorHappend(rPrm,"Couldn't find element TD for preview content");return;}}
else{if($("#dpreview_"+this.prm.mSTable+"_"+rPrm.recId).length)
this.prepareForHide(rPrm);if(this.isShowErrorHappend)
this.showErrorHappend(rPrm,"Undefined type of mode for showing preview");return;}
var id=(rPrm&&rPrm.id?rPrm.id:this.prm.pageId);var loadedContent=$('#loaded_content'+id);if($(loadedContent).length)
dPreview=loadedContent;$(dPreview).empty();$(dPreview).html(html);var table=getTableObj(id);if($.browser.msie&&table)
$(table).parent().css('background-color',$(table).css('background-color'));if(hide){$(dPreview).prepend(hide);this.setLinkForHide(rPrm,"#dpClose"+rPrm.id);}
if(js.length)
eval(js);}
this.processPreviewReturn=function(doc,rPrm)
{if($("#data",doc).length)
txt=$("#data",doc).text();else
txt="error"+doc.body.innerHTML;if(this.prm.mode=='add_master')
eval(txt);else{if(txt.substr(0,5)=='decli')
{txt=txt.substr(5);$("#data",doc).remove();this.DisplayPreview($("#html",doc).text(),txt,rPrm);}
else
{txt=txt.substr(5);this.DisplayPreview(txt,"",rPrm);}}}
this.getHtmlForHide=function(rPrm)
{return'<div align="left" style="float:left;"><img id="dpClose'+rPrm.id+'" src="images/search/closeRed.gif" valign="middle" style="cursor:pointer;margin-right:10px;">'+'<a href="'+$(rPrm.linkId).attr('href')+'">'+window.TEXT_PROCEED_TO+' '+rPrm.dCaption+'</a></div>';}
this.setLinkForHide=function(rPrm,linkId)
{var dpInline=this;$(linkId)[0].onclick=function()
{dpInline.hideDPInline(rPrm);return false;};}
this.hideShowDetailPreview=function(elem)
{var dpInline=this;var dPreview=$("#detailPreview"+this.prm.pageId)[0];if(!dPreview)
{if(this.isShowErrorHappend)
this.showErrorHappend('',"Couldn't find element detailPreview"+this.prm.pageId+" for show or hide detail Preview");return;}
if(!elem)
{if(this.isShowErrorHappend)
this.showErrorHappend('',"Undefined element dpShowHide"+this.prm.pageId+" for show or hide detail preview");return;}
var img=$(elem).find('img.dpImg:first')[0];if(!img)
{if(this.isShowErrorHappend)
this.showErrorHappend('',"Undefined image dpImg for show or hide detail preview");return;}
if(img.id=='dpMinus'+this.prm.pageId)
{img.id="dpPlus"+this.prm.pageId;img.src="include/img/plus.gif";$(dPreview).hide();}
else{img.id="dpMinus"+this.prm.pageId;img.src="include/img/minus.gif";$(dPreview).show();}}
this.hideDPInline=function(rPrm)
{var tdPreview=$("#dpreview_"+this.prm.mSTable+"_"+rPrm.recId);if(!tdPreview)
{if(this.isShowErrorHappend)
this.showErrorHappend(rPrm,"Couldn't get preview content");return;}
$(tdPreview).html();$(tdPreview).css('border','none');var trParents=$(tdPreview).parents("tr");if(!trParents.length)
{if(this.isShowErrorHappend)
this.showErrorHappend(rPrm,"Couldn't get parent elements TR for clicked link hide");return;}
var previewTr=trParents[0];var trChildren=$(previewTr).children("td");for(var i=0;i<trChildren.length;i++)
{if($(trChildren[i]).attr("colid")&&$(trChildren[i]).attr("colid")!="endrecord"&&trChildren[i].innerHTML.length)
break;}
if(i<trChildren.length)
{if(this.isShowErrorHappend)
this.showErrorHappend(rPrm,"Couldn't find all child elements TD hide TR element");return;}
var dpInline=this;$(rPrm.linkId)[0].onclick=function()
{dpInline.showDPInline(rPrm.dTable,rPrm.recId,this);return false;};$(previewTr).remove();var frameId=this.getIdForIframe(rPrm);removeFlyFrame=$("#"+frameId)[0];removeForm=$("#frmAdmin"+rPrm.id)[0];setTimeout('$(removeFlyFrame).remove(); $(removeForm).remove();',100);}
this.getIdForIframe=function(rPrm)
{if(this.prm.mode=='add_master'||this.prm.mode=='list_details_edit_add'||(rPrm&&rPrm.mode=='list_details_edit_add'))
id=this.prm.pageId;else if(rPrm)
id=rPrm.id;return'flyframe'+id;}
this.createPreviewIframe=function(rPrm)
{var frameId=this.getIdForIframe(rPrm);var dpInline=this;if($('#'+frameId).length)
{delete $('#'+frameId).loadCount;return;}
if(window.ActiveXObject)
{var strPrm="";if(rPrm)
{strPrm="{";for(var el in rPrm)
strPrm+="'"+el+"':"+(el!='recId'&&el!='id'?"'"+rPrm[el]+"'":rPrm[el])+",";var pos=strPrm.lastIndexOf(",");strPrm=strPrm.substring(0,pos)+"}";}
var onload="if(typeof this.loadCount == 'undefined') \n"+"{ \n"+"  this.loadCount = 0; \n"+" return; \n"+"} \n"+"var ioDocument = window.frames['"+frameId+"'].document; \n"+"dpInline"+this.prm.pageId+".processPreviewReturn(ioDocument,"+(!strPrm?"''":strPrm)+");";var iframetxt="<iframe src=\"javascript:false;\" style = \"position:absolute;\""+"onload=\""+onload+"\""+"id = \""+frameId+"\""+"name = \""+frameId+"\""+"frameborder = \"0\" vspace = \"0\" hspace = \"0\" marginwidth = \"0\" marginheight = \"0\" scrolling = \"no\"/>";var io=document.createElement(iframetxt);}
else{var io=document.createElement('iframe');io.id=frameId;io.name=frameId;$(io).load(function()
{if(typeof this.loadCount=='undefined')
{this.loadCount=0;return;}
var ioDocument=$("#"+frameId).get(0).contentDocument;dpInline.processPreviewReturn(ioDocument,rPrm);});}
io.style.position='absolute';io.style.top='-10000px';io.style.left='-10000px';document.body.appendChild(io);return io;}
this.createPreviewForm=function(rPrm)
{var frameId=this.getIdForIframe(rPrm);var id=(rPrm&&rPrm.id?rPrm.id:this.prm.pageId);var mTable=(rPrm&&rPrm.mTable?rPrm.mTable:this.prm.mTable);var formId='frmAdmin'+id;if($('#'+formId).length)
return;var server_url=rPrm.dTable+'_list.'+this.prm.ext;var form=$('<form method="POST" action="'+server_url+'" name="'+formId+'" id="'+formId+'" ></form>');$('<input type="hidden" id="a'+id+'" name="a" value="delete">').appendTo(form);$('<input type="hidden" name="mode" value="listdetails">').appendTo(form);$('<input type="hidden" name="id" value="'+id+'">').appendTo(form);if(rPrm&&rPrm.id&&this.prm.pageId&&rPrm.id!=this.prm.pageId)
$('<input type="hidden" name="masterid" value="'+this.prm.pageId+'">').appendTo(form);if(rPrm&&rPrm.mPageType)
$('<input type="hidden" name="masterpagetype" value="'+htmlSpecialChars(rPrm.mPageType)+'">').appendTo(form);$('<input type="hidden" name="mastertable" value="'+htmlSpecialChars(mTable)+'">').appendTo(form);var mKeys=new Array();if(rPrm.mKeys)
mKeys=rPrm.mKeys;else{var mData=this.getMasterData($(rPrm.linkId)[0]);mKeys=mData.keys;}
for(var i=0;i<mKeys.length;i++)
$('<input type="hidden" name="masterkey'+(i+1)+'" value="'+htmlSpecialChars(mKeys[i])+'">').appendTo(form);$(form).css('position','absolute');$(form).css('top','-10000px');$(form).css('left','-10000px');$(form).attr('target',frameId);$(form).appendTo('body');return form;}
this.getMasterData=function(link)
{pos=link.href.indexOf("?");if(pos<0)
return false;var masterData={};masterData.query=link.href.substr(pos);arr=masterData.query.split("&");masterData.keys=[];for(var i=1;i<arr.length;i++)
{arr1=arr[i].split("=");masterData.keys[i-1]=unescape(arr1[1]);}
return masterData;}
this.submitPreviewForm=function(id)
{var id=(id?id:this.prm.pageId);if($('input[@type=checkbox][@checked][@id^=check'+id+'_]').length&&confirm('Do you really want to delete these records?'))
{var form=$('#frmAdmin'+id);$('input[@type=checkbox][@id^=check'+id+'_]',form).each(function()
{$(this).remove();});$('input[@type=checkbox][@checked][@id^=check'+id+'_]').each(function()
{var clone=$(this).clone();var id=$(clone).attr('id');$(clone).appendTo(form);$('#'+id,form).attr('checked','checked');});$(form).submit();}
return false;}
this.showErrorHappend=function(rPrm,txt)
{txt='<b>Error</b>: '+txt;var dPreview=$("#dpreview_"+this.prm.mSTable+"_"+rPrm.recId)[0];var detPreview=$("#detailPreview"+this.prm.pageId)[0];if(!dPreview&&!detPreview)
{if(rPrm.link)
this.createError(rPrm.link,rPrm.recId,txt);}
else if(dPreview)
$(dPreview).html('<div class="error">'+txt+'</div>');else if(detPreview)
{var link=$("a[@name=dt"+this.prm.pageId+"]")[0]
if(link)
this.createError(link,this.prm.pageId,txt);}}
this.createError=function(link,id,txt)
{var error=$("#dperror"+id);if(!$(error).length)
{$(document.body).append("<div id=\"dperror"+id+"\" class=\"inline_error error\">"+txt+"</div>");error=$("#dperror"+id);}
else{$(error).empty();$(error).html(txt);}
var coors=findPos(link);coors[0]+=coors[2];coors[1]+=coors[3];$(error).css("top",coors[1]+"px");$(error).css("left",coors[0]+"px");$(error).css("z-index",100);$(error).show();setTimeout('$("#dperror'+id+'").fadeOut(1000); ',2000);setTimeout('$("#dperror'+id+'").remove(); ',3000);}}
function dpInlineOnAddEdit(dpParams)
{this.Opts=dpParams;this.isSbmMaster=false;this.prepareForSaveAllDetail=function()
{var validAll=true;for(var i=0;i<this.Opts.dInlineObjs.length;i++)
{if(!this.checkValidationAll(this.Opts.dInlineObjs[i]))
{validAll=false;this.showDP(this.Opts.dInlineObjs[i].pageid);this.prepareMessage(i);}}
if(validAll)
{this.Opts.mMessage='';$(this.Opts.mForm).attr('target','flyframe'+this.Opts.mId);if(!this.isSbmMaster)
this.isSbmMaster=true;if(this.isAllSubmitRecords())
{$(this.Opts.mForm).get(0).submit();}
else{window.frames['flyframe'+this.Opts.mId].location=this.Opts.mShortTableName+'_add.'+this.Opts.ext+'?editType=addmaster&isSbmSuc=0';}}}
this.saveAllDetail=function()
{if(!this.isSbmMaster)
this.isSbmMaster=true;if(this.Opts.dInlineObjs.length)
{for(var i=0;i<this.Opts.dInlineObjs.length;i++)
this.saveAll(i);}
else
this.submitMasterForm();}
this.saveAll=function(io)
{var obj=this.Opts.dInlineObjs[io];obj.isSbmSuc=true;obj.readySbmMaster=false;this.getEditRows(obj);this.Opts.dMessages='';if(obj.recIds.length)
{for(var i=0;i<obj.recIds.length;i++)
{if(this.Opts.mPageType=="edit")
$(obj.recIds[i][1]).click();else
obj.submitInputContent(obj.recIds[i][0],"","add");}
setTimeout('window.dpObj.onLoadIframes('+io+')',1000);}
else{obj.readySbmMaster=true;if(this.isAllReadySbmMaster())
this.submitMasterForm();}}
this.onLoadIframes=function(io)
{var obj=this.Opts.dInlineObjs[io];for(var i=0;i<obj.recIds.length;i++)
{if(window['uploadFrame'+obj.recIds[i][0]]&&obj.isSbmSuc)
{obj.recIds.splice(i,1);i--;}}
if(obj.recIds.length&&obj.isSbmSuc)
setTimeout('window.dpObj.onLoadIframes('+io+')',1000);if(!obj.isSbmSuc)
this.prepareMessage(io);if(obj.isSbmSuc&&!obj.recIds.length)
{obj.readySbmMaster=true;if(this.isAllReadySbmMaster())
this.submitMasterForm()}}
this.showDP=function(pageid)
{var div=$('#dpShowHide'+pageid)[0];if($('#dpPlus'+pageid)[0])
window['dpInline'+pageid].hideShowDetailPreview(div);}
this.prepareMessage=function(io)
{var obj=this.Opts.dInlineObjs[io];this.createTextMessage(io);if(this.Opts.mPageType=="add"&&this.isSbmMaster)
{var arrCntrl=Runner.controls.ControlManager.getAt(this.Opts.mTableName);for(var i=0;i<arrCntrl.length;i++)
arrCntrl[i].spanContElem.empty().html(this.Opts.mSavedValues[arrCntrl[i].goodFieldName]);}
this.showMessage();this.showDP(obj.pageid);window.scroll(0,0);}
this.createTextMessage=function(io)
{var obj=this.Opts.dInlineObjs[io];var url=document.URL,txt="";var pos=url.indexOf("#dt"+obj.pageid);if(pos==-1)
url=url+"#dt"+obj.pageid;var msg=(new String(TEXT_DETAIL_NOT_SAVED)).replace('%s',this.Opts.dCaptions[io]);txt="<div class='message mes_not'><<< "+msg+" >>> <br><a href='"+url+"' >"+TEXT_DETAIL_GOTO+" "+this.Opts.dCaptions[io]+"</a></div>";this.Opts.dMessages+=txt;}
this.showMessage=function()
{var mes=$("div[@id^=message_block]");var mtb=$("div.main_table_border");var txt="";if(this.Opts.mMessage)
txt=this.Opts.mMessage;if(!this.isAllReadySbmMaster())
txt=txt+this.Opts.dMessages;if($(mes).length)
$(mes).empty().html(txt);else
$(mtb).prepend('<div id="message_block" class="downedit">'+txt+'</div>');this.isSbmMaster=false;}
this.showHideInvalidCaptcha=function(type)
{var captchaSpan=$('#edit1_captcha_0');if($(captchaSpan).length)
{var error=$(captchaSpan).find('div.error');if(type=='hide'&&$(error).length)
$(error).remove();else if($(error).length&&type=='show')
$(error).empty().html(window.TEXT_INVALID_CAPTCHA_CODE);else if(!$(error).length&&type=='show')
$(captchaSpan).append('<div class=\"error\">'+window.TEXT_INVALID_CAPTCHA_CODE+'</div>');}
this.isSbmMaster=false;}
this.hideCaptcha=function()
{var captchaBlock=$('.captcha_block');if($(captchaBlock).length)
$(captchaBlock).remove();}
this.getEditRows=function(obj)
{var inlineObject=obj,btn="";obj.recIds=new Array();if(this.Opts.mPageType=="add")
btn="revert"+obj.pageid;else
btn="save"+obj.pageid;$('#detailPreview'+obj.pageid+' a[@id^='+btn+'_]').each(function()
{var len=inlineObject.recIds.length;var id=$(this).attr('id');var pos=id.indexOf("_");if(pos>0)
inlineObject.recIds[len]=[id.substr(pos+1),this];});}
this.checkValidationAll=function(obj)
{var valResAll=true;this.getEditRows(obj);for(var i=0;i<obj.recIds.length;i++)
{var arrCntrls=Runner.controls.ControlManager.getAt(obj.tName,obj.recIds[i][0]);if(!obj.checkValidation(arrCntrls))
valResAll=false;}
return valResAll;}
this.submitMasterForm=function()
{if(this.Opts.mPageType=="edit")
{$(this.Opts.mForm).submit();this.isSbmMaster=false;}
else if(this.Opts.mPageType=="add")
window.location=this.Opts.mShortTableName+'_add.php';}
this.isAllReadySbmMaster=function()
{var readySbmAll=true;for(var i=0;i<this.Opts.dInlineObjs.length;i++)
{var obj=this.Opts.dInlineObjs[i];if(!obj.readySbmMaster)
readySbmAll=false;}
return readySbmAll;}
this.isAllSubmitRecords=function()
{var sbmAllRec=true;for(var i=0;i<this.Opts.dInlineObjs.length;i++)
{var obj=this.Opts.dInlineObjs[i];if(!obj.isSbmSuc&&obj.recIds.length)
sbmAllRec=false;}
return sbmAllRec;}}