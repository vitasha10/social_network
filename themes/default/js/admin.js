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

_IN_ADMIN_PANEL = true;
_SPACE_FULL = true;

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

function updateGeneralSystem_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[1], response.html, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;            
   }
}

function updateGeneralSystem_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateGeneralSystem(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    sstatus = validationInput('zeroandpositive', '#sstatus', diverror, txt_error_option, bsubmit, true);
    if (!sstatus) return;

    sprivacy = validationInput('zeroandpositive', '#wprivacy', diverror, txt_error_option, bsubmit, true);
    if (!sprivacy) return;

    scompany = validationInput('empty', '#scompany', diverror, txt_error_company, bsubmit, true);
    if (!scompany) return;
    
	paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;

    var data = {
        sst: sstatus,
        spr: sprivacy,
        scny: scompany,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'system',
            data: data
    };

    invoke(params, updateGeneralSystem_Ok, updateGeneralSystem_Error);

}

/******************************************************/

function updateGeneralSEO_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[1], response.html, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;            
   }
}

function updateGeneralSEO_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateGeneralSEO(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    stitle = validationInput('empty', '#stitle', diverror, txt_error_title, bsubmit, true);
    if (!stitle) return;

    skeywords = validationInput('empty', '#skeywords', diverror, txt_error_keyword, bsubmit, true);
    if (!skeywords) return;

    sdescription = validationInput('empty', '#sdescription', diverror, txt_error_description, bsubmit, true);
    if (!sdescription) return;
    
	paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;

    var data = {
        stt: stitle,
        sky: skeywords,
        sdsc: sdescription,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'seo',
            data: data
    };

    invoke(params, updateGeneralSEO_Ok, updateGeneralSEO_Error);

}

/******************************************************/

function updateGeneralRegister_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[1], response.html, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;            
   }
}

function updateGeneralRegister_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateGeneralRegister(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    rvalidation = validationInput('zeroandpositive', '#rvalidation', diverror, txt_error_option, bsubmit, true);
    if (!rvalidation) return;

    minage = validationInput('zeroandpositive', '#minage', diverror, txt_error_min_age, bsubmit, true);
    if (!minage) return;

    maxage = validationInput('zeroandpositive', '#maxage', diverror, txt_error_max_age, bsubmit, true);
    if (!maxage) return;

    if (minage >= maxage) {
        openandclose(diverror, txt_error_mingreatermax, 1700)
        setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500);
        return;
    }

    lremember = validationInput('zeroandpositive', '#lremember', diverror, txt_error_option, bsubmit, true);
    if (!lremember) return;
    
	paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;

    var data = {
        rval: rvalidation,
        rmina: minage,
        rmaxa: maxage,
        rrem: lremember,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'register',
            data: data
    };

    invoke(params, updateGeneralRegister_Ok, updateGeneralRegister_Error);

}

/******************************************************/

function updateGeneralEmail_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[1], response.html, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;            
   }
}

function updateGeneralEmail_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateGeneralEmail(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    fromname = validationInput('empty', '#fromname', diverror, txt_error_fromname, bsubmit, true);
    if (!fromname) return;

    fromemail = validationInput('email', '#fromemail', diverror, txt_error_fromemail, bsubmit, true);
    if (!fromemail) return;

	paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;

    var data = {
        frn: fromname,
        fre: fromemail,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'email',
            data: data
    };

    invoke(params, updateGeneralEmail_Ok, updateGeneralEmail_Error);

}

/******************************************************/

function updateGeneralPHPMAILER_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[1], response.html, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;            
   }
}

function updateGeneralPHPMAILER_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateGeneralPHPMAILER(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');
    
    withphpmiler = validationInput('zeroandpositive', '#withphpmail', diverror, txt_error_option, bsubmit, true);
    if (!withphpmiler) return;

    mailhost = validationInput('empty', '#mailhost', diverror, txt_error_mailhost, bsubmit, true);
    if (!mailhost) return;

    mailport = validationInput('empty', '#mailport', diverror, txt_error_mailport, bsubmit, true);
    if (!mailport) return;

    musername = validationInput('email', '#musername', diverror, txt_error_musername, bsubmit, true);
    if (!musername) return;

    mpassword = validationInput('empty', '#mpassword', diverror, txt_error_mpassword, bsubmit, true);
    if (!mpassword) return;

	paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;

    var data = {
        wphpm: withphpmiler,
        mhost: mailhost,
        mport: mailport,
        muser: musername,
        mpass: mpassword,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'phpmailer',
            data: data
    };

    invoke(params, updateGeneralPHPMAILER_Ok, updateGeneralPHPMAILER_Error);

}

/******************************************************/

function updateGeneralFBLogin_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[1], response.html, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;            
   }
}

function updateGeneralFBLogin_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateGeneralFBLogin(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');
    
    withfblogin = validationInput('zeroandpositive', '#withfblogin', diverror, txt_error_option, bsubmit, true);
    if (!withfblogin) return;
    
    if (withfblogin == 1) {

        fbappid = validationInput('empty', '#fbappid', diverror, txt_error_appid, bsubmit, true);
        if (!fbappid) return;
    
        appsecret = validationInput('empty', '#appsecret', diverror, txt_error_appsecret, bsubmit, true);
        if (!appsecret) return;

    } else {
        fbappid = '';
        appsecret = '';
    }

	paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;

    var data = {
        wfbl: withfblogin,
        fbapi: fbappid,
        fbsec: appsecret,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'fblogin',
            data: data
    };

    invoke(params, updateGeneralFBLogin_Ok, updateGeneralFBLogin_Error);

}

/******************************************************/


function updateGeneralTWLogin_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[1], response.html, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;            
   }
}

function updateGeneralTWLogin_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateGeneralTWLogin(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');
    
    withtwlogin = validationInput('zeroandpositive', '#withtwlogin', diverror, txt_error_option, bsubmit, true);
    if (!withtwlogin) return;
    
    if (withtwlogin == 1) {

        twappid = validationInput('empty', '#twappid', diverror, txt_error_twappid, bsubmit, true);
        if (!twappid) return;
    
        twappsecret = validationInput('empty', '#twappsecret', diverror, txt_error_twappsecret, bsubmit, true);
        if (!twappsecret) return;

        twdomain = validationInput('empty', '#twdomain', diverror, txt_error_twdomain, bsubmit, true);
        if (!twdomain) return;

    } else {
        twappid = '';
        twappsecret = '';
        twdomain = '';
    }

	paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;

    var data = {
        wtwl: withtwlogin,
        twapi: twappid,
        twsec: twappsecret,
        twdom: twdomain,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'twlogin',
            data: data
    };

    invoke(params, updateGeneralTWLogin_Ok, updateGeneralTWLogin_Error);

}

/******************************************************/

