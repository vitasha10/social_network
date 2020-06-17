<div id="the-talk-<?php echo $D->the_talk_id?>" class="one-talk-list">
    <div class="avatar"><img src="<?php echo $D->the_talk_user_avatar?>"></div>
    
    <div class="info">
        <div class="info-cell">
        
            <div class="spacename">
                <div class="name"><?php echo $D->the_talk_user_name?></div>
                <div class="themessage"><?php echo $D->the_talk_message?></div>
                <div class="thedate"><?php echo $D->the_talk_thedate?></div>
            </div>
            
        </div>
    </div>

    <div class="clear"></div>
</div>

<script>
    $('#the-talk-<?php echo $D->the_talk_id?>').click(function(e){ 
        e.preventDefault();
        $('.one-talk-list').removeClass('active');
        actionOnClick(_SITE_URL + 'messages/<?php echo $D->the_talk_user_username?>', 'messages-2-parts-right', 'min');
    });
</script>