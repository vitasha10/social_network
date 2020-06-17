        <?php if(isset($D->js_script_max)) echo $D->js_script_max;?>
        <div id="dashboard-main-area">
            <div id="dashboard-main-area-left">
                <div id="menuleft">
                    <?php echo $D->mini_card_user?>
                    <?php echo $D->dashboard_menu_left?>
                    <div class="mrg10B"></div>
                </div>
            </div>

            <div id="dashboard-main-area-right">
            
                <?php $this->load_template('min/groups-feed.php'); ?>
            

            </div>
            <div class="clear"></div>
        </div>
