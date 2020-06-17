                   <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>
                   
                    <link rel="stylesheet" href="<?php echo $K->SITE_URL.'themes/'.$K->THEME?>/js/mediaelement/mediaelementplayer.min.css" />
                    <link rel="stylesheet" href="<?php echo $K->SITE_URL.'themes/'.$K->THEME?>/js/videojs/video-js.min.css" />

                    <div id="profile-content-area">
                        <div id="profile-content-area-left">

                            <?php $this->load_template('_left-event.php'); ?>

                        </div>
                        <div id="profile-content-area-right">
                        
                        <?php if (!$D->show_activity) { ?>
                        
                            <?php $this->load_template('_restricted-event.php'); ?>
                                                    
                        <?php } else { ?>
                        
                            <?php if (isset($D->view_editor) && $D->view_editor) $this->load_template('_editor.php'); ?>

                            <div id="list-activities">
                                <?php echo $D->the_list_activities ?>
                            </div>
                            <?php echo $D->show_more ?>
                            
                        <?php } ?>

                        </div>

                        <div class="clear"></div>
                        
                    <script>
                        $('video.js_video-js').each(function(){ videojs($(this)[0], {}, function() {}); });
                        $('audio.mep_audio').mediaelementplayer();
                        activeSlimScrollers();
                    </script>

                    </div>
<?php if ($D->_IS_LOGGED) { ?>

<script>
var _menu_resp_dashboard = stripslashes('<?php echo strJS(cutLineJump($D->mini_card_user))?>') + stripslashes('<?php echo strJS(cutLineJump($D->dashboard_menu_responsive))?>') + '<div class="mrg10B"></div>';

$('.action_autosize').each(function(){
    autosize(this);
})                

makeMenuResp('dashboard');

</script>

<?php } ?>

                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>
