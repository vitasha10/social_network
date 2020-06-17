               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>
               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>
                <div id="dashboard-one-space">

                    <div class="box-white">
                        <div class="box-white-header-clean">

                            <div class="ico"><img src="<?php echo getImageTheme('i-m-library.png'); ?>"></div>
                            <div class="title withico"><?php echo $this->lang('dashboard_library_title'); ?></div>
                            
                            <div class="some-right withico"><span><img style="width:11px; height:11px;" src="<?php echo getImageTheme('ico-glass.png'); ?>" alt=""></span> <span class="link link-blue bold" id="link-filter"><?php echo $this->lang('dashboard_library_txt_filter')?></a></span></div>

                            <div class="clear"></div>

                        </div>

                        <div class="box-white-body <?php echo($D->open_filter ? '' : 'hide')?>" id="space-filter">

                            <div>
                                
                                <div class="form-block library-categories">
                                    <label for="categorylibrary"><?php echo $this->lang('dashboard_library_txt_categories')?>:</label>
                                    <select name="categorylibrary" id="categorylibrary" class="form-control" onchange="loadsubcategorylibrary(this.value, <?php echo $D->m_category?>, '<?php echo $this->lang('dashboard_library_txt_all')?>','#subcategorymarket');"></select>
                                </div>
                                <div class="form-block mkplace-categories">
                                    <label for="subcategorylibrary"><?php echo $this->lang('dashboard_library_txt_subcategories')?>:</label>
                                    <select name="subcategorylibrary" id="subcategorylibrary" class="form-control"></select>
                                </div>

                                <div class="clear"></div>
                                
                                <div class="centered" style="margin-top:10px;"><span id="bfilter" class="my-btn my-btn-small"><?php echo $this->lang('dashboard_library_btn_filter')?></span></div>
                                
                                
                                
                            </div>
                            
                    <script>
                    
                        idcategory = <?php echo $D->l_category?>;
                        idsubcategory = <?php echo $D->l_subcategory?>;
                        var msgccategories = stripslashes('<?php echo strJS($this->lang('dashboard_library_txt_all'))?>');
                        var msgcsubcategories = stripslashes('<?php echo strJS($this->lang('dashboard_library_txt_all'))?>');
                        loadcategorylibrary(idcategory, msgccategories, msgcsubcategories, '#categorylibrary', '#subcategorylibrary');
                        loadsubcategorylibrary(idcategory, idsubcategory, msgcsubcategories, '#subcategorylibrary');
                        
                    </script>


                        </div>
                        
                        <script>
                        var filter_open = 0;
                        $('#link-filter').click(function(){
                            if (filter_open == 0) {
                                $('#space-filter').slideDown('slow');
                                filter_open = 1;
                            } else {
                                $('#space-filter').slideUp('slow');
                                filter_open = 0;
                            }
                            
                        });
                        
                        $('#bfilter').click(function(){
                            cat = $('#categorylibrary').val();
                            subcat = $('#subcategorylibrary').val();
                            if (cat == -1) cat = 'all';
                            if (subcat == -1) subcat = 'all';
                            actionOnClick(_SITE_URL + 'library/c:' + cat + '/s:' + subcat, 'dashboard-main-area-right', 'min');
                        });
                        </script>
                        

                    </div>


                                            
                    <?php if (empty($D->the_list_items)) { ?>
                                            
                    <div class="box-activity-no-item" style="margin-top:20px;">
                        <div class="inside-text">
                            <?php echo $this->lang('dashboard_library_empty'); ?>
                        </div>
                    </div>
                                                    
                    <?php } else {?>
                    
                    <div id="list-items" class="listlibrary">
                        <?php echo $D->the_list_items ?>
                    </div>
                    
                    <?php } ?>
                    
                    <?php if ($D->show_more) { ?>
                    <div id="space_more" class="centered">
                        <span class="my-btn" id="linkmore"><?php echo $this->lang('global_txt_showmore')?></span>
                        <input type="hidden" id="activities_place" name="activities_place" value="library" />
                        <input type="hidden" id="activity_page" name="activity_page" value="1" />
                    </div>
                    
                    <script>
                        $('#linkmore').click(function() {
                            moreItems();
                        });
                    </script>
                    
                    <?php } ?>


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