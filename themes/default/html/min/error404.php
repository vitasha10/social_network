                   <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                    <div id="error404" class="centered">

                        <div style="margin-top:100px; font-weight:bold; font-size:24px;"><?php echo $D->msg01?></div>

                        <div style="margin-top:20px; font-size:14px; font-weight:bold;"><?php echo $D->msg02?></div>

                        <div style="margin-top:80px; margin-bottom:100px;"><img src="<?php echo getImageTheme('link-break.png')?>"></div>

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

                <?php $this->load_template('_foot-out.php'); ?>
