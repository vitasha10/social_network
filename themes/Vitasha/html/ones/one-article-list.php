<div class="myRow" id="article-<?php echo $D->one->idarticle?>">
    <a href="<?php echo $D->one->url?>" rel="phantom-all" target="dashboard-main-area"><div class="myCell avatar" style="width:55px; height:55px; background-size: cover; background-position: center center; background-image:url(<?php echo $D->one->photo?>);"></div></a>
    <div class="myCell name">
        <div><span class="link link-blue"><a href="<?php echo $D->one->url?>" rel="phantom-all" target="dashboard-main-area"><?php echo $D->one->allname?></a></span></div>
        <div class="line2">Creator: <span class="link link-blue"><a href="<?php echo $K->SITE_URL.$D->one->creator_username?>" rel="phantom-all" target="dashboard-main-area"><?php echo $D->one->creator_name?></a></span></div>
        <div class="actions2">
            <span><a href="<?php echo $K->SITE_URL?>admin/articles/edit/a:<?php echo $D->one->idarticle?>" rel="phantom-all" target="dashboard-main-area"><img src="<?php echo getImageTheme('list-ico-edit.png')?>" class="ico"></a></span>

            <span id="del-prod1-<?php echo $D->one->idarticle?>"><img src="<?php echo getImageTheme('list-ico-delete.png')?>" class="ico"></span>

        </div>

    </div>

    <div class="myCell actions">

        <span><a href="<?php echo $K->SITE_URL?>admin/articles/edit/a:<?php echo $D->one->idarticle?>" rel="phantom-all" target="dashboard-main-area"><img src="<?php echo getImageTheme('list-ico-edit.png')?>" class="ico"></a></span>

        <span id="del-prod2-<?php echo $D->one->idarticle?>"><img src="<?php echo getImageTheme('list-ico-delete.png')?>" class="ico"></span>

    </div>

</div>

<script>
    $('#del-prod1-<?php echo $D->one->idarticle?>, #del-prod2-<?php echo $D->one->idarticle?>').click(function(){
        closeEmerged();
        _confirm(msg_delete_article, nothign, deleteArticle, <?php echo $D->one->idarticle?>);
    });
</script>