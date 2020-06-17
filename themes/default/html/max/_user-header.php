<div id="profile-header">
    
    <div id="cover-header" <?php echo(empty($D->cover_user)?'':'class="with_cover"') ?>>
        
        <div id="space-cover-header">
            <?php if ($D->with_cover) { ?>
            <a href="<?php echo $K->SITE_URL.$D->username.'/photo/'.$D->cover_media?>" class="zoomeer with_cover" data-id="<?php echo $D->cover_media?>" data-image="<?php echo $D->cover_user?>" data-place="cover-user" id="link-cover">
            <img id="cover-img" src="<?php echo $D->cover_user?>" style=" top:<?php echo $D->position_cover_user?>">
            <div id="shadow-header"></div>
            </a>
            <?php } ?>
        
            <?php if ($D->_IS_LOGGED && !$D->is_my_profile) { ?>
            <div style="bottom:59px; padding: 0; position: absolute; right:15px;">
                <span id="menu-more-points" class="my-btn my-btn-small"><img src="<?php echo getImageTheme('icodots.png'); ?>"></span>
                
                <div id="menu-in-points" class="_emerged">
                    <div id="bblockuser" class="one_option"><?php echo($this->lang('profile_txt_block_user'));?></div>
                    <?php if (!$D->is_reported) { ?>
                    <div id="breportuser" class="one_option">
                        <?php echo($this->lang('profile_txt_report_user'));?>
                        <script>
                        <?php 
                        $theformreport = '<div><div class="form-block"><label for="textreason">'.$this->lang('profile_txt_ureport_confirm_q').':</label><textarea name="textreason" type="text" id="textreason" placeholder="'.$this->lang('profile_txt_ureport_confirm_q_placeholder').'" class="form-control"/></textarea></div></div>';
                        ?>
                        
                        var msg_confirm_report = stripslashes('<?php echo $this->designer->boxConfirm($this->lang('profile_txt_ureport_confirm'), $theformreport, $this->lang('profile_txt_ureport_confirm_bconfirm'), $this->lang('profile_txt_ureport_confirm_bcancel'))?>');
                        $('#breportuser').click(function(e){
                            e.preventDefault();
                            closeEmerged();
                            _confirmWithInput(msg_confirm_report, nothign, reportUser, '#textreason', '#textreason');
                        });
                        </script>
                    </div>
                    <?php } else { ?>
                    <div id="bunreported" class="one_option">
                        <?php echo($this->lang('profile_txt_cancel_report_user'));?>
                        <script>
                        var msg_confirm_unreport = stripslashes('<?php echo $this->designer->boxConfirm($this->lang('profile_txt_ureport_cancel_title'), $this->lang('profile_txt_ureport_cancel_msg'), $this->lang('profile_txt_ureport_cancel_bconfirm'), $this->lang('profile_txt_ureport_cancel_bdiscard'))?>');
                        
                        $('#bunreported').click(function(e){
                            e.preventDefault();
                            closeEmerged();    
                            _confirm(msg_confirm_unreport, nothign, unReportUser, 1);
                        });
                        
                        </script>
                    </div>
                    <?php } ?>
                </div>
                
            </div>
            
            <script>
            $('#menu-more-points').click(function(e){
                if ($('#menu-in-points').is (':hidden')) {
                    closeEmerged();
                    $('#menu-in-points').show();
                } else $('#menu-in-points').hide();
                e.stopPropagation();
            });

            var msg_confirm_block = stripslashes('<?php echo $this->designer->boxConfirm($this->lang('profile_txt_block_confirm'), $this->lang('profile_txt_block_confirm_q', array('#NAME_USER#'=>$D->the_name_user)), $this->lang('profile_txt_block_confirm_bconfirm'), $this->lang('profile_txt_block_confirm_bcancel'))?>');
            
            $('#bblockuser').click(function(e){
                e.preventDefault();
                closeEmerged();    
                _confirm(msg_confirm_block, nothign, blockUser, 1);
            });
            
            </script>
            <?php } ?>
        
        </div>
        
        <div class="clear"></div>
        
        <?php if ($D->_IS_LOGGED && $D->is_my_profile) { ?>
        <div id="preload-actions-cover"><img src="<?php echo getImageTheme('preload.gif'); ?>"></div>
        <div id="actions-cover">
            <div id="icon-actions-menu">
                <img src="<?php echo getImageTheme('ico-photo-profile.png')?>">
            </div>
            <div id="menu-actions-cover" class="_emerged">
                <div class="opc-action-cover" id="upload-bg-header"><?php echo $this->lang('setting_cover_menu_upload')?></div>
                <div class="opc-action-cover" id="move-bg-header"><?php echo $this->lang('setting_cover_menu_reposition')?></div>
                <div class="opc-action-cover" id="remove-bg-header"><?php echo $this->lang('setting_cover_menu_remove')?></div>
                <div>
                    <form id="form-cover-new" name="form-cover-new" action="" method="POST" enctype="multipart/form-data">
                    <input id="the-new-cover" name="the-new-cover" type="file" accept="image/*" style="display:none;">
                    </form>
                    <script>
                    var sizeCover = <?php echo $K->SIZE_IMAGEN_COVER?>;
                    var filecover = null;
                    
                    var btnUploadCover = document.getElementById('upload-bg-header');
                    var inputCover = document.getElementById('the-new-cover');
                    
                    btnUploadCover.onclick = function(e) {
                        document.getElementById("the-new-cover").click()
                    }
                    
                    var _tp = 0;
                    var _cp = '<?php echo $D->codeprofile?>';
                    inputCover.onchange = function(e) {
                        filecover = this.files[0];
                        uploadCoverNew();
                    }
                    </script>
                </div>
            </div>
        </div>
        
        <div id="more-options-reposition">
            <div id="save-bg-header"><span class="my-btn my-btn-blue my-btn-small"><?php echo $this->lang('setting_txt_save_changes')?></span></div>
            <div id="cancel-bg-header" class="mrg5T"><span class="my-btn my-btn-small"><?php echo $this->lang('setting_txt_cancel')?></span></div>
        </div>

        
        <div class="clear"></div>
        <?php } ?>
    
    </div>
    <div class="clear"></div>

    
    <div id="avatar-header">

        <div id="space-avatar-header">
        
            <?php if ($D->with_avatar) { ?>
            
            <a href="<?php echo $K->SITE_URL.$D->username.'/photo/'.$D->avatar_media?>" class="zoomeer" data-id="<?php echo $D->avatar_media?>" data-image="<?php echo $D->data_media_avatar_user; ?>" data-place="avatar-user"><img src="<?php echo $D->the_avatar_user; ?>" id="the-photo-avatar"></a>
            
            <?php } else { ?>
            
            <img src="<?php echo $D->the_avatar_user; ?>" id="the-photo-avatar">
            
            <?php } ?>
        
        </div>
        
        <?php if ($D->_IS_LOGGED && $D->is_my_profile) { ?>
        <div id="preload-actions-avatar"><img src="<?php echo getImageTheme('preload.gif'); ?>"></div>
        <div id="icon-upload-avatar"><img src="<?php echo getImageTheme('ico-photo-profile.png')?>"></div>
        <div id="icon-remove-avatar"><img src="<?php echo getImageTheme('ico-photo-delete.png')?>"></div>
        <form id="form-avatar-new" name="form-avatar-new" action="" method="POST" enctype="multipart/form-data">
        <input id="the-new-avatar" name="the-new-avatar" type="file" accept="image/*" style="display:none;">
        </form>
        <script>
        var sizeAvatar = <?php echo $K->SIZE_IMAGEN_AVATAR?>;
        var fileavatar = null;
        
        var btnUploadAvatar = document.getElementById('icon-upload-avatar');
        var inputAvatar = document.getElementById('the-new-avatar');
        
        btnUploadAvatar.onclick = function(e) {
            document.getElementById("the-new-avatar").click()
        }
        
        inputAvatar.onchange = function(e) {
            fileavatar = this.files[0];
            uploadAvatarNew();
        }

        var msg_delete_avatar = stripslashes('<?php echo $this->designer->boxConfirm($this->lang('setting_avatar_delete_title'), $this->lang('setting_avatar_delete_msg'), $this->lang('setting_txt_confirm'), $this->lang('setting_txt_cancel'))?>');
    
        $('#icon-remove-avatar').on('click', function() {
            closeEmerged();
            _confirm(msg_delete_avatar, nothign, removeAvatar, 1);
        });        

        </script>
        <?php } ?>
    </div>


    <div id="username-header" <?php if ($D->the_verified) {?>class="with_verified"<?php } ?>><a href="<?php echo $K->SITE_URL.$D->username?>" class="undecorated" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><span id="the-name"><?php echo $D->the_name_user?></span></a><?php if ($D->the_verified) {?><span id="the-verified"><img src="<?php echo getImageTheme('verified.png')?>"></span><?php } ?></div>


    <?php if ($D->_IS_LOGGED) { ?>

    <div id="area-the-actions">
    
        <?php if (!$D->is_my_profile) { ?>

        <span id="b-action-message" class="my-btn my-btn-small"><?php echo $this->lang('profile_txt_bmessage')?></span>

        <?php } ?>
    
        <?php if ($D->is_my_profile) { ?>

        <a href="<?php echo $K->SITE_URL?>settings/account" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><span class="my-btn my-btn-small"><?php echo $this->lang('profile_txt_settings')?></span></a>

        <?php } else { ?>
        <div class="item_action hide" id="preload-b-action">
            <span style="padding:0 10px;"><img src="<?php echo getImageTheme('preload.gif');?>"></span>
        </div>
        <div class="item_action hide" id="area-action-addfriend">
            <span id="b-action-addfriend" class="my-btn my-btn-small"><?php echo $this->lang('profile_txt_add_friend')?></span>
        </div>
        <div class="item_action hide" id="area-action-requestsent">
            <span id="b-action-requestsent" class="my-btn my-btn-small"><?php echo $this->lang('profile_txt_friend_request_sent')?></span>
            
            <div id="submenu-cancel" class="boxsubmenu hide">
                <div id="opc-cancelrequest" class="opcsm"><?php echo $this->lang('profile_txt_friend_cancel_request');?></div>
            </div>
        </div>
        <div class="item_action hide" id="area-action-friends">
            <span id="b-action-friends" class="my-btn my-btn-green my-btn-small"><?php echo $this->lang('profile_txt_friend_friends')?></span>

            <div id="submenu-unfriend" class="boxsubmenu hide">
                <div id="opc-unfriend" class="opcsm"><?php echo $this->lang('profile_txt_friend_unfriend');?></div>
            </div>
        </div>

        <div class="item_action hide" id="area-action-answerrequest">
            <span id="b-action-answer" class="my-btn my-btn-small"><?php echo $this->lang('profile_txt_friend_respond')?></span>

            <div id="submenu-answerconfirm" class="boxsubmenu hide">
                <div id="opc-answconfirm" class="opcsm"><?php echo $this->lang('profile_txt_friend_respond_confirm');?></div>
                <div id="opc-answdelete" class="opcsm"><?php echo $this->lang('profile_txt_friend_respond_delete');?></div>
            </div>
        </div>
        
        <div class="clear"></div>
        
        <script>
        <?php if ($D->friendship == 0) { ?>
         $('#area-action-addfriend').show();
        <?php } ?>

        <?php if ($D->friendship == 1) { ?>
        $('#area-action-friends').show();
        <?php } ?>

        <?php if ($D->friendship == 2) { ?>
        $('#area-action-requestsent').show();
        <?php } ?>

        <?php if ($D->friendship == 3) { ?>
        $('#area-action-answerrequest').show();
        <?php } ?>

        var cuser = '<?php echo $D->codeprofile?>';

        var controllerSubmenuView1, controllerSubmenuView2;
        
        function clearControllers() {
            clearInterval(controllerSubmenuView2);
        }
        
        function showSubmenuAction(submenu) {
            clearControllers();
            controllerSubmenuView1 = setInterval(function() {
                $(submenu).show();
            },50);
        }

        function hideSubmenuAction(submenu) {
            clearInterval(controllerSubmenuView1);
            controllerSubmenuView2 = setInterval(function() {
                $(submenu).hide();
                clearInterval(controllerSubmenuView2);	
            },200);
        }

        function keepSubMenuVisible(controllerSubMenu) {
	    	clearInterval(controllerSubMenu);
    	}


        $('#b-action-addfriend').click(function() {
            addFriend();
        });
        
        $('#b-action-requestsent').mouseover(function(){
            showSubmenuAction('#submenu-cancel');
        });

    	$('#b-action-requestsent').mouseleave(function(){
            hideSubmenuAction('#submenu-cancel');
            
        });

        $('#submenu-cancel').mouseover(function() {
            keepSubMenuVisible(controllerSubmenuView2);
        });

        $('#submenu-cancel').mouseleave(function() {
            hideSubmenuAction('#submenu-cancel');
        });    
        
        $('#opc-cancelrequest').click(function(){
            cancelFriendRequest();
        });



        $('#b-action-friends').mouseover(function(){
            showSubmenuAction('#submenu-unfriend');
        });

    	$('#b-action-friends').mouseleave(function(){
            hideSubmenuAction('#submenu-unfriend');
            
        });

        $('#submenu-unfriend').mouseover(function() {
            keepSubMenuVisible(controllerSubmenuView2);
        });

        $('#submenu-unfriend').mouseleave(function() {
            hideSubmenuAction('#submenu-unfriend');
        });    

        $('#opc-unfriend').click(function(){
            unFriend();
        });



        $('#b-action-answer').mouseover(function(){
            showSubmenuAction('#submenu-answerconfirm');
        });

    	$('#b-action-answer').mouseleave(function(){
            hideSubmenuAction('#submenu-answerconfirm');
        });

        $('#submenu-answerconfirm').mouseover(function() {
            keepSubMenuVisible(controllerSubmenuView2);
        });

        $('#submenu-answerconfirm').mouseleave(function() {
            hideSubmenuAction('#submenu-answerconfirm');
        });    

        $('#opc-answdelete').click(function(){
            deleteFriendRequest();
        });

        $('#opc-answconfirm').click(function(){
            confirmFriendRequest();
        });

        </script>

        <?php } ?>
    </div>
    
    <?php } ?>


    
    <div id="cover-bottom">
        <div id="area-menu-header">

            <div id="inside-menu">

                <div id="in-content">

                    <a href="<?php echo $K->SITE_URL.$D->username?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?> class="one-option"><?php echo($this->lang('profile_txt_timeline'));?></a>
                    
                    <a href="<?php echo $K->SITE_URL.$D->username?>/friends" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?> class="one-option no_in_movil"><?php echo($this->lang('profile_txt_friends'));?></a>
                    
                    <a href="<?php echo $K->SITE_URL.$D->username?>/photos" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?> class="one-option no_in_tablet no_in_movil no_in_movil_land"><?php echo($this->lang('profile_txt_photos'));?></a>
                    
                    <a href="<?php echo $K->SITE_URL.$D->username?>" id="menu-more-profile-link" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?> class="one-option"><span><?php echo($this->lang('profile_txt_more'));?></span> <span><img src="<?php echo getImageTheme('ico-more-menu.png')?>"></span></a>
                    

                    <div id="menu-more-container" class="_emerged">
                    
                        <a href="<?php echo $K->SITE_URL.$D->username?>/friends" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?> class="one_option yes_in_movil"><?php echo($this->lang('profile_txt_friends'));?></a>
                        
                        <a href="<?php echo $K->SITE_URL.$D->username?>/photos" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?> class="one_option yes_in_tablet yes_in_movil yes_in_movil_land"><?php echo($this->lang('profile_txt_photos'));?></a>
                        
                        <a href="<?php echo $K->SITE_URL.$D->username?>/videos" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?>><div class="one_option"><?php echo($this->lang('profile_txt_videos'));?></div></a>

                        <a href="<?php echo $K->SITE_URL.$D->username?>/audios" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?>><div class="one_option"><?php echo($this->lang('profile_txt_audios'));?></div></a>
                        
                        <a href="<?php echo $K->SITE_URL.$D->username?>/likes" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?>><div class="one_option"><?php echo($this->lang('profile_txt_likes'));?></div></a>
                        
                        <a href="<?php echo $K->SITE_URL.$D->username?>/groups" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?>><div class="one_option"><?php echo($this->lang('profile_txt_groups'));?></div></a>

                    </div>

                </div>
                
                <div class="clear"></div>
                
                <script>
                $('#menu-more-profile-link').click(function(e){
                    e.preventDefault();
                    if ($('#menu-more-container').is (':hidden')) {
                        closeEmerged();
                        $('#menu-more-container').show();
                    } else $('#menu-more-container').hide();
                    e.stopPropagation();
                });
                </script>

            </div>
        </div>

    </div>
    
</div>

<div id="space-in-mini" class="box-simple box-formovil" style="position:relative; display:none;">
    <div id="btsactions"></div>
    <div class="clear"></div>
</div>



<script>
function re_order() {
    <?php if ($D->_IS_LOGGED) { ?>
    thetop = $('.spacetop').width();
    if (thetop <= 480) {
        $('#area-the-actions').appendTo('#btsactions');
        $('#space-in-mini').show();
    }
    if (thetop > 480) {
        $('#space-in-mini').hide();
        $('#area-the-actions').appendTo('#profile-header');
    }
    <?php } ?>
}

re_order();
$(window).resize(function() {
    re_order();
});

$('#b-action-message').click(function(e){
    e.preventDefault();
    startChat('<?php echo $D->codeprofile?>','<?php echo $D->the_name_user?>', '<?php echo $D->username?>');
});
</script>

<script>

var msg_alert_cover_empty = stripslashes('<?php echo $this->designer->boxAlert($this->lang('setting_cover_alert_up_title'), $this->lang('setting_cover_alert_empty_msg'), $this->lang('setting_txt_close'))?>');
var msg_alert_cover_format = stripslashes('<?php echo $this->designer->boxAlert($this->lang('setting_cover_alert_up_title'), $this->lang('setting_cover_alert_format_msg'), $this->lang('setting_txt_close'))?>');
var msg_alert_cover_large = stripslashes('<?php echo $this->designer->boxAlert($this->lang('setting_cover_alert_up_title'), $this->lang('setting_cover_alert_large_msg'), $this->lang('setting_txt_close'))?>');

var msg_alert_avatar_empty = stripslashes('<?php echo $this->designer->boxAlert($this->lang('setting_avatar_alert_up_title'), $this->lang('setting_avatar_alert_empty_msg'), $this->lang('setting_txt_close'))?>');
var msg_alert_avatar_format = stripslashes('<?php echo $this->designer->boxAlert($this->lang('setting_avatar_alert_up_title'), $this->lang('setting_avatar_alert_format_msg'), $this->lang('setting_txt_close'))?>');
var msg_alert_avatar_large = stripslashes('<?php echo $this->designer->boxAlert($this->lang('setting_avatar_alert_up_title'), $this->lang('setting_avatar_alert_large_msg'), $this->lang('setting_txt_close'))?>');


$(function() {
    var posi_bg_number = '<?php echo str_replace('px', '', $D->position_cover_user)?>';

    function status_responsive() {
        widthCover = $('#cover-header').width();
        
        if (widthCover <= 300) {
            the_position = (300 * posi_bg_number) / 800;
            $('#cover-img').css('top', the_position);
        }

        if (widthCover > 300 && widthCover <= 480) {
            the_position = (480 * posi_bg_number) / 800;
            $('#cover-img').css('top', the_position);
        }

        if (widthCover > 480 && widthCover <= 768) {
            the_position = (768 * posi_bg_number) / 800;
            $('#cover-img').css('top', the_position);
        }
    }
    status_responsive();

    $(window).resize(function() {
        status_responsive();
    });

    <?php if ($D->_IS_LOGGED && $D->is_my_profile) { ?>

    <?php if ($D->with_avatar) { ?>
    $('#icon-remove-avatar').show();
    <?php } ?>

    <?php if (empty($D->cover_user)) {?>
    $('#move-bg-header').hide();
    $('#remove-bg-header').hide();
    <?php } ?>

    var posi_bg_initial = '<?php echo $D->position_cover_user?>';
    var posi_bg_new = posi_bg_initial;

    $('#move-bg-header').on('click', function() {

        $('#actions-cover').hide();
        
        $('#more-options-reposition').show();

        $('#cover-img').addClass('with_drag');        
        $('#shadow-header').on('click', function(){ return false; });

        var y1 = $('#cover-header').height();
        var y2 =  $('#cover-img').height();
        
        $('#cover-img').draggable({ disabled: false });
        $('#cover-img').draggable({
            scroll: false,
            axis: "y",
            drag: function(event, ui) {
                if(ui.position.top >= 0) ui.position.top = 0;
                else if(ui.position.top <= y1 - y2) ui.position.top = y1 - y2;
            },
            stop: function(event, ui) {
                posi_bg_new = ui.position.top;
            }
        });

    });

    $('#cancel-bg-header').on('click', function(){
        
        $('#actions-cover').show();
        
        $('#more-options-reposition').hide();

        $('#cover-img').removeClass('with_drag');
        $('#cover-img').draggable({ disabled: true });
        
        $('#cover-img').css('top', posi_bg_initial);

    });
    
    $('#save-bg-header').on('click', function(){
        
        $('#actions-cover').show();
        
        $('#more-options-reposition').hide();

        $('#cover-img').removeClass('with_drag');        
        $('#cover-img').draggable({ disabled: true });
        
        posi_bg_initial = posi_bg_new;
        var cadposi = '' + posi_bg_new + '';
        posi_bg_new = cadposi.replace('px','');
        
        posi_bg_number = posi_bg_new;
        
        saveRepositionBG(posi_bg_new);

    });

    var msg_delete_cover = stripslashes('<?php echo $this->designer->boxConfirm($this->lang('setting_cover_delete_title'), $this->lang('setting_cover_delete_msg'), $this->lang('setting_txt_confirm'), $this->lang('setting_txt_cancel'))?>');

    $('#remove-bg-header').on('click', function() {
        closeEmerged();
        _confirm(msg_delete_cover, nothign, removeCover, 1);
    });        

    $("#icon-actions-menu").on("click",function(){
        closeEmerged();
        positop = $("#icon-actions-menu").position()
        $('#menu-actions-cover').css('top',positop.top + 20);
        $('#menu-actions-cover').show();
        return false;
    });
    
    $('#link-cover, #icon-actions-menu').mouseover(function(){ $('#icon-actions-menu').css('opacity','1'); }).mouseout(function(){ $('#icon-actions-menu').css('opacity','0.5'); });
    
    $('#the-photo-avatar').mouseover(function(){ $('#icon-remove-avatar, #icon-upload-avatar').css('opacity','1'); }).mouseout(function(){ $('#icon-remove-avatar, #icon-upload-avatar').css('opacity','0.5'); });
    $('#icon-remove-avatar').mouseover(function(){ $('#icon-remove-avatar').css('opacity','1'); }).mouseout(function(){ $('#icon-remove-avatar').css('opacity','0.5'); });
    $('#icon-upload-avatar').mouseover(function(){ $('#icon-upload-avatar').css('opacity','1'); }).mouseout(function(){ $('#icon-upload-avatar').css('opacity','0.5'); });
    
    <?php } ?>

});
</script>