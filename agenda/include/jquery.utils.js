
(function($){$.extend($.expr[':'],{icontains:function(a,i,m){return(a.textContent||a.innerText||jQuery(a).text()||"").toLowerCase().indexOf(m[3].toLowerCase())>=0;}});$.extend({basename:function(s){var t=s.split('/');return t[t.length]==''&&s||t.slice(0,t.length).join('/');},filename:function(s){return s.split('/').pop();},isRegExp:function(o){return o&&o.constructor.toString().indexOf('RegExp()')!=-1||false;},isArray:function(o){return o&&o.constructor.toString().indexOf('Array()')!=-1||false;},toCurrency:function(o){o=parseFloat(o,10).toFixed(2);return(o=='NaN')?'0.00':o;},range:function(){if(!arguments.length){return[];}
var min,max,step;if(arguments.length==1){min=0;max=arguments[0]-1;step=1;}
else{min=arguments[0];max=arguments[1]-1;step=arguments[2]||1;}
if(step<0&&min>=max){step*=-1;var tmp=min;min=max;max=tmp;min+=((max-min)%step);}
var a=[];for(var i=min;i<=max;i+=step){a.push(i);}
return a;}});$.extend($.fn,{selectRange:function(start,end){if($(this).get(0).createTextRange){var range=$(this).get(0).createTextRange();range.collapse(true);range.moveEnd('character',end);range.moveStart('character',start);range.select();}
else if($(this).get(0).setSelectionRange){$(this).bind('focus',function(e){e.preventDefault();}).get(0).setSelectionRange(start,end);}
return $(this);}});})(jQuery);