    <div class="inside-content-embed">
        <?php if (isset($D->withDelete) && $D->withDelete) { ?>
        <div id="embed-remove">X</div>
        <?php } ?>
        <div class="area-embed">
            <?php if (isset($D->infoEmbed['e_thumbnail']) && is_string($D->infoEmbed['e_thumbnail']) && !empty($D->infoEmbed['e_thumbnail'])) { ?>
            <div class="image-ref"><div class="inside-image-ref" style="background-image:url('<?php echo $D->infoEmbed['e_thumbnail']?>');"></div></div>
            <?php } ?>
            <div class="the-info-embed">
                <div class="title"><a href="<?php echo $D->infoEmbed['e_url']?>" target="_blank"><?php echo $D->infoEmbed['e_title']?></a></div>
                <div class="text"><?php echo $D->infoEmbed['e_text']?></div>
                <div class="source"><?php echo $D->infoEmbed['e_host']?></div>
            </div>
        </div>
    </div>