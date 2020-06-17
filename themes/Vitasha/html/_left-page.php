    <div class="space-box">
        <div class="header-space-box"><?php echo $this->lang('profile_page_info_title')?></div>
        <div class="body-space-box-no-padding">

            <div class="item_info">
                <div class="icon"><img src="<?php echo getImageTheme('page-info-likes.png')?>"></div>
                <div class="text"><?php echo $D->numlikes?> <?php echo($D->numlikes == 1 ? $this->lang('profile_page_info_like') : $this->lang('profile_page_info_likes')); ?></div>
                <div class="clear"></div>
            </div>

            <div class="item_info">
                <div class="icon"><img src="<?php echo getImageTheme('page-info-about.png')?>"></div>
                <div class="text2"><?php echo $D->description ?></div>
                <div class="clear"></div>
            </div>

            <div class="item_info">
                <div class="icon"><img src="<?php echo getImageTheme('page-info-category.png')?>"></div>
                <div class="text2"><?php echo $D->nameCategory ?></div>
                <div class="clear"></div>
            </div>

        
        </div>

    </div>
        
    <?php $this->load_template('_pseudo-foot.php'); ?>