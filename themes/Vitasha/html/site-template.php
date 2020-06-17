<?php $this->load_template('_header.php'); ?>

<div id="site-all-content">

    <div id="site-top-area">
    <?php $this->load_template('_top.php'); ?>
    </div>

    <?php $this->load_template($D->file_in_template); ?>

    <?php if (isset($D->menu_footer) && $D->menu_footer) { ?>
    <div id="site-foot-area">
        <?php $this->load_template('_foot-out.php'); ?>
    </div>
    <?php } ?>
    
</div>

<?php $this->load_template('_footer.php'); ?>