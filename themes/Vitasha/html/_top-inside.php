    <script> var msg_error_conection = stripslashes('<?php echo strJS($this->lang('global_txt_cannotperform'))?>'); </script>

    <div id="topbar">
        <div class="spacetop">

            <?php echo $D->html_logo ?>

            <div id="bar-search-top">
                <div>
                <form id="form-search-top" method="post">
                <input autocomplete="off" type="text" id="input-search-top" name="input-search-top" <?php if (isset($D->_IS_LOGGED) && $D->_IS_LOGGED) { ?> onFocus="viewRecentSearch()" <?php } ?> placeholder="<?php echo $this->lang('global_search_top_placeholder'); ?>">
                </form>
                </div>
                <div id="area-results-search" class="_emerged">
                    <div id="title-search-top"><?php echo $this->lang('global_search_top_search_results')?></div>
                    <div id="inside-info-search" class="slimscrollers"></div>
                    <a href="<?php echo $K->SITE_URL?>search" id="link-more-search-top" rel="phantom-all" target="dashboard-main-area" class="undecorated">
                    <div id="footer-search-top" class="link link-blue"><?php echo $this->lang('global_search_top_search_more')?></div>
                    </a>
                </div>
                <script>
                $("#input-search-top").on('keyup', searchForTop);

                $('#form-search-top').submit(function(e){
                    query = $("#input-search-top").val();
                    if (query != this.defaultValue){
                        <?php if (isset($D->_IS_LOGGED) && $D->_IS_LOGGED) { ?>
                        _SPACE_FULL = true;
                        actionOnClick(_SITE_URL + 'search/q:' + query, 'dashboard-main-area', 'all');
                        <?php } else { ?>
                        document.location = _SITE_URL + 'search/q:' + query;
                        <?php } ?>
                    }
                    return false;
                });
                </script>
            </div>

            <?php echo $D->html_menu_top ?>

            <div id="area-menu-more" class="_emerged">
                <div id="content-area-menu-more">
                    <div id="inside-info">
                        <?php echo $D->html_menu_more ?>
                    </div>
                </div>
            </div>

            <div id="area-notif-people" class="_emerged">
                <div id="content-area-notif-people">
                    <div class="title_area_notif"><?php echo $this->lang('dashboard_txt_notifications_people')?></div>
                    <div id="inside-info" class="slimscrollers"></div>
                    <a href="<?php echo $K->SITE_URL?>notifications/people" rel="phantom-all" target="dashboard-main-area" class="undecorated">
                    <div id="footer-info" class="link link-blue">
                        <?php echo $this->lang('dashboard_txt_see_all')?>
                    </div>
                    </a>
                </div>
            </div>

            <div id="area-notif-message" class="_emerged">
                <div id="content-area-notif-message">
                    <div class="title_area_notif"><?php echo $this->lang('dashboard_txt_recent_messages')?></div>
                    <div id="inside-info" class="slimscrollers"></div>
                    <a href="<?php echo $K->SITE_URL?>messages" rel="phantom-all" target="dashboard-main-area" class="undecorated">
                    <div id="footer-info" class="link link-blue">
                        <?php echo $this->lang('dashboard_txt_see_all')?>
                    </div>
                    </a>
                </div>
            </div>

            <div id="area-notif-global" class="_emerged">
                <div id="content-area-notif-global">
                    <div class="title_area_notif"><?php echo $this->lang('dashboard_txt_global_notifications')?></div>
                    <div id="inside-info" class="slimscrollers"></div>
                    <a href="<?php echo $K->SITE_URL?>notifications/global" rel="phantom-all" target="dashboard-main-area" class="undecorated">
                    <div id="footer-info" class="link link-blue">
                        <?php echo $this->lang('dashboard_txt_see_all')?>
                    </div>
                    </a>
                </div>
            </div>
            
            
            
<div>
    <div id="dash-menu-responsive" class="_emerged" style="display:none;">
        <div id="inside-menu-responsive">
            <div id="inside-info">
                <div id="menuleft" class="slimscrollers"></div>
            </div>
        </div>
    </div>
</div>
<script>
    var html_inside_menu_responsive = '';

    $('#logo-mini').click(function(e) {
        if (!isVisibleMenuResponsive) {
            $('#dash-menu-responsive #menuleft').html(html_inside_menu_responsive);
            openMenuResponsive();
        } 
        else closeMenuResponsive();
        return false;
    });
    
    closeMenuResponsive();

