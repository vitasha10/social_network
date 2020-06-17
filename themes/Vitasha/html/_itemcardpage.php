<a href="<?php echo $K->SITE_URL.$D->username?>" class="undecorated" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>>

<?php if (!empty($D->cover)) { ?>

<div onmouseover="keepCardVisible()" id="ItemCard">
	<div class="ucover" style="background-image: url(<?php echo $K->STORAGE_URL_COVERS_PAGE.$D->code.'/'.$D->cover?>); background-position:0 <?php echo $D->cover_position?>">
        
    </div>
    <div>
    	<div class="uavatar"><img src="<?php echo $D->avatar?>"></div>
        <div>
            
            <div class="unamelarge">

            	<span><?php echo $D->titlePage?></span>
            
				<?php if ($D->isVerified == 1) { ?>
                
                <span style="position:absolute;">
                    <span style="position:relative; margin-left:5px; vertical-align:-5px; top:-5px;">
                        <img src="<?php echo getImageTheme('verified.png')?>" title="<?php echo $this->lang('profile_infobasic_title_verified')?>">
                    </span>
                </span>
                
                <?php } ?>

            </div>
            <div class="ucategory"><?php echo $D->namecategory?></div>
			
            <div class="sh"></div>
            
        </div>
        <div class="sh"></div>
    </div>
    <div id="ubottom">
    	<span><span class="bold" style="font-size:14px;"><?php echo $D->numlikes?></span> <span class="actions"><?php echo ($D->numlikes==1?$this->lang('global_card_txt_like'):$this->lang('global_card_txt_likes'))?></span></span>
    </div>
	<div class="sh"></div>
</div>

<?php } else { ?>


<div onmouseover="keepCardVisible()" id="ItemCardNoCover">
	<div class="ucover"></div>
    <div>
    	<div class="uavatar"><img src="<?php echo $D->avatar?>"></div>
        <div>

    		<div class="unamelarge">

            	<span><?php echo $D->titlePage?></span>
            
				<?php if ($D->isVerified == 1) { ?>
                
                <span style="position:absolute;">
                    <span style="position:relative; margin-left:5px; vertical-align:-5px; top:-5px;">
                        <img src="<?php echo getImageTheme('verified.png')?>" title="<?php echo $this->lang('profile_infobasic_title_verified')?>">
                    </span>
                </span>
                
                <?php } ?>
            
            </div>
            <div class="ucategory"><?php echo $D->namecategory?></div>
            <div class="sh"></div>
        </div>
        <div class="sh"></div>
    </div>
    <div id="ubottom">
    	<span><span class="bold" style="font-size:14px;"><?php echo $D->numlikes?></span> <span class="actions"><?php echo ($D->numlikes==1?$this->lang('global_card_txt_like'):$this->lang('global_card_txt_likes'))?></span></span>
    </div>
	<div class="sh"></div>
</div>


<?php } ?>
</a>