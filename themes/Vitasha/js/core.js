/*
********************************************************
* @author Santos Montano B. (Lito Santos M.)
* @author_url 1: http://www.kanorika.com
* @author_url 2: http://codecanyon.net/user/kanorika
* @author_email: info@kanorika.com   
********************************************************
* iSocial - Social Networking Platform
* Copyright (c) 2018 iSocial. All rights reserved.
********************************************************
*/

var _ID_MENU_LEFT;
var _SPACE_FULL, _IN_DASHBOARD, _IN_ADMIN_PANEL, _IN_SETTING_PANEL;
_SPACE_FULL = false;
_IN_DASHBOARD = false;
_IN_ADMIN_PANEL = false;
_IN_SETTING_PANEL = false;
var _WIDTH_AREA_WORK;

var httpR;

function startPreloadBar() {
    $("#preload-bar").show();
    $("#preload-bar").width((50 + Math.random() * 30) + "%");
}

function stopPreloadBar() {
    $("#preload-bar").width("101%").delay(200).fadeOut(400, function() {
        $(this).width("0");
    });
}

function loadPhantom(source, target, lysize) {
    startPreloadBar();
	var pageload = source + '/phantom:yes/lysize:' + lysize;
	$.ajax({
        type:'POST',
		url:pageload,
        beforeSend: function(xdatax){
            if (httpR) httpR.abort();
            httpR = xdatax;
        },
		success: function(response) {
            stopPreloadBar();
			$('#' + target + '').html(response);
            if ( $("#newtitlesite").length > 0 ) document.title = $('#newtitlesite').html();
			$(document).scrollTop(0);
		}
	});
    closeEmerged();
}

/*************************************/

function actionOnClick(sourceURL, target, lysize) {

    _closeModal();
    
    closeEmerged();

    loadPhantom(sourceURL, target, lysize);
    
    if (sourceURL != window.location) window.history.pushState({"target":target,"size":lysize}, '', sourceURL);    

}

/*************************************/

$(function() {

    $(document).on("click", "a[rel='phantom']", function(e) {
        
        e.preventDefault();
        
        actionOnClick($(this).attr('href'), $(this).attr('target'), 'min');

    });
    
    $(document).on("click", "a[rel='phantom-max']", function(e) {
        
        e.preventDefault();
        
        the_target = $(this).attr('target');
        lysize = 'max';
        if (_IN_DASHBOARD) {
            if (_SPACE_FULL) {
                _SPACE_FULL = false;
            } else {
                the_target = 'dashboard-main-area-right';
                lysize = 'min';
            }
        }

        actionOnClick($(this).attr('href'), the_target, lysize);

    });
    
    $(document).on("click", "a[rel='phantom-all']", function(e) {
        
        e.preventDefault();
        
        if (_IN_DASHBOARD) {
            _SPACE_FULL = true;
        }

        actionOnClick($(this).attr('href'), $(this).attr('target'), 'max');

    });

});


$(window).on('popstate', function(ev) {
	var mobileOs = (navigator.userAgent.match(/(iPad|iPhone|iPod|Android)/g) ? true : false );
	if (mobileOs && !window.history.ready && !ev.originalEvent.state) return;
	
	if (!ev.originalEvent.state) return;

	state = JSON.parse(JSON.stringify(ev.originalEvent.state));
	var pageload = location.href;
	sourceURL = pageload.replace(_SITE_URL, '');
	if (pageload == '') pageload = _SITE_URL;

    if (_IN_DASHBOARD || _IN_SETTING_PANEL || _IN_ADMIN_PANEL) {
        _SPACE_FULL = true;
        state.target = 'dashboard-main-area';
        state.size = 'max';
    }
    
	loadPhantom(pageload, state.target, state.size);
});
