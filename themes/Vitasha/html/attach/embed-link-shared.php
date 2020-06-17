    <div class="inside-content-embed">

        <div class="area-embed">
            <?php if (isset($D->shared->infoEmbed['e_thumbnail']) && is_string($D->shared->infoEmbed['e_thumbnail']) && !empty($D->shared->infoEmbed['e_thumbnail'])) { ?>
            <div class="image-ref"><div class="inside-image-ref" style="background-image:url('<?php echo $D->shared->infoEmbed['e_thumbnail']?>');"></div></div>
            <?php } ?>
            <div class="the-info-embed">
                <div class="title"><a href="<?php echo $D->shared->infoEmbed['e_url']?>" target="_blank"><?php echo $D->shared->infoEmbed['e_title']?></a></div>
                <div class="text"><?php echo $D->shared->infoEmbed['e_text']?></div>
                <div class="source"><?php echo $D->shared->infoEmbed['e_host']?></div>
            </div>
        </div>

    </div>