function updateTheme_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[1], response.html, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;            
   }
}

function updateTheme_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateTheme(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    thetheme = validationInput('empty', '#thetheme', diverror, txt_error_option, bsubmit, true);
    if (!thetheme) return;
    
	paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;

    var data = {
        them: thetheme,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'theme',
            data: data
    };

    invoke(params, updateTheme_Ok, updateTheme_Error);

}

/******************************************************/

function updateLanguage_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[1], response.html, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;            
   }
}

function updateLanguage_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateLanguage(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    thelang = validationInput('empty', '#thelang', diverror, txt_error_option, bsubmit, true);
    if (!thelang) return;
    
	paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;

    var data = {
        lang: thelang,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'language',
            data: data
    };

    invoke(params, updateLanguage_Ok, updateLanguage_Error);

}

/******************************************************/

function createCategoryPage_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            actionOnClick(_SITE_URL + 'admin/pages/categories', 'dashboard-main-area-right', 'min');
            break;            
   }
}

function createCategoryPage_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function createCategoryPage(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    namecat = validationInput('empty', '#namecat', diverror, txt_error_name, bsubmit, true);
    if (!namecat) return;
    
	paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;

    var data = {
        ncat: namecat,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'addcatpage',
            data: data
    };

    invoke(params, createCategoryPage_Ok, createCategoryPage_Error);

}

/******************************************************/

function deleteCategoryPage_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose('#errorcat-' + paramsArray[0], response.message, 1700);
            break;

        case 'OK':
            $('#onecat-' + paramsArray[0]).fadeOut(500, function() { $('#onecat-' + paramsArray[0]).remove(); });
            break;            
   }
}

function deleteCategoryPage_Error(response) {
    openandclose('#errorcat-' + paramsArray[0], msg_error_conection, 1700);
}

function deleteCategoryPage(idcategory) {
    
	paramsArray[0] = idcategory;

    var data = {
        idcat: idcategory,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'deletecatpage',
            data: data
    };

    invoke(params, deleteCategoryPage_Ok, deleteCategoryPage_Error);

}

/******************************************************/

function updateCategoryPage_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            $('#textname' + paramsArray[2]).html(paramsArray[3]);
            $('#namecategory' + paramsArray[2]).val(paramsArray[3]);
            $('#areaedit-' + paramsArray[2]).slideUp('slow', function(){
                $('#spacecat-' + paramsArray[2]).slideDown('slow');
            });

            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;
   }
}

function updateCategoryPage_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function updateCategoryPage(idcategory) {
    
    diverror = '#msgerrorcat' + idcategory;
    bsubmit = '#bupdate' +  idcategory;

	$(bsubmit).attr('disabled','true');

    namecategory = validationInput('empty', '#namecategory' + idcategory, diverror, text_error_name_category, bsubmit, true);
    if (!namecategory) return;
    
	paramsArray[0] = diverror;
	paramsArray[1] = bsubmit;
	paramsArray[2] = idcategory;
	paramsArray[3] = namecategory;

    var data = {
        icat: idcategory,
        ncat: namecategory,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'updatecatpage',
            data: data
    };

    invoke(params, updateCategoryPage_Ok, updateCategoryPage_Error);

}

/******************************************************/

function createSubCategoryPage_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            actionOnClick(_SITE_URL + 'admin/pages/subcategories/c:' + paramsArray[3], 'dashboard-main-area-right', 'min');
            break;
   }
}

function createSubCategoryPage_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function createSubCategoryPage(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    namecat = validationInput('empty', '#namecat', diverror, txt_error_name, bsubmit, true);
    if (!namecat) return;

    idc= $('#idc').val();
    
	paramsArray[0] = diverror;
	paramsArray[1] = divok;
	paramsArray[2] = bsubmit;
	paramsArray[3] = idc;

    var data = {
        ncat: namecat,
        idc : idc,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'addsubcatpage',
            data: data
    };

    invoke(params, createSubCategoryPage_Ok, createSubCategoryPage_Error);

}

/******************************************************/

function deleteSubCategoryPage_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose('#errorcat-' + paramsArray[0], response.message, 1700);
            break;

        case 'OK':
            $('#onecat-' + paramsArray[0]).fadeOut(500, function() { $('#onecat-' + paramsArray[0]).remove(); });
            break;
   }
}

function deleteSubCategoryPage_Error(response) {
    openandclose('#errorcat-' + paramsArray[0], msg_error_conection, 1700);
}

function deleteSubCategoryPage(idsubcategory) {
    
	paramsArray[0] = idsubcategory;

    var data = {
        idscat: idsubcategory,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'deletesubcatpage',
            data: data
    };

    invoke(params, deleteSubCategoryPage_Ok, deleteSubCategoryPage_Error);

}

/******************************************************/

function updateSubCategoryPage_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            $('#textname' + paramsArray[2]).html(namecategory);
            $('#namecategory' + paramsArray[2]).val(namecategory);
            $('#areaedit-' + paramsArray[2]).slideUp('slow', function(){
                $('#spacecat-' + paramsArray[2]).slideDown('slow');
            });

            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;
   }
}

function updateSubCategoryPage_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function updateSubCategoryPage(idscategory) {
    
    diverror = '#msgerrorcat' + idscategory;
    bsubmit = '#bupdate' +  idscategory;

	$(bsubmit).attr('disabled','true');

    namecategory = validationInput('empty', '#namecategory' + idscategory, diverror, text_error_name_subcategory, bsubmit, true);
    if (!namecategory) return;
    
	paramsArray[0] = diverror;
	paramsArray[1] = bsubmit;
	paramsArray[2] = idscategory;

    var data = {
        iscat: idscategory,
        nscat: namecategory,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'updatesubcatpage',
            data: data
    };

    invoke(params, updateSubCategoryPage_Ok, updateSubCategoryPage_Error);

}

/******************************************************/

function createCategoryProduct_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            actionOnClick(_SITE_URL + 'admin/products/categories', 'dashboard-main-area-right', 'min');
            break;            
   }
}

function createCategoryProduct_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function createCategoryProduct(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    namecat = validationInput('empty', '#namecat', diverror, txt_error_name, bsubmit, true);
    if (!namecat) return;
    
	paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;

    var data = {
        ncat: namecat,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'addcatproduct',
            data: data
    };

    invoke(params, createCategoryProduct_Ok, createCategoryProduct_Error);

}

/******************************************************/

function deleteCategoryProduct_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose('#errorcat-' + paramsArray[0], response.message, 1700);
            break;

        case 'OK':
            $('#onecat-' + paramsArray[0]).fadeOut(500, function() { $('#onecat-' + paramsArray[0]).remove(); });
            break;            
   }
}

function deleteCategoryProduct_Error(response) {
    openandclose('#errorcat-' + paramsArray[0], msg_error_conection, 1700);
}

