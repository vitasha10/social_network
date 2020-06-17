<div id="notif-messages-<?php echo $D->idnotification?>" class="one-notif-messages">

    <div class="avatar"><img src="<?php echo $D->avatar?>"></div>

    <div class="info">

        <div class="info-cell">

            <div class="spacename">

                <div class="name"><?php echo $D->name?></div>

                <div class="themessage"><?php echo $D->the_message?></div>

                <div class="thedate"><?php echo $D->thedate?></div>

            </div>

        </div>

    </div>

    <div class="clear"></div>

</div>

<script>

    $('#notif-messages-<?php echo $D->idnotification?>').click(function(e){
        e.preventDefault();
        startChat('<?php echo $D->mess_user_code?>','<?php echo $D->name?>', '<?php echo $D->mess_user_username?>');
    });

</script>