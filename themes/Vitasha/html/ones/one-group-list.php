<div class="myRow" id="group-<?php echo $D->one->idgroup?>">
    <div class="myCell name">
        <div><span class="link link-blue"><a href="<?php echo $K->SITE_URL.$D->one->username?>" rel="phantom-all" target="dashboard-main-area"><?php echo $D->one->allname?></a></span></div>
        <div class="line2">Creator: <span class="link link-blue"><a href="<?php echo $K->SITE_URL.$D->one->creator_username?>" rel="phantom-all" target="dashboard-main-area"><?php echo $D->one->creator_name?></a></span></div>
        <div class="actions2">
            <span><a href="<?php echo $K->SITE_URL?>admin/groups/edit/g:<?php echo $D->one->idgroup?>" rel="phantom-all" target="dashboard-main-area"><img src="<?php echo getImageTheme('list-ico-edit.png')?>" class="ico"></a></span>

            <span id="del-group1-<?php echo $D->one->idgroup?>"><img src="<?php echo getImageTheme('list-ico-delete.png')?>" class="ico"></span>

        </div>
    </div>
    <div class="myCell actions">
        <span><a href="<?php echo $K->SITE_URL?>admin/groups/edit/g:<?php echo $D->one->idgroup?>" rel="phantom-all" target="dashboard-main-area"><img src="<?php echo getImageTheme('list-ico-edit.png')?>" class="ico"></a></span>

        <span id="del-group2-<?php echo $D->one->idgroup?>"><img src="<?php echo getImageTheme('list-ico-delete.png')?>" class="ico"></span>

    </div>
</div>

<script>
    $('#del-group1-<?php echo $D->one->idgroup?>, #del-group2-<?php echo $D->one->idgroup?>').click(function(){
        closeEmerged();
        _confirm(msg_delete_group, nothign, deleteGroup, <?php echo $D->one->idgroup?>);
    });
</script>
