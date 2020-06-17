
<div class="myRow" id="onegame-<?php echo $D->one->idgame?>">

    <div class="myCell avatar tall centered"><img src="<?php echo $K->STORAGE_URL_GAMES.$D->one->thumbnail; ?>"></div>

    <div class="myCell name">

        <div><span class="link link-blue"><a href="<?php echo $K->SITE_URL; ?>admin/games/edit/g:<?php echo $D->one->code; ?>" rel="phantom-all" target="dashboard-main-area"><?php echo $D->one->name?></a></span></div>

        <div class="actions2">

            <span><a href="<?php echo $K->SITE_URL; ?>admin/games/edit/g:<?php echo $D->one->code; ?>" rel="phantom-all" target="dashboard-main-area"><img src="<?php echo getImageTheme('list-ico-edit.png')?>" class="ico"></a></span>

            <span id="delgame1-<?php echo $D->one->idgame?>"><img src="<?php echo getImageTheme('list-ico-delete.png')?>" class="ico"></span>

        </div>

    </div>

    <div class="myCell actions">

        <span><a href="<?php echo $K->SITE_URL; ?>admin/games/edit/g:<?php echo $D->one->code; ?>" rel="phantom-all" target="dashboard-main-area"><img src="<?php echo getImageTheme('list-ico-edit.png')?>" class="ico"></a></span>

        <span id="delgame2-<?php echo $D->one->idgame?>"><img src="<?php echo getImageTheme('list-ico-delete.png')?>" class="ico"></span>

    </div>

</div>

<script>

$('#delgame1-<?php echo $D->one->idgame; ?>, #delgame2-<?php echo $D->one->idgame; ?>').click(function(){
    closeEmerged();
    _confirm(msg_delete_game, nothign, deleteGame, <?php echo $D->one->idgame?>);
});

</script>