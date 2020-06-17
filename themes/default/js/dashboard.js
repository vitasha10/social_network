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

_IN_ADMIN_PANEL = false;
_IN_SETTING_PANEL = false;
_IN_DASHBOARD = true;

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function moreItems_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            theItems = response.items;
            more = parseInt(response.more);

            $('#list-items').append(theItems);
                        
            if (more == 1) {
                ap = parseInt($('#activity_page').val());
                $('#activity_page').val(ap + 1);
                reloading_done = 0;
            } else {
                $('#space_more').hide();
                reloading_done = 1;
            }
            break;            
   }
}

function moreItems_Error(response) {
}

function moreItems() {

    var data = {
        ap: $('#activity_page').val(),
        from: $('#activities_place').val(),
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'moreitems',
            action: 'more',
            data: data
    };

    invoke(params, moreItems_Ok, moreItems_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function createGroup_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            _SPACE_FULL = true;
            actionOnClick(_SITE_URL + response.urlgroup, 'dashboard-main-area', 'max');
            break;            
   }
}

function createGroup_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function createGroup(diverror, bsubmit) {
    
	$(bsubmit).attr('disabled','true');
	
	titlegroup = validationInput('empty', '#titlegroup', diverror, txt_enter_title, bsubmit, true);
	if (!titlegroup) return;
	
	urlgroup = validationInput('empty', '#urlgroup', diverror, txt_enter_url, bsubmit, true);
	if (!urlgroup) return;
    
	urlgroup = validationInput('pageorgroup', '#urlgroup', diverror, txt_url_invalid, bsubmit, true);
	if (!urlgroup) return;
	
	descriptiongroup = validationInput('empty', '#descriptiongroup', diverror, txt_enter_description, bsubmit, true);
	if (!descriptiongroup) return;

    privacygroup = $('#privacygroup').val();

	paramsArray[0] = diverror;
    paramsArray[1] = bsubmit;
    
    var data = {
        gti: titlegroup,
        gur: urlgroup,
        gds: descriptiongroup,
        gpr: privacygroup,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsgroups',
            action: 'create',
            data: data
    }

    invoke(params, createGroup_Ok, createGroup_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function updateGroup_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            _SPACE_FULL = true;
            actionOnClick(_SITE_URL + response.urlgroup, 'dashboard-main-area', 'max');
            break;            
   }
}

function updateGroup_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function updateGroup(diverror, bsubmit) {
    
	$(bsubmit).attr('disabled','true');
	
	titlegroup = validationInput('empty', '#titlegroup', diverror, txt_enter_title, bsubmit, true);
	if (!titlegroup) return;
	
	urlgroup = validationInput('empty', '#urlgroup', diverror, txt_enter_url, bsubmit, true);
	if (!urlgroup) return;
    
	urlgroup = validationInput('pageorgroup', '#urlgroup', diverror, txt_url_invalid, bsubmit, true);
	if (!urlgroup) return;
	
	descriptiongroup = validationInput('empty', '#descriptiongroup', diverror, txt_enter_description, bsubmit, true);
	if (!descriptiongroup) return;

    privacygroup = $('#privacygroup').val();

	paramsArray[0] = diverror;
    paramsArray[1] = bsubmit;
    
    var data = {
        gti: titlegroup,
        gur: urlgroup,
        gds: descriptiongroup,
        gpr: privacygroup,
        cgr: cgr,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsgroups',
            action: 'update',
            data: data
    }

    invoke(params, updateGroup_Ok, updateGroup_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function searchGroup_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            $('#preloadsearch').hide();
            openandclose(paramsArray[2], response.message, 1700)
            setTimeout(function() { $(paramsArray[3]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            $('#preloadsearch').hide();
            $('#space-result-search-groups').html(response.theresult);
            $('#space-result-search-groups').show();
            setTimeout(function() { $(paramsArray[3]).removeAttr('disabled'); }, 2500);
            break;            
   }
}

function searchGroup_Error(response) {
    $('#preloadsearch').hide();
    openandclose(paramsArray[2], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[3]).removeAttr('disabled'); }, 2500);
}

function searchGroup(diverror, bsubmit) {

    $('#space-result-search-groups').html('');
        
	$(bsubmit).attr('disabled','true');
    $('#preloadsearch').show();
    
	termsearch = validationInput('empty', '#termsearch', diverror, txt_error_empty_term, bsubmit, true);
	if (!termsearch) return;
    
    if ($.trim($('#termsearch').val()).length <= 3) {
        openandclose(diverror, txt_error_short_term, 1700);		
        $('#termsearch').focus();
        setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500); 
        return;
    }

	paramsArray[2] = diverror;
    paramsArray[3] = bsubmit;
    
    var data = {
        tse: termsearch,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsgroups',
            action: 'search',
            data: data
    }

    invoke(params, searchGroup_Ok, searchGroup_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function deleteGroup_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            break;

        case 'OK':
            actionOnClick(_SITE_URL + 'groups', 'dashboard-main-area', 'max');
            break;            
   }
}

function deleteGroup_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
}

function deleteGroup(diverror) {

	paramsArray[0] = diverror;
    
    var data = {
        code: codegroup,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsgroups',
            action: 'delete',
            data: data
    }

    invoke(params, deleteGroup_Ok, deleteGroup_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function loadcategorypages_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            $(paramsArray[0]).html(response.categories);
            $(paramsArray[0]).removeAttr('disabled');
            break;            
   }
}

function loadcategorypages_Error(response) {
}

function loadcategorypages(idcat, msgcategory, msgsubcategory, divcategories, divsubcategories) {
	$(divcategories).html('<option value="-1">' + msgcategory + '</option>');
	$(divcategories).attr('disabled','true');
	$(divsubcategories).html('<option value="0">' + msgsubcategory + '</option>');
    
	paramsArray[0] = divcategories;
    
    var data = {
        idc: idcat,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'getcategories',
            action: 'getcatpages',
            data: data
    }

    invoke(params, loadcategorypages_Ok, loadcategorypages_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function loadsubcategorypages_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            $(paramsArray[1]).html(response.subcategories);
            $(paramsArray[1]).removeAttr('disabled');
            break;            
   }
}

function loadsubcategorypages_Error(response) {
}

function loadsubcategorypages(idcat, idsubcat, msgcsubcategory, divsubcategories) {	
	$(divsubcategories).html('<option value="-1">' + msgcsubcategory + '</option>');
	$(divsubcategories).attr('disabled','true');
    
	paramsArray[1] = divsubcategories;
    
    var data = {
        idc: idcat,
        idsc: idsubcat,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'getsubcategories',
            action: 'getsubcatpages',
            data: data
    }

    invoke(params, loadsubcategorypages_Ok, loadsubcategorypages_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function createPage_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[2], response.message, 1700)
            setTimeout(function() { $(paramsArray[3]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            _SPACE_FULL = true;
            actionOnClick(_SITE_URL + response.urlpage, 'dashboard-main-area', 'max');
            break;            
   }
}

function createPage_Error(response) {
    openandclose(paramsArray[2], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[3]).removeAttr('disabled'); }, 2500);
}

function createPage(diverror, bsubmit) {
    
	$(bsubmit).attr('disabled','true');
    
	idcategory = validationInput('positive', '#categorypage', diverror, txt_choose_category, bsubmit, false);
	if (!idcategory) return;

	idsubcategory = validationInput('positive', '#subcategorypage', diverror, txt_choose_subcategory, bsubmit, false);
	if (!idsubcategory) return;

	titlepage = validationInput('empty', '#titlepage', diverror, txt_enter_title, bsubmit, false);
	if (!titlepage) return;
	
	urlpage = validationInput('empty', '#urlpage', diverror, txt_enter_url, bsubmit, false);
	if (!urlpage) return;
    
	urlpage = validationInput('pageorgroup', '#urlpage', diverror, txt_url_invalid, bsubmit, false);
	if (!urlpage) return;
	
	descriptionpage = validationInput('empty', '#descriptionpage', diverror, txt_enter_description, bsubmit, false);
	if (!descriptionpage) return;

	paramsArray[2] = diverror;
    paramsArray[3] = bsubmit;
    
    var data = {
        pic: idcategory,
        pisc: idsubcategory,
        pti: titlepage,
        pur: urlpage,
        pds: descriptionpage,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionspages',
            action: 'create',
            data: data
    }

    invoke(params, createPage_Ok, createPage_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function updatePage_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[2], response.message, 1700)
            setTimeout(function() { $(paramsArray[3]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            _SPACE_FULL = true;
            actionOnClick(_SITE_URL + response.urlpage, 'dashboard-main-area', 'max');
            break;            
   }
}

function updatePage_Error(response) {
    openandclose(paramsArray[2], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[3]).removeAttr('disabled'); }, 2500);
}

function updatePage(diverror, bsubmit) {
    
	$(bsubmit).attr('disabled','true');
    
	idcategory = validationInput('positive', '#categorypage', diverror, txt_choose_category, bsubmit, false);
	if (!idcategory) return;

	idsubcategory = validationInput('positive', '#subcategorypage', diverror, txt_choose_subcategory, bsubmit, false);
	if (!idsubcategory) return;

	titlepage = validationInput('empty', '#titlepage', diverror, txt_enter_title, bsubmit, false);
	if (!titlepage) return;
	
	urlpage = validationInput('empty', '#urlpage', diverror, txt_enter_url, bsubmit, false);
	if (!urlpage) return;
    
	urlpage = validationInput('pageorgroup', '#urlpage', diverror, txt_url_invalid, bsubmit, false);
	if (!urlpage) return;
	
	descriptionpage = validationInput('empty', '#descriptionpage', diverror, txt_enter_description, bsubmit, false);
	if (!descriptionpage) return;

	paramsArray[2] = diverror;
    paramsArray[3] = bsubmit;
    
    var data = {
        pic: idcategory,
        pisc: idsubcategory,
        pti: titlepage,
        pur: urlpage,
        pds: descriptionpage,
        cpg: cpg,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionspages',
            action: 'update',
            data: data
    }

    invoke(params, updatePage_Ok, updatePage_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function deletePage_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            break;

        case 'OK':
            actionOnClick(_SITE_URL + 'pages', 'dashboard-main-area', 'max');
            break;            
   }
}