function deleteCategoryProduct(idcategory) {
    
	paramsArray[0] = idcategory;

    var data = {
        idcat: idcategory,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'deletecatproduct',
            data: data
    };

    invoke(params, deleteCategoryProduct_Ok, deleteCategoryProduct_Error);

}

/******************************************************/

function updateCategoryProduct_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            $('#textname' + paramsArray[2]).html(paramsArray[3]);
            $('#namecategory' + paramsArray[2]).val(paramsArray[3]);
            $('#areaedit-' + paramsArray[2]).slideUp('slow', function(){
                $('#spacecat-' + paramsArray[2]).slideDown('slow');
            });

            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;
   }
}

function updateCategoryProduct_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function updateCategoryProduct(idcategory) {
    
    diverror = '#msgerrorcat' + idcategory;
    bsubmit = '#bupdate' +  idcategory;

	$(bsubmit).attr('disabled','true');

    namecategory = validationInput('empty', '#namecategory' + idcategory, diverror, text_error_name_category, bsubmit, true);
    if (!namecategory) return;
    
	paramsArray[0] = diverror;
	paramsArray[1] = bsubmit;
	paramsArray[2] = idcategory;
	paramsArray[3] = namecategory;

    var data = {
        icat: idcategory,
        ncat: namecategory,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'updatecatproduct',
            data: data
    };

    invoke(params, updateCategoryProduct_Ok, updateCategoryProduct_Error);

}

/******************************************************/

function createSubCategoryProduct_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            actionOnClick(_SITE_URL + 'admin/products/subcategories/c:' + paramsArray[3], 'dashboard-main-area-right', 'min');
            break;
   }
}

function createSubCategoryProduct_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function createSubCategoryProduct(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    namecat = validationInput('empty', '#namecat', diverror, txt_error_name, bsubmit, true);
    if (!namecat) return;

    idc= $('#idc').val();
    
	paramsArray[0] = diverror;
	paramsArray[1] = divok;
	paramsArray[2] = bsubmit;
	paramsArray[3] = idc;

    var data = {
        ncat: namecat,
        idc : idc,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'addsubcatproduct',
            data: data
    };

    invoke(params, createSubCategoryProduct_Ok, createSubCategoryProduct_Error);

}

/******************************************************/

function deleteSubCategoryProduct_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose('#errorcat-' + paramsArray[0], response.message, 1700);
            break;

        case 'OK':
            $('#onecat-' + paramsArray[0]).fadeOut(500, function() { $('#onecat-' + paramsArray[0]).remove(); });
            break;
   }
}

function deleteSubCategoryProduct_Error(response) {
    openandclose('#errorcat-' + paramsArray[0], msg_error_conection, 1700);
}

function deleteSubCategoryProduct(idsubcategory) {
    
	paramsArray[0] = idsubcategory;

    var data = {
        idscat: idsubcategory,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'deletesubcatproduct',
            data: data
    };

    invoke(params, deleteSubCategoryProduct_Ok, deleteSubCategoryProduct_Error);

}

/******************************************************/

function updateSubCategoryProduct_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            $('#textname' + paramsArray[2]).html(namecategory);
            $('#namecategory' + paramsArray[2]).val(namecategory);
            $('#areaedit-' + paramsArray[2]).slideUp('slow', function(){
                $('#spacecat-' + paramsArray[2]).slideDown('slow');
            });

            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;
   }
}

function updateSubCategoryProduct_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function updateSubCategoryProduct(idscategory) {
    
    diverror = '#msgerrorcat' + idscategory;
    bsubmit = '#bupdate' +  idscategory;

	$(bsubmit).attr('disabled','true');

    namecategory = validationInput('empty', '#namecategory' + idscategory, diverror, text_error_name_subcategory, bsubmit, true);
    if (!namecategory) return;
    
	paramsArray[0] = diverror;
	paramsArray[1] = bsubmit;
	paramsArray[2] = idscategory;

    var data = {
        iscat: idscategory,
        nscat: namecategory,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'updatesubcatproduct',
            data: data
    };

    invoke(params, updateSubCategoryProduct_Ok, updateSubCategoryProduct_Error);

}




/******************************************************/

function createCategoryArticle_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            actionOnClick(_SITE_URL + 'admin/articles/categories', 'dashboard-main-area-right', 'min');
            break;            
   }
}

function createCategoryArticle_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function createCategoryArticle(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    namecat = validationInput('empty', '#namecat', diverror, txt_error_name, bsubmit, true);
    if (!namecat) return;
    
	paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;

    var data = {
        ncat: namecat,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'addcatarticle',
            data: data
    };

    invoke(params, createCategoryArticle_Ok, createCategoryArticle_Error);

}

/******************************************************/

function deleteCategoryArticle_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose('#errorcat-' + paramsArray[0], response.message, 1700);
            break;

        case 'OK':
            $('#onecat-' + paramsArray[0]).fadeOut(500, function() { $('#onecat-' + paramsArray[0]).remove(); });
            break;            
   }
}

function deleteCategoryArticle_Error(response) {
    openandclose('#errorcat-' + paramsArray[0], msg_error_conection, 1700);
}

function deleteCategoryArticle(idcategory) {
    
	paramsArray[0] = idcategory;

    var data = {
        idcat: idcategory,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'deletecatarticle',
            data: data
    };

    invoke(params, deleteCategoryArticle_Ok, deleteCategoryArticle_Error);

}

/******************************************************/

function updateCategoryArticle_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            $('#textname' + paramsArray[2]).html(paramsArray[3]);
            $('#namecategory' + paramsArray[2]).val(paramsArray[3]);
            $('#areaedit-' + paramsArray[2]).slideUp('slow', function(){
                $('#spacecat-' + paramsArray[2]).slideDown('slow');
            });

            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;
   }
}

function updateCategoryArticle_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function updateCategoryArticle(idcategory) {
    
    diverror = '#msgerrorcat' + idcategory;
    bsubmit = '#bupdate' +  idcategory;

	$(bsubmit).attr('disabled','true');

    namecategory = validationInput('empty', '#namecategory' + idcategory, diverror, text_error_name_category, bsubmit, true);
    if (!namecategory) return;
    
	paramsArray[0] = diverror;
	paramsArray[1] = bsubmit;
	paramsArray[2] = idcategory;
	paramsArray[3] = namecategory;

    var data = {
        icat: idcategory,
        ncat: namecategory,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'updatecatarticle',
            data: data
    };

    invoke(params, updateCategoryArticle_Ok, updateCategoryArticle_Error);

}

/******************************************************/

function createSubCategoryArticle_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            actionOnClick(_SITE_URL + 'admin/articles/subcategories/c:' + paramsArray[3], 'dashboard-main-area-right', 'min');
            break;
   }
}

