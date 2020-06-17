               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                <div id="admin-main-area">

                    <div class="box-white">

                        <div class="box-white-header">
                            <div class="ico"><img src="<?php echo getImageTheme('ico-admin-timezone.png')?>"></div>
                            <div class="title"><?php echo $this->lang('admin_timezone_title')?></div>
                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_timezone_block_timezone')?></div>

                                <form id="form1" name="form1" method="post" action="">
                                <div class="form-block">
                                    <label for="timezone"><?php echo $this->lang('admin_timezone_block_timezone_foryour')?></label>
                                    <select name="timezone" id="timezone" class="form-control">
                                        <?php foreach($D->menu_timezones as $k=>$v) { ?>
                                        <option value="<?php echo $k ?>" <?php echo($k == $D->the_timezone ? 'selected="selected"' : ''); ?>><?php echo htmlspecialchars($v); ?></option>
                                        <?php } ?>
                                    </select>
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

    var txt_error_option = stripslashes('<?php echo strJS($this->lang('admin_txt_must_choose_option'))?>');

    $('#bsave1').click(function(e){
        e.preventDefault();
        updateTimezone('#msgerror1', '#msgok1', '#bsave1');
    });

    markMenuLeft('admin');
    makeMenuResp('admin');

</script>