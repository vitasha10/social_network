<div class="myRow" id="product-<?php echo $D->one->idproduct?>">
    <div class="myCell avatar"><a href="<?php echo $D->one->url?>" rel="phantom-all" target="dashboard-main-area"><img src="<?php echo $D->one->photo?>"></a></div>
    <div class="myCell name">
        <div><span class="link link-blue"><a href="<?php echo $D->one->url?>" rel="phantom-all" target="dashboard-main-area"><?php echo $D->one->allname?></a></span></div>
        <div class="line2">Creator: <span class="link link-blue"><a href="<?php echo $K->SITE_URL.$D->one->creator_username?>" rel="phantom-all" target="dashboard-main-area"><?php echo $D->one->creator_name?></a></span></div>
        <div class="actions2">
            <span><a href="<?php echo $K->SITE_URL?>admin/products/edit/p:<?php echo $D->one->idproduct?>" rel="phantom-all" target="dashboard-main-area"><img src="<?php echo getImageTheme('list-ico-edit.png')?>" class="ico"></a></span>

            <span id="del-prod1-<?php echo $D->one->idproduct?>"><img src="<?php echo getImageTheme('list-ico-delete.png')?>" class="ico"></span>

        </div>

    </div>

    <div class="myCell actions">

        <span><a href="<?php echo $K->SITE_URL?>admin/products/edit/p:<?php echo $D->one->idproduct?>" rel="phantom-all" target="dashboard-main-area"><img src="<?php echo getImageTheme('list-ico-edit.png')?>" class="ico"></a></span>

        <span id="del-prod2-<?php echo $D->one->idproduct?>"><img src="<?php echo getImageTheme('list-ico-delete.png')?>" class="ico"></span>

    </div>

</div>

<script>
    $('#del-prod1-<?php echo $D->one->idproduct?>, #del-prod2-<?php echo $D->one->idproduct?>').click(function(){
        closeEmerged();
        _confirm(msg_delete_product, nothign, deleteProduct, <?php echo $D->one->idproduct?>);
    });
</script>