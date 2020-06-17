<div class="one-item-people" id="itemdir-<?php echo $D->people_s->iduser?>">

    <a href="<?php echo $K->SITE_URL.$D->people_s->user_username?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>>
    <div class="container-info">

        <div class="container-image">
            <img src="<?php echo $D->the_avatar_people?>" alt="" class="img">        
        </div>    
        <div class="container-name">
            <div class="line01"><?php echo($D->people_s->firstname.' '.$D->people_s->lastname);?></div>
            <span class="line02"><?php echo($D->people_s->user_username);?></span>
        </div>

    </div>
    </a>

</div>

<script>
$('#itemdir-<?php echo $D->people_s->iduser?>').hover(
    function(){
        $('#itemdir-<?php echo $D->people_s->iduser?> .container-name').show();
    },
    function(){
        $('#itemdir-<?php echo $D->people_s->iduser?> .container-name').hide();
    }
);
</script>