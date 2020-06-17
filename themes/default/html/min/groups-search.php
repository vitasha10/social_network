               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                <div id="dashboard-main-center">

                    <div class="box-white">
                        <div class="box-white-header">
                            <div class="title small"><?php echo $this->lang('dashboard_groups_search_title'); ?></div>

                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <div class="form-block">
                                <label for="termsearch"><?php echo $this->lang('dashboard_groups_search_txt_search')?>:</label>
                                <input name="termsearch" type="text" id="termsearch" placeholder="<?php echo $this->lang('dashboard_groups_search_txt_placeholder')?>" class="form-control"/>
                            </div>

                            <div>
                                <div id="msgerror" class="alert alert-red hide"></div>
                                <span><input type="submit" name="bsearchg" id="bsearchg" value="<?php echo $this->lang('dashboard_groups_search_txt_search')?>" class="my-btn my-btn-blue"/></span>
                            </div>

                            <div class="mrg30T mrg20B hide" id="preloadsearch"><img src="<?php echo getImageTheme('preload.gif')?>"></div>
                            <div class="mrg30T mrg20B hide" id="space-result-search-groups"></div>

                            <script>

                                var txt_error_empty_term = stripslashes('<?php echo strJS($this->lang('dashboard_groups_search_error_empty_term'))?>');
                                var txt_error_short_term = stripslashes('<?php echo strJS($this->lang('dashboard_groups_search_error_short_term'))?>');

                                $('#bsearchg').click(function(e){
                                    e.preventDefault();
                                    searchGroup('#msgerror', '#bsearchg');
                                });

                            </script>

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