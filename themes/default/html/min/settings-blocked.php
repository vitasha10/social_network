               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>
               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>
                <div id="setting-main-area">

                    <div class="box-white mrg30B">

                        <div class="box-white-header">
                            <div class="ico"><img src="<?php echo getImageTheme('ico-set-blocking.png')?>"></div>
                            <div class="title"><?php echo $this->lang('setting_blocked_title')?></div>
                            <div class="clear"></div>
                        </div>
                    
                        <div class="box-white-body">
                        
                            <?php if (empty($D->the_list_items)) { ?>
                        
                            <p class="centered grey"><?php echo $this->lang('setting_blocked_nouser')?></span>
                            
                            <?php } else { ?>

                            <div id="list-items" class="theusersblocked">
                                <?php echo $D->the_list_items ?>
                            </div>
                            
                            <?php } ?>
                            
                            <?php if ($D->show_more) { ?>
                            <div id="space_more" class="centered">
                                <span class="my-btn" id="linkmore"><?php echo $this->lang('global_txt_showmore')?></span>
                                <input type="hidden" id="activities_place" name="activities_place" value="ublocked" />
                                <input type="hidden" id="activity_page" name="activity_page" value="1" />
                            </div>
                            
                            <script>
                                $('#linkmore').click(function() {
                                    moreItems();
                                });
                                

                            </script>
                            
                            <?php } ?>
                        
                        </div>

                    </div>     

                </div>
                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>

<script>
    var _menu_resp_settings = stripslashes('<?php echo strJS(cutLineJump($D->setting_menu_title))?>') + stripslashes('<?php echo strJS(cutLineJump($D->setting_menu_responsive))?>') + '<div class="mrg10B"></div>';

    var msg_confirm_block = new Array();
    
    $('#bsave1').click(function(e){
        e.preventDefault();
        _confirm(msg_delete_account, nothign, deleteAccount, '#msgerror1');
//        deleteAccount('#msgerror1', '#bsave1');
    });

    markMenuLeft('settings');
    makeMenuResp('settings');
</script>