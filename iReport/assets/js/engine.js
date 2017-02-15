var globalSpeedAnimation = 300;

var isNiceScroll = true;
var BASE_URL = $('#BASE_URL').val();
var index_p = '';

var isLogin = $('#login-status').val();

$(document).ready(function(){
	var time = setInterval(function(){
		updateCss();
		if(document.readyState = 'complete')
		{
			$('.preload').animate({'height': '0%'}, 1000, 'easeOutExpo', function(){

			});
			clearInterval(time);
		}
	},500);

	initBrowser();

	initScreenSize();

	initNiceScroll();

	clickControl();

	focusControl();

	liveControl();

	hoverControl();

	keyControl();

	updateCss();

	$(window).resize( $.debounce(200, function(){

		initScreenSize();

		updateCss();

	}) );
});


function clickControl()
{
	// imamsrifkan: action expand list menu
	$('.nav-list > li > a').click(function(){

		$('.nav-list > li').removeClass('active');
		$(this).parent().addClass('active');

		$('.nav-list > li .list-item').slideUp(globalSpeedAnimation);
		$(this).parent().find('.list-item').slideDown(globalSpeedAnimation);
	});

	// imamsrifkan: action popup add presence
	$('.btn-presence').click(function(){

        $('#modal-presence').modal('show');
    });

    // imamsrifkan: action popup confirmation

    // imamsrifkan: action delete all data presence
    // $('#modal-confirmation .modal-body button#true').click(function(){
    // 	id = $(this).parent('.modal-body').attr('id');
    // 	$.ajax({
    // 		url: BASE_URL + index_p + '/presence/'
    // 	});
    // });

    // imamsrifkan: action for reset password
    $('.list-members .reset-password').click(function(){
		var ID = $(this).attr('id');
		if(ID)
		{
			$('#confirm form').attr('action', BASE_URL + index_p + 'members/reset');
			$('#confirm form input#ID').val(ID);
		}
		$("#confirm.modal .modal-body p").html('Are you sure want to reset password?. Password will be reset in default password.');
		$('#confirm').modal('show');
	});

	// imamsrifkan: action delete member
	$('.list-members .delete').click(function(){
		var ID = $(this).attr('id');
		if(ID)
		{
			$('#confirm form').attr('action', BASE_URL + index_p + 'members/delete');
			$('#confirm form input#ID').val(ID);
		}
		$("#confirm.modal .modal-body p").html('Are you sure want to delete this member?');
		$('#confirm').modal('show');
	});

	// imamsrifkan: action delete presence
	$('.list-presence .delete').click(function(){
		var ID = $(this).attr('id');
		if(ID)
		{
			$('#confirm form').attr('action', BASE_URL + index_p + 'presence/delete');
			$('#confirm form input#ID').val(ID);
		}
		$('#confirm').modal('show');
	});

	// imamsrifkan: action delete all presences
    $('.list-presence .btn-confirm').click(function(){
    	var ID = $(this).attr('id');
    	if(ID)
    	{
    		$('#modal-confirmation form').attr('action', BASE_URL + index_p + 'presence/delete_all');
    		$('#modal-confirmation form input#ID').val(ID);
    	}
    	$('#modal-confirmation').modal('show');
    });

	// imamsrifkan: action print web
	$('.print-button').click(function(){
		url = $(this).attr('data-url');
		if(url != '' || url != null)
		{
			if($('.hidden-data').length == 0)
			{
				$('body').append('<div class="hidden-data" style="display: none"></div>');
				$('.hidden-data').html('');
				$('.hidden-data').load(url, function(){
					debug('load complete');
					$('<div/>').html($(this).html()).printElement();
				});
			}
		}
	});

	// imamsrifkan: action export web
	$('.export-button').click(function(){
		url = $(this).attr('data-url');
		if(url != '' || url != null)
		{
			window.location.href = url;
		}
	});

}

function hoverControl()
{
	$('.list-members .reset-password').hover(function(){
		$(this).children().removeClass('fui-radio-unchecked').addClass('fui-radio-checked');
	}, function(){
		$(this).children().removeClass('fui-radio-checked').addClass('fui-radio-unchecked');
	});
}

function liveControl()
{
	$('.nav-list .list-item').hide();

	$('.nav-list').children('li').each(function(){
		if($(this).hasClass('active'))
		{
			$(this).find('.list-item').show();	
		}
		else
		{
			$(this).find('.list-item').hide();	
		}
	});

	$("select.dropdown").selectpicker({menuStyle: 'dropdown'});

	// live: hide progress login
	$('.form-login .alert-message').hide();
	$('.form-login .alert-message .progress').hide();

	// live: show form login
	if(isLogin == 'false' || typeof isLogin == false)
	{
	    $('#modal-login').modal('show');
	}

	// live: activate tagsInput
	$('.tags-input').tagsInput();

}

function focusControl()
{
	$('.form-login input').focus(function(){
		$('#btn-login').slideDown(globalSpeedAnimation);
		$('.form-login .alert-message, .form-login .alert-message .text').slideUp(globalSpeedAnimation);
	});
}

