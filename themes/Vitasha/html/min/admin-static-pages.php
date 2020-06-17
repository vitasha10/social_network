               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                <div id="admin-main-area">

                    <div class="box-white">

                        <div class="box-white-header">
                            <div class="ico"><img src="<?php echo getImageTheme('ico-admin-static-pages.png')?>"></div>
                            <div class="title"><?php echo $this->lang('admin_static_pages_title')?></div>
                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <?php if ($D->numstatics <= 0) { ?>

                            <p class="mrg20T centered grey"><?php echo $this->lang('admin_static_pages_noitems')?></p>
                            <div class="centered mrg20T mrg20B"><a href="<?php echo $K->SITE_URL?>admin/static-pages/add" rel="phantom" target="dashboard-main-area-right"><span class="my-btn my-btn-small"><?php echo $this->lang('admin_static_pages_badd')?></span></a></div>

                            <?php } else { ?>

                            <div class="centered"><a href="<?php echo $K->SITE_URL?>admin/static-pages/add" rel="phantom" target="dashboard-main-area-right"><span class="my-btn my-btn-small"><?php echo $this->lang('admin_static_pages_badd')?></span></a></div>

                            <div class="myTable table-list-3col">
                                <?php echo $D->items_statics?>
                            </div>

                            <div class="clear"></div>

                            <p class="grey2 mrg20T"><span id="num_items" class="bold"><?php echo $D->numstatics?></span> <?php echo($D->numstatics==1 ? $this->lang('admin_txt_item') : $this->lang('admin_txt_items'))?></p>

                            <?php } ?>

                        </div>

                    </div>     

                </div>

                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>

<script>
    var _menu_resp_admin = stripslashes('<?php echo strJS(cutLineJump($D->admin_menu_title))?>') + stripslashes('<?php echo strJS(cutLineJump($D->admin_menu_responsive))?>') + '<div class="mrg10B"></div>';

    var msg_delete_staticpage = stripslashes('<?php echo $this->designer->boxConfirm($this->lang('admin_static_pages_title_delete'), $this->lang('admin_static_pages_msg_delete'), $this->lang('admin_alert_text_confirm'), $this->lang('admin_alert_text_cancel'))?>');


    markMenuLeft('admin');
    makeMenuResp('admin');

</script>



