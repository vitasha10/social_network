<div class="article-in-post">

    <a href="<?php echo $K->SITE_URL; ?>article/<?php echo $D->article->code; ?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-max" target="dashboard-main-area"' : '') ?>>
    <div class="container-info">

        <div class="container-image">
            <div class="theimage" style="background-image:url(<?php echo $D->article->photo; ?>);"></div>
        </div>    
        <div class="container-name">
            <div class="thecategory"><span class="thetext"><?php echo $D->subcategory_article; ?></span></div>
            <div class="thetitle"><?php echo($D->article->title); ?></div>
            <div class="textby"><span class="theby"><?php echo $this->lang('dashboard_library_txt_by')?></span> <span class="thename"><?php echo(stripslashes($D->the_writer_a->firstname).' '.stripslashes($D->the_writer_a->lastname)); ?></span></div>
        </div>

    </div>
    </a>

</div>