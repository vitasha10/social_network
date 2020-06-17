<div id="activity_<?php echo $D->code_activity?>" class="box-activity">

    <div class="ba-header">
        <?php if ($D->_IS_LOGGED) { ?>
        <div id="link_amenu_<?php echo $D->code_activity?>" class="ba-ico-menu-activity"><img src="<?php echo getImageTheme('icon-menu-in-post.png')?>"></div>
        <div id="amenu_<?php echo $D->code_activity?>" class="activity_menu _emerged">
            <div class="activity_menu_inside"><?php echo $D->block_menu_activity?></div>
        </div>
        <?php } ?>

        <div>
            <div class="ba-avatar" id="ba-avatar-<?php echo $D->code_activity?>"><a href="<?php echo $K->SITE_URL.$D->activity_who_does_it_username?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><img onmouseover="itemCard(0, 'ba-avatar-<?php echo $D->code_activity?>', '<?php echo $D->activity_who_does_it_code?>', <?php echo $D->item1_type?>)" onmouseout="ignoreItemCard()" src="<?php echo $D->activity_avatar ?>"></a></div>
            <div class="ba-info">
                <div class="ba-info-1">

                    <span id="name1-<?php echo $D->code_activity?>" onmouseover="itemCard(1, 'name1-<?php echo $D->code_activity?>', '<?php echo $D->activity_who_does_it_code?>', <?php echo $D->item1_type?>)" onmouseout="ignoreItemCard()"><a href="<?php echo $K->SITE_URL.$D->activity_who_does_it_username?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><?php echo $D->activity_who_does_it ?></a></span>

                    <?php if ($D->in_where == 1 || $D->in_where == 2 || $D->in_where == 3 || $D->in_where == 5 || $D->in_where == 6) { ?>
                    <span>&nbsp;<img src="<?php echo getImageTheme('arrow_to.png')?>">&nbsp;</span>
                    <span id="name2-<?php echo $D->code_activity?>" <?php if($D->in_where != 6) { ?> onmouseover="itemCard(1, 'name2-<?php echo $D->code_activity?>', '<?php echo $D->item2_code?>', <?php echo $D->item2_type?>)" onmouseout="ignoreItemCard()" <?php } ?>><a href="<?php echo $K->SITE_URL.$D->item2_uname?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><?php echo $D->item2_name ?></a></span>
                    <?php } ?>

                    <span><?php echo $D->text_actions?></span>

                    <span><?php echo(!empty($D->more_text_in_post_top) ? $D->more_text_in_post_top : ''); ?></span>

                </div>

                <?php if (!empty($D->more_text_in_post_bottom)) { ?>
                <div class="ba-info-3"><?php echo $D->more_text_in_post_bottom ?></div>
                <?php } ?>

                <div class="ba-info-2">
                    <span><img src="<?php echo getImageTheme('mini-clock.png')?>"></span>
                    <span class="link link-grey"><a href="<?php echo $K->SITE_URL.$D->activity_who_does_it_username.'/post/'.$D->code_activity?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><?php echo $D->activity_whendate ?></a></span>

                    <?php if ($D->activity_post_posted_in != 2 && $D->activity_post_posted_in != 3) { ?>
                    <span style="line-height:1.34; font-size:11px;">&middot;</span>

                        <?php if (($D->post_is_editable && $D->activity_post_posted_in == 0 && ($D->post_typepost != 4 && $D->post_typepost != 5 && $D->post_typepost != 6 && $D->post_typepost != 7 && $D->post_typepost != 8 && $D->post_typepost != 11 && $D->post_typepost != 12)) && $D->in_where == 0) { ?>
                    <span id="act_type_post_<?php echo $D->code_activity?>" class="hand">
                        <span style="line-height:1.34; font-size:11px;"><img id="theicon_<?php echo $D->code_activity?>" src="<?php echo $D->icono_typepost ?>"></span>
                        <span><img src="<?php echo getImageTheme('arrow-down.png')?>"></span>
                    </span>
                    <div style="position:relative; float:left;">
                        <div id="amwh_<?php echo $D->code_activity?>" class="m-whois _emerged">
                            <div class="no-opc-whois"><?php echo $this->lang('dashboard_newactivity_who_see');?></div>
                            <div id="amwh_public_<?php echo $D->code_activity?>" class="opc-whois">
                                <div><?php echo $this->lang('dashboard_newactivity_who_public');?></div>
                                <div class="descr"><?php echo $this->lang('dashboard_newactivity_who_public_descr');?></div>
                            </div>
                            <div id="amwh_friends_<?php echo $D->code_activity?>" class="opc-whois">
                                <div><?php echo $this->lang('dashboard_newactivity_who_friends');?></div>
                                <div class="descr"><?php echo $this->lang('dashboard_newactivity_who_friends_descr');?></div>
                            </div>
                            <div id="amwh_onlyme_<?php echo $D->code_activity?>" class="opc-whois">
                                <div><?php echo $this->lang('dashboard_newactivity_who_onlyme');?></div>
                                <div class="descr"><?php echo $this->lang('dashboard_newactivity_who_onlyme_descr');?></div>
                            </div>
                        </div>
                    </div>
                    
                    <script>
                        $("#act_type_post_<?php echo $D->code_activity?>").on("click",function(){
                            closeEmerged();
                            $('#amwh_<?php echo $D->code_activity?>').show();
                            return false;
                        });
                        
                        $("#amwh_public_<?php echo $D->code_activity?>").on("click",function(){
                            changeTypePost('<?php echo $D->code_activity?>', 0);
                        });
                        
                        $("#amwh_friends_<?php echo $D->code_activity?>").on("click",function(){
                            changeTypePost('<?php echo $D->code_activity?>', 1);
                        });
                    
                        $("#amwh_onlyme_<?php echo $D->code_activity?>").on("click",function(){
                            changeTypePost('<?php echo $D->code_activity?>', 2);
                        });
                    </script>
                    
                        <?php } else { ?>
                    <span style="line-height:1.34; font-size:11px;"><img src="<?php echo $D->icono_typepost ?>"></span>                        
                        <?php } ?>
                    
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>
    <div class="clear"></div>

    <div id="space_txt_message_<?php echo $D->code_activity?>" class="ba-body" style=" <?php echo(isset($D->activity_message) && !empty($D->activity_message) ? '' : 'padding-bottom:0px;' ) ?> ">

        <?php if (isset($D->activity_message_cut) && !empty($D->activity_message_cut)) { ?>

        <span id="block_min_<?php echo $D->code_activity?>"><?php echo nl2br($D->activity_message_cut); ?> <span id="see_more_<?php echo $D->code_activity?>" class="link link-blue"><?php echo $this->lang('activity_txt_see_more')?></span></span>

        <span id="block_max_<?php echo $D->code_activity?>" class="hide"><?php echo nl2br($D->activity_message); ?></span>

        <?php } else {?>

        <span id="block_max_<?php echo $D->code_activity?>"><?php echo nl2br($D->activity_message); ?></span>

        <?php } ?>

        <script>
        $('#see_more_<?php echo $D->code_activity?>').click(function(){
            $('#block_min_<?php echo $D->code_activity?>').fadeOut('fast', function(){
                $('#block_max_<?php echo $D->code_activity?>').fadeIn('fast');
            });
        });
        </script>

    </div>

    <?php if ($D->post_is_editable) { ?>
    <div class="hide" id="space_edit_message_<?php echo $D->code_activity?>" style="box-sizing:border-box; padding:10px 10px 0; margin-bottom:10px; ">
        <div style="background-color: #fff; border: 1px solid #9cb4d8;">
            <textarea class="action_autosize" style="width:100%; box-sizing:border-box; border:none; font-family: helvetica,arial,sans-serif; font-size:14px;"><?php echo $D->activity_message_original ?></textarea>
            <input type="hidden" id="tmp_edit_<?php echo $D->code_activity?>" value="<?php echo $D->activity_message_original;?>">
            <div style="background-color: #f6f7f9; border-top: 1px solid #e9eaed; margin-bottom:0; text-align: right; padding:5px;">
                <span id="edit_preload_<?php echo $D->code_activity?>" class="hide"><img src="<?php echo getImageTheme('preload.gif')?>"></span>
                <span id="edit_actions_<?php echo $D->code_activity?>">
                    <span id="edit_message_cancel_<?php echo $D->code_activity?>" class="my-btn my-btn-small"><?php echo $this->lang('activity_edit_text_cancel')?></span> <span id="edit_message_done_<?php echo $D->code_activity?>" class="my-btn my-btn-small my-btn-blue"><?php echo $this->lang('activity_edit_text_done')?></span>
                </span>
            </div>
        </div>
    </div>
    <script>

        $('#edit_message_cancel_<?php echo $D->code_activity?>').click(function(){
            closeEmerged();
            $('#space_edit_message_<?php echo $D->code_activity?>').hide();
            $('#space_txt_message_<?php echo $D->code_activity?>').show();
            $('#space_edit_message_<?php echo $D->code_activity?> textarea').val($('#tmp_edit_<?php echo $D->code_activity?>').val());
        });

        $('#edit_message_done_<?php echo $D->code_activity?>').click(function(){
            closeEmerged();
            updateActivity('<?php echo $D->code_activity?>');
        });    
    </script>
    <?php } ?>

    <?php if (isset($D->html_attach) && !empty($D->html_attach)) { ?>
        <?php echo $D->html_attach?>
    <?php } ?>

    <?php if (isset($D->html_embed) && !empty($D->html_embed)) { ?>
    <div class="ba-embed"><?php echo $D->html_embed ?></div>
    <?php } ?>

    <?php if (isset($D->html_shared) && !empty($D->html_shared)) { ?>
        <div style="padding:0 10px;"><?php echo $D->html_shared?></div>
    <?php } ?>

    <?php if ($D->show_bottom) { ?>

    <div class="ba-bottom">

        <?php if ($D->_IS_LOGGED) { ?>

        <div class="ba-actions">

            <div class="space-icons-actions">
                <div id="action-like-<?php echo $D->code_activity?>" class="opcaction">
                    <div id="space-like-<?php echo $D->code_activity?>">
                        <div class="act-ico"><img src="<?php echo getImageTheme($D->liketoUser ? 'post-ico-like-active.png' : 'post-ico-like.png')?>"></div>
                        <div class="act-text <?php echo($D->liketoUser ? 'active' : '')?>"><?php echo $this->lang('activity_txt_action_like')?></div>
                        <input type="hidden" id="status-like-<?php echo $D->code_activity?>" name="status-like-<?php echo $D->code_activity?>" value="<?php echo($D->liketoUser ? 1 : 0)?>">
                        <div class="clear"></div>
                    </div>
                    <span id="preload-like-<?php echo $D->code_activity?>" class="hide"><img src="<?php echo getImageTheme('preload.gif')?>"></span>
                </div>

                <div id="action-comment-<?php echo $D->code_activity?>" class="opcaction">
                    <div class="act-ico"><img src="<?php echo getImageTheme('post-ico-comment.png')?>"></div>
                    <div class="act-text"><?php echo $this->lang('activity_txt_action_comment')?></div>
                    <div class="clear"></div>
                </div>

                <?php if ($D->post_is_shareable) { ?>
                <div id="action-share-<?php echo $D->code_activity?>" class="opcaction">
                    <div class="act-ico"><img src="<?php echo getImageTheme('post-ico-share.png')?>"></div>
                    <div class="act-text"><?php echo $this->lang('activity_txt_action_share')?></div>
                    <div class="clear"></div>
                </div>
                <?php } ?>

                <input type="hidden" id="code_visit_<?php echo $D->code_activity?>" name="code_visit_<?php echo $D->code_activity?>" value="<?php echo $D->code_visitor?>">
                <input type="hidden" id="type_visit_<?php echo $D->code_activity?>" name="type_visit_<?php echo $D->code_activity?>" value="<?php echo $D->type_visitor?>">
                <div class="clear"></div>
            </div>

            <?php if ($D->post_is_shareable) { ?>

            <div id="share_ok_<?php echo $D->code_activity?>" class="msg_share_ok"></div>

            <div class="space-for-share-post hide">
                <div class="bold" style="color:#6E6E6E;"><?php echo $this->lang('activity_share_title')?></div>
                <div style="box-sizing:border-box; padding:5px 0 0;">
                    <div style="background-color: #fff; border: 1px solid #9cb4d8;">
                        <textarea id="share-msg-post-<?php echo $D->code_for_share?><?php echo $D->code_activity?>" name="share-msg-post-<?php echo $D->code_for_share?>" class="action_autosize" style="width:100%; box-sizing:border-box; border:none; font-family: helvetica,arial,sans-serif; font-size:14px; padding:5px;" placeholder="<?php echo $this->lang('activity_share_placeholder')?>"></textarea>
                        <input name="sh_for_who_<?php echo $D->code_for_share?>" type="hidden" id="sh_for_who_<?php echo $D->code_for_share?>" value="<?php echo $D->activity_for_who?>">
                        <input name="sh_code_writer_<?php echo $D->code_for_share?>" type="hidden" id="sh_code_writer_<?php echo $D->code_for_share?>" value="<?php echo $D->code_visitor?>">
                        <input name="sh_type_writer_<?php echo $D->code_for_share?>" type="hidden" id="sh_type_writer_<?php echo $D->code_for_share?>" value="<?php echo $D->type_visitor?>">
                        <input name="sh_posted_in_<?php echo $D->code_for_share?>" type="hidden" id="sh_posted_in_<?php echo $D->code_for_share?>" value="0">
                        <input name="sh_code_wall_<?php echo $D->code_for_share?>" type="hidden" id="sh_code_wall_<?php echo $D->code_for_share?>" value="<?php echo $D->code_visitor?>">

                        <div style="background-color: #f6f7f9; border-top: 1px solid #e9eaed; margin-bottom:0; text-align: right; padding:5px;">
                            <span id="share_preload_<?php echo $D->code_activity?>" class="hide"><img src="<?php echo getImageTheme('preload.gif')?>"></span>
                            <span id="share_actions_<?php echo $D->code_activity?>">
                                <span id="share_post_cancel_<?php echo $D->code_activity?>" class="my-btn my-btn-small"><?php echo $this->lang('activity_share_text_cancel')?></span> <span id="share_post_done_<?php echo $D->code_activity?>" class="my-btn my-btn-small my-btn-blue"><?php echo $this->lang('activity_share_text_share')?></span>
                            </span>
                        </div>
                    </div>
                </div>

            </div>

            <?php } ?>

        </div>

        <?php } ?>

        <div class="ba-nums-likes <?php echo(!$D->_IS_LOGGED ? 'nologin':'')?> <?php echo($D->activity_numlikes < 1 ? 'hide' : '') ?>">
            <div class="ba-num-likes-ico"><img src="<?php echo getImageTheme('ico-numlikes.png')?>"></div>
            <div class="ba-num-likes-text"><span class="link link-blue"><span class="activity_num_likes"><?php echo $D->activity_numlikes?></span></span></div>
            <div class="clear"></div>
        </div>

        <div class="ba-nums-shares <?php echo(!$D->_IS_LOGGED ? 'nologin':'')?> <?php echo($D->activity_numshares < 1 ? 'hide' : '') ?>">
            <div class="ba-num-shares-ico"><img src="<?php echo getImageTheme('ico-numshares.png')?>"></div>
            <div class="ba-num-shares-text"><span class="link link-blue"><span class="activity_num_shares"><?php echo $D->activity_numshares?></span></span></div>
            <div class="clear"></div>
        </div>

        <?php if (!empty($D->comments_html)) {?>
        <div class="ba-areacomments <?php echo(($D->activity_numshares == 0 && !$D->_IS_LOGGED) ? 'nonums' : '');?>">
            <div><?php echo $D->comments_html;?></div>
        </div>
        <?php } ?>

        <?php if ($D->_IS_LOGGED) { ?>
        <div style="padding:0 10px 0;" id="comments-news-<?php echo $D->code_activity?>"></div>
        <?php } ?>

        <?php if ($D->_IS_LOGGED) { ?>

        <div id="space-input-comment-<?php echo $D->code_activity?>">

            <div class="ba-areainputcomment">

                <div class="comment-avatar">
                    <img src="<?php echo $D->avatar_user;?>">
                </div>

                <div class="comment-input">
                    <div class="inside-area-input">
                        <form id="form-comment-<?php echo $D->code_activity?>" name="form-comment-<?php echo $D->code_activity?>" action="" method="POST" enctype="multipart/form-data">

                        <textarea id="textarea-comment-<?php echo $D->code_activity?>" name="textarea-comment-<?php echo $D->code_activity?>" class="comment_for_post action_autosize" rows="1" placeholder="<?php echo $this->lang('activity_comment_placeholder')?>"></textarea>
                        <div class="input-more">
                            <div class="ico-smiles"><img src="<?php echo getImageTheme('ico-smilecom.png')?>"></div>                        
                            <div class="menusmiles"><?php echo getAreaEmoticons('textarea-comment-'.$D->code_activity)?></div>
                            
                            <div class="ico-attach" id="button-attach-comment-<?php echo $D->code_activity?>"><img src="<?php echo getImageTheme('ico-attachcom.png')?>"></div>
                            <input id="attach-comment-<?php echo $D->code_activity?>" name="attach-comment-<?php echo $D->code_activity?>" type="file" accept="image/*">
                            
                            <div id="bstickerscom-<?php echo $D->code_activity?>" class="ico-stickerscom"><img src="<?php echo getImageTheme('ico-stickercom.png')?>"></div>
                            <div class="menustickers-comment"><div class="slimscrollers"><?php echo getAreaStickers($D->code_activity,'insertStickerComment'); ?></div></div>
                            
                            

                        </div>
                            <input name="cm_code_writer_<?php echo $D->code_activity?>" type="hidden" id="cm_code_writer_<?php echo $D->code_activity?>" value="<?php echo $D->code_visitor?>">
                            <input name="cm_type_writer_<?php echo $D->code_activity?>" type="hidden" id="cm_type_writer_<?php echo $D->code_activity?>" value="<?php echo $D->type_visitor?>">                    
                        </form>
                    </div>
                    <div class="space-attach-file" id="space-attach-file-<?php echo $D->code_activity?>">
                        <div class="delete-info-attach" id="delete-info-attach-<?php echo $D->code_activity?>">x</div>
                        <div class="inside-space-attach-file" id="info-attach-file-<?php echo $D->code_activity?>" style="background-image:url(<?php echo getImageTheme('ico-attach.png')?>); background-position:3px 5px; background-repeat:no-repeat; padding-left:20px;"></div>
                    </div>
                </div>
            </div>

        </div>

        <div id="preload-input-comment-<?php echo $D->code_activity?>" style="padding:10px;" class="centered hide"><img src="<?php echo getImageTheme('loader.gif')?>"></div>

        <?php } else { ?>

            <?php if ($D->activity_numshares == 0 && $D->activity_numlikes == 0) { ?>
        <div class="mrg5B"></div>
            <?php } ?>

            <?php if (!empty($D->comments_html)) { ?>
        <div class="mrg5B"></div>
            <?php } ?>

        <?php } ?>

    </div>

    <?php } ?>

    <script>

        <?php if ($D->_IS_LOGGED) { ?>

        document.getElementById('button-attach-comment-<?php echo $D->code_activity?>').onclick = function(e) {
            document.getElementById('attach-comment-<?php echo $D->code_activity?>').click()
        }

        document.getElementById('attach-comment-<?php echo $D->code_activity?>').onchange = function(e) {

            if (this.files[0].name != '') {
                var ext = this.files[0].name.split('.').pop().toLowerCase();
                if ($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
                    _alert(msg_error_format_attach_comment);
                    return;
                }
            }

            $('#info-attach-file-<?php echo $D->code_activity?>').html(this.files[0].name);
            $('#space-attach-file-<?php echo $D->code_activity?>').show();
            $('#button-attach-comment-<?php echo $D->code_activity?>').hide();
            $('#textarea-comment-<?php echo $D->code_activity?>').focus();
        }

        $('#delete-info-attach-<?php echo $D->code_activity?>').click(function(){
            closeEmerged();
            $('#info-attach-file-<?php echo $D->code_activity?>').html('');
            $('#space-attach-file-<?php echo $D->code_activity?>').hide();
            $('#button-attach-comment-<?php echo $D->code_activity?>').show();
            $('#attach-comment-<?php echo $D->code_activity?>').val('');
            $('#textarea-comment-<?php echo $D->code_activity?>').focus();
        });

        $('#textarea-comment-<?php echo $D->code_activity?>').on('keydown', function (event) {
            if (event.keyCode == 13 && event.shiftKey == 0) {
                event.preventDefault();
                var message = $(this).val();
                var the_photo = $('#attach-comment-<?php echo $D->code_activity?>').val();
                if(is_empty(message) && is_empty(the_photo)) return;
                commentPost('<?php echo $D->code_activity?>');
            }
        });

        <?php if ($D->post_is_shareable) { ?>

        $('#action-share-<?php echo $D->code_activity?>').click(function(){
            closeEmerged();
            $('#activity_<?php echo $D->code_activity?> .space-icons-actions').slideUp('low',function(){
                $('#activity_<?php echo $D->code_activity?> .space-for-share-post').slideDown('low');
            });
        });

        $('#share_post_cancel_<?php echo $D->code_activity?>').click(function(){
            closeEmerged();
            $('#activity_<?php echo $D->code_activity?> .space-for-share-post').slideUp('low',function(){
                $('#activity_<?php echo $D->code_activity?> .space-icons-actions').slideDown('low');
            });        
        });

        $('#share_post_done_<?php echo $D->code_activity?>').click(function(){
            closeEmerged();
            sharePost('<?php echo $D->code_for_share?>', '<?php echo $D->code_activity?>');
        });

        <?php } ?>

        $('#action-like-<?php echo $D->code_activity?>').click(function(){
            closeEmerged();
            likedPost('<?php echo $D->code_activity?>');
        });

        $('#action-comment-<?php echo $D->code_activity?>').click(function(){
            closeEmerged();
            $('#textarea-comment-<?php echo $D->code_activity?>').focus();            
        });

        $('#link_amenu_<?php echo $D->code_activity?>').click(function(e){
            closeEmerged();
            $('#amenu_<?php echo $D->code_activity?>').show();
            e.stopPropagation();
        });
		
            <?php if ($D->post_is_saveable) { ?>
        $('#optma_save_<?php echo $D->code_activity?>').click(function(e){
            closeEmerged();
            saveActivity('<?php echo $D->code_activity?>');
            e.stopPropagation();
        });
		
        $('#optma_unsave_<?php echo $D->code_activity?>').click(function(e){
            closeEmerged();
            unSaveActivity('<?php echo $D->code_activity?>');
            e.stopPropagation();
        });
            <?php } ?>

            <?php if ($D->post_is_editable) { ?>
        $('#optma_edit_<?php echo $D->code_activity?>').click(function(e){
            closeEmerged();
            $('#space_txt_message_<?php echo $D->code_activity?>').hide();
            $('#space_edit_message_<?php echo $D->code_activity?>').show();
            $('#space_edit_message_<?php echo $D->code_activity?> textarea').focus();
            e.stopPropagation();
        });
            <?php } ?>

            <?php if ($D->post_is_removable) { ?>

        $('#optma_delete_<?php echo $D->code_activity?>').click(function(e){
            closeEmerged();
            _confirm(msg_delete_post, nothign, deleteActivity, '<?php echo $D->code_activity?>');
            e.stopPropagation();
        });

            <?php } ?>

            <?php if ($D->post_is_reportable) { ?>
        $('#optma_report_<?php echo $D->code_activity?>').click(function(e){
            closeEmerged();
            themessage = replaceString('{#CODE#}', '<?php echo $D->code_activity?>', 3, msg_report_post)
            _confirmWithInput(themessage, nothign, reportActivity, '<?php echo $D->code_activity?>', '#textreason-<?php echo $D->code_activity?>');
            e.stopPropagation();
        });
        
        $('#optma_ureport_<?php echo $D->code_activity?>').click(function(e){
            closeEmerged();
            _confirm(msg_ureport_post, nothign, unReportActivity, '<?php echo $D->code_activity?>');
            e.stopPropagation();
        });
            <?php } ?>

            <?php if ($D->post_is_hideable) { ?>
        $('#optma_hide_<?php echo $D->code_activity?>').click(function(e){
            closeEmerged();
            _confirm(msg_hide_post, nothign, hideActivity, '<?php echo $D->code_activity?>');
            e.stopPropagation();
        });
            <?php } ?>

        <?php } ?>

    </script>
</div>