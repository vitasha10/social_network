                   <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                    <div id="profile-content-area">

                        <div id="profile-settings-area-left">

                            <?php $this->load_template('_menu-setting-group.php'); ?>

                        </div>

                        <div id="profile-settings-area-right">

                            <div class="box-white">
                                <div class="box-white-header">
                                    <div class="title"><?php echo $this->lang('setting_group_settings_title'); ?></div>
                                    <div class="clear"></div>
                                </div>

                                <div class="box-white-body">

                                    <div id="form01" class="mrg10B">
                                        <form id="form1" name="form1" method="post" action="">
                                        <div class="form-block">
                                            <label for="titlegroup"><?php echo $this->lang('dashboard_groups_create_txt_title')?>:</label>
                                            <input name="titlegroup" type="text" id="titlegroup" placeholder="<?php echo $this->lang('dashboard_groups_create_alt_title')?>" class="form-control" value="<?php echo $D->the_title?>"/>
                                        </div>

                                        <div class="form-block">
                                            <label for="urlgroup"><?php echo $this->lang('dashboard_groups_create_txt_url')?>:</label>
                                            <input name="urlgroup" type="text" id="urlgroup" placeholder="<?php echo $this->lang('dashboard_groups_create_alt_url')?>" class="form-control" value="<?php echo $D->username?>"/>
                                        </div>

                                        <div class="form-block">
                                            <label for="descriptiongroup"><?php echo $this->lang('dashboard_groups_create_txt_description')?>:</label>
                                            <textarea name="descriptiongroup" type="text" id="descriptiongroup" placeholder="<?php echo $this->lang('dashboard_groups_create_alt_description')?>" class="form-control"/></textarea>
                                            <script>$('#descriptiongroup').val(stripslashes('<?php echo strJS($D->about)?>'));</script>
                                        </div>

                                        <div class="form-block">
                                            <label for="privacygroup"><?php echo $this->lang('dashboard_groups_create_txt_privacy')?>:</label>
                                            <select name="privacygroup" id="privacygroup" class="form-control" onchange="loadDetails(this.value, '#msgprivacy');">
                                            <option value="0" <?php echo($D->privacy == 0 ?'selected="selected"' : '');?>><?php echo $this->lang('dashboard_groups_create_txt_public')?></option>
                                            <option value="1" <?php echo($D->privacy == 1 ?'selected="selected"' : '');?>><?php echo $this->lang('dashboard_groups_create_txt_closed')?></option>

                                            <option value="2" <?php echo($D->privacy == 2 ?'selected="selected"' : '');?>><?php echo $this->lang('dashboard_groups_create_txt_secret')?></option>
                                            </select>
                                            <div id="msgprivacy" class="mrg5T"></div>
                                        </div>

                                        <div class="mrg20T">
                                            <div id="msgerror" class="alert alert-red hide"></div>
                                            <span><input type="submit" name="bsave" id="bsave" value="<?php echo $this->lang('setting_txt_save_changes')?>" class="my-btn my-btn-blue"/></span>
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

                                        loadDetails(<?php echo $D->privacy?>, '#msgprivacy');

                                        var txt_enter_title = stripslashes('<?php echo strJS($this->lang('dashboard_groups_create_error_entertitle'))?>');
                                        var txt_enter_url = stripslashes('<?php echo strJS($this->lang('dashboard_groups_create_error_enterurl'))?>');
                                        var txt_url_invalid = stripslashes('<?php echo strJS($this->lang('dashboard_groups_create_error_urlnovalid'))?>');
                                        var txt_enter_description = stripslashes('<?php echo strJS($this->lang('dashboard_groups_create_error_enterdescription'))?>');

                                        var cgr = '<?php echo $D->codegroup?>';

                                        $('#bsave').click(function(e){
                                            e.preventDefault();
                                            updateGroup('#msgerror', '#bsave');
                                        });

                                        </script>

                                    </div>


                                    <div style="margin-top:40px; margin-bottom:25px;">
                                        <div id="msgerror2" class="alert alert-red hide"></div>
                                        <div><span id="linkdeletegroup" class="link link-blue"><?php echo $this->lang('setting_group_settings_txt_delet_page_alert_title')?></span></div>
                                    </div>
                                    
                                    <script>
                                    var msg_delete_group = stripslashes('<?php echo $this->designer->boxConfirm($this->lang('setting_group_settings_txt_delet_page_alert_title'), $this->lang('setting_group_settings_txt_delet_page_alert_msg'), $this->lang('setting_group_settings_txt_delet_page_alert_ok'), $this->lang('setting_group_settings_txt_delet_page_alert_cancel'))?>');
        
                                    var codegroup = '<?php echo $D->codegroup; ?>';
                                    $('#linkdeletegroup').click(function(e){
                                        e.preventDefault();
                                        _confirm(msg_delete_group, nothign, deleteGroup, '#msgerror2');
                                    });
                                    </script>


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