function deletePage_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
}

function deletePage(diverror) {

	paramsArray[0] = diverror;
    
    var data = {
        code: codepage,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionspages',
            action: 'delete',
            data: data
    }

    invoke(params, deletePage_Ok, deletePage_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/


function searchPage_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            $('#preloadsearch').hide();
            openandclose(paramsArray[2], response.message, 1700)
            setTimeout(function() { $(paramsArray[3]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            $('#preloadsearch').hide();
            $('#space-result-search-page').html(response.theresult);
            $('#space-result-search-page').show();
            setTimeout(function() { $(paramsArray[3]).removeAttr('disabled'); }, 2500);
            break;            
   }
}

function searchPage_Error(response) {
    $('#preloadsearch').hide();
    openandclose(paramsArray[2], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[3]).removeAttr('disabled'); }, 2500);
}

function searchPage(diverror, bsubmit) {

    $('#space-result-search-page').html('');
        
	$(bsubmit).attr('disabled','true');
    $('#preloadsearch').show();
    
	termsearch = validationInput('empty', '#termsearch', diverror, txt_error_empty_term, bsubmit, true);
	if (!termsearch) return;
    
    if ($.trim($('#termsearch').val()).length <= 3) {
        openandclose(diverror, txt_error_short_term, 1700);		
        $('#termsearch').focus();
        setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500); 
        return;
    }

	paramsArray[2] = diverror;
    paramsArray[3] = bsubmit;
    
    var data = {
        tse: termsearch,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionspages',
            action: 'search',
            data: data
    }

    invoke(params, searchPage_Ok, searchPage_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function saveRepositionBG_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            break;            
   }
}

function saveRepositionBG_Error(response) {
}

function saveRepositionBG(posibg) {

    var data = {
        posi: posibg,
        typr: _tp,
        copr: _cp,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionssettingprofile',
            action: 'positionbgcover',
            data: data
    }

    invoke(params, saveRepositionBG_Ok, saveRepositionBG_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function removeCover_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            $('#space-cover-header').html(response.space_cover_header);
            $('#cover-header').removeClass('with_cover');

            $('#move-bg-header').hide();
            $('#remove-bg-header').hide();

            break;            
   }
   $('#actions-cover').show();
}

function removeCover_Error(response) {
    $('#actions-cover').show();
}

function removeCover(n) {

    $('#actions-cover').hide();
    
    var data = {
        typr: _tp,
        copr: _cp,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionssettingprofile',
            action: 'removecover',
            data: data
    }

    invoke(params, removeCover_Ok, removeCover_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function uploadCoverNew_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            $('#preload-actions-cover').hide();
            $('#actions-cover').show();
            
            break;

        case 'OK':
            
            $('#preload-actions-cover').hide();
            $('#cover-header').addClass('with_cover');
            $('#space-cover-header').html(response.space_cover_header);

            $('#move-bg-header').show();
            $('#remove-bg-header').show();

            $('#link-cover').show();
            $('#actions-cover').show();
            
            break;            
   }
}

function uploadCoverNew_Error(response) {
    $('#preload-actions-cover').hide();
    $('#actions-cover').show();
}

function uploadCoverNew() {
    
    $('#actions-cover').hide();

    thefilecover = filecover;
    if (thefilecover == null) {
        _alert(msg_alert_cover_empty);
        $('#actions-cover').show();
        return;
    }

    if (thefilecover != '') {
        var ext = thefilecover.name.split('.').pop().toLowerCase();
        if($.inArray(ext, ['jpg', 'png']) == -1) {
            _alert(msg_alert_cover_format);
            $('#actions-cover').show();
            return;
        }
    }
    
    if (thefilecover.size > sizeCover) {
        _alert(msg_alert_cover_large);
        $('#actions-cover').show();
        return;
    }

    var data_cover = new FormData(document.getElementById("form-cover-new"));
    data_cover.append("the_cover_new", filecover);
    data_cover.append("type_profile", _tp);
    data_cover.append("code_profile", _cp);

    var params = {
            type: 'POST',
            withFile: true,
            module:  'actionssettingprofile',
            action: 'uploadcover',
            data: data_cover
    }
    
    $('#preload-actions-cover').show();

    invoke(params, uploadCoverNew_Ok, uploadCoverNew_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function removeAvatar_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            $('#icon-remove-avatar').show();
            break;

        case 'OK':
            $('#space-avatar-header').html(response.space_avatar);
            $('#opt-user-top .the_avatar img').attr('src', response.icoavatartop);
            break;            
   }

}

function removeAvatar_Error(response) {
    $('#icon-remove-avatar').show();
}

function removeAvatar(n) {

    $('#icon-remove-avatar').hide();
    
    var data = {
        typr: _tp,
        copr: _cp,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionssettingprofile',
            action: 'removeavatar',
            data: data
    }

    invoke(params, removeAvatar_Ok, removeAvatar_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function uploadAvatarNew_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            $('#preload-actions-avatar').hide();
            $('#icon-upload-avatar').show();
            break;

        case 'OK':
            $('#preload-actions-avatar').hide();
            $('#space-avatar-header').html(response.space_avatar);
            $('#opt-user-top .the_avatar img').attr('src', response.icoavatartop);
            $('#icon-remove-avatar').show();
            $('#icon-upload-avatar').show();
            break;            
   }
}

function uploadAvatarNew_Error(response) {
    $('#preload-actions-avatar').hide();
    $('#icon-upload-avatar').show();
}

function uploadAvatarNew() {
    
    $('#preload-actions-avatar').show();
    $('#icon-upload-avatar').hide();

    thefileavatar = fileavatar;
    if (thefileavatar == null) {
        _alert(msg_alert_avatar_empty);
        $('#preload-actions-avatar').hide();
        $('#icon-upload-avatar').show();
        return;
    }

    if (thefileavatar != '') {
        var ext = thefileavatar.name.split('.').pop().toLowerCase();
        if($.inArray(ext, ['jpg', 'png']) == -1) {
            _alert(msg_alert_avatar_format);
            $('#preload-actions-avatar').hide();
            $('#icon-upload-avatar').show();
            return;
        }
    }
    
    if (thefileavatar.size > sizeAvatar) {
        _alert(msg_alert_avatar_large);
        $('#preload-actions-avatar').hide();
        $('#icon-upload-avatar').show();
        return;
    }

    var data_avatar = new FormData(document.getElementById("form-avatar-new"));
    data_avatar.append("the_avatar_new", fileavatar);
    data_avatar.append("type_profile", _tp);
    data_avatar.append("code_profile", _cp);

    var params = {
            type: 'POST',
            withFile: true,
            module:  'actionssettingprofile',
            action: 'uploadavatar',
            data: data_avatar
    }

    invoke(params, uploadAvatarNew_Ok, uploadAvatarNew_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function deleteActivity_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            _alert(response.message); 
            break;
        case 'OK':
            $("#activity_" + response.codepost).fadeOut(500, function() { $("#activity_" + response.codepost).remove(); });
            break;            
   }
}

function deleteActivity_Error(response) {
    alert(msg_error_conection); 
}

function deleteActivity(code){
    var data = {
        cod: code,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionspost',
            action: 'delete',
            data: data
    }

    invoke(params, deleteActivity_Ok, deleteActivity_Error);
}


/*__________________________________________________________________*/
/*__________________________________________________________________*/

function updateActivity_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            $('#edit_preload_' + response.codepost).hide();
            $('#edit_actions_' + response.codepost).show();
            _alert(response.message);
            break;
        case 'OK':
            $('#space_txt_message_' + response.codepost).html(response.newmsg);
            $('#space_edit_message_' + response.codepost).hide();
            $('#space_txt_message_' + response.codepost).show();
            $('#edit_preload_' + response.codepost).hide();
            $('#edit_actions_' + response.codepost).show();
            $('#space_edit_message_' + response.codepost + ' textarea').val(response.newmsg_raw);
            $('#tmp_edit_' + response.codepost).val(response.newmsg_raw);
            break;            
   }
}

function updateActivity_Error(response) {}

function updateActivity(code){
    $('#edit_actions_' + code).hide();
    $('#edit_preload_' + code).show();
    
    message = $('#space_edit_message_' + code + ' textarea').val();
    message = $.trim(message);
    if (message == '') {
        $('#edit_preload_' + code).hide();
        $('#edit_actions_' + code).show();
        _alert(msg_alert_edit_empty);
        return;
    }
    
    var data = {
        cod: code,
        msg: message,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionspost',
            action: 'update',
            data: data
    }

    invoke(params, updateActivity_Ok, updateActivity_Error);
}


/*__________________________________________________________________*/
/*__________________________________________________________________*/

function hideActivity_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            _alert(response.message);
            break;
        case 'OK':
            $("#activity_" + response.codepost).fadeOut(500, function() { $("#activity_" + response.codepost).remove(); });
            break;            
   }
}

function hideActivity_Error(response) {
    alert(msg_error_conection);
}

function hideActivity(code){
	
    var data = {
        cod: code,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionspost',
            action: 'hide',
            data: data
    }

    invoke(params, hideActivity_Ok, hideActivity_Error);
}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function reportActivity_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            _alert(response.message);
            break;
        case 'OK':
            $('#optma_report_' + response.codepost).remove();
            _alert(response.html);
            break;            
   }
}

function reportActivity_Error(response) {
    alert(msg_error_conection);
}

