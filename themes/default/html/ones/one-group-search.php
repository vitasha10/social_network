<div style="margin-bottom:20px;">

    <div style="float:left; margin-right:10px; width:80px; height:80px;">

        <a href="<?php echo($K->SITE_URL.$D->the_username_group)?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>>

        <div class="mybadge" style="background-color:#EEF0F2; <?php if ($D->with_cover) { ?> background-repeat: no-repeat; background-position: 50%; background-size: 150% auto; background-image: url(<?php echo $D->group_avatar?>); <?php } ?>">
            <?php if (!$D->with_cover) { ?><div style="margin-top:-5px; text-decoration:none; color:#555555; font-size:36px; font-weight:bold;"><?php echo substr(trim($D->the_title_group),0,1)?></div><?php } ?>
        </div>

        </a>
        
    </div>

    <div style="padding:0 0 0 0px; display:table-cell; vertical-align:middle;">
    
        <div style="display:table-cell; vertical-align:middle; height:80px;">

            <div><span class="link link-blue bold" style="font-size:15px;"><a href="<?php echo($K->SITE_URL.$D->the_username_group)?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><?php echo $D->the_title_group?></a></span></div>
    
            <div><?php echo $D->nummembers_group.' '.$D->txt_members?></div>
            
        </div>

    </div>

    <div class="clear"></div>

</div>