function createSubCategoryArticle_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function createSubCategoryArticle(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    namecat = validationInput('empty', '#namecat', diverror, txt_error_name, bsubmit, true);
    if (!namecat) return;

    idc= $('#idc').val();
    
	paramsArray[0] = diverror;
	paramsArray[1] = divok;
	paramsArray[2] = bsubmit;
	paramsArray[3] = idc;

    var data = {
        ncat: namecat,
        idc : idc,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'addsubcatarticle',
            data: data
    };

    invoke(params, createSubCategoryArticle_Ok, createSubCategoryArticle_Error);

}

/******************************************************/

function deleteSubCategoryArticle_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose('#errorcat-' + paramsArray[0], response.message, 1700);
            break;

        case 'OK':
            $('#onecat-' + paramsArray[0]).fadeOut(500, function() { $('#onecat-' + paramsArray[0]).remove(); });
            break;
   }
}

function deleteSubCategoryArticle_Error(response) {
    openandclose('#errorcat-' + paramsArray[0], msg_error_conection, 1700);
}

function deleteSubCategoryArticle(idsubcategory) {
    
	paramsArray[0] = idsubcategory;

    var data = {
        idscat: idsubcategory,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'deletesubcatarticle',
            data: data
    };

    invoke(params, deleteSubCategoryArticle_Ok, deleteSubCategoryArticle_Error);

}

/******************************************************/

function updateSubCategoryArticle_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            $('#textname' + paramsArray[2]).html(namecategory);
            $('#namecategory' + paramsArray[2]).val(namecategory);
            $('#areaedit-' + paramsArray[2]).slideUp('slow', function(){
                $('#spacecat-' + paramsArray[2]).slideDown('slow');
            });

            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;
   }
}

function updateSubCategoryArticle_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function updateSubCategoryArticle(idscategory) {
    
    diverror = '#msgerrorcat' + idscategory;
    bsubmit = '#bupdate' +  idscategory;

	$(bsubmit).attr('disabled','true');

    namecategory = validationInput('empty', '#namecategory' + idscategory, diverror, text_error_name_subcategory, bsubmit, true);
    if (!namecategory) return;
    
	paramsArray[0] = diverror;
	paramsArray[1] = bsubmit;
	paramsArray[2] = idscategory;

    var data = {
        iscat: idscategory,
        nscat: namecategory,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'updatesubcatarticle',
            data: data
    };

    invoke(params, updateSubCategoryArticle_Ok, updateSubCategoryArticle_Error);

}

/******************************************************/

function deleteUser_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            alert(response.message);
            break;

        case 'OK':
            $('#user-' + paramsArray[0]).fadeOut(500, function() { $('#user-' + paramsArray[0]).remove(); });
            $('#num_items').html(parseInt($('#num_items').html()) - 1);
            break;
   }
}

function deleteUser_Error(response) {
    alert(msg_error_conection);
}

function deleteUser(iduser) {
    
    paramsArray[0] = iduser;
    
    var data = {
        iduser: iduser,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'deleteuser',
            data: data
    };

    invoke(params, deleteUser_Ok, deleteUser_Error);

}

/******************************************************/

function updateUserGeneral_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[1], response.html, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;
   }
}

function updateUserGeneral_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateUserGeneral(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    verify = validationInput('zeroandpositive', '#verify', diverror, txt_error_option, bsubmit, true);
    if (!verify) return;

    status = validationInput('zeroandpositive', '#status', diverror, txt_error_option, bsubmit, true);
    if (!status) return;

    level = validationInput('zeroandpositive', '#level', diverror, txt_error_option, bsubmit, true);
    if (!level) return;
    
    paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;
    
    var data = {
        ver: verify,
        sta: status,
        lev: level,
        idu: idu,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'usergeneral',
            data: data
    };

    invoke(params, updateUserGeneral_Ok, updateUserGeneral_Error);

}

/******************************************************/

function updateUserProfile_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[1], response.html, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;
   }
}

function updateUserProfile_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateUserProfile(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    firstname = validationInput('empty', '#firstname', diverror, txt_error_firstname, bsubmit, true);
    if (!firstname) return;

    lastname = validationInput('empty', '#lastname', diverror, txt_error_lastname, bsubmit, true);
    if (!lastname) return;

    gender = validationInput('positive', '#gender', diverror, txt_error_sex, bsubmit, true);
    if (!gender) return;

	day = $('#day').val();
	month = $('#month').val();	
	year = $('#year').val();
	if (day == 0 || month == 0 || year == 0) {
		openandclose(diverror, txt_error_birthday, 1700);
		$('#year').focus();
		setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 2500); 
		return;
	}

	xday = day;
	xmonth = month;
	if (day<10) xday='0' + day;
	if (month<10) xmonth='0' + month;
	caddate = xday + '/' + xmonth + '/' + year;
	if (!validateDate(caddate)) {
		openandclose(diverror, txt_error_birthday2, 1700);
		$('#year').focus();
		setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 2500); 
		return;
	}

    currentcity = validationInput('empty', '#currentcity', diverror, txt_error_currentcity, bsubmit, true);
    if (!currentcity) return;

    hometown = validationInput('empty', '#hometown', diverror, txt_error_hometown, bsubmit, true);
    if (!hometown) return;
        
    paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;
    
    var data = {
        fn: firstname,
        ln: lastname,
        ge: gender,
        bi: year + '-' + xmonth + '-' + xday,
        cc: currentcity,
        ht: hometown,
        idu: idu,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'userprofile',
            data: data
    };

    invoke(params, updateUserProfile_Ok, updateUserProfile_Error);

}

/******************************************************/

function updateUserEmail_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[1], response.html, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;
   }
}

function updateUserEmail_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateUserEmail(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    email = validationInput('email', '#email', diverror, txt_error_email, bsubmit, true);
    if (!email) return;
    
    paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;
    
    var data = {
        em: email,
        idu: idu,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'useremail',
            data: data
    };

    invoke(params, updateUserEmail_Ok, updateUserEmail_Error);

}

/******************************************************/

function updateUserUsername_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[1], response.html, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;
   }
}

function updateUserUsername_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateUserUsername(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    username = validationInput('empty', '#username', diverror, txt_error_username, bsubmit, true);
    if (!username) return;

    username = validationInput('username', '#username', diverror, txt_error_notvalid, bsubmit, true);
    if (!username) return;
    
    paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;
    
    var data = {
        un: username,
        idu: idu,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'userusername',
            data: data
    };

    invoke(params, updateUserUsername_Ok, updateUserUsername_Error);

}

/******************************************************/

function updateUserPassword_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            $('#password').val('');
            $('#password').focus();
            openandclose(paramsArray[1], response.html, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;
   }
}

