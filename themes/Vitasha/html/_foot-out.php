
    <div id="foot-nologin">
        
        <div class="separator"></div>
        
        <div id="space-foot-one">
    
            <?php echo $K->COMPANY?> &copy; <?php echo date('Y'); ?>
    
        </div>
        
        <div id="space-foot-two">

        <?php
        $statics = getStaticsFoot();
        if ($statics) {
            foreach ($statics as $onest) { ?>
            <span class="link link-grey" style="padding-right:10px;"><a href="<?php echo $K->SITE_URL.'info/'.$onest->url?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><span style="word-wrap: break-word;"><?php echo $onest->title ?></span></a></span>
        <?php 
            }
        } ?>

        </div>
        
        <div class="clear"></div>
        
    </div>
