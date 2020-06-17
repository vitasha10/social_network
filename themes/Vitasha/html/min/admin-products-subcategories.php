               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                <div id="admin-main-area">

                    <div class="box-white mrg30B">

                        <div class="box-white-header">
                            <div class="ico"><img src="<?php echo getImageTheme('ico-admin-cat-products.png')?>"></div>
                            <div class="title"><?php echo $this->lang('admin_products_subcategories_title')?></div>
                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <div style="margin-top:-5px; margin-bottom:5px;"><span class="link-blue">&laquo;</span> <span class="link link-blue"><a href="<?php echo $K->SITE_URL?>admin/products/categories" rel="phantom" target="dashboard-main-area-right"><?php echo $this->lang('admin_products_subcategories_back_categories')?></a></span></div>

                            <div class="spacetitle centered mrg20B"><?php echo $D->name_category?></div>

                            <?php if (isset($D->html_items) && empty($D->html_items)) { ?>

                            <p class="mrg20T centered grey"><?php echo $this->lang('admin_products_subcategories_no_subcategories')?></p>
                            <div class="centered mrg20T mrg20B"><a href="<?php echo $K->SITE_URL?>admin/products/subcategories/add/c:<?php echo $D->idcat?>" rel="phantom" target="dashboard-main-area-right"><span class="my-btn my-btn-small"><?php echo $this->lang('admin_products_subcategories_badd')?></span></a></div>

                            <?php } else { ?>

                            <div class="centered"><a href="<?php echo $K->SITE_URL?>admin/products/subcategories/add/c:<?php echo $D->idcat?>" rel="phantom" target="dashboard-main-area-right"><span class="my-btn my-btn-small"><?php echo $this->lang('admin_products_subcategories_badd')?></span></a></div>

                            <div class="list_items">

                            <?php echo $D->html_items?>

                            </div>

                            <?php } ?>

                        </div>

                    </div>     

                </div>

                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>

<script>

    var _menu_resp_admin = stripslashes('<?php echo strJS(cutLineJump($D->admin_menu_title))?>') + stripslashes('<?php echo strJS(cutLineJump($D->admin_menu_responsive))?>') + '<div class="mrg10B"></div>';

    var text_error_name_subcategory = stripslashes('<?php echo strJS($this->lang('admin_products_subcategories_add_error_name'))?>');

    var msg_delete_subcategory_product = stripslashes('<?php echo $this->designer->boxConfirm($this->lang('admin_products_subcategories_title_delete'), $this->lang('admin_products_subcategories_msg_delete'), $this->lang('admin_alert_text_confirm'), $this->lang('admin_alert_text_cancel'))?>');


    markMenuLeft('admin');
    makeMenuResp('admin');

</script>
