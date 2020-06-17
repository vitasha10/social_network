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

/*************************************/

var paramsArray = new Array();

/*************************************/

function hideScrollBody() {
    $thebody = $(window.document.body);
    bodyWidth = $thebody.innerWidth();
    $thebody.css('overflow', 'hidden'); 
    $thebody.css('marginRight', ($thebody.css('marginRight') ? '+=' : '') + ($thebody.innerWidth() - bodyWidth)) 
}

function showScrollBody() {
    $thebody = $(window.document.body);
    bodyWidth = $thebody.innerWidth();
    $thebody.css('marginRight', '-=' + (bodyWidth - $thebody.innerWidth()))
    $thebody.css('overflow', 'auto');  
}

/*************************************/

function activeSlimScrollers() {
    $('.slimscrollers').each(function(){
        if ($(this).parent('.slimScrollDiv').length > 0) return;
        $(this).slimScroll({
            height: function(){
                var value_default = '100%';
                var height = $(this).attr('data-slimscroll-height');
                if (height === undefined) return value_default;
                return height;
            },
            distance: '2px'
        })
    });
}

/*************************************/

function nothign(){ }

function _closeModal() {
    $('#the-modal-content').html('');
    $('#the-modal').removeClass('modal-for-zoomeer');
    $('#the-modal').hide();
    showScrollBody();
}

function _alert(theContent) {
    hideScrollBody();
    $('#the-modal-content').html(theContent);
    $('#the-modal').show();
    $('#space_close, #bclose_alert').click(function(){
        _closeModal();
    });
}

function _confirm(theContent, callCancel, callConfirm, thevalue) {
    hideScrollBody();
    $('#the-modal-content').html(theContent);
    $('#the-modal').show();
    $('#space_close, #b_cancel').click(function(){
        _closeModal();
        callCancel();
    });

    $('#b_ok').click(function(){
        _closeModal();
        callConfirm(thevalue);
    });

}

function _confirmWithInput(theContent, callCancel, callConfirm, thevalue, theinput) {
    hideScrollBody();
    $('#the-modal-content').html(theContent);
    $('#the-modal').show();
    $('#space_close, #b_cancel').click(function(){
        _closeModal();
        callCancel();
    });

    $('#b_ok').click(function(){
        valuereturn = $.trim($(theinput).val());
        if (valuereturn == '') return false;
        _closeModal();
        callConfirm(thevalue, valuereturn);
    });

}

$(document).on('click', '#the-modal', function(e) {
    if ($(e.target).is("#the-modal")) {
        _closeModal()
    }
});

/**********************/
$('html').on('click', '.slimScrollBar', function (e) {
    e.stopPropagation();
});

$(document).on('click', '.slimScrollBar', function (e) {
    e.stopPropagation();
});
/*********************/

function destroy_slimScrol(element) {
    if($(element).parent().hasClass('slimScrollDiv')) {
        $(element).parent().replaceWith($(element));
        $(element).removeAttr('style');
    }
}

/*************************************/

function closeEmerged() {
    /****************************/
	clearInterval(delayCard);
	clearInterval(delayCard2);
    $('#item-card').html('');
    /****************************/
    
    $('._emerged').hide();
    
    if (_IN_DASHBOARD || _IN_ADMIN_PANEL || _IN_SETTING_PANEL) {
        if (isVisibleMenuMore) closeMenuMore();
        if (isVisibleNotif) closeNotifGlobal();
        if (isVisibleNotifPeople) closeNotifPeople();
        if (isVisibleNotifMessage) closeNotifMessage();
        if (isVisibleMenuResponsive) closeMenuResponsive();
        
        if ($('#inputsf').val() != '') {
            $('#inputsf').val('');
            loadFriendsOnline();
        }
        
        if ($('#inputsf2').val() != '') {
            $('#inputsf2').val('');
            loadFriendsOnline();
        }

        if ($('#input-search-top').val() != '') {
            $('#input-search-top').val('');
        }
        
    }
    
    //return false;
}

/*************************************/

function validateDate(a) {
 strExpReg = /^(((0[1-9]|[12][0-9]|3[01])([/])(0[13578]|10|12)([/])(\d{4}))|(([0][1-9]|[12][0-9]|30)([/])(0[469]|11)([/])(\d{4}))|((0[1-9]|1[0-9]|2[0-8])([/])(02)([/])(\d{4}))|((29)(\.|-|\/)(02)([/])([02468][048]00))|((29)([/])(02)([/])([13579][26]00))|((29)([/])(02)([/])([0-9][0-9][0][48]))|((29)([/])(02)([/])([0-9][0-9][2468][048]))|((29)([/])(02)([/])([0-9][0-9][13579][26])))$/;
 return strExpReg.test(a);
}

/*************************************/

function validateEmail(e) {
	var b=/^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/;
	return b.test(e);
}

/*************************************/

function validateUsername(username) {
	pattern = /^[A-Za-z0-9][A-Za-z0-9_]{5,14}$/;
	if (username.match(pattern)) return true;
	return false;
}

/*************************************/

