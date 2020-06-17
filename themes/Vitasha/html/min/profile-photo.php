                   <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                    <link rel="stylesheet" href="<?php echo $K->SITE_URL.'themes/'.$K->THEME?>/js/mediaelement/mediaelementplayer.min.css" />
                    <link rel="stylesheet" href="<?php echo $K->SITE_URL.'themes/'.$K->THEME?>/js/videojs/video-js.min.css" />

                    <div id="space-main-center">
                        <?php echo $D->html_media?>
                        <div style="margin-bottom:50px;"></div>
                    </div>

                    <div id="space-main-right">

                    <?php $this->load_template('_others-right.php'); ?>

                    </div>

                    <div class="clear"></div>

                    <script>
                        $('video.js_video-js').each(function(){ videojs($(this)[0], {}, function() {}); });
                        $('audio.mep_audio').mediaelementplayer();
                        activeSlimScrollers();
                    </script>

<?php if ($D->_IS_LOGGED) { ?>

<script>
var _menu_resp_dashboard = stripslashes('<?php echo strJS(cutLineJump($D->mini_card_user))?>') + stripslashes('<?php echo strJS(cutLineJump($D->dashboard_menu_responsive))?>') + '<div class="mrg10B"></div>';

$('.action_autosize').each(function(){
    autosize(this);
});

makeMenuResp('dashboard');

</script>

<?php } ?>

                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>