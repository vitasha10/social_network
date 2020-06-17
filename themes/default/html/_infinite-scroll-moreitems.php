<?php if ($K->WITH_INFINITE_SCROLL) { ?>
<script>
var alone_reloading_done = 0;
$(window).scroll(function() {
    the_width = $(document).width();
    if (the_width > 768) {
        the_height_window = $(window).scrollTop() + $(window).height();
        the_height_document = $(document).height() - 100;
        if (the_height_window > the_height_document) {
            if (alone_reloading_done == 0) {
                alone_reloading_done = 1;
                moreItems();
                return false;
            }
        }
    }
});
</script>
<?php } ?>