function updateUserPassword_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateUserPassword(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    pnew = validationInput('password', '#password', diverror, txt_error_pnew, bsubmit, true);
    if (!pnew) return;
    
    paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;
    
    var data = {
        pn: '' + CryptoJS.MD5(pnew) + '',
        idu: idu,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'userpassword',
            data: data
    };

    invoke(params, updateUserPassword_Ok, updateUserPassword_Error);

}

/******************************************************/

function updateUserPrivacy_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[1], response.html, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;
   }
}

function updateUserPrivacy_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateUserPrivacy(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    pprofile = validationInput('number', '#pprofile', diverror, txt_error_option, bsubmit, false);
    if (!pprofile) return;

    pwritewall = validationInput('number', '#pwritewall', diverror, txt_error_option, bsubmit, false);
    if (!pwritewall) return;

    pseefriends = validationInput('number', '#pseefriends', diverror, txt_error_option, bsubmit, false);
    if (!pseefriends) return;

    pseepages = validationInput('number', '#pseepages', diverror, txt_error_option, bsubmit, false);
    if (!pseepages) return;

    pseegroups = validationInput('number', '#pseegroups', diverror, txt_error_option, bsubmit, false);
    if (!pseegroups) return;

    pmessages = validationInput('number', '#pmessages', diverror, txt_error_option, bsubmit, false);
    if (!pmessages) return;

    pbirthday = validationInput('number', '#pbirthday', diverror, txt_error_option, bsubmit, false);
    if (!pbirthday) return;

    plocation = validationInput('number', '#plocation', diverror, txt_error_option, bsubmit, false);
    if (!plocation) return;

    paboutme = validationInput('number', '#paboutme', diverror, txt_error_option, bsubmit, false);
    if (!paboutme) return;

    pchat = validationInput('number', '#pchat', diverror, txt_error_option, bsubmit, false);
    if (!pchat) return;    

    paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;
    
    var data = {
        ppro: pprofile,
        pwri: pwritewall,
        psfr: pseefriends,
        pspa: pseepages,
        psgr: pseegroups,
        pmes: pmessages,
        pbir: pbirthday,
        ploc: plocation,
        pabo: paboutme,
        pcha: pchat,
        idu: idu,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'userprivacy',
            data: data
    };

    invoke(params, updateUserPrivacy_Ok, updateUserPrivacy_Error);

}


/******************************************************/

function deletePage_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            alert(response.message);
            break;

        case 'OK':
            $('#page-' + paramsArray[0]).fadeOut(500, function() { $('#page-' + paramsArray[0]).remove(); });
            $('#num_items').html(parseInt($('#num_items').html()) - 1);
            break;
   }
}

function deletePage_Error(response) {
    alert(msg_error_conection);
}

function deletePage(idpage) {
    
    paramsArray[0] = idpage;
    
    var data = {
        idpage: idpage,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'deletepage',
            data: data
    };

    invoke(params, deletePage_Ok, deletePage_Error);

}


/******************************************************/

function updatePageGeneral_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[1], response.html, 1700)
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;
   }
}

function updatePageGeneral_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updatePageGeneral(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    verify = validationInput('zeroandpositive', '#verify', diverror, txt_error_option, bsubmit, true);
    if (!verify) return;

	idcategory = validationInput('positive', '#categorypage', diverror, txt_choose_category, bsubmit, true);
	if (!idcategory) return;

	idsubcategory = validationInput('positive', '#subcategorypage', diverror, txt_choose_subcategory, bsubmit, true);
	if (!idsubcategory) return;

	titlepage = validationInput('empty', '#titlepage', diverror, txt_enter_title, bsubmit, true);
	if (!titlepage) return;

	urlpage = validationInput('empty', '#urlpage', diverror, txt_enter_url, bsubmit, true);
	if (!urlpage) return;

	urlpage = validationInput('pageorgroup', '#urlpage', diverror, txt_url_invalid, bsubmit, true);
	if (!urlpage) return;

	descriptionpage = validationInput('empty', '#descriptionpage', diverror, txt_enter_description, bsubmit, true);
	if (!descriptionpage) return;
    
    paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;
    
    var data = {
        ver: verify,
        pic: idcategory,
        pisc: idsubcategory,
        pti: titlepage,
        pur: urlpage,
        pds: descriptionpage,
        idp: idp,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'updatepagesgeneral',
            data: data
    };

    invoke(params, updatePageGeneral_Ok, updatePageGeneral_Error);

}


/******************************************************/

function deleteGroup_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            alert(response.message);
            break;

        case 'OK':
            $('#group-' + paramsArray[0]).fadeOut(500, function() { $('#group-' + paramsArray[0]).remove(); });
            $('#num_items').html(parseInt($('#num_items').html()) - 1);
            break;
   }
}

function deleteGroup_Error(response) {
    alert(msg_error_conection);
}

function deleteGroup(idgroup) {
    
    paramsArray[0] = idgroup;
    
    var data = {
        idgroup: idgroup,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'deletegroup',
            data: data
    };

    invoke(params, deleteGroup_Ok, deleteGroup_Error);

}

/******************************************************/

function updateGroupGeneral_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[1], response.html, 1700)
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;
   }
}

function updateGroupGeneral_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateGroupGeneral(diverror, divok, bsubmit) {
    
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
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;
    
    var data = {
        gti: titlegroup,
        gur: urlgroup,
        gds: descriptiongroup,
        gpr: privacygroup,
        idg: idg,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'updategroupsgeneral',
            data: data
    };

    invoke(params, updateGroupGeneral_Ok, updateGroupGeneral_Error);

}

/******************************************************/

function createStaticPage_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            actionOnClick(_SITE_URL + 'admin/static-pages', 'dashboard-main-area-right', 'min');
            break;
   }
}

function createStaticPage_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function createStaticPage(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    urlstatic = validationInput('url_static', '#urlstatic', diverror, txt_error_url, bsubmit, true);
    if (!urlstatic) return;

    titlestatic = validationInput('empty', '#titlestatic', diverror, txt_error_title, bsubmit, true);
    if (!titlestatic) return;

    htmlstatic = validationInput('empty', '#htmlstatic', diverror, txt_error_html, bsubmit, true);
    if (!htmlstatic) return;

    infootstatic = $('#infootstatic').val();
    
    paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;
    
    var data = {
        us: urlstatic,
        ts: titlestatic,
        hs: htmlstatic,
        ifs : infootstatic,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'addstaticpage',
            data: data
    };

    invoke(params, createStaticPage_Ok, createStaticPage_Error);

}

/******************************************************/

function updateStaticPage_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[1], response.html, 1700)
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;
   }
}

