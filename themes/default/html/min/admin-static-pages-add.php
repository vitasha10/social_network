               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                <div id="admin-main-area">

                    <div class="box-white">

                        <div class="box-white-header">
                            <div class="ico"><img src="<?php echo getImageTheme('ico-admin-static-pages.png')?>"></div>
                            <div class="title"><?php echo $this->lang('admin_static_pages_add_title')?></div>
                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_static_pages_add_title_new')?></div>

                                <form id="form1" name="form1" method="post" action="">

                                <div class="form-block">
                                    <label for="urlstatic"><?php echo $this->lang('admin_static_pages_add_url')?></label>
                                    <input name="urlstatic" type="text" id="urlstatic" placeholder="<?php echo $this->lang('admin_static_pages_add_url')?>" class="form-control"/>
                                </div>

                                <div class="form-block">
                                    <label for="titlestatic"><?php echo $this->lang('admin_static_pages_add_thetitle')?></label>
                                    <input name="titlestatic" type="text" id="titlestatic" placeholder="<?php echo $this->lang('admin_static_pages_add_thetitle')?>" class="form-control"/>
                                </div>

                                <div class="form-block">
                                    <label for="htmlstatic"><?php echo $this->lang('admin_static_pages_add_html')?></label>
                                    <textarea name="htmlstatic" type="text" id="htmlstatic" placeholder="<?php echo $this->lang('admin_static_pages_add_html')?>" class="form-control"/></textarea>
                                </div>

                                <div class="form-block">
                                    <label for="infootstatic"><?php echo $this->lang('admin_static_pages_add_infoot')?></label>
                                    <select name="infootstatic" id="infootstatic" class="form-control">
                                        <option value="0"><?php echo $this->lang('admin_static_pages_add_infoot_no')?></option>
                                        <option value="1"><?php echo $this->lang('admin_static_pages_add_infoot_yes')?></option>
                                    </select>
                                </div>

                                <div id="msgerror1" class="alert alert-red hide"></div>
                                <div id="msgok1" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave1" id="bsave1" value="<?php echo $this->lang('admin_static_pages_add_bsubmit')?>" class="my-btn my-btn-blue"/></div>

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

    var txt_error_url = stripslashes('<?php echo strJS($this->lang('admin_static_pages_add_error_url'))?>');
    var txt_error_title = stripslashes('<?php echo strJS($this->lang('admin_static_pages_add_error_thetitle'))?>');
    var txt_error_html = stripslashes('<?php echo strJS($this->lang('admin_static_pages_add_error_html'))?>');

    $('#bsave1').click(function(e){
        e.preventDefault();
        createStaticPage('#msgerror1', '#msgok1', '#bsave1');
    });

    markMenuLeft('admin');
    makeMenuResp('admin');
    
</script>