function reportActivity(codepost, valuereturn) {
    
	valuereturn = $.trim(valuereturn);
    if (valuereturn == '') return false;

    var data = {
        cod: codepost,
        reason: valuereturn,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionspost',
            action: 'report',
            data: data
    }

    invoke(params, reportActivity_Ok, reportActivity_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function saveActivity_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            _alert(response.message);
            break;
        case 'OK':
            $('#optma_save_' + response.codepost).hide();
            $('#optma_unsave_' + response.codepost).show();
            _alert(response.html);
            break;            
   }
}

function saveActivity_Error(response) {
    alert(msg_error_conection);
}

function saveActivity(codepost) {
    
    var data = {
        cod: codepost,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionspost',
            action: 'saved',
            data: data
    }

    invoke(params, saveActivity_Ok, saveActivity_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function unSaveActivity_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            _alert(response.message);
            break;
        case 'OK':
            $('#optma_save_' + response.codepost).show();
            $('#optma_unsave_' + response.codepost).hide();
            _alert(response.html);
            break;            
   }
}

function unSaveActivity_Error(response) {
    alert(msg_error_conection);
}

function unSaveActivity(codepost) {
    
    var data = {
        cod: codepost,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionspost',
            action: 'unsaved',
            data: data
    }

    invoke(params, unSaveActivity_Ok, unSaveActivity_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function unReportActivity_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            _alert(response.message);
            break;
        case 'OK':
            $('#optma_ureport_' + response.codepost).remove();
            _alert(response.html);
            break;            
   }
}

function unReportActivity_Error(response) {
    alert(msg_error_conection);
}

function unReportActivity(codepost) {

    var data = {
        cod: codepost,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionspost',
            action: 'unreport',
            data: data
    }

    invoke(params, unReportActivity_Ok, unReportActivity_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function likedPost_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            $('#preload-like-' + paramsArray[0]).hide();
            $('#space-like-' + paramsArray[0]).show();
            _alert(response.message);
            break;
        case 'OK':
            code = response.codepost;
            status_like = $('#status-like-' + code).val();
            if (status_like == '0') {
                $('#status-like-' + code).val('1');
                $('#action-like-' + code + ' .act-text').addClass('active');
                $('#action-like-' + code + ' img').attr('src', _SITE_URL + 'themes/' + _THEME + '/imgs/post-ico-like-active.png');
                numlikes = $('#activity_' + code + ' .activity_num_likes').html();
                numlikes = parseInt(numlikes) + 1;
                $('#activity_' + code + ' .activity_num_likes').html(numlikes);
                if (numlikes == 1) $('#activity_' + code + ' .ba-nums-likes').show();
            }
            if (status_like == '1') {
                $('#status-like-' + code).val('0');
                $('#action-like-' + code + ' .act-text').removeClass('active');
                $('#action-like-' + code + ' img').attr('src', _SITE_URL + 'themes/' + _THEME + '/imgs/post-ico-like.png');
                numlikes = $('#activity_' + code + ' .activity_num_likes').html();
                numlikes = parseInt(numlikes) - 1;
                $('#activity_' + code + ' .activity_num_likes').html(numlikes);
                if (numlikes == 0) $('#activity_' + code + ' .ba-nums-likes').hide();
            }

            $('#preload-like-' + code).hide();
            $('#space-like-' + code).show();
            break;            
   }
}

function likedPost_Error(response) {
    $('#preload-like-' + paramsArray[0]).hide();
    $('#space-like-' + paramsArray[0]).show();
    alert(msg_error_conection);
}

function likedPost(code){
    $('#space-like-' + code).hide();
    $('#preload-like-' + code).show();

	paramsArray[0] = code;

    var data = {
        cod: code,
        sts: $('#status-like-' + code).val(),
        cvis: $('#code_visit_' + code).val(),
        tvis: $('#type_visit_' + code).val(),
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionspost',
            action: 'like',
            data: data
    }

    invoke(params, likedPost_Ok, likedPost_Error);
}


/*__________________________________________________________________*/
/*__________________________________________________________________*/

function sharePost_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            code = response.codepost;
            $('#preload-like-' + code).hide();
            $('#space-like-' + code).show();
            _alert(response.message);
            
            break;
        case 'OK':
            code = response.codepost;//alert(code);
            $("#share_ok_" + paramsArray[0]).html(response.msgok);
            $("#activity_" + paramsArray[0] + " .space-for-share-post").slideUp('low',function(){
                $("#share_ok_" + paramsArray[0]).slideDown('low');
            });
            setTimeout(function(){
                $("#share_ok_" + paramsArray[0]).slideUp('low',function(){
                    $("#activity_" + paramsArray[0] + " .space-icons-actions").slideDown('low');
                    $("#share-msg-post-" + code + paramsArray[0]).val('');
                    $('#share_preload_' + paramsArray[0]).hide();
                    $('#share_actions_' + paramsArray[0]).show();
                });
            }, 3000);
            
            break;            
   }
}

function sharePost_Error(response) {
    $('#share_preload_' + paramsArray[0]).hide();
    $('#share_actions_' + paramsArray[0]).show();
    alert(msg_error_conection);
}

function sharePost(code, container){
    $('#share_actions_' + code).hide();
    $('#share_preload_' + code).show();

	paramsArray[0] = container;

    var data = {
        cod: code,
        shfw: $('#sh_for_who_' + code).val(),
        shcwr: $('#sh_code_writer_' + code).val(),
        shtw: $('#sh_type_writer_' + code).val(),
        shpi: $('#sh_posted_in_' + code).val(),
        shcwl: $('#sh_code_wall_' + code).val(),
        shmsg: $("#share-msg-post-" + code + container).val(),
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionspost',
            action: 'share',
            data: data
    }

    invoke(params, sharePost_Ok, sharePost_Error);
}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function commentPost_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            _alert(response.message); 
            break;
        case 'OK':
            $('#comments-news-' + paramsArray[0]).append(response.newcomment);
            $('#info-attach-file-' + paramsArray[0]).html('');
            $('#space-attach-file-' + paramsArray[0]).hide();
            $('#button-attach-comment-' + paramsArray[0]).show();
            $('#attach-comment-' + paramsArray[0]).val('');
            $('#textarea-comment-' + paramsArray[0]).val('');
            $('#textarea-comment-' + paramsArray[0]).height('16px');
            break;            
   }
   $('#preload-input-comment-' + paramsArray[0]).hide();
   $('#space-input-comment-' + paramsArray[0]).show();
}

function commentPost_Error(response) {
    $('#preload-input-comment-' + paramsArray[0]).hide();
    $('#space-input-comment-' + paramsArray[0]).show();
    alert(msg_error_conection);
}

function commentPost(code){

    $('#space-input-comment-' + code).hide();
    $('#preload-input-comment-' + code).show();
    
    paramsArray[0] = code;
    
    var formData = new FormData(document.getElementById("form-comment-" + code));
    formData.append("codepost", code);
    formData.append("msgcomment", $('#textarea-comment-' + code).val());
    formData.append("code_writer", $('#cm_code_writer_' + code).val());
    formData.append("type_writer", $('#cm_type_writer_' + code).val());
    
    var params = {
            type: 'POST',
            withFile: true,
            module: 'actionspost',
            action: 'newcomment',
            data: formData
    }

    invoke(params, commentPost_Ok, commentPost_Error);
}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function deleteComment_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            _alert(response.message); 
            $('#delete-comment-' + paramsArray[0]).show();
            break;
        case 'OK':
            $("#comment-post-" + paramsArray[0]).fadeOut(500, function() { $("#comment-post-" + paramsArray[0]).remove(); });
            break;            
   }
}

function deleteComment_Error(response) {
    alert(msg_error_conection); 
    $('#delete-comment-' + paramsArray[0]).show();
}

function deleteComment(idcomment){
    
    paramsArray[0] = idcomment;
    
    var data = {
        idc: idcomment,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionspost',
            action: 'deletecomment',
            data: data
    }

    invoke(params, deleteComment_Ok, deleteComment_Error);
}


/*__________________________________________________________________*/
/*__________________________________________________________________*/

function commentMedia_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            _alert(response.message); 
            break;
        case 'OK':
            $('#textarea-comment-media-' + paramsArray[0]).val('');
            $('#comments-media-news-' + paramsArray[0]).append(response.newcomment);
            $('#textarea-comment-media-' + paramsArray[0]).height('16px');
            break;            
   }
}

function commentMedia_Error(response) {
    alert(msg_error_conection); 
}

function commentMedia(code){
    
    paramsArray[0] = code;
    
    var data = {
        cod: code,
        msg: $('#textarea-comment-media-' + code).val(),
        cwr: cmm_code_writer,
        twr: cmm_type_writer,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsmedia',
            action: 'newcomment',
            data: data
    }

    invoke(params, commentMedia_Ok, commentMedia_Error);
}


/*__________________________________________________________________*/
/*__________________________________________________________________*/

function likedMedia_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            $('#preload-like-media-' + paramsArray[0]).hide();
            $('#space-like-media-' + paramsArray[0]).show();
            _alert(response.message);
            break;
        case 'OK':
            code = response.codemedia;
            status_like = $('#status-like-media-' + code).val();
            if (status_like == '0') {
                $('#status-like-media-' + code).val('1');
                $('#action-like-media-' + code + ' .act-text').addClass('active');
                $('#action-like-media-' + code + ' img').attr('src', _SITE_URL + 'themes/' + _THEME + '/imgs/post-ico-like-active.png');
                numlikes = $('#media-' + code + ' .media_num_likes').html();
                numlikes = parseInt(numlikes) + 1;
                $('#media-' + code + ' .media_num_likes').html(numlikes);
                if (numlikes == 1) $('#media-' + code + ' .zo-nums-likes').show();
            }
            if (status_like == '1') {
                $('#status-like-media-' + code).val('0');
                $('#action-like-media-' + code + ' .act-text').removeClass('active');
                $('#action-like-media-' + code + ' img').attr('src', _SITE_URL + 'themes/' + _THEME + '/imgs/post-ico-like.png');
                numlikes = $('#media-' + code + ' .media_num_likes').html();
                numlikes = parseInt(numlikes) - 1;
                $('#media-' + code + ' .media_num_likes').html(numlikes);
                if (numlikes == 0) $('#media-' + code + ' .zo-nums-likes').hide();
            }

            $('#preload-like-media-' + code).hide();
            $('#space-like-media-' + code).show();
            break;            
   }
}

