<div id="comment-post-<?php echo $D->cl_comm_idcomment?>" class="comment-in-activity">
    
    <?php if ($D->cl_comm_is_removable) { ?>
    <div id="delete-comment-<?php echo $D->cl_comm_idcomment?>" class="delete-comment">x</div>
    <?php } ?>

    <div id="avatar-user-comment-<?php echo $D->cl_comm_idcomment?>" class="cia-avatar"><a href="<?php echo $K->SITE_URL.$D->cl_comm_writer_username?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><img onmouseover="itemCard(0, 'avatar-user-comment-<?php echo $D->cl_comm_idcomment?>', '<?php echo $D->cl_comm_writer_code?>', <?php echo $D->cl_comm_writer_type?>)" onmouseout="ignoreItemCard()" src="<?php echo $D->cl_comm_avatar?>"></a></div>
    
    <div class="cia-info">
        <div><span id="name-user-comment-<?php echo $D->cl_comm_idcomment?>" class="link link-blue bold"><a href="<?php echo $K->SITE_URL.$D->cl_comm_writer_username?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?> onmouseover="itemCard(1, 'name-user-comment-<?php echo $D->cl_comm_idcomment?>', '<?php echo $D->cl_comm_writer_code?>', <?php echo $D->cl_comm_writer_type?>)" onmouseout="ignoreItemCard()"><?php echo $D->cl_comm_writer_name?></a></span> 
            
        <?php if ($D->cl_comm_type_comment == 1 || $D->cl_comm_type_comment == 2) { ?>
            
            <?php if (isset($D->cl_comm_comment_cut) && !empty($D->cl_comm_comment_cut)) { ?>
            
            <span id="text_comment_min_<?php echo $D->cl_comm_idcomment?>"><?php echo nl2br($D->cl_comm_comment_cut); ?> <span id="see_more_com_<?php echo $D->cl_comm_idcomment?>" class="link link-blue"><?php echo $this->lang('activity_txt_see_more')?></span></span>
            
            <span id="text_comment_max_<?php echo $D->cl_comm_idcomment?>" class="hide"><?php echo nl2br($D->cl_comm_comment); ?></span>
            
            <script>
            $('#see_more_com_<?php echo $D->cl_comm_idcomment?>').click(function(){
                $('#text_comment_min_<?php echo $D->cl_comm_idcomment?>').fadeOut('fast', function(){
                    $('#text_comment_max_<?php echo $D->cl_comm_idcomment?>').fadeIn('fast');
                });
            });
            </script>

            <?php } else {?>
            
            <span id="text_comment_max_<?php echo $D->cl_comm_idcomment?>"><?php echo nl2br($D->cl_comm_comment); ?></span>
            
            <?php } ?>


        <?php } ?>

        <?php if ($D->cl_comm_type_comment == 3) { ?>

        <div><img src="<?php echo $K->SITE_URL?>themes/<?php echo $K->THEME?>/imgs/stickers/max/<?php echo $D->cl_comm_comment;?>.png" width="80" height="80"></div>

        <?php } ?>

        </div>

        <?php if (!empty($D->cl_comm_attach_html)) {?>
        <div style="margin-top:10px; margin-bottom:5px;"><a href="<?php echo $K->SITE_URL?>#" class="zoomeer-basic" data-image="<?php echo $D->cl_comm_attach_max;?>"><img src="<?php echo $D->cl_comm_attach_html;?>"></a></div>
        <?php } ?>

        <div class="when_date"><?php echo $D->cl_comm_whendate?></div>
    </div>

    <div class="clear"></div>

</div>

<?php if ($D->cl_comm_is_removable) { ?>
<script>
    $('#delete-comment-<?php echo $D->cl_comm_idcomment?>').click(function(e) {
        e.preventDefault();
        closeEmerged();
        <?php if ($D->cl_comm_typeitem == 1) { ?>
        deleteComment('<?php echo $D->cl_comm_idcomment?>');
        <?php } else { ?>
        _confirm(msg_delete_comment, nothign, deleteComment, '<?php echo $D->cl_comm_idcomment?>');
        <?php } ?>
    });
</script>
<?php } ?>