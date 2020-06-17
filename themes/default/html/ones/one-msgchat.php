<div class="burblu_chat">
    <div class="<?php echo($D->who_write_in_chat == 1 ? 'in_me' : 'in_friend')?>">

        <?php if ($D->who_write_in_chat == 1) { ?>
        <div class="name link-blue bold"><?php echo $this->lang('dashboard_chat_txt_you')?></div>
        <?php } else { ?>
        <div class="name link link-blue bold"><a href="<?php echo $K->SITE_URL.$D->chat_user_username?>" rel="phantom-all" target="dashboard-main-area"><?php echo $D->chat_user_name?></a></div>
        <?php } ?>
        
        <?php if ($D->type_message_in_chat == 1) { ?>
        <div class="message"><?php echo $D->chat_msgchatnew_me;?></div>
        
        <?php } elseif ($D->type_message_in_chat == 2) { ?>
        <div class="message"><a href="<?php echo $K->SITE_URL?>#" class="zoomeer-basic" data-image="<?php echo $D->chat_photo_max;?>"><img width="175" height="175" src="<?php echo $D->chat_msgchatnew_me;?>"></a></div>
        
        <?php } elseif ($D->type_message_in_chat == 3) { ?>
            <?php if ($D->who_write_in_chat == 1) { ?>
        <div class="message"><div style="float:right;"><img src="<?php echo getImageTheme('icodwnf.png'); ?>"></div> <div style=" padding-right:20px; text-align:right" class="link link-blue"><a href="<?php echo $D->chat_file_url_dwl?>"><?php echo $D->chat_msgchatnew_me;?></a></div><div class="clear"></div></div>
            <?php } else { ?>
        <div class="message"><div style="float:left;"><img src="<?php echo getImageTheme('icodwnf.png'); ?>"></div> <div style=" padding-left:20px; text-align:left" class="link link-blue"><a href="<?php echo $D->chat_file_url_dwl?>"><?php echo $D->chat_msgchatnew_me;?></a></div><div class="clear"></div></div>
            <?php } ?>
        
        <?php } elseif ($D->type_message_in_chat == 4) { ?>
        <div class="message"><img src="<?php echo $K->SITE_URL?>themes/<?php echo $K->THEME?>/imgs/stickers/max/<?php echo $D->the_sticker;?>.png" width="165" height="165"></div>
        <?php } ?>

        <div class="clear"></div>

        <div class="whendate"><?php echo $D->chat_txt_whendate?></div>

    </div>
</div>

<div class="clear"></div>