function validateURLStatic(url) {
	pattern = /^[A-Za-z0-9][A-Za-z0-9_]{3,20}$/;
	if (url.match(pattern)) return true;
	return false;
}

/*************************************/

function validateUrl(url)
{
    return url.match(/^(http|https|ftp):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(:(\d+))?\/?/i)
}

/*************************************/

function validateUsernamePageOrGroup(username) {
	if (username == '') return false;
	if (username.lenght < 6 && username.lenght > 20) return false;
	
	pattern = /^[A-Za-z0-9][A-Za-z0-9_]{5,19}$/; //Allow only letters, digits and the underscore (except in the first position). With a minimum of 6 characters (1+5), and a maximum of 20 (1+19).
	if (username.match(pattern)) return true;
	return false;
}

/*************************************/

function stripslashes(str) {
  return (str + '')
    .replace(/\\(.?)/g, function(s, n1) {
      switch (n1) {
        case '\\':
          return '\\';
        case '0':
          return '\u0000';
        case '':
          return '';
        default:
          return n1;
      }
    });
}

/*************************************/

function replaceString(cadsearch, cadreplace, num, str) {
    newcad = str;
    for (x=0; x<num; x++) {
        newcad = str.replace(cadsearch, cadreplace);
        str = newcad;
    }
    return newcad;
}

/*************************************/

function is_empty(value) {
    if (value.match(/\S/) == null) return true;
    else return false;
}

/*************************************/

function opendiv(thediv,message) {
	$(thediv).html(message);
	$(thediv).slideDown("slow");
}

var divactive='';
function openandclose(thediv,message,thetime) {
	$(thediv).html(message);
	$(thediv).slideDown("slow", function(){
		divactive=thediv;
		delayactive=setTimeout(closediv,thetime);
	});	
}

function closediv() {
	$(divactive).slideUp("slow", function(){
		clearTimeout(delayactive);
	});
}

/*************************************/

function invoke(params, fSuccess, fError) {
    if (params.withFile) { 
        $.ajax({
            type: params.type ? params.type : 'POST',
            url: _SITE_URL + 'services/' + params.module + '/' + params.action,
            data: params.data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                fSuccess(response.data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                var response = new Array(jqXHR, textStatus, errorThrown);
                fError(response);
            }
        });
    } else {
        $.ajax({
            type: params.type ? params.type : 'POST',
            url: _SITE_URL + 'services/' + params.module + '/' + params.action,
            data: params.data,
            success: function(response) {
                fSuccess(response.data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                var response = new Array(jqXHR, textStatus, errorThrown);
                fError(response);
            }
        });
    }
}

/*************************************/
/*************************************/
/*************************************/

var delayCard, delayCard2;
function keepCardVisible() {
	clearInterval(delayCard2);
}

function ignoreItemCard() {
	
	clearInterval(delayCard);
	
	delayCard2 = setInterval(function() {
        $('#item-card').html('');
		$('#item-card').hide();
		clearInterval(delayCard2);	
	},700);
	
}

function itemCard_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            $('#item-card').html(response.message);
            break;

        case 'OK':
            if (response.withcover) {
                unewtop = response.utopCard + 'px';
                $('#item-card').css('top',unewtop);
                $('#item-card').html(response.html);
            } else {
                unewtop = response.utopCardnoCover + 'px';
                $('#item-card').css('top',unewtop);
                $('#item-card').html(response.html);
            }
            break;            
   }
}

function itemCard_Error(response) {
}

function itemCard(posi, divitem, ucode, typeItem) {

	clearInterval(delayCard2);
	delayCard = setInterval(function() {    

		margintop = 10;
		
		heightAvat1 = 42;
		heightName1 = 17;
		heightAvat2 = 35;
		heightName2 = 14;
		
		topDiv = $('#' + divitem).offset().top;
		leftDiv = $('#' + divitem).offset().left;

		heightCard = 180;
		heightCardnoCover = 125;
	
		u = topDiv > ($(document).scrollTop() + $(window).height() / 2) ? 's' : 'n';
		
		if (u == 'n') {
	
			utopini = margintop + topDiv  + 10;

			if (posi == 0) { utopini = utopini + heightAvat1; }
			if (posi == 1) { utopini = utopini + heightName1; }
			if (posi == 2) { utopini = utopini + heightAvat2; }
			if (posi == 3) { utopini = utopini + heightName2; }
			
			utopCard = utopini;
			utopCardnoCover = utopini;
			
		} else {
			
			utopini = margintop + topDiv - 35;
			
			utopCard = utopini - heightCard;
			utopCardnoCover = utopini - heightCardnoCover;
			
		}
		
		if (posi == 0 || posi == 2) { leftDiv = leftDiv - 10; }
		if (posi == 1 || posi == 3) { leftDiv = leftDiv + 50; }
	
		$('#item-card').show();
		$('#item-card').html('<div class="cpreload"><img src="' + _SITE_URL + '/themes/' + _THEME + '/imgs/preload.gif"></div>');
	
		var pos = {
			top: utopini + 'px',
			left: leftDiv + 'px'
		};
		
		$('#item-card').css(pos);

        var data = {
            cod: ucode,
            typ: typeItem,
            unt: utopCard,
            untnc: utopCardnoCover,
            waw: _WIDTH_AREA_WORK,
        };
    
        var params = {
                type: 'POST',
                withFile: false,
                module: 'itemcard',
                action: 'load',
                data: data
        };
    
        invoke(params, itemCard_Ok, itemCard_Error);
    
		clearInterval(delayCard);

	}, 700);

}

