<div class="the_media_photo">
    <div class="three_vert_block1">
        <a href="<?php echo $K->SITE_URL.($D->is_shared ? $D->shared->activity_who_does_it_username : $D->activity_who_does_it_username)?>/photo/<?php echo $D->photo[0]->code?>" class="zoomeer" data-id="<?php echo $D->photo[0]->code?>" data-image="<?php echo $K->STORAGE_URL_PHOTOS?>thumb1/<?php echo $D->photo[0]->folder.'/'.$D->photo[0]->namefile?>" data-place="post"><div class="one_photo three_vert_1<?php echo($D->is_shared?'_shared':'')?>" style="background-image:url(<?php echo $K->STORAGE_URL_PHOTOS?>thumb2/<?php echo $D->photo[0]->folder.'/'.$D->photo[0]->namefile?>);"></div></a>
    </div>
    
    <div class="three_vert_block2">
        <a href="<?php echo $K->SITE_URL.($D->is_shared ? $D->shared->activity_who_does_it_username : $D->activity_who_does_it_username)?>/photo/<?php echo $D->photo[1]->code?>" class="zoomeer" data-id="<?php echo $D->photo[1]->code?>" data-image="<?php echo $K->STORAGE_URL_PHOTOS?>thumb1/<?php echo $D->photo[1]->folder.'/'.$D->photo[1]->namefile?>" data-place="post"><div class="one_photo three_vert_2<?php echo($D->is_shared?'_shared':'')?>" style="background-image:url(<?php echo $K->STORAGE_URL_PHOTOS?>thumb3/<?php echo $D->photo[1]->folder.'/'.$D->photo[1]->namefile?>); margin-bottom:4px;"></div></a>
        <a href="<?php echo $K->SITE_URL.($D->is_shared ? $D->shared->activity_who_does_it_username : $D->activity_who_does_it_username)?>/photo/<?php echo $D->photo[2]->code?>" class="zoomeer" data-id="<?php echo $D->photo[2]->code?>" data-image="<?php echo $K->STORAGE_URL_PHOTOS?>thumb1/<?php echo $D->photo[2]->folder.'/'.$D->photo[2]->namefile?>" data-place="post"><div class="one_photo three_vert_2<?php echo($D->is_shared?'_shared':'')?>" style="background-image:url(<?php echo $K->STORAGE_URL_PHOTOS?>thumb3/<?php echo $D->photo[2]->folder.'/'.$D->photo[2]->namefile?>);"></div></a>
    </div>
    
    <div class="clear"></div>
</div>