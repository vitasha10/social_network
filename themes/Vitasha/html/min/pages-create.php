               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>
               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>
                <div id="dashboard-main-center">

                    <div class="box-white">
                        <div class="box-white-header">
                            <div class="title small"><?php echo $this->lang('dashboard_pages_create_title'); ?></div>

                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <div id="form01" class="mrg30B">
                                <form id="form1" name="form1" method="post" action="">
                                <div class="form-block">
                                    <label for="categorypage"><?php echo $this->lang('dashboard_pages_create_txt_category')?>:</label>
                                    <select name="categorypage" id="categorypage" class="form-control" onchange="loadsubcategorypages(this.value, -1, '<?php echo $this->lang('dashboard_pages_create_txt_choosesubcategory')?>','#subcategorypage');"></select>
                                </div>

                                <div class="form-block">
                                    <label for="subcategorypage"><?php echo $this->lang('dashboard_pages_create_txt_subcategory')?>:</label>
                                    <select name="subcategorypage" id="subcategorypage" class="form-control"></select>
                                </div>

                                <div class="form-block">
                                    <label for="titlepage"><?php echo $this->lang('dashboard_pages_create_txt_title')?>:</label>
                                    <input name="titlepage" type="text" id="titlepage" placeholder="<?php echo $this->lang('dashboard_pages_create_alt_title')?>" class="form-control"/>
                                </div>

                                <div class="form-block">
                                    <label for="urlpage"><?php echo $this->lang('dashboard_pages_create_txt_url')?>:</label>
                                    <input name="urlpage" type="text" id="urlpage" placeholder="<?php echo $this->lang('dashboard_pages_create_alt_url')?>" class="form-control"/>
                                </div>

                                <div class="form-block">
                                    <label for="descriptionpage"><?php echo $this->lang('dashboard_pages_create_txt_description')?>:</label>
                                    <textarea name="descriptionpage" type="text" id="descriptionpage" placeholder="<?php echo $this->lang('dashboard_pages_create_alt_description')?>" class="form-control"/></textarea>
                                </div>

                                <div class="mrg20T">
                                    <div id="msgerror" class="alert alert-red hide"></div>
                                    <span><input type="submit" name="bsave" id="bsave" value="<?php echo $this->lang('dashboard_pages_create_txt_buttonsave')?>" class="my-btn my-btn-blue"/></span>
                                </div>

                              </form>

                                <script>
                                idcategory = -1;
                                idsubcategory = -1;
                                var msgccategories = stripslashes('<?php echo strJS($this->lang('dashboard_pages_create_txt_choosecategory'))?>');
                                var msgcsubcategories = stripslashes('<?php echo strJS($this->lang('dashboard_pages_create_txt_choosesubcategory'))?>');
                                loadcategorypages(idcategory, msgccategories, msgcsubcategories, '#categorypage', '#subcategorypage');
                                loadsubcategorypages(idcategory, idsubcategory, msgcsubcategories, '#subcategorypage');

                                var txt_enter_title = stripslashes('<?php echo strJS($this->lang('dashboard_pages_create_error_entertitle'))?>');
                                var txt_enter_url = stripslashes('<?php echo strJS($this->lang('dashboard_pages_create_error_enterurl'))?>');
                                var txt_url_invalid = stripslashes('<?php echo strJS($this->lang('dashboard_pages_create_error_urlnovalid'))?>');
                                var txt_enter_description = stripslashes('<?php echo strJS($this->lang('dashboard_pages_create_error_enterdescription'))?>');
                                var txt_choose_category = stripslashes('<?php echo strJS($this->lang('dashboard_pages_create_error_choosecategory'))?>');
                                var txt_choose_subcategory = stripslashes('<?php echo strJS($this->lang('dashboard_pages_create_error_choosesubcategory'))?>');

                                $('#bsave').click(function(e){
                                    e.preventDefault();
                                    createPage('#msgerror', '#bsave');
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