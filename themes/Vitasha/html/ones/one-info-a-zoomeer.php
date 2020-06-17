<div id="media-<?php echo $D->codemedia?>" class="info-zoomeer">
    <div class="zo-header">
        <div class="zo-avatar"><img src="<?php echo $D->url_avatar?>"></div>

        <div class="zo-info">
            <div class="zo-info-1"><a href="<?php echo $K->SITE_URL.$D->username?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><?php echo $D->name?></a></div>
            <div class="zo-info-2">
                <span><img src="<?php echo getImageTheme('mini-clock.png')?>"></span>
                <span class="link link-grey"><a href="<?php echo $K->SITE_URL.$D->username.'/post/'.$D->postcode?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><?php echo $D->post_date ?></a></span>

                <?php if ($D->posted_in != 2) { ?>
                <span style="line-height:1.34; font-size:11px;">&middot;</span>
                <span style="line-height:1.34; font-size:11px;"><img src="<?php echo $D->icono_typepost ?>"></span>
                <?php } ?>

            </div>

        </div>

    </div>

    <div class="clear"></div>

    <?php if ($D->_IS_LOGGED) { ?>

    <div class="zo-bottom">
        <div class="zo-actions">
            <div class="space-icons-actions">

                <div id="action-like-media-<?php echo $D->codemedia?>" class="opcaction">
                    <div id="space-like-media-<?php echo $D->codemedia?>">
                        <div class="act-ico"><img src="<?php echo getImageTheme($D->liketoUser ? 'post-ico-like-active.png' : 'post-ico-like.png')?>"></div>
                        <div class="act-text <?php echo($D->liketoUser ? 'active' : '')?>"><?php echo $this->lang('activity_txt_action_like')?></div>
                        <input type="hidden" id="status-like-media-<?php echo $D->codemedia?>" name="status-like-media-<?php echo $D->codemedia?>" value="<?php echo($D->liketoUser ? 1 : 0)?>">
                        <div class="clear"></div>
                    </div>
                    <span id="preload-like-media-<?php echo $D->codemedia?>" class="hide"><img src="<?php echo getImageTheme('preload.gif')?>"></span>
                </div>

                <div id="action-comment-media-<?php echo $D->codemedia?>" class="opcaction">
                    <div class="act-ico"><img src="<?php echo getImageTheme('post-ico-comment.png')?>"></div>
                    <div class="act-text"><?php echo $this->lang('activity_txt_action_comment')?></div>
                    <div class="clear"></div>
                </div>

                <div class="clear"></div>

            </div>
        </div>

        <div class="zo-nums-likes <?php echo(!$D->_IS_LOGGED ? 'nologin':'')?> <?php echo($D->numlikes < 1 ? 'hide' : '') ?>">
            <div class="zo-num-likes-ico"><img src="<?php echo getImageTheme('ico-numlikes.png')?>"></div>
            <div class="zo-num-likes-text"><span class="link link-blue"><span class="media_num_likes"><?php echo $D->numlikes?></span></span></div>
            <div class="clear"></div>
        </div>

        <?php if (!empty($D->comments_html)) {?>
        <div class="zo-areacomments <?php echo(!$D->_IS_LOGGED ? 'nonums' : '');?>">
            <div><?php echo $D->comments_html;?></div>
        </div>
        <?php } ?>

        <?php if ($D->_IS_LOGGED) { ?>
        <div style="padding:0 10px 0;" id="comments-media-news-<?php echo $D->codemedia?>"></div>
        <?php } ?>

        <?php if ($D->_IS_LOGGED) { ?>

        <div class="zo-areainputcomment">
            <div class="comment-avatar">
                <img src="<?php echo $D->avatar_user;?>">
            </div>

            <div class="comment-input">
                <div class="inside-area-input">
                    <form id="form-comment-<?php echo $D->codemedia?>" name="form-comment-<?php echo $D->codemedia?>" action="" method="POST">

                    <textarea id="textarea-comment-media-<?php echo $D->codemedia?>" name="textarea-comment-media-<?php echo $D->codemedia?>" class="comment_for_post action_autosize" rows="1" placeholder="<?php echo $this->lang('activity_comment_placeholder')?>"></textarea>
                    <div class="input-more">
                        <div class="ico-smiles"><img src="<?php echo getImageTheme('ico-smilecom.png')?>"></div>
                        <div class="menusmiles inzoom"><?php echo getAreaEmoticons('textarea-comment-media-'.$D->codemedia)?></div>
                        
                        <div id="bstickerscommed-<?php echo $D->codemedia?>" class="ico-stickerscom"><img src="<?php echo getImageTheme('ico-stickercom.png')?>"></div>
                        <div class="menustickers-comment inzoom"><div class="slimscrollers"><?php echo getAreaStickers($D->codemedia, 'insertStickerCommentMedia'); ?></div></div>
                        
                    </div>
                    </form>
                </div>

            </div>
        </div>

        <?php } else { ?>

            <?php if ($D->activity_numlikes == 0) { ?>
        <div class="mrg5B"></div>
            <?php } ?>

            <?php if (!empty($D->comments_html)) { ?>
        <div class="mrg5B"></div>
            <?php } ?>

        <?php } ?>

    </div>

    <?php } ?>

</div>

<?php if ($D->_IS_LOGGED) { ?>
<script>
    var cmm_code_writer = '<?php echo $D->code_visitor?>';
    var cmm_type_writer = <?php echo $D->type_visitor?>;
    $('#textarea-comment-media-<?php echo $D->codemedia?>').on('keydown', function (event) {
        if (event.keyCode == 13 && event.shiftKey == 0) {
            event.preventDefault();
            var message = $(this).val();
            if(is_empty(message)) return;
            commentMedia('<?php echo $D->codemedia?>');
        }
    });

    $('#action-like-media-<?php echo $D->codemedia?>').click(function(){
        closeEmerged();
        likedMedia('<?php echo $D->codemedia?>');
    });

    $('#action-comment-media-<?php echo $D->codemedia?>').click(function(){
        closeEmerged();
        $('#textarea-comment-media-<?php echo $D->codemedia?>').focus();            
    });
    
    $('.action_autosize').each(function(){
        autosize(this);
    });
    
</script>
<?php } ?>