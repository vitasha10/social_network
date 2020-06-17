               <script>_ID_MENU_LEFT = '<?php echo(isset($D->id_menu) ? $D->id_menu : '')?>';</script>

               <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>
               
               
    <script src="<?php echo $K->SITE_URL.'themes/'.$K->THEME?>/js/datepair/jquery.timepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $K->SITE_URL.'themes/'.$K->THEME?>/js/datepair/jquery.timepicker.css" />

    <script src="<?php echo $K->SITE_URL.'themes/'.$K->THEME?>/js/datepair/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $K->SITE_URL.'themes/'.$K->THEME?>/js/datepair/bootstrap-datepicker.standalone.css" />

    <script src="<?php echo $K->SITE_URL.'themes/'.$K->THEME?>/js/datepair/pikaday.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $K->SITE_URL.'themes/'.$K->THEME?>/js/datepair/pikaday.css" />

    <script src="<?php echo $K->SITE_URL.'themes/'.$K->THEME?>/js/datepair/moment.min.js"></script>
    <script src="<?php echo $K->SITE_URL.'themes/'.$K->THEME?>/js/datepair/site.js"></script>

    <script src="<?php echo $K->SITE_URL.'themes/'.$K->THEME?>/js/datepair/datepair.js"></script>
    <script src="<?php echo $K->SITE_URL.'themes/'.$K->THEME?>/js/datepair/jquery.datepair.js"></script>
    

                <div id="dashboard-main-center">

                    <div class="box-white">
                        <div class="box-white-header">
                            <div class="title"><?php echo $this->lang('dashboard_myevents_edit_title'); ?></div>
                            
                            <div class="some-right"><div><span class="blue">&laquo;</span> <span class="link link-blue"><a href="<?php echo $K->SITE_URL?>myevents" rel="phantom" target="dashboard-main-area-right"><?php echo $this->lang('dashboard_myevents_edit_back')?></a></span></div></div>

                            <div class="clear"></div>
                        </div>

                        <div class="box-white-body">

                            <div id="form01" class="mrg30B">
                                <form id="form1" name="form1" method="post" action="">
                                <div class="form-block">
                                    <label for="titleevent"><?php echo $this->lang('dashboard_myevents_create_txt_name')?>:</label>
                                    <input name="titleevent" type="text" value="<?php echo $D->title?>" id="titleevent" placeholder="<?php echo $this->lang('dashboard_myevents_create_txt_name')?>" class="form-control"/>
                                </div>

                                <div class="form-block">
                                    <label for="locationevent"><?php echo $this->lang('dashboard_myevents_create_txt_location')?>:</label>
                                    <input name="locationevent" type="text" value="<?php echo $D->address?>" id="locationevent" placeholder="<?php echo $this->lang('dashboard_myevents_create_txt_location')?>" class="form-control"/>
                                </div>
                                
                                
                                <div class="form-block" id="alldateandtime">
                                    <div>
                                        <label for="datestart">Start:</label>
                                        <div class="clear"></div>
                                        <input type="text" id="datestart" name="datestart" class="date start form-control p50" value="<?php echo $D->date_start;?>" placeholder="<?php echo $this->lang('dashboard_myevents_create_placeholder_date')?>" />
                                        <input type="text" id="timestart" name="timestart" class="time start form-control p50" value="<?php echo $D->time_start;?>" placeholder="<?php echo $this->lang('dashboard_myevents_create_placeholder_time')?>"/>
                                        <div class="clear"></div>
                                    </div>

                                    <div style="margin-top:10px;">
                                        <label for="dateend">End:</label>
                                        <div class="clear"></div>
                                        <input type="text" id="dateend" name="dateend" class="date end form-control p50" value="<?php echo $D->date_end;?>" placeholder="<?php echo $this->lang('dashboard_myevents_create_placeholder_date')?>" />
                                        <input type="text" id="timeend" name="timeend" class="time end form-control p50" value="<?php echo $D->time_end;?>" placeholder="<?php echo $this->lang('dashboard_myevents_create_placeholder_time')?>"/>
                                        <div class="clear"></div>
                                    </div>
                                    
                                    <script>
                                        $('#alldateandtime .time').timepicker({
                                            'showDuration': true,
                                            'timeFormat': 'g:ia'
                                        });
                        
                                        $('#alldateandtime .date').datepicker({
                                            'format': '<?php echo $this->lang('dashboard_myevents_create_format_date'); ?>',
                                            'autoclose': true
                                        });
                        
                                        $('#alldateandtime').datepair();
                                    </script>

                                </div>
                                
                                

                                <div class="form-block">
                                    <label for="descriptionevent"><?php echo $this->lang('dashboard_myevents_create_txt_description')?>:</label>
                                    <textarea name="descriptionevent" type="text" id="descriptionevent" placeholder="<?php echo $this->lang('dashboard_myevents_create_txt_description')?>" class="form-control"><?php echo $D->description?></textarea>
                                </div>



                                <div class="mrg20T">
                                    <div id="msgerror" class="alert alert-red hide"></div>
                                    <span><input type="submit" name="bsave" id="bsave" value="<?php echo $this->lang('dashboard_myevents_edit_bupdate')?>" class="my-btn my-btn-blue"/></span> <span class="link link-blue"><a href="<?php echo $K->SITE_URL?>myevents" rel="phantom" target="dashboard-main-area-right"><?php echo $this->lang('dashboard_myevents_edit_bcancel')?></a></span>
                                </div>

                              </form>

                                <script>

                                var txt_enter_name = stripslashes('<?php echo strJS($this->lang('dashboard_myevents_create_error_name'))?>');
                                var txt_enter_location = stripslashes('<?php echo strJS($this->lang('dashboard_myevents_create_error_location'))?>');
                                var txt_enter_datestart = stripslashes('<?php echo strJS($this->lang('dashboard_myevents_create_error_datestart'))?>');
                                var txt_enter_timestart = stripslashes('<?php echo strJS($this->lang('dashboard_myevents_create_error_timestart'))?>');
                                var txt_enter_dateend = stripslashes('<?php echo strJS($this->lang('dashboard_myevents_create_error_dateend'))?>');
                                var txt_enter_timeend = stripslashes('<?php echo strJS($this->lang('dashboard_myevents_create_error_timeend'))?>');
                                var txt_enter_description = stripslashes('<?php echo strJS($this->lang('dashboard_myevents_create_error_description'))?>');

                                var codev = '<?php echo $D->codeevent; ?>';
                                $('#bsave').click(function(e){
                                    e.preventDefault();
                                    updateEvent('#msgerror', '#bsave');
                                });

                                </script>

                            </div>

                            <div class="mrg30B"></div>
                            <div id="msgerror2" class="alert alert-red hide"></div>
                            <div><span id="linkdeleteevent" class="link link-blue"><?php echo $this->lang('dashboard_myevents_edit_bdelete')?></span></div>
                            
                            <script>
                            
                            var msg_delete_event = stripslashes('<?php echo $this->designer->boxConfirm($this->lang('dashboard_myevents_delete_alert_title'), $this->lang('dashboard_myevents_delete_alert_message'), $this->lang('dashboard_myevents_delete_alert_bdelete'), $this->lang('dashboard_myevents_delete_alert_bcancel'))?>');
                                
                            $('#linkdeleteevent').click(function(e){
                                e.preventDefault();
                                _confirm(msg_delete_event, nothign, deleteEvent, '#msgerror2');
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

                <?php if (!empty($K->KEY_API_GOOGLE)) { ?>
                <script>
                $(document).ready(function() {
                    var input_places = document.getElementById('locationevent');
                    var autocomplete = new google.maps.places.Autocomplete(input_places);
                });
                </script>
                <?php } ?>
                
                <!--DASHBOARD-->