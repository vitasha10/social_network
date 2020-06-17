               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                <div id="admin-main-area">

                    <div class="box-white">

                        <div class="box-white-header">
                            <div class="ico"><img src="<?php echo getImageTheme('ico-admin-cat-products.png')?>"></div>
                            <div class="title"><?php echo $this->lang('admin_products_subcategories_add_title')?></div>
                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <div style="margin-top:-5px; margin-bottom:5px;"><span class="link-blue">&laquo;</span> <span class="link link-blue"><a href="<?php echo $K->SITE_URL?>admin/products/subcategories/c:<?php echo $D->idcat?>" rel="phantom" target="dashboard-main-area-right"><?php echo $this->lang('admin_products_subcategories_back')?></a></span></div>

                            <div class="spacetitle centered mrg20B"><?php echo $D->name_category?></div>

                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_products_subcategories_add_title_new')?></div>

                                <form id="form1" name="form1" method="post" action="">

                                <div class="form-block">
                                    <label for="namecat"><?php echo $this->lang('admin_products_subcategories_add_name')?></label>
                                    <input name="namecat" type="text" id="namecat" placeholder="<?php echo $this->lang('admin_products_subcategories_add_name')?>" class="form-control"/>
                                </div>

                                <div id="msgerror1" class="alert alert-red hide"></div>
                                <div id="msgok1" class="alert alert-green hide"></div>
                                <div>
                                    <input type="submit" name="bsave1" id="bsave1" value="<?php echo $this->lang('admin_products_subcategories_add_bsave')?>" class="my-btn my-btn-blue"/>
                                    <input type="hidden" id="idc" name="idc" value="<?php echo $D->idcat?>">
                                </div>

                                </form>

                            </div>

                        </div>

                    </div>     

                </div>

                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>

<script>

    var _menu_resp_admin = stripslashes('<?php echo strJS(cutLineJump($D->admin_menu_title))?>') + stripslashes('<?php echo strJS(cutLineJump($D->admin_menu_responsive))?>') + '<div class="mrg10B"></div>';

    var txt_error_name = stripslashes('<?php echo strJS($this->lang('admin_products_subcategories_add_error_name'))?>');

    $('#bsave1').click(function(e){
        e.preventDefault();
        createSubCategoryProduct('#msgerror1', '#msgok1', '#bsave1');
    });

    markMenuLeft('admin');
    makeMenuResp('admin');
    
</script>