<div id="group_<?php echo $D->group->code?>" class="onegroup <?php echo ($D->group_last ? 'last' : ''); ?>">

    <div class="onegroup-actions">
        <a href="<?php echo $K->SITE_URL.$D->group->guname?>/settings" rel="phantom-all" target="dashboard-main-area"><div class="my-btn my-btn-blue"><?php echo $this->lang('dashboard_groups_txt_settings')?></div></a>
    </div>

    <div class="onegroup-info">
        <div class="group_title"><span class="link link-blue"><a href="<?php echo $K->SITE_URL.$D->group->guname?>" rel="phantom-all" target="dashboard-main-area"><?php echo $D->group->title?></a></span></div>
        <div class="group_members"><?php echo $D->group->nummembers?> <?php echo ($D->group->nummembers == 1 ? strtolower($this->lang('global_txt_member')) : strtolower($this->lang('global_txt_members')))?></div>
    </div>
    
    <div class="clear"></div>

</div>