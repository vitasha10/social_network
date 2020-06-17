<div class="the_media_photo">

    <div class="four_vert_block1">

        <a href="<?php echo $K->SITE_URL.($D->is_shared ? $D->shared->activity_who_does_it_username : $D->activity_who_does_it_username)?>/post/<?php echo $D->code_post_album?>" class="zoomeer" data-id="<?php echo $D->photo[0]->code?>" data-image="<?php echo $K->STORAGE_URL_ALBUMS_USERS?>thumb1/<?php echo $D->photo[0]->folder.'/'.$D->photo[0]->namefile?>" data-place="album"><div class="one_photo four_vert_1<?php echo($D->is_shared?'_shared':'')?>" style="background-image:url(<?php echo $K->STORAGE_URL_ALBUMS_USERS?>thumb2/<?php echo $D->photo[0]->folder.'/'.$D->photo[0]->namefile?>);"></div></a>

    </div>

    

    <div class="four_vert_block2">



        <a href="<?php echo $K->SITE_URL.($D->is_shared ? $D->shared->activity_who_does_it_username : $D->activity_who_does_it_username)?>/post/<?php echo $D->code_post_album?>" class="zoomeer" data-id="<?php echo $D->photo[1]->code?>" data-image="<?php echo $K->STORAGE_URL_ALBUMS_USERS?>thumb1/<?php echo $D->photo[1]->folder.'/'.$D->photo[1]->namefile?>" data-place="album"><div class="one_photo four_vert_2<?php echo($D->is_shared?'_shared':'')?>" style="background-image:url(<?php echo $K->STORAGE_URL_ALBUMS_USERS?>thumb3/<?php echo $D->photo[1]->folder.'/'.$D->photo[1]->namefile?>); margin-bottom:3px;"></div></a>

        <a href="<?php echo $K->SITE_URL.($D->is_shared ? $D->shared->activity_who_does_it_username : $D->activity_who_does_it_username)?>/post/<?php echo $D->code_post_album?>" class="zoomeer" data-id="<?php echo $D->photo[2]->code?>" data-image="<?php echo $K->STORAGE_URL_ALBUMS_USERS?>thumb1/<?php echo $D->photo[2]->folder.'/'.$D->photo[2]->namefile?>" data-place="album"><div class="one_photo four_vert_2<?php echo($D->is_shared?'_shared':'')?>" style="background-image:url(<?php echo $K->STORAGE_URL_ALBUMS_USERS?>thumb3/<?php echo $D->photo[2]->folder.'/'.$D->photo[2]->namefile?>); margin-bottom:3px;"></div></a>

        <a href="<?php echo $K->SITE_URL.($D->is_shared ? $D->shared->activity_who_does_it_username : $D->activity_who_does_it_username)?>/post/<?php echo $D->code_post_album?>" class="zoomeer" data-id="<?php echo $D->photo[3]->code?>" data-image="<?php echo $K->STORAGE_URL_ALBUMS_USERS?>thumb1/<?php echo $D->photo[3]->folder.'/'.$D->photo[3]->namefile?>" data-place="album"><div class="one_photo four_vert_2<?php echo($D->is_shared?'_shared':'')?>" style="background-image:url(<?php echo $K->STORAGE_URL_ALBUMS_USERS?>thumb3/<?php echo $D->photo[3]->folder.'/'.$D->photo[3]->namefile?>);">

        

        <?php if ($D->is_shared) { ?>

        

        <?php if ($D->shared->more_photos) { ?>

            <div class="space_for_more">

                <div class="four_vert_2_more<?php echo($D->is_shared?'_shared':'')?>"><?php echo $D->shared->how_many?>+</div>

            </div>

        <?php } ?>

        <?php } else { ?>

        <?php if ($D->more_photos) { ?>

            <div class="space_for_more">

                <div class="four_vert_2_more"><?php echo $D->how_many?>+</div>

            </div>

        <?php } ?>        

        <?php } ?>

        </div></a>

    </div>

    <div class="clear"></div>

</div>