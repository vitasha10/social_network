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
	if (!$D->_IS_LOGGED) $this->globalRedirect('login');

	$this->loadLanguage('global.php');
	$this->loadLanguage('dashboard.php');

    $D->_IN_DASHBOARD = FALSE;
    $D->_WITH_NOTIFIER = TRUE;

	$D->isPhantom = FALSE;
	if ($this->param('phantom') && $this->param('phantom')=='yes') $D->isPhantom = TRUE;

	$D->layout_size = 'min';
	if ($this->param('lysize')) $D->layout_size = $this->param('lysize');
    
    $D->id_menu = 'opt_ml_messages';
    
    /******************************************************/
    
    if (isset($this->params->userchat)) {
        $D->the_username_chat = $this->params->userchat;
        $D->the_iduser_chat = $this->params->iduserchat;
        $thename = $this->db2->fetch("SELECT code, firstname, lastname FROM users WHERE iduser=".$D->the_iduser_chat);
        $D->name_user_chat = $thename->firstname.' '.$thename->lastname;
        $D->code_user_chat = $thename->code;
    }
    
    $sql_theblockeds = 'SELECT iduserblocked FROM users_blocked WHERE iduser='.$this->user->id;
    
    $all_talks = $this->db2->fetch_all("SELECT talks.idtalk FROM talks INNER JOIN talks_messages ON talks.idlastmessage = talks_messages.idmessage INNER JOIN talks_users ON talks.idtalk = talks_users.idtalk WHERE talks_users.deleted = '0' AND talks_users.iduser = ".$this->user->id." AND talks_users.iduser NOT IN (".$sql_theblockeds.") ORDER BY talks_messages.whendate DESC LIMIT 0, ".$K->ITEMS_PER_PAGE);
    
    $D->html_talks = '';
    
    $num_talks = count($all_talks);
    if ($num_talks > 0) {
        
        foreach($all_talks as $onetalk) {
            
            $oneconversation = $this->db2->fetch("SELECT talks.idtalk, talks.idlastmessage, talks_messages.message, talks_messages.iduser, talks_messages.typemessage, talks_messages.whendate, talks_users.viewed FROM talks INNER JOIN talks_messages ON talks.idlastmessage = talks_messages.idmessage INNER JOIN talks_users ON talks.idtalk = talks_users.idtalk WHERE talks_users.deleted=0 AND talks_users.iduser=".$this->user->id." AND talks.idtalk=".$onetalk->idtalk);
            
            $theuser = $this->db2->fetch("SELECT users.code, users.iduser, users.firstname, users.lastname, users.user_username, users.avatar FROM talks_users INNER JOIN users ON talks_users.iduser=users.iduser WHERE talks_users.idtalk=".$oneconversation->idtalk." AND talks_users.iduser<>".$this->user->id);
    
            $D->the_talk_user_code = $theuser->code;
            $D->the_talk_user_username = stripslashes($theuser->user_username);
    
            if (empty($theuser->avatar)) $theuser->avatar = $K->DEFAULT_AVATAR_USER;
            $base_url = $K->STORAGE_URL_AVATARS.'min2/';
            $D->the_talk_user_avatar = $base_url.$theuser->avatar;
            $D->the_talk_user_name = stripslashes($theuser->firstname).' '.stripslashes($theuser->lastname);
            if ($theuser->avatar != $K->DEFAULT_AVATAR_USER) $D->the_talk_user_avatar = $base_url.$D->the_talk_user_code.'/'.$theuser->avatar;
    
            $D->the_talk_id = $oneconversation->idtalk;
            
            if ($oneconversation->typemessage == 1) $D->the_talk_message = analyzeMessageChat(str_cut($oneconversation->message, 50));
            if ($oneconversation->typemessage == 2) {
                if ($oneconversation->iduser == $user->info->iduser) $D->the_talk_message = $this->lang('dashboard_messages_txt_you_send_photo');
                else $D->the_talk_message = $this->lang('dashboard_messages_txt_send_you_photo');
                
                $D->the_talk_message = '<span style="font-style:italic;">'.$D->the_talk_message.'</span>';
            }
            if ($oneconversation->typemessage == 3) {
                if ($oneconversation->iduser == $user->info->iduser) $D->the_talk_message = $this->lang('dashboard_messages_txt_you_send_file');
                else $D->the_talk_message = $this->lang('dashboard_messages_txt_send_you_file');
                
                $D->the_talk_message = '<span style="font-style:italic;">'.$D->the_talk_message.'</span>';
            }
            if ($oneconversation->typemessage == 4) {
                if ($oneconversation->iduser == $user->info->iduser) $D->the_talk_message = $this->lang('dashboard_messages_txt_you_send_sticker');
                else $D->the_talk_message = $this->lang('dashboard_messages_txt_send_you_sticker');
                
                $D->the_talk_message = '<span style="font-style:italic;">'.$D->the_talk_message.'</span>';
            }
            
            $D->the_talk_thedate = '<span class="thelivestamp" data-locale="'.$K->LANGUAGE.'" data-livestamp="'.$oneconversation->whendate.'"></span>';
    
            $D->html_talks .= $this->load_template('ones/one-talk.php', FALSE);
            
        }
        
    }

    if (isset($this->params->userchat)) {
        
        $the_talk = $this->db2->fetch('SELECT idtalk FROM talks_users WHERE iduser IN ('.$this->user->id.','.$D->the_iduser_chat.') GROUP BY idtalk HAVING COUNT(idtalk) = 2');
        
        $numtalks = count($the_talk);
        
        $D->html_talks_messages = '';
        
        if ($numtalks > 0) {
            
            $idtalk = $the_talk->idtalk;
            $D->the_idtalk = $idtalk;
            
            $last_message_talk = $this->db2->fetch_field('SELECT idlastmessage FROM talks WHERE idtalk='.$idtalk.' LIMIT 1');
            
            $the_messages = $this->db2->fetch_all("SELECT * FROM ( SELECT talks_messages.idmessage, talks_messages.message, talks_messages.typemessage, talks_messages.nameattach, talks_messages.whendate, users.iduser, users.firstname, users.lastname, users.user_username FROM talks_messages INNER JOIN users ON talks_messages.iduser = users.iduser WHERE talks_messages.idtalk = ".$idtalk." ORDER BY talks_messages.idmessage DESC LIMIT 0,10 ) messages ORDER BY messages.idmessage ASC");
            
            $id_last_message_view = $this->db2->fetch_field('SELECT last_message_view FROM talks_users WHERE iduser='.$this->user->id.' AND idtalk='.$idtalk.' LIMIT 1');                    
            $num_messages_unread = 0;
            
            if (count($the_messages) > 0) {
                
                foreach ($the_messages as $onemessage) {

                    $D->chat_txt_whendate = '<span class="thelivestamp" data-locale="'.$K->LANGUAGE.'" data-livestamp="'.$onemessage->whendate.'"></span>';
                    
                    if ($onemessage->iduser == $user->id) $D->who_write_in_chat = 1; //me
                    else {
                        $D->who_write_in_chat = 2; //friend
                        if ($onemessage->idmessage > $id_last_message_view) $num_messages_unread++;
                        $D->chat_user_name = stripslashes($onemessage->firstname).' '.stripslashes($onemessage->lastname);
                        $D->chat_user_username = $onemessage->user_username;
                    }
                    
                    $D->type_message_in_chat = $onemessage->typemessage;
                    
                    switch ($D->type_message_in_chat) {
                        case 1:
                            $D->chat_msgchatnew_me = analyzeMessageChat($onemessage->message);
                            break;
                        case 2:
                            $D->chat_msgchatnew_me = $K->STORAGE_URL_PHOTOS_MESSAGES.'min/'.$onemessage->nameattach;
                            $D->chat_photo_max = $K->STORAGE_URL_PHOTOS_MESSAGES.$onemessage->nameattach;
                            break;
                        case 3:
                            $newnamefile = stripslashes($onemessage->message);
                            $D->chat_msgchatnew_me = cutStringCenter($newnamefile, $K->NUM_CHARS_NAME_FILE);
                            $thenamefile = sanitizeNameFile($newnamefile);
                            $D->chat_file_url_dwl = $K->SITE_URL.'dwf/f:'.$onemessage->nameattach.'/o:'.$thenamefile;
                            break;
                        case 4:
                            $D->the_sticker = $onemessage->message;
                            break;                            
                    }

                    $D->html_talks_messages .= $this->load_template('ones/one-msgchat.php',FALSE);

                }

                if ($num_messages_unread > $this->user->info->num_notifications_messages) $num_messages_unread = $this->user->info->num_notifications_messages;
                $this->db2->query('UPDATE users SET num_notifications_messages=num_notifications_messages-'.$num_messages_unread.' WHERE iduser='.$this->user->id.' LIMIT 1'); 

            }

            $this->db2->query('UPDATE talks_users SET viewed=1, last_message_view='.$last_message_talk.' WHERE iduser='.$this->user->id.' AND idtalk='.$idtalk);

        }else{
            
        }

    }

    /******************************************************/
  
	if ($D->isPhantom) {

        $html = '';

        $this->load_extract_controller('_dashboard-menu-left');

		if ($D->layout_size == 'min') {
            
            if (isset($this->params->userchat)) {
                $for_load = 'min/messages-talk.php';
                $D->titlePhantom = $D->name_user_chat.' | '.$this->lang('dashboard_messages_title');
            } else {
                $for_load = 'min/messages.php';
                $D->titlePhantom = $this->lang('dashboard_messages_title');
            }
		} else {
            $for_load = 'max/messages.php';
            $D->titlePhantom = $this->lang('dashboard_messages_title');
		}

        $html .= $this->load_template($for_load, FALSE);
        echo $html;
        
	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_dashboard-menu-left');
        
        $D->page_title = $this->lang('dashboard_messages_title');

        $D->file_in_template = 'max/messages.php';
        $this->load_template('dashboard-template.php');
        
    }
?>