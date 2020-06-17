        <?php if(isset($D->js_script_max)) echo $D->js_script_max;?>
        <div id="<?php echo $D->id_container?>-main-area">
            <div id="posts-main">
            
                <?php if (!$D->post_is_showeable) { ?>
                
                <div class="box-white">
                    <div class="mrg30T mrg30B"><p class="centered"><?php echo $this->lang('activity_txt_no_permission')?></p></div>
                </div>
                
                <?php } else { ?>
            
                <div id="posts-main-left">
                    <img src="<?php echo $D->the_avatar_page?>">
                </div>        

                <div id="posts-main-right">
                
                    <?php $this->load_template('min/page-photo.php'); ?>

                </div>
                
                <div class="clear"></div>
                
                <?php } ?>

            </div>

        </div>
