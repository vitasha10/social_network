               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>
               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>
                <div id="setting-main-area">

                    <div class="box-white mrg30B">

                        <div class="box-white-header">
                            <div class="ico"><img src="<?php echo getImageTheme('ico-set-account.png')?>"></div>
                            <div class="title"><?php echo $this->lang('setting_account_title')?></div>
                            <div class="clear"></div>
                        </div>
                    
                        <div class="box-white-body">
                        

                            <div class="areablock space-in-setting">
                            
                                <div class="subtitle"><?php echo $this->lang('setting_account_block_email_title')?></div>

                                <form id="form1" name="form1" method="post" action="">
                                <div class="form-block">
                                    <label for="email"><?php echo $this->lang('setting_account_block_email_email')?>:</label>
                                    <input name="email" type="text" id="email" placeholder="<?php echo $this->lang('setting_account_block_email_email')?>" class="form-control" value="<?php echo $D->email?>"/>
                                </div>
                                
                                <div id="msgerror1" class="alert alert-red hide"></div>
                                <div id="msgok1" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave1" id="bsave1" value="<?php echo $this->lang('setting_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>
                                
                                </form>
                            
                            </div>


                            <div class="areablock space-in-setting">
                            
                                <div class="subtitle"><?php echo $this->lang('setting_account_block_username_title')?></div>

                                <form id="form2" name="form2" method="post" action="">
                                <div class="form-block">
                                    <label for="username"><?php echo $this->lang('setting_account_block_username_username')?>:</label>
                                    <input name="username" type="text" id="username" placeholder="<?php echo $this->lang('setting_account_block_username_username')?>" class="form-control" value="<?php echo $D->username?>"/>
                                </div>
                                
                                <div id="msgerror2" class="alert alert-red hide"></div>
                                <div id="msgok2" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave2" id="bsave2" value="<?php echo $this->lang('setting_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>
                                
                                </form>
                            
                            </div>
                        

                            <div class="areablock space-in-setting">
                            
                                <div class="subtitle"><?php echo $this->lang('setting_account_block_password_title')?></div>

                                <form id="form3" name="form3" method="post" action="">
                                <div class="form-block">
                                    <label for="pcurrent"><?php echo $this->lang('setting_account_block_password_currentpass')?>:</label>
                                    <input name="pcurrent" type="password" id="pcurrent" class="form-control"/>
                                </div>
                                <div class="form-block">
                                    <label for="pnew"><?php echo $this->lang('setting_account_block_password_newpass')?>:</label>
                                    <input name="pnew" type="password" id="pnew" class="form-control"/>
                                </div>
                                <div class="form-block">
                                    <label for="pnew2"><?php echo $this->lang('setting_account_block_password_newpass2')?>:</label>
                                    <input name="pnew2" type="password" id="pnew2" class="form-control"/>
                                </div>
                                
                                <div id="msgerror3" class="alert alert-red hide"></div>
                                <div id="msgok3" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave3" id="bsave3" value="<?php echo $this->lang('setting_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>
                                
                                </form>
                            
                            </div>
                            
                            
                            
                            <div class="areablock space-in-setting">
                            
                                <div class="subtitle"><?php echo $this->lang('setting_account_block_langtimezone_title')?></div>

                                <form id="form4" name="form4" method="post" action="">

                                <div class="form-block">
                                    <label for="timezone"><?php echo $this->lang('setting_account_block_langtimezone_language')?></label>
                                    <select name="timezone" id="timezone" class="form-control">
                                        <?php foreach($D->menu_timezones as $k=>$v) { ?>
                                        <option value="<?php echo $k ?>" <?php echo($k == $D->the_timezone ? 'selected="selected"' : ''); ?>><?php echo htmlspecialchars($v); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                                <div class="form-block">
                                    <label for="language"><?php echo $this->lang('setting_account_block_langtimezone_tomezone')?></label>
                                    <select name="language" id="language" class="form-control">
                                        <?php foreach($D->list_languages as $k=>$v) { ?>
                                        <option value="<?php echo $k ?>" <?php echo($k == $D->lang_default ? 'selected="selected"' : ''); ?>><?php echo htmlspecialchars($v); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                                <div id="msgerror4" class="alert alert-red hide"></div>
                                <div id="msgok4" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave4" id="bsave4" value="<?php echo $this->lang('setting_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>
                                
                                </form>
                            
                            </div>
                            

                        
                        </div>

                    </div>     

                </div>
                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>

<script>

    var _menu_resp_settings = stripslashes('<?php echo strJS(cutLineJump($D->setting_menu_title))?>') + stripslashes('<?php echo strJS(cutLineJump($D->setting_menu_left))?>') + '<div class="mrg10B"></div>';
                
    var txt_error_username = stripslashes('<?php echo strJS($this->lang('setting_account_block_username_error_username'))?>');
    var txt_error_notvalid = stripslashes('<?php echo strJS($this->lang('setting_account_block_username_error_notvalid'))?>');

    var txt_error_email = stripslashes('<?php echo strJS($this->lang('setting_account_block_email_error_email'))?>');
    
    var txt_error_pcurrent = stripslashes('<?php echo strJS($this->lang('setting_account_block_password_error_current'))?>');
    var txt_error_pnew = stripslashes('<?php echo strJS($this->lang('setting_account_block_password_error_new'))?>');
    var txt_error_pnew2 = stripslashes('<?php echo strJS($this->lang('setting_account_block_password_error_new2'))?>');
    var txt_error_pnomatch = stripslashes('<?php echo strJS($this->lang('setting_account_block_password_error_notmatch'))?>');
    
    $('#bsave1').click(function(e){
        e.preventDefault();
        updateEmail('#msgerror1', '#msgok1', '#bsave1');
    });

    $('#bsave2').click(function(e){
        e.preventDefault();
        updateUsername('#msgerror2', '#msgok2', '#bsave2');
    });

    $('#bsave3').click(function(e){
        e.preventDefault();
        updatePassword('#msgerror3', '#msgok3', '#bsave3');
    });
    
    var txt_error_choose_lt = stripslashes('<?php echo strJS($this->lang('setting_account_block_langtimezone_error_msg'))?>');
    $('#bsave4').click(function(e){
        e.preventDefault();
        updateLangTime('#msgerror4', '#msgok4', '#bsave4');
    });

    markMenuLeft('settings');
    makeMenuResp('settings')
</script>