               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>
               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>
               
                <div id="dashboard-special-center" style="margin-bottom:30px;">

                    <div class="box-activity">
                    
                        <div class="detail-article">
                        
                            <div class="theheader">
                                <div class="title-article"><?php echo $D->article->title; ?></div>
                                
                                <div class="postedin"><?php echo($this->lang('global_txt_posted_in').' '.$D->category_article); ?></div>
                                
                                <div class="summary-article"><?php echo $D->article->summary; ?></div>
                                
                                <div class="theuser">
                                    <div class="theavatar"><a href="<?php echo $K->SITE_URL.$D->writer_username?>" rel="phantom-all" target="dashboard-main-area"><img src="<?php echo $D->url_avatar?>" alt=""></a></div>
                                    <div class="theinfo">
                                        <div class="thename"><a href="<?php echo $K->SITE_URL.$D->writer_username?>" rel="phantom-all" target="dashboard-main-area"><?php echo $D->writer_a; ?></a></div>
                                        <div class="thefriends"><?php echo($D->num_friends_a)?> <?php echo($D->num_friends_a == 1 ? $this->lang('global_txt_friend') : $this->lang('global_txt_friends')); ?></div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                
                            </div>    
                            
                            <div class="thephoto">
                                <a href="<?php echo $K->SITE_URL?>#" class="zoomeer-basic" data-image="<?php echo $D->article->photo_max; ?>">
                                <img src="<?php echo $D->article->photo_normal; ?>" alt="">
                                </a>
                            </div>  
                            
                            <div class="thebody">
                                <div class="thecontent"><?php echo $D->article->text_article; ?></div>
                            </div>                   
                        
                        </div>
                    
                    </div>


                </div>
                
                
                <div id="dashboard-special-right">
                    <div class="box-activity">
                    
                        <div class="sugestion-articles">
                        
                            <div class="title-bar"><?php echo $this->lang('global_txt_read_more'); ?></div>
                            
                            <div class="the-body">
                            
                                <?php if (empty($D->html_sugestion)) { ?> 
                                <div class="sempty"><?php echo $this->lang('global_txt_no_items'); ?></div>
                                
                                <?php } else { ?>
                                
                                <div><?php echo $D->html_sugestion; ?></div>
                                
                                <?php } ?>

                            
                            </div>
                        
                        
                        </div>
                        
                    </div>
                

                </div>




                <div class="clear"></div>

                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>

                <script>
                
                var _menu_resp_dashboard = stripslashes('<?php echo strJS(cutLineJump($D->mini_card_user))?>') + stripslashes('<?php echo strJS(cutLineJump($D->dashboard_menu_responsive))?>') + '<div class="mrg10B"></div>';

                markMenuLeft('dashboard');
                makeMenuResp('dashboard');

                </script>

                <!--DASHBOARD-->