               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>
               
                <div id="dashboard-main-center">

                    <div class="box-white">
                        <div class="box-white-header">
                            <div class="title"><?php echo $this->lang('dashboard_albums_edit_title'); ?></div>
                            
                            <div class="some-right"><div><span class="blue">&laquo;</span> <span class="link link-blue"><a href="<?php echo $K->SITE_URL?>albums" rel="phantom" target="dashboard-main-area-right"><?php echo $this->lang('dashboard_albums_edit_back')?></a></span></div></div>

                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <div id="form01" class="mrg30B">
                                <form id="form1" name="form1" method="post" action="">
                                
                                <div class="form-block">
                                    <label for="titlealbum"><?php echo $this->lang('dashboard_albums_create_txt_title')?>:</label>
                                    <input name="titlealbum" type="text" id="titlealbum" placeholder="<?php echo $this->lang('dashboard_albums_create_txt_title')?>" value="<?php echo $D->title?>" class="form-control"/>
                                </div>
                                
                                <div class="form-block">
                                    <label for="descriptionalbum"><?php echo $this->lang('dashboard_albums_create_txt_description')?>:</label>
                                    <textarea name="descriptionalbum" type="text" id="descriptionalbum" placeholder="<?php echo $this->lang('dashboard_albums_create_txt_description')?>" class="form-control"><?php echo $D->description?></textarea>
                                </div>
                                
                                
                                <div class="form-block">
                                    <label for="privacyalbum"><?php echo $this->lang('dashboard_albums_create_txt_privacy')?>:</label>
                                    <select name="privacyalbum" id="privacyalbum" class="form-control">
                                        <option value="0" <?php echo($D->privacy == 0 ? 'selected' : '');?>><?php echo $this->lang('dashboard_albums_txt_public')?></option>
                                        <option value="1" <?php echo($D->privacy == 1 ? 'selected' : '');?>><?php echo $this->lang('dashboard_albums_txt_friends')?></option>
                                    </select>
                                </div>


                                <div class="mrg20T">
                                    <div id="msgerror" class="alert alert-red hide"></div>
                                    <span><input type="submit" name="bsave" id="bsave" value="<?php echo $this->lang('dashboard_albums_edit_bupdate')?>" class="my-btn my-btn-blue"/></span> &nbsp; <span class="link link-blue"><a href="<?php echo $K->SITE_URL?>albums" rel="phantom" target="dashboard-main-area-right"><?php echo $this->lang('dashboard_albums_edit_bcancel')?></a></span> <span id="preload-publish" class="hide"><img src="<?php echo getImageTheme('preload.gif'); ?>" alt=""></span>
                                </div>

                              </form>

                                <script>
                                
                                var txt_error_title = stripslashes('<?php echo strJS($this->lang('dashboard_albums_create_error_title'))?>');
                                var txt_error_privacy = stripslashes('<?php echo strJS($this->lang('dashboard_albums_create_error_privacy'))?>');

                                var code_album = '<?php echo $D->codealbum;?>';
                                $('#bsave').click(function(e){
                                    e.preventDefault();
                                    updateAlbum('#msgerror', '#bsave');
                                });

                                </script>

                            </div>

                            <div class="mrg30B"></div>
                            <div id="msgerror2" class="alert alert-red hide"></div>
                            <div><span id="linkdeletealbum" class="link link-blue"><?php echo $this->lang('dashboard_albums_edit_bdelete')?></span></div>
                            
                            <script>
                            
                            var msg_delete_album = stripslashes('<?php echo $this->designer->boxConfirm($this->lang('dashboard_albums_delete_alert_title'), $this->lang('dashboard_albums_delete_alert_message'), $this->lang('dashboard_albums_delete_alert_bdelete'), $this->lang('dashboard_albums_delete_alert_bcancel'))?>');

                            $('#linkdeletealbum').click(function(e){
                                e.preventDefault();
                                _confirm(msg_delete_album, nothign, deleteAlbum, '#msgerror2');
                            });
                            </script>
                            
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