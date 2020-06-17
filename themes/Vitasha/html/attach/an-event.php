<div class="the_event_in_post">

    <div class="inside-ev-p">

        <?php if (!empty($D->cover_event)) { ?>
        <a href="<?php echo $D->url_event; ?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>>
        <div class="the-avat" style="background-image:url(<?php echo $D->cover_event;?>);"></div>
        </a>
        <?php } ?>
        
        <div class="space-info">
        
            <div class="thearea1">
                <div class="themonth"><?php echo $D->themonth_s; ?></div>
                <div class="thenumber"><?php echo $D->theday_s; ?></div>
            </div>
            
            <div class="thearea2">
                <div class="thetitle"><a href="<?php echo $D->url_event; ?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><?php echo $D->title_event; ?></a></div>
                <div><span class="thedate"><?php echo $D->date_of_event; ?></span></div>
                
                <div class="themore">
                    <span><?php echo $D->going ?> <?php echo $this->lang('global_event_txt_going')?></span> &#8226; 
                    <span><?php echo $D->interested ?> <?php echo $this->lang('global_event_txt_interested')?></span>
                </div>

            </div>
            
            <div class="clear"></div>
            
        </div>
    
    
    </div>



</div>