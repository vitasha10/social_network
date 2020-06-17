<div id="linkmore" class="centered">
    <span id="loader_showmore" class="hide"><img src="<?php echo getImageTheme('preload.gif')?>"></span>
    <span class="my-btn" id="bmore"><?php echo $this->lang('global_txt_showmore')?></span>
    <input type="hidden" id="activity_page" name="activity_page" value="1" />
    <input type="hidden" id="code_profile" name="code_profile" value="<?php echo $D->codeprofile?>" />
</div>

<div class="mrg30B"></div>

<script>
var code_profile = '<?php echo $D->codeprofile?>';
var theplace = <?php echo $D->the_place?>; // 1: user  2: page  3:group  4:event // 5:dashboard  6:pages feed  7:groups feed  8:saved  9: hashtag
var type_items = <?php echo $D->type_items?>; // 1: timeline (all)  2: videos  3: audios

$('#bmore').click(function(){
    moreActivities();
});

<?php if ($K->WITH_INFINITE_SCROLL) { ?>
var reloading_done = 0;
$(window).scroll(function() {
    the_width = $(document).width();
    if (the_width > 768) {
        the_height_window = $(window).scrollTop() + $(window).height();
        the_height_document = $(document).height() - 100;
        if (the_height_window > the_height_document) {
            if (reloading_done == 0) {
                reloading_done = 1;
                moreActivities();
                return false;
            }
        }
    }
});
<?php } ?>

</script>