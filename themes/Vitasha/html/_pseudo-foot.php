<div style="padding:10px 8px 0; margin-bottom:20px;">
    <div>
    <?php
    $statics = getStaticsFoot();
    if ($statics) {
        foreach ($statics as $onest) { ?>
        <span class="link link-grey" style="padding-right:10px;"><a href="<?php echo $K->SITE_URL.'info/'.$onest->url?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><span style="word-wrap: break-word;"><?php echo $onest->title ?></span></a></span>
    <?php 
        }
    } ?>
    </div>
    <div style="color:#90949c; margin-top:5px;"><?php echo $K->COMPANY?> &copy; <?php echo date('Y'); ?></div>
</div>