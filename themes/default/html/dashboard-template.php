<?php $this->load_template('_header.php'); ?>

<div id="dashboard-all-content">

    <div id="dashboard-top-area">
        <?php $this->load_template('_top-inside.php'); ?>
    </div>

    <?php $this->load_template($D->file_in_template); ?>

    <div id="dashboard-foot-area">
        <?php $this->load_template('_foot-inside.php'); ?>
    </div>

</div>

<?php $this->load_template('_footer.php'); ?>