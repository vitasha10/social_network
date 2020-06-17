               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                <div id="admin-main-area">

                    <div class="box-white">

                        <div class="box-white-header">
                            <div class="ico"><img src="<?php echo getImageTheme('ico-admin-currencies.png')?>"></div>
                            <div class="title"><?php echo $this->lang('admin_currencies_add_title')?></div>
                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_currencies_add_title_new')?></div>

                                <form id="form1" name="form1" method="post" action="">

                                <div class="form-block">
                                    <label for="namecurrency"><?php echo $this->lang('admin_currencies_add_name')?></label>
                                    <input name="namecurrency" type="text" id="namecurrency" placeholder="<?php echo $this->lang('admin_currencies_add_name')?>" class="form-control"/>
                                </div>

                                <div class="form-block">
                                    <label for="codecurrency"><?php echo $this->lang('admin_currencies_add_code')?></label>
                                    <input name="codecurrency" type="text" id="codecurrency" placeholder="<?php echo $this->lang('admin_currencies_add_code')?>" class="form-control"/>
                                </div>
                                
                                <div class="form-block">
                                    <label for="symbolcurrency"><?php echo $this->lang('admin_currencies_add_symbol')?></label>
                                    <input name="symbolcurrency" type="text" id="symbolcurrency" placeholder="<?php echo $this->lang('admin_currencies_add_symbol')?>" class="form-control"/>
                                </div>

                                <div id="msgerror1" class="alert alert-red hide"></div>
                                <div id="msgok1" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave1" id="bsave1" value="<?php echo $this->lang('admin_currencies_add_bsave')?>" class="my-btn my-btn-blue"/></div>

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

    var txt_error_name = stripslashes('<?php echo strJS($this->lang('admin_currencies_add_error_name'))?>');
    var txt_error_code = stripslashes('<?php echo strJS($this->lang('admin_currencies_add_error_code'))?>');
    var txt_error_symbol = stripslashes('<?php echo strJS($this->lang('admin_currencies_add_error_symbol'))?>');

    $('#bsave1').click(function(e){
        e.preventDefault();
        createCurrency('#msgerror1', '#msgok1', '#bsave1');
    });

    markMenuLeft('admin');
    makeMenuResp('admin');
    
</script>