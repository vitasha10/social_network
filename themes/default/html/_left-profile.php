    <div class="space-box">
        <div class="header-space-box"><?php echo $this->lang('profile_txt_intro')?></div>
        <div class="body-space-box">
            <?php if (!empty($D->aboutme)) { ?>
            <div class="intro-space-box"><?php echo $D->aboutme?></div>
            <?php } ?>

            <?php if (!empty($D->currentcity)) { ?>
            <div class="item-with-icon">
                <div class="part1"><img src="<?php echo getImageTheme('prof_home.png')?>"></div>
                <div class="part2"><?php echo $this->lang('profile_txt_livein')?> <span class="resalt"><?php echo $D->currentcity?></span></div>
                <div class="clear"></div>
            </div>
            <?php } ?>

            <?php if (!empty($D->hometown)) { ?>
            <div class="item-with-icon">
                <div class="part1"><img src="<?php echo getImageTheme('prof_placeholder.png')?>"></div>
                <div class="part2"><?php echo $this->lang('profile_txt_from')?> <span class="resalt"><?php echo $D->hometown?></span></div>
                <div class="clear"></div>
            </div>
            <?php } ?>

            <?php if (!empty($D->text_gender)) { ?>
            <div class="item-with-icon">
                <div class="part1"><img src="<?php echo getImageTheme('prof_sex.png')?>"></div>
                <div class="part2"><?php echo $this->lang('profile_txt_iam')?> <span class="resalt"><?php echo $D->text_gender?></span></div>
                <div class="clear"></div>
            </div>
            <?php } ?>

            <?php if (!empty($D->text_birthday)) { ?>
            <div class="item-with-icon">
                <div class="part1"><img src="<?php echo getImageTheme('prof_calendar.png')?>"></div>
                <div class="part2"><?php echo $this->lang('profile_txt_born')?> <span class="resalt"><?php echo $D->text_birthday?></span></div>
                <div class="clear"></div>
            </div>
            <?php } ?>
        
        </div>

    </div>

    <div class="clear"></div>
        
    <?php $this->load_template('_pseudo-foot.php'); ?>