/*************************************/

function actionSearchForTop_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            $('#inside-info-search').html(response.result_search);
            $('#link-more-search-top').attr('href', _SITE_URL + 'search/q:' + response.the_query);
            break;            
   }
}

function actionSearchForTop_Error(response) {
}

function actionSearchForTop(query) {

    var data = {
        q: query,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionssearch',
            action: 'searchtop',
            data: data
    };

    invoke(params, actionSearchForTop_Ok, actionSearchForTop_Error);

}

function searchForTop() {
	var query = $('#input-search-top').val();
        
	if (query == '') {
		var time_show_result = 0;
	} else {
		$('#area-results-search').show();
		var time_show_result = 250;
    }
    
	setTimeout(function() {

        if($.trim(query) == '') {
            $("#area-results-search").hide();
            $("#inside-info-search").html('');
        } else {
            actionSearchForTop(query);
        }

	}, time_show_result);
    
}

/*************************************/

function handleFiles(files, divpreview, nummax) {
    themax = nummax;
    if (nummax > files.length) themax = files.length;
    
    if ($('#' + divpreview + ' img').length < nummax) {
    
        for (var i = 0; i < themax; i++) {
            var file = files[i];
            
            if (!file.type.startsWith('image/')){ continue }
            
            var img = document.createElement("img");
            img.classList.add("obj");
            img.file = file;
            var preview = document.getElementById(divpreview);
            preview.appendChild(img); // Assuming that "preview" is the div output where the content will be displayed.
            
            var reader = new FileReader();
            reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
            reader.readAsDataURL(file);
        }
        
        return true;

    } else return false;

}

/*************************************/

function validationInput(action, idinput, diverror, msgerror, bsubmit, withfocus) {
	$(bsubmit).attr('disabled','true');
	valinput = $.trim($(idinput).val());
    result = false;
	switch (action) {
		case 'empty':
			if (valinput != '') result = true;
			break;

		case 'negative':
			if (valinput < 0) result = true;
			break;

		case 'positive':
			if (valinput > 0) result = true;
			break;

		case 'zero':
			if (valinput == 0) result = true;
			break;

		case 'zeroandpositive':
			if (valinput >= 0) result = true;
			break;

		case 'number':
			if (!isNaN(valinput)) result = true;
			break;
            
		case 'numberpositive':
			if (!isNaN(valinput)) 
                if (valinput > 0) result = true;
			break;

		case 'email':
			if (validateEmail(valinput)) result = true;
			break;
			
		case 'username':
			if (validateUsername(valinput)) result = true;
			break;

		case 'url_static':
			if (validateURLStatic(valinput)) result = true;
			break;
            
		case 'pageorgroup':
			if (validateUsernamePageOrGroup(valinput)) result = true;
			break;
			
		case 'password':
			if (valinput != '' && valinput.length >= 6 && valinput.length <= 20) result = true;
			break;
            
		case 'url':
			if (validateUrl(valinput)) result = true;
			break;
						
	}

    if (result == false) {
        $(idinput).val(valinput);
        openandclose(diverror,msgerror,1700);	
        if (withfocus) $(idinput).focus();
        setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500); 
        return false;
    } else return valinput;
    
}

/**********************************************************/

function moreActivities_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            theactivities = response.activities;
            more = parseInt(response.more);

            $('#list-activities').append(theactivities);

            if (more == 1) {
                ap = parseInt($('#activity_page').val());
                $('#activity_page').val(ap + 1);
                reloading_done = 0;
            } else {
                $('#linkmore').hide();
                reloading_done = 1;
            }

			$('video.js_video-js').each(function(){ videojs($(this)[0], {}, function() {}); });
			$('audio.mep_audio').mediaelementplayer();
            activeSlimScrollers();
			$('.action_autosize').each(function(){
				autosize(this);
			});

            break;            
   }
   $('#loader_showmore').hide();
   $('#bmore').show();
}

function moreActivities_Error(response) {
}

function moreActivities() {
    
    $('#bmore').hide();
    $('#loader_showmore').show();

    var data = {
        ap: $('#activity_page').val(),
        plc: theplace,
        cp: code_profile,
        typ: type_items,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'moreactivities',
            action: 'more',
            data: data
    };

    invoke(params, moreActivities_Ok, moreActivities_Error);

}

/**********************************************************/

$('html').click(function() {
    closeEmerged();
});

$(function() {
    _WIDTH_AREA_WORK = $('.spacetop').width();
    $(window).resize(function() {
        _WIDTH_AREA_WORK = $('.spacetop').width();
    });
});

window.onbeforeunload = function() {
  window.scrollTo(0, 0);
}
