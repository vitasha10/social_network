<div id="onecurrency-<?php echo $D->one->idcurrency?>" class="one_item">

    <div>
        <div id="delcur-<?php echo $D->one->idcurrency?>" class="delete_item opc_delete_cat">x</div>

        <div class="info_item">
            <div class="the_name"><?php echo $D->one->name?> - <?php echo $D->one->code_iso?> - <?php echo $D->one->symbol?></div>
            <div class="the_option"><a href="<?php echo $K->SITE_URL; ?>admin/currencies/edit/c:<?php echo $D->one->idcurrency; ?>" rel="phantom-all" target="dashboard-main-area"><?php echo $this->lang('admin_currencies_txt_edit')?></a></div>
        </div>
    </div>

    <div class="clear"></div>

</div>

<script>

$('#delcur-<?php echo $D->one->idcurrency?>').click(function(){
    closeEmerged();
    _confirm(msg_delete_currency, nothign, deleteCurrency, <?php echo $D->one->idcurrency?>);
});


</script>