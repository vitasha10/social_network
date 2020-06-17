    <div class="inside-content-embed">
        <?php if (isset($D->withDelete) && $D->withDelete) { ?>
        <div id="embed-remove">X</div>
        <?php } ?>
        <div class="area-embed <?php echo ((isset($D->withoutBorder) && $D->withoutBorder) ? 'enoborder' : '' ) ?>">
            <div class="embed-responsive">
                <?php echo $D->infoEmbed['e_html']?>
            </div>
            <div class="the-info-embed">
                <div class="title"><a href="<?php echo $D->infoEmbed['e_url']?>" target="_blank"><?php echo $D->infoEmbed['e_title']?></a></div>
                <div class="text"><?php echo $D->infoEmbed['e_text']?></div>
                <div class="source"><?php echo $D->infoEmbed['e_provider']?></div>
            </div>
        </div>
    </div>
