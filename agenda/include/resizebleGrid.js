
function createTable(div,table,tName,id)
{var num_cell=0,id_cell=0;var fields={fields:[]};var myColumnDefs=new Array();var initCookies=new Array();var notInclTd=new Array();var trClasses=new Array();var listIcons=false;var aligns={th:[],td:[]};$("#"+table+" tr:eq(0)").find('th').each(function()
{if(isClassNameAvailable(this.className))
{fields.fields[id_cell]="column"+id_cell;var content=$(this).html();if(!YAHOO.util.Cookie.get(tName))
{var obj={key:'column'+id_cell,label:content,width:this.offsetWidth,resizeable:true,sortable:false};myColumnDefs[id_cell]=obj;initCookies[initCookies.length]=this.offsetWidth;}
else{var tablecookie=YAHOO.util.Cookie.get(tName);tablecookie=YAHOO.lang.JSON.parse(tablecookie);var obj={key:'column'+id_cell,label:content,width:tablecookie[id_cell],resizeable:true,sortable:false};myColumnDefs[id_cell]=obj;}
aligns.th[id_cell]=this.align;id_cell++;}
else
notInclTd[notInclTd.length]=num_cell;num_cell++;});initCookies=YAHOO.lang.JSON.stringify(initCookies);if(!YAHOO.util.Cookie.get(tName))
YAHOO.util.Cookie.set(tName,initCookies);YAHOO.example.Data={areacodes:[]};$("#"+table+" tr[@rowid]").each(function(i)
{var trClassName=$(this).attr('class');trClasses[i]=trClassName;if(!$('td[@class^=headerlistdown]',this).length)
{var areaCodes={};var lenData=YAHOO.example.Data.areacodes.length;var num_cell=0,id_cell=0;$('td',this).each(function(j)
{if($(this).parent().attr('rowid')!=undefined)
{var st=true;for(var k=0;k<notInclTd.length;k++)
{if(num_cell==notInclTd[k])
st=false;}
if(st)
{var content=$(this).html();areaCodes[myColumnDefs[id_cell].key]=content;if(!i)
{aligns.td[id_cell]=this.align;if(!listIcons)
{var tdClassName=$(this).attr('class');if(tdClassName)
{if(tdClassName.indexOf('listIcons')!=-1)
listIcons=true;}}}
id_cell++;}
num_cell++;}});YAHOO.example.Data.areacodes[lenData]=areaCodes;}});YAHOO.example.MultipleFeatures=function()
{var myDataSource=new YAHOO.util.DataSource(YAHOO.example.Data.areacodes);myDataSource.responseType=YAHOO.util.DataSource.TYPE_JSARRAY;myDataSource.responseSchema=fields;var myConfigs={draggableColumns:false};var myDataTable=new YAHOO.widget.DataTable(div,myColumnDefs,myDataSource,myConfigs);setTHTDAlign(id,aligns,listIcons);setTRClasses(id,trClasses);myDataTable.addListener("columnResizeEvent",function(params)
{var value=new String(params["column"]);var num=parseInt(value.substr(23));var tablecookie=YAHOO.util.Cookie.get(tName);tablecookie=YAHOO.lang.JSON.parse(tablecookie);var updateCookie=new Array();var len=tablecookie.length;for(var i=0;i<len;i++)
{if(i==num)
tablecookie[i]=params["width"];updateCookie[i]=tablecookie[i];}
updateCookie=YAHOO.lang.JSON.stringify(updateCookie);YAHOO.util.Cookie.set(tName,updateCookie);});return{oDS:myDataSource,oDT:myDataTable};}();}
function isClassNameAvailable(name)
{var arrClassNames=new Array(),avail=false;;arrClassNames=name.split(" ");if(arrClassNames.length)
{for(i=0;i<arrClassNames.length;i++)
{if(arrClassNames[i]=="headerlist"||arrClassNames[i]=="blackshade"||arrClassNames[i]=="headerlist_right2"||arrClassNames[i]=="headerlist_right_M")
{avail=true;break;}}
return avail;}
else
return false;}
function setTHTDAlign(id,aligns,listIcons)
{var table=getTableObj(id);if(!table)
return false;$('th',table).each(function(i)
{this.align=aligns.th[i]});$('tr[@id^=yui-rec]',table).each(function()
{$('td[@class^=yui-dt]',this).each(function(i)
{this.align=aligns.td[i];if(!i&&listIcons)
{var newTdClass=$(this).attr('class');newTdClass+=' listIcons';$(this)[0].className=newTdClass;}});});}
function setTRClasses(id,trClasses)
{var table=getTableObj(id);if(!table)
return false;$('.yui-dt-data tr[@id^=yui-rec]',table).each(function(i)
{this.className=trClasses[i];});}
function prepareForCreateTable(param)
{var old_table=getTableObj(param.id);if(!old_table)
return;var id_table=$(old_table).attr('id');$(document.body).attr('class','yui-skin-sam');if(!id_table)
{$(old_table).attr('id','tabledata'+param.id);id_table='tabledata'+param.id;}
createTable($(old_table).parent().attr('id'),id_table,param.tName,param.id);if(param.useInlineAdd&&param.permisAdd)
{var table=getTableObj(param.id);if(!table)
return false;$('.yui-dt-data tr:first',table).hide();if(!param.numRows)
$(table).hide();}}
function inlineAddIfUseResize(id)
{var table=getTableObj(id)
if(!table)
return false;var yuiRec=$('.yui-dt-data tr:first',table);if(!$(yuiRec).length)
return false;else if($(yuiRec).css('display')=='none')
{$(table).show();return{'id':$(yuiRec).attr('id'),'name':"yui-rec-add"};}
else
return false}