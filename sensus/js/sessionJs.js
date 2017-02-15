$(function(){
	if (!$.isFunction(window.top.jsSession)){
		document.location.href = window.location.href + ((window.location.href.substr(-1) === "/") ? '' : '/') + "list.html";
	}
});