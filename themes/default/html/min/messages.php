                    <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>
                    <div id="messages-2-parts-left">

                        <div class="box-white">
                            
                            <div class="box-white-header-clean">
                                <div class="title"><?php echo $this->lang('dashboard_messages_title_recent'); ?></div>
                                <div class="clear"></div>
                            </div>
                            
                            <div class="container-inbox">
                                <div class="slimscrollers" data-slimScroll-height="100%"><?php echo $D->html_talks?></div>
                            </div>
                            
                        </div>
                    
                    </div>
                    
                <?php if (!isset($D->html_talks_messages)) { ?>
                    
                    <div id="messages-2-parts-right">

                        <div class="box-white mrg20B">
                            
                            <div class="box-white-header-clean">
                                <div class="title"><?php echo $this->lang('dashboard_messages_title_noselection'); ?></div>
                                <div class="clear"></div>
                            </div>
                            
                            <div>
                                
                                <div class="container-body">

                                    <div class="msg-no-selected"><?php echo $this->lang('dashboard_messages_title_no_selected_conversation'); ?></div>
                                
                                </div>
                            
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    <div class="clear"></div>
                    
                <?php } else { ?>

                <?php $this->load_template('min/messages-talk.php'); ?>

                <?php } ?>

                    <script>
                        var _menu_resp_dashboard = stripslashes('<?php echo strJS(cutLineJump($D->mini_card_user))?>') + stripslashes('<?php echo strJS(cutLineJump($D->dashboard_menu_responsive))?>') + '<div class="mrg10B"></div>';
                    
                        activeSlimScrollers(); 
                        
                        makeMenuResp('dashboard');                   
                    </script>

                    
                    <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                    <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                    <?php } ?>
                    
                    <?php $this->load_template('_foot-out.php'); ?>
