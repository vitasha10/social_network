<?php $this->load_template('_header.php'); ?>

<div id="generic-top-area">
    <?php $this->load_template('_top.php'); ?>
</div>

<div id="generic-main-area">

    <div id="area-login">
        <div id="titleform"><?php echo $this->lang('login_title', array('#SITE_TITLE#'=>$K->SITE_TITLE))?></div>

        <div id="area-form">
            <form id="formlogin" name="formlogin" method="post">
            <div class="nameitem"><?php echo $this->lang('login_username_or_email')?></div>
            <div><input type="text" class="boxinput" name="username" id="username" placeholder="<?php echo $this->lang('login_username_or_email')?>"></div>
            <div id="alert-username" class="alert alert-red hide"></div>
            <div class="nameitem"><?php echo $this->lang('login_password')?></div>
            <div><input type="password" class="boxinput" name="password" id="password" placeholder="<?php echo $this->lang('login_password')?>"></div>
            <div id="alert-password" class="alert alert-red hide"></div>

            <div id="alert-error-form" class="alert alert-red hide"></div>
            <div id="areabutton"><button class="btn" name="go_login" id="go_login" type="submit"><?php echo $this->lang('login_bsubmit')?></button></div>

            <?php if ($K->LOGIN_WITH_REMEMBER) { ?>
            <div id="arearemember"><input type="checkbox" name="rememberme" id="rememberme"><span style="padding:5px; padding-left:5px;"><?php echo $this->lang('login_txt_rememberme')?></span></div>
            <?php } ?>
            </form> 

            <div id="link-forgot" class="link link-blue"><a href="<?php echo $K->SITE_URL?>login/resetpass"><?php echo $this->lang('login_forgot_password')?></a></div>

        </div>

    </div>

    <script>

        var error_username = stripslashes('<?php echo strJS($this->lang('login_error_username'))?>');
        var error_password = stripslashes('<?php echo strJS($this->lang('login_error_password'))?>');
        var with_rememberme = <?php echo $K->LOGIN_WITH_REMEMBER?'1':'0'; ?>;

        $('#go_login').click(function(){ 
            login('#alert-error-form', '#go_login');
            return false;
        })

    </script>

</div>

<div id="generic-foot-area">
<?php $this->load_template('_foot-out.php'); ?>
</div>

<?php $this->load_template('_footer.php'); ?>