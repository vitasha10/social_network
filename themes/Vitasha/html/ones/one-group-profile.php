<div id="group-<?php echo $D->p_group->code?>" class="onegroup_profile">

    <div class="avatar">
<img class="avatmember" src="<?php echo $D->arr_avat[0]; ?>"><img class="avatmember" src="<?php echo $D->arr_avat[1]; ?>"><img class="avatmember" src="<?php echo $D->arr_avat[2]; ?>"><img class="avatmember" src="<?php echo $D->arr_avat[3]; ?>">
    </div>

    <div style="overflow:hidden;">
        <div class="info">
            <div class="ghost"></div><div class="name">
                <span onmouseout="ignoreItemCard()" onmouseover="itemCard(1, 'n-rq-<?php echo $D->p_group->code?>', '<?php echo $D->p_group->code?>', 2)" id="n-rq-<?php echo $D->p_group->code?>" class="link link-blue"><a href="<?php echo $K->SITE_URL.$D->p_group->guname?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><?php echo $D->p_group->title?></a></span>
                <div style="font-size:13px; font-weight:normal; color:#4F4F4F;">
                    <?php echo $D->p_group->nummembers; ?> <?php echo($D->p_group->nummembers == 1 ? $this->lang('profile_groups_txt_member') : $this->lang('profile_groups_txt_members')); ?>
                </div>
            </div>
    
        </div>
    </div>

    <div class="clear"></div>

</div>

<?php if ($D->count_f % 2 == 0) { ?>

<div class="clear"></div>

<?php } ?>