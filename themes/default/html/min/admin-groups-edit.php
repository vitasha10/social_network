               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                <div id="admin-main-area">

                    <div class="box-white mrg30B">

                        <div class="box-white-header">

                            <div class="ico"><img src="<?php echo getImageTheme('ico-admin-pages.png')?>"></div>
                            <div class="title"><?php echo $D->title?></div>
                            <div class="clear"></div>

                        </div>

                        <div class="box-white-body">

                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_groups_edit_block_general_title')?></div>

                                <form id="form1" name="form1" method="post" action="">

                                <div class="form-block">
                                    <label for="titlegroup"><?php echo $this->lang('admin_groups_edit_block_txt_title')?>:</label>
                                    <input name="titlegroup" type="text" id="titlegroup" placeholder="<?php echo $this->lang('admin_groups_edit_block_alt_title')?>" class="form-control" value="<?php echo $D->title?>"/>
                                </div>

                                <div class="form-block">
                                    <label for="urlgroup"><?php echo $this->lang('admin_groups_edit_block_txt_url')?>:</label>
                                    <input name="urlgroup" type="text" id="urlgroup" placeholder="<?php echo $this->lang('admin_groups_edit_block_alt_url')?>" class="form-control" value="<?php echo $D->username?>"/>
                                </div>

                                <div class="form-block">
                                    <label for="descriptiongroup"><?php echo $this->lang('admin_groups_edit_block_txt_description')?>:</label>
                                    <textarea name="descriptiongroup" type="text" id="descriptiongroup" placeholder="<?php echo $this->lang('admin_groups_edit_block_alt_description')?>" class="form-control"/></textarea>
                                    <script>$('#descriptiongroup').val(stripslashes('<?php echo strJS($D->about)?>'));</script>
                                </div>

                                <div class="form-block">
                                    <label for="privacygroup"><?php echo $this->lang('admin_groups_edit_block_txt_privacy')?>:</label>
                                    <select name="privacygroup" id="privacygroup" class="form-control" onchange="loadDetails(this.value, '#msgprivacy');">
                                    <option value="0" <?php echo($D->privacy == 0 ?'selected="selected"' : '');?>><?php echo $this->lang('admin_groups_edit_block_txt_public')?></option>
                                    <option value="1" <?php echo($D->privacy == 1 ?'selected="selected"' : '');?>><?php echo $this->lang('admin_groups_edit_block_txt_closed')?></option>
                                    <option value="2" <?php echo($D->privacy == 2 ?'selected="selected"' : '');?>><?php echo $this->lang('admin_groups_edit_block_txt_secret')?></option>
                                    </select>
                                    <div id="msgprivacy" class="mrg5T"></div>
                                </div>

                                <div id="msgerror1" class="alert alert-red hide"></div>
                                <div id="msgok1" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave1" id="bsave1" value="<?php echo $this->lang('admin_txt_save_changes')?>" class="my-btn my-btn-blue"/></div>

                                </form>

                            </div>

                        </div>

                    </div>     

                </div>

                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>

<script>

    var _menu_resp_admin = stripslashes('<?php echo strJS(cutLineJump($D->admin_menu_title))?>') + stripslashes('<?php echo strJS(cutLineJump($D->admin_menu_responsive))?>') + '<div class="mrg10B"></div>';

    var idg = <?php echo $D->idgroup?>;

    var txt_error_option = stripslashes('<?php echo strJS($this->lang('admin_txt_must_choose_option'))?>');
    var txt_enter_title = stripslashes('<?php echo strJS($this->lang('admin_groups_edit_block_error_entertitle'))?>');
    var txt_enter_url = stripslashes('<?php echo strJS($this->lang('admin_groups_edit_block_error_enterurl'))?>');
    var txt_url_invalid = stripslashes('<?php echo strJS($this->lang('admin_groups_edit_block_error_urlnovalid'))?>');
    var txt_enter_description = stripslashes('<?php echo strJS($this->lang('admin_groups_edit_block_error_enterdescription'))?>');

    function loadDetails(idmsg, divmsg) {
        idmsg = parseInt(idmsg);
        switch (idmsg) {
            case 0:
                $(divmsg).html('<?php echo $this->lang('dashboard_groups_create_txt_msgpublic');?>');
                break;	
            case 1:
                $(divmsg).html('<?php echo $this->lang('dashboard_groups_create_txt_msgclosed');?>');
                break;	
            case 2:
                $(divmsg).html('<?php echo $this->lang('dashboard_groups_create_txt_msgsecret');?>');
                break;
        }
    }

    loadDetails(<?php echo $D->privacy?>, '#msgprivacy');

    $('#bsave1').click(function(e){
        e.preventDefault();
        updateGroupGeneral('#msgerror1', '#msgok1', '#bsave1');
    });

    markMenuLeft('admin');
    makeMenuResp('admin');

</script>