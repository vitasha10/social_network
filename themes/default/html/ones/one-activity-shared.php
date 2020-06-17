<div id="activity_<?php echo $D->shared->code_activity?>" class="box-activity-shared">

    <div class="ba-header">

        <div>
            <div class="ba-avatar" id="ba-avatar-<?php echo $D->shared->code_activity?>"><a href="<?php echo $K->SITE_URL.$D->shared->activity_who_does_it_username?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><img onmouseover="itemCard(0, 'ba-avatar-<?php echo $D->shared->code_activity?>', '<?php echo $D->shared->activity_who_does_it_code?>', <?php echo $D->shared->item1_type?>)" onmouseout="ignoreItemCard()" src="<?php echo $D->shared->activity_avatar ?>"></a></div>

            <div class="ba-info">
                <div class="ba-info-1">

                    <span id="name1-<?php echo $D->shared->code_activity?>" onmouseover="itemCard(1, 'name1-<?php echo $D->shared->code_activity?>', '<?php echo $D->shared->activity_who_does_it_code?>', <?php echo $D->shared->item1_type?>)" onmouseout="ignoreItemCard()"><a href="<?php echo $K->SITE_URL.$D->shared->activity_who_does_it_username?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><?php echo $D->shared->activity_who_does_it ?></a></span>

                    <?php if ($D->shared->in_where == 1 || $D->shared->in_where == 2 || $D->shared->in_where == 3 || $D->shared->in_where == 5) { ?>

                    <span>&nbsp;<img src="<?php echo getImageTheme('arrow_to.png')?>">&nbsp;</span>
                    <span id="name2-<?php echo $D->shared->code_activity?>" onmouseover="itemCard(1, 'name2-<?php echo $D->shared->code_activity?>', '<?php echo $D->shared->item2_code?>', <?php echo $D->shared->item2_type?>)" onmouseout="ignoreItemCard()"><a href="<?php echo $K->SITE_URL.$D->shared->item2_uname?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><?php echo $D->shared->item2_name ?></a></span>

                    <?php } ?>

                    <span><?php echo $D->shared->text_actions?></span>

                    <span><?php echo(!empty($D->shared->more_text_in_post_top) ? $D->shared->more_text_in_post_top : ''); ?></span>

                </div>

                <?php if (!empty($D->shared->more_text_in_post_bottom)) { ?>
                <div class="ba-info-3"><?php echo $D->shared->more_text_in_post_bottom ?></div>
                <?php } ?>

                <div class="ba-info-2">
                    <span><img src="<?php echo getImageTheme('mini-clock.png')?>"></span>
                    <span class="link link-grey"><a href="<?php echo $K->SITE_URL.$D->shared->activity_who_does_it_username.'/post/'.$D->shared->code_activity?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><?php echo $D->shared->activity_whendate ?></a></span>

                    <?php if ($D->shared->activity_post_posted_in != 2) { ?>
                    <span style="line-height:1.34; font-size:11px;">&middot;</span>
                    <span style="line-height:1.34; font-size:11px;"><img src="<?php echo $D->shared->icono_typepost ?>"></span>
                    <?php } ?>

                </div>

            </div>

        </div>

    </div>

    <div class="clear"></div>

    <div id="space_txt_message_<?php echo $D->shared->code_activity?>" class="ba-body" style=" <?php echo(isset($D->shared->activity_message) && !empty($D->shared->activity_message) ? '' : 'padding-bottom:0px;' ) ?> ">

        <?php if (isset($D->shared->activity_message_cut)) { ?>

        <span id="block_min_<?php echo $D->shared->code_activity?>"><?php echo nl2br($D->shared->activity_message_cut); ?> <span id="see_more_<?php echo $D->shared->code_activity?>" class="link link-blue"><?php echo $this->lang('activity_txt_see_more')?></span></span>

        <span id="block_max_<?php echo $D->shared->code_activity?>" class="hide"><?php echo nl2br($D->shared->activity_message); ?></span>

        <?php } else {?>

        <span id="block_max_<?php echo $D->shared->code_activity?>"><?php echo nl2br($D->shared->activity_message); ?></span>

        <?php } ?>

        <script>
        $('#see_more_<?php echo $D->shared->code_activity?>').click(function(){
            $('#block_min_<?php echo $D->shared->code_activity?>').fadeOut('fast', function(){
                $('#block_max_<?php echo $D->shared->code_activity?>').fadeIn('fast');
            });
        });
        </script>

    </div>

    <?php if (isset($D->shared->html_attach) && !empty($D->shared->html_attach)) { ?>
        <?php echo $D->shared->html_attach?>
    <?php } ?>

    <?php if (isset($D->shared->html_embed) && !empty($D->shared->html_embed)) { ?>
    <div class="ba-embed"><?php echo $D->shared->html_embed ?></div>
    <?php } ?>

    <script> 
        $('activity_<?php echo $D->shared->code_activity?> .thelivestamp').livestamp();
    </script>
</div>