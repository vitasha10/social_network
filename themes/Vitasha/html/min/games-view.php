               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>
               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

               <link rel="stylesheet" href="<?php echo $K->SITE_URL.'themes/'.$K->THEME?>/css/fullscreen.css" type="text/css" media="screen">
               
                <div id="dashboard-one-space">

                    <div class="box-white">
                        <div class="box-white-header-clean">

                            <div class="ico"><img src="<?php echo getImageTheme('i-m-games.png'); ?>"></div>
                            <div class="title withico"><?php echo $this->lang('dashboard_games_title'); ?></div>

                            <div class="clear"></div>

                        </div>
                    
                        <div class="box-white-body">
                            <div id="space-name-game">
                                <div id="thumbnail"><img src="<?php echo $K->STORAGE_URL_GAMES.$D->game->thumbnail; ?>" alt=""></div>
                                <div id="name"><?php echo $D->game->name; ?></div>
                                <div id="author" class="link link-grey"><a href="<?php echo $D->game->urlowner; ?>" target="_blank"><?php echo $this->lang('dashboard_games_autor'); ?></a></div>
                                <div class="clear"></div>
                            </div>
                            
                            <div class="embed-game">
                                <iframe id="frame-game" src="<?php echo $D->game->urlgame; ?>" frameborder="0" allowfullscreen></iframe>
                            </div>
                            <div class="clear"></div>
                            
                            <div id="space-botton-max"><span id="game-fullscreen" class="my-btn my-btn-small"><?php echo $this->lang('dashboard_games_fullscreen')?></span></div>

                        
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
                
               <script src="<?php echo $K->SITE_URL.'themes/'.$K->THEME?>/js/fullscreen.js"></script>

                <!--DASHBOARD-->