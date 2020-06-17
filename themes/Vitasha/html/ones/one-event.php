<div id="event_<?php echo $D->event->code?>" class="oneeevent <?php echo ($D->event_last ? 'last' : ''); ?>">

    <div class="oneeevent-actions">

        <a href="<?php echo $K->SITE_URL.'myevents/edit/e:'.$D->event->code?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="dashboard-main-area-right"' : '') ?>><div class="my-btn my-btn-blue"><?php echo $this->lang('dashboard_myevents_bedit')?></div></a>

    </div>

    <div class="oneeevent-info">

        <div class="event_title"><span class="link link-blue"><a href="<?php echo $K->SITE_URL.'event/'.$D->event->code?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><?php echo $D->event->title; ?></a></span></div>

        <div class="event_type"><?php echo ($D->event->privacy == 1 ? $this->lang('dashboard_myevents_txt_private') : $this->lang('dashboard_myevents_txt_public'))?></div>

    </div>

    <div class="clear"></div>

</div>