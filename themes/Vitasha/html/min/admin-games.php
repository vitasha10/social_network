               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                <div id="admin-main-area">

                    <div class="box-white">

                        <div class="box-white-header">
                            <div class="ico"><img src="<?php echo getImageTheme('ico-admin-games.png')?>"></div>
                            <div class="title"><?php echo $this->lang('admin_games_title')?></div>
                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <?php if (isset($D->html_items) && empty($D->html_items)) { ?>

                            <p class="mrg20T centered grey"><?php echo $this->lang('admin_games_empty')?></p>

                            <div class="centered mrg20T mrg20B"><a href="<?php echo $K->SITE_URL?>admin/games/add" rel="phantom" target="dashboard-main-area-right"><span class="my-btn my-btn-small"><?php echo $this->lang('admin_games_badd')?></span></a></div>

                            <?php } else { ?>

                            <div class="centered"><a href="<?php echo $K->SITE_URL?>admin/games/add" rel="phantom" target="dashboard-main-area-right"><span class="my-btn my-btn-small"><?php echo $this->lang('admin_games_badd')?></span></a></div>

                            <div class="myTable table-list-3col">

                            <?php echo $D->html_items?>

                            </div>
                            
                            <div class="clear"></div>

                            <p class="grey2 mrg20T"><span id="num_items" class="bold"><?php echo $D->numgames?></span> <?php echo($D->numgames==1 ? $this->lang('admin_txt_item') : $this->lang('admin_txt_items'))?></p>

                            <?php } ?>

                        </div>

                    </div>     

                </div>

                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>

<script>

    _menu_resp_admin = stripslashes('<?php echo strJS(cutLineJump($D->admin_menu_title))?>') + stripslashes('<?php echo strJS(cutLineJump($D->admin_menu_responsive))?>') + '<div class="mrg10B"></div>';

    var msg_delete_game = stripslashes('<?php echo $this->designer->boxConfirm($this->lang('admin_games_title_delete'), $this->lang('admin_games_msg_delete'), $this->lang('admin_alert_text_confirm'), $this->lang('admin_alert_text_cancel'))?>');

    markMenuLeft('admin');
    makeMenuResp('admin');

</script>
