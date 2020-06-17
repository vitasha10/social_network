<div id="member-<?php echo $D->code_friend?>" class="oneuser_edge">

    <div class="avatar" id="a-rq-<?php echo $D->code_friend?>" onmouseout="ignoreItemCard()" onmouseover="itemCard(0, 'a-rq-<?php echo $D->code_friend?>', '<?php echo $D->code_friend?>', 0)"><a href="<?php echo $K->SITE_URL.$D->username_friend?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><img src="<?php echo $D->avatar_friend?>"></a></div>
    
    <div class="info">

        <div class="name">
            <span onmouseout="ignoreItemCard()" onmouseover="itemCard(1, 'n-rq-<?php echo $D->code_friend?>', '<?php echo $D->code_friend?>', 0)" id="n-rq-<?php echo $D->code_friend?>" class="link link-blue"><a href="<?php echo $K->SITE_URL.$D->username_friend?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><?php echo $D->name_friend?></a></span>        
        </div>
        
    </div>
    
    <div class="clear"></div>

</div>
<?php if ($D->count_f % 2 == 0) { ?>
<div class="clear"></div>
<?php } ?>