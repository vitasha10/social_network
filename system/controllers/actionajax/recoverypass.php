<?php  
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

    global $db2, $K, $D;
	$page = & $GLOBALS['page'];

	$page->loadLanguage('global.php');
	$page->loadLanguage('login.php');

    $the_sanitaze = new sanitize(); // init sanitaze

	$error = FALSE;
    $msgerror = '';

	$email = isset($_POST['em']) ? (strtolower(trim($_POST['em']))) : '';

	if (!$error && empty($email) && !emailValid($email)) {
		$error = TRUE;
		$msgerror = $page->lang('signup_error_email');
	}

	if ($error) {
        echo('ERROR:'.$msgerror);
        return;
	} else {

		$theUser = $db2->fetch("SELECT code, with_validation, validated, user_email FROM users WHERE user_email='".$email."' LIMIT 1");

		if (!$theUser) {
            echo('ERROR:'.$page->lang('login_reset_error_nonregistered'));
            return;
		} else {

			$sendMailRecovery = 0;
			if ($theUser->with_validation) {

				if (!$theUser->validated) {

					$page->loadLanguage('email.php');

					$to = $email;
					$subject = $page->lang('email_validation_subject');
					$D->linkvalidation = $K->SITE_URL.'validation/c:'.$theUser->code.'/e:'.$theUser->user_email;
                    $message = $page->load_template('email/validate_email.php', FALSE);

					$from = $K->MAIL_FROM;

					if ($K->MAIL_WITH_PHPMAILER) {
						sendMail_PHPMailer($to, $subject, $message);
					} else {
						sendMail($to, $subject, $message, $from);
					}				
				} else $sendMailRecovery = 1;
			} else $sendMailRecovery = 1;

			if ($sendMailRecovery == 1) {
				$coderecovery = getCode(20, 0);		
				$db2->query("UPDATE users SET pass_reset_key='".$coderecovery."' WHERE code='".$theUser->code."' LIMIT 1");

				$D->linkresetpass = $K->SITE_URL.'resetpass/c:'.$coderecovery.'/cu:'.$theUser->code;    

				$to = $email;
				$subject = $page->lang('email_recovery_subject');

				$D->linkresetpass = $K->SITE_URL.'resetpass/c:'.$theUser->code.'/e:'.$theUser->user_email;

                $message = $page->load_template('email/reset_password.php', FALSE);

				$from = $K->MAIL_FROM;
				if ($K->MAIL_WITH_PHPMAILER) {
					sendMail_PHPMailer($to, $subject, $message);
				} else {
					sendMail($to, $subject, $message, $from);
				}
			}
            echo(json_encode(array('html'=>$page->lang('login_reset_ok'))));
            return;
		}	
	}
?>