<?php $this->load_template('_header.php'); ?>

<div id="generic-top-area">
    <?php $this->load_template('_top.php'); ?>
</div>

    <div id="area-resetpass" style="margin-bottom:120px;">
        <div id="titleform"><?php echo $this->lang('login_reset_title')?></div>

        <div id="area-form">
            <form id="formreset" name="formreset" method="post">
            <div class="nameitem"><?php echo $this->lang('login_reset_username')?></div>
            <div><input type="text" class="boxinput" name="email" id="email" placeholder="<?php echo $this->lang('login_reset_username')?>"></div>
            <div id="alert-email" class="alert alert-red hide"></div>

            <div id="alert-error-form" class="alert alert-red hide"></div>
            <div id="areabutton"><button class="btn" name="go_reset" id="go_reset" type="submit"><?php echo $this->lang('login_reset_bsubmit')?></button></div>

            </form> 

        </div>

        <div id="divok" class="hide"></div>

    </div>

    <script>
        var error_email = stripslashes('<?php echo strJS($this->lang('login_reset_error_email'))?>');
        $('#go_reset').click(function(){ 
            resetpass('#area-form', '#divok', '#alert-error-form', '#go_reset');
            return false;
        })
    </script>

<div id="generic-foot-area">
<?php $this->load_template('_foot-out.php'); ?>
</div>

<?php $this->load_template('_footer.php'); ?>