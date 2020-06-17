               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>
                <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>
                <link rel="stylesheet" href="<?php echo $K->SITE_URL.'themes/'.$K->THEME?>/js/mediaelement/mediaelementplayer.min.css" />
                <link rel="stylesheet" href="<?php echo $K->SITE_URL.'themes/'.$K->THEME?>/js/videojs/video-js.min.css" />

                <div id="dashboard-main-center">

                    <?php $this->load_template('_editor.php'); ?>

                    <div id="the-posts-init">
                        <div style="text-align:center;"><img src="<?php echo getImageTheme('preload.gif');?>"></div>
                    </div>

                    <div id="the-show-more"></div>

                </div>

                <div id="dashboard-main-right">

                    <?php $this->load_template('_dashboard-right.php'); ?>

                </div>
                <div class="clear"></div>

                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>

                <script type="text/javascript">
                    var _menu_resp_dashboard = stripslashes('<?php echo strJS(cutLineJump($D->mini_card_user))?>') + stripslashes('<?php echo strJS(cutLineJump($D->dashboard_menu_responsive))?>') + '<div class="mrg10B"></div>';
                    markMenuLeft('dashboard');
                    makeMenuResp('dashboard');
                </script>

                <script type="text/javascript">
                    $(function() {
                        setTimeout(function(){ loadPostsInit(); }, 1);
                    });
                </script>

                <!--DASHBOARD-->