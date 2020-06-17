<div id="product_<?php echo $D->product->code?>" class="oneproduct <?php echo ($D->product_last ? 'last' : ''); ?>">

    <div class="oneproduct-actions">

        <a href="<?php echo $K->SITE_URL.'products/edit/p:'.$D->product->code?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="dashboard-main-area-right"' : '') ?>><div class="my-btn my-btn-blue"><?php echo $this->lang('dashboard_products_bedit')?></div></a>

    </div>

    <div class="oneproduct-info">

        <div class="product_name"><span class="link link-blue"><a href="<?php echo $K->SITE_URL.$this->user->info->user_username.'/post/'.$D->product->codepost?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><?php echo $D->product->name; ?></a></span></div>

        <div class="product_price"><?php echo $D->currency->symbol; ?> <?php echo $D->product->price; ?></div>

    </div>

    <div class="clear"></div>

</div>