function updateStaticPage_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateStaticPage(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    urlstatic = validationInput('url_static', '#urlstatic', diverror, txt_error_url, bsubmit, true);
    if (!urlstatic) return;

    titlestatic = validationInput('empty', '#titlestatic', diverror, txt_error_title, bsubmit, true);
    if (!titlestatic) return;

    htmlstatic = validationInput('empty', '#htmlstatic', diverror, txt_error_html, bsubmit, true);
    if (!htmlstatic) return;

    infootstatic = $('#infootstatic').val();
    
    paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;
    
    var data = {
        ids: id_staticpage,
        us: urlstatic,
        ts: titlestatic,
        hs: htmlstatic,
        ifs : infootstatic,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'updatestaticpage',
            data: data
    };

    invoke(params, updateStaticPage_Ok, updateStaticPage_Error);

}

/******************************************************/

function deleteStaticPage_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            alert(response.message);
            break;

        case 'OK':
            $('#static-' + paramsArray[0]).fadeOut(500, function() { $('#static-' + paramsArray[0]).remove(); });
            $('#num_items').html(parseInt($('#num_items').html()) - 1);
            break;
   }
}

function deleteStaticPage_Error(response) {
    alert(msg_error_conection);
}

function deleteStaticPage(idsp) {
    
    paramsArray[0] = idsp;
    
    var data = {
        idsp: idsp,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'deletestaticpage',
            data: data
    };

    invoke(params, deleteStaticPage_Ok, deleteStaticPage_Error);

}

/******************************************************/

function createCurrency_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            actionOnClick(_SITE_URL + 'admin/currencies', 'dashboard-main-area-right', 'min');
            break;            
   }
}

function createCurrency_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function createCurrency(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    namecurrency = validationInput('empty', '#namecurrency', diverror, txt_error_name, bsubmit, true);
    if (!namecurrency) return;

    codecurrency = validationInput('empty', '#codecurrency', diverror, txt_error_code, bsubmit, true);
    if (!codecurrency) return;

    symbolcurrency = validationInput('empty', '#symbolcurrency', diverror, txt_error_symbol, bsubmit, true);
    if (!symbolcurrency) return;
    
	paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;

    var data = {
        namec: namecurrency,
        codec: codecurrency,
        symbc: symbolcurrency,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'addcurrency',
            data: data
    };

    invoke(params, createCurrency_Ok, createCurrency_Error);

}

/******************************************************/

function deleteCurrency_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            alert(response.message);
            break;

        case 'OK':
            $('#onecurrency-' + paramsArray[0]).fadeOut(500, function() { $('#onecurrency-' + paramsArray[0]).remove(); });
            $('#num_items').html(parseInt($('#num_items').html()) - 1);
            break;
   }
}

function deleteCurrency_Error(response) {
    alert(msg_error_conection);
}

function deleteCurrency(idc) {
    
    paramsArray[0] = idc;
    
    var data = {
        idc: idc,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'deletecurrency',
            data: data
    };

    invoke(params, deleteCurrency_Ok, deleteCurrency_Error);

}

/******************************************************/

function updateCurrency_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            actionOnClick(_SITE_URL + 'admin/currencies', 'dashboard-main-area-right', 'min');
            break;            
   }
}

function updateCurrency_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateCurrency(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    namecurrency = validationInput('empty', '#namecurrency', diverror, txt_error_name, bsubmit, true);
    if (!namecurrency) return;

    codecurrency = validationInput('empty', '#codecurrency', diverror, txt_error_code, bsubmit, true);
    if (!codecurrency) return;

    symbolcurrency = validationInput('empty', '#symbolcurrency', diverror, txt_error_symbol, bsubmit, true);
    if (!symbolcurrency) return;
    
	paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;

    var data = {
        idc: idc,
        namec: namecurrency,
        codec: codecurrency,
        symbc: symbolcurrency,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'updatecurrency',
            data: data
    };

    invoke(params, updateCurrency_Ok, updateCurrency_Error);

}

/******************************************************/

function createAds_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            if (paramsArray[2] == 1) actionOnClick(_SITE_URL + 'admin/ads/dashboard', 'dashboard-main-area-right', 'min');
            else actionOnClick(_SITE_URL + 'admin/ads/profile', 'dashboard-main-area-right', 'min');
            break;
   }
}

function createAds_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function createAds(diverror, divok, bsubmit, slot) {

    $(bsubmit).attr('disabled','true');

    paramsArray[0] = diverror;
    paramsArray[1] = bsubmit;
    paramsArray[2] = slot;
    
	nameads = validationInput('empty', '#nameads', diverror, txt_error_name, bsubmit, false);
	if (!nameads) return;
    
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

	urlads = validationInput('url', '#urlads', diverror, txt_error_url, bsubmit, false);
	if (!urlads) return;
    
	target = validationInput('zeroandpositive', '#target', diverror, txt_error_target, bsubmit, false);
	if (!target) return;


    var formData = new FormData(document.getElementById("form1"));
    formData.append("namea", nameads);
    formData.append("urla", urlads);
    formData.append("tara", target);
    formData.append("slot", slot);
    
    var params = {
            type: 'POST',
            withFile: true,
            module: 'admin',
            action: 'createads',
            data: formData
    }

    invoke(params, createAds_Ok, createAds_Error);

}

/******************************************************/

function deleteAds_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            alert(response.message);
            break;

        case 'OK':
            $('#oneads-' + paramsArray[0]).fadeOut(500, function() { $('#oneads-' + paramsArray[0]).remove(); });
            break;            
   }
}

function deleteAds_Error(response) {
    alert(msg_error_conection);
}

function deleteAds(id) {
    
	paramsArray[0] = id;

    var data = {
        idbasic: id,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'deleteads',
            data: data
    };

    invoke(params, deleteAds_Ok, deleteAds_Error);

}

/******************************************************/

function updateAds_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[2], response.themessage, 1700);
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;
   }
}

function updateAds_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function updateAds(diverror, divok, bsubmit) {

    $(bsubmit).attr('disabled','true');

    paramsArray[0] = diverror;
    paramsArray[1] = bsubmit;
    paramsArray[2] = divok;
    
	nameads = validationInput('empty', '#nameads', diverror, txt_error_name, bsubmit, false);
	if (!nameads) return;
    
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

	urlads = validationInput('url', '#urlads', diverror, txt_error_url, bsubmit, false);
	if (!urlads) return;
    
	target = validationInput('zeroandpositive', '#target', diverror, txt_error_target, bsubmit, false);
	if (!target) return;
    
	status = validationInput('zeroandpositive', '#status', diverror, txt_error_status, bsubmit, false);
	if (!status) return;

    var formData = new FormData(document.getElementById("form1"));
    formData.append("namea", nameads);
    formData.append("urla", urlads);
    formData.append("tara", target);
    formData.append("slot", slot);
    formData.append("idads", idads);
    formData.append("status", status);
    formData.append("chgi", changeimg);
    
    var params = {
            type: 'POST',
            withFile: true,
            module: 'admin',
            action: 'updateads',
            data: formData
    }

    invoke(params, updateAds_Ok, updateAds_Error);

}

