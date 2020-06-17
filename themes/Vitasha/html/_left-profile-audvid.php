    <div class="space-box">

        <div class="header-space-box"><?php echo $D->title_section?></div>

        <div class="body-space-box">
            <?php echo($this->lang('profile_items_found').': <span class="bold">'.$D->num_items_total.'</span>'); ?>
        </div>

    </div>

    <div class="clear"></div>

    <?php $this->load_template('_pseudo-foot.php'); ?>