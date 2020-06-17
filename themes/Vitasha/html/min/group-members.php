                   <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                    <div id="profile-content-area">

                        <div class="box-white mrg30B">

                            <div class="box-white-header">
                                <div class="title small"><?php echo $this->lang('profile_group_members_title')?></div>
                                <div class="clear"></div>
                            </div>

                            <div class="box-white-body">

                                <?php if (empty($D->html_members)) { ?>

                                <div class="centered mrg20T mrg20B grey"><?php echo $this->lang('profile_group_members_nohave', array('#THEGROUP#'=>$D->the_title))?></div>

                                <?php } else { ?>

                                <?php echo $D->html_members ?>

                                <?php } ?>

                                <div class="clear"></div>

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
