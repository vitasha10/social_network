    <div class="inside-content-embed">
        <?php if (isset($D->withDelete) && $D->withDelete) { ?>
        <div id="embed-remove">X</div>
        <?php } ?>
        <div class="area-embed">
            <div class="image-ref"><div class="inside-image-ref" style="background-image:url('<?php echo $D->infoEmbed['e_url']?>');"></div></div>
            <div class="the-info-embed">
                <div class="source"><a href="<?php echo $D->infoEmbed['e_url']?>" target="_blank"><?php echo $D->infoEmbed['e_provider']?></a></div>
            </div>
        </div>
    </div>
