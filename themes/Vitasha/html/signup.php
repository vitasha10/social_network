<?php $this->load_template('_header.php'); ?>

<div id="generic-top-area">
    <?php $this->load_template('_top.php'); ?>
</div>

<div id="generic-main-area">

    <div id="area-register">
        <div id="titleform"><?php echo $this->lang('signup_title')?></div>
        <div id="msgfree"><?php echo $this->lang('signup_msgfree')?></div>
        <div id="area-form">
            <form id="formregister" name="formregister" method="post">
            <div><?php echo $this->lang('signup_firstname')?></div>
            <div><input type="text" class="boxinput" name="firstname" id="firstname" placeholder="<?php echo $this->lang('signup_firstname')?>"></div>
            <div id="alert-firstname" class="alert alert-red hide"></div>
            <div class="nameitem"><?php echo $this->lang('signup_lastname')?></div>
            <div><input type="text" class="boxinput" name="lastname" id="lastname" placeholder="<?php echo $this->lang('signup_lastname')?>"></div>
            <div id="alert-lastname" class="alert alert-red hide"></div>
            <div class="nameitem"><?php echo $this->lang('signup_email')?></div>
            <div><input type="text" class="boxinput" name="email" id="email" placeholder="<?php echo $this->lang('signup_email')?>"></div>
            <div id="alert-email" class="alert alert-red hide"></div>
            <div class="nameitem"><?php echo $this->lang('signup_username')?></div>
            <div><input type="text" class="boxinput" name="username" id="username" placeholder="<?php echo $this->lang('signup_username')?>"></div>
            <div id="alert-username" class="alert alert-red hide"></div>
            <div class="nameitem"><?php echo $this->lang('signup_password')?></div>
            <div><input type="password" class="boxinput" name="password" id="password" placeholder="<?php echo $this->lang('signup_password')?>"></div>
            <div id="alert-password" class="alert alert-red hide"></div>
            <div>
                <div class="nameitem"><?php echo $this->lang('signup_birthday')?></div>
                <div>
                    <span>
                    <select name="bmonth" id="bmonth" class="boxcombo">
                    <option value="-1"><?php echo $this->lang('signup_birthday_month')?>:</option>
                    <option value="1"><?php echo $this->lang('signup_birthday_jan')?></option>
                    <option value="2"><?php echo $this->lang('signup_birthday_feb')?></option>
                    <option value="3"><?php echo $this->lang('signup_birthday_mar')?></option>
                    <option value="4"><?php echo $this->lang('signup_birthday_apr')?></option>
                    <option value="5"><?php echo $this->lang('signup_birthday_may')?></option>
                    <option value="6"><?php echo $this->lang('signup_birthday_jun')?></option>
                    <option value="7"><?php echo $this->lang('signup_birthday_jul')?></option>
                    <option value="8"><?php echo $this->lang('signup_birthday_aug')?></option>
                    <option value="9"><?php echo $this->lang('signup_birthday_sep')?></option>
                    <option value="10"><?php echo $this->lang('signup_birthday_oct')?></option>
                    <option value="11"><?php echo $this->lang('signup_birthday_nov')?></option>
                    <option value="12"><?php echo $this->lang('signup_birthday_dec')?></option>
                    </select>
                    </span>

                    <span>
                    <select name="bday" id="bday" class="boxcombo">
                    <option value="-1"><?php echo $this->lang('signup_birthday_day')?>:</option>
                    <?php for ($x=1; $x<=31; $x++) { ?>
                    <option value="<?php echo $x?>"><?php echo $x?></option>
                    <?php } ?>          
                    </select>
                    </span>

                    <span>
                    <select name="byear" id="byear" class="boxcombo">
                    <option value="-1"><?php echo $this->lang('signup_birthday_year')?>:</option>
                    <?php for ($x=date("Y"); $x>=(date("Y")-110); $x--) { ?>
                    <option value="<?php echo $x?>"><?php echo $x?></option>
                    <?php } ?>                
                    </select>
                    </span>

                </div>

            </div>

            <div id="alert-birthday" class="alert alert-red hide"></div>

            <div>
                <div class="nameitem"><?php echo $this->lang('signup_gender')?></div>
                <div id="rgender">
                    <span><input name="sex" value="1" id="sex" type="radio"><label><?php echo $this->lang('signup_gender_male')?></label></span>
                    <span class="spaceradio"><input name="sex" value="2" id="sex" type="radio"><label><?php echo $this->lang('signup_gender_female')?></label></span>
                </div>
            </div>

            <div id="alert-gender" class="alert alert-red hide"></div>
            <div id="alert-error-form" class="alert alert-red hide"></div>
            <div id="areabutton"><button class="btn" name="go_register" id="go_register" type="submit"><?php echo $this->lang('signup_bsubmit')?></button></div>
            <input name="valGender" type="hidden" id="valGender" value="">

            </form>    
        </div>

        <div id="divok" class="hide"></div>

    </div>

    <script>
        $("input[name=sex]").click(function () {
            $('#valGender').val($(this).val());
        });

        var error_firstname = stripslashes('<?php echo strJS($this->lang('signup_error_firstname'))?>');
        var error_lastname = stripslashes('<?php echo strJS($this->lang('signup_error_lastname'))?>');
        var error_email = stripslashes('<?php echo strJS($this->lang('signup_error_email'))?>');
        var error_username = stripslashes('<?php echo strJS($this->lang('signup_error_username'))?>');
        var error_password = stripslashes('<?php echo strJS($this->lang('signup_error_password'))?>');
        var error_birthday1 = stripslashes('<?php echo strJS($this->lang('signup_error_age_empty'))?>');
        var error_birthday2 = stripslashes('<?php echo strJS($this->lang('signup_error_age'))?>');
        var error_gender = stripslashes('<?php echo strJS($this->lang('signup_error_gender'))?>');
        $('#go_register').click(function(){ 
            register('#area-form', '#divok', '#alert-error-form', '#go_register');
            return false;
        })
    </script>

</div>

<div id="generic-foot-area">
<?php $this->load_template('_foot-out.php'); ?>
</div>

<?php $this->load_template('_footer.php'); ?>