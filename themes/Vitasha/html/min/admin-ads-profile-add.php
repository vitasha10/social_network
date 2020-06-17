               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                <div id="admin-main-area">

                    <div class="box-white">

                        <div class="box-white-header">
                            <div class="ico"><img src="<?php echo getImageTheme('ico-admin-ads-basic-p.png')?>"></div>
                            <div class="title"><?php echo $this->lang('admin_ads_profile_add_title')?></div>
                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_ads_profile_add_title_new')?></div>
                                
                                <div class="form-block">
                                    <label for="type_ads"><?php echo $this->lang('admin_ads_profile_add_type_ads')?>:</label>
                                    <select name="type_ads" id="type_ads" class="form-control">
                                        <option value="0"><?php echo $this->lang('admin_ads_profile_add_choose_type_ads')?></option>
                                        <option value="1"><?php echo $this->lang('admin_ads_profile_add_type_ads_image')?></option>
                                        <option value="2"><?php echo $this->lang('admin_ads_profile_add_type_ads_html')?></option>
                                    </select>
                                </div>
                                
                                <div id="space_ads_image" style="display:none;">

                                    <form id="form1" name="form1" method="post" action="">

                                    <div class="form-block">
                                        <label for="nameads"><?php echo $this->lang('admin_ads_profile_add_name')?></label>
                                        <input name="nameads" type="text" id="nameads" placeholder="<?php echo $this->lang('admin_ads_profile_add_name')?>" class="form-control"/>
                                    </div>
                                    
                                    
                                    
                                    <div class="form-block">
                                        <label for="imageupload"><?php echo $this->lang('admin_ads_profile_add_banner')?>:</label>
                                        <div id="imageupload" class="space_upload">
                                            <div id="imagepreview"><div class="msgupload"><?php echo $this->lang('admin_ads_profile_add_banner_txt_upload')?></div></div>
    
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
                                    
                                    <div class="form-block">
                                        <label for="urlads"><?php echo $this->lang('admin_ads_profile_add_url')?></label>
                                        <input name="urlads" type="text" id="urlads" placeholder="<?php echo $this->lang('admin_ads_profile_add_url')?>" class="form-control"/>
                                    </div>
                                    
                                    <div class="form-block">
                                        <label for="target"><?php echo $this->lang('admin_ads_profile_add_load')?>:</label>
                                        <select name="target" id="target" class="form-control">
                                            <option value="0"><?php echo $this->lang('admin_ads_profile_add_load_same')?></option>
                                            <option value="1"><?php echo $this->lang('admin_ads_profile_add_load_blank')?></option>
                                        </select>
                                    </div>
                                    
    
                                    <div id="msgerror1" class="alert alert-red hide"></div>
                                    <div id="msgok1" class="alert alert-green hide"></div>
                                    <div><input type="submit" name="bsave1" id="bsave1" value="<?php echo $this->lang('admin_ads_profile_add_bsave')?>" class="my-btn my-btn-blue"/></div>
    
                                    </form>
                                
                                </div>
                                
                                <div id="space_ads_html" style="display:none;">

                                    <form id="form2" name="form2" method="post" action="">
                                
                                    <div class="form-block">
                                        <label for="nameads2"><?php echo $this->lang('admin_ads_dashboard_add_name')?></label>
                                        <input name="nameads2" type="text" id="nameads2" placeholder="<?php echo $this->lang('admin_ads_dashboard_add_name')?>" class="form-control"/>
                                    </div>
                                    
                                    <div class="form-block">
                                        <label for="codehtml"><?php echo $this->lang('admin_ads_dashboard_add_type_ads_html_code')?>:</label>
                                        <textarea name="codehtml" type="text" id="codehtml" placeholder="<?php echo $this->lang('admin_ads_dashboard_add_type_ads_html_code')?>" class="form-control" rows="10"></textarea>
                                    </div>
                                
                                    <div id="msgerror2" class="alert alert-red hide"></div>
                                    <div id="msgok2" class="alert alert-green hide"></div>
                                    <div><input type="submit" name="bsave2" id="bsave2" value="<?php echo $this->lang('admin_ads_dashboard_add_bsave')?>" class="my-btn my-btn-blue"/></div>
    
                                    </form>
                                
                                </div>

                            </div>

                        </div>

                    </div>     

                </div>

                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>

<script>

    var _menu_resp_admin = stripslashes('<?php echo strJS(cutLineJump($D->admin_menu_title))?>') + stripslashes('<?php echo strJS(cutLineJump($D->admin_menu_responsive))?>') + '<div class="mrg10B"></div>';

    var txt_error_name = stripslashes('<?php echo strJS($this->lang('admin_ads_profile_add_error_name'))?>');
    var txt_error_url = stripslashes('<?php echo strJS($this->lang('admin_ads_profile_add_error_url'))?>');
    var txt_error_target = stripslashes('<?php echo strJS($this->lang('admin_ads_profile_add_error_target'))?>');
    var txt_error_image = stripslashes('<?php echo strJS($this->lang('admin_ads_profile_add_error_image'))?>');
    var txt_error_formatimage = stripslashes('<?php echo strJS($this->lang('admin_ads_profile_add_error_image_format'))?>');


    $('#bsave1').click(function(e){
        e.preventDefault();
        createAds('#msgerror1', '#msgok1', '#bsave1', 2);
    });
    
    var txt_error_htmlcode = stripslashes('<?php echo strJS($this->lang('admin_ads_dashboard_add_error_html'))?>');

    $('#bsave2').click(function(e){
        e.preventDefault();
        createAdsHTML('#msgerror2', '#msgok2', '#bsave2', 2);
    });

    markMenuLeft('admin');
    makeMenuResp('admin');
    
</script>

<script>
$('#type_ads').change(function(){
    switch(this.value) {
        case '0':
            $('#space_ads_image').hide();
            $('#space_ads_html').hide();
            return;
            break;
            
        case '1':
            $('#space_ads_image').show();
            $('#space_ads_html').hide();
            break;

        case '2':
            $('#space_ads_image').hide();
            $('#space_ads_html').show();            
            break;
        
    }
});
</script>