function likedMedia_Error(response) {
    $('#preload-like-media-' + paramsArray[0]).hide();
    $('#space-like-media-' + paramsArray[0]).show();
    alert(msg_error_conection);
}

function likedMedia(code){
    $('#space-like-media-' + code).hide();
    $('#preload-like-media-' + code).show();
    
	paramsArray[0] = code;

    var data = {
        cod: code,
        sts: $('#status-like-media-' + code).val(),
        cvis: cmm_code_writer,
        tvis: cmm_type_writer,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsmedia',
            action: 'like',
            data: data
    }

    invoke(params, likedMedia_Ok, likedMedia_Error);
}


/*__________________________________________________________________*/
/*__________________________________________________________________*/

function joinedGroup_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            $('#area-action-join').show();
            break;

        case 'OK':
            $('#area-action-join').hide();
            $('#area-action-pending').show();
            break;
   }
   $('#preload-b-action').hide();
}

function joinedGroup_Error(response) {
    $('#preload-b-action').hide();
    $('#area-action-join').show();
}

function joinedGroup() {
    $('#area-action-join').hide();
    $('#preload-b-action').show();

    var data = {
        cgroup: cgroup,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsingroup',
            action: 'join',
            data: data
    }

    invoke(params, joinedGroup_Ok, joinedGroup_Error);

}


/*__________________________________________________________________*/
/*__________________________________________________________________*/

function cancelRequest_Ok(response) {
   switch (response.status) {
        case 'ERROR':

            $('#area-action-pending').show();
            break;

        case 'OK':
            $('#area-action-pending').hide();
            $('#area-action-join').show();

            break;
   }
   $('#preload-b-action').hide();
}

function cancelRequest_Error(response) {
    $('#preload-b-action').hide();
    $('#area-action-pending').show();
}

function cancelRequest() {

    $('#area-action-pending').hide();
    $('#preload-b-action').show();

    var data = {
        cgroup: cgroup,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsingroup',
            action: 'cancelrequest',
            data: data
    }

    invoke(params, cancelRequest_Ok, cancelRequest_Error);

}


/*__________________________________________________________________*/
/*__________________________________________________________________*/

function leaveGroup_Ok(response) {
   switch (response.status) {
        case 'ERROR':

            $('#area-action-joined').show();
            break;

        case 'OK':
            $('#area-action-joined').hide();
            $('#area-action-join').show();

            break;
   }
   $('#preload-b-action').hide();
}

function leaveGroup_Error(response) {
    $('#preload-b-action').hide();
    $('#area-action-joined').show();
}

function leaveGroup() {

    $('#area-action-joined').hide();
    $('#preload-b-action').show();

    var data = {
        cgroup: cgroup,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsingroup',
            action: 'leavegroup',
            data: data
    }

    invoke(params, leaveGroup_Ok, leaveGroup_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function declineRequestGroup_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            $('#member-' + paramsArray[0]).fadeOut();
            break;
   }
}

function declineRequestGroup_Error(response) {
}

function declineRequestGroup(codeuser, codegroup) {

    paramsArray[0] = codeuser;

    var data = {
        cuser: codeuser,
        cgroup: codegroup,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsingroup',
            action: 'declinerequest',
            data: data
    }

    invoke(params, declineRequestGroup_Ok, declineRequestGroup_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function approveRequestGroup_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            $('#actions-in-request-' + paramsArray[0]).slideUp('fast', function(){
                $('#ok-request-' + paramsArray[0]).slideDown('fast');
            });
            break;
   }
}

function approveRequestGroup_Error(response) {
}

