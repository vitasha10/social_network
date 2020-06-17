<div class="myRow" id="user-<?php echo $D->one->iduser?>">

    <div class="myCell avatar"><a href="<?php echo $K->SITE_URL.$D->one->username?>" rel="phantom-all" target="dashboard-main-area"><img src="<?php echo $D->one->avatar?>"></a></div>

    <div class="myCell name">

        <div><span class="link link-blue"><a href="<?php echo $K->SITE_URL.$D->one->username?>" rel="phantom-all" target="dashboard-main-area"><?php echo $D->one->allname?></a></span></div>

        <div class="actions2">

            <span><a href="<?php echo $K->SITE_URL?>admin/users/edit/u:<?php echo $D->one->iduser?>" rel="phantom-all" target="dashboard-main-area"><img src="<?php echo getImageTheme('list-ico-edit.png')?>" class="ico"></a></span>

            <?php if (!$D->isadministrador && ($D->leveladmin <= $D->me->leveladmin)) { ?>

            <span id="del-user1-<?php echo $D->one->iduser?>"><img src="<?php echo getImageTheme('list-ico-delete.png')?>" class="ico"></span>

            <?php } ?>

        </div>

    </div>

    <div class="myCell actions">

        <span><a href="<?php echo $K->SITE_URL?>admin/users/edit/u:<?php echo $D->one->iduser?>" rel="phantom-all" target="dashboard-main-area"><img src="<?php echo getImageTheme('list-ico-edit.png')?>" class="ico"></a></span>

        <?php if (!$D->isadministrador || ($D->leveladmin < $D->me->leveladmin)) { ?>

        <span id="del-user2-<?php echo $D->one->iduser?>"><img src="<?php echo getImageTheme('list-ico-delete.png')?>" class="ico"></span>

        <?php } ?>

    </div>

</div>

<?php if (!$D->isadministrador || ($D->leveladmin < $D->me->leveladmin)) { ?>
<script>
    $('#del-user1-<?php echo $D->one->iduser?>, #del-user2-<?php echo $D->one->iduser?>').click(function(){
        closeEmerged();
        _confirm(msg_delete_user, nothign, deleteUser, <?php echo $D->one->iduser?>);
    });
</script>

<?php } ?>