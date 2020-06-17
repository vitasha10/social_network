<a href="<?php echo $K->SITE_URL.$D->username?>" class="undecorated" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>>

<?php if (!empty($D->cover)) { ?>

<div onmouseover="keepCardVisible()" id="ItemCard">
	<div class="ucover" style="background-image: url(<?php echo $K->STORAGE_URL_COVERS_GROUP.$D->code.'/'.$D->cover?>); background-position:0 <?php echo $D->cover_position?>"></div>

    <div class="namegroup"><?php echo $D->titleGroup?></div>

    <div id="ubottom">
    	<span><span class="bold" style="font-size:14px;"><?php echo $D->nummembers?></span> <span class="actions"><?php echo ($D->nummembers==1?$this->lang('global_card_txt_member'):$this->lang('global_card_txt_members'))?></span></span>
    </div>
	<div class="sh"></div>
</div>

<?php } else { ?>


<div onmouseover="keepCardVisible()" id="ItemCardNoCover">
	<div class="ucover"></div>

    <div class="namegroup"><?php echo $D->titleGroup?></div>

    <div id="ubottom">
    	<span><span class="bold" style="font-size:14px;"><?php echo $D->nummembers?></span> <span class="actions"><?php echo ($D->nummembers==1?$this->lang('global_card_txt_member'):$this->lang('global_card_txt_members'))?></span></span>
    </div>
	<div class="sh"></div>
</div>


<?php } ?>
</a>