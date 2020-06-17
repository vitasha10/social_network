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

function login_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[1]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            location.href = _SITE_URL + "dashboard";
            break;
   }
}

function login_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() {$(paramsArray[1]).removeAttr('disabled');}, 2500);
}

function login(diverror, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

	username = $('#username').val();
	if (username.indexOf('@') != -1) {
		username = validationInput('email', '#username', '#alert-username', error_username, bsubmit, true);
		if (!username) return;
	} else {
		username = validationInput('username', '#username', '#alert-username', error_username, bsubmit, true);
		if (!username) return;
	}

	password = validationInput('password', '#password', '#alert-password', error_password, bsubmit, true);
	if (!password) return;

	rememberme = 0;
	if (with_rememberme == 1) {
		if ($('#rememberme').is(':checked')) rememberme = 1;
	}

    var data = {
        un: username,
        pw: '' + CryptoJS.MD5(password) + '',
        r: rememberme,
    }
 
    paramsArray[0] = diverror;
    paramsArray[1] = bsubmit;
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'login',
            action: 'login',
            data: data
    }

    invoke(params, login_Ok, login_Error);

}