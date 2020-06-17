               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>
               
                <div id="dashboard-main-center">

                    <div class="box-white">
                        <div class="box-white-header">
                            <div class="title"><?php echo $this->lang('dashboard_products_edit_title'); ?></div>
                            
                            <div class="some-right"><div><span class="blue">&laquo;</span> <span class="link link-blue"><a href="<?php echo $K->SITE_URL?>products" rel="phantom" target="dashboard-main-area-right"><?php echo $this->lang('dashboard_products_edit_back')?></a></span></div></div>

                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <div id="form01" class="mrg30B">
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



                                <div class="form-block">
                                    <label for="imageupload"><?php echo $this->lang('dashboard_products_create_txt_photos')?>:</label>
                                    <div id="imageupload" class="space_upload">
                                        
                                        <?php if (empty($D->photo[0])) { ?>
                                        <div id="imagepreview"><div class="msgupload"><?php echo $this->lang('dashboard_products_create_txt_uploadphotos')?></div></div>
                                        <?php } else {?>
                                        <div id="imagepreview"><img src="<?php echo $K->STORAGE_URL_PRODUCTS.$D->photo[0].'?r:'.getCode(7, 1); ?>" alt=""></div>
                                        <?php } ?>

                                    </div>
                                    
                                    <input type="file" accept="image/*" class="hide" id="imagenfile" name="imagenfile">
                                    <input id="changeimg" name="changeimg" value="0" type="hidden">
                                    
                                    <script>
                                    
                                    $('#imageupload')[0].ondragover = function(e) {
                                        e.stopPropagation();
                                        e.preventDefault();
                                        $('#imageupload').addClass('hover');
                                    };
                                    
                                    $('#imageupload')[0].ondragleave = function(e) {
                                        e.stopPropagation();
                                        e.preventDefault();
                                        $('#imageupload').removeClass('hover');
                                        return false;
                                    };
                                    
                                    $('#imageupload')[0].ondrop = function(e) {
                                        e.stopPropagation();
                                        e.preventDefault();
                                        $('#imageupload').removeClass('hover');
                                        var dt = e.dataTransfer;
                                        var files = dt.files;
                                        result = handleFiles(files, 'imagepreview', 1);
                                        if (result) $('#changeimg').val('1'); 
                                        $('.msgupload').hide();
                                    };
                                    
                                    $('#imageupload').click(function(e){
                                        $("#imagenfile").click();
                                    });
                                    
                                    $("#imagenfile").change(function(e) {
                                        $("#imagepreview").html("<img src='" + window.URL.createObjectURL(this.files[0]) + "' alt=''>");
                                        $('#changeimg').val('1');
                                    });
                                    
                                    </script>
                                </div>
                                

                                <div class="mrg20T">
                                    <div id="msgerror" class="alert alert-red hide"></div>
                                    <span><input type="submit" name="bsave" id="bsave" value="<?php echo $this->lang('dashboard_products_edit_bupdate')?>" class="my-btn my-btn-blue"/></span> &nbsp; <span class="link link-blue"><a href="<?php echo $K->SITE_URL?>products" rel="phantom" target="dashboard-main-area-right"><?php echo $this->lang('dashboard_products_edit_bcancel')?></a></span> <span id="preload-publish" class="hide"><img src="<?php echo getImageTheme('preload.gif'); ?>" alt=""></span>
                                </div>

                              </form>

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

                                $('#bsave').click(function(e){
                                    e.preventDefault();
                                    updateProduct('#msgerror', '#bsave');
                                });

                                </script>

                            </div>

                            <div class="mrg30B"></div>
                            <div id="msgerror2" class="alert alert-red hide"></div>
                            <div><span id="linkdeleteproduct" class="link link-blue"><?php echo $this->lang('dashboard_products_edit_bdelete')?></span></div>
                            
                            <script>
                            
                            var msg_delete_product = stripslashes('<?php echo $this->designer->boxConfirm($this->lang('dashboard_products_delete_alert_title'), $this->lang('dashboard_products_delete_alert_message'), $this->lang('dashboard_products_delete_alert_bdelete'), $this->lang('dashboard_products_delete_alert_bcancel'))?>');

                            var codpro = '<?php echo $D->codeproduct; ?>';
                            $('#linkdeleteproduct').click(function(e){
                                e.preventDefault();
                                _confirm(msg_delete_product, nothign, deleteProduct, '#msgerror2');
                            });
                            </script>
                            
                            <div class="mrg30B"></div>

                        </div>

                    </div>

                </div>

                <div id="dashboard-main-right">

                    <?php $this->load_template('_dashboard-right.php'); ?>

                </div>

                <div class="clear"></div>

                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>

                <script>
                
                var _menu_resp_dashboard = stripslashes('<?php echo strJS(cutLineJump($D->mini_card_user))?>') + stripslashes('<?php echo strJS(cutLineJump($D->dashboard_menu_responsive))?>') + '<div class="mrg10B"></div>';

                markMenuLeft('dashboard');
                makeMenuResp('dashboard');

                </script>

                <!--DASHBOARD-->