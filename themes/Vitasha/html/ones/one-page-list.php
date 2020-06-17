<div class="myRow" id="page-<?php echo $D->one->idpage?>">
    <div class="myCell avatar"><a href="<?php echo $K->SITE_URL.$D->one->username?>" rel="phantom-all" target="dashboard-main-area"><img src="<?php echo $D->one->avatar?>"></a></div>
    <div class="myCell name">
        <div><span class="link link-blue"><a href="<?php echo $K->SITE_URL.$D->one->username?>" rel="phantom-all" target="dashboard-main-area"><?php echo $D->one->allname?></a></span></div>
        <div class="line2">Creator: <span class="link link-blue"><a href="<?php echo $K->SITE_URL.$D->one->creator_username?>" rel="phantom-all" target="dashboard-main-area"><?php echo $D->one->creator_name?></a></span></div>
        <div class="actions2">
            <span><a href="<?php echo $K->SITE_URL?>admin/pages/edit/p:<?php echo $D->one->idpage?>" rel="phantom-all" target="dashboard-main-area"><img src="<?php echo getImageTheme('list-ico-edit.png')?>" class="ico"></a></span>

            <span id="del-page1-<?php echo $D->one->idpage?>"><img src="<?php echo getImageTheme('list-ico-delete.png')?>" class="ico"></span>

        </div>
    </div>
    <div class="myCell actions">
        <span><a href="<?php echo $K->SITE_URL?>admin/pages/edit/p:<?php echo $D->one->idpage?>" rel="phantom-all" target="dashboard-main-area"><img src="<?php echo getImageTheme('list-ico-edit.png')?>" class="ico"></a></span>

        <span id="del-page2-<?php echo $D->one->idpage?>"><img src="<?php echo getImageTheme('list-ico-delete.png')?>" class="ico"></span>

    </div>
</div>

<script>
    $('#del-page1-<?php echo $D->one->idpage?>, #del-page2-<?php echo $D->one->idpage?>').click(function(){
        closeEmerged();
        _confirm(msg_delete_page, nothign, deletePage, <?php echo $D->one->idpage?>);
    });
</script>
