        <div id="dashboard-main-area">
            <div id="dashboard-main-area-left">
                <div id="setting-left-area">

                    <div id="menuleft-setting">
                        <?php echo $D->setting_menu_title?>
                        <?php echo $D->setting_menu_left?>
                        <div class="mrg10B"></div>
                    </div>

                </div>
            </div>
            <div id="dashboard-main-area-right">
            
                <?php $this->load_template('min/settings-profile.php'); ?>

            </div>
            <div class="clear"></div>
        </div>