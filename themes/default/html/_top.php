    <script> var msg_error_conection = stripslashes('<?php echo strJS($this->lang('global_txt_cannotperform'))?>'); </script>
    <div id="topbar-basic">
        <div class="spacetop">
            <?php echo $D->html_logo ?>
            <?php echo $D->html_menu_top ?>
        </div>
    </div>

    <div class="clear"></div>

    <div id="space-below-top-basic"></div>

    <div id="item-card" class="_emerged"></div>

    <!-- layout modal -->

    <div id="the-modal" class="hide">
        <div id="the-modal-content"></div>
    </div>

    <script>

	$('#item-card').mouseleave(function() {
		$('#item-card').hide();
	});

    </script>