               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>
               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>
                <div id="dashboard-main-center">

                    <div class="box-white">
                        <div class="box-white-header">
                            <div class="title small"><?php echo $this->lang('dashboard_photos_create_title'); ?></div>

                            <div class="clear"></div>

                        </div>

                        <div class="box-white-body">

                            <div id="form01" class="mrg30B">
                                <form id="form1" name="form1" method="post" action="">
                                <div class="form-block">
                                    <label for="privacyalbum"><?php echo $this->lang('dashboard_photos_create_txt_privacy')?>:</label>
                                    <select name="privacyalbum" id="privacyalbum" class="form-control">
                                    <option value="0"><?php echo $this->lang('dashboard_photos_create_txt_public')?></option>
                                    <option value="1"><?php echo $this->lang('dashboard_photos_create_txt_friends')?></option>
                                    <option value="2"><?php echo $this->lang('dashboard_photos_create_txt_onlyme')?></option>
                                    </select>
                                </div>

                                <div class="form-block">
                                    <label for="namealbum"><?php echo $this->lang('dashboard_photos_create_txt_name')?>:</label>
                                    <input name="namealbum" type="text" id="namealbum" placeholder="<?php echo $this->lang('dashboard_photos_create_alt_name')?>" class="form-control"/>
                                </div>

                                <div class="form-block">
                                    <label for="descriptionalbum"><?php echo $this->lang('dashboard_photos_create_txt_description')?>:</label>
                                    <textarea name="descriptionalbum" type="text" id="descriptionalbum" placeholder="<?php echo $this->lang('dashboard_photos_create_alt_description')?>" class="form-control"/></textarea>
                                </div>

                                <div class="mrg20T">
                                    <input name="typecreator" id="typecreator" value="0" type="hidden">
                                    <div id="msgerror" class="alert alert-red hide"></div>
                                    <span><input type="submit" name="bsave" id="bsave" value="<?php echo $this->lang('dashboard_photos_create_txt_buttonsave')?>" class="my-btn my-btn-blue"/></span>
                                </div>

                              </form>

                                <script>

                                var txt_enter_title = stripslashes('<?php echo strJS($this->lang('dashboard_photos_create_error_entertitle'))?>');
                                var txt_enter_description = stripslashes('<?php echo strJS($this->lang('dashboard_photos_create_error_enterdescription'))?>');

                                $('#bsave').click(function(e){
                                    e.preventDefault();
                                    createAlbum('#msgerror', '#bsave');
                                });

                                </script>

                            </div>

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

                <!--DASHBOARD-->