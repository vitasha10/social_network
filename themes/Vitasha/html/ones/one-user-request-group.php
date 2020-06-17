<div id="member-<?php echo $D->code_user?>" class="oneusermin">

    <div class="avatar" id="a-rq-<?php echo $D->code_user?>" onmouseout="ignoreItemCard()" onmouseover="itemCard(0, 'a-rq-<?php echo $D->code_user?>', '<?php echo $D->code_user?>', 0)"><a href="<?php echo $K->SITE_URL.$D->username_user?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><img src="<?php echo $D->avatar?>"></a></div>

    <div class="info">

        <div class="name">

            <span onmouseout="ignoreItemCard()" onmouseover="itemCard(1, 'n-rq-<?php echo $D->code_user?>', '<?php echo $D->code_user?>', 0)" id="n-rq-<?php echo $D->code_user?>" class="link link-blue"><a href="<?php echo $K->SITE_URL.$D->username_user?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><?php echo $D->name_user?></a></span>        

        </div>

        <div class="moreinfo">

            <div class="mrg5T">

                <div id="ok-request-<?php echo $D->code_user?>" class="hide"><img src="<?php echo getImageTheme('ok-request-group.png')?>"></div>

                <div id="actions-in-request-<?php echo $D->code_user?>">

                    <span id="action-approve-<?php echo $D->code_user?>" class="my-btn my-btn-small my-btn-blue"><?php echo $this->lang('setting_group_requests_approve')?></span>

                    <span id="action-decline-<?php echo $D->code_user?>" class="link link-grey"><?php echo $this->lang('setting_group_requests_decline')?></span>

                </div>

            </div>        

        </div>

    </div>

    <script>
        $('#action-approve-<?php echo $D->code_user?>').click(function(e){
            e.preventDefault();
            approveRequestGroup('<?php echo $D->code_user?>', '<?php echo $D->codegroup?>');
        });

        $('#action-decline-<?php echo $D->code_user?>').click(function(e){
            e.preventDefault();
            declineRequestGroup('<?php echo $D->code_user?>', '<?php echo $D->codegroup?>');
        });
    </script>

</div>