function approveRequestGroup(codeuser, codegroup) {

    paramsArray[0] = codeuser;

    var data = {
        cuser: codeuser,
        cgroup: codegroup,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsingroup',
            action: 'approverequest',
            data: data
    }

    invoke(params, approveRequestGroup_Ok, approveRequestGroup_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function likePage_Ok(response) {
   switch (response.status) {
        case 'ERROR':

            $('#area-action-like').show();
            break;

        case 'OK':
            $('#area-action-like').hide();
            $('#area-action-liked').show();

            break;
   }
   $('#preload-b-action').hide();
}

function likePage_Error(response) {
    $('#preload-b-action').hide();
    $('#area-action-like').show();
}

function likePage() {
    $('#area-action-like').hide();
    $('#preload-b-action').show();

    var data = {
        cpage: cpage,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsinpage',
            action: 'like',
            data: data
    }

    invoke(params, likePage_Ok, likePage_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function unlikePage_Ok(response) {
   switch (response.status) {
        case 'ERROR':

            $('#area-action-liked').show();
            break;

        case 'OK':
            $('#area-action-liked').hide();
            $('#area-action-like').show();

            break;
   }
   $('#preload-b-action').hide();
}

function unlikePage_Error(response) {
    $('#preload-b-action').hide();
    $('#area-action-liked').show();
}

function unlikePage() {
    $('#area-action-liked').hide();
    $('#preload-b-action').show();

    var data = {
        cpage: cpage,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsinpage',
            action: 'unlike',
            data: data
    }

    invoke(params, unlikePage_Ok, unlikePage_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function addFriend_Ok(response) {
   switch (response.status) {
        case 'ERROR':

            $('#area-action-addfriend').show();
            break;

        case 'OK':
            $('#area-action-addfriend').hide();
            $('#area-action-requestsent').show();

            break;
   }
   $('#preload-b-action').hide();
}

function addFriend_Error(response) {
    $('#preload-b-action').hide();
    $('#area-action-addfriend').show();
}

function addFriend() {
    $('#area-action-addfriend').hide();
    $('#preload-b-action').show();

    var data = {
        cuser: cuser,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsinprofile',
            action: 'addfriend',
            data: data
    }

    invoke(params, addFriend_Ok, addFriend_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function cancelFriendRequest_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            $('#area-action-requestsent').show();
            break;

        case 'OK':
            $('#area-action-requestsent').hide();
            $('#area-action-addfriend').show();
            break;
   }
   $('#preload-b-action').hide();
}

function cancelFriendRequest_Error(response) {
    $('#preload-b-action').hide();
    $('#area-action-requestsent').show();
}

function cancelFriendRequest() {
    $('#area-action-requestsent').hide();
    $('#preload-b-action').show();

    var data = {
        cuser: cuser,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsinprofile',
            action: 'cancelfriendrequest',
            data: data
    }

    invoke(params, cancelFriendRequest_Ok, cancelFriendRequest_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function deleteFriendRequest_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            $('#area-action-answerrequest').show();
            break;

        case 'OK':
            $('#area-action-answerrequest').hide();
            $('#area-action-addfriend').show();
            break;
   }
   $('#preload-b-action').hide();
}

function deleteFriendRequest_Error(response) {
    $('#preload-b-action').hide();
    $('#area-action-answerrequest').show();
}

function deleteFriendRequest() {
    $('#area-action-answerrequest').hide();
    $('#preload-b-action').show();

    var data = {
        cuser: cuser,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsinprofile',
            action: 'deletefriendrequest',
            data: data
    }

    invoke(params, deleteFriendRequest_Ok, deleteFriendRequest_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function confirmFriendRequest_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            $('#area-action-answerrequest').show();
            break;

        case 'OK':
            $('#area-action-answerrequest').hide();
            $('#area-action-friends').show();
            break;
   }
   $('#preload-b-action').hide();
}

function confirmFriendRequest_Error(response) {
    $('#preload-b-action').hide();
    $('#area-action-answerrequest').show();
}

function confirmFriendRequest() {
    $('#area-action-answerrequest').hide();
    $('#preload-b-action').show();

    var data = {
        cuser: cuser,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsinprofile',
            action: 'confirmfriendrequest',
            data: data
    }

    invoke(params, confirmFriendRequest_Ok, confirmFriendRequest_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function unFriend_Ok(response) {
   switch (response.status) {
        case 'ERROR':

            $('#area-action-friends').show();
            break;

        case 'OK':
            $('#area-action-friends').hide();
            $('#area-action-addfriend').show();

            break;
   }
   $('#preload-b-action').hide();
}

function unFriend_Error(response) {
    $('#preload-b-action').hide();
    $('#area-action-friends').show();
}

function unFriend() {
    $('#area-action-friends').hide();
    $('#preload-b-action').show();

    var data = {
        cuser: cuser,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsinprofile',
            action: 'unfriend',
            data: data
    }

    invoke(params, unFriend_Ok, unFriend_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function confirmRequestFriend_Notif_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            $('#preload-notif-' + paramsArray[0]).hide();
            $('#buttons-actions-' + paramsArray[0]).show();
            break;

        case 'OK':
            $('#buttons-actions-' + paramsArray[0]).hide();
            $('#preload-notif-' + paramsArray[0]).hide();
            $('#btn-friends-' + paramsArray[0]).show();
            break;
   }
}

function confirmRequestFriend_Notif_Error(response) {
    $('#preload-notif-' + paramsArray[0]).hide();
    $('#buttons-actions-' + paramsArray[0]).show();
}

function confirmRequestFriend_Notif(idnotif, codeuser) {
    $('#buttons-actions-' + idnotif).hide();
    $('#preload-notif-' + idnotif).show();

    paramsArray[0] = idnotif;

    var data = {
        idn: idnotif,
        cdu: codeuser,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsinnotif',
            action: 'confirmfriendrequest',
            data: data
    }

    invoke(params, confirmRequestFriend_Notif_Ok, confirmRequestFriend_Notif_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function deleteRequestFriend_Notif_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            $('#preload-notif-' + paramsArray[0]).hide();
            $('#buttons-actions-' + paramsArray[0]).show();
            break;

        case 'OK':
            $('#buttons-actions-' + paramsArray[0]).hide();
            $('#preload-notif-' + paramsArray[0]).hide();
            $('#notif-people-' + paramsArray[0]).fadeOut();
            break;
   }
}

function deleteRequestFriend_Notif_Error(response) {
    $('#preload-notif-' + paramsArray[0]).hide();
    $('#buttons-actions-' + paramsArray[0]).show();
}

function deleteRequestFriend_Notif(idnotif, codeuser) {
    $('#buttons-actions-' + idnotif).hide();
    $('#preload-notif-' + idnotif).show();

    paramsArray[0] = idnotif;

    var data = {
        idn: idnotif,
        cdu: codeuser,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsinnotif',
            action: 'deletefriendrequest',
            data: data
    }

    invoke(params, deleteRequestFriend_Notif_Ok, deleteRequestFriend_Notif_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function insertStickerComment_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            _alert(response.message);
            break;

        case 'OK':
            $('#comments-news-' + paramsArray[0]).append(response.newcomment);
            break;
   }
   $('#preload-input-comment-' + paramsArray[0]).hide();
   $('#space-input-comment-' + paramsArray[0]).show();
}

function insertStickerComment_Error(response) {
    $('#preload-input-comment-' + paramsArray[0]).hide();
    $('#space-input-comment-' + paramsArray[0]).show();
    alert(msg_error_conection);
}

function insertStickerComment(code, sticker) {
    $('#bstickerscom-' + code).next('.menustickers-comment').toggle();
    
    $('#space-input-comment-' + code).hide();
    $('#preload-input-comment-' + code).show();

    paramsArray[0] = code;

    var formData = new FormData(document.getElementById("form-comment-" + code));
    formData.append("codepost", code);
    formData.append("msgcomment", sticker);
    formData.append("code_writer", $('#cm_code_writer_' + code).val());
    formData.append("type_writer", $('#cm_type_writer_' + code).val());
    
    var params = {
            type: 'POST',
            withFile: true,
            module: 'actionspost',
            action: 'newstickercomment',
            data: formData
    }

    invoke(params, insertStickerComment_Ok, insertStickerComment_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function insertStickerCommentMedia_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            _alert(response.message);
            break;

        case 'OK':
            $('#comments-media-news-' + paramsArray[0]).append(response.newcomment);
            break;
   }
}

function insertStickerCommentMedia_Error(response) {
    alert(msg_error_conection); 
}

function insertStickerCommentMedia(code, sticker) {

    $('#bstickerscommed-' + code).next('.menustickers-comment').toggle();
    
    paramsArray[0] = code;

    var data = {
        cod: code,
        msg: sticker,
        cwr: cmm_code_writer,
        twr: cmm_type_writer,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsmedia',
            action: 'newstickercommentmedia',
            data: data
    }

    invoke(params, insertStickerCommentMedia_Ok, insertStickerCommentMedia_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function insertSmiles(areaText, stringEmo) {
	var item_dom = document.getElementsByName(areaText)[0];
	if (document.selection) {
		item_dom.focus();
		sel = document.selection.createRange();
		sel.text = ' ' + stringEmo + ' ';
		return;
	}
	
	if (item_dom.selectionStart || item_dom.selectionStart == "0") {
		var t_start = item_dom.selectionStart;
		var t_end = item_dom.selectionEnd;
		var val_start = item_dom.value.substring(0, t_start);
		var val_end = item_dom.value.substring(t_end, item_dom.value.length);
		item_dom.value = val_start + ' ' + stringEmo + ' ' + val_end;
	} else item_dom.value += ' ' + stringEmo + ' ';
	
	//item_dom.focus(); 
}

$(document).on('click', '.ico-smiles', function() {
    $(this).next('.menusmiles').toggle();
});

$(document).on('click', function(e) {
    if ($(e.target).hasClass('ico-smiles') || $(e.target).parents('.ico-smiles').length > 0 || $(e.target).hasClass('menusmiles') || $(e.target).parents('.menusmiles').length > 0) return;
    $('.menusmiles').hide();
});

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function blockUser_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            _alert(response.message);
            break;

        case 'OK':
            loadFriendsOnline();
            _SPACE_FULL = true;
            actionOnClick(_SITE_URL + 'settings/blocked', 'dashboard-main-area', 'max');
            break;
   }
}

function blockUser_Error(response) {
    alert(msg_error_conection); 
}

function blockUser() {

    var data = {
        cod: cuser,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsinprofile',
            action: 'blockuser',
            data: data
    }

    invoke(params, blockUser_Ok, blockUser_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function unBlockUser_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            _alert(response.message);
            break;

        case 'OK':
            loadFriendsOnline();
            $("#user_blocked_" + paramsArray[0]).fadeOut(500, function() { $("#user_blocked_" + paramsArray[0]).remove(); });
            break;
   }
}

function unBlockUser_Error(response) {
    alert(msg_error_conection); 
}

function unBlockUser(cuser) {

    var data = {
        cod: cuser,
    }
 
    paramsArray[0] = cuser;
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionssetting',
            action: 'unblockuser',
            data: data
    }

    invoke(params, unBlockUser_Ok, unBlockUser_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function reportUser_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            _alert(response.message);
            break;

        case 'OK':
            $('#breportuser').remove();
            _alert(response.html);
            break;
   }
}

function reportUser_Error(response) {
    alert(msg_error_conection); 
}

function reportUser(divreason, valuereturn) {
    
	valuereturn = $.trim(valuereturn);
    if (valuereturn == '') return false;

    var data = {
        cod: cuser,
        reason: valuereturn,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsinprofile',
            action: 'reportuser',
            data: data
    }

    invoke(params, reportUser_Ok, reportUser_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function unReportUser_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            _alert(response.message);
            break;

        case 'OK':
            $('#bunreported').remove();
            _alert(response.html);
            break;
   }
}

function unReportUser_Error(response) {
    alert(msg_error_conection); 
}

function unReportUser() {

    var data = {
        cod: cuser,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsinprofile',
            action: 'unreportuser',
            data: data
    }

    invoke(params, unReportUser_Ok, unReportUser_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function changeTypePost_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            _alert(response.message);
            break;

        case 'OK':
            $('#theicon_' + paramsArray[0]).attr('src', response.theicon);
            $('#amwh_' + paramsArray[0]).hide();
            break;
   }
}

function changeTypePost_Error(response) {
    alert(msg_error_conection); 
}

function changeTypePost(thecode, thetype) {

    var data = {
        cod: thecode,
        typ: thetype,
    }
 
    paramsArray[0] = thecode;
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionspost',
            action: 'changetype',
            data: data
    }

    invoke(params, changeTypePost_Ok, changeTypePost_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function loadPostsInit_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;
        case 'OK':
            $('#the-posts-init').html(response.listactivities);
            $('#the-show-more').html(response.showmore);
			$('video.js_video-js').each(function(){ videojs($(this)[0], {}, function() {}); });
			$('audio.mep_audio').mediaelementplayer();
            activeSlimScrollers();
			$('.action_autosize').each(function(){
				autosize(this);
			});
            

            
            break;            
   }
}

function loadPostsInit_Error() {}

function loadPostsInit() {
     var data = {}
    
    var params = {
        type: 'POST',
        withFile: false,
        module: 'drawsections',
        action: 'postsinit',
        data: data
    }

    invoke(params, loadPostsInit_Ok, loadPostsInit_Error);
    
}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function loadSavedPostInit_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;
        case 'OK':
            $('#the-posts-init').html(response.listactivities);
            $('#the-show-more').html(response.showmore);
			$('video.js_video-js').each(function(){ videojs($(this)[0], {}, function() {}); });
			$('audio.mep_audio').mediaelementplayer();
            activeSlimScrollers();
			$('.action_autosize').each(function(){
				autosize(this);
			}) 
            break;            
   }
}

function loadSavedPostInit_Error() {}

function loadSavedPostInit() {
     var data = {}
    
    var params = {
        type: 'POST',
        withFile: false,
        module: 'drawsections',
        action: 'savedpostinit',
        data: data
    }

    invoke(params, loadSavedPostInit_Ok, loadSavedPostInit_Error);
    
}

/*__________________________________________________________________*/
/*__________________________________________________________________*/


function createEvent_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            _SPACE_FULL = true;
            actionOnClick(_SITE_URL + 'event/' + response.codeevent, 'dashboard-main-area', 'max');
            break;            
   }
}

function createEvent_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function createEvent(diverror, bsubmit) {
    
	$(bsubmit).attr('disabled','true');
	
	nameevent = validationInput('empty', '#titleevent', diverror, txt_enter_name, bsubmit, false);
	if (!nameevent) return;
	
	locationevent = validationInput('empty', '#locationevent', diverror, txt_enter_location, bsubmit, false);
	if (!locationevent) return;

	datestart = validationInput('empty', '#datestart', diverror, txt_enter_datestart, bsubmit, false);
	if (!datestart) return;

	timestart = validationInput('empty', '#timestart', diverror, txt_enter_timestart, bsubmit, false);
	if (!timestart) return;

	dateend = validationInput('empty', '#dateend', diverror, txt_enter_dateend, bsubmit, false);
	if (!dateend) return;

	timeend = validationInput('empty', '#timeend', diverror, txt_enter_timeend, bsubmit, false);
	if (!timeend) return;
    
	descriptionevent = validationInput('empty', '#descriptionevent', diverror, txt_enter_description, bsubmit, false);
	if (!descriptionevent) return;
	
	paramsArray[0] = diverror;
    paramsArray[1] = bsubmit;
    
    var data = {
        ena: nameevent,
        elo: locationevent,
        ede: descriptionevent,
        dts: datestart,
        tms: timestart,
        dte: dateend,
        tme: timeend,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsevents',
            action: 'create',
            data: data
    }

    invoke(params, createEvent_Ok, createEvent_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function updateEvent_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            _SPACE_FULL = true;
            actionOnClick(_SITE_URL + 'event/' + response.codeevent, 'dashboard-main-area', 'max');
            break;            
   }
}

function updateEvent_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function updateEvent(diverror, bsubmit) {
    
	$(bsubmit).attr('disabled','true');
	
	nameevent = validationInput('empty', '#titleevent', diverror, txt_enter_name, bsubmit, false);
	if (!nameevent) return;
	
	locationevent = validationInput('empty', '#locationevent', diverror, txt_enter_location, bsubmit, false);
	if (!locationevent) return;
    
	datestart = validationInput('empty', '#datestart', diverror, txt_enter_datestart, bsubmit, false);
	if (!datestart) return;

	timestart = validationInput('empty', '#timestart', diverror, txt_enter_timestart, bsubmit, false);
	if (!timestart) return;

	dateend = validationInput('empty', '#dateend', diverror, txt_enter_dateend, bsubmit, false);
	if (!dateend) return;

	timeend = validationInput('empty', '#timeend', diverror, txt_enter_timeend, bsubmit, false);
	if (!timeend) return;
    
	descriptionevent = validationInput('empty', '#descriptionevent', diverror, txt_enter_description, bsubmit, false);
	if (!descriptionevent) return;

	paramsArray[0] = diverror;
    paramsArray[1] = bsubmit;
    
    var data = {
        code: codev,
        ena: nameevent,
        elo: locationevent,
        ede: descriptionevent,
        dts: datestart,
        tms: timestart,
        dte: dateend,
        tme: timeend,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsevents',
            action: 'update',
            data: data
    }

    invoke(params, updateEvent_Ok, updateEvent_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function deleteEvent_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            break;

        case 'OK':
            actionOnClick(_SITE_URL + 'myevents', 'dashboard-main-area-right', 'min');
            break;            
   }
}

function deleteEvent_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
}

function deleteEvent(diverror) {

	paramsArray[0] = diverror;
    
    var data = {
        code: codev,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsevents',
            action: 'delete',
            data: data
    }

    invoke(params, deleteEvent_Ok, deleteEvent_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function actionEventInterested_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            if (paramsArray[0] == 1) {
                $('#area-action-selected').show();
            } else {
                $('#area-action-initial').show();
            }
            break;

        case 'OK':
            
            type_change = response.change;
            switch (type_change) {
                case 0:
                    
                    break;
                case 1:
                    
                    break;
                case 2:
                    
                    break;                
            }
            
            $('#action_quitevent').html(text_yano_interested);
            $('#action_going').css('font-weight','normal');
            $('#action_interested').css('font-weight','bold');
            $('#text-btn-result').html(response.txtbtn);
            $('#area-action-selected').show();
            
            break;
   }
   $('#preload-b-action').hide();
}

function actionEventInterested_Error(response) {
    $('#preload-b-action').hide();
    if (paramsArray[0] == 1) {
        $('#area-action-selected').show();
    } else {
        $('#area-action-initial').show();
    }
}

function actionEventInterested(in_menue_merged) {

    if (in_menue_merged == 1) {
        $('#area-action-selected').hide();
    } else {
        $('#area-action-initial').hide();
    }
    
    $('#preload-b-action').show();
    
    paramsArray[0] = in_menue_merged;

    var data = {
        cevent: code_event,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsinevent',
            action: 'interested',
            data: data
    }

    invoke(params, actionEventInterested_Ok, actionEventInterested_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function actionEventGoing_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            if (paramsArray[0] == 1) {
                $('#area-action-selected').show();
            } else {
                $('#area-action-initial').show();
            }
            break;

        case 'OK':
            
            type_change = response.change;
            switch (type_change) {
                case 0:
                    
                    break;
                case 1:
                    
                    break;
                case 2:
                    
                    break;                
            }
            
            $('#action_quitevent').html(text_yano_going);
            $('#action_going').css('font-weight','bold');
            $('#action_interested').css('font-weight','normal');
            $('#text-btn-result').html(response.txtbtn);
            $('#area-action-selected').show();
            
            break;
   }
   $('#preload-b-action').hide();
}

function actionEventGoing_Error(response) {
    $('#preload-b-action').hide();
    if (paramsArray[0] == 1) {
        $('#area-action-selected').show();
    } else {
        $('#area-action-initial').show();
    }
}

function actionEventGoing(in_menue_merged) {

    if (in_menue_merged == 1) {
        $('#area-action-selected').hide();
    } else {
        $('#area-action-initial').hide();
    }
    
    $('#preload-b-action').show();
    
    paramsArray[0] = in_menue_merged;

    var data = {
        cevent: code_event,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsinevent',
            action: 'going',
            data: data
    }

    invoke(params, actionEventGoing_Ok, actionEventGoing_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function actionQuitEvent_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            $('#area-action-selected').show();
            break;

        case 'OK':
            $('#text-btn-result').html('');
            $('#area-action-initial').show();
            break;
   }
   $('#preload-b-action').hide();
}

function actionQuitEvent_Error(response) {
    $('#preload-b-action').hide();
    $('#area-action-selected').show();
}

function actionQuitEvent() {

    $('#area-action-selected').hide();
    
    $('#preload-b-action').show();


    var data = {
        cevent: code_event,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsinevent',
            action: 'quit',
            data: data
    }

    invoke(params, actionQuitEvent_Ok, actionQuitEvent_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/


function loadcategoryarticles_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            $(paramsArray[0]).html(response.categories);
            $(paramsArray[0]).removeAttr('disabled');
            break;            
   }
}

function loadcategoryarticles_Error(response) {
}

function loadcategoryarticles(idcat, msgcategory, msgsubcategory, divcategories, divsubcategories) {
	$(divcategories).html('<option value="-1">' + msgcategory + '</option>');
	$(divcategories).attr('disabled','true');
	$(divsubcategories).html('<option value="0">' + msgsubcategory + '</option>');
    
	paramsArray[0] = divcategories;
    
    var data = {
        idc: idcat,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'getcategories',
            action: 'getcatarticles',
            data: data
    }

    invoke(params, loadcategoryarticles_Ok, loadcategoryarticles_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function loadsubcategoryarticles_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            $(paramsArray[1]).html(response.subcategories);
            $(paramsArray[1]).removeAttr('disabled');
            break;            
   }
}

function loadsubcategoryarticles_Error(response) {
}

function loadsubcategoryarticles(idcat, idsubcat, msgcsubcategory, divsubcategories) {	
	$(divsubcategories).html('<option value="-1">' + msgcsubcategory + '</option>');
	$(divsubcategories).attr('disabled','true');
    
	paramsArray[1] = divsubcategories;
    
    var data = {
        idc: idcat,
        idsc: idsubcat,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'getsubcategories',
            action: 'getsubcatarticles',
            data: data
    }

    invoke(params, loadsubcategoryarticles_Ok, loadsubcategoryarticles_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/


function loadcategoryproducts_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            $(paramsArray[0]).html(response.categories);
            $(paramsArray[0]).removeAttr('disabled');
            break;            
   }
}

function loadcategoryproducts_Error(response) {
}

function loadcategoryproducts(idcat, msgcategory, msgsubcategory, divcategories, divsubcategories) {
	$(divcategories).html('<option value="-1">' + msgcategory + '</option>');
	$(divcategories).attr('disabled','true');
	$(divsubcategories).html('<option value="0">' + msgsubcategory + '</option>');
    
	paramsArray[0] = divcategories;
    
    var data = {
        idc: idcat,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'getcategories',
            action: 'getcatproducts',
            data: data
    }

    invoke(params, loadcategoryproducts_Ok, loadcategoryproducts_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function loadsubcategoryproducts_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            $(paramsArray[1]).html(response.subcategories);
            $(paramsArray[1]).removeAttr('disabled');
            break;            
   }
}

function loadsubcategoryproducts_Error(response) {
}

function loadsubcategoryproducts(idcat, idsubcat, msgcsubcategory, divsubcategories) {	
	$(divsubcategories).html('<option value="-1">' + msgcsubcategory + '</option>');
	$(divsubcategories).attr('disabled','true');
    
	paramsArray[1] = divsubcategories;
    
    var data = {
        idc: idcat,
        idsc: idsubcat,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'getsubcategories',
            action: 'getsubcatproducts',
            data: data
    }

    invoke(params, loadsubcategoryproducts_Ok, loadsubcategoryproducts_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function publishArticle_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            $('#preload-publish').hide();
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            actionOnClick(_SITE_URL + 'articles', 'dashboard-main-area-right', 'min');
            break;
   }
}

function publishArticle_Error(response) {
    $('#preload-publish').hide();
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function publishArticle(diverror, bsubmit) {

    $(bsubmit).attr('disabled','true');

    paramsArray[0] = diverror;
    paramsArray[1] = bsubmit;
    
	titlearticle = validationInput('empty', '#titlearticle', diverror, txt_error_title, bsubmit, false);
	if (!titlearticle) return;

	idcategory = validationInput('positive', '#categoryarticle', diverror, txt_error_category, bsubmit, false);
	if (!idcategory) return;

	idsubcategory = validationInput('positive', '#subcategoryarticle', diverror, txt_error_subcategory, bsubmit, false);
	if (!idsubcategory) return;

	summaryarticle = validationInput('empty', '#summaryarticle', diverror, txt_error_summary, bsubmit, false);
	if (!summaryarticle) return;
    

    thefile = $('#imagenfile').val();
    if (thefile != '') {
        var ext = thefile.split('.').pop().toLowerCase();
        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            openandclose(diverror, txt_error_formatimage, 1700)
            setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500);
            return;
        }
    } else {
        openandclose(diverror, txt_error_image, 1700)
        setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500);
        return;
    }

	thecontent = tinyMCE.activeEditor.getContent();
	if (thecontent.length < 10) {
        openandclose(diverror, txt_error_content, 1700)
        setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500);
		return;
	}

    var formData = new FormData(document.getElementById("form1"));
    formData.append("tta", titlearticle);
    formData.append("idca", idcategory);
    formData.append("idsca", idsubcategory);
    formData.append("smrya", summaryarticle);
    formData.append("conta", thecontent);
    
    var params = {
            type: 'POST',
            withFile: true,
            module: 'actionsarticles',
            action: 'publish',
            data: formData
    }
    
    $('#preload-publish').show();

    invoke(params, publishArticle_Ok, publishArticle_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/


function updateArticle_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            $('#preload-publish').hide();
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            actionOnClick(_SITE_URL + 'articles', 'dashboard-main-area-right', 'min');
            break;
   }
}

