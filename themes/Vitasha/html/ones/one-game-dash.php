<div class="one-item-game" id="itemgame-<?php echo $D->game->code; ?>">
    
    <div class="container-info">
        <a href="<?php echo $D->game->url; ?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>>
        <div class="container-image">
            <div class="theimage"><img src="<?php echo $K->STORAGE_URL_GAMES.$D->game->thumbnail; ?>" alt=""></div>
        </div>  
        </a>  
        <div class="container-name">
            <div style="font-size:12px; font-weight:bold; line-height:16px;"><?php echo($D->game->name); ?></div>
            <div class="link link-grey"><span class="author"><a href="<?php echo $D->game->url_owner?>" target="_blank"><?php echo $this->lang('dashboard_games_autor');?></a></span></div>
        </div>

    </div>

</div>