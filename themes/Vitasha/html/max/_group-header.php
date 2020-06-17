<div id="profile-header">
    
    <div id="cover-header" <?php echo(empty($D->cover_group)?'':'class="with_cover"') ?>>

        <div id="space-cover-header">
        <?php if ($D->with_cover) { ?>
        <a href="<?php echo $K->SITE_URL.$D->cover_user.'/photo/'.$D->cover_media?>" class="zoomeer with_cover" data-id="<?php echo $D->cover_media?>" data-image="<?php echo $D->cover_group?>" data-place="cover-group" id="link-cover">
        <img id="cover-img" src="<?php echo $D->cover_group?>" style=" top:<?php echo $D->position_cover_group?>">
        <div id="shadow-header"></div>
        </a>
        <?php } ?>
        </div>
        
        <div class="clear"></div>
        
        <?php if ($D->_IS_LOGGED && $D->is_my_group) { ?>
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

                    var _tp = 2;
                    var _cp = '<?php echo $D->codegroup?>';                    
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

    <div id="username-header" class="ingroup"><a href="<?php echo $K->SITE_URL.$D->username?>" class="undecorated" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><span id="the-name"><?php echo $D->the_title?></span></a></div>
    <div id="type-group"><span><img src="<?php echo getImageTheme($D->ico_type_group);?>"></span> <span><?php echo $D->text_type_group?></span></div>
    
    <?php if ($D->_IS_LOGGED) { ?>

    <div id="area-the-actions">
        <?php if ($D->is_my_group) { ?>

        <a href="<?php echo $K->SITE_URL.$D->username?>/settings" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?>><span class="my-btn my-btn-small"><?php echo $this->lang('profile_txt_settings')?></span></a>

        <?php } else { ?>
        <div class="item_action hide" id="preload-b-action">
            <span style="padding:0 10px;"><img src="<?php echo getImageTheme('preload.gif');?>"></span>
        </div>
        <div class="item_action hide" id="area-action-join">
            <span id="b-action-join" class="my-btn my-btn-small"><?php echo $this->lang('profile_txt_join_group')?></span>
        </div>
        <div class="item_action hide" id="area-action-pending">
            <span id="b-action-pending" class="my-btn my-btn-small"><?php echo $this->lang('profile_txt_pending')?></span>
            
            <div id="submenu-cancel" class="boxsubmenu hide">
                <div id="opc-cancelrequest" class="opcsm"><?php echo $this->lang('profile_txt_cancel_request');?></div>
            </div>
        </div>
        <div class="item_action hide" id="area-action-joined">
            <div id="b-action-joined" class="my-btn my-btn-green my-btn-small"><?php echo $this->lang('profile_txt_joined')?></div>

            <div id="submenu-leave" class="boxsubmenu hide">
                <div id="opc-leavegroup" class="opcsm"><?php echo $this->lang('profile_txt_leave_group');?></div>
            </div>
        </div>
        
        <div class="clear"></div>
        
        <script>
        <?php if ($D->membership == 1) { ?>
        $('#area-action-joined').show();
        <?php } ?>

        <?php if ($D->membership == 0) { ?>
        $('#area-action-pending').show();
        <?php } ?>

        <?php if ($D->membership == 2) { ?>
        $('#area-action-join').show();
        <?php } ?>

        var cgroup = '<?php echo $D->codegroup?>';
        $('#b-action-join').click(function() {
            joinedGroup();
        });
        
        $('#b-action-pending').mouseover(function(){
            showSubmenuAction('#submenu-cancel');
        });

    	$('#b-action-pending').mouseleave(function(){
            hideSubmenuAction('#submenu-cancel');
            
        });
            
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

        $('#submenu-cancel').mouseover(function() {
            keepSubMenuVisible(controllerSubmenuView2);
        });

        $('#submenu-cancel').mouseleave(function() {
            hideSubmenuAction('#submenu-cancel');
        });    
        
        $('#opc-cancelrequest').click(function(){
            cancelRequest();
        });



        $('#b-action-joined').mouseover(function(){
            showSubmenuAction('#submenu-leave');
        });

    	$('#b-action-joined').mouseleave(function(){
            hideSubmenuAction('#submenu-leave');
        });

        $('#submenu-leave').mouseover(function() {
            keepSubMenuVisible(controllerSubmenuView2);
        });

        $('#submenu-leave').mouseleave(function() {
            hideSubmenuAction('#submenu-leave');
        });    

        $('#opc-leavegroup').click(function(){
            leaveGroup();
        });

        </script>

        <?php } ?>
    </div>
    
    <?php } ?>
    
    <div id="cover-bottom">
        <div id="area-menu-header" class="ingroup">

            <div id="inside-menu" class="ingroup">
                
                <div id="in-content">

                    <a href="<?php echo $K->SITE_URL.$D->username?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?> class="one-option"><?php echo($this->lang('profile_txt_timeline'));?></a>
                    <a href="<?php echo $K->SITE_URL.$D->username?>/photos" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?> class="one-option no_in_movil"><?php echo($this->lang('profile_txt_photos'));?></a>
                    <a href="<?php echo $K->SITE_URL.$D->username?>/videos" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?> class="one-option no_in_movil no_in_movil_land"><?php echo($this->lang('profile_txt_videos'));?></a>
                    <a href="<?php echo $K->SITE_URL.$D->username?>/audios" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?> class="one-option no_in_movil no_in_movil_land"><?php echo($this->lang('profile_txt_audios'));?></a>
                    <a href="<?php echo $K->SITE_URL.$D->username?>/members" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?> class="one-option no_in_movil no_in_movil_land"><?php echo($this->lang('profile_txt_members'));?></a>

                    <a href="<?php echo $K->SITE_URL.$D->username?>" id="menu-more-profile-link" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?> class="one-option no_in_tablet yes_in_movil yes_in_movil_land"><span><?php echo($this->lang('profile_txt_more'));?></span> <span><img src="<?php echo getImageTheme('ico-more-menu.png')?>"></span></a>

                    
                    <div id="menu-more-container" class="_emerged">
                        
                        <a href="<?php echo $K->SITE_URL.$D->username?>/photos" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?> class="yes_in_movil"><div class="one_option"><?php echo($this->lang('profile_txt_photos'));?></div></a>
                        
                        <a href="<?php echo $K->SITE_URL.$D->username?>/videos" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?> class="yes_in_movil yes_in_movil_land"><div class="one_option"><?php echo($this->lang('profile_txt_videos'));?></div></a>
                        
                        <a href="<?php echo $K->SITE_URL.$D->username?>/audios" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?> class="yes_in_movil yes_in_movil_land"><div class="one_option"><?php echo($this->lang('profile_txt_audios'));?></div></a>
                        
                        <a href="<?php echo $K->SITE_URL.$D->username?>/members" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?>><div class="one_option"><?php echo($this->lang('profile_txt_members'));?></div></a>
                    </div>

                </div>
                
                <div class="clear"></div>

                <script>
                $('#menu-more-profile-link').click(function(e){
                    e.preventDefault();
                    if ($('#menu-more-container').is (':hidden')) $('#menu-more-container').show();
                    else $('#menu-more-container').hide();
                    e.stopPropagation();
                });
                </script>

            </div>
        </div>

    </div>
    
</div>

<script>
var msg_alert_cover_empty = stripslashes('<?php echo $this->designer->boxAlert($this->lang('setting_cover_alert_up_title'), $this->lang('setting_cover_alert_empty_msg'), $this->lang('setting_txt_close'))?>');
var msg_alert_cover_format = stripslashes('<?php echo $this->designer->boxAlert($this->lang('setting_cover_alert_up_title'), $this->lang('setting_cover_alert_format_msg'), $this->lang('setting_txt_close'))?>');
var msg_alert_cover_large = stripslashes('<?php echo $this->designer->boxAlert($this->lang('setting_cover_alert_up_title'), $this->lang('setting_cover_alert_large_msg'), $this->lang('setting_txt_close'))?>');

$(function() {
    var posi_bg_number = '<?php echo str_replace('px', '', $D->position_cover_group)?>';

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

    <?php if (empty($D->cover_group)) {?>
    $('#link-cover').hide();
    <?php } ?>

    <?php if ($D->_IS_LOGGED && $D->is_my_group) { ?>

    <?php if (empty($D->cover_group)) {?>
    $('#move-bg-header').hide();
    $('#remove-bg-header').hide();
    <?php } ?>

    var posi_bg_initial = '<?php echo $D->position_cover_group?>';
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
    
    <?php } ?>

});
</script>