function updateArticle_Error(response) {
    $('#preload-publish').hide();
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function updateArticle(diverror, bsubmit) {

    $(bsubmit).attr('disabled','true');

    paramsArray[0] = diverror;
    paramsArray[1] = bsubmit;
    
	titlearticle = validationInput('empty', '#titlearticle', diverror, txt_error_title, bsubmit, false);
	if (!titlearticle) return;

	idcategory = validationInput('positive', '#categoryarticle', diverror, txt_error_category, bsubmit, false);
	if (!idcategory) return;

	idsubcategory = validationInput('positive', '#subcategoryarticle', diverror, txt_error_subcategory, bsubmit, false);
	if (!idsubcategory) return;

	summaryarticle = validationInput('empty', '#summaryarticle', diverror, txt_error_summary, bsubmit, false);
	if (!summaryarticle) return;
    
    changeimg = $('#changeimg').val();
    
    if (changeimg == '1') { 

        thefile = $('#imagenfile').val();
        if (thefile != '') {
            var ext = thefile.split('.').pop().toLowerCase();
            if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
                openandclose(diverror, txt_error_formatimage, 1700)
                setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500);
                return;
            }
        } else {
            openandclose(diverror, txt_error_image, 1700)
            setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500);
            return;
        }

    }

	thecontent = tinyMCE.activeEditor.getContent();
	if (thecontent.length < 10) {
        openandclose(diverror, txt_error_content, 1700)
        setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500);
		return;
	}

    var formData = new FormData(document.getElementById("form1"));
    formData.append("codea", codart);
    formData.append("tta", titlearticle);
    formData.append("idca", idcategory);
    formData.append("idsca", idsubcategory);
    formData.append("smrya", summaryarticle);
    formData.append("conta", thecontent);
    formData.append("chgi", changeimg);
    
    var params = {
            type: 'POST',
            withFile: true,
            module: 'actionsarticles',
            action: 'update',
            data: formData
    }
    
    $('#preload-publish').show();

    invoke(params, updateArticle_Ok, updateArticle_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function deleteArticle_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            break;

        case 'OK':
            actionOnClick(_SITE_URL + 'articles', 'dashboard-main-area-right', 'min');
            break;            
   }
}

