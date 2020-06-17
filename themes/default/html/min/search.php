                    <?php if(isset($D->js_script_min)) echo $D->js_script_min;?>

                    <div id="site-2-parts-left">

                        <div class="box-white mrg30B">

                            <div class="box-white-header-clean">
                                <div class="title"><?php echo $this->lang('global_search_title'); ?></div>
                                <div class="clear"></div>
                            </div>

                            <div class="box-white-body">

                                <div class="areablock space-form-search margin-bottom-zero">

                                    <form id="form-search-s" name="form-search-s" method="post" action="">

                                    <div class="form-block">

                                        <label for="tsearch"><?php echo $this->lang('global_search_yoursearch')?>:</label>

                                        <input name="tsearch" type="text" id="tsearch" placeholder="<?php echo $this->lang('global_search_box_placeholder')?>" class="form-control" value="<?php echo $D->the_query?>"/>

                                    </div>

                                    <div id="msgerror" class="alert alert-red hide"></div>

                                    <div><input type="submit" name="bsearchs" id="bsearchs" value="<?php echo $this->lang('global_search_button')?>" class="my-btn my-btn-blue"/></div>

                                    </form>

                                </div>

                                <?php if (!empty($D->html_results)) { ?>

                                <hr style="margin-top:15px;">

                                <div class="title-result-search"><?php echo $this->lang('global_search_title_results'); ?></div>

                                <?php echo $D->html_results?>

                                <?php if ($D->numresults > 0) { ?>

                                <div class="grey" style="font-size:13px; margin-top:15px; margin-bottom:5px;"><span class="bold"><?php echo $D->numresults; ?></span> <?php echo($D->numresults == 1 ? $this->lang('global_search_txt_result') : $this->lang('global_search_txt_results'))?></div> 

                                <?php } ?>

                                <?php } else { ?>

                                <div style="margin-bottom:40px;"></div>

                                <?php } ?>

                            </div>

                        </div>

                    </div>

                    <div id="site-2-parts-right">

                    <?php $this->load_template('_others-right.php'); ?>

                    </div>

                    <div class="clear"></div>

                <?php if (isset($D->titlePhantom) && !empty($D->titlePhantom)) { ?>

                <div id="newtitlesite" style="display:none;"><?php echo $D->titlePhantom?></div>

                <?php } ?>

<script>

    var txt_error_text_search = stripslashes('<?php echo strJS($this->lang('global_search_error_text'))?>');
    var txt_error_text_search_small = stripslashes('<?php echo strJS($this->lang('global_search_error_text_small'))?>');

    $('#tsearch').bind('keydown', function(e) {
        if(e.keyCode==13) {
            init_search($('#tsearch').val(), '#msgerror');
            return false;
        }
    });

    $('#bsearchs').click(function(e){
        e.preventDefault();
        init_search($('#tsearch').val(), '#msgerror');
    });

    function init_search(thestring, diverror) {
        thestring = $.trim(thestring);
        if (thestring == '') {
            openandclose(diverror, txt_error_text_search, 2500);
            return;
        }

        if (thestring.length < 2) {
            openandclose(diverror, txt_error_text_search_small, 2500);
            return;
        }

        <?php if (isset($D->_IS_LOGGED) && $D->_IS_LOGGED) { ?>
        _SPACE_FULL = true;
        actionOnClick(_SITE_URL + 'search/q:' + thestring, 'dashboard-main-area', 'all');
        <?php } else { ?>
        document.location = _SITE_URL + 'search/q:' + encodeURIComponent(escape(thestring.replace(' ','+')));
        <?php } ?>
    }

    $('#input-search-top').val('');
    closeEmerged();

</script>

<script type="text/javascript">
    var _menu_resp_dashboard = stripslashes('<?php echo strJS(cutLineJump($D->mini_card_user))?>') + stripslashes('<?php echo strJS(cutLineJump($D->dashboard_menu_responsive))?>') + '<div class="mrg10B"></div>';

    makeMenuResp('dashboard');
</script>