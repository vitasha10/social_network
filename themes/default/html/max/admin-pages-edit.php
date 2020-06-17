        <div id="dashboard-main-area">
            <div id="dashboard-main-area-left">
                <div id="admin-left-area">

                    <div id="menuleft-admin">
                        <?php echo $D->admin_menu_title; ?>
                        <?php echo $D->admin_menu_left; ?>
                        <div class="mrg10B"></div>
                    </div>

                </div>
            </div>
            <div id="dashboard-main-area-right">

                <?php $this->load_template('min/admin-pages-edit.php'); ?>

            </div>
            <div class="clear"></div>
        </div>