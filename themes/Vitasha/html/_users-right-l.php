<div class="box-activity">

    <div class="sugestion-peoples">
    
        <div class="title-bar"><?php echo $this->lang('global_txt_know_people'); ?></div>
        
        <div class="the-body">
        
            <?php if (empty($D->html_know_people)) { ?> 
            
            <div class="theempty"><?php echo $this->lang('global_txt_no_items'); ?></div>
            
            <?php } else { ?>
            
            <div class="list-sug-people">
                <?php echo $D->html_know_people; ?>
            </div>
            
            <?php } ?>

        
        </div>
    
    
    </div>
    
</div>