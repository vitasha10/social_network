    <div class="space-box">
        <div class="header-space-box"><?php echo $this->lang('profile_event_info_title')?></div>
        <div class="body-space-box-no-padding">

            <div class="item_info">
                <div class="icon"><img src="<?php echo getImageTheme('icook.png')?>"></div>
                <div class="text"><?php echo $D->going; ?> <?php echo($this->lang('global_event_txt_going')); ?></div>
                <div class="clear"></div>
            </div>

            <div class="item_info">
                <div class="icon"><img src="<?php echo getImageTheme('icostar.png')?>"></div>
                <div class="text"><?php echo $D->interested; ?> <?php echo($this->lang('global_event_txt_interested')); ?></div>
                <div class="clear"></div>
            </div>

        </div>

    </div>

    <?php $this->load_template('_pseudo-foot.php'); ?>