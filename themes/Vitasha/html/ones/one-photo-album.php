<div id="photo_album_<?php echo $D->the_photo->code?>" class="onephoto">



    <div style="position:relative;">
        <div class="withdelete"><span id="delete_photo_<?php echo $D->the_photo->code?>">x</span></div>
        <a href="<?php echo $K->SITE_URL?>#" class="zoomeer-basic" data-image="<?php echo $D->the_photo->url_max; ?>">
        <div class="img_photo" style="background-image:url(<?php echo $D->the_photo->url; ?>);"></div>
        </a>
    </div>
    

    
</div>
<script>
$('#delete_photo_<?php echo $D->the_photo->code?>').click(function(e){
    e.preventDefault();
    _confirm(msg_delete_photo_album, nothign, deletePhotosAlbum, '<?php echo $D->the_photo->code?>');
});
</script>