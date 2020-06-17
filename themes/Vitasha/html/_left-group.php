    <div class="space-box">
        <div class="header-space-box"><?php echo $this->lang('profile_group_info_title')?></div>
        <div class="body-space-box-no-padding">

            <div class="item_info">
                <div class="icon"><img src="<?php echo getImageTheme('group-info-members.png')?>"></div>
                <div class="text"><?php echo $D->nummembers?> <?php echo($D->nummembers == 1 ? $this->lang('profile_group_info_member') : $this->lang('profile_group_info_members')); ?></div>
                <div class="clear"></div>
            </div>

            <div class="item_info">
                <div class="icon"><img src="<?php echo getImageTheme('group-info-about.png')?>"></div>
                <div class="text"><?php echo $D->about ?></div>
                <div class="clear"></div>
            </div>

        </div>

    </div>

    <?php $this->load_template('_pseudo-foot.php'); ?>