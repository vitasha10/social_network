               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>
               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>
               
                <link rel="stylesheet" href="<?php echo $K->SITE_URL.'themes/'.$K->THEME?>/js/mediaelement/mediaelementplayer.min.css" />
                <link rel="stylesheet" href="<?php echo $K->SITE_URL.'themes/'.$K->THEME?>/js/videojs/video-js.min.css" />
               
                <div id="dashboard-main-center">

                    <?php if (empty($D->the_list_activities)) { ?>

                    <div class="box-activity centered">
                        <div style="padding:50px 10px 40px;">
                            <div style="font-size:15px;"><?php echo $this->lang('dashboard_pages_feed_nopost')?></div>
                        </div>
                        <div style="margin-bottom:50px;">
                            <span><a href="<?php echo $K->SITE_URL?>pages/search" rel="phantom" target="dashboard-main-area-right"><img src="<?php echo getImageTheme('search-pages.png')?>"></a></span>
                            <div class="clear"></div>
                            <span class="link link-blue"><a href="<?php echo $K->SITE_URL?>pages/search" rel="phantom" target="dashboard-main-area-right"><?php echo $this->lang('dashboard_pages_feed_searchpages')?></a></span>
                        </div>
                    </div>

                    <?php } else { ?>

                    <div id="list-activities">
                        <?php echo $D->the_list_activities ?>
                    </div>

                    <?php echo $D->show_more ?>

                    <?php } ?>

                </div>

                <div id="dashboard-main-right">

                    <?php $this->load_template('_dashboard-right.php'); ?>

                </div>

                <div class="clear"></div>

                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>

                <script>
                
                    var _menu_resp_dashboard = stripslashes('<?php echo strJS(cutLineJump($D->mini_card_user))?>') + stripslashes('<?php echo strJS(cutLineJump($D->dashboard_menu_responsive))?>') + '<div class="mrg10B"></div>';

                    $('video.js_video-js').each(function(){ videojs($(this)[0], {}, function() {}); });
                    $('audio.mep_audio').mediaelementplayer();
                    activeSlimScrollers();

                    $('.action_autosize').each(function(){
                        autosize(this);
                    })                
                    

                    markMenuLeft('dashboard');
                    makeMenuResp('dashboard');

                </script>

                

                <!--DASHBOARD-->