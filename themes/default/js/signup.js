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

function register_Ok(response) {

	switch (response.status) {
		case 'ERROR':
			openandclose(paramsArray[0], response.message, 1700)
			setTimeout(function() { $(paramsArray[3]).removeAttr('disabled'); }, 2500);
			break;
		case 'OK':
            if (parseInt(response.with_validation) == 1) {
                $(paramsArray[1]).html(response.html);
                $(paramsArray[2]).fadeOut('slow',function(){
                    $(paramsArray[2]).hide(function(){
                        $(paramsArray[1]).fadeIn('slow');
                    });
                });
            } else {
    			location.href = _SITE_URL + "dashboard";
            }
			break;
	}
    
}

function register_Error(response) {
	openandclose(paramsArray[0], msg_error_conection, 1700)
	setTimeout(function() {$(paramsArray[3]).removeAttr('disabled');}, 2500); 
}

function register(divform, divok, diverror, bsubmit){

	$(bsubmit).attr('disabled','true');

	firstname = validationInput('empty', '#firstname', '#alert-firstname', error_firstname, bsubmit, false);
	if (!firstname) return;

	lastname = validationInput('empty', '#lastname', '#alert-lastname', error_lastname, bsubmit, false);
	if (!lastname) return;

	email = validationInput('email', '#email', '#alert-email', error_email, bsubmit, false);
	if (!email) return;

	username = validationInput('username', '#username', '#alert-username', error_username, bsubmit, false);
	if (!username) return;

	password = validationInput('password', '#password', '#alert-password', error_password, bsubmit, false);
	if (!password) return;

	bmonth = $('#bmonth').val();
	bday = $('#bday').val();
	byear = $('#byear').val();
	if (bmonth == -1 || bday == -1 || byear == -1) {
		openandclose('#alert-birthday', error_birthday1,1700);
		//$('#byear').focus();
		setTimeout(function() { $(bsubmit).removeAttr('disabled'); }, 2500);
		return;
	}

	tmpDay = bday;
	tmpMonth = bmonth;
	if (bday < 10) tmpDay = '0' + bday;
	if (bmonth < 10) tmpMonth = '0' + bmonth;
	cadDate = tmpDay + '/' + tmpMonth + '/' + byear;

	if (!validateDate(cadDate)) {
		openandclose('#alert-birthday', error_birthday2,1700);
		//$('#byear').focus();
		setTimeout(function() {$(bsubmit).removeAttr('disabled');}, 2500);
		return;
	}

	gender = validationInput('empty', '#valGender', '#alert-gender', error_gender, bsubmit, false);
	if (!gender) return;

	paramsArray[0] = diverror;
	paramsArray[1] = divok;
	paramsArray[2] = divform;
	paramsArray[3] = bsubmit;

    var data = {
        fn: firstname,
        ln: lastname,
        un: username,
        pw: '' + CryptoJS.MD5(password) + '',
        em: email,
        ge: gender,
        bd: bday,
        bm: bmonth,
        by: byear
    }

    var params = {
            type: 'POST',
            withFile: false,
            module:  'signup',
            action: 'signup',
            data: data
    };

    invoke(params, register_Ok, register_Error);
}