// auto resize iframe
function resizeIframe() {
	var f = document.getElementById('hwFrame');
	f.style.height = f.contentWindow.document.body.scrollHeight + "px";
};

//session
function jsSession(url){
	document.location.href = url;
};

var iframe;

function callEditForm(id) {
	iframe.contentWindow.edit_form(id);
}

function gup( name ) {
	name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
	var regexS = "[\\?&]"+name+"=([^&#]*)";
	var regex = new RegExp( regexS );
	var results = regex.exec( window.location.href );
	if( results != null ) {
		iframe = document.getElementById('hwFrame');
		if(iframe != null) {
            iframe.onload = function() {
            	setTimeout('callEditForm('+ results[1] +')',500);
            }
        }
	}
}

$(document).ready(function(){
	// check editable function 
	gup('id');
});