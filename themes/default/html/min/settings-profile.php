               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>
               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>
                <div id="setting-main-area">

                    <div class="box-white mrg30B">

                        <div class="box-white-header">
                            <div class="ico"><img src="<?php echo getImageTheme('ico-set-profile.png')?>"></div>
                            <div class="title"><?php echo $this->lang('setting_profile_title')?></div>
                            <div class="clear"></div>
                        </div>
                    
                        <div class="box-white-body">
                        

                            <div class="areablock space-in-setting">
                            
                                <div class="subtitle"><?php echo $this->lang('setting_profile_block_personal_title')?></div>

                                <form id="form1" name="form1" method="post" action="">
                                <div class="form-block">
                                    <label for="firstname"><?php echo $this->lang('setting_profile_block_personal_firstname')?>:</label>
                                    <input name="firstname" type="text" id="firstname" placeholder="<?php echo $this->lang('setting_profile_block_personal_firstname')?>" class="form-control" value="<?php echo $D->firstname?>"/>
                                </div>

                                <div class="form-block">
                                    <label for="lastname"><?php echo $this->lang('setting_profile_block_personal_lastname')?>:</label>
                                    <input name="lastname" type="text" id="lastname" placeholder="<?php echo $this->lang('setting_profile_block_personal_lastname')?>" class="form-control" value="<?php echo $D->lastname?>"/>
                                </div>

                                <div class="form-block">
                                    <label for="gender"><?php echo $this->lang('setting_profile_block_personal_iam')?>:</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="0" <?php echo($D->gender==0?'selected="selected"':'');?>><?php echo $this->lang('setting_profile_block_personal_selectsex')?>:</option>
                                        <option value="1" <?php echo($D->gender==1?'selected="selected"':'');?>><?php echo $this->lang('setting_profile_block_personal_male')?></option>
                                        <option value="2" <?php echo($D->gender==2?'selected="selected"':'');?>><?php echo $this->lang('setting_profile_block_personal_female')?></option>
                                    </select>
                                </div>

                                <div class="form-block">
                                    <label for="day"><?php echo $this->lang('setting_profile_block_personal_birthday')?>:</label>
                                    <div class="clear"></div>
                                    
                                    <select name="day" id="day" class="form-control p33">
                                        <option value="0" <?php echo $D->born[2] == 0 ? 'selected="selected"' : '' ?>><?php echo $this->lang('setting_profile_block_personal_day')?>:</option>
                                        <?php for ($x=1; $x<=31; $x++) { ?>
                                        <option value="<?php echo $x?>" <?php echo ($D->born[2] == $x && $D->born[2] != 0)?'selected="selected"' : '' ?>><?php echo $x?></option>
                                        <?php } ?>          
                                    </select>

                                    <select name="month" id="month" class="form-control p33">

                                        <option value="0" <?php echo ($D->born[1]==0 ? 'selected="selected"':'')?>><?php echo $this->lang('setting_profile_block_personal_month')?>:</option>
                                        <option value="1" <?php echo ($D->born[1]==1 && $D->born[1]!=0)?'selected="selected"':'' ?>><?php echo $this->lang('setting_profile_block_personal_month_jan')?></option>
                                        <option value="2" <?php echo ($D->born[1]==2 && $D->born[1]!=0)?'selected="selected"':'' ?>><?php echo $this->lang('setting_profile_block_personal_month_feb')?></option>
                                        <option value="3" <?php echo ($D->born[1]==3 && $D->born[1]!=0)?'selected="selected"':'' ?>><?php echo $this->lang('setting_profile_block_personal_month_mar')?></option>
                                        <option value="4" <?php echo ($D->born[1]==4 && $D->born[1]!=0)?'selected="selected"':'' ?>><?php echo $this->lang('setting_profile_block_personal_month_apr')?></option>
                                        <option value="5" <?php echo ($D->born[1]==5 && $D->born[1]!=0)?'selected="selected"':'' ?>><?php echo $this->lang('setting_profile_block_personal_month_may')?></option>
                                        <option value="6" <?php echo ($D->born[1]==6 && $D->born[1]!=0)?'selected="selected"':'' ?>><?php echo $this->lang('setting_profile_block_personal_month_jun')?></option>
                                        <option value="7" <?php echo ($D->born[1]==7 && $D->born[1]!=0)?'selected="selected"':'' ?>><?php echo $this->lang('setting_profile_block_personal_month_jul')?></option>
                                        <option value="8" <?php echo ($D->born[1]==8 && $D->born[1]!=0)?'selected="selected"':'' ?>><?php echo $this->lang('setting_profile_block_personal_month_aug')?></option>
                                        <option value="9" <?php echo ($D->born[1]==9 && $D->born[1]!=0)?'selected="selected"':'' ?>><?php echo $this->lang('setting_profile_block_personal_month_sep')?></option>
                                        <option value="10" <?php echo ($D->born[1]==10 && $D->born[1]!=0)?'selected="selected"':'' ?>><?php echo $this->lang('setting_profile_block_personal_month_oct')?></option>
                                        <option value="11" <?php echo ($D->born[1]==11 && $D->born[1]!=0)?'selected="selected"':'' ?>><?php echo $this->lang('setting_profile_block_personal_month_nov')?></option>
                                        <option value="12" <?php echo ($D->born[1]==12 && $D->born[1]!=0)?'selected="selected"':'' ?>><?php echo $this->lang('setting_profile_block_personal_month_dic')?></option>

                                    </select>


                                    <select name="year" id="year" class="form-control p33">
                                    
                                        <option value="0" <?php echo $D->born[0] == 0 ? 'selected="selected"' : '' ?>><?php echo $this->lang('setting_profile_block_personal_year')?>:</option>
                                        <?php for ($x = date("Y"); $x >= (date("Y")-106); $x--) { ?>
                                        <option value="<?php echo $x?>" <?php echo ($D->born[0] == $x && $D->born[0] != 0) ? 'selected="selected"' : '' ?>><?php echo $x?></option>
                                        <?php } ?>                

                                    </select>
                                    
                                    <div class="clear"></div>
                                </div>

                                
                                <div id="msgerror1" class="alert alert-red hide"></div>
                                <div id="msgok1" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave1" id="bsave1" value="<?php echo $this->lang('setting_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>
                                
                                </form>
                            
                            </div>

                            <div class="areablock space-in-setting">
                            
                                <div class="subtitle"><?php echo $this->lang('setting_profile_block_aboutme_title')?></div>

                                <form id="form3" name="form3" method="post" action="">
                                <div class="form-block">
                                    <label for="aboutme"><?php echo $this->lang('setting_profile_block_aboutme_aboutme')?>:</label>
                                    <input name="aboutme" type="text" id="aboutme" placeholder="<?php echo $this->lang('setting_profile_block_aboutme_aboutme')?>" class="form-control" value="<?php echo $D->aboutme?>"/>
                                </div>

                                <div id="msgerror3" class="alert alert-red hide"></div>
                                <div id="msgok3" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave3" id="bsave3" value="<?php echo $this->lang('setting_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>
                                
                                </form>
                            
                            </div>

                            <div class="areablock space-in-setting">
                            
                                <div class="subtitle"><?php echo $this->lang('setting_profile_block_location_title')?></div>

                                <form id="form2" name="form2" method="post" action="">
                                <div class="form-block">
                                    <label for="currentcity"><?php echo $this->lang('setting_profile_block_location_current_city')?>:</label>
                                    <input name="currentcity" type="text" id="currentcity" placeholder="<?php echo $this->lang('setting_profile_block_location_current_city')?>" class="form-control" value="<?php echo $D->currentcity?>"/>
                                </div>

                                <div class="form-block">
                                    <label for="hometown"><?php echo $this->lang('setting_profile_block_location_hometown')?>:</label>
                                    <input name="hometown" type="text" id="hometown" placeholder="<?php echo $this->lang('setting_profile_block_location_hometown')?>" class="form-control" value="<?php echo $D->hometown?>"/>
                                </div>
                                
                                <div id="msgerror2" class="alert alert-red hide"></div>
                                <div id="msgok2" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave2" id="bsave2" value="<?php echo $this->lang('setting_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>
                                
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
             
    var txt_error_firstname = stripslashes('<?php echo strJS($this->lang('setting_profile_block_personal_error_firstname'))?>');
    var txt_error_lastname = stripslashes('<?php echo strJS($this->lang('setting_profile_block_personal_error_lastname'))?>');
    var txt_error_sex = stripslashes('<?php echo strJS($this->lang('setting_profile_block_personal_error_sex'))?>');
    var txt_error_birthday = stripslashes('<?php echo strJS($this->lang('setting_profile_block_personal_error_birthday'))?>');
    var txt_error_birthday2 = stripslashes('<?php echo strJS($this->lang('setting_profile_block_personal_error_birthday2'))?>');
    
    var txt_error_currentcity = stripslashes('<?php echo strJS($this->lang('setting_profile_block_location_error_currentcity'))?>');
    var txt_error_hometown = stripslashes('<?php echo strJS($this->lang('setting_profile_block_location_error_hometown'))?>');
    
    var txt_error_aboutme = stripslashes('<?php echo strJS($this->lang('setting_profile_block_aboutme_error_aboutme'))?>');
    
    $('#bsave1').click(function(e){
        e.preventDefault();
        updatePersonal('#msgerror1', '#msgok1', '#bsave1');
    });

    $('#bsave2').click(function(e){
        e.preventDefault();
        updateLocation('#msgerror2', '#msgok2', '#bsave2');
    });

    $('#bsave3').click(function(e){
        e.preventDefault();
        updateAboutMe('#msgerror3', '#msgok3', '#bsave3');
    });
    
    markMenuLeft('settings');
    makeMenuResp('settings');
</script>