function deleteArticle_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
}

function deleteArticle(diverror) {

	paramsArray[0] = diverror;
    
    var data = {
        code: codart,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsarticles',
            action: 'delete',
            data: data
    }

    invoke(params, deleteArticle_Ok, deleteArticle_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function createProduct_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            $('#preload-publish').hide();
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            actionOnClick(_SITE_URL + 'products', 'dashboard-main-area-right', 'min');
            break;
   }
}

function createProduct_Error(response) {
    $('#preload-publish').hide();
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function createProduct(diverror, bsubmit) {

    $(bsubmit).attr('disabled','true');

    paramsArray[0] = diverror;
    paramsArray[1] = bsubmit;
    
	nameproduct = validationInput('empty', '#nameproduct', diverror, txt_error_name, bsubmit, false);
	if (!nameproduct) return;

	descriptionproduct = validationInput('empty', '#descriptionproduct', diverror, txt_error_description, bsubmit, false);
	if (!descriptionproduct) return;

	idcategory = validationInput('positive', '#categoryproduct', diverror, txt_error_category, bsubmit, false);
	if (!idcategory) return;

	idsubcategory = validationInput('positive', '#subcategoryproduct', diverror, txt_error_subcategory, bsubmit, false);
	if (!idsubcategory) return;
    
	typeproduct = validationInput('positive', '#typeproduct', diverror, txt_error_type, bsubmit, false);
	if (!typeproduct) return;

	currencyproduct = validationInput('positive', '#currencyproduct', diverror, txt_error_currency, bsubmit, false);
	if (!currencyproduct) return;
    
	priceproduct = validationInput('numberpositive', '#priceproduct', diverror, txt_error_price, bsubmit, false);
	if (!priceproduct) return;
    
	locationproduct = validationInput('empty', '#locationproduct', diverror, txt_error_location, bsubmit, false);
	if (!locationproduct) return;

    thefile = $('#imagenfile').val();
    if (thefile != '') {
        var ext = thefile.split('.').pop().toLowerCase();
        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            openandclose(diverror, txt_error_formatphoto, 1700)
            setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500);
            return;
        }
    } else {
        openandclose(diverror, txt_error_photo, 1700)
        setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500);
        return;
    }


    var formData = new FormData(document.getElementById("form1"));
    formData.append("namp", nameproduct);
    formData.append("desp", descriptionproduct);
    formData.append("idcp", idcategory);
    formData.append("idsp", idsubcategory);
    formData.append("typp", typeproduct);
    formData.append("curp", currencyproduct);
    formData.append("prip", priceproduct);
    formData.append("locp", locationproduct);
    
    var params = {
            type: 'POST',
            withFile: true,
            module: 'actionsproducts',
            action: 'create',
            data: formData
    }
    
    $('#preload-publish').show();

    invoke(params, createProduct_Ok, createProduct_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/


function updateProduct_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            $('#preload-publish').hide();
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            actionOnClick(_SITE_URL + 'products', 'dashboard-main-area-right', 'min');
            break;
   }
}

function updateProduct_Error(response) {
    $('#preload-publish').hide();
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function updateProduct(diverror, bsubmit) {

    $(bsubmit).attr('disabled','true');

    paramsArray[0] = diverror;
    paramsArray[1] = bsubmit;
    
	nameproduct = validationInput('empty', '#nameproduct', diverror, txt_error_name, bsubmit, false);
	if (!nameproduct) return;

	descriptionproduct = validationInput('empty', '#descriptionproduct', diverror, txt_error_description, bsubmit, false);
	if (!descriptionproduct) return;

	idcategory = validationInput('positive', '#categoryproduct', diverror, txt_error_category, bsubmit, false);
	if (!idcategory) return;

	idsubcategory = validationInput('positive', '#subcategoryproduct', diverror, txt_error_subcategory, bsubmit, false);
	if (!idsubcategory) return;
    
	typeproduct = validationInput('positive', '#typeproduct', diverror, txt_error_type, bsubmit, false);
	if (!typeproduct) return;

	currencyproduct = validationInput('positive', '#currencyproduct', diverror, txt_error_currency, bsubmit, false);
	if (!currencyproduct) return;
    
	priceproduct = validationInput('numberpositive', '#priceproduct', diverror, txt_error_price, bsubmit, false);
	if (!priceproduct) return;
    
	locationproduct = validationInput('empty', '#locationproduct', diverror, txt_error_location, bsubmit, false);
	if (!locationproduct) return;

    
    changeimg = $('#changeimg').val();
    
    if (changeimg == '1') { 

        thefile = $('#imagenfile').val();
        if (thefile != '') {
            var ext = thefile.split('.').pop().toLowerCase();
            if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
                openandclose(diverror, txt_error_formatphoto, 1700)
                setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500);
                return;
            }
        } else {
            openandclose(diverror, txt_error_photo, 1700)
            setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500);
            return;
        }

    }
    

    var formData = new FormData(document.getElementById("form1"));
    formData.append("codep", codpro);
    formData.append("namp", nameproduct);
    formData.append("desp", descriptionproduct);
    formData.append("idcp", idcategory);
    formData.append("idsp", idsubcategory);
    formData.append("typp", typeproduct);
    formData.append("curp", currencyproduct);
    formData.append("prip", priceproduct);
    formData.append("locp", locationproduct);
    formData.append("chgi", changeimg);
    
    
    var params = {
            type: 'POST',
            withFile: true,
            module: 'actionsproducts',
            action: 'update',
            data: formData
    }
    
    $('#preload-publish').show();

    invoke(params, updateProduct_Ok, updateProduct_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function deleteProduct_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            break;

        case 'OK':
            actionOnClick(_SITE_URL + 'products', 'dashboard-main-area-right', 'min');
            break;            
   }
}

function deleteProduct_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
}