/******************************************************/


function createGame_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            actionOnClick(_SITE_URL + 'admin/games', 'dashboard-main-area-right', 'min');
            break;
   }
}

function createGame_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function createGame(diverror, divok, bsubmit) {

    $(bsubmit).attr('disabled','true');

    paramsArray[0] = diverror;
    paramsArray[1] = bsubmit;
    
	namegame = validationInput('empty', '#namegame', diverror, txt_error_name, bsubmit, false);
	if (!namegame) return;
    
	urlgame = validationInput('url', '#urlgame', diverror, txt_error_url_game, bsubmit, false);
	if (!urlgame) return;
    
	urlowner = validationInput('url', '#urlowner', diverror, txt_error_url_owner, bsubmit, false);
	if (!urlowner) return;
    
    thefile = $('#imagenfile').val();
    if (thefile != '') {
        var ext = thefile.split('.').pop().toLowerCase();
        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            openandclose(diverror, txt_error_thumbnail_format, 1700)
            setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500);
            return;
        }
    } else {
        openandclose(diverror, txt_error_thumbnail, 1700)
        setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500);
        return;
    }

    var formData = new FormData(document.getElementById("form1"));
    formData.append("nameg", namegame);
    formData.append("urlgm", urlgame);
    formData.append("urlow", urlowner);
    
    var params = {
            type: 'POST',
            withFile: true,
            module: 'admin',
            action: 'creategame',
            data: formData
    }

    invoke(params, createGame_Ok, createGame_Error);

}

/******************************************************/

function deleteGame_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            alert(response.message);
            break;

        case 'OK':
            $('#onegame-' + paramsArray[0]).fadeOut(500, function() { $('#onegame-' + paramsArray[0]).remove(); });
            break;            
   }
}

function deleteGame_Error(response) {
    alert(msg_error_conection);
}

function deleteGame(id) {
    
	paramsArray[0] = id;

    var data = {
        idg: id,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'deletegame',
            data: data
    };

    invoke(params, deleteGame_Ok, deleteGame_Error);

}

/******************************************************/

function updateGame_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[2], response.themessage, 1700);
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;
   }
}

function updateGame_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function updateGame(diverror, divok, bsubmit) {

    $(bsubmit).attr('disabled','true');

    paramsArray[0] = diverror;
    paramsArray[1] = bsubmit;
    paramsArray[2] = divok;
    
	namegame = validationInput('empty', '#namegame', diverror, txt_error_name, bsubmit, false);
	if (!namegame) return;
    
	urlgame = validationInput('url', '#urlgame', diverror, txt_error_url_game, bsubmit, false);
	if (!urlgame) return;
    
	urlowner = validationInput('url', '#urlowner', diverror, txt_error_url_owner, bsubmit, false);
	if (!urlowner) return;
    
    changeimg = $('#changeimg').val();
    
    if (changeimg == '1') {
    
        thefile = $('#imagenfile').val();
        if (thefile != '') {
            var ext = thefile.split('.').pop().toLowerCase();
            if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
                openandclose(diverror, txt_error_thumbnail_format, 1700)
                setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500);
                return;
            }
        } else {
            openandclose(diverror, txt_error_thumbnail, 1700)
            setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500);
            return;
        }
        
    }

	status = validationInput('zeroandpositive', '#status', diverror, txt_error_status, bsubmit, false);
	if (!status) return;

    var formData = new FormData(document.getElementById("form1"));
    formData.append("nameg", namegame);
    formData.append("urlgm", urlgame);
    formData.append("urlow", urlowner);
    formData.append("idgam", idgame);
    formData.append("status", status);
    formData.append("chgi", changeimg);
    
    var params = {
            type: 'POST',
            withFile: true,
            module: 'admin',
            action: 'updategame',
            data: formData
    }

    invoke(params, updateGame_Ok, updateGame_Error);

}

/******************************************************/

function updateTimezone_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[1], response.html, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;            
   }
}

function updateTimezone_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateTimezone(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    timezone = validationInput('empty', '#timezone', diverror, txt_error_option, bsubmit, true);
    if (!timezone) return;
    
	paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;

    var data = {
        timez: timezone,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'timezone',
            data: data
    };

    invoke(params, updateTimezone_Ok, updateTimezone_Error);

}

/******************************************************/

function updateProduct_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[1], response.html, 1700)
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;
   }
}

function updateProduct_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateProduct(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

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
    
    paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;
    
    var data = {
        idpr: idproduct,
        namp: nameproduct,
        desp: descriptionproduct,
        idcp: idcategory,
        idsp: idsubcategory,
        typp: typeproduct,
        curp: currencyproduct,
        prip: priceproduct,
        locp: locationproduct,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'updateproduct',
            data: data
    };

    invoke(params, updateProduct_Ok, updateProduct_Error);

}

/******************************************************/

function deleteProduct_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            alert(response.message);
            break;

        case 'OK':
            $('#product-' + paramsArray[0]).fadeOut(500, function() { $('#product-' + paramsArray[0]).remove(); });
            $('#num_items').html(parseInt($('#num_items').html()) - 1);
            break;            
   }
}

function deleteProduct_Error(response) {
    alert(msg_error_conection);
}

function deleteProduct(idproduct) {
    
    paramsArray[0] = idproduct;
    
    var data = {
        idp: idproduct,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'deleteproduct',
            data: data
    }

    invoke(params, deleteProduct_Ok, deleteProduct_Error);

}

/******************************************************/


function updateArticle_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[1], response.html, 1700)
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;
   }
}

function updateArticle_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateArticle(diverror, divok, bsubmit) {

	$(bsubmit).attr('disabled','true');

	titlearticle = validationInput('empty', '#titlearticle', diverror, txt_error_title, bsubmit, false);
	if (!titlearticle) return;

	idcategory = validationInput('positive', '#categoryarticle', diverror, txt_error_category, bsubmit, false);
	if (!idcategory) return;

	idsubcategory = validationInput('positive', '#subcategoryarticle', diverror, txt_error_subcategory, bsubmit, false);
	if (!idsubcategory) return;

	summaryarticle = validationInput('empty', '#summaryarticle', diverror, txt_error_summary, bsubmit, false);
	if (!summaryarticle) return;
    
    paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;
    
    var data = {
        idea: idarticle,
        tta: titlearticle,
        idca: idcategory,
        idsca: idsubcategory,
        smrya: summaryarticle,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'updatearticle',
            data: data
    };

    invoke(params, updateArticle_Ok, updateArticle_Error);

}

/******************************************************/


function deleteArticle_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            alert(response.message);
            break;

        case 'OK':
            $('#article-' + paramsArray[0]).fadeOut(500, function() { $('#article-' + paramsArray[0]).remove(); });
            $('#num_items').html(parseInt($('#num_items').html()) - 1);
            break;            
   }
}

