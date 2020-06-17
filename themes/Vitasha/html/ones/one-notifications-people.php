<div id="notif-people-<?php echo $D->idnotification?>" class="one-notif-people">
    <div class="avatar"><img src="<?php echo $D->avatar?>"></div>
    
    <div class="info">
        <div class="info-cell">
        
    <?php switch ($D->type_notif) {
    
            case 1: ?>
        
            <div class="spacename">
                <div class="name"><a href="<?php echo $D->url_people?>" class="link link-blue bold" rel="phantom-all" target="dashboard-main-area"><?php echo $D->name?></a> <span><?php echo $D->cadaction?></span></div>
            </div>
            
            <?php break;
            case 5:
            ?>

            <div class="bactions">
                <div id="buttons-actions-<?php echo $D->idnotification?>">
                    <span class="my-btn my-btn-blue my-btn-usmall" id="btn-confirm-<?php echo $D->idnotification?>"><?php echo $this->lang('dashboard_notif_txt_friend_request_confirm')?></span>
                    <span class="my-btn my-btn-usmall" id="btn-delete-<?php echo $D->idnotification?>"><?php echo $this->lang('dashboard_notif_txt_friend_request_delete')?></span>
                </div>
                <span class="my-btn my-btn-usmall" style="display:none;" id="btn-friends-<?php echo $D->idnotification?>"><?php echo $this->lang('dashboard_notif_txt_friend_request_ok')?></span>
                <span id="preload-notif-<?php echo $D->idnotification?>" style="padding:0 10px;" class="hide"><img src="<?php echo getImageTheme('preload.gif');?>"></span>

            </div>
            
            <div class="spacename">
                <div class="name"><a href="<?php echo $D->url_people?>" class="link link-blue bold" rel="phantom-all" target="dashboard-main-area"><?php echo $D->name?></a></div>
            </div>

            <script>
            $('#btn-confirm-<?php echo $D->idnotification?>').click(function(e) {
                e.stopPropagation();
                confirmRequestFriend_Notif(<?php echo $D->idnotification?>, '<?php echo $D->notif_codeuser?>');
            });
            
            $('#btn-delete-<?php echo $D->idnotification?>').click(function(e) {
                e.stopPropagation();
                deleteRequestFriend_Notif(<?php echo $D->idnotification?>, '<?php echo $D->notif_codeuser?>');
            });

            $('#btn-friends-<?php echo $D->idnotification?>').click(function(e) {
                e.stopPropagation();
            
            });

            </script>

            <?php break;
            case 6:
            ?>

            <div class="spacename">
                <div class="name"><a href="<?php echo $D->url_people?>" class="link link-blue bold" rel="phantom-all" target="dashboard-main-area"><?php echo $D->name?></a> <span><?php echo $D->cadaction?></span></div>
            </div>
                    
            <?php break; ?>
            
    <?php } ?>

            
        </div>
    </div>

    <div class="clear"></div>
</div>