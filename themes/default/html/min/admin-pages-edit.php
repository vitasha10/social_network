               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                <div id="admin-main-area">

                    <div class="box-white mrg30B">

                        <div class="box-white-header">
                            <div class="ico"><img src="<?php echo getImageTheme('ico-admin-pages.png')?>"></div>
                            <div class="title"><?php echo $D->title?></div>
                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_pages_edit_block_general_title')?></div>

                                <form id="form1" name="form1" method="post" action="">

                                <div class="form-block">
                                    <label for="verify"><?php echo $this->lang('admin_pages_edit_block_general_verify')?></label>
                                    <select name="verify" id="verify" class="form-control">
                                        <option value="0" <?php echo($D->verified == 0 ?'selected="selected"' : '');?>><?php echo $this->lang('admin_pages_edit_block_general_verify_no')?></option>
                                        <option value="1" <?php echo($D->verified == 1 ? 'selected="selected"' : '');?>><?php echo $this->lang('admin_pages_edit_block_general_verify_yes')?></option>
                                    </select>
                                </div>

                                <div class="form-block">
                                    <label for="categorypage"><?php echo $this->lang('admin_pages_edit_block_general_txt_category')?></label>
                                    <select name="categorypage" id="categorypage" class="form-control" onchange="loadsubcategorypages(this.value, -1, '<?php echo $this->lang('admin_pages_edit_block_general_txt_choosecategory')?>','#subcategorypage');"></select>
                                </div>

                                <div class="form-block">
                                    <label for="subcategorypage"><?php echo $this->lang('admin_pages_edit_block_general_txt_subcategory')?></label>
                                    <select name="subcategorypage" id="subcategorypage" class="form-control"></select>
                                </div>

                                <div class="form-block">
                                    <label for="titlepage"><?php echo $this->lang('admin_pages_edit_block_general_txt_title')?></label>
                                    <input name="titlepage" type="text" id="titlepage" placeholder="<?php echo $this->lang('admin_pages_edit_block_general_alt_title')?>" class="form-control" value="<?php echo $D->title?>"/>
                                </div>

                                <div class="form-block">
                                    <label for="urlpage"><?php echo $this->lang('admin_pages_edit_block_general_txt_url')?></label>
                                    <input name="urlpage" type="text" id="urlpage" placeholder="<?php echo $this->lang('admin_pages_edit_block_general_alt_url')?>" class="form-control" value="<?php echo $D->username?>"/>
                                </div>

                                <div class="form-block">
                                    <label for="descriptionpage"><?php echo $this->lang('admin_pages_edit_block_general_txt_description')?></label>
                                    <textarea name="descriptionpage" type="text" id="descriptionpage" placeholder="<?php echo $this->lang('admin_pages_edit_block_general_alt_description')?>" class="form-control"/></textarea>
                                    <script>$('#descriptionpage').val(stripslashes('<?php echo strJS($D->description)?>'));</script>
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

    var _menu_resp_admin = stripslashes('<?php echo strJS(cutLineJump($D->admin_menu_title))?>') + stripslashes('<?php echo strJS(cutLineJump($D->admin_menu_responsive))?>') + '<div class="mrg10B"></div>';

    idcategory = <?php echo $D->idcat?>;
    idsubcategory = <?php echo $D->idsubcat?>;
    var msgccategories = stripslashes('<?php echo strJS($this->lang('admin_pages_edit_block_general_txt_choosecategory'))?>');
    var msgcsubcategories = stripslashes('<?php echo strJS($this->lang('admin_pages_edit_block_general_txt_choosesubcategory'))?>');
    loadcategorypages(idcategory, msgccategories, msgcsubcategories, '#categorypage', '#subcategorypage');
    loadsubcategorypages(idcategory, idsubcategory, msgcsubcategories, '#subcategorypage');

    var idp = <?php echo $D->idpage?>;

    var txt_error_option = stripslashes('<?php echo strJS($this->lang('admin_txt_must_choose_option'))?>');
    var txt_enter_title = stripslashes('<?php echo strJS($this->lang('admin_pages_edit_block_general_error_entertitle'))?>');
    var txt_enter_url = stripslashes('<?php echo strJS($this->lang('admin_pages_edit_block_general_error_enterurl'))?>');
    var txt_url_invalid = stripslashes('<?php echo strJS($this->lang('admin_pages_edit_block_general_error_urlnovalid'))?>');
    var txt_enter_description = stripslashes('<?php echo strJS($this->lang('admin_pages_edit_block_general_error_enterdescription'))?>');
    var txt_choose_category = stripslashes('<?php echo strJS($this->lang('admin_pages_edit_block_general_error_choosecategory'))?>');
    var txt_choose_subcategory = stripslashes('<?php echo strJS($this->lang('admin_pages_edit_block_general_error_choosesubcategory'))?>');

    $('#bsave1').click(function(e){
        e.preventDefault();
        updatePageGeneral('#msgerror1', '#msgok1', '#bsave1');
    });

    markMenuLeft('admin');
    makeMenuResp('admin');

</script>