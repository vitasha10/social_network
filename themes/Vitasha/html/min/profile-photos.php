                   <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>
                   
<?php if (!$D->show_profile) { ?>

                    <?php $this->load_template('_restricted-profile.php'); ?>

<?php } else { ?>
                   
                   
                    <div id="profile-content-area">
                        
                        <div class="box-white mrg30B">
                        
                            <div class="box-white-header">
                                <div class="title small"><?php echo $this->lang('profile_photos_title')?></div>
                                <div class="clear"></div>
                            </div>
                            
                            <div class="box-white-body">
                            
                                <?php if (empty($D->html_photos)) { ?>
                                
                                <div class="centered mrg20T mrg20B grey"><?php echo $this->lang('profile_photos_nohave', array('#THEUSER#'=>$D->the_name_user))?></div>
                                
                                <?php } else { ?>
                                
                                <?php echo $D->html_photos ?>
                                
                                <?php } ?>
                                
                                <div class="clear"></div>
                            
                            </div>
                        
                        </div>
                        
                        <div class="clear"></div>
                        
                        <?php $this->load_template('_foot-out.php'); ?>

                    </div>

<?php } ?>

                    <?php if ($D->_IS_LOGGED) { ?>
                    
                    <script>
                    var _menu_resp_dashboard = stripslashes('<?php echo strJS(cutLineJump($D->mini_card_user))?>') + stripslashes('<?php echo strJS(cutLineJump($D->dashboard_menu_responsive))?>') + '<div class="mrg10B"></div>';
                    
                    makeMenuResp('dashboard');

                    </script>
                    
                    <?php } ?>

                    
                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>
