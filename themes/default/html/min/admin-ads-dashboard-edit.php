               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                <div id="admin-main-area">

                    <div class="box-white">

                        <div class="box-white-header">
                            <div class="ico"><img src="<?php echo getImageTheme('ico-admin-ads-basic-d.png')?>"></div>
                            <div class="title"><?php echo $this->lang('admin_ads_dashboard_edit_title')?></div>
                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_ads_dashboard_edit_title_edit')?></div>
                                
                                <div class="form-block">
                                    <label for="type_ads"><?php echo $this->lang('admin_ads_dashboard_edit_type_ads')?>: <span style="font-weight:normal;"><?php echo $D->text_type; ?></span></label>
                                </div>
                                
                                <?php if ($D->type_ads == 1) { ?>
                                <div id="space_ads_image">

                                    <form id="form1" name="form1" method="post" action="">

                                <div class="form-block">
                                    <label for="nameads"><?php echo $this->lang('admin_ads_dashboard_add_name')?></label>
                                    <input name="nameads" type="text" id="nameads" value="<?php echo $D->name?>" placeholder="<?php echo $this->lang('admin_ads_dashboard_add_name')?>" class="form-control"/>
                                </div>
                                
                                
                                
                                <div class="form-block">
                                    <label for="imageupload"><?php echo $this->lang('admin_ads_dashboard_add_banner')?>:</label>
                                    <div id="imageupload" class="space_upload">
                                        <?php if (empty($D->thefile)) { ?>
                                        <div id="imagepreview"><div class="msgupload"><?php echo $this->lang('dashboard_articles_publish_txt_upload_image')?></div></div>
                                        <?php } else {?>
                                        <div id="imagepreview"><img src="<?php echo $K->STORAGE_URL_ADS_BASIC.$D->thefile.'?r:'.getCode(7, 1); ?>" alt=""></div>
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
                                
                                <div class="form-block">
                                    <label for="urlads"><?php echo $this->lang('admin_ads_dashboard_add_url')?></label>
                                    <input name="urlads" type="text" id="urlads" value="<?php echo $D->theurl?>" placeholder="<?php echo $this->lang('admin_ads_dashboard_add_url')?>" class="form-control"/>
                                </div>
                                
                                <div class="form-block">
                                    <label for="target"><?php echo $this->lang('admin_ads_dashboard_add_load')?>:</label>
                                    <select name="target" id="target" class="form-control">
                                        <option value="0" <?php echo($D->target == 0 ? 'selected' : '')?>><?php echo $this->lang('admin_ads_dashboard_add_load_same')?></option>
                                        <option value="1" <?php echo($D->target == 1 ? 'selected' : '')?>><?php echo $this->lang('admin_ads_dashboard_add_load_blank')?></option>
                                    </select>
                                </div>
                                
                                <div class="form-block">
                                    <label for="status"><?php echo $this->lang('admin_ads_dashboard_edit_status')?>:</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="0" <?php echo($D->status == 0 ? 'selected' : '')?>><?php echo $this->lang('admin_ads_dashboard_edit_status_disabled')?></option>
                                        <option value="1" <?php echo($D->status == 1 ? 'selected' : '')?>><?php echo $this->lang('admin_ads_dashboard_edit_status_enabled')?></option>
                                    </select>
                                </div>
                                

                                <div id="msgerror1" class="alert alert-red hide"></div>
                                <div id="msgok1" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave1" id="bsave1" value="<?php echo $this->lang('admin_ads_dashboard_edit_bupdate')?>" class="my-btn my-btn-blue"/></div>

                                </form>
                                
                                </div>
                                <?php } ?>
                                
                                
                                <?php if ($D->type_ads == 2) { ?>
                                <div id="space_ads_html">

                                    <form id="form2" name="form2" method="post" action="">
                                
                                    <div class="form-block">
                                        <label for="nameads2"><?php echo $this->lang('admin_ads_dashboard_add_name')?></label>
                                        <input name="nameads2" type="text" id="nameads2" value="<?php echo $D->name; ?>" placeholder="<?php echo $this->lang('admin_ads_dashboard_add_name')?>" class="form-control"/>
                                    </div>
                                    
                                    <div class="form-block">
                                        <label for="codehtml"><?php echo $this->lang('admin_ads_dashboard_add_type_ads_html_code')?>:</label>
                                        <textarea name="codehtml" type="text" id="codehtml" placeholder="<?php echo $this->lang('admin_ads_dashboard_add_type_ads_html_code')?>" class="form-control" rows="10"><?php echo $D->the_html; ?></textarea>
                                    </div>
                                    
                                    <div class="form-block">
                                        <label for="status2"><?php echo $this->lang('admin_ads_dashboard_edit_status')?>:</label>
                                        <select name="status2" id="status2" class="form-control">
                                            <option value="0" <?php echo($D->status == 0 ? 'selected' : '')?>><?php echo $this->lang('admin_ads_dashboard_edit_status_disabled')?></option>
                                            <option value="1" <?php echo($D->status == 1 ? 'selected' : '')?>><?php echo $this->lang('admin_ads_dashboard_edit_status_enabled')?></option>
                                        </select>
                                    </div>
                                
                                    <div id="msgerror2" class="alert alert-red hide"></div>
                                    <div id="msgok2" class="alert alert-green hide"></div>
                                    <div><input type="submit" name="bsave2" id="bsave2" value="<?php echo $this->lang('admin_ads_dashboard_edit_bupdate')?>" class="my-btn my-btn-blue"/></div>
    
                                    </form>
                                
                                </div>
                                <?php } ?>
                                

                            </div>

                        </div>

                    </div>     

                </div>

                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>

<script>

    var _menu_resp_admin = stripslashes('<?php echo strJS(cutLineJump($D->admin_menu_title))?>') + stripslashes('<?php echo strJS(cutLineJump($D->admin_menu_responsive))?>') + '<div class="mrg10B"></div>';

    var txt_error_name = stripslashes('<?php echo strJS($this->lang('admin_ads_dashboard_add_error_name'))?>');
    var txt_error_url = stripslashes('<?php echo strJS($this->lang('admin_ads_dashboard_add_error_url'))?>');
    var txt_error_target = stripslashes('<?php echo strJS($this->lang('admin_ads_dashboard_add_error_target'))?>');
    var txt_error_status = stripslashes('<?php echo strJS($this->lang('admin_ads_dashboard_edit_error_status'))?>');
    var txt_error_image = stripslashes('<?php echo strJS($this->lang('admin_ads_dashboard_add_error_image'))?>');
    var txt_error_formatimage = stripslashes('<?php echo strJS($this->lang('admin_ads_dashboard_add_error_image_format'))?>');

    var idads = <?php echo $D->idbasic; ?>;
    var slot = 1;
    
    <?php if ($D->type_ads == 1) { ?>
    $('#bsave1').click(function(e) {
        e.preventDefault();
        updateAds('#msgerror1', '#msgok1', '#bsave1');
    });
    <?php } ?>
    
    var txt_error_htmlcode = stripslashes('<?php echo strJS($this->lang('admin_ads_dashboard_add_error_html'))?>');
    
    <?php if ($D->type_ads == 2) { ?>
    $('#bsave2').click(function(e) {
        e.preventDefault();
        updateAdsHTML('#msgerror2', '#msgok2', '#bsave2');
    });
    <?php } ?>

    markMenuLeft('admin');
    makeMenuResp('admin');
    
</script>