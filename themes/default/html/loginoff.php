<?php $this->load_template('_header-off.php'); ?>

<style>
#area-form{ width:250px; margin:0 auto; margin-top:50px; }
.boxinput{ border:1px solid #B1B1B1; padding:6px 6px; color:#656B7A; outline: none; font-size:13px; resize:none; width:100%; margin-bottom:10px; }
.nameitem{ margin-bottom:5px; }
#area-form #areabutton{ margin-top:10px; }
#area-form #areabutton .btn{ display: inline-block; margin-bottom: 0; text-align: center; white-space: nowrap; vertical-align: middle; cursor: pointer; background: repeat-x #f4f4f4; background-image: linear-gradient(to bottom,#f4f4f4 0,#eaeaea 100%); border-radius:3px; color: #555 !important; padding: 2px 15px 3px; font-size:14px; line-height:22px; border: 1px solid #ccc; }
</style>

        <div id="area-form">
            <form id="formlogin" name="formlogin" method="post">

            <div class="nameitem"><?php echo $this->lang('off_login_username')?></div>
            <div><input type="text" class="boxinput" name="username" id="username" placeholder="<?php echo $this->lang('off_login_username')?>"></div>
            <div class="nameitem"><?php echo $this->lang('off_login_password')?></div>
            <div><input type="password" class="boxinput" name="password" id="password" placeholder="<?php echo $this->lang('off_login_password')?>"></div>

            <div id="areabutton"><button class="btn" name="go_login" id="go_login" type="submit"><?php echo $this->lang('off_login_blogin')?></button></div>
            <input id="login" name="login" type="hidden" value="ok">

            </form> 

        </div>

<?php $this->load_template('_footer-off.php'); ?>