function deleteProduct(diverror) {

	paramsArray[0] = diverror;
    
    var data = {
        code: codpro,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsproducts',
            action: 'delete',
            data: data
    }

    invoke(params, deleteProduct_Ok, deleteProduct_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/



/*******************************************************************/

function viewRecentSearch() {

     var data = {
        action: 'recentsearchtop',
    }

    $.ajax({
        type: 'POST',
        url: _SITE_URL + 'services/actionssearch',
        data: data,
        success: function(response) {
           switch (response.status) {
                case 'ERROR':
                    break;
                case 'OK':
                    $('#inside-info-search').html(response.result_search);
                    $('#link-more-search-top').attr('href', _SITE_URL + 'search/q:' + response.the_query);
                    break;            
           }
        }
    });    

}

/*******************************************************************/

$(document).on('click', '.the-smiles-chat', function() {
    $(this).next('.menusmiles-chat').toggle();
});

$(document).on('click', function(e) {
    if ($(e.target).hasClass('the-smiles-chat') || $(e.target).parents('.the-smiles-chat').length > 0 || $(e.target).hasClass('menusmiles-chat') || $(e.target).parents('.menusmiles-chat').length > 0) return;
    $('.menusmiles-chat').hide();
});

/*******************************************************************/


$(document).on('click', '.the-stickers-chat', function() {
    $(this).next('.menustickers-chat').toggle();
});

$(document).on('click', function(e) {
    if ($(e.target).hasClass('the-stickers-chat') || $(e.target).parents('.the-stickers-chat').length > 0 || $(e.target).hasClass('menustickers-chat') || $(e.target).parents('.menustickers-chat').length > 0) return;
    $('.menustickers-chat').hide();
});

/*******************************************************************/

$(document).on('click', '.ico-stickerscom', function() {
    $(this).next('.menustickers-comment').toggle();
});

$(document).on('click', function(e) {
    if ($(e.target).hasClass('ico-stickerscom') || $(e.target).parents('.ico-stickerscom').length > 0 || $(e.target).hasClass('menustickers-comment') || $(e.target).parents('.menustickers-comment').length > 0) return;
    $('.menustickers-comment').hide();
});

/*******************************************************************/


/*******************************************************************/
/* START version 1.0.1 */

function loadcategorymarket_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            $(paramsArray[0]).html(response.categories);
            $(paramsArray[0]).removeAttr('disabled');
            break;            
   }
}

function loadcategorymarket_Error(response) {
}

function loadcategorymarket(idcat, msgcategory, msgsubcategory, divcategories, divsubcategories) {
	$(divcategories).html('<option value="-1">' + msgcategory + '</option>');
	$(divcategories).attr('disabled','true');
	$(divsubcategories).html('<option value="0">' + msgsubcategory + '</option>');
    
	paramsArray[0] = divcategories;
    
    var data = {
        idc: idcat,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'getcategories',
            action: 'market',
            data: data
    }

    invoke(params, loadcategorymarket_Ok, loadcategorymarket_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function loadsubcategorymarket_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            $(paramsArray[1]).html(response.subcategories);
            $(paramsArray[1]).removeAttr('disabled');
            break;            
   }
}

function loadsubcategorymarket_Error(response) {
}

function loadsubcategorymarket(idcat, idsubcat, msgcsubcategory, divsubcategories) {	
	$(divsubcategories).html('<option value="-1">' + msgcsubcategory + '</option>');
	$(divsubcategories).attr('disabled','true');
    
	paramsArray[1] = divsubcategories;
    
    var data = {
        idc: idcat,
        idsc: idsubcat,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'getsubcategories',
            action: 'market',
            data: data
    }

    invoke(params, loadsubcategorymarket_Ok, loadsubcategorymarket_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/


function loadcategorylibrary_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            $(paramsArray[0]).html(response.categories);
            $(paramsArray[0]).removeAttr('disabled');
            break;            
   }
}

function loadcategorylibrary_Error(response) {
}

function loadcategorylibrary(idcat, msgcategory, msgsubcategory, divcategories, divsubcategories) {
	$(divcategories).html('<option value="-1">' + msgcategory + '</option>');
	$(divcategories).attr('disabled','true');
	$(divsubcategories).html('<option value="0">' + msgsubcategory + '</option>');
    
	paramsArray[0] = divcategories;
    
    var data = {
        idc: idcat,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'getcategories',
            action: 'library',
            data: data
    }

    invoke(params, loadcategorylibrary_Ok, loadcategorylibrary_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function loadsubcategorylibrary_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            $(paramsArray[1]).html(response.subcategories);
            $(paramsArray[1]).removeAttr('disabled');
            break;            
   }
}

function loadsubcategorylibrary_Error(response) {
}

function loadsubcategorylibrary(idcat, idsubcat, msgcsubcategory, divsubcategories) {	
	$(divsubcategories).html('<option value="-1">' + msgcsubcategory + '</option>');
	$(divsubcategories).attr('disabled','true');
    
	paramsArray[1] = divsubcategories;
    
    var data = {
        idc: idcat,
        idsc: idsubcat,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'getsubcategories',
            action: 'library',
            data: data
    }

    invoke(params, loadsubcategorylibrary_Ok, loadsubcategorylibrary_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function createAlbum_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            $('#preload-publish').hide();
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            actionOnClick(_SITE_URL + 'albums', 'dashboard-main-area-right', 'min');
            break;
   }
}

function createAlbum_Error(response) {
    $('#preload-publish').hide();
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function createAlbum(diverror, bsubmit) {

    $(bsubmit).attr('disabled','true');

    paramsArray[0] = diverror;
    paramsArray[1] = bsubmit;
    
	titlealbum = validationInput('empty', '#titlealbum', diverror, txt_error_title, bsubmit, false);
	if (!titlealbum) return;

	descriptionalbum = $('#descriptionalbum').val();

	privacyalbum = validationInput('zeroandpositive', '#privacyalbum', diverror, txt_error_privacy, bsubmit, false);
	if (!privacyalbum) return;
    
    numphotos = $('#numphotos').val();
    
    if (numphotos > 0) {
        
        thefile = $('#filesphotos').val();
        
        var thephotos = document.getElementById('filesphotos').files;
        
        errorformat = false;
        
        for(x = 0; x < thephotos.length; x++) {
            var ext = thephotos[x].name.split('.').pop().toLowerCase();
            if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
                errorformat = true;
                break;
            }
        }
        if (errorformat) {
            openandclose(diverror, txt_error_formatphoto, 1700)
            setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500);
            return;
        }
        
    } else {
        openandclose(diverror, txt_error_photo, 1700)
        setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500);
        return;
    }

    var formData = new FormData(document.getElementById("form1"));
    
    var params = {
            type: 'POST',
            withFile: true,
            module: 'actionsalbums',
            action: 'create',
            data: formData
    }
    
    $('#preload-publish').show();

    invoke(params, createAlbum_Ok, createAlbum_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function updateAlbum_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            $('#preload-publish').hide();
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            actionOnClick(_SITE_URL + 'albums', 'dashboard-main-area-right', 'min');
            break;
   }
}

function updateAlbum_Error(response) {
    $('#preload-publish').hide();
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function updateAlbum(diverror, bsubmit) {

    $(bsubmit).attr('disabled','true');

    paramsArray[0] = diverror;
    paramsArray[1] = bsubmit;
    
	titlealbum = validationInput('empty', '#titlealbum', diverror, txt_error_title, bsubmit, false);
	if (!titlealbum) return;

	descriptionalbum = $('#descriptionalbum').val();

	privacyalbum = validationInput('zeroandpositive', '#privacyalbum', diverror, txt_error_privacy, bsubmit, false);
	if (!privacyalbum) return;

    var data = {
        tta: titlealbum,
        dca: descriptionalbum,
        pva: privacyalbum,
        cda: code_album,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsalbums',
            action: 'update',
            data: data
    }
    
    $('#preload-publish').show();

    invoke(params, updateAlbum_Ok, updateAlbum_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function deleteAlbum_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            break;

        case 'OK':
            actionOnClick(_SITE_URL + 'albums', 'dashboard-main-area-right', 'min');
            break;            
   }
}

function deleteAlbum_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
}

function deleteAlbum(diverror) {

	paramsArray[0] = diverror;
    
    var data = {
        code: code_album,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsalbums',
            action: 'delete',
            data: data
    }

    invoke(params, deleteAlbum_Ok, deleteAlbum_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function addPhotosAlbum_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            $('#preload-publish').hide();
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            actionOnClick(_SITE_URL + 'albums/photos/a:' + response.codealbum, 'dashboard-main-area-right', 'min');
            break;
   }
}

function addPhotosAlbum_Error(response) {
    $('#preload-publish').hide();
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function addPhotosAlbum(diverror, bsubmit) {

    $(bsubmit).attr('disabled','true');

    paramsArray[0] = diverror;
    paramsArray[1] = bsubmit;
    
    numphotos = $('#numphotos').val();
    
    if (numphotos > 0) {
        
        thefile = $('#filesphotos').val();
        
        var thephotos = document.getElementById('filesphotos').files;
        
        errorformat = false;
        
        for(x = 0; x < thephotos.length; x++) {
            var ext = thephotos[x].name.split('.').pop().toLowerCase();
            if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
                errorformat = true;
                break;
            }
        }
        if (errorformat) {
            openandclose(diverror, txt_error_formatphoto, 1700)
            setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500);
            return;
        }
        
    } else {
        openandclose(diverror, txt_error_photo, 1700)
        setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500);
        return;
    }

    var formData = new FormData(document.getElementById("form1"));
    formData.append("coda", code_album);
    
    var params = {
            type: 'POST',
            withFile: true,
            module: 'actionsalbums',
            action: 'addphotos',
            data: formData
    }
    
    $('#preload-publish').show();

    invoke(params, addPhotosAlbum_Ok, addPhotosAlbum_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function deletePhotosAlbum_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            alert(response.message);
            break;

        case 'OK':
            if (response.total == 1) {
                actionOnClick(_SITE_URL + 'albums', 'dashboard-main-area-right', 'min');
            } else {
                $("#photo_album_" + paramsArray[0]).fadeOut(500, function() { $("#photo_album_" + paramsArray[0]).remove(); });
            }
            break;
   }
}

function deletePhotosAlbum_Error(response) {
    alert(msg_error_conection);
}

function deletePhotosAlbum(codephoto) {
    
    paramsArray[0] = codephoto;

    var data = {
        codea: codealbum,
        codep: codephoto,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionsalbums',
            action: 'deletephoto',
            data: data
    }

    invoke(params, deletePhotosAlbum_Ok, deletePhotosAlbum_Error);

}

/* END version 1.0.1 */
/*__________________________________________________________________*/
/*__________________________________________________________________*/
