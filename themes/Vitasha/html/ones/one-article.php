<div id="article_<?php echo $D->article->code?>" class="onearticle <?php echo ($D->article_last ? 'last' : ''); ?>">

    <div class="onearticle-actions">

        <a href="<?php echo $K->SITE_URL.'articles/edit/a:'.$D->article->code?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="dashboard-main-area-right"' : '') ?>><div class="my-btn my-btn-blue"><?php echo $this->lang('dashboard_articles_bedit')?></div></a>

    </div>

    <div class="onearticle-info">

        <div class="article_name"><span class="link link-blue"><a href="<?php echo $K->SITE_URL.'article/'.$D->article->code?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><?php echo $D->article->title; ?></a></span></div>

        <div class="article_categories">
            <div><?php echo $D->categories->category;?> &#8226; <?php echo $D->categories->subcategory;?></div>
            <div></div>
        </div>

    </div>

    <div class="clear"></div>

</div>