                   <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                    <div id="info-content-area">

                        <div id="info-content-header"><?php echo $D->static_title?></div>

                        <div id="info-content-info"><?php echo $D->static_texthtml?></div>

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
