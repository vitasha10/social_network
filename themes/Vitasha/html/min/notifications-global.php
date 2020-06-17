                    <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                    <div id="dashboard-2-parts-left">

                        <div class="box-white mrg30B">

                            <div class="box-white-header-clean">
                                <div class="title"><?php echo $this->lang('dashboard_notifications_title'); ?></div>
                                <div class="clear"></div>
                            </div>

                            <div class="box-white-body">
                            <?php echo $D->html_notifications?>
                            </div>

                        </div>

                    </div>

                    <div id="dashboard-2-parts-right">

                        <?php $this->load_template('_dashboard-right.php'); ?>

                    </div>

                    <div class="clear"></div>


                <script>
                    var _menu_resp_dashboard = stripslashes('<?php echo strJS(cutLineJump($D->mini_card_user))?>') + stripslashes('<?php echo strJS(cutLineJump($D->dashboard_menu_responsive))?>') + '<div class="mrg10B"></div>';

                    makeMenuResp('dashboard');
                </script>

                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>