function keyControl()
{
	$('.form-login input').keypress(function(){
		$('#btn-login').slideDown(globalSpeedAnimation);
		$('.form-login .alert-message, .form-login .alert-message .text').slideUp(globalSpeedAnimation);
	});
}

function updateCss()
{

	if(isLogin == 'false' || typeof isLogin == false)
	{
		$('.modal-backdrop').addClass('bg-blur');

		$('body').css({
			'position': 'fixed',
			'width': '100%'
		});
	}

	// css: set position for pop up login
	var modal = $('.modal');
	modal.each(function(){
		var modalHeight = ($(window).height()/2) - ($(this).height()/2);
		var modalWidth = ($(window).width()/2) - ($(this).outerWidth()/2);
			$(this).css({
				'top': modalHeight + "px",
				'left': 'auto',
				'right': modalWidth + "px"
			});
	});

	// css: set min-height for sidebar
	var minH = ($(window).height()*0.55);
	$('.container-fluid .row-fluid .span3.sidebar').css('min-height',minH + "px");

	$("#confirm form, #modal-confirmation form").css('margin-bottom','0');
}

// imamsrifkan : function debug screen
function debug(msg,status)
{
	return false;
	if(status == undefined || status == 'undefined'){
		status = !false;
	}

	if(status){
		var screenDebug = $('#screen-debug');
		if(screenDebug.length == 0){
			$('body').append('<div id="screen-debug"></div>');
			$('#screen-debug').css({
				'position': 'fixed',
				'z-index': '9999',
				'background-color':'#272822',
				'top':'40px',
				'right':'10px',
				'padding':'10px',
				'color':'#fff',
				'opacity':0.5,
				'font-size':'12px',
				'cursor':'pointer'
			});

			$('#screen-debug').hover(function(){
				$(this).stop().animate({opacity:1},300);
			},function(){
				$(this).stop().animate({opacity:0.5},300);
			})

			$('#screen-debug').click(function(){
				$(this).remove();
			})
			$('#screen-debug').html(msg+'<br/>');
		}
	}
	screenDebug.html(screenDebug.html()+msg+'<br/>');
}


// imamsrifkan : detect screen resolution
function initScreenSize()
{
	return false;
	
	var winW = $(window).width();
	var winH = $(window).height();

	var optimRatio = 4/3;
	var currRatio = winW/winH;
	var difRatio = (optimRatio - currRatio).toFixed(3);
	var msg = winW+'x'+winH+' : '+difRatio;
	if(difRatio < 0.1 && difRatio > -0.1){
		msg += ' <- Optimum Ratio';
	}
	$('body').append('<div id="resolution-debug"></div>');
	$('#resolution-debug').css({
		'position':'fixed',
		'z-index':'9999',
		'background-color':'#272822',
		'top':'40px',
		'left':'10px',
		'padding':'10px',
		'opacity':'0.5',
		'font-size':'12px',
		'cursor':'pointer',
		'color':'#fff'
	});
	$('#resolution-debug').hover(function(){
			$(this).stop().animate({opacity:1},300);
		},function(){
			$(this).stop().animate({opacity:0.5},300);
		})
	$('#resolution-debug').click(function(){
		$(this).remove();
	})
	$('#resolution-debug').html(msg);
}

function debugPlugins(msg,status)
{
	return false;
	if(status == undefined || status == 'undefined'){
		status = !false;
	}
	if(status){
		$('body').append('<div id="plugins-debug"></div>');
		$('#plugins-debug').css({
			'position':'fixed',
			'z-index':'9999',
			'background-color':'#272822',
			'bottom':'10px',
			'left':'10px',
			'padding':'10px',
			'opacity':'0.5',
			'font-size':'12px',
			'cursor':'pointer',
			'color':'#fff'
		});
		$('#plugins-debug').hover(function(){
			$(this).stop().animate({opacity:1},300);
		},function(){
			$(this).stop().animate({opacity:0.5},300);
		})
		$('#plugins-debug').click(function(){
			$(this).remove();
		})
		$('#plugins-debug').html(msg+'<br/>');
	}
}

// imamsrifkan : function using niceScroll
function initNiceScroll()
{
	if(isNiceScroll){
		$('body, .modal .modal-body').niceScroll({
			cursorcolor:"#939491",
			cursorwidth: '10',
		})
	}	
	debugPlugins('Nice Scroll : '+isNiceScroll);
}

// imamsrifkan : function detect browser
function initBrowser()
{
	// comment : detect browser

	// chrome
	if(chrome()){
		debug('Browser Chrome');
	}
	// safari
	else if(safari()){
		debug('Browser Safari');
	}
	// firefox
	else if(firefox()){
		debug('Browser Firefox');
	}
}


function chrome()
{
	uagent = navigator.userAgent.toLowerCase();
	if(uagent.search('chrome') > -1){
		return true;
	}else{
		return false;
	}
}

function safari()
{
	uagent = navigator.userAgent.toLowerCase();
	if(uagent.search('safari') > -1){
		return true;
	}else{
		return false;
	}
}

function firefox()
{
	uagent = navigator.userAgent.toLowerCase();
	if(uagent.search('firefox') > -1){
		return true;
	}else
	{
		return false;
	}
}