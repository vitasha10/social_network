               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>
               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>
                <div id="setting-main-area">

                    <div class="box-white mrg30B">

                        <div class="box-white-header">
                            <div class="ico"><img src="<?php echo getImageTheme('ico-set-privacy.png')?>"></div>
                            <div class="title"><?php echo $this->lang('setting_privacy_title')?></div>
                            <div class="clear"></div>
                        </div>
                    
                        <div class="box-white-body">
                        

                            <div class="areablock space-in-setting">
                            
                                <div class="subtitle"><?php echo $this->lang('setting_privacy_block_profile')?></div>

                                <form id="form1" name="form1" method="post" action="">

                                <div class="form-block">
                                    <label for="pprofile"><?php echo $this->lang('setting_privacy_txtprofile')?></label>
                                    <select name="pprofile" id="pprofile" class="form-control">
                                        <option value="0" <?php echo($D->privacy==0?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txtpublic')?></option>
                                        <option value="1" <?php echo($D->privacy==1?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txtonlyfriends')?></option>
                                        <option value="2" <?php echo($D->privacy==2?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txtprivate')?></option>
                                    </select>
                                </div>

                                <div class="form-block">
                                    <label for="pwritewall"><?php echo $this->lang('setting_privacy_txt_wall')?></label>
                                    <select name="pwritewall" id="pwritewall" class="form-control">
                                        <option value="0" <?php echo($D->who_write_on_my_wall==0?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txt_any')?></option>
                                        <option value="1" <?php echo($D->who_write_on_my_wall==1?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txt_friends')?></option>
                                        <option value="2" <?php echo($D->who_write_on_my_wall==2?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txt_onlyme')?></option>
                                    </select>
                                </div>

                                <div class="form-block">
                                    <label for="pseefriends"><?php echo $this->lang('setting_privacy_txt_seefriends')?></label>
                                    <select name="pseefriends" id="pseefriends" class="form-control">
                                        <option value="0" <?php echo($D->who_can_see_friends==0?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txt_any')?></option>
                                        <option value="1" <?php echo($D->who_can_see_friends==1?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txt_friends')?></option>
                                        <option value="2" <?php echo($D->who_can_see_friends==2?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txt_onlyme')?></option>
                                    </select>
                                </div>

                                <div class="form-block">
                                    <label for="pseepages"><?php echo $this->lang('setting_privacy_txt_seepages')?></label>
                                    <select name="pseepages" id="pseepages" class="form-control">
                                        <option value="0" <?php echo($D->who_can_see_liked_pages==0?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txt_any')?></option>
                                        <option value="1" <?php echo($D->who_can_see_liked_pages==1?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txt_friends')?></option>
                                        <option value="2" <?php echo($D->who_can_see_liked_pages==2?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txt_onlyme')?></option>
                                    </select>
                                </div>

                                <div class="form-block">
                                    <label for="pseegroups"><?php echo $this->lang('setting_privacy_txt_seegroups')?></label>
                                    <select name="pseegroups" id="pseegroups" class="form-control">
                                        <option value="0" <?php echo($D->who_can_see_joined_groups==0?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txt_any')?></option>
                                        <option value="1" <?php echo($D->who_can_see_joined_groups==1?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txt_friends')?></option>
                                        <option value="2" <?php echo($D->who_can_see_joined_groups==2?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txt_onlyme')?></option>
                                    </select>
                                </div>

                                <div class="form-block">
                                    <label for="pmessages"><?php echo $this->lang('setting_privacy_txt_sendmessage')?></label>
                                    <select name="pmessages" id="pmessages" class="form-control">
                                        <option value="0" <?php echo($D->who_can_sendme_messages==0?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txt_any')?></option>
                                        <option value="1" <?php echo($D->who_can_sendme_messages==1?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txt_friends')?></option>
                                        <option value="2" <?php echo($D->who_can_sendme_messages==2?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txt_nobody')?></option>
                                    </select>
                                </div>

                                
                                <div id="msgerror1" class="alert alert-red hide"></div>
                                <div id="msgok1" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave1" id="bsave1" value="<?php echo $this->lang('setting_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>
                                
                                </form>
                            
                            </div>
                            
                            <div class="areablock space-in-setting">
                            
                                <div class="subtitle"><?php echo $this->lang('setting_privacy_block_myinfo')?></div>

                                <form id="form2" name="form2" method="post" action="">

                                <div class="form-block">
                                    <label for="pbirthday"><?php echo $this->lang('setting_privacy_txtbirthday')?></label>
                                    <select name="pbirthday" id="pbirthday" class="form-control">
                                        <option value="0" <?php echo($D->who_can_see_birthdate==0?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txt_any')?></option>
                                        <option value="1" <?php echo($D->who_can_see_birthdate==1?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txt_friends')?></option>
                                        <option value="2" <?php echo($D->who_can_see_birthdate==2?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txt_onlyme')?></option>
                                    </select>
                                </div>
                                
                                <div class="form-block">
                                    <label for="plocation"><?php echo $this->lang('setting_privacy_txtlocation')?></label>
                                    <select name="plocation" id="plocation" class="form-control">
                                        <option value="0" <?php echo($D->who_can_see_location==0?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txt_any')?></option>
                                        <option value="1" <?php echo($D->who_can_see_location==1?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txt_friends')?></option>
                                        <option value="2" <?php echo($D->who_can_see_location==2?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txt_onlyme')?></option>
                                    </select>
                                </div>
                                
                                <div class="form-block">
                                    <label for="paboutme"><?php echo $this->lang('setting_privacy_txtaboutme')?></label>
                                    <select name="paboutme" id="paboutme" class="form-control">
                                        <option value="0" <?php echo($D->who_can_see_about_me==0?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txt_any')?></option>
                                        <option value="1" <?php echo($D->who_can_see_about_me==1?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txt_friends')?></option>
                                        <option value="2" <?php echo($D->who_can_see_about_me==2?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txt_onlyme')?></option>
                                    </select>
                                </div>
                                

                                
                                <div id="msgerror2" class="alert alert-red hide"></div>
                                <div id="msgok2" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave2" id="bsave2" value="<?php echo $this->lang('setting_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>
                                
                                </form>
                            
                            </div>
                            
                            <div class="areablock space-in-setting">
                            
                                <div class="subtitle"><?php echo $this->lang('setting_privacy_block_chat')?></div>

                                <form id="form3" name="form3" method="post" action="">

                                <div class="form-block">
                                    <label for="pchat"><?php echo $this->lang('setting_privacy_chatstatus')?></label>
                                    <select name="pchat" id="pchat" class="form-control">
                                        <option value="0" <?php echo($D->chat==0?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txtoffline')?></option>
                                        <option value="1" <?php echo($D->chat==1?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_txtonline')?></option>
                                    </select>
                                </div>
                                
                                <div class="form-block">
                                    <label for="pchatmute"><?php echo $this->lang('setting_privacy_mutechat')?></label>
                                    <select name="pchatmute" id="pchatmute" class="form-control">
                                        <option value="0" <?php echo($D->chat_mute==0?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_mutechat_yes')?></option>
                                        <option value="1" <?php echo($D->chat_mute==1?'selected="selected"':'');?>><?php echo $this->lang('setting_privacy_mutechat_no')?></option>
                                    </select>
                                </div>
                                
                                <div id="msgerror3" class="alert alert-red hide"></div>
                                <div id="msgok3" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave3" id="bsave3" value="<?php echo $this->lang('setting_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>
                                
                                </form>
                            
                            </div>
                        
                        </div>

                    </div>     

                </div>
                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>

<script>

    var _menu_resp_settings = stripslashes('<?php echo strJS(cutLineJump($D->setting_menu_title))?>') + stripslashes('<?php echo strJS(cutLineJump($D->setting_menu_responsive))?>') + '<div class="mrg10B"></div>';
    
    var txt_error_option = stripslashes('<?php echo strJS($this->lang('setting_privacy_error_msg'))?>');
    
    $('#bsave1').click(function(e){
        e.preventDefault();
        updatePrivacyProfile('#msgerror1', '#msgok1', '#bsave1');
    });

    $('#bsave2').click(function(e){
        e.preventDefault();
        updatePrivacyInfo('#msgerror2', '#msgok2', '#bsave2');
    });

    $('#bsave3').click(function(e){
        e.preventDefault();
        updatePrivacyChat('#msgerror3', '#msgok3', '#bsave3');
    });

    markMenuLeft('settings');
    makeMenuResp('settings');
</script>