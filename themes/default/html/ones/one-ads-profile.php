<div id="oneads-<?php echo $D->one->idbasic?>" class="one_item">

    <div>
        <div id="delads-<?php echo $D->one->idbasic?>" class="delete_item opc_delete_cat">x</div>

        <div class="info_item">
            <div class="the_name"><?php echo $D->one->name?> <span style="color:#CC0003; font-size:13px;"><?php echo($D->one->status == 0 ? '('.$this->lang('admin_ads_profile_txt_not_visible').')' : '')?><span></div>

            <div><span class="the_option"><a href="<?php echo $K->SITE_URL?>admin/ads/profile/edit/a:<?php echo $D->one->code?>" rel="phantom" target="dashboard-main-area-right"><span class="bold">Edit</span></a></span></div>
        </div>
    </div>

    <div class="clear"></div>

</div>

<script>

$('#delads-<?php echo $D->one->idbasic?>').click(function(){
    closeEmerged();
    _confirm(msg_delete_ads, nothign, deleteAds, <?php echo $D->one->idbasic?>);
});

</script>