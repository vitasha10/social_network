               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                <div id="admin-main-area">

                    <div class="box-white mrg30B">

                        <div class="box-white-header">
                            <div class="ico"><img src="<?php echo getImageTheme('ico-admin-general.png')?>"></div>
                            <div class="title"><?php echo $this->lang('admin_general_title')?></div>
                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_general_block_system_title')?></div>

                                <form id="form1" name="form1" method="post" action="">
                                <div class="form-block">
                                    <label for="sstatus"><?php echo $this->lang('admin_general_block_system_status')?>:</label>
                                    <select name="sstatus" id="sstatus" class="form-control">
                                        <option value="0" <?php echo($D->site_status == 0 ?'selected="selected"' : '');?>><?php echo $this->lang('admin_general_block_system_offline')?></option>
                                        <option value="1" <?php echo($D->site_status == 1 ? 'selected="selected"' : '');?>><?php echo $this->lang('admin_general_block_system_online')?></option>
                                    </select>
                                </div>

                                <div class="form-block">
                                    <label for="wprivacy"><?php echo $this->lang('admin_general_block_system_web_privacy')?>:</label>
                                    <select name="wprivacy" id="wprivacy" class="form-control">
                                        <option value="0" <?php echo($D->site_privacy == 0 ?'selected="selected"' : '');?>><?php echo $this->lang('admin_general_block_system_web_public')?></option>
                                        <option value="1" <?php echo($D->site_privacy == 1 ? 'selected="selected"' : '');?>><?php echo $this->lang('admin_general_block_system_web_private')?></option>
                                    </select>
                                </div>

                                <div class="form-block">
                                    <label for="scompany"><?php echo $this->lang('admin_general_block_system_company')?>:</label>
                                    <input name="scompany" type="text" id="scompany" placeholder="<?php echo $this->lang('admin_general_block_system_company')?>" class="form-control" value="<?php echo $D->site_company?>"/>
                                </div>

                                <div id="msgerror1" class="alert alert-red hide"></div>
                                <div id="msgok1" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave1" id="bsave1" value="<?php echo $this->lang('admin_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>

                                </form>

                            </div>

                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_general_block_seo_title')?></div>

                                <form id="form2" name="form2" method="post" action="">
                                <div class="form-block">
                                    <label for="stitle"><?php echo $this->lang('admin_general_block_seo_sitetitle')?>:</label>
                                    <input name="stitle" type="text" id="stitle" placeholder="<?php echo $this->lang('admin_general_block_seo_sitetitle')?>" class="form-control" value="<?php echo $D->site_title?>"/>
                                </div>

                                <div class="form-block">
                                    <label for="skeywords"><?php echo $this->lang('admin_general_block_seo_sitekeywords')?>:</label>
                                    <input name="skeywords" type="text" id="skeywords" placeholder="<?php echo $this->lang('admin_general_block_seo_sitekeywords')?>" class="form-control" value="<?php echo $D->site_keywords?>"/>
                                </div>

                                <div class="form-block">
                                    <label for="sdescription"><?php echo $this->lang('admin_general_block_seo_sitedescription')?>:</label>
                                    <input name="sdescription" type="text" id="sdescription" placeholder="<?php echo $this->lang('admin_general_block_seo_sitedescription')?>" class="form-control" value="<?php echo $D->site_description?>"/>
                                </div>

                                <div id="msgerror2" class="alert alert-red hide"></div>
                                <div id="msgok2" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave2" id="bsave2" value="<?php echo $this->lang('admin_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>

                                </form>

                            </div>

                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_general_block_register_title')?></div>

                                <form id="form3" name="form3" method="post" action="">
                                <div class="form-block">
                                    <label for="rvalidation"><?php echo $this->lang('admin_general_block_register_emailvalidation')?>:</label>
                                    <select name="rvalidation" id="rvalidation" class="form-control">
                                        <option value="0" <?php echo($D->email_validation == 0 ?'selected="selected"' : '');?>><?php echo $this->lang('admin_general_block_register_without_validation')?></option>

                                        <option value="1" <?php echo($D->email_validation == 1 ? 'selected="selected"' : '');?>><?php echo $this->lang('admin_general_block_register_with_validation')?></option>
                                    </select>
                                </div>

                                <div class="form-block">
                                    <label for="minage"><?php echo $this->lang('admin_general_block_register_minimum_age')?>:</label>
                                    <input name="minage" type="text" id="minage" placeholder="<?php echo $this->lang('admin_general_block_register_minimum_age')?>" class="form-control" value="<?php echo $D->min_age?>"/>
                                </div>

                                <div class="form-block">
                                    <label for="maxage"><?php echo $this->lang('admin_general_block_register_maximum_age')?>:</label>
                                    <input name="maxage" type="text" id="maxage" placeholder="<?php echo $this->lang('admin_general_block_register_maximum_age')?>" class="form-control" value="<?php echo $D->max_age?>"/>
                                </div>

                                <div class="form-block">
                                    <label for="lremember"><?php echo $this->lang('admin_general_block_register_remember_login')?>:</label>
                                    <select name="lremember" id="lremember" class="form-control">
                                        <option value="0" <?php echo($D->with_remember == 0 ?'selected="selected"' : '');?>><?php echo $this->lang('admin_general_block_register_log_without_remember')?></option>
                                        <option value="1" <?php echo($D->with_remember == 1 ? 'selected="selected"' : '');?>><?php echo $this->lang('admin_general_block_register_log_with_remember')?></option>
                                    </select>
                                </div>

                                <div id="msgerror3" class="alert alert-red hide"></div>
                                <div id="msgok3" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave3" id="bsave3" value="<?php echo $this->lang('admin_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>

                                </form>

                            </div>
                            
                            
                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_general_block_sidebar_users_title')?></div>

                                <form id="form8" name="form8" method="post" action="">
                                <div class="form-block">
                                    <label for="sidebarusers"><?php echo $this->lang('admin_general_block_sidebar_users_what')?>:</label>
                                    <select name="sidebarusers" id="sidebarusers" class="form-control">
                                        <option value="1" <?php echo($D->email_validation == 1 ?'selected="selected"' : '');?>><?php echo $this->lang('admin_general_block_sidebar_users_what_friends')?></option>

                                        <option value="2" <?php echo($D->email_validation == 2 ? 'selected="selected"' : '');?>><?php echo $this->lang('admin_general_block_sidebar_users_what_all')?></option>
                                    </select>
                                </div>

                                <div id="msgerror8" class="alert alert-red hide"></div>
                                <div id="msgok8" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave8" id="bsave8" value="<?php echo $this->lang('admin_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>

                                </form>

                            </div>
                            
                            
                            
                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_general_block_foremail_title')?></div>

                                <form id="form4" name="form4" method="post" action="">
                                <div class="form-block">
                                    <label for="fromname"><?php echo $this->lang('admin_general_block_foremail_fromname')?></label>
                                    <input name="fromname" type="text" id="fromname" placeholder="<?php echo $this->lang('admin_general_block_foremail_fromname')?>" class="form-control" value="<?php echo $D->mail_fromname;?>"/>
                                </div>

                                <div class="form-block">
                                    <label for="fromemail"><?php echo $this->lang('admin_general_block_foremail_fromemail')?></label>
                                    <input name="fromemail" type="text" id="fromemail" placeholder="<?php echo $this->lang('admin_general_block_foremail_fromemail')?>" class="form-control" value="<?php echo $D->mail_from;?>"/>
                                </div>

                                <div id="msgerror4" class="alert alert-red hide"></div>
                                <div id="msgok4" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave4" id="bsave4" value="<?php echo $this->lang('admin_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>

                                </form>

                            </div>
                            
                            
                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_general_block_withphpmailer_title')?></div>

                                <form id="form5" name="form5" method="post" action="">
                                <div class="form-block">
                                    <label for="withphpmail"><?php echo $this->lang('admin_general_block_withphpmailer_enabledisable')?></label>
                                    <select name="withphpmail" id="withphpmail" class="form-control">
                                        <option value="0" <?php echo($D->mail_withphpmailer == 0 ?'selected="selected"' : '');?>><?php echo $this->lang('admin_general_block_withphpmailer_disable')?></option>
                                        <option value="1" <?php echo($D->mail_withphpmailer == 1 ? 'selected="selected"' : '');?>><?php echo $this->lang('admin_general_block_withphpmailer_enable')?></option>
                                    </select>
                                </div>
                                
                                <div class="form-block">
                                    <label for="mailhost"><?php echo $this->lang('admin_general_block_withphpmailer_mailhost')?></label>
                                    <input name="mailhost" type="text" id="mailhost" placeholder="<?php echo $this->lang('admin_general_block_withphpmailer_mailhost')?>" class="form-control" value="<?php echo $D->mail_host;?>"/>
                                </div>

                                <div class="form-block">
                                    <label for="mailport"><?php echo $this->lang('admin_general_block_withphpmailer_mailport')?></label>
                                    <input name="mailport" type="text" id="mailport" placeholder="<?php echo $this->lang('admin_general_block_withphpmailer_mailport')?>" class="form-control" value="<?php echo $D->mail_port;?>"/>
                                </div>
                                
                                <div class="form-block">
                                    <label for="musername"><?php echo $this->lang('admin_general_block_withphpmailer_username')?></label>
                                    <input name="musername" type="text" id="musername" placeholder="<?php echo $this->lang('admin_general_block_withphpmailer_username')?>" class="form-control" value="<?php echo $D->mail_username;?>"/>
                                </div>

                                <div class="form-block">
                                    <label for="mpassword"><?php echo $this->lang('admin_general_block_withphpmailer_password')?></label>
                                    <input name="mpassword" type="password" id="mpassword" placeholder="<?php echo $this->lang('admin_general_block_withphpmailer_password')?>" class="form-control"/>
                                </div>

                                <div id="msgerror5" class="alert alert-red hide"></div>
                                <div id="msgok5" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave5" id="bsave5" value="<?php echo $this->lang('admin_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>

                                </form>

                            </div>
                            
                            
                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_general_block_fblogin_title')?></div>

                                <form id="form6" name="form6" method="post" action="">
                                <div class="form-block">
                                    <label for="withfblogin"><?php echo $this->lang('admin_general_block_fblogin_allow')?></label>
                                    <select name="withfblogin" id="withfblogin" class="form-control">
                                        <option value="0" <?php echo($D->fb_login == 0 ?'selected="selected"' : '');?>><?php echo $this->lang('admin_general_block_fblogin_allow_no')?></option>
                                        <option value="1" <?php echo($D->fb_login == 1 ? 'selected="selected"' : '');?>><?php echo $this->lang('admin_general_block_fblogin_allow_yes')?></option>
                                    </select>
                                </div>
                                
                                <div class="form-block">
                                    <label for="fbappid"><?php echo $this->lang('admin_general_block_fblogin_appid')?></label>
                                    <input name="fbappid" type="text" id="fbappid" placeholder="<?php echo $this->lang('admin_general_block_withphpmailer_mailhost')?>" class="form-control" value="<?php echo $D->fb_appid;?>"/>
                                </div>

                                <div class="form-block">
                                    <label for="appsecret"><?php echo $this->lang('admin_general_block_fblogin_appsecret')?></label>
                                    <input name="appsecret" type="text" id="appsecret" placeholder="<?php echo $this->lang('admin_general_block_withphpmailer_mailport')?>" class="form-control" value="<?php echo $D->fb_appsecret;?>"/>
                                </div>

                                <div id="msgerror6" class="alert alert-red hide"></div>
                                <div id="msgok6" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave6" id="bsave6" value="<?php echo $this->lang('admin_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>

                                </form>

                            </div>
                            
                            
                            
                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_general_block_twlogin_title')?></div>

                                <form id="form7" name="form7" method="post" action="">
                                <div class="form-block">
                                    <label for="withtwlogin"><?php echo $this->lang('admin_general_block_twlogin_allow')?></label>
                                    <select name="withtwlogin" id="withtwlogin" class="form-control">
                                        <option value="0" <?php echo($D->tw_login == 0 ?'selected="selected"' : '');?>><?php echo $this->lang('admin_general_block_twlogin_allow_no')?></option>
                                        <option value="1" <?php echo($D->tw_login == 1 ? 'selected="selected"' : '');?>><?php echo $this->lang('admin_general_block_twlogin_allow_yes')?></option>
                                    </select>
                                </div>
                                
                                <div class="form-block">
                                    <label for="twappid"><?php echo $this->lang('admin_general_block_twlogin_appid')?></label>
                                    <input name="twappid" type="text" id="twappid" placeholder="<?php echo $this->lang('admin_general_block_twlogin_appid')?>" class="form-control" value="<?php echo $D->tw_appid;?>"/>
                                </div>

                                <div class="form-block">
                                    <label for="twappsecret"><?php echo $this->lang('admin_general_block_twlogin_appsecret')?></label>
                                    <input name="twappsecret" type="text" id="twappsecret" placeholder="<?php echo $this->lang('admin_general_block_twlogin_appsecret')?>" class="form-control" value="<?php echo $D->tw_appsecret;?>"/>
                                </div>
                                
                                <div class="form-block">
                                    <label for="twdomain"><?php echo $this->lang('admin_general_block_twlogin_domain')?></label>
                                    <input name="twdomain" type="text" id="twdomain" placeholder="<?php echo $this->lang('admin_general_block_twlogin_domain')?>" class="form-control" value="<?php echo $D->tw_email;?>"/>
                                </div>


                                <div id="msgerror7" class="alert alert-red hide"></div>
                                <div id="msgok7" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave7" id="bsave7" value="<?php echo $this->lang('admin_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>

                                </form>

                            </div>
                            
                            
                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_general_block_google_api_title')?></div>

                                <form id="form9" name="form9" method="post" action="">
                                <div class="form-block">
                                    <label for="apigoogle"><?php echo $this->lang('admin_general_block_google_api_key')?></label>
                                    <input name="apigoogle" type="text" id="apigoogle" placeholder="<?php echo $this->lang('admin_general_block_google_api_key')?>" class="form-control" value="<?php echo $D->api_key_google;?>"/>
                                </div>

                                <div id="msgerror9" class="alert alert-red hide"></div>
                                <div id="msgok9" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave9" id="bsave9" value="<?php echo $this->lang('admin_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>

                                </form>

                            </div>
                            
                            

                        </div>

                    </div>     

                </div>

                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>

<script>

    var _menu_resp_admin = stripslashes('<?php echo strJS(cutLineJump($D->admin_menu_title))?>') + stripslashes('<?php echo strJS(cutLineJump($D->admin_menu_responsive))?>') + '<div class="mrg10B"></div>';

    var txt_error_option = stripslashes('<?php echo strJS($this->lang('admin_txt_must_choose_option'))?>');
    var txt_error_company = stripslashes('<?php echo strJS($this->lang('admin_general_block_system_error_company'))?>');
    var txt_error_title = stripslashes('<?php echo strJS($this->lang('admin_general_block_seo_error_title'))?>');
    var txt_error_keyword = stripslashes('<?php echo strJS($this->lang('admin_general_block_seo_error_keywords'))?>');
    var txt_error_description = stripslashes('<?php echo strJS($this->lang('admin_general_block_seo_error_description'))?>');

    var txt_error_min_age = stripslashes('<?php echo strJS($this->lang('admin_general_block_register_error_min_age'))?>');
    var txt_error_max_age = stripslashes('<?php echo strJS($this->lang('admin_general_block_register_error_max_age'))?>');
    var txt_error_mingreatermax = stripslashes('<?php echo strJS($this->lang('admin_general_block_register_error_mingreatermax'))?>');

    $('#bsave1').click(function(e){
        e.preventDefault();
        updateGeneralSystem('#msgerror1', '#msgok1', '#bsave1');
    });

    $('#bsave2').click(function(e){
        e.preventDefault();
        updateGeneralSEO('#msgerror2', '#msgok2', '#bsave2');
    });

    $('#bsave3').click(function(e){
        e.preventDefault();
        updateGeneralRegister('#msgerror3', '#msgok3', '#bsave3');
    });
    
    var txt_error_fromname = stripslashes('<?php echo strJS($this->lang('admin_general_block_foremail_error_fromname'))?>');
    var txt_error_fromemail = stripslashes('<?php echo strJS($this->lang('admin_general_block_foremail_error_fromemail'))?>');
    $('#bsave4').click(function(e){
        e.preventDefault();
        updateGeneralEmail('#msgerror4', '#msgok4', '#bsave4');
    });
    
    var txt_error_mailhost = stripslashes('<?php echo strJS($this->lang('admin_general_block_withphpmailer_error_mailhost'))?>');
    var txt_error_mailport = stripslashes('<?php echo strJS($this->lang('admin_general_block_withphpmailer_error_mailport'))?>');
    var txt_error_musername = stripslashes('<?php echo strJS($this->lang('admin_general_block_withphpmailer_error_username'))?>');
    var txt_error_mpassword = stripslashes('<?php echo strJS($this->lang('admin_general_block_withphpmailer_error_password'))?>');
    $('#bsave5').click(function(e){
        e.preventDefault();
        updateGeneralPHPMAILER('#msgerror5', '#msgok5', '#bsave5');
    });
    
    var txt_error_appid = stripslashes('<?php echo strJS($this->lang('admin_general_block_fblogin_error_appid'))?>');
    var txt_error_appsecret = stripslashes('<?php echo strJS($this->lang('admin_general_block_fblogin_error_appsecret'))?>');
    $('#bsave6').click(function(e){
        e.preventDefault();
        updateGeneralFBLogin('#msgerror6', '#msgok6', '#bsave6');
    });
    
    var txt_error_twappid = stripslashes('<?php echo strJS($this->lang('admin_general_block_twlogin_error_appid'))?>');
    var txt_error_twappsecret = stripslashes('<?php echo strJS($this->lang('admin_general_block_twlogin_error_appsecret'))?>');
    var txt_error_twdomain = stripslashes('<?php echo strJS($this->lang('admin_general_block_twlogin_error_domain'))?>');
    $('#bsave7').click(function(e){
        e.preventDefault();
        updateGeneralTWLogin('#msgerror7', '#msgok7', '#bsave7');
    });
    
    $('#bsave8').click(function(e){
        e.preventDefault();
        updateSidebarUsers('#msgerror8', '#msgok8', '#bsave8');
    });
    
    var txt_error_apigoogle = stripslashes('<?php echo strJS($this->lang('admin_general_block_google_api_key_error'))?>');
    $('#bsave9').click(function(e){
        e.preventDefault();
        updateAPIGoogle('#msgerror9', '#msgok9', '#bsave9');
    });

    markMenuLeft('admin');
    makeMenuResp('admin')

</script>