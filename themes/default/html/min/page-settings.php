                   <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                    <div id="profile-content-area">

                        <div id="profile-settings-area-left">

                            <?php $this->load_template('_menu-setting-page.php'); ?>

                        </div>

                        <div id="profile-settings-area-right">

                            <div class="box-white">
                                <div class="box-white-header">
                                    <div class="title"><?php echo $this->lang('setting_page_settings_title'); ?></div>
                                    <div class="clear"></div>
                                </div>

                                <div class="box-white-body">

                                    <div id="form01" class="mrg10B">

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
                                            <input name="titlepage" type="text" id="titlepage" placeholder="<?php echo $this->lang('dashboard_pages_create_alt_title')?>" class="form-control" value="<?php echo $D->the_title?>"/>
                                        </div>

                                        <div class="form-block">
                                            <label for="urlpage"><?php echo $this->lang('dashboard_pages_create_txt_url')?>:</label>
                                            <input name="urlpage" type="text" id="urlpage" placeholder="<?php echo $this->lang('dashboard_pages_create_alt_url')?>" class="form-control" value="<?php echo $D->username?>"/>
                                        </div>

                                        <div class="form-block">
                                            <label for="descriptionpage"><?php echo $this->lang('dashboard_pages_create_txt_description')?>:</label>
                                            <textarea name="descriptionpage" type="text" id="descriptionpage" placeholder="<?php echo $this->lang('dashboard_pages_create_alt_description')?>" class="form-control"/></textarea>
                                            <script>$('#descriptionpage').val(stripslashes('<?php echo strJS($D->description)?>'));</script>
                                        </div>

                                        <div class="mrg20T">
                                            <div id="msgerror" class="alert alert-red hide"></div>
                                            <span><input type="submit" name="bsave" id="bsave" value="<?php echo $this->lang('setting_txt_save_changes')?>" class="my-btn my-btn-blue"/></span>
                                        </div>

                                      </form>

                                        <script>

                                        idcategory = <?php echo $D->idcat?>;
                                        idsubcategory = <?php echo $D->idsubcat?>;
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

                                        var cpg = '<?php echo $D->codepage?>';
                                        $('#bsave').click(function(e){
                                            e.preventDefault();
                                            updatePage('#msgerror', '#bsave');
                                        });

                                        </script>

                                    </div>
                                    
                                    
                                    
                                    
                                    <div style="margin-top:40px; margin-bottom:25px;">
                                        <div id="msgerror2" class="alert alert-red hide"></div>
                                        <div><span id="linkdeletepage" class="link link-blue"><?php echo $this->lang('setting_page_settings_txt_delet_page')?></span></div>
                                    </div>
                                    
                                    <script>
                                    var msg_delete_page = stripslashes('<?php echo $this->designer->boxConfirm($this->lang('setting_page_settings_txt_delet_page_alert_title'), $this->lang('setting_page_settings_txt_delet_page_alert_msg'), $this->lang('setting_page_settings_txt_delet_page_alert_ok'), $this->lang('setting_page_settings_txt_delet_page_alert_cancel'))?>');
        
                                    var codepage = '<?php echo $D->codepage; ?>';
                                    $('#linkdeletepage').click(function(e){
                                        e.preventDefault();
                                        _confirm(msg_delete_page, nothign, deletePage, '#msgerror2');
                                    });
                                    </script>
                                    
                                    

                                </div>

                            </div>

                        </div>

                        <div class="clear"></div>

                        <?php $this->load_template('_foot-out.php'); ?>

                    </div>

<script>
    var _menu_resp_dashboard = stripslashes('<?php echo strJS(cutLineJump($D->mini_card_user))?>') + stripslashes('<?php echo strJS(cutLineJump($D->dashboard_menu_responsive))?>') + '<div class="mrg10B"></div>';
    
    makeMenuResp('dashboard');
</script>

                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>
