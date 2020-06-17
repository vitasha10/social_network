<div id="space-dashright">

    <?php $this->load_template('_advertising-right.php'); ?>
    
    <?php if (isset($D->SHOW_SUGGESTIONS_PEOPLE) && $D->SHOW_SUGGESTIONS_PEOPLE) { ?>

    <?php $this->load_template('_users-right-w.php'); ?>

    <?php } ?>

</div>


<?php $this->load_template('_pseudo-foot.php'); ?>