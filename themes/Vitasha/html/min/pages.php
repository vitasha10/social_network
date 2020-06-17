               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>
               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>
                <div id="dashboard-main-center">

                    <div class="box-white">
                        <div class="box-white-header-clean">
                        
                            <div class="title"><?php echo $this->lang('dashboard_pages_title_your'); ?></div>

                            <div class="some-right"><div><span class="blue">+</span> <span class="link link-blue bold"><a href="<?php echo $K->SITE_URL?>pages/create" rel="phantom" target="dashboard-main-area-right"><?php echo $this->lang('dashboard_pages_txt_createpage')?></a></span></div></div>

                            <div class="clear"></div>

                        </div>

                        <div class="box-white-body">

                            <?php if (empty($D->the_list_items)) { ?>

                            <p class="centered grey"><?php echo $this->lang('dashboard_pages_txt_nopages'); ?></p>

                            <?php } else {?>

                            <div id="list-items" class="thepages">
                                <?php echo $D->the_list_items ?>
                            </div>

                            <?php } ?>

                            <?php if ($D->show_more) { ?>

                            <div id="space_more" class="centered">
                                <span class="my-btn" id="linkmore"><?php echo $this->lang('global_txt_showmore')?></span>
                                <input type="hidden" id="activities_place" name="activities_place" value="pages" />
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

                <div id="dashboard-main-right">

                    <?php $this->load_template('_dashboard-right.php'); ?>

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