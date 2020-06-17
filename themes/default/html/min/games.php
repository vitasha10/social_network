               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>
               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>
                <div id="dashboard-one-space">

                    <div class="box-white">
                        <div class="box-white-header-clean">

                            <div class="ico"><img src="<?php echo getImageTheme('i-m-games.png'); ?>"></div>
                            <div class="title withico"><?php echo $this->lang('dashboard_games_title'); ?></div>

                            <div class="clear"></div>

                        </div>
                    
                        <div class="box-white-body">
                                            
                            <?php if (empty($D->the_list_items)) { ?>
                                                    
                            <div class="box-activity-no-item" style="margin-top:20px;">
                                <div class="inside-text">
                                    <?php echo $this->lang('dashboard_games_empty'); ?>
                                </div>
                            </div>
                                                            
                            <?php } else {?>
                            
                            <div id="list-items" class="listgames">
                                <?php echo $D->the_list_items ?>
                            </div>
                            
                            <?php } ?>
                            
                            <?php if ($D->show_more) { ?>
                            <div id="space_more" class="centered">
                                <span class="my-btn" id="linkmore"><?php echo $this->lang('global_txt_showmore')?></span>
                                <input type="hidden" id="activities_place" name="activities_place" value="games" />
                                <input type="hidden" id="activity_page" name="activity_page" value="1" />
                            </div>
                            
                            <script>
                                $('#linkmore').click(function() {
                                    moreItems();
                                });
                            </script>
                            
                            <?php } ?>
                        
                    </div>

                    </div>

                </div>


                <div class="clear"></div>

                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>

                <script>
                
                var _menu_resp_dashboard = stripslashes('<?php echo strJS(cutLineJump($D->mini_card_user))?>') + stripslashes('<?php echo strJS(cutLineJump($D->dashboard_menu_responsive))?>') + '<div class="mrg10B"></div>';

                markMenuLeft('dashboard');
                makeMenuResp('dashboard');

                </script>

                <!--DASHBOARD-->