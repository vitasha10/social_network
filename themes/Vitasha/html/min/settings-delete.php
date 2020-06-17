               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>
               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>
                <div id="setting-main-area">

                    <div class="box-white mrg30B">

                        <div class="box-white-header">
                            <div class="ico"><img src="<?php echo getImageTheme('ico-set-delete.png')?>"></div>
                            <div class="title"><?php echo $this->lang('setting_delete_title')?></div>
                            <div class="clear"></div>
                        </div>
                    
                        <div class="box-white-body">
                        

                            <div class="areablock">
                            
                                <form id="form1" name="form1" method="post" action="">
                                <div class="form-block">
                                    <label class="mrg10T"><?php echo $this->lang('setting_delete_txt_delete')?></label>
                                    
                                </div>
                                
                                <div id="msgerror1" class="alert alert-red hide"></div>
                                <div><input type="submit" name="bsave1" id="bsave1" value="<?php echo $this->lang('setting_delete_bsubmit')?>" class="my-btn my-btn-red"/></div>
                                <div class="grey mrg20T"><?php echo $this->lang('setting_delete_warning')?></div>
                                
                                </form>
                            
                            </div>

                        
                        </div>

                    </div>     

                </div>
                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>

<script>

    var _menu_resp_settings = stripslashes('<?php echo strJS(cutLineJump($D->setting_menu_title))?>') + stripslashes('<?php echo strJS(cutLineJump($D->setting_menu_responsive))?>') + '<div class="mrg10B"></div>';

    var msg_delete_account = stripslashes('<?php echo $this->designer->boxConfirm($this->lang('setting_delete_alert_title'), $this->lang('setting_delete_alert'), $this->lang('setting_delete_alert_bdelete'), $this->lang('setting_delete_alert_bcancel'))?>');                
    
    $('#bsave1').click(function(e){
        e.preventDefault();
        _confirm(msg_delete_account, nothign, deleteAccount, '#msgerror1');
//        deleteAccount('#msgerror1', '#bsave1');
    });

    markMenuLeft('settings');
    makeMenuResp('settings');
</script>