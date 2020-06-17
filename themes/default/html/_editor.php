<?php if(isset($D->js_script_editor)) echo $D->js_script_editor;?>
<div id="activity-editor">
    <form id="activity-new" name="activity-new" action="" method="POST" enctype="multipart/form-data">
    
    <?php
    /********************************************************************/
    /********************************************************************/
    ?>

    <div id="activity-editor-top">
    
        <div id="menu-tab-editor">
        
            <span id="tab-editor-01" class="opc-tab-editor">
                <i class="icon-tab-editor"><img src="<?php echo getImageTheme('icon-update-status.png')?>"></i>
                <span class="txt_opc_editor"><?php echo $this->lang('dashboard_newactivity_tab_status')?></span>
                <i id="p01" class="pointer-tab"><img src="<?php echo getImageTheme('pointer-tab.png')?>"></i>
            </span>
        
            <span id="tab-editor-02" class="opc-tab-editor space-tab">
                <i class="icon-tab-editor"><img src="<?php echo getImageTheme('icon-add-video.png')?>"></i>
                <span class="txt_opc_editor"><?php echo $this->lang('dashboard_newactivity_tab_video')?></span>
                <i id="p02" class="pointer-tab hide"><img src="<?php echo getImageTheme('pointer-tab.png')?>"></i>
            </span>
        
            <span id="tab-editor-03" class="opc-tab-editor space-tab">
                <i class="icon-tab-editor"><img src="<?php echo getImageTheme('icon-add-audio.png')?>"></i>
                <span class="txt_opc_editor"><?php echo $this->lang('dashboard_newactivity_tab_music')?></span>
                <i id="p03" class="pointer-tab hide"><img src="<?php echo getImageTheme('pointer-tab.png')?>"></i>
            </span>
            
        </div>
        
        <?php if ($D->editor_for == 1) { ?>
        <div id="space-top-avatar-writer"><img src="<?php echo $D->the_avatar_page_umin?>" alt="<?php echo $D->editor_text_posting_as?>" title="<?php echo $D->editor_text_posting_as?>"></div>
        <?php } ?>
        
        <div id="preload-editor"><img src="<?php echo getImageTheme('preload.gif')?>"></div>
        
        <div class="clear"></div>
        
        <script>
            
            $('#tab-editor-01 .txt_opc_editor').css('color','#333');
            $('#tab-editor-01').css('cursor','default');
        
            $('#tab-editor-01').click(function(){
                goTab1();     
            });
        
            $('#tab-editor-02').click(function(){   
                goTab2();     
            });
        
            $('#tab-editor-03').click(function(){        
                goTab3();
            });
        
        </script>    
    
    </div>
    
    <?php
    /********************************************************************/
    /********************************************************************/
    ?>
    
    <div id="activity-editor-textarea">
    
        <div id="space-input">
            <div class="_a">
    
                <div id="input-video" class="hide">
                    <div id="action_upload_video">
                        <div id="the_upload_video" class="my-btn my-btn-ico-top"><img style="padding-top:3px;" src="<?php echo getImageTheme('icon-add-video.png')?>"><br><?php echo $this->lang('dashboard_newactivity_txt_select_video')?></div>
                        <input id="video_activity_new" name="video_activity_new" accept="video/*" type="file">
                    </div>
                    <div id="info_upload_video">
                        <div id="remove_info_video">X</div>
                        <div style="font-size:13px; color:#A6A6A6;"><?php echo $this->lang('dashboard_newactivity_txt_video')?>:</div>
                        <div id="selected_file_video" style="font-size:15px; color:#696969; word-break: break-all;"></div>
                    </div>
                    <div class="clear"></div>
                                        
                    <script>
                    var sizeVideo = <?php echo $K->FILE_SIZE_VIDEO?>;
                    
                    var filevideo = null;
                    
                    var btnUploadVideo = document.getElementById('the_upload_video');
                    var inputVideo = document.getElementById('video_activity_new');
                    
                    btnUploadVideo.onclick = function(e) {
                        document.getElementById("video_activity_new").click()
                    }
                    
                    inputVideo.onchange = function(e) {
                        filevideo = this.files[0];
                        $('#selected_file_video').html(filevideo.name);
                        $('#action_upload_video').hide();
                        $('#info_upload_video').show();
                    }
                    
                    btnUploadVideo.addEventListener('dragover', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        return false;
                    }, false);
                    
                    btnUploadVideo.addEventListener('drop', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        if (e.dataTransfer.files.length == 1) {
                            filevideo = e.dataTransfer.files[0];
                            $('#selected_file_video').html(filevideo.name);
                            $('#action_upload_video').hide();
                            $('#info_upload_video').show();
                        }
                        return false;
                    }, false);
                    
                    $('#remove_info_video').on("click", function(){
                        $('#selected_file_video').html('');
                        $('#info_upload_video').hide();
                        $('#action_upload_video').show();
                        filevideo = null;
                    });
                    </script>
                </div>
    
                <div id="input-audio" class="hide">
                    <div id="action_upload_audio">
                        <div id="the_upload_audio" class="my-btn my-btn-ico-top"><img style="padding-top:3px;" src="<?php echo getImageTheme('icon-add-audio.png')?>"><br><?php echo $this->lang('dashboard_newactivity_txt_select_audio')?></div>
                        <input id="audio_activity_new" name="audio_activity_new" accept="audio/*" type="file">
                    </div>
                    <div id="info_upload_audio">
                        <div id="remove_info_audio">X</div>
                        <div style="font-size:13px; color:#A6A6A6;"><?php echo $this->lang('dashboard_newactivity_txt_audio')?>:</div>
                        <div id="selected_file_audio" style="font-size:15px; color:#696969;"></div>
                    </div>
                    <div class="clear"></div>

                    <script>
                    var sizeAudio = <?php echo $K->FILE_SIZE_AUDIO?>;
                    
                    var fileaudio = null;
                    
                    var btnUploadAudio = document.getElementById('the_upload_audio');
                    var inputAudio = document.getElementById('audio_activity_new');
                    
                    btnUploadAudio.onclick = function(e) {
                        document.getElementById("audio_activity_new").click()
                    }
                    
                    inputAudio.onchange = function(e) {
                        fileaudio = this.files[0];
                        $('#selected_file_audio').html(fileaudio.name);
                        $('#action_upload_audio').hide();
                        $('#info_upload_audio').show();
                    }
                    
                    btnUploadAudio.addEventListener('dragover', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        return false;
                    }, false);
                    
                    btnUploadAudio.addEventListener('drop', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        if (e.dataTransfer.files.length == 1) {
                            fileaudio = e.dataTransfer.files[0];
                            $('#selected_file_audio').html(fileaudio.name);
                            $('#action_upload_audio').hide();
                            $('#info_upload_audio').show();
                        }
                        return false;
                    }, false);
                    
                    $('#remove_info_audio').on("click", function(){
                        $('#selected_file_audio').html('');
                        $('#info_upload_audio').hide();
                        $('#action_upload_audio').show();
                        fileaudio = null;
                    });
                    </script>

                </div>
    
                <div class="_b">
                    <textarea id="text-new-activity" name="text-new-activity" class="action_autosize" placeholder="<?php echo $D->placeholder_textarea_editor ?>"></textarea>
                    
                </div>
                
                <div id="content-embed"></div>
    
    
            </div>
        </div>
    
        <div id="filling">
            <div id="areaf3">x</div>
            <div id="areaf1"><?php echo $this->lang('dashboard_newactivity_txt_feeling')?></div>
            <div id="areaf2">
                <div style="display:flex;">
                    <div style="flex:1;">
                        <input id="input_feeling" name="input_feeling" type="text" maxlength="25" style=" width:100%;">
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>

        <?php if (isset($D->editor_for) && $D->editor_for != 1) { ?>
        <div id="withp">
            <div id="areaw3">x</div>
            <div id="areaw1"><?php echo $this->lang('dashboard_newactivity_txt_people')?></div>
            <div id="areaw2">
                <div style="display:flex;">
                    <div style="flex:1;">
                        <input id="input_withp" name="input_withp" type="text" maxlength="50" style=" width:100%;">
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <?php } ?>

        <div id="insitu">
            <div id="areai3">x</div>
            <div id="areai1"><?php echo $this->lang('dashboard_newactivity_txt_location')?></div>
            <div id="areai2">
                <div style="display:flex;">
                    <div style="flex:1;">
                        <input id="input_insitu" name="input_insitu" type="text" maxlength="50" style=" width:100%;">
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        
        <div id="msg-photos" style="background-image:url(<?php echo getImageTheme('ico-attach.png')?>); background-position:3px 6px; background-repeat:no-repeat; padding-left:20px;">
            <span id="delele_msg_photos">x</span>
            <span id="nquantity"></span> <span id="msg_quantity"></span>
        </div>
    
    </div>
    
    <?php
    /********************************************************************/
    /********************************************************************/
    ?>
    
    <div id="activity-editor-bottom">
    
        <div id="space-bottom-editor">
            <div id="bottom-accesories">
        
                <div id="icons">
                    
                    <div id="b-opc-attach-files" class="ico-attach-first">
                        <div class="_a">
                            <div class="_b">
                                <div class="_c">
                                <img src="<?php echo getImageTheme('attach-photo.png')?>">
                                <input id="photos_selected_new" class="_d" title="<?php echo $this->lang('dashboard_newactivity_alt_photo')?>" multiple name="photos_activity_new[]" accept="image/*" type="file">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php if (isset($D->editor_for) && ($D->editor_for != 1 && $D->editor_for != 3)) { ?>
                    <div id="b-opc-attach-people" class="ico-attach" title="<?php echo $this->lang('dashboard_newactivity_alt_people')?>"><img src="<?php echo getImageTheme('attach-user.png')?>"></div>
                    <?php } ?>
                    
                    <div id="b-opc-attach-feeling" class="ico-attach" title="<?php echo $this->lang('dashboard_newactivity_alt_feeling')?>"><img src="<?php echo getImageTheme('attach-smile.png')?>"></div>
                    
                    <div id="b-opc-attach-location" class="ico-attach" title="<?php echo $this->lang('dashboard_newactivity_alt_location')?>"><img src="<?php echo getImageTheme('attach-pointer.png')?>"></div>
                    
                    <input name="typeattach" type="hidden" id="typeattach" value="">
                    <input name="infoembed" type="hidden" id="infoembed" value="">
                    <input name="typeembed" type="hidden" id="typeembed" value="0">
                </div>
        
        
            </div>
            
            <div id="area-send">
            
                <?php if (isset($D->editor_for) && $D->editor_for == 0) { ?>
                
                <?php if (isset($D->view_selector_who) && $D->view_selector_who) { ?>
                
                <div id="area-select-whois">
                    <div id="select-whois">
                        <span id="txt-for-who"></span>
                        <span><img src="<?php echo getImageTheme('arrow-down.png')?>"></span>
                    </div>            
                    
                    <div>
                        <div id="menu-whois" class="_emerged">
                            <div class="no-opc-whois"><?php echo $this->lang('dashboard_newactivity_who_see');?></div>
                            <div id="m-whois-public" class="opc-whois">
                                <div><?php echo $this->lang('dashboard_newactivity_who_public');?></div>
                                <div class="descr"><?php echo $this->lang('dashboard_newactivity_who_public_descr');?></div>
                            </div>
                            <div id="m-whois-friends" class="opc-whois">
                                <div><?php echo $this->lang('dashboard_newactivity_who_friends');?></div>
                                <div class="descr"><?php echo $this->lang('dashboard_newactivity_who_friends_descr');?></div>
                            </div>
                            <div id="m-whois-onlyme" class="opc-whois">
                                <div><?php echo $this->lang('dashboard_newactivity_who_onlyme');?></div>
                                <div class="descr"><?php echo $this->lang('dashboard_newactivity_who_onlyme_descr');?></div>
                            </div>
                        </div>
                    </div>
        
                </div>
                
                <?php } ?>
                
                <?php } ?>
            
                <div id="bottom-send">
                    <div id="inside-send" class="ellipsis"><?php echo $this->lang('dashboard_newactivity_bpost')?></div>
                </div>
        
                <div class="clear"></div>
        
            </div>
            
            <div class="clear"></div>
        
        </div>
        
        <div id="space-preload-editor" class="hide" style="text-align:center; padding-top:12px;"><img src="<?php echo getImageTheme('loader.gif')?>"></div>
        
        <div class="clear"></div>
        
        <script>
            var posted_in = <?php echo $D->posted_in_editor ?>;
            var code_wall = '<?php echo $D->code_wall_editor ?>';
            var code_writer = '<?php echo $D->code_writer_editor?>';
            var type_writer = <?php echo $D->type_writer_editor ?>;
            var for_who = <?php echo $D->for_who_editor ?>;

        <?php if (isset($D->editor_for) && $D->editor_for == 0) { ?>
        
            var txt_public = stripslashes('<?php echo strJS($this->lang('dashboard_newactivity_who_public'));?>');
            var txt_friends = stripslashes('<?php echo strJS($this->lang('dashboard_newactivity_who_friends'));?>');
            var txt_onlyme = stripslashes('<?php echo strJS($this->lang('dashboard_newactivity_who_onlyme'));?>');
            
            function applyForWho(fw) {
                switch (fw) {
                    case 0:
                        $('#txt-for-who').text(txt_public);
                        for_who = 0;
                        break;
                    case 1:
                        $('#txt-for-who').text(txt_friends);
                        for_who = 1;
                        break;
                    case 2:
                        $('#txt-for-who').text(txt_onlyme);
                        for_who = 2;
                        break;                    
                }
            }
            
            applyForWho(for_who);
            
            $("#select-whois").on("click",function(){
                closeEmerged();
                positop = $("#select-whois").position()
                $('#menu-whois').css('top',positop.top + 17);
                $('#menu-whois').show();
                return false;
            });
        
            $("#m-whois-public").on("click",function(){
                applyForWho(0);
                $('#menu-whois').hide();
                return false;
            });
            
            $("#m-whois-friends").on("click",function(){
                applyForWho(1);
                $('#menu-whois').hide();
                return false;
            });
        
            $("#m-whois-onlyme").on("click",function(){
                applyForWho(2);
                $('#menu-whois').hide();
                return false;
            });
            
        <?php } ?>
            
            $('#text-new-activity').keyup(function(){
                typeattach = $.trim($('#typeattach').val());
                if (typeattach != '') return;
                infoembed = $.trim($('#infoembed').val());
                if (infoembed != '') return;
                
                var the_url_in_status = $(this).val().match(/(https?:\/\/[^\s]+)/gi);
                if (the_url_in_status === null || the_url_in_status.length == 0) return;
                var the_real_url = the_url_in_status[0];
                if (!validateUrl(the_real_url)) return;                
                getEmbed(the_real_url);
            });
            
            <?php if (isset($D->editor_for) && $D->editor_for != 1) { ?>
            var attach_people = 0;
            $('#b-opc-attach-people').click(function(){
                if (attach_people == 0) {
                    attach_people = 1;
                    $('#withp').show();
                    $('#input_withp').focus();
                } else {
                    attach_people = 0;
                    $('#withp').hide();
                    $('#input_withp').val('');
                }
            });
            <?php } ?>

            $('#areaw3').click(function(){
                attach_people = 0;
                $('#withp').hide();
                $('#input_withp').val('');
            });

            var attach_feeling = 0;
            $('#b-opc-attach-feeling').click(function(){
                if (attach_feeling == 0) {
                    attach_feeling = 1;
                    $('#filling').show();
                    $('#input_feeling').focus();
                } else {
                    attach_feeling = 0;
                    $('#filling').hide();
                    $('#input_feeling').val('');
                }
            });
            
            $('#areaf3').click(function(){
                attach_feeling = 0;
                $('#filling').hide();
                $('#input_feeling').val('');
            });

            var attach_location = 0;
            $('#b-opc-attach-location').click(function(){
                if (attach_location == 0) {
                    attach_location = 1;
                    $('#insitu').show();
                    $('#input_insitu').focus();
                } else {
                    attach_location = 0;
                    $('#insitu').hide();
                    $('#input_insitu').val('');
                }
            });

            $('#areai3').click(function(){
                attach_location = 0;
                $('#insitu').hide();
                $('#input_insitu').val('');
            });
            
            $('body').on('click', '#embed-remove', function() {
                $('#infoembed').val('');
                $('#typeembed').val('0');
                $('#content-embed').html('').fadeOut();
                show_attach_file();
            });
        </script>
    
    
    </div>

    <?php
    /********************************************************************/
    /********************************************************************/
    ?>
    
    
    </form>
