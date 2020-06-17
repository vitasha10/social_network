<div id="page_<?php echo $D->page->code?>" class="onepage <?php echo ($D->page_last ? 'last' : ''); ?>">

    <img src="<?php echo $D->page->avatar?>" class="the_avat">

    <div class="all_info">

        <div class="onepage-actions">

            <a href="<?php echo $K->SITE_URL.$D->page->puname?>/settings" rel="phantom-all" target="dashboard-main-area"><div class="my-btn my-btn-blue"><?php echo($this->lang('dashboard_groups_txt_settings'))?></div></a>

        </div>

        <div class="onepage-info">

            <div class="page_title"><span class="link link-blue"><a href="<?php echo $K->SITE_URL.$D->page->puname?>" rel="phantom-all" target="dashboard-main-area"><?php echo $D->page->title?></a></span></div>

            <div class="page_category"><?php echo $D->nameCategory?></div>

            <div class="page_likes"><?php echo $D->page->numlikes?> <?php echo ($D->page->numlikes == 1 ? strtolower($this->lang('global_txt_like')) : strtolower($this->lang('global_txt_likes')))?></div>

        </div>

        <div class="clear"></div>

    </div>

</div>

<div class="clear"></div>