               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                <div id="admin-main-area">

                    <div class="box-white mrg30B">

                        <div class="box-white-header">
                            <div class="ico"><img src="<?php echo getImageTheme('ico-admin-users.png')?>"></div>
                            <div class="title"><?php echo $D->the_name_user?></div>
                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <?php if ($D->me->is_admin && ($D->leveladmin <= $D->me->leveladmin)) { ?>

                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_users_edit_block_general_title')?></div>

                                <?php if (($D->leveladmin < $D->me->leveladmin || $D->iduser == $D->me->iduser) || (!$D->isadministrador)) { ?>

                                <form id="form1" name="form1" method="post" action="">
                                <div class="form-block">
                                    <label for="verify"><?php echo $this->lang('admin_users_edit_block_general_verify')?></label>
                                    <select name="verify" id="verify" class="form-control">
                                        <option value="0" <?php echo($D->verified == 0 ?'selected="selected"' : '');?>><?php echo $this->lang('admin_users_edit_block_general_verify_no')?></option>
                                        <option value="1" <?php echo($D->verified == 1 ? 'selected="selected"' : '');?>><?php echo $this->lang('admin_users_edit_block_general_verify_yes')?></option>
                                    </select>
                                </div>

                                <?php } else { ?>

                                <input type="hidden" name="verify" id="verify" value="<?php echo $D->verified?>">

                                <?php } ?>

                                <?php if ($D->leveladmin < $D->me->leveladmin && $D->iduser != $D->me->iduser) { ?>

                                <div class="form-block">
                                    <label for="status"><?php echo $this->lang('admin_users_edit_block_general_status')?></label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="0" <?php echo($D->active == 0 ?'selected="selected"' : '');?>><?php echo $this->lang('admin_users_edit_block_general_status_inactive')?></option>
                                        <option value="1" <?php echo($D->active == 1 ? 'selected="selected"' : '');?>><?php echo $this->lang('admin_users_edit_block_general_status_active')?></option>
                                    </select>
                                </div>

                                <?php } else { ?>

                                <input type="hidden" name="status" id="status" value="<?php echo $D->active?>">

                                <?php } ?>

                                <?php if ($D->me->leveladmin > 1 && $D->iduser != $D->me->iduser) { ?>

                                <div class="form-block">
                                    <label for="level"><?php echo $this->lang('admin_users_edit_block_general_level')?></label>
                                    <select name="level" id="level" class="form-control">
                                        <option value="0" <?php echo($D->isadministrador == 0 ?'selected="selected"' : '');?>><?php echo $this->lang('admin_users_edit_block_general_level_notadmin')?></option>
                                        <option value="1" <?php echo($D->isadministrador == 1 ? 'selected="selected"' : '');?>><?php echo $this->lang('admin_users_edit_block_general_level_isadmin')?></option>
                                    </select>
                                </div>

                                <?php } else { ?>

                                <input type="hidden" name="level" id="level" value="<?php echo $D->isadministrador?>">

                                <?php } ?>

                                <div id="msgerror1" class="alert alert-red hide"></div>
                                <div id="msgok1" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave1" id="bsave1" value="<?php echo $this->lang('admin_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>

                                </form>

                            </div>

                            <?php } ?>

                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_users_edit_block_profile_title')?></div>

                                <form id="form2" name="form2" method="post" action="">
                                <div class="form-block">
                                    <label for="firstname"><?php echo $this->lang('admin_users_edit_block_profile_firstname')?></label>
                                    <input name="firstname" type="text" id="firstname" placeholder="<?php echo $this->lang('admin_users_edit_block_profile_firstname')?>" class="form-control" value="<?php echo $D->firstname?>"/>
                                </div>

                                <div class="form-block">
                                    <label for="lastname"><?php echo $this->lang('admin_users_edit_block_profile_lastname')?></label>
                                    <input name="lastname" type="text" id="lastname" placeholder="<?php echo $this->lang('admin_users_edit_block_profile_lastname')?>" class="form-control" value="<?php echo $D->lastname?>"/>
                                </div>

                                <div class="form-block">
                                    <label for="gender"><?php echo $this->lang('admin_users_edit_block_profile_gender')?></label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="0" <?php echo($D->gender==0?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_profile_selectsex')?>:</option>
                                        <option value="1" <?php echo($D->gender==1?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_profile_male')?></option>
                                        <option value="2" <?php echo($D->gender==2?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_profile_female')?></option>
                                    </select>
                                </div>

                                <div class="form-block">
                                    <label for="day"><?php echo $this->lang('admin_users_edit_block_profile_birthday')?></label>
                                    <div class="clear"></div>

                                    <select name="day" id="day" class="form-control p33">
                                        <option value="0" <?php echo $D->born[2] == 0 ? 'selected="selected"' : '' ?>><?php echo $this->lang('admin_users_edit_block_profile_day')?>:</option>
                                        <?php for ($x=1; $x<=31; $x++) { ?>
                                        <option value="<?php echo $x?>" <?php echo ($D->born[2] == $x && $D->born[2] != 0)?'selected="selected"' : '' ?>><?php echo $x?></option>
                                        <?php } ?>          
                                    </select>

                                    <select name="month" id="month" class="form-control p33">

                                        <option value="0" <?php echo ($D->born[1]==0 ? 'selected="selected"':'')?>><?php echo $this->lang('admin_users_edit_block_profile_month')?>:</option>
                                        <option value="1" <?php echo ($D->born[1]==1 && $D->born[1]!=0)?'selected="selected"':'' ?>><?php echo $this->lang('admin_users_edit_block_profile_month_jan')?></option>
                                        <option value="2" <?php echo ($D->born[1]==2 && $D->born[1]!=0)?'selected="selected"':'' ?>><?php echo $this->lang('admin_users_edit_block_profile_month_feb')?></option>
                                        <option value="3" <?php echo ($D->born[1]==3 && $D->born[1]!=0)?'selected="selected"':'' ?>><?php echo $this->lang('admin_users_edit_block_profile_month_mar')?></option>
                                        <option value="4" <?php echo ($D->born[1]==4 && $D->born[1]!=0)?'selected="selected"':'' ?>><?php echo $this->lang('admin_users_edit_block_profile_month_apr')?></option>
                                        <option value="5" <?php echo ($D->born[1]==5 && $D->born[1]!=0)?'selected="selected"':'' ?>><?php echo $this->lang('admin_users_edit_block_profile_month_may')?></option>
                                        <option value="6" <?php echo ($D->born[1]==6 && $D->born[1]!=0)?'selected="selected"':'' ?>><?php echo $this->lang('admin_users_edit_block_profile_month_jun')?></option>
                                        <option value="7" <?php echo ($D->born[1]==7 && $D->born[1]!=0)?'selected="selected"':'' ?>><?php echo $this->lang('admin_users_edit_block_profile_month_jul')?></option>
                                        <option value="8" <?php echo ($D->born[1]==8 && $D->born[1]!=0)?'selected="selected"':'' ?>><?php echo $this->lang('admin_users_edit_block_profile_month_aug')?></option>
                                        <option value="9" <?php echo ($D->born[1]==9 && $D->born[1]!=0)?'selected="selected"':'' ?>><?php echo $this->lang('admin_users_edit_block_profile_month_sep')?></option>
                                        <option value="10" <?php echo ($D->born[1]==10 && $D->born[1]!=0)?'selected="selected"':'' ?>><?php echo $this->lang('admin_users_edit_block_profile_month_oct')?></option>
                                        <option value="11" <?php echo ($D->born[1]==11 && $D->born[1]!=0)?'selected="selected"':'' ?>><?php echo $this->lang('admin_users_edit_block_profile_month_nov')?></option>
                                        <option value="12" <?php echo ($D->born[1]==12 && $D->born[1]!=0)?'selected="selected"':'' ?>><?php echo $this->lang('admin_users_edit_block_profile_month_dic')?></option>

                                    </select>

                                    <select name="year" id="year" class="form-control p33">

                                        <option value="0" <?php echo $D->born[0] == 0 ? 'selected="selected"' : '' ?>><?php echo $this->lang('admin_users_edit_block_profile_year')?>:</option>

                                        <?php for ($x = date("Y"); $x >= (date("Y")-106); $x--) { ?>

                                        <option value="<?php echo $x?>" <?php echo ($D->born[0] == $x && $D->born[0] != 0) ? 'selected="selected"' : '' ?>><?php echo $x?></option>

                                        <?php } ?>                

                                    </select>

                                    <div class="clear"></div>

                                </div>

                                <div class="form-block">
                                    <label for="currentcity"><?php echo $this->lang('admin_users_edit_block_profile_currentcity')?></label>
                                    <input name="currentcity" type="text" id="currentcity" placeholder="<?php echo $this->lang('admin_users_edit_block_profile_currentcity')?>" class="form-control" value="<?php echo $D->currentcity?>"/>
                                </div>

                                <div class="form-block">
                                    <label for="hometown"><?php echo $this->lang('admin_users_edit_block_profile_hometown')?></label>
                                    <input name="hometown" type="text" id="hometown" placeholder="<?php echo $this->lang('admin_users_edit_block_profile_hometown')?>" class="form-control" value="<?php echo $D->hometown?>"/>
                                </div>

                                <div id="msgerror2" class="alert alert-red hide"></div>
                                <div id="msgok2" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave2" id="bsave2" value="<?php echo $this->lang('admin_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>

                                </form>

                            </div>

                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_users_edit_block_email_title')?></div>

                                <form id="form3" name="form3" method="post" action="">
                                <div class="form-block">
                                    <label for="email"><?php echo $this->lang('admin_users_edit_block_email_email')?></label>
                                    <input name="email" type="text" id="email" placeholder="<?php echo $this->lang('admin_users_edit_block_email_email')?>" class="form-control" value="<?php echo $D->email?>"/>
                                </div>

                                <div id="msgerror3" class="alert alert-red hide"></div>
                                <div id="msgok3" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave3" id="bsave3" value="<?php echo $this->lang('admin_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>

                                </form>

                            </div>

                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_users_edit_block_username_title')?></div>

                                <form id="form4" name="form4" method="post" action="">
                                <div class="form-block">
                                    <label for="username"><?php echo $this->lang('admin_users_edit_block_username_username')?></label>
                                    <input name="username" type="text" id="username" placeholder="<?php echo $this->lang('admin_users_edit_block_username_username')?>" class="form-control" value="<?php echo $D->username?>"/>
                                </div>

                                <div id="msgerror4" class="alert alert-red hide"></div>
                                <div id="msgok4" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave4" id="bsave4" value="<?php echo $this->lang('admin_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>

                                </form>

                            </div>

                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_users_edit_block_password_title')?></div>

                                <form id="form5" name="form5" method="post" action="">
                                <div class="form-block">
                                    <label for="password"><?php echo $this->lang('admin_users_edit_block_password_newpass')?></label>
                                    <input name="password" type="password" id="password" placeholder="<?php echo $this->lang('admin_users_edit_block_password_newpass')?>" class="form-control"/>
                                </div>

                                <div id="msgerror5" class="alert alert-red hide"></div>
                                <div id="msgok5" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave5" id="bsave5" value="<?php echo $this->lang('admin_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>

                                </form>

                            </div>

                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_users_edit_block_privacy_title')?></div>

                                <form id="form6" name="form6" method="post" action="">

                                <div class="form-block">
                                    <label for="pprofile"><?php echo $this->lang('admin_users_edit_block_privacy_txtprofile')?></label>
                                    <select name="pprofile" id="pprofile" class="form-control">
                                        <option value="0" <?php echo($D->privacy==0?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txtpublic')?></option>
                                        <option value="1" <?php echo($D->privacy==1?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txtonlyfriends')?></option>
                                        <option value="2" <?php echo($D->privacy==2?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txtprivate')?></option>
                                    </select>
                                </div>

                                <div class="form-block">
                                    <label for="pwritewall"><?php echo $this->lang('admin_users_edit_block_privacy_txt_wall')?></label>
                                    <select name="pwritewall" id="pwritewall" class="form-control">
                                        <option value="0" <?php echo($D->who_write_on_my_wall==0?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txt_any')?></option>
                                        <option value="1" <?php echo($D->who_write_on_my_wall==1?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txt_friends')?></option>
                                        <option value="2" <?php echo($D->who_write_on_my_wall==2?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txt_onlyme')?></option>
                                    </select>
                                </div>

                                <div class="form-block">
                                    <label for="pseefriends"><?php echo $this->lang('admin_users_edit_block_privacy_txt_seefriends')?></label>
                                    <select name="pseefriends" id="pseefriends" class="form-control">
                                        <option value="0" <?php echo($D->who_can_see_friends==0?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txt_any')?></option>
                                        <option value="1" <?php echo($D->who_can_see_friends==1?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txt_friends')?></option>
                                        <option value="2" <?php echo($D->who_can_see_friends==2?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txt_onlyme')?></option>
                                    </select>
                                </div>

                                <div class="form-block">
                                    <label for="pseepages"><?php echo $this->lang('admin_users_edit_block_privacy_txt_seepages')?></label>
                                    <select name="pseepages" id="pseepages" class="form-control">
                                        <option value="0" <?php echo($D->who_can_see_liked_pages==0?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txt_any')?></option>
                                        <option value="1" <?php echo($D->who_can_see_liked_pages==1?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txt_friends')?></option>
                                        <option value="2" <?php echo($D->who_can_see_liked_pages==2?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txt_onlyme')?></option>
                                    </select>

                                </div>

                                <div class="form-block">
                                    <label for="pseegroups"><?php echo $this->lang('admin_users_edit_block_privacy_txt_seegroups')?></label>
                                    <select name="pseegroups" id="pseegroups" class="form-control">
                                        <option value="0" <?php echo($D->who_can_see_joined_groups==0?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txt_any')?></option>
                                        <option value="1" <?php echo($D->who_can_see_joined_groups==1?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txt_friends')?></option>
                                        <option value="2" <?php echo($D->who_can_see_joined_groups==2?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txt_onlyme')?></option>
                                    </select>
                                </div>

                                <div class="form-block">
                                    <label for="pmessages"><?php echo $this->lang('admin_users_edit_block_privacy_txt_sendmessage')?></label>
                                    <select name="pmessages" id="pmessages" class="form-control">
                                        <option value="0" <?php echo($D->who_can_sendme_messages==0?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txt_any')?></option>
                                        <option value="1" <?php echo($D->who_can_sendme_messages==1?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txt_friends')?></option>
                                        <option value="2" <?php echo($D->who_can_sendme_messages==2?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txt_nobody')?></option>
                                    </select>
                                </div>

                                <div class="form-block">
                                    <label for="pbirthday"><?php echo $this->lang('admin_users_edit_block_privacy_txtbirthday')?></label>
                                    <select name="pbirthday" id="pbirthday" class="form-control">
                                        <option value="0" <?php echo($D->who_can_see_birthdate==0?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txt_any')?></option>
                                        <option value="1" <?php echo($D->who_can_see_birthdate==1?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txt_friends')?></option>
                                        <option value="2" <?php echo($D->who_can_see_birthdate==2?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txt_onlyme')?></option>
                                    </select>
                                </div>

                                <div class="form-block">
                                    <label for="plocation"><?php echo $this->lang('admin_users_edit_block_privacy_txtlocation')?></label>
                                    <select name="plocation" id="plocation" class="form-control">
                                        <option value="0" <?php echo($D->who_can_see_location==0?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txt_any')?></option>
                                        <option value="1" <?php echo($D->who_can_see_location==1?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txt_friends')?></option>
                                        <option value="2" <?php echo($D->who_can_see_location==2?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txt_onlyme')?></option>
                                    </select>
                                </div>

                                <div class="form-block">
                                    <label for="paboutme"><?php echo $this->lang('admin_users_edit_block_privacy_txtaboutme')?></label>
                                    <select name="paboutme" id="paboutme" class="form-control">
                                        <option value="0" <?php echo($D->who_can_see_about_me==0?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txt_any')?></option>
                                        <option value="1" <?php echo($D->who_can_see_about_me==1?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txt_friends')?></option>
                                        <option value="2" <?php echo($D->who_can_see_about_me==2?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txt_onlyme')?></option>
                                    </select>
                                </div>

                                <div class="form-block">
                                    <label for="pchat"><?php echo $this->lang('admin_users_edit_block_privacy_chatstatus')?></label>
                                    <select name="pchat" id="pchat" class="form-control">
                                        <option value="0" <?php echo($D->chat==0?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txtoffline')?></option>
                                        <option value="1" <?php echo($D->chat==1?'selected="selected"':'');?>><?php echo $this->lang('admin_users_edit_block_privacy_txtonline')?></option>
                                    </select>
                                </div>

                                <div id="msgerror6" class="alert alert-red hide"></div>
                                <div id="msgok6" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave6" id="bsave6" value="<?php echo $this->lang('admin_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>

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

    var idu = <?php echo $D->iduser?>;

    var txt_error_option = stripslashes('<?php echo strJS($this->lang('admin_txt_must_choose_option'))?>');
    var txt_error_firstname = stripslashes('<?php echo strJS($this->lang('admin_users_edit_block_profile_error_firstname'))?>');
    var txt_error_lastname = stripslashes('<?php echo strJS($this->lang('admin_users_edit_block_profile_error_lastname'))?>');
    var txt_error_sex = stripslashes('<?php echo strJS($this->lang('admin_users_edit_block_profile_error_sex'))?>');
    var txt_error_birthday = stripslashes('<?php echo strJS($this->lang('admin_users_edit_block_profile_error_birthday'))?>');
    var txt_error_birthday2 = stripslashes('<?php echo strJS($this->lang('admin_users_edit_block_profile_error_birthday2'))?>');

    var txt_error_currentcity = stripslashes('<?php echo strJS($this->lang('admin_users_edit_block_profile_error_currentcity'))?>');
    var txt_error_hometown = stripslashes('<?php echo strJS($this->lang('admin_users_edit_block_profile_error_hometown'))?>');

    var txt_error_email = stripslashes('<?php echo strJS($this->lang('admin_users_edit_block_email_error_email'))?>');

    var txt_error_username = stripslashes('<?php echo strJS($this->lang('admin_users_edit_block_username_error_username'))?>');
    var txt_error_notvalid = stripslashes('<?php echo strJS($this->lang('admin_users_edit_block_username_error_notvalid'))?>');

    var txt_error_pnew = stripslashes('<?php echo strJS($this->lang('admin_users_edit_block_password_error_new'))?>');

    $('#bsave1').click(function(e){
        e.preventDefault();
        updateUserGeneral('#msgerror1', '#msgok1', '#bsave1');
    });

    $('#bsave2').click(function(e){
        e.preventDefault();
        updateUserProfile('#msgerror2', '#msgok2', '#bsave2');
    });

    $('#bsave3').click(function(e){
        e.preventDefault();
        updateUserEmail('#msgerror3', '#msgok3', '#bsave3');
    });

    $('#bsave4').click(function(e){
        e.preventDefault();
        updateUserUsername('#msgerror4', '#msgok4', '#bsave4');
    });

    $('#bsave5').click(function(e){
        e.preventDefault();
        updateUserPassword('#msgerror5', '#msgok5', '#bsave5');
    });

    $('#bsave6').click(function(e){
        e.preventDefault();
        updateUserPrivacy('#msgerror6', '#msgok6', '#bsave6');
    });

    markMenuLeft('admin');
    makeMenuResp('admin');
    
</script>