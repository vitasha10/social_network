               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                <div id="admin-main-area">

                    <div class="box-white mrg30B">

                        <div class="box-white-header">
                            <div class="ico"><img src="<?php echo getImageTheme('ico-admin-articles.png')?>"></div>
                            <div class="title"><?php echo $this->lang('admin_articles_edit_block_general_title')?></div>
                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_products_edit_block_general_title')?></div>

                                <form id="form1" name="form1" method="post" action="">

                                <div class="form-block">
                                    <label for="titlearticle"><?php echo $this->lang('admin_articles_edit_block_general_txt_title')?>:</label>
                                    <input name="titlearticle" type="text" id="titlearticle" value="<?php echo $D->title; ?>" placeholder="<?php echo $this->lang('admin_articles_edit_block_general_txt_title')?>" class="form-control"/>
                                </div>
                                
                                <div class="form-block">
                                    <label for="categoryarticle"><?php echo $this->lang('admin_articles_edit_block_general_txt_category')?>:</label>
                                    <select name="categoryarticle" id="categoryarticle" class="form-control" onchange="loadsubcategoryarticles(this.value, <?php echo $D->idcategory?>, '<?php echo $this->lang('admin_articles_edit_block_general_txt_choosesubcategory')?>','#subcategoryarticle');"></select>
                                </div>

                                <div class="form-block">
                                    <label for="subcategoryarticle"><?php echo $this->lang('admin_articles_edit_block_general_txt_subcategory')?>:</label>
                                    <select name="subcategoryarticle" id="subcategoryarticle" class="form-control"></select>
                                </div>

                                <div class="form-block">
                                    <label for="summaryarticle"><?php echo $this->lang('admin_articles_edit_block_general_txt_summary')?>:</label>
                                    <textarea name="summaryarticle" type="text" id="summaryarticle" placeholder="<?php echo $this->lang('admin_articles_edit_block_general_txt_summary')?>" class="form-control"><?php echo $D->summary; ?></textarea>

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
                                
                                idcategory = <?php echo $D->idcategory?>;
                                idsubcategory = <?php echo $D->idsubcategory?>;
                                var msgccategories = stripslashes('<?php echo strJS($this->lang('admin_articles_edit_block_general_txt_choosecategory'))?>');
                                var msgcsubcategories = stripslashes('<?php echo strJS($this->lang('admin_articles_edit_block_general_txt_choosesubcategory'))?>');
                                loadcategoryarticles(idcategory, msgccategories, msgcsubcategories, '#categoryarticle', '#subcategoryarticle');
                                loadsubcategoryarticles(idcategory, idsubcategory, msgcsubcategories, '#subcategoryarticle');

                                var txt_error_title = stripslashes('<?php echo strJS($this->lang('admin_articles_edit_block_general_error_title'))?>');
                                var txt_error_category = stripslashes('<?php echo strJS($this->lang('admin_articles_edit_block_general_error_category'))?>');
                                var txt_error_subcategory = stripslashes('<?php echo strJS($this->lang('admin_articles_edit_block_general_error_subcategory'))?>');
                                var txt_error_summary = stripslashes('<?php echo strJS($this->lang('admin_articles_edit_block_general_error_summary'))?>');
                                var txt_error_content = stripslashes('<?php echo strJS($this->lang('admin_articles_edit_block_general_error_content'))?>');
                                var txt_error_image = stripslashes('<?php echo strJS($this->lang('admin_articles_edit_block_general_error_image'))?>');
                                var txt_error_formatimage = stripslashes('<?php echo strJS($this->lang('admin_articles_edit_block_general_error_formatimage'))?>');

                                var idarticle = <?php echo $D->idarticle; ?>;
                                $('#bsave1').click(function(e) {
                                    e.preventDefault();
                                    updateArticle('#msgerror1', '#msgok1', '#bsave1');
                                });

                                </script>
                

<script>

    var _menu_resp_admin = stripslashes('<?php echo strJS(cutLineJump($D->admin_menu_title))?>') + stripslashes('<?php echo strJS(cutLineJump($D->admin_menu_responsive))?>') + '<div class="mrg10B"></div>';

    markMenuLeft('admin');
    makeMenuResp('admin');

</script>