</script>
            

        </div>
    </div>
    <div class="clear"></div>
    <div id="space-below"></div>
    
    


    <script>

    $('#ico-more').click(function(e) {
        if (!isVisibleMenuMore) {
            openMenuMore();
            activeSlimScrollers();
        }
        else closeMenuMore();
        return false;
    });

    /*****************************************/

    $('#ico-not-people').click(function(e) {
        if (!isVisibleNotifPeople) {
            openNotifPeople();
            activeSlimScrollers();
        } else closeNotifPeople();
        return false;
    });

    /*****************************************/

    $('#ico-not-message').click(function() {
        if (!isVisibleNotifMessage) {
            openNotifMessage();
            activeSlimScrollers();
        } else closeNotifMessage();
        return false;
    });

    /*****************************************/

    $('#ico-not-global').click(function() {
        if (!isVisibleNotif) {
            openNotifGlobal();
            activeSlimScrollers();
        } else closeNotifGlobal();
        return false;
    });

    /*****************************************/

    var interval_notifications_people = <?php echo $K->INTERVAL_NOTIFICATIONS_PEOPLE?>;
    checkNotificationsPeople();

    var interval_notifications_global = <?php echo $K->INTERVAL_NOTIFICATIONS_GLOBAL?>;
    checkNotificationsGlobal();

    var interval_notifications_messages = <?php echo $K->INTERVAL_NOTIFICATIONS_MESSAGES?>;
    checkNotificationsMessages();

    </script>

    <div id="sidebar-chat">
        <div id="boxlist">
            <div class="slimscrollers area_online_chat"></div>
        </div>
        <div id="boxsearch">
            <div id="ico-search-chat"><img src="<?php echo getImageTheme('ico-search-chat.png')?>"></div>
            <div id="input-search-chat"><input id="inputsf" name="inputsf" type="text" autocomplete="off" placeholder="<?php echo $this->lang('dashboard_chat_placeholder')?>"></div>
            <div class="clear"></div>
        </div>

        <script>
            activeSlimScrollers();
            var _INTERVAL_CHECK_USER_ONLINE = <?php echo $K->INTERVAL_CHECK_USER_ONLINE?>;
            loadFriendsOnline();            

            var _INTERVAL_PULSE_CHAT = <?php echo $K->INTERVAL_CHECK_NEW_MSG_CHAT?>;
            pulseChat();

            $("#inputsf").on('keyup', searchUserBox);
        </script>
    </div>

    <div id="users-box-chat-bottom">
        <div id="users-box-chat-bottom-space1" class="hand">
            <span class="txtfollbot"><?php echo $this->lang('global_box_list_chat_title'); ?></span>
        </div>
        <div id="users-box-chat-bottom-space2">
            <div id="bar-chat-bottom-open">
                <div id="titlebar"><?php echo $this->lang('global_box_list_chat_title'); ?></div>
            </div>

            <div id="boxlist2bottom">
                <div class="slimscrollers area_online_chat"></div>
            </div>

            <div id="searchf">
                <div id="contentinput">
                <input type="text" id="inputsf2" name="inputsf2" autocomplete="off" placeholder="<?php echo $this->lang('dashboard_chat_placeholder')?>">
                </div>
                <script>
                    $("#inputsf2").on('keyup', searchUserBox2);
                </script>
            </div>
        </div>
    </div>

<script>
$('#users-box-chat-bottom-space1').click(function(e) {
    e.stopPropagation();
    $('#users-box-chat-bottom-space1').css('display','none');
    $('#users-box-chat-bottom-space2').show();
    boxFriendsOpen = 1;
    $('#inputsf2').focus();
});

$('#bar-chat-bottom-open').click(function(e){
    e.stopPropagation();
    $('#users-box-chat-bottom-space2').css('display','none');
    $('#users-box-chat-bottom-space1').show();
    boxFriendsOpen = 0;
    $('#inputsf2').val('');
});

