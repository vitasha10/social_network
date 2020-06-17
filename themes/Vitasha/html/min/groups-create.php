               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                <div id="dashboard-main-center">

                    <div class="box-white">
                        <div class="box-white-header">
                            <div class="title small"><?php echo $this->lang('dashboard_groups_create_title'); ?></div>

                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <div id="form01" class="mrg30B">
                                <form id="form1" name="form1" method="post" action="">
                                <div class="form-block">
                                    <label for="titlegroup"><?php echo $this->lang('dashboard_groups_create_txt_title')?>:</label>
                                    <input name="titlegroup" type="text" id="titlegroup" placeholder="<?php echo $this->lang('dashboard_groups_create_alt_title')?>" class="form-control"/>
                                </div>

                                <div class="form-block">
                                    <label for="urlgroup"><?php echo $this->lang('dashboard_groups_create_txt_url')?>:</label>
                                    <input name="urlgroup" type="text" id="urlgroup" placeholder="<?php echo $this->lang('dashboard_groups_create_alt_url')?>" class="form-control"/>
                                </div>

                                <div class="form-block">
                                    <label for="descriptiongroup"><?php echo $this->lang('dashboard_groups_create_txt_description')?>:</label>
                                    <textarea name="descriptiongroup" type="text" id="descriptiongroup" placeholder="<?php echo $this->lang('dashboard_groups_create_alt_description')?>" class="form-control"/></textarea>
                                </div>

                                <div class="form-block">
                                    <label for="privacygroup"><?php echo $this->lang('dashboard_groups_create_txt_privacy')?>:</label>
                                    <select name="privacygroup" id="privacygroup" class="form-control" onchange="loadDetails(this.value, '#msgprivacy');">
                                    <option value="0"><?php echo $this->lang('dashboard_groups_create_txt_public')?></option>
                                    <option value="1"><?php echo $this->lang('dashboard_groups_create_txt_closed')?></option>
                                    <option value="2"><?php echo $this->lang('dashboard_groups_create_txt_secret')?></option>
                                    </select>

                                    <div id="msgprivacy" class="mrg5T"></div>

                                </div>

                                <div class="mrg20T">
                                    <div id="msgerror" class="alert alert-red hide"></div>
                                    <span><input type="submit" name="bsave" id="bsave" value="<?php echo $this->lang('dashboard_groups_create_txt_buttonsave')?>" class="my-btn my-btn-blue"/></span>
                                </div>

                              </form>

                                <script>

                                function loadDetails(idmsg, divmsg) {
                                    idmsg = parseInt(idmsg);
                                    switch (idmsg) {
                                        case 0:
                                            $(divmsg).html('<?php echo $this->lang('dashboard_groups_create_txt_msgpublic');?>');
                                            break;	
                                        case 1:
                                            $(divmsg).html('<?php echo $this->lang('dashboard_groups_create_txt_msgclosed');?>');
                                            break;	
                                        case 2:
                                            $(divmsg).html('<?php echo $this->lang('dashboard_groups_create_txt_msgsecret');?>');
                                            break;
                                    }

                                }

                                loadDetails(0, '#msgprivacy');

                                var txt_enter_title = stripslashes('<?php echo strJS($this->lang('dashboard_groups_create_error_entertitle'))?>');
                                var txt_enter_url = stripslashes('<?php echo strJS($this->lang('dashboard_groups_create_error_enterurl'))?>');
                                var txt_url_invalid = stripslashes('<?php echo strJS($this->lang('dashboard_groups_create_error_urlnovalid'))?>');
                                var txt_enter_description = stripslashes('<?php echo strJS($this->lang('dashboard_groups_create_error_enterdescription'))?>');

                                $('#bsave').click(function(e){
                                    e.preventDefault();
                                    createGroup('#msgerror', '#bsave');
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

                <script>
                
                var _menu_resp_dashboard = stripslashes('<?php echo strJS(cutLineJump($D->mini_card_user))?>') + stripslashes('<?php echo strJS(cutLineJump($D->dashboard_menu_responsive))?>') + '<div class="mrg10B"></div>';

                markMenuLeft('dashboard');
                makeMenuResp('dashboard');

                </script>

                <!--DASHBOARD-->