function deleteArticle_Error(response) {
    alert(msg_error_conection);
}

function deleteArticle(idarticle) {

    paramsArray[0] = idarticle;
    
    var data = {
        ida: idarticle,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'deletearticle',
            data: data
    }

    invoke(params, deleteArticle_Ok, deleteArticle_Error);

}

/******************************************************/


/******************************************************/
/******************************************************/
/* Version 1.1.5 */

function createAdsHTML_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            if (paramsArray[2] == 1) actionOnClick(_SITE_URL + 'admin/ads/dashboard', 'dashboard-main-area-right', 'min');
            else actionOnClick(_SITE_URL + 'admin/ads/profile', 'dashboard-main-area-right', 'min');
            break;
   }
}

function createAdsHTML_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function createAdsHTML(diverror, divok, bsubmit, slot) {

    $(bsubmit).attr('disabled','true');

    paramsArray[0] = diverror;
    paramsArray[1] = bsubmit;
    paramsArray[2] = slot;
    
	nameads = validationInput('empty', '#nameads2', diverror, txt_error_name, bsubmit, false);
	if (!nameads) return;

	codehtml = validationInput('empty', '#codehtml', diverror, txt_error_htmlcode, bsubmit, false);
	if (!codehtml) return;

    var data = {
        namea: nameads,
        chtml: codehtml,
        slot: slot,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'createadshtml',
            data: data
    }

    invoke(params, createAdsHTML_Ok, createAdsHTML_Error);

}

/******************************************************/

function updateAdsHTML_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[2], response.themessage, 1700);
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;
   }
}

function updateAdsHTML_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function updateAdsHTML(diverror, divok, bsubmit) {

    $(bsubmit).attr('disabled','true');

    paramsArray[0] = diverror;
    paramsArray[1] = bsubmit;
    paramsArray[2] = divok;
    
	nameads = validationInput('empty', '#nameads2', diverror, txt_error_name, bsubmit, false);
	if (!nameads) return;

	codehtml = validationInput('empty', '#codehtml', diverror, txt_error_htmlcode, bsubmit, false);
	if (!codehtml) return;

	status = validationInput('zeroandpositive', '#status2', diverror, txt_error_status, bsubmit, false);
	if (!status) return;

    var data = {
        namea: nameads,
        chtml: codehtml,
        status: status,
        slot: slot,
        idads: idads,
    }

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'updateadshtml',
            data: data
    }

    invoke(params, updateAdsHTML_Ok, updateAdsHTML_Error);

}

/******************************************************/

function createAdsHTML_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            if (paramsArray[2] == 1) actionOnClick(_SITE_URL + 'admin/ads/dashboard', 'dashboard-main-area-right', 'min');
            else actionOnClick(_SITE_URL + 'admin/ads/profile', 'dashboard-main-area-right', 'min');
            break;
   }
}

function createAdsHTML_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function createAdsHTML(diverror, divok, bsubmit, slot) {

    $(bsubmit).attr('disabled','true');

    paramsArray[0] = diverror;
    paramsArray[1] = bsubmit;
    paramsArray[2] = slot;
    
	nameads = validationInput('empty', '#nameads2', diverror, txt_error_name, bsubmit, false);
	if (!nameads) return;

	codehtml = validationInput('empty', '#codehtml', diverror, txt_error_htmlcode, bsubmit, false);
	if (!codehtml) return;

    var data = {
        namea: nameads,
        chtml: codehtml,
        slot: slot,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'createadshtml',
            data: data
    }

    invoke(params, createAdsHTML_Ok, createAdsHTML_Error);

}

/******************************************************/


function updateSidebarUsers_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[1], response.html, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;            
   }
}

function updateSidebarUsers_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateSidebarUsers(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    sidebarusers = validationInput('positive', '#sidebarusers', diverror, txt_error_option, bsubmit, true);
    if (!sidebarusers) return;

	paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;

    var data = {
        sbus: sidebarusers,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'sidebarusers',
            data: data
    };

    invoke(params, updateSidebarUsers_Ok, updateSidebarUsers_Error);

}

/* End Version 1.1.5 */
/******************************************************/
/******************************************************/



/******************************************************/
/******************************************************/
/* Version 1.1.7 */

function updateAppAndroid_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[2], response.html, 1700);
            setTimeout(function() {
                //$(paramsArray[1]).removeAttr('disabled'); 
                actionOnClick(_SITE_URL + 'admin/app-android', 'dashboard-main-area-right', 'min');
            }, 2500);
            break;
   }
}

function updateAppAndroid_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function updateAppAndroid(diverror, divok, bsubmit) {

    $(bsubmit).attr('disabled','true');

    paramsArray[0] = diverror;
    paramsArray[1] = bsubmit;
    paramsArray[2] = divok;
    
    numfilesapks = $('#numfilesapks').val();
    
    show_app = $('#show_app').val();
    if (show_app == 1) {
        
        if (numfilesapks == 0) {
            openandclose(diverror, txt_error_apk, 1700)
            setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500);
            return;
        }
        
        thefile = $('#filesapks').val();
        if (thefile != '') {
            var ext = thefile.split('.').pop().toLowerCase();
            if($.inArray(ext, ['apk']) == -1) {
                openandclose(diverror, txt_error_format_apk, 1700)
                setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500);
                return;
            }
        } else {
            openandclose(diverror, txt_error_apk, 1700)
            setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500);
            return;
        }
    }

    if (show_app == 1) {
        
        var formData = new FormData(document.getElementById("form1"));
        formData.append("show_app", show_app);
        
        var params = {
                type: 'POST',
                withFile: true,
                module: 'admin',
                action: 'updateappandroid',
                data: formData
        }

    } else {
        var data = {
            show_app: show_app,
        };
    
        var params = {
                type: 'POST',
                withFile: false,
                module: 'admin',
                action: 'updateappandroid',
                data: data
        };
    }

    invoke(params, updateAppAndroid_Ok, updateAppAndroid_Error);

}

/******************************************************/


/* End Version 1.1.7 */
/******************************************************/
/******************************************************/



/******************************************************/
/******************************************************/
/* Version 1.2.0 */


function updateAPIGoogle_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[1], response.html, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;            
   }
}

function updateAPIGoogle_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateAPIGoogle(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    apigoogle = validationInput('empty', '#apigoogle', diverror, txt_error_apigoogle, bsubmit, true);
    if (!apigoogle) return;

	paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;

    var data = {
        apig: apigoogle,
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'admin',
            action: 'apigoogle',
            data: data
    };

    invoke(params, updateAPIGoogle_Ok, updateAPIGoogle_Error);

}


/* End Version 1.2.0 */
/******************************************************/
/******************************************************/
