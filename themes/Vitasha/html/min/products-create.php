               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>
               
                <div id="dashboard-main-center">

                    <div class="box-white">
                        <div class="box-white-header">
                            <div class="title small"><?php echo $this->lang('dashboard_products_create_title'); ?></div>

                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <div id="form01" class="mrg30B">
                                <form id="form1" name="form1" method="post" action="">
                                
                                <div class="form-block">
                                    <label for="nameproduct"><?php echo $this->lang('dashboard_products_create_txt_name')?>:</label>
                                    <input name="nameproduct" type="text" id="nameproduct" placeholder="<?php echo $this->lang('dashboard_products_create_txt_name')?>" class="form-control"/>
                                </div>
                                
                                <div class="form-block">
                                    <label for="descriptionproduct"><?php echo $this->lang('dashboard_products_create_txt_description')?>:</label>
                                    <textarea name="descriptionproduct" type="text" id="descriptionproduct" placeholder="<?php echo $this->lang('dashboard_products_create_txt_description')?>" class="form-control"/></textarea>
                                </div>
                                
                                <div class="form-block">
                                    <label for="categoryproduct"><?php echo $this->lang('dashboard_products_create_txt_category')?>:</label>
                                    <select name="categoryproduct" id="categoryproduct" class="form-control" onchange="loadsubcategoryproducts(this.value, -1, '<?php echo $this->lang('dashboard_products_create_txt_choosesubcategory')?>','#subcategoryproduct');"></select>
                                </div>

                                <div class="form-block">
                                    <label for="subcategoryproduct"><?php echo $this->lang('dashboard_products_create_txt_subcategory')?>:</label>
                                    <select name="subcategoryproduct" id="subcategoryproduct" class="form-control"></select>
                                </div>
                                
                                <div class="form-block">
                                    <label for="typeproduct"><?php echo $this->lang('dashboard_products_create_txt_type')?>:</label>
                                    <select name="typeproduct" id="typeproduct" class="form-control">
                                        <option value="1"><?php echo $this->lang('dashboard_products_create_txt_type_new')?></option>
                                        <option value="2"><?php echo $this->lang('dashboard_products_create_txt_type_used')?></option>
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
                                    <input name="priceproduct" type="text" id="priceproduct" placeholder="<?php echo $this->lang('dashboard_products_create_txt_price')?>" class="form-control"/>
                                </div>
                                
                                <div class="form-block">
                                    <label for="locationproduct"><?php echo $this->lang('dashboard_products_create_txt_location')?>:</label>
                                    <input name="locationproduct" type="text" id="locationproduct" placeholder="<?php echo $this->lang('dashboard_products_create_txt_location')?>" class="form-control"/>
                                </div>



                                <div class="form-block">
                                    <label for="imageupload"><?php echo $this->lang('dashboard_products_create_txt_photos')?>:</label>
                                    <div id="imageupload" class="space_upload">
                                        <div id="imagepreview"><div class="msgupload"><?php echo $this->lang('dashboard_products_create_txt_uploadphotos')?></div></div>

                                    </div>
                                    
                                    <input type="file" accept="image/*" class="hide" id="imagenfile" name="imagenfile">
                                    
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
                                        handleFiles(files, 'imagepreview', 1);
                                        $('.msgupload').hide();
                                    };
                                    
                                    $('#imageupload').click(function(e){
                                        $("#imagenfile").click();
                                    });
                                    
                                    $("#imagenfile").change(function(e) {
                                        $("#imagepreview").html("<img src='" + window.URL.createObjectURL(this.files[0]) + "' alt=''>")
                                    });
                                    
                                    </script>
                                </div>
                                

                                <div class="mrg20T">
                                    <div id="msgerror" class="alert alert-red hide"></div>
                                    <span><input type="submit" name="bsave" id="bsave" value="<?php echo $this->lang('dashboard_products_create_bsave')?>" class="my-btn my-btn-blue"/></span> <span id="preload-publish" class="hide"><img src="<?php echo getImageTheme('preload.gif'); ?>" alt=""></span>
                                </div>

                              </form>

                                <script>
                                
                                idcategory = -1;
                                idsubcategory = -1;
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
                                    createProduct('#msgerror', '#bsave');
                                });

                                </script>

                            </div>

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