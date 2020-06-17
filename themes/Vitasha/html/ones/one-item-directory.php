<div class="one-item-directory" id="itemdir-<?php echo $D->one_item_directory->iduser?>">

    <a href="<?php echo $K->SITE_URL.$D->one_item_directory->user_username?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>>
    <div class="container-info">

        <div class="container-image">
            <img src="<?php echo $D->the_avatar_item?>" alt="" class="img">        
        </div>    
        <div class="container-name">
            <div style="font-size:12px; font-weight:bold; line-height:16px;"><?php echo($D->one_item_directory->firstname.' '.$D->one_item_directory->lastname);?></div>
            <span><?php echo($D->one_item_directory->user_username);?></span>
        </div>

    </div>
    </a>

</div>

<script>
$('#itemdir-<?php echo $D->one_item_directory->iduser?>').hover(
    function(){
        $('#itemdir-<?php echo $D->one_item_directory->iduser?> .container-name').show();
    },
    function(){
        $('#itemdir-<?php echo $D->one_item_directory->iduser?> .container-name').hide();
    }
);
</script>