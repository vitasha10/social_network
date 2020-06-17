<div id="page-<?php echo $D->page->code?>" class="onepage_profile">

    <div class="avatar" id="a-rq-<?php echo $D->page->code?>" onmouseout="ignoreItemCard()" onmouseover="itemCard(0, 'a-rq-<?php echo $D->page->code?>', '<?php echo $D->page->code?>', 1)"><a href="<?php echo $K->SITE_URL.$D->page->puname?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><img src="<?php echo $D->page->avatar; ?>"></a></div>

    <div style="overflow:hidden;">
        <div class="info">
            <div class="ghost"></div><div class="name">
                <span onmouseout="ignoreItemCard()" onmouseover="itemCard(1, 'n-rq-<?php echo $D->page->code?>', '<?php echo $D->page->code?>', 1)" id="n-rq-<?php echo $D->page->code?>" class="link link-blue"><a href="<?php echo $K->SITE_URL.$D->page->puname?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><?php echo $D->page->title?></a></span>
                <div style="font-size:13px; font-weight:normal; color:#4F4F4F;">
                    <?php echo $D->nameCategory; ?>
                </div>
            </div>
    
        </div>
    </div>

    <div class="clear"></div>

</div>

<?php if ($D->count_f % 2 == 0) { ?>

<div class="clear"></div>

<?php } ?>