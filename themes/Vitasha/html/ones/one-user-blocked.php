<div id="user_blocked_<?php echo $D->user_blocked->user_code?>" class="oneblocked <?php echo ($D->user_blocked_last ? 'last' : ''); ?>">

    <img src="<?php echo $D->user_blocked->avatar?>" class="the_avat">

    <div class="all_info">

        <div class="oneblocked-actions">

            <span id="bunblock_<?php echo $D->user_blocked->user_code?>" class="my-btn"><?php echo($this->lang('setting_blocked_txt_unblock'))?></span>

        </div>

        <div class="oneblocked-info">

            <div class="user_name"><span class="blue"><?php echo($D->user_blocked->firstname.' '.$D->user_blocked->lastname)?></span></div>

            <div class="user_friends"><?php echo $D->user_blocked->num_friends?> <?php echo ($D->user_blocked->num_friends == 1 ? strtolower($this->lang('global_txt_friend')) : strtolower($this->lang('global_txt_friends')))?></div>

        </div>

        <div class="clear"></div>

    </div>

    <div class="clear"></div>

</div>

<div class="clear"></div>

<script>

$('#bunblock_<?php echo $D->user_blocked->user_code?>').click(function(e){
    e.preventDefault();
    closeEmerged();    
    _confirm(stripslashes('<?php echo $this->designer->boxConfirm($this->lang('setting_blocked_txt_confirm'), $this->lang('setting_blocked_txt_confirm_q', array('#NAME_USER#'=>($D->user_blocked->firstname.' '.$D->user_blocked->lastname))), $this->lang('setting_blocked_txt_confirm_bconfirm'), $this->lang('setting_blocked_txt_confirm_bcancel'))?>'), nothign, unBlockUser, '<?php echo $D->user_blocked->user_code?>');
});
</script>
