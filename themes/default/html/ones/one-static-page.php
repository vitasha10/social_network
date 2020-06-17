<div class="myRow" id="static-<?php echo $D->onestatic->idstatic?>">

    <div class="myCell avatar tall centered"><img style="height:25px;" src="<?php echo getImageTheme('ico-static.png'); ?>"></div>

    <div class="myCell name">

        <div><span class="link link-blue"><a href="<?php echo $K->SITE_URL?>info/<?php echo $D->onestatic->url?>" rel="phantom-all" target="dashboard-main-area"><?php echo $D->onestatic->title?></a></span></div>

        <div class="actions2">

            <span><a href="<?php echo $K->SITE_URL?>admin/static-pages/edit/s:<?php echo $D->onestatic->idstatic?>" rel="phantom-all" target="dashboard-main-area"><img src="<?php echo getImageTheme('list-ico-edit.png')?>" class="ico"></a></span>

            <span id="del-static1-<?php echo $D->onestatic->idstatic?>"><img src="<?php echo getImageTheme('list-ico-delete.png')?>" class="ico"></span>

        </div>

    </div>

    <div class="myCell actions">

        <span><a href="<?php echo $K->SITE_URL?>admin/static-pages/edit/s:<?php echo $D->onestatic->idstatic?>" rel="phantom-all" target="dashboard-main-area"><img src="<?php echo getImageTheme('list-ico-edit.png')?>" class="ico"></a></span>

        <span id="del-static2-<?php echo $D->onestatic->idstatic?>"><img src="<?php echo getImageTheme('list-ico-delete.png')?>" class="ico"></span>

    </div>

</div>

<script>

$('#del-static1-<?php echo $D->onestatic->idstatic?>, #del-static2-<?php echo $D->onestatic->idstatic?>').click(function(){
    closeEmerged();
    _confirm(msg_delete_staticpage, nothign, deleteStaticPage, <?php echo $D->onestatic->idstatic?>);
});

</script>