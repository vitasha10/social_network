<div class="product-in-post" id="the_prod<?php echo $product->code; ?>">
    <div class="area1">
        <div class="container-image">
            <a href="<?php echo $K->SITE_URL?>#" class="zoomeer-basic" data-image="<?php echo $D->url_photo_max_product; ?>">
            <div class="theimage" style="background-image:url(<?php echo $D->url_photo_product; ?>);"></div>
            </a>
        </div>
    </div>
    <div class="area2">
        <div class="block-info">
            <div class="labelinfo"><?php echo $this->lang('activity_txt_name_prod'); ?></div>
            <div class="textinfo"><?php echo $D->product->name; ?></div>
        </div>

        <div class="block-info">
            <div class="labelinfo"><?php echo $this->lang('activity_txt_description_prod'); ?></div>
            <div class="textinfo nobold"><?php echo $D->product->description; ?></div>
        </div>

        <div class="block-info">
            <div class="labelinfo"><?php echo $this->lang('activity_txt_price_prod'); ?></div>
            <div class="textinfo"><?php echo $D->currency->symbol; ?> <?php echo $D->product->price; ?></div>
        </div>
        
        <div class="block-info">
            <div class="labelinfo"><?php echo $this->lang('activity_txt_location_prod'); ?></div>
            <div class="textinfo"><?php echo $D->product->location; ?></div>
        </div>

        <div class="block-info">
            <div class="labelinfo"><?php echo $this->lang('activity_txt_type_prod'); ?></div>
            <div class="textinfo"><?php echo($D->product->type == 1 ? $this->lang('global_txt_new') : $this->lang('global_txt_used')) ?></div>
        </div>
        <?php if ($D->_IS_LOGGED) { ?>
        <?php if ($D->owner_prod) { ?>
        
        <div class="block-info" style="margin-top:15px;">
            <a href="<?php echo $K->SITE_URL.'products/edit/p:'.$D->product_code?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><div class="my-btn my-btn-blue"><?php echo $this->lang('activity_txt_edit_prod')?></div></a>
        </div>
        
        <?php } else { ?>

        <div class="block-info" style="margin-top:15px;">
            <div id="bseller_the_prod<?php echo $product->code; ?>" class="my-btn my-btn-blue"><?php echo $this->lang('activity_txt_message_seller')?></div>
            <script>
                $('#bseller_the_prod<?php echo $product->code; ?>').click(function(e){
                    e.preventDefault();
                    startChat('<?php echo $D->theuser_prod->code; ?>','<?php echo(stripslashes($D->theuser_prod->firstname).' '.stripslashes($D->theuser_prod->lastname))?>', '<?php echo $D->theuser_prod->user_username; ?>');
                });
            </script>
        </div>

        <?php } ?>
        <?php } ?>

    </div>
    
    <div class="clear"></div>

</div>