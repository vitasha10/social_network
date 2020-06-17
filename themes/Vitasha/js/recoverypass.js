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

function resetpass_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            openandclose(paramsArray[0], response.message, 1700)
            setTimeout(function() { $(paramsArray[2]).removeAttr('disabled'); }, 2500);
            break;

        case 'OK':
            $(paramsArray[1]).html(response.html);
            $(paramsArray[3]).fadeOut('slow',function(){
                $(paramsArray[3]).hide(function(){
                    $(paramsArray[1]).fadeIn('slow');
                });
            });
            break;
   }
}

function resetpass_Error(response) {
    openandclose(paramsArray[0], msg_error_conection, 1700)
    setTimeout(function() {$(paramsArray[2]).removeAttr('disabled');}, 2500); 
}

function resetpass(divform, divok, diverror, bsubmit) {
    
	$(bsubmit).attr('disabled','true');

	email = validationInput('email', '#email', '#alert-email', error_email, bsubmit, true);
	if (!email) return;

    var data = {
        em: email,
    }
 
    paramsArray[0] = diverror;
    paramsArray[1] = divok;
    paramsArray[2] = bsubmit;
    paramsArray[3] = divform;
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'recoverypass',
            action: 'recovery',
            data: data
    }

    invoke(params, resetpass_Ok, resetpass_Error);

}