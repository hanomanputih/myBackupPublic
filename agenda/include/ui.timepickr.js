
(function($){var getTimeRanges=function(options)
{var list=[];var hours=[];var minutes=[];var seconds=[];var convention=[];if(options.hours)
{var range=(options.convention==24)&&options.range24h||options.range12h;for(var nCnt=0;nCnt<range.length;nCnt++)
{var o=new Object;o.text=range[nCnt];o.hovered=options.hovered[0]==nCnt?true:false;hours.push(o);}
list.push(hours);}
if(options.minutes)
{for(var nCnt=0;nCnt<options.rangeMin.length;nCnt++)
{var o=new Object;o.text=options.rangeMin[nCnt];o.hovered=options.hovered[1]==nCnt?true:false;minutes.push(o);}
list.push(minutes);}
if(options.seconds)
{for(var nCnt=0;nCnt<options.rangeSec.length;nCnt++)
{var o=new Object;o.text=options.rangeSec[nCnt];o.hovered=options.hovered[2]==nCnt?true:false;seconds.push(o);}
list.push(seconds);}
if(options.convention==12&&options.apm)
{var o=new Object;o.text=options.apm[0];o.hovered=options.hovered[1]<12?true:false;convention.push(o);var o=new Object;o.text=options.apm[1];o.hovered=options.hovered[1]>=12?true:false;convention.push(o);list.push(convention)}
return list;};var parseTime=function(timeString,rangeMin){if(!timeString){return false;}
var timeAndAmPmArr=timeString.split(' ');var timeArr=timeAndAmPmArr[0].split(':');if(!timeAndAmPmArr[0]||timeArr.length==0){return false;}
var parsedTimeObj=new Object;parsedTimeObj.numTimeArr=new Object;for(var i=0;i<timeArr.length;i++){var liNum=parseInt(timeArr[i]);if(i==1){var minStep=60/rangeMin.length;if(minStep!=1){liNum=liNum/minStep;liNum=Math.round(liNum);}}else if(i==2){switch(liNum){case 0:liNum=0;break;case 15:liNum=1;break;case 30:liNum=2;break;case 45:liNum=3;break;default:liNum=Math.round(liNum/15);break;}}
parsedTimeObj.numTimeArr[i.toString()]=liNum;}
if(timeAndAmPmArr[1]){parsedTimeObj.numTimeArr[0]--;var len=timeArr.length;if(timeAndAmPmArr[1]=='am'){parsedTimeObj.numTimeArr[len.toString()]=0;}else if(timeAndAmPmArr[1]=='pm'){parsedTimeObj.numTimeArr[len.toString()]=1;}}
return parsedTimeObj;}
var createButton=function(i)
{$span=$('<span />').text(i.text);$li=$('<li />');if(i.hovered)
{$span.addClass('hover');$li.addClass('hover');}
$li.append($span);return $li;}
var createRow=function(obj)
{var row=$('<ol />')
for(var x in obj)
row.append(createButton(obj[x]));return row;}
var buildMenu=function(i,root)
{var menu=$('<span class="ui-dropslide" type="timePick"/>');for(var x in i)
menu.append(createRow(i[x]));return menu;};$.widget('ui.timepickr',{init:function()
{var opt=this.options;var ranges=getTimeRanges(this.options);var menu=buildMenu(ranges);var element=this.element;var rangeMin=this.options.rangeMin;menu.insertAfter(this.element);element.addClass('ui-timepickr').dropslide(this.options.dropslide).bind('select',this.options.select);if(this.options.val){element.val(this.options.val)}
if(this.options.handle)
{$(this.options.handle).bind('click',[element,rangeMin],function(){var ctrl=Runner.controls.ControlManager.getAt(opt.tName,opt.rowId,opt.fName);var val=ctrl.getValue();var timeArr=parseTime(val,rangeMin);$("span[@type='timePick']").dropslide('hide');$(element).dropslide('show',true,timeArr);});}}});$.ui.timepickr.defaults={val:false,handle:false,hours:true,minutes:true,seconds:false,range24h:$.range(0,24),range12h:$.range(1,13),rangeMin:['00','15','30','45'],rangeSec:['00','15','30','45'],apm:['am','pm'],convention:12,hovered:[10,20,30],select:function(e,dropslide)
{$(this).val(dropslide.getSelection().join(':'));e.stopPropagation();},dropslide:{trigger:'focus'}};})(jQuery);