                   <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                    <div id="profile-content-area">

                        <div id="profile-settings-area-left">

                            <?php $this->load_template('_menu-setting-group.php'); ?>

                        </div>

                        <div id="profile-settings-area-right">

                            <div class="box-white mrg30B">
                                <div class="box-white-header">
                                    <div class="title"><?php echo $this->lang('setting_group_requests_title'); ?></div>
                                    <div class="clear"></div>
                                </div>

                                <div class="box-white-body">

                                    <?php if (empty($D->requests_html)) { ?>

                                    <p class="centered grey"><?php echo $this->lang('setting_group_requests_empty'); ?></p>

                                    <?php } else {?>

                                    <?php echo $D->requests_html?>

                                    <?php } ?>

                                </div>
                            </div>

                        </div>

                        <div class="clear"></div>

                        <?php $this->load_template('_foot-out.php'); ?>

                    </div>
<?php if ($D->_IS_LOGGED) { ?>

<script>
var _menu_resp_dashboard = stripslashes('<?php echo strJS(cutLineJump($D->mini_card_user))?>') + stripslashes('<?php echo strJS(cutLineJump($D->dashboard_menu_responsive))?>') + '<div class="mrg10B"></div>';

makeMenuResp('dashboard');

</script>

<?php } ?>



                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>