</div>
<div id="new-activity"></div>

<script>
    
    var placeholder_editor_status = stripslashes('<?php echo strJS($this->lang('dashboard_newactivity_ph_textarea'))?>');
    var placeholder_editor_status_video = stripslashes('<?php echo strJS($this->lang('dashboard_newactivity_ph_textarea_video'))?>');
    var placeholder_editor_status_audio = stripslashes('<?php echo strJS($this->lang('dashboard_newactivity_ph_textarea_audio'))?>');

    var msg_alert_format = stripslashes('<?php echo $this->designer->boxAlert($this->lang('dashboard_newactivity_error_format_image_title'), $this->lang('dashboard_newactivity_error_format_image_msg'), $this->lang('dashboard_newactivity_error_bclose'))?>');
    
    var msg_alert_status_empty = stripslashes('<?php echo $this->designer->boxAlert($this->lang('dashboard_newactivity_error_status_title'), $this->lang('dashboard_newactivity_error_status_empty'), $this->lang('dashboard_newactivity_error_bclose'))?>');
    
    var msg_alert_video_wrong = stripslashes('<?php echo $this->designer->boxAlert($this->lang('dashboard_newactivity_error_video_title'), $this->lang('dashboard_newactivity_error_video_wrong'), $this->lang('dashboard_newactivity_error_bclose'))?>');
    
    var msg_alert_video_large = stripslashes('<?php echo $this->designer->boxAlert($this->lang('dashboard_newactivity_error_video_title'), $this->lang('dashboard_newactivity_error_video_large'), $this->lang('dashboard_newactivity_error_bclose'))?>');
    
    var msg_alert_audio_empty = stripslashes('<?php echo $this->designer->boxAlert($this->lang('dashboard_newactivity_error_audio_title'), $this->lang('dashboard_newactivity_error_audio_empty'), $this->lang('dashboard_newactivity_error_bclose'))?>');
    
    var msg_alert_audio_wrong = stripslashes('<?php echo $this->designer->boxAlert($this->lang('dashboard_newactivity_error_audio_title'), $this->lang('dashboard_newactivity_error_audio_wrong'), $this->lang('dashboard_newactivity_error_bclose'))?>');
    
    var msg_alert_audio_large = stripslashes('<?php echo $this->designer->boxAlert($this->lang('dashboard_newactivity_error_audio_title'), $this->lang('dashboard_newactivity_error_audio_large'), $this->lang('dashboard_newactivity_error_bclose'))?>');
    
    $('#bottom-send').click(function() {
        sendNewPost();
    });

    msg_one = stripslashes('<?php echo strJS($this->lang('dashboard_newactivity_msg_quantity_photo'));?>');
    msg_more = stripslashes('<?php echo strJS($this->lang('dashboard_newactivity_msg_quantity_photos'));?>');
    $('#photos_selected_new:file').change(function () {
        if (this.files.length == 1) {
            $('#nquantity').text(1);
            $('#msg_quantity').text(msg_one);
            $('#msg-photos').show();
        } else {
            $('#nquantity').text(this.files.length);
            $('#msg_quantity').text(msg_more);
            $('#msg-photos').show();
        }
        $('#typeattach').val('photos');
    });

    $('#delele_msg_photos').click(function(){
        $('#msg-photos').hide();
        $('#typeattach').val('');
        resetFile("#photos_selected_new");
    });

</script>