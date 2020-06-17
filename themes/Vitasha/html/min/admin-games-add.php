               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                <div id="admin-main-area">

                    <div class="box-white">

                        <div class="box-white-header">
                            <div class="ico"><img src="<?php echo getImageTheme('ico-admin-games.png')?>"></div>
                            <div class="title"><?php echo $this->lang('admin_games_add_title')?></div>
                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <div class="areablock space-in-admin">

                                <div class="subtitle"><?php echo $this->lang('admin_games_add_title_new')?></div>

                                <form id="form1" name="form1" method="post" action="">

                                <div class="form-block">
                                    <label for="namegame"><?php echo $this->lang('admin_games_add_name')?></label>
                                    <input name="namegame" type="text" id="namegame" placeholder="<?php echo $this->lang('admin_currencies_add_name')?>" class="form-control"/>
                                </div>

                                <div class="form-block">
                                    <label for="urlgame"><?php echo $this->lang('admin_games_add_url_game')?></label>
                                    <input name="urlgame" type="text" id="urlgame" placeholder="<?php echo $this->lang('admin_games_add_url_game')?>" class="form-control"/>
                                </div>
                                
                                <div class="form-block">
                                    <label for="urlowner"><?php echo $this->lang('admin_games_add_url_owner')?></label>
                                    <input name="urlowner" type="text" id="urlowner" placeholder="<?php echo $this->lang('admin_games_add_url_owner')?>" class="form-control"/>
                                </div>
                                
                                <div class="form-block">
                                    <label for="imageupload"><?php echo $this->lang('admin_games_add_thumbnail')?> <span style="font-weight:normal;">(80 x 80 px)</span>:</label>
                                    <div id="imageupload" class="space_upload">
                                        <div id="imagepreview"><div class="msgupload"><?php echo $this->lang('admin_games_add_thumbnail_click')?></div></div>

                                    </div>
                                    
                                    <input type="file" accept="image/*" class="hide" id="imagenfile" name="imagenfile">
                                    
                                    <script>
                                    
                                    $('#imageupload')[0].ondragover = function(e) {
                                        e.stopPropagation();
                                        e.preventDefault();
                                        $('#imageupload').addClass('hover');
                                    };
                                    
                                    $('#imageupload')[0].ondragleave = function(e) {
                                        e.stopPropagation();
                                        e.preventDefault();
                                        $('#imageupload').removeClass('hover');
                                        return false;
                                    };
                                    
                                    $('#imageupload')[0].ondrop = function(e) {
                                        e.stopPropagation();
                                        e.preventDefault();
                                        $('#imageupload').removeClass('hover');
                                        var dt = e.dataTransfer;
                                        var files = dt.files;
                                        handleFiles(files, 'imagepreview', 1);
                                        $('.msgupload').hide();
                                    };
                                    
                                    $('#imageupload').click(function(e){
                                        $("#imagenfile").click();
                                    });
                                    
                                    $("#imagenfile").change(function(e) {
                                        $("#imagepreview").html("<img src='" + window.URL.createObjectURL(this.files[0]) + "' alt=''>")
                                    });
                                    
                                    </script>
                                </div>


                                <div id="msgerror1" class="alert alert-red hide"></div>
                                <div id="msgok1" class="alert alert-green hide"></div>
                                <div><input type="submit" name="bsave1" id="bsave1" value="<?php echo $this->lang('admin_games_add_bsave')?>" class="my-btn my-btn-blue"/></div>

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

    var txt_error_name = stripslashes('<?php echo strJS($this->lang('admin_games_add_error_name'))?>');
    var txt_error_url_game = stripslashes('<?php echo strJS($this->lang('admin_games_add_error_url_game'))?>');
    var txt_error_url_owner = stripslashes('<?php echo strJS($this->lang('admin_games_add_error_url_owner'))?>');
    var txt_error_thumbnail = stripslashes('<?php echo strJS($this->lang('admin_games_add_error_url_thumbnail'))?>');
    var txt_error_thumbnail_format = stripslashes('<?php echo strJS($this->lang('admin_games_add_error_thumbnail_format'))?>');

    $('#bsave1').click(function(e){
        e.preventDefault();
        createGame('#msgerror1', '#msgok1', '#bsave1');
    });

    markMenuLeft('admin');
    makeMenuResp('admin');
    
</script>