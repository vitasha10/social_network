        <?php if(isset($D->js_script_max)) echo $D->js_script_max;?>
        <div id="<?php echo $D->id_container?>-main-area">
            <div id="profile-main">
                <div id="profile-main-area-left">
                
                    <div id="profile-top-area">

                        <?php $this->load_template('max/_page-header.php'); ?>

                    </div>

                    <?php $this->load_template('min/page-settings.php'); ?>
                
                </div>        

                <div id="profile-main-area-right">

                    <?php $this->load_template('_profile-right.php'); ?>

                </div>
                
                <div class="clear"></div>
            </div>

        </div>