</script>
    

    <div id="space-for-chat">
        <div id="inside-space-for-chat">
            <div id="the-counter-hidden">
                <div id="button-counter"></div>
                <div id="list-hidden">
                    <div id="inside-list-hidden"></div>
                </div>
            </div>
            <div id="group-chats">
                <!-- here the box chat -->        
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>

    <div id="item-card" class="_emerged"></div>

    <script>
    var sizePhotoMessage = <?php echo $K->FILE_SIZE_PHOTO_MESSAGES?>;
    var sizeAttachMessage = <?php echo $K->FILE_SIZE_ATTACH_MESSAGES?>;
    
    var txt_write_message = stripslashes('<?php echo strJS($this->lang('global_txt_write_message'))?>');
    var txt_box_chat_opc1 = stripslashes('<?php echo strJS($this->lang('global_box_chat_t_opc_tomax'))?>');
    var txt_box_chat_opc2 = stripslashes('<?php echo strJS($this->lang('global_box_chat_t_opc_add_photo'))?>');
    var txt_box_chat_opc3 = stripslashes('<?php echo strJS($this->lang('global_box_chat_t_opc_add_file'))?>');
    

    var txt_chat_alt_photo = stripslashes('<?php echo strJS($this->lang('global_box_chat_alt_photo'))?>');
    var txt_chat_alt_smile = stripslashes('<?php echo strJS($this->lang('global_box_chat_alt_smile'))?>');
    var txt_chat_alt_file = stripslashes('<?php echo strJS($this->lang('global_box_chat_alt_file'))?>');
    var txt_chat_alt_sticker = stripslashes('<?php echo strJS($this->lang('global_box_chat_alt_sticker'))?>');
    
    var msg_chat_error_photo_format = stripslashes('<?php echo $this->designer->boxAlert($this->lang('global_chat_error_photo_title'), $this->lang('global_chat_error_photo_wrong'), $this->lang('global_txt_ok'))?>');
    
    var msg_chat_error_photo_large = stripslashes('<?php echo $this->designer->boxAlert($this->lang('global_chat_error_photo_title'), $this->lang('global_chat_error_photo_large'), $this->lang('global_txt_ok'))?>');

    var msg_chat_error_file_format = stripslashes('<?php echo $this->designer->boxAlert($this->lang('global_chat_error_file_title'), $this->lang('global_chat_error_file_wrong'), $this->lang('global_txt_ok'))?>');
    
    var msg_chat_error_file_large = stripslashes('<?php echo $this->designer->boxAlert($this->lang('global_chat_error_file_title'), $this->lang('global_chat_error_file_large'), $this->lang('global_txt_ok'))?>');
    
    var bad_ext_files = '<?php echo $K->BAD_EXT_FILES; ?>';
	
	<?php if (isset($D->_IS_LOGGED) && $D->_IS_LOGGED) { ?>

	var msg_hide_post = stripslashes('<?php echo $this->designer->boxConfirm($this->lang('global_activity_alert_hide_post_title'), $this->lang('global_activity_alert_hide_post_msg'), $this->lang('global_activity_alert_text_confirm'), $this->lang('global_activity_alert_text_cancel'))?>');
	
	<?php 
	$theformreport_post = '<div><div class="form-block"><label for="textreason-{#CODE#}">'.$this->lang('global_activity_alert_report_post_confirm_q').':</label><textarea name="textreason-{#CODE#}" type="text" id="textreason-{#CODE#}" placeholder="'.$this->lang('global_activity_alert_report_post_confirm_q_placeholder').'" class="form-control"/></textarea></div></div>';
	?>
	
	var msg_report_post = stripslashes('<?php echo $this->designer->boxConfirm($this->lang('global_activity_alert_report_post_title'), $theformreport_post, $this->lang('global_activity_alert_text_confirm'), $this->lang('global_activity_alert_text_cancel'))?>');
	
	var msg_ureport_post = stripslashes('<?php echo $this->designer->boxConfirm($this->lang('global_activity_alert_ureport_post_title'), $this->lang('global_activity_alert_ureport_post_msg'), $this->lang('global_activity_alert_text_confirm'), $this->lang('global_activity_alert_text_cancel'))?>');
	
	var msg_delete_post = stripslashes('<?php echo $this->designer->boxConfirm($this->lang('global_activity_alert_delete_post_title'), $this->lang('global_activity_alert_delete_post_msg'), $this->lang('global_activity_alert_text_confirm'), $this->lang('global_activity_alert_text_cancel'))?>');
	
	var msg_alert_edit_empty = stripslashes('<?php echo $this->designer->boxAlert($this->lang('global_activity_txt_edit'), $this->lang('global_activity_edit_error_empty'), $this->lang('global_activity_alert_text_ok'))?>');
	
	var msg_delete_comment = stripslashes('<?php echo $this->designer->boxConfirm($this->lang('global_activity_alert_delete_comment_title'), $this->lang('global_activity_alert_delete_comment_msg'), $this->lang('global_activity_alert_text_confirm'), $this->lang('global_activity_alert_text_cancel'))?>');
	
	var msg_error_format_attach_comment = stripslashes('<?php echo $this->designer->boxAlert($this->lang('global_dashboard_newcomment_error_format_image_title'), $this->lang('global_dashboard_newcomment_error_format_image_msg'), $this->lang('global_dashboard_newcomment_error_bclose'))?>');
	
	<?php } ?>

	$('#item-card').mouseleave(function() {
		$('#item-card').hide();
	});
    </script>

    <!-- layout modal -->

    <div id="the-modal" class="hide">
        <div id="the-modal-content"></div>
    </div>