               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                <div id="admin-main-area">

                    <div class="box-white">

                        <div class="box-white-header">
                            <div class="ico"><img src="<?php echo getImageTheme('ico-admin-products.png')?>"></div>
                            <div class="title"><?php echo $this->lang('admin_products_title')?></div>
                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <?php if (empty($D->html_items)) { ?> 

                                <p class="mrg20T centered grey mrg20B"><?php echo $this->lang('admin_txt_no_items')?></p>

                            <?php } else { ?>                       

                                <div class="myTable table-list-3col">
                                    <?php echo $D->html_items; ?>
                                </div>

                                <?php if ($D->totalPag > 1) { ?>

                                <div class="pagination">

                                <?php if ($D->pageCurrent != 1) { ?>

                                    <span><a href="<?php echo $D->url_list?>p:<?php echo($D->pageCurrent - 1)?>" rel="phantom" target="dashboard-main-area-right"><img src="<?php echo getImageTheme('arrow-left.png')?>"></a></span>

                                <?php } ?>

                                <?php for($i=$D->firstPage; $i<=$D->lastPage; $i++) { ?>

                                    <?php if ($i == $D->pageCurrent) {?>

                                    <span class="current"><?php echo $i ?></span>

                                    <?php } else {?>

                                    <span class="nocurrent"><a href="<?php echo $D->url_list?>p:<?php echo $i?>" rel="phantom" target="dashboard-main-area-right"><?php echo $i?></a></span>

                                    <?php } ?>			

                                <?php } ?>

                                <?php if ($D->pageCurrent != $D->lastPage) { ?>

                                    <span><a href="<?php echo $D->url_list?>p:<?php echo($D->pageCurrent + 1)?>" rel="phantom" target="dashboard-main-area-right"><img src="<?php echo getImageTheme('arrow-right.png')?>"></a></span>

                                <?php } ?>

                                </div>

                                <div class="clear"></div>

                                <?php } else { ?>

                                <p class="grey2 mrg20T"><span id="num_items" class="bold"><?php echo $D->numitems?></span> <?php echo($D->numitems==1 ? $this->lang('admin_txt_item') : $this->lang('admin_txt_items'))?></p>

                                <?php } ?>

                            <?php } ?>

                        </div>

                    </div>     

                </div>

                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>

<script>

    var _menu_resp_admin = stripslashes('<?php echo strJS(cutLineJump($D->admin_menu_title))?>') + stripslashes('<?php echo strJS(cutLineJump($D->admin_menu_responsive))?>') + '<div class="mrg10B"></div>';

    var msg_delete_product = stripslashes('<?php echo $this->designer->boxConfirm($this->lang('admin_products_title_delete'), $this->lang('admin_products_msg_delete'), $this->lang('admin_alert_text_confirm'), $this->lang('admin_alert_text_cancel'))?>');
    

    markMenuLeft('admin');
    makeMenuResp('admin');

</script>