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

function htmlzoom(thephoto, idphoto) {
    html = '';
    html = html + '<div class="zoomeer-box">';
    html = html + '    <div class="zoomeer-box-container">';
    html = html + '        <a href="" class="zoomeer-close"><img src="' + _SITE_URL + 'themes/' + _THEME + '/imgs/zoom-close.png"></a>';
    html = html + '        <div class="zoomeer-box-preview"><span class="inside-prev">';
    html = html + '            <div  class="zoomeer-next zoomeer-slider">';
    html = html + '                <img src="' + _SITE_URL + 'themes/' + _THEME + '/imgs/zoom-next.png">';
    html = html + '            </div>';
    html = html + '            <div  class="zoomeer-prev zoomeer-slider">';
    html = html + '                <img src="' + _SITE_URL + 'themes/' + _THEME + '/imgs/zoom-prev.png">';
    html = html + '            </div>';
    html = html + '            <img id="zoomeer-photo-preview" alt="" src="' + thephoto + '">';
    html = html + '        </span></div>';
    html = html + '        <div class="zoomeer-box-data">';
    html = html + '            <div class="slimscrollers zoomeer-scrollers" data-slimscroll-height="100%">';
    html = html + '                <div class="zoomeer-info" data-id="' + idphoto + '">';
    html = html + '                    <div class="zoomeer-infomedia hide">';
    html = html + '                    </div>';
    html = html + '                    <div class="zoomeer-loader">';
    html = html + '                        <span><img src="' + _SITE_URL + 'themes/' + _THEME + '/imgs/preload.gif"></span>';
    html = html + '                    </div>';
    html = html + '                </div>';
    html = html + '            </div>';
    html = html + '        </div>';
    html = html + '        <div class="clear"></div>';
    html = html + '    </div>';
    html = html + '</div>';
    return html;
}

/**********************/

function getInfoPost_Ok(response) {
    $('.zoomeer-loader').hide();
    $('.zoomeer-infomedia').html(response.infomedia);
    if (!response.prev) {
        $('.zoomeer-prev').hide();
    } else {
        $('.zoomeer-prev').attr('data-id', response.idprev);
        $('.zoomeer-prev').attr('data-image', response.imgprev);
        $('.zoomeer-prev').attr('data-place', response.place);
        $('.zoomeer-prev').show();
    }
    if (!response.next) {
        $('.zoomeer-next').hide();
    } else {
        $('.zoomeer-next').attr('data-id', response.idnext);
        $('.zoomeer-next').attr('data-image', response.imgnext);
        $('.zoomeer-next').attr('data-place', response.place);
        $('.zoomeer-next').show();
    }
    $('.zoomeer-infomedia').show();
    activeSlimScrollers();
}

function getInfoPost_Error(response) {
}

function getInfoPost(code_media, theplace) {

    var data = {
        cm: code_media,
        ipl: theplace,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'infomedia',
            action: 'get',
            data: data
    }

    invoke(params, getInfoPost_Ok, getInfoPost_Error);

}

/**********************/


$(document).on('click', '.zoomeer', function(e) {
    e.preventDefault();
    $('.zoomeer-infomedia').hide();
    hideScrollBody();
    var code = $(this).attr('data-id');
    var photo = $(this).attr('data-image');
    var place = $(this).attr('data-place');
    $('.zoomeer-loader').show();
    $('#the-modal').show();
    $('#the-modal').addClass('modal-for-zoomeer');
    $('#the-modal-content').html(htmlzoom(photo, code));
    getInfoPost(code, place);
});

$(document).on('click', '.zoomeer-slider', function(e) {
    $('#zoomeer-photo-preview').hide();
    var code = $(this).attr('data-id');
    var photo = $(this).attr('data-image');
    var place = $(this).attr('data-place');
    var zoomeer = $(this).parents('.zoomeer');
    $('.zoomeer-infomedia').hide();
    $('.zoomeer-loader').show();
    $('.zoomeer-next').hide();
    $('.zoomeer-prev').hide();
    $('.zoomeer-info-a').html('');
    $('.zoomeer-info-b').html('');
    $('#zoomeer-photo-preview').attr('src', photo);
    $('#zoomeer-photo-preview').show();
    getInfoPost(code, place);
});


$(document).on('click', '.zoomeer-close', function(e) {
    e.preventDefault();
    _closeModal();
});    

$(document).on('click', '.zoomeer-box', function(e) {
    if ($(e.target).is(".zoomeer-box")) {
        _closeModal();
    }
});

$(document).on('keydown', function(e) {
    if(e.keyCode === 27 && $('.zoomeer-box').length > 0) {
        _closeModal();
    }
});


/*******************************************************************/
/*******************************************************************/

function htmlzoom_basic(thephoto, idphoto) {
    html = '';
    html = html + '<div class="zoomeer-box-basic">';
    html = html + '    <div class="zoomeer-box-container">';
    html = html + '        <a href="" class="zoomeer-close"><img src="' + _SITE_URL + 'themes/' + _THEME + '/imgs/zoom-close.png"></a>';
    html = html + '        <div class="zoomeer-box-preview"><span class="inside-prev">';
    html = html + '        <div class="zoomeer-box-preview">';
    html = html + '            <img alt="" src="' + thephoto + '">';
    html = html + '        </div>';
    html = html + '        </span></div>';
    html = html + '        <div class="clear"></div>';
    html = html + '    </div>';
    html = html + '</div>';
    return html;
}

$(document).on('click', '.zoomeer-basic', function(e) {
    e.preventDefault();
    hideScrollBody();
    var photo = $(this).attr('data-image');
    $('#the-modal').show();
    $('#the-modal').addClass('modal-for-zoomeer');
    $('#the-modal-content').html(htmlzoom_basic(photo));
});

$(document).on('click', '.zoomeer-box-basic', function(e) {
    if ($(e.target).is(".zoomeer-box-basic")) {
        _closeModal();
    }
});

$(document).on('keydown', function(e) {
    if(e.keyCode === 27 && $('.zoomeer-box-basic').length > 0) {
        _closeModal();
    }
});