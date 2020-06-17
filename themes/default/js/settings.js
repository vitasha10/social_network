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

_IN_SETTING_PANEL = true;
_SPACE_FULL = true;

/******************************************************/

function updateEmail_Ok(response) {
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

function updateEmail_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateEmail(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    email = validationInput('email', '#email', diverror, txt_error_email, bsubmit, true);
    if (!email) return;

    var data = {
        em: email,
    };
 
    paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionssetting',
            action: 'email',
            data: data,
    };

    invoke(params, updateEmail_Ok, updateEmail_Error);

}

/******************************************************/

function updateUsername_Ok(response) {
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

function updateUsername_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateUsername(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    username = validationInput('empty', '#username', diverror, txt_error_username, bsubmit, true);
    if (!username) return;

    username = validationInput('username', '#username', diverror, txt_error_notvalid, bsubmit, true);
    if (!username) return;

    var data = {
        un: username,
    };
 
    paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionssetting',
            action: 'username',
            data: data,
    };

    invoke(params, updateUsername_Ok, updateUsername_Error);

}

/******************************************************/

function updatePassword_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            $('#pcurrent').val('');
            $('#pnew').val('');
            $('#pnew2').val('');
            $('#pcurrent').focus();
            openandclose(paramsArray[1], response.html, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;
   }
}

function updatePassword_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updatePassword(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    pcurrent = validationInput('password', '#pcurrent', diverror, txt_error_pcurrent, bsubmit, true);
    if (!pcurrent) return;

    pnew = validationInput('password', '#pnew', diverror, txt_error_pnew, bsubmit, true);
    if (!pnew) return;

    pnew2 = validationInput('password', '#pnew2', diverror, txt_error_pnew2, bsubmit, true);
    if (!pnew2) return;

	if (pnew != pnew2) {
        openandclose(diverror, txt_error_pnomatch, 1700);
        setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500);
        return;
    }

    var data = {
        pc: '' + CryptoJS.MD5(pcurrent) + '',
        pn: '' + CryptoJS.MD5(pnew) + '',
    };
 
    paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionssetting',
            action: 'password',
            data: data,
    };

    invoke(params, updatePassword_Ok, updatePassword_Error);

}


/******************************************************/

function updatePersonal_Ok(response) {
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

function updatePersonal_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updatePersonal(diverror, divok, bsubmit) {
    
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

    var data = {
        fn: firstname,
        ln: lastname,
        ge: gender,
        bi: year + '-' + xmonth + '-' + xday,
    };
 
    paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionssetting',
            action: 'personal',
            data: data,
    };

    invoke(params, updatePersonal_Ok, updatePersonal_Error);

}

/******************************************************/

function updateLocation_Ok(response) {
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

function updateLocation_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateLocation(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    currentcity = validationInput('empty', '#currentcity', diverror, txt_error_currentcity, bsubmit, true);
    if (!currentcity) return;

    hometown = validationInput('empty', '#hometown', diverror, txt_error_hometown, bsubmit, true);
    if (!hometown) return;

    var data = {
        cc: currentcity,
        ho: hometown,
    };
 
    paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionssetting',
            action: 'location',
            data: data,
    };

    invoke(params, updateLocation_Ok, updateLocation_Error);

}

/******************************************************/

function updateAboutMe_Ok(response) {
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

function updateAboutMe_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateAboutMe(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    aboutme = validationInput('empty', '#aboutme', diverror, txt_error_aboutme, bsubmit, true);
    if (!aboutme) return;

    var data = {
        abme: aboutme,
    };
 
    paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionssetting',
            action: 'aboutme',
            data: data,
    };

    invoke(params, updateAboutMe_Ok, updateAboutMe_Error);

}

/******************************************************/

function updatePrivacyProfile_Ok(response) {
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

function updatePrivacyProfile_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updatePrivacyProfile(diverror, divok, bsubmit) {
    
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

    var data = {
        ppro: pprofile,
        pwri: pwritewall,
        psfr: pseefriends,
        pspa: pseepages,
        psgr: pseegroups,
        pmes: pmessages,
    };
 
    paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionssetting',
            action: 'privacyprofile',
            data: data,
    };

    invoke(params, updatePrivacyProfile_Ok, updatePrivacyProfile_Error);

}

/******************************************************/

function updatePrivacyInfo_Ok(response) {
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

function updatePrivacyInfo_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updatePrivacyInfo(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    pbirthday = validationInput('number', '#pbirthday', diverror, txt_error_option, bsubmit, false);
    if (!pbirthday) return;

    plocation = validationInput('number', '#plocation', diverror, txt_error_option, bsubmit, false);
    if (!plocation) return;

    paboutme = validationInput('number', '#paboutme', diverror, txt_error_option, bsubmit, false);
    if (!paboutme) return;

    var data = {
        pbir: pbirthday,
        ploc: plocation,
        pabo: paboutme,
    };
 
    paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionssetting',
            action: 'privacyinfo',
            data: data,
    };

    invoke(params, updatePrivacyInfo_Ok, updatePrivacyInfo_Error);

}

/******************************************************/

function updatePrivacyChat_Ok(response) {
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

function updatePrivacyChat_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updatePrivacyChat(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    pchat = validationInput('number', '#pchat', diverror, txt_error_option, bsubmit, false);
    if (!pchat) return;

    pchatmute = validationInput('number', '#pchatmute', diverror, txt_error_option, bsubmit, false);
    if (!pchatmute) return;

    var data = {
        pcha: pchat,
        pchamu: pchatmute,
    };
 
    paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionssetting',
            action: 'privacychat',
            data: data,
    };

    invoke(params, updatePrivacyChat_Ok, updatePrivacyChat_Error);

}

/******************************************************/

function deleteAccount_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            self.location = _SITE_URL;
            break;
   }
}

function deleteAccount_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
}

function deleteAccount(diverror) {
    
    bsubmit = $('#bsave1');

	$(bsubmit).attr('disabled','true');

    var data = {
    };
 
    paramsArray[0] = diverror;
    paramsArray[1] = bsubmit;
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionssetting',
            action: 'delete',
            data: data,
    };

    invoke(params, deleteAccount_Ok, deleteAccount_Error);

}

/******************************************************/


function updateLangTime_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700);
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            openandclose(paramsArray[1], response.html, 1700);
            setTimeout(function() {
                $(paramsArray[2]).removeAttr('disabled');
                window.location.replace(_SITE_URL + 'settings/account');
            },
            1200);
            break;
   }
}

function updateLangTime_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700);
    setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
}

function updateLangTime(diverror, divok, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

    timezone = validationInput('empty', '#timezone', diverror, txt_error_choose_lt, bsubmit, false);
    if (!timezone) return;

    language = validationInput('empty', '#language', diverror, txt_error_choose_lt, bsubmit, false);
    if (!language) return;

    var data = {
        tztime: timezone,
        tzlang: language,
    };
 
    paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'actionssetting',
            action: 'timelang',
            data: data,
    };

    invoke(params, updateLangTime_Ok, updateLangTime_Error);

}

/******************************************************/