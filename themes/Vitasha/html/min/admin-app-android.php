               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                <div id="admin-main-area">

                    <div class="box-white">

                        <div class="box-white-header">
                            <div class="ico"><img src="<?php echo getImageTheme('ico-admin-app-android.png')?>"></div>
                            <div class="title"><?php echo $this->lang('admin_menu_app_android_title')?></div>
                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_menu_app_android_title')?></div>
                                
                                <form id="form1" name="form1" method="post" action="">
                                
                                <div class="form-block">
                                    <label for="show_app"><?php echo $this->lang('admin_menu_app_android_txt_allow')?>:</label>
                                    <select name="show_app" id="show_app" class="form-control">
                                        <option value="1" <?php echo($D->option_show_app == 1 ? 'selected' : '');?>><?php echo $this->lang('admin_menu_app_android_choose_yes')?></option>
                                        <option value="0" <?php echo($D->option_show_app == 0 ? 'selected' : '');?>><?php echo $this->lang('admin_menu_app_android_choose_no')?></option>
                                    </select>
                                </div>
                                
                                <div id="space_form_app" style=" <?php echo($D->option_show_app == 1 ? '' : 'display:none;');?> ">

                                    <div class="form-block">
                                        <label for="apkupload"><?php echo $this->lang('admin_menu_app_android_fileapp')?>:</label>
                                        
                                        <?php if ($D->current_app) { ?>
                                        <div id="space_link_replace"><?php echo $this->lang('admin_menu_app_android_fileapp_current')?> (<span id="link_replace_apk" class="link link-blue"><?php echo $this->lang('admin_menu_app_android_fileapp_replace'); ?></span>)</div>
                                        
                                        <div id="apkupload" class="space_upload" style="display:none;">
                                            <div id="prewapk"><div class="msgupload"><?php echo $this->lang('admin_menu_app_android_fileapp_txt_upload')?></div></div>
    
                                        </div>
                                        
                                        <script>
                                            $('#link_replace_apk').click(function(){
                                                
                                                $("#space_link_replace").slideUp('low',function(){
                                                    $("#apkupload").slideDown('low');
                                                });

                                            });
                                        </script>
                                        
                                        <?php } else { ?>

                                        <div id="apkupload" class="space_upload">
                                            <div id="prewapk"><div class="msgupload"><?php echo $this->lang('admin_menu_app_android_fileapp_txt_upload')?></div></div>
    
                                        </div>

                                        <?php } ?>

                                        <input type="file"class="hide" id="filesapks" name="filesapks">
                                        <input id="numfilesapks" name="numfilesapks" type="hidden" value="0">
                                        
                                        <div id="msg-apks-files" style="background-image:url(<?php echo getImageTheme('ico-attach.png')?>);">
                                            <span id="delele_msg_apks">x</span>
                                            <span id="nquantity"></span> <span id="msg_quantity"></span>
                                        </div>
                                        
                                    <script>
                                    
                                    $('#apkupload').ondragover = function(e) {
                                        e.stopPropagation();
                                        e.preventDefault();
                                        $('#apkupload').addClass('hover');
                                    };
                                    
                                    $('#apkupload').ondragleave = function(e) {
                                        e.stopPropagation();
                                        e.preventDefault();
                                        $('#apkupload').removeClass('hover');
                                        return false;
                                    };
                                    
                                    $('#apkupload').ondrop = function(e) {
                                        e.stopPropagation();
                                        e.preventDefault();
                                        $('#apkupload').removeClass('hover');
                                        return false;
                                    };
                                    
                                    $('#apkupload').click(function(e){
                                        $("#filesapks").click();
                                    });
                                    
                                    var msg_one = stripslashes('<?php echo strJS($this->lang('admin_menu_app_android_fileapp_attach'))?>');
                                    var msg_more = stripslashes('<?php echo strJS($this->lang('admin_menu_app_android_fileapp_attachs'))?>');
                                    $("#filesapks").change(function(e) {
                                        if (this.files.length == 1) {
                                            $('#nquantity').text(1);
                                            $('#msg_quantity').text(msg_one);
                                            $('#msg-apks-files').show();
                                        } else {
                                            $('#nquantity').text(this.files.length);
                                            $('#msg_quantity').text(msg_more);
                                            $('#msg-apks-files').show();
                                        }
                                        $('#apkupload').hide();
                                        $('#numfilesapks').val(this.files.length);
                                    });
                                    
                                    $('#delele_msg_apks').click(function(){
                                        $('#msg-apks-files').hide();
                                        $('#apkupload').show();
                                        $('#numfilesapks').val(0);
                                        var $fileInput = $('#filesapks');
                                        $fileInput.val('');        
                                        var inputClone = $fileInput.clone(true);
                                        $fileInput.after(inputClone);
                                        $fileInput.remove();
                                        $fileInput = inputClone;
                                    });
                                    
                                    </script>
                                    </div>
                                
                                </div>
                                
                                <div id="msgerror1" class="alert alert-red hide"></div>
                                <div id="msgok1" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave1" id="bsave1" value="<?php echo $this->lang('admin_menu_app_android_bsave')?>" class="my-btn my-btn-blue"/></div>
                                
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

    var txt_error_apk = stripslashes('<?php echo strJS($this->lang('admin_menu_app_android_error_file'))?>');
    var txt_error_format_apk = stripslashes('<?php echo strJS($this->lang('admin_menu_app_android_error_format_file'))?>');

    $('#bsave1').click(function(e){
        e.preventDefault();
        updateAppAndroid('#msgerror1', '#msgok1', '#bsave1');
    });

    markMenuLeft('admin');
    makeMenuResp('admin');
    
</script>

<script>
$('#show_app').change(function(){
    switch(this.value) {
        case '0':
            $('#space_form_app').hide();
            return;
            break;
            
        case '1':
            $('#space_form_app').show();
            break;
    }
});
</script>