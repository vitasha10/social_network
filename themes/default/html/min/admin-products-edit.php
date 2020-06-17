               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                <div id="admin-main-area">

                    <div class="box-white mrg30B">

                        <div class="box-white-header">
                            <div class="ico"><img src="<?php echo getImageTheme('ico-admin-products.png')?>"></div>
                            <div class="title"><?php echo $this->lang('admin_products_edit_block_title')?></div>
                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_products_edit_block_general_title')?></div>

                                <form id="form1" name="form1" method="post" action="">


                                <div class="form-block">
                                    <label for="nameproduct"><?php echo $this->lang('dashboard_products_create_txt_name')?>:</label>
                                    <input name="nameproduct" type="text" id="nameproduct" value="<?php echo $D->name; ?>" placeholder="<?php echo $this->lang('dashboard_products_create_txt_name')?>" class="form-control"/>
                                </div>
                                
                                <div class="form-block">
                                    <label for="descriptionproduct"><?php echo $this->lang('dashboard_products_create_txt_description')?>:</label>
                                    <textarea name="descriptionproduct" type="text" id="descriptionproduct" placeholder="<?php echo $this->lang('dashboard_products_create_txt_description')?>" class="form-control"><?php echo $D->description; ?></textarea>
                                </div>
                                
                                <div class="form-block">
                                    <label for="categoryproduct"><?php echo $this->lang('dashboard_products_create_txt_category')?>:</label>
                                    <select name="categoryproduct" id="categoryproduct" class="form-control" onchange="loadsubcategoryproducts(this.value, <?php echo $D->idcategory?>, '<?php echo $this->lang('dashboard_products_create_txt_choosesubcategory')?>','#subcategoryproduct');"></select>
                                </div>

                                <div class="form-block">
                                    <label for="subcategoryproduct"><?php echo $this->lang('dashboard_products_create_txt_subcategory')?>:</label>
                                    <select name="subcategoryproduct" id="subcategoryproduct" class="form-control"></select>
                                </div>
                                
                                <div class="form-block">
                                    <label for="typeproduct"><?php echo $this->lang('dashboard_products_create_txt_type')?>:</label>
                                    <select name="typeproduct" id="typeproduct" class="form-control">
                                        <option value="1" <?php echo($D->type_product == 1 ? 'selected' : ''); ?>><?php echo $this->lang('dashboard_products_create_txt_type_new')?></option>
                                        <option value="2" <?php echo($D->type_product == 2 ? 'selected' : ''); ?>><?php echo $this->lang('dashboard_products_create_txt_type_used')?></option>
                                    </select>
                                </div>
                                
                                <div class="form-block">
                                    <label for="currencyproduct"><?php echo $this->lang('dashboard_products_create_txt_currency')?>:</label>
                                    <select name="currencyproduct" id="currencyproduct" class="form-control">
                                        <?php echo $D->currencies?>
                                    </select>
                                </div>
                                
                                <div class="form-block">
                                    <label for="priceproduct"><?php echo $this->lang('dashboard_products_create_txt_price')?>:</label>
                                    <input name="priceproduct" type="text" id="priceproduct" value="<?php echo $D->price; ?>" placeholder="<?php echo $this->lang('dashboard_products_create_txt_price')?>" class="form-control"/>
                                </div>
                                
                                <div class="form-block">
                                    <label for="locationproduct"><?php echo $this->lang('dashboard_products_create_txt_location')?>:</label>
                                    <input name="locationproduct" type="text" id="locationproduct" value="<?php echo $D->location; ?>" placeholder="<?php echo $this->lang('dashboard_products_create_txt_location')?>" class="form-control"/>
                                </div>

                                <div id="msgerror1" class="alert alert-red hide"></div>
                                <div id="msgok1" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave1" id="bsave1" value="<?php echo $this->lang('admin_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>

                                </form>

                            </div>

                        </div>

                    </div>     

                </div>

                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>
                
                
                
                                <script>
                                
                                idcategory = <?php echo $D->idcategory; ?>;
                                idsubcategory = <?php echo $D->idsubcategory; ?>;
                                var msgccategories = stripslashes('<?php echo strJS($this->lang('dashboard_products_create_txt_choosecategory'))?>');
                                var msgcsubcategories = stripslashes('<?php echo strJS($this->lang('dashboard_products_create_txt_choosesubcategory'))?>');
                                loadcategoryproducts(idcategory, msgccategories, msgcsubcategories, '#categoryproduct', '#subcategoryproduct');
                                loadsubcategoryproducts(idcategory, idsubcategory, msgcsubcategories, '#subcategoryproduct');

                                var txt_error_name = stripslashes('<?php echo strJS($this->lang('dashboard_products_create_error_name'))?>');
                                var txt_error_category = stripslashes('<?php echo strJS($this->lang('dashboard_products_create_error_category'))?>');
                                var txt_error_subcategory = stripslashes('<?php echo strJS($this->lang('dashboard_products_create_error_subcategory'))?>');
                                var txt_error_description = stripslashes('<?php echo strJS($this->lang('dashboard_products_create_error_description'))?>');
                                var txt_error_type = stripslashes('<?php echo strJS($this->lang('dashboard_products_create_error_type'))?>');
                                var txt_error_currency = stripslashes('<?php echo strJS($this->lang('dashboard_products_create_error_currency'))?>');
                                var txt_error_price = stripslashes('<?php echo strJS($this->lang('dashboard_products_create_error_price'))?>');
                                var txt_error_photo = stripslashes('<?php echo strJS($this->lang('dashboard_products_create_error_photo'))?>');
                                var txt_error_location = stripslashes('<?php echo strJS($this->lang('dashboard_products_create_error_location'))?>');
                                var txt_error_formatphoto = stripslashes('<?php echo strJS($this->lang('dashboard_products_create_error_formatimage'))?>');
                                
                                var idproduct = <?php echo $D->idproduct; ?>;
                                $('#bsave1').click(function(e){
                                    e.preventDefault();
                                    updateProduct('#msgerror1', '#msgok1', '#bsave1');
                                });

                                </script>
                

<script>

    var _menu_resp_admin = stripslashes('<?php echo strJS(cutLineJump($D->admin_menu_title))?>') + stripslashes('<?php echo strJS(cutLineJump($D->admin_menu_responsive))?>') + '<div class="mrg10B"></div>';

    markMenuLeft('admin');
    makeMenuResp('admin');

</script>