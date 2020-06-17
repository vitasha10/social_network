<div id="chat-<?php echo $D->cht_code?>" class="onechat-max">
    <div style="padding-left:8px; position:relative;">
        <div class="ch-avatar"><img src="<?php echo $D->cht_avatar?>" style="font-size:0 !important;"></div>
        
        <?php if (!empty($D->cht_color_status)) { ?>
        <div class="ch-status">
            <div class="inside_ch-status"><span style="color:<?php echo $D->cht_color_status?> !important;">&#8226;</span></div>
        </div>
        <?php } else { ?>

            <?php if (!empty($D->ago_time_user)) { ?>
        <div class="ch-time-ago">
            <div class="inside_ch-time-ago"><?php echo $D->ago_time_user; ?></div>
        </div>
            <?php } ?>

        <?php } ?>
        
        <div class="ch-name"><?php echo $D->cht_nameUser?></div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>

<script>

    $('#chat-<?php echo $D->cht_code?>').click(function(e){
        e.preventDefault();
        startChat('<?php echo $D->cht_code?>','<?php echo $D->cht_nameUser?>', '<?php echo $D->cht_username?>');
    });

</script>