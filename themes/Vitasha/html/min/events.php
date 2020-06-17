               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>
                <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>
                <link rel="stylesheet" href="<?php echo $K->SITE_URL.'themes/'.$K->THEME?>/js/mediaelement/mediaelementplayer.min.css" />
                <link rel="stylesheet" href="<?php echo $K->SITE_URL.'themes/'.$K->THEME?>/js/videojs/video-js.min.css" />

                <div id="dashboard-main-center">
                
                    <div class="box-white-title" style="margin-bottom:10px;">
                        <div class="inside-space">
                            <div class="ico"><img src="<?php echo getImageTheme('i-m-events.png'); ?>"></div>
                            <div class="title"><?php echo $this->lang('dashboard_events_title');?></div>
                            <div class="clear"></div>
                        </div>
                    </div>


                    <?php if (empty($D->the_list_items)) { ?>

                    <div class="box-activity centered">

                        <div style="padding:50px 10px 40px;">

                            <div style="font-size:15px;"><?php echo $this->lang('dashboard_events_no_events')?></div>

                        </div>

                    </div>

                    <?php } else { ?>

                    <div id="list-items">

                        <?php echo $D->the_list_items ?>

                    </div>
                    

                        <?php if ($D->show_more) { ?>

                    <div id="space_more" class="centered">
                        <span class="my-btn" id="linkmore"><?php echo $this->lang('global_txt_showmore')?></span>
                        <input type="hidden" id="activities_place" name="activities_place" value="events" />
                        <input type="hidden" id="activity_page" name="activity_page" value="1" />
                    </div>

                    <script>

                        $('#linkmore').click(function() {
                            moreItems();
                        });

                    </script>
                    

                        <?php } ?>
                        

                    <?php } ?>


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

                <!--DASHBOARD-->