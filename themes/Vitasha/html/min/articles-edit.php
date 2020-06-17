               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

               <script src="<?php echo $K->SITE_URL.'themes/'.$K->THEME?>/js/tinymce/tinymce.min.js"></script>
               
                <div id="dashboard-main-center">

                    <div class="box-white" style="margin-bottom:60px;">
                        <div class="box-white-header">
                            <div class="title small"><?php echo $this->lang('dashboard_articles_edit_title'); ?></div>

                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <div id="form01" class="mrg30B">
                                <form id="form1" name="form1" method="post" action="">
                                
                                <div class="form-block">
                                    <label for="titlearticle"><?php echo $this->lang('dashboard_articles_publish_txt_title')?>:</label>
                                    <input name="titlearticle" type="text" id="titlearticle" value="<?php echo $D->title; ?>" placeholder="<?php echo $this->lang('dashboard_articles_publish_txt_title')?>" class="form-control"/>
                                </div>
                                
                                <div class="form-block">
                                    <label for="categoryarticle"><?php echo $this->lang('dashboard_articles_publish_txt_category')?>:</label>
                                    <select name="categoryarticle" id="categoryarticle" class="form-control" onchange="loadsubcategoryarticles(this.value, <?php echo $D->idcategory?>, '<?php echo $this->lang('dashboard_articles_publish_txt_choosesubcategory')?>','#subcategoryarticle');"></select>
                                </div>

                                <div class="form-block">
                                    <label for="subcategoryarticle"><?php echo $this->lang('dashboard_articles_publish_txt_subcategory')?>:</label>
                                    <select name="subcategoryarticle" id="subcategoryarticle" class="form-control"></select>
                                </div>

                                <div class="form-block">
                                    <label for="summaryarticle"><?php echo $this->lang('dashboard_articles_publish_txt_summary')?>:</label>
                                    <textarea name="summaryarticle" type="text" id="summaryarticle" placeholder="<?php echo $this->lang('dashboard_articles_publish_txt_summary')?>" class="form-control"><?php echo $D->summary; ?></textarea>

                                </div>

                                <div class="form-block">
                                    <label for="imageupload"><?php echo $this->lang('dashboard_articles_publish_txt_image')?>:</label>
                                    <div id="imageupload" class="space_upload">
                                        <?php if (empty($D->photo)) { ?>
                                        <div id="imagepreview"><div class="msgupload"><?php echo $this->lang('dashboard_articles_publish_txt_upload_image')?></div></div>
                                        <?php } else {?>
                                        <div id="imagepreview"><img src="<?php echo $K->STORAGE_URL_ARTICLES.$D->photo.'?r:'.getCode(7, 1); ?>" alt=""></div>
                                        <?php } ?>

                                    </div>
                                    
                                    <input type="file" accept="image/*" class="hide" id="imagenfile" name="imagenfile">
                                    <input id="changeimg" name="changeimg" value="0" type="hidden">
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
                                        result = handleFiles(files, 'imagepreview', 1);
                                        if (result) $('#changeimg').val('1'); 
                                        $('.msgupload').hide();
                                    };
                                    
                                    $('#imageupload').click(function(e){
                                        $("#imagenfile").click();
                                    });
                                    
                                    $("#imagenfile").change(function(e) {
                                        $("#imagepreview").html("<img src='" + window.URL.createObjectURL(this.files[0]) + "' alt=''>");
                                        $('#changeimg').val('1');
                                    });
                                    
                                    </script>
                                </div>
                                
                                <div class="form-block">
                                    <label for="contentarticle"><?php echo $this->lang('dashboard_articles_publish_txt_content')?>:</label>
                                    <textarea name="contentarticle" type="text" rows="2" id="contentarticle" class="form-control"><?php echo $D->content; ?></textarea>
                                    
                                <script>
                                    
                                
                                    tinymce.init({
                                        selector:'#contentarticle',
                                        plugins: "hr link autolink lists",
                                        convert_urls: false,
                                        relative_urls: false,
                                        remove_script_host: false,
                                        media_live_embeds: true,
                                        media_dimensions: false,
                                        media_poster: false,
                                        media_alt_source: false,
                                        default_link_target: "_blank",
                                        target_list: false,
                                        link_title: false,
                                        menubar: false,
                                        height : 200,
                                        toolbar: "bold italic underline alignleft aligncenter alignright | bullist numlist | link | hr"
                                        
                                    });
                                </script>

                                </div>

                                <div class="mrg20T">
                                    <div id="msgerror" class="alert alert-red hide"></div>
                                    <span><input type="submit" name="bsave" id="bsave" value="<?php echo $this->lang('dashboard_articles_edit_bupdate')?>" class="my-btn my-btn-blue"/></span> &nbsp; <span class="link link-blue"><a href="<?php echo $K->SITE_URL?>articles" rel="phantom" target="dashboard-main-area-right"><?php echo $this->lang('dashboard_articles_edit_bcancel')?></a></span> <span id="preload-publish" class="hide"><img src="<?php echo getImageTheme('preload.gif'); ?>" alt=""></span>
                                </div>

                              </form>

                                <script>
                                
                                idcategory = <?php echo $D->idcategory?>;
                                idsubcategory = <?php echo $D->idsubcategory?>;
                                var msgccategories = stripslashes('<?php echo strJS($this->lang('dashboard_articles_publish_txt_choosecategory'))?>');
                                var msgcsubcategories = stripslashes('<?php echo strJS($this->lang('dashboard_articles_publish_txt_choosesubcategory'))?>');
                                loadcategoryarticles(idcategory, msgccategories, msgcsubcategories, '#categoryarticle', '#subcategoryarticle');
                                loadsubcategoryarticles(idcategory, idsubcategory, msgcsubcategories, '#subcategoryarticle');

                                var txt_error_title = stripslashes('<?php echo strJS($this->lang('dashboard_articles_publish_error_title'))?>');
                                var txt_error_category = stripslashes('<?php echo strJS($this->lang('dashboard_articles_publish_error_category'))?>');
                                var txt_error_subcategory = stripslashes('<?php echo strJS($this->lang('dashboard_articles_publish_error_subcategory'))?>');
                                var txt_error_summary = stripslashes('<?php echo strJS($this->lang('dashboard_articles_publish_error_summary'))?>');
                                var txt_error_content = stripslashes('<?php echo strJS($this->lang('dashboard_articles_publish_error_content'))?>');
                                var txt_error_image = stripslashes('<?php echo strJS($this->lang('dashboard_articles_publish_error_image'))?>');
                                var txt_error_formatimage = stripslashes('<?php echo strJS($this->lang('dashboard_articles_publish_error_formatimage'))?>');

                                var codart = '<?php echo $D->codearticle; ?>';
                                $('#bsave').click(function(e){
                                    e.preventDefault();
                                    updateArticle('#msgerror', '#bsave');
                                });

                                </script>

                            </div>


                            <div class="mrg30B"></div>
                            <div id="msgerror2" class="alert alert-red hide"></div>
                            <div><span id="linkdeletearticle" class="link link-blue"><?php echo $this->lang('dashboard_articles_edit_bdelete')?></span></div>
                            
                            <script>
                            
                            var msg_delete_article = stripslashes('<?php echo $this->designer->boxConfirm($this->lang('dashboard_articles_delete_alert_title'), $this->lang('dashboard_articles_delete_alert_message'), $this->lang('dashboard_articles_delete_alert_bdelete'), $this->lang('dashboard_articles_delete_alert_bcancel'))?>');
                                
                            $('#linkdeletearticle').click(function(e){
                                e.preventDefault();
                                _confirm(msg_delete_article, nothign, deleteArticle, '#msgerror2');
                            });
                            </script>
                            
                            <div class="mrg30B"></div>

                        </div>

                    </div>

                </div>

                <div id="dashboard-main-right">

                    <?php $this->load_template('_dashboard-right.php'); ?>

                </div>

                <div class="clear"></div>

                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>
                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>
                <?php } ?>

                <script>
                
                var _menu_resp_dashboard = stripslashes('<?php echo strJS(cutLineJump($D->mini_card_user))?>') + stripslashes('<?php echo strJS(cutLineJump($D->dashboard_menu_responsive))?>') + '<div class="mrg10B"></div>';

                markMenuLeft('dashboard');
                makeMenuResp('dashboard');

                </script>

                <!--DASHBOARD-->