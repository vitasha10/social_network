<div id="album_<?php echo $D->event->code?>" class="onealbum <?php echo ($D->album_last ? 'last' : ''); ?>">

    <div class="onealbum-actions">

        <a href="<?php echo $K->SITE_URL.'albums/edit/a:'.$D->album->code?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="dashboard-main-area-right"' : '') ?>><div class="my-btn my-btn-blue"><?php echo $this->lang('dashboard_albums_bedit')?></div></a>

    </div>

    <div class="onealbum-info">

        <div class="album_title"><span class="link link-blue"><a href="<?php echo $K->SITE_URL.$D->album->the_username.'/post/'.$D->album->post_code?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><?php echo $D->album->title; ?></a></span></div>

        <div class="album_type"><span><img src="<?php echo ($D->album->privacy == 1 ? getImageTheme('typepost-friends.png') : getImageTheme('typepost-public.png'))?>" alt=""></span> &#8226; <span class="link link-grey" style="font-weight:normal;"><a href="<?php echo $K->SITE_URL.'albums/photos/a:'.$D->album->code?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="dashboard-main-area-right"' : '') ?>><span style="font-weight:bold;"><?php echo $D->album->numphotos; ?></span> <?php echo($D->album->numphotos == 1 ? $this->lang('dashboard_albums_txt_photo') : $this->lang('dashboard_albums_txt_photos'));?></a></span> &#8226; <span class="link link-grey" style="font-weight:normal;"><a href="<?php echo $K->SITE_URL.'albums/addphotos/a:'.$D->album->code?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="dashboard-main-area-right"' : '') ?>><?php echo $this->lang('dashboard_albums_link_add_photos')?></a></span></div>

    </div>
    
    

    <div class="clear"></div>

</div>