<a href="<?php echo $D->st_user_url?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?> class="undecorated">
<div class="oneitem-result-search">
    <div class="avatar"><img src="<?php echo $D->st_user_avatar?>"></div>
    <div class="info">
        <div class="info-cell">

            <div class="spacename">
                <div class="name"><span class="bold"><?php echo $D->st_user_name?></span></div>
                <div class="numfriends"><?php echo $D->st_user_numfriends?> <?php echo($D->st_user_numfriends == 1 ? $this->lang('global_search_txt_friend') : $this->lang('global_search_txt_friends')); ?></div>
            </div>

        </div>
    </div>
</div>
</a>