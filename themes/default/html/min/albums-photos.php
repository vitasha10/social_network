               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>
               
                <div id="dashboard-main-center">

                    <div class="box-white">
                        <div class="box-white-header">
                            <div class="title"><?php echo $this->lang('dashboard_albums_photos_title'); ?></div>
                            
                            <div class="some-right"><div><span class="blue">&laquo;</span> <span class="link link-blue"><a href="<?php echo $K->SITE_URL?>albums" rel="phantom" target="dashboard-main-area-right"><?php echo $this->lang('dashboard_albums_edit_back')?></a></span></div></div>

                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">
                        
                            <div class="spacetitle" style="text-align:center; margin-bottom:10px;"><?php echo $D->title; ?></div>
                        

                            <?php if (empty($D->hmtl_photos)) { ?>
                            
                            <?php } else { ?>
                            
                                <div id="space-photos-album">
                                    <?php echo $D->hmtl_photos; ?>
                                    <div class="clear"></div>
                                </div>
                                
                                <script>
                                    var codealbum = '<?php echo $D->codealbum; ?>';
                                    var msg_delete_photo_album = stripslashes('<?php echo $this->designer->boxConfirm($this->lang('dashboard_albums_photos_delete_alert_title'), $this->lang('dashboard_albums_photos_delete_alert_message'), $this->lang('dashboard_albums_photos_delete_alert_bdelete'), $this->lang('dashboard_albums_photos_delete_alert_bcancel'))?>');
                                </script>
                            
                            <?php } ?>

                            <div class="mrg30B"></div>

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