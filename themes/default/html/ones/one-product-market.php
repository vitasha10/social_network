<div class="one-item-market" id="itemmarket-<?php echo $D->product->code; ?>">

    <a href="<?php echo $D->product->url; ?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>>
    <div class="container-info">

        <div class="container-image">
            <div class="theimage" style="background-image:url(<?php echo $D->photo_product; ?>);"></div>
        </div>    
        <div class="container-name">
            <span style="font-size:12px; font-weight:bold; line-height:16px;"><?php echo($D->product->name); ?></span>
            <div><?php echo $D->currency->symbol; ?> <?php echo $D->product->price; ?></div>
            <span><?php echo $D->product->location?></span>
        </div>

    </div>
    </a>

</div>
