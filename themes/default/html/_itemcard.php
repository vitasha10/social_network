<a href="<?php echo $K->SITE_URL.$D->username?>" class="undecorated" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>>

<?php if (!empty($D->cover)) { ?>

<div onmouseover="keepCardVisible()" id="ItemCard">
	<div class="ucover" style="background-image: url(<?php echo $K->STORAGE_URL_COVERS.$D->code.'/'.$D->cover?>); background-position:0 <?php echo $D->cover_position?>">
        
    </div>
    <div>
    	<div class="uavatar"><img src="<?php echo $D->avatar?>"></div>
        <div>
            
            <div class="uname">

            	<span><?php echo $D->nameUser?></span>
            
				<?php if ($D->isVerified == 1) { ?>
                
                <span style="position:absolute;">
                    <span style="position:relative; margin-left:5px; vertical-align:-5px; top:-5px;">
                        <img src="<?php echo getImageTheme('verified.png')?>" title="<?php echo $this->lang('profile_infobasic_title_verified')?>">
                    </span>
                </span>
                
                <?php } ?>

            </div>
            
			
            <div class="sh"></div>
            
        </div>
        <div class="sh"></div>
    </div>
    <div id="ubottom">
    	<span><span class="bold" style="font-size:14px;"><?php echo $D->num_friends?></span> <span class="actions"><?php echo ($D->num_friends==1?$this->lang('global_card_txt_friend'):$this->lang('global_card_txt_friends'))?></span></span>
    </div>
	<div class="sh"></div>
</div>

<?php } else { ?>


<div onmouseover="keepCardVisible()" id="ItemCardNoCover">
	<div class="ucover"></div>
    <div>
    	<div class="uavatar"><img src="<?php echo $D->avatar?>"></div>
        <div>
        	<?php if ($D->isVerified == 1) { ?><div style="float:right; margin-right:5px; margin-top:4px; "><img src="<?php echo getImageTheme('verified.png')?>"></div><?php } ?>
    		<div class="uname"><?php echo $D->nameUser?></div>
            <div class="sh"></div>
        </div>
        <div class="sh"></div>
    </div>
    <div id="ubottom">
    	<span><span class="bold" style="font-size:14px;"><?php echo $D->num_friends?></span> <span class="actions"><?php echo ($D->num_friends==1?$this->lang('global_card_txt_friend'):$this->lang('global_card_txt_friends'))?></span></span>
    </div>
	<div class="sh"></div>
</div>


<?php } ?>
</a>