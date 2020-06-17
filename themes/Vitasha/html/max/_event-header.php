<div id="profile-header" style="margin-bottom:0 !important;">
    
    <div id="cover-header" <?php echo(empty($D->cover_event)?'':'class="with_cover"') ?>>

        <div id="space-cover-header">
        <?php if ($D->with_cover) { ?>
        <a href="<?php echo $K->SITE_URL.$D->cover_user.'/photo/'.$D->cover_media?>" class="zoomeer with_cover" data-id="<?php echo $D->cover_media?>" data-image="<?php echo $D->cover_event?>" data-place="cover-event" id="link-cover">
        <img id="cover-img" src="<?php echo $D->cover_event?>" style=" top:<?php echo $D->position_cover_event?>">
        <div id="shadow-header"></div>
        </a>
        <?php } ?>
        </div>
        
        <div class="clear"></div>
        
        <?php if ($D->_IS_LOGGED && $D->is_my_event) { ?>
        <div id="preload-actions-cover"><img src="<?php echo getImageTheme('preload.gif'); ?>"></div>
        <div id="actions-cover">
            <div id="icon-actions-menu">
                <img src="<?php echo getImageTheme('ico-photo-profile.png')?>">
            </div>
            <div id="menu-actions-cover" class="_emerged">
                <div class="opc-action-cover" id="upload-bg-header"><?php echo $this->lang('setting_cover_menu_upload')?></div>
                <div class="opc-action-cover" id="move-bg-header"><?php echo $this->lang('setting_cover_menu_reposition')?></div>
                <div class="opc-action-cover" id="remove-bg-header"><?php echo $this->lang('setting_cover_menu_remove')?></div>
                <div>
                    <form id="form-cover-new" name="form-cover-new" action="" method="POST" enctype="multipart/form-data">
                    <input id="the-new-cover" name="the-new-cover" type="file" accept="image/*" style="display:none;">
                    </form>
                    <script>
                    var sizeCover = <?php echo $K->SIZE_IMAGEN_COVER?>;
                    var filecover = null;
                    
                    var btnUploadCover = document.getElementById('upload-bg-header');
                    var inputCover = document.getElementById('the-new-cover');
                    
                    btnUploadCover.onclick = function(e) {
                        document.getElementById("the-new-cover").click()
                    }

                    var _tp = 3;
                    var _cp = '<?php echo $D->codeevent?>';                    
                    inputCover.onchange = function(e) {
                        filecover = this.files[0];
                        uploadCoverNew();
                    }
                    </script>
                </div>
            </div>
        </div>
        
        <div id="more-options-reposition">
            <div id="save-bg-header"><span class="my-btn my-btn-blue my-btn-small"><?php echo $this->lang('setting_txt_save_changes')?></span></div>
            <div id="cancel-bg-header" class="mrg5T"><span class="my-btn my-btn-small"><?php echo $this->lang('setting_txt_cancel')?></span></div>
        </div>

        
        <div class="clear"></div>
        <?php } ?>
    
    </div>
    <div class="clear"></div>

    <div id="username-header" class="inevent"><a href="<?php echo $K->SITE_URL.'event/'.$D->codeevent?>" class="undecorated" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><span id="the-name"><?php echo $D->the_title?></span></a></div>
    <div id="type-event"><span><?php echo $D->text_type_event?></span></div>
    
    <?php if ($D->_IS_LOGGED) { ?>

    <div id="area-the-actions">
        <?php if ($D->is_my_event) { ?>

        <a href="<?php echo $K->SITE_URL?>myevents/edit/e:<?php echo $D->codeevent; ?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom-all" target="dashboard-main-area"' : '') ?>><span class="my-btn my-btn-small"><?php echo $this->lang('profile_txt_edit')?></span></a>

        <?php } else { ?>
 
         <div class="item_action hide" id="preload-b-action">
            <span style="padding:0 10px;"><img src="<?php echo getImageTheme('preload.gif');?>"></span>
        </div>
        
        <div class="item_action hide" id="area-action-initial">
            <span id="b-action-interested" class="my-btn my-btn-small"><img src="<?php echo getImageTheme('icostar-dark.png') ?>"> Me Interesa</span>
            <span id="b-action-going" class="my-btn my-btn-small"><img src="<?php echo getImageTheme('icook-dark.png') ?>"> Asistiré</span>
        </div>
        
        <div class="item_action hide" id="area-action-selected">
            <span id="b-action-choose" class="my-btn my-btn-small">
                <img src="<?php echo getImageTheme('icook-dark.png') ?>"> 
                <span id="text-btn-result"></span> 
                <img src="<?php echo getImageTheme('icodown-dark.png') ?>">
            </span>
            
            <div id="menu-in-event-result" class="_emerged">
                <div id="action_going" class="one_option"><?php echo($this->lang('global_event_txt_action_going_m'));?></div>
                <div id="action_interested" class="one_option"><?php echo($this->lang('global_event_txt_action_interested_m'));?></div>
                <div id="action_quitevent" class="one_option"></div>
            </div>

        </div>
        
        <div class="clear"></div>

        <script>
            var code_event = '<?php echo $D->codeevent?>';
        
            $('#b-action-interested').click(function(){
                actionEventInterested(0);
            });
            
            $('#b-action-going').click(function(){
                actionEventGoing(0);
            });
        
        </script> 

        <script>
        $('#b-action-choose').click(function(e){
            e.preventDefault();
            if ($('#menu-in-event-result').is (':hidden')) $('#menu-in-event-result').show();
            else $('#menu-in-event-result').hide();
            e.stopPropagation();
        });
        
            $('#action_interested').click(function(){
                actionEventInterested(1);
            });
            
            $('#action_going').click(function(){
                actionEventGoing(1);
            });
        
            $('#action_quitevent').click(function(){
                actionQuitEvent();
            });
        
        </script>        

        
        <script>
        
        var text_result_interested = stripslashes('<?php echo strJS($this->lang('global_event_txt_action_interested'))?>');
        var text_result_going = stripslashes('<?php echo strJS($this->lang('global_event_txt_action_going'))?>');
        var text_yano_going = stripslashes('<?php echo strJS($this->lang('global_event_txt_action_no_going_m'))?>');
        var text_yano_interested = stripslashes('<?php echo strJS($this->lang('global_event_txt_action_no_interested_m'))?>');

        <?php if (!$D->assistance) { ?>
        $('#area-action-initial').show();
        <?php } else { ?>
        
            $('#area-action-selected').show();
        
        <?php if ($D->assistance == 1) { ?>
                
            $('#text-btn-result').html(text_result_interested);
            $('#action_quitevent').html(text_yano_interested);
            $('#action_interested').css('font-weight','bold');
                
         <?php } else { ?>
            $('#text-btn-result').html(text_result_going);
            $('#action_quitevent').html(text_yano_going);
            $('#action_going').css('font-weight','bold');
         <?php } ?>

        <?php } ?>


        </script>

        <?php } ?>
    </div>
    
    <?php } ?>
    
    <div id="cover-bottom">
        <div id="area-menu-header" class="ingroup">
            <div id="inside-menu" class="ingroup">
                <div id="in-content">
                    <a href="<?php echo $K->SITE_URL.'event/'.$D->codeevent?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?> class="one-option no_in_movil"><?php echo($this->lang('profile_txt_timeline'));?></a>
                    <a href="<?php echo $K->SITE_URL.'event/interested/'.$D->codeevent?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?> class="one-option no_in_movil no_in_movil_land"><?php echo($this->lang('profile_txt_interested'));?></a>
                    <a href="<?php echo $K->SITE_URL.'event/going/'.$D->codeevent?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?> class="one-option no_in_movil no_in_movil_land"><?php echo($this->lang('profile_txt_going'));?></a>
                    
                    <a href="<?php echo $K->SITE_URL.$D->username?>" id="menu-more-profile-link" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?> class="one-option no_in_tablet yes_in_movil yes_in_movil_land"><span><?php echo($this->lang('profile_txt_more'));?></span> <span><img src="<?php echo getImageTheme('ico-more-menu.png')?>"></span></a>

                    
                    <div id="menu-more-container" class="_emerged">
                        
                        <a href="<?php echo $K->SITE_URL.'event/'.$D->codeevent?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?> class="yes_in_movil"><div class="one_option"><?php echo($this->lang('profile_txt_timeline'));?></div></a>
                        
                        <a href="<?php echo $K->SITE_URL.'event/interested/'.$D->codeevent?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?> class="yes_in_movil yes_in_movil_land"><div class="one_option"><?php echo($this->lang('profile_txt_interested'));?></div></a>
                        <a href="<?php echo $K->SITE_URL.'event/going/'.$D->codeevent?>" <?php echo($D->_IS_LOGGED ? 'rel="phantom" target="profile-content-area"' : '') ?> class="yes_in_movil yes_in_movil_land"><div class="one_option"><?php echo($this->lang('profile_txt_going'));?></div></a>

                    </div>
                    
                    
                    <script>
                    $('#menu-more-profile-link').click(function(e){
                        e.preventDefault();
                        if ($('#menu-more-container').is (':hidden')) $('#menu-more-container').show();
                        else $('#menu-more-container').hide();
                        e.stopPropagation();
                    });
                    </script>
                    
                    
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    
</div>

<div class="more-info-event">

    <div class="spacetop">
        <?php if ($D->start_unix != $D->end_unix) { ?>
        <div><span><?php echo date("F j - Y - g:i a",$D->start_unix); ?> | <?php echo date("F j - Y - g:i a",$D->end_unix); ?></span></div>
        <?php } else { ?>
        <div><span><?php echo date("F j - Y - g:i a",$D->start_unix); ?></span></div>
        <?php } ?>
    </div>
    
    <div>
        <div class="space01">
            <div>
                <div class="thetitle"><?php echo $this->lang('profile_txt_description')?></div>
                <div class="thecontent"><?php echo $D->description?></div>
            </div>
        </div>
        
        <div class="space02">
            <div>
                <div class="thetitle"><?php echo $this->lang('profile_txt_location')?></div>
                <div class="thecontent"><?php echo $D->address?></div>

<?php if (!empty($K->KEY_API_GOOGLE)) { ?>
                
<?php 
$D->e_lat = '';
$D->e_lon = '';
$e_address = str_replace(' ', '+', $D->address);
$urlQuery = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$e_address.'&key='.$K->KEY_API_GOOGLE;
$thedata = httpCurl($urlQuery);
$thedata = objectToArray(json_decode($thedata));
$D->e_error = FALSE;
if ($thedata['status'] == 'OK') {
    $D->e_lat = $thedata['results'][0]['geometry']['location']['lat'];
    $D->e_lon = $thedata['results'][0]['geometry']['location']['lng'];
} else {
    $D->e_error = TRUE;
}
?>
                <?php if (!$D->e_error) { ?>
                <div id="action_map" class="link link-blue see_map"><?php echo $this->lang('profile_txt_see_map')?></div>
                <div id="preload_map"><img src="<?php echo getImageTheme('preload.gif'); ?>" alt=""></div>
                <div id="map_event"></div>
                <?php } ?>
                
                
<?php } ?>
                
            </div>
        
        </div>
        
        <div class="clear"></div>
    </div>
    
</div>

<script>
var msg_alert_cover_empty = stripslashes('<?php echo $this->designer->boxAlert($this->lang('setting_cover_alert_up_title'), $this->lang('setting_cover_alert_empty_msg'), $this->lang('setting_txt_close'))?>');
var msg_alert_cover_format = stripslashes('<?php echo $this->designer->boxAlert($this->lang('setting_cover_alert_up_title'), $this->lang('setting_cover_alert_format_msg'), $this->lang('setting_txt_close'))?>');
var msg_alert_cover_large = stripslashes('<?php echo $this->designer->boxAlert($this->lang('setting_cover_alert_up_title'), $this->lang('setting_cover_alert_large_msg'), $this->lang('setting_txt_close'))?>');

$(function() {
    var posi_bg_number = '<?php echo str_replace('px', '', $D->position_cover_event)?>';

    function status_responsive() {
        widthCover = $('#cover-header').width();
        
        if (widthCover <= 300) {
            the_position = (300 * posi_bg_number) / 800;
            $('#cover-img').css('top', the_position);
        }

        if (widthCover > 300 && widthCover <= 480) {
            the_position = (480 * posi_bg_number) / 800;
            $('#cover-img').css('top', the_position);
        }

        if (widthCover > 480 && widthCover <= 768) {
            the_position = (768 * posi_bg_number) / 800;
            $('#cover-img').css('top', the_position);
        }
    }
    status_responsive();

    $(window).resize(function() {
        status_responsive();
    });

    <?php if (empty($D->cover_event)) {?>
    $('#link-cover').hide();
    <?php } ?>

    <?php if ($D->_IS_LOGGED && $D->is_my_event) { ?>

    <?php if (empty($D->cover_event)) {?>
    $('#move-bg-header').hide();
    $('#remove-bg-header').hide();
    <?php } ?>

    var posi_bg_initial = '<?php echo $D->position_cover_event?>';
    var posi_bg_new = posi_bg_initial;

    $('#move-bg-header').on('click', function() {
        
        $('#actions-cover').hide();
        
        $('#more-options-reposition').show();

        $('#cover-img').addClass('with_drag');        
        $('#shadow-header').on('click', function(){ return false; });

        var y1 = $('#cover-header').height();
        var y2 =  $('#cover-img').height();
        
        $('#cover-img').draggable({ disabled: false });
        $('#cover-img').draggable({
            scroll: false,
            axis: "y",
            drag: function(event, ui) {
                if(ui.position.top >= 0) ui.position.top = 0;
                else if(ui.position.top <= y1 - y2) ui.position.top = y1 - y2;
            },
            stop: function(event, ui) {
                posi_bg_new = ui.position.top;
            }
        });

    });

    $('#cancel-bg-header').on('click', function(){
        
        $('#actions-cover').show();
        
        $('#more-options-reposition').hide();

        $('#cover-img').removeClass('with_drag');
        $('#cover-img').draggable({ disabled: true });
        
        $('#cover-img').css('top', posi_bg_initial);

    });
    
    $('#save-bg-header').on('click', function(){
        
        $('#actions-cover').show();
        
        $('#more-options-reposition').hide();

        $('#cover-img').removeClass('with_drag');        
        $('#cover-img').draggable({ disabled: true });
        
        posi_bg_initial = posi_bg_new;
        var cadposi = '' + posi_bg_new + '';
        posi_bg_new = cadposi.replace('px','');
        
        posi_bg_number = posi_bg_new;
        
        saveRepositionBG(posi_bg_new);

    });

    var msg_delete_cover = stripslashes('<?php echo $this->designer->boxConfirm($this->lang('setting_cover_delete_title'), $this->lang('setting_cover_delete_msg'), $this->lang('setting_txt_confirm'), $this->lang('setting_txt_cancel'))?>');

    $('#remove-bg-header').on('click', function() {
        closeEmerged();
        _confirm(msg_delete_cover, nothign, removeCover, 1);
    });        

    $("#icon-actions-menu").on("click",function(){
        closeEmerged();
        positop = $("#icon-actions-menu").position()
        $('#menu-actions-cover').css('top',positop.top + 20);
        $('#menu-actions-cover').show();
        return false;
    });
    
    $('#link-cover, #icon-actions-menu').mouseover(function(){ $('#icon-actions-menu').css('opacity','1'); }).mouseout(function(){ $('#icon-actions-menu').css('opacity','0.5'); });
    
    <?php } ?>

});

<?php if (!empty($K->KEY_API_GOOGLE)) { ?>

<?php if (!$D->e_error) { ?>

var txt_see_map = stripslashes('<?php echo strJS($this->lang('profile_txt_see_map'))?>');
var txt_hide_map = stripslashes('<?php echo strJS($this->lang('profile_txt_hide_map'))?>');
var txt_no_map = stripslashes('<?php echo strJS($this->lang('profile_txt_no_map'))?>');

var see_map = 0;
var e_lat = '<?php echo $D->e_lat; ?>';
var e_lon = '<?php echo $D->e_lon; ?>';

$('#action_map').click(function(){
    $('#preload_map').show();
    if (see_map == 0) {
        $('#map_event').show();        
        // Create the MAP
        map = new google.maps.Map(document.getElementById("map_event"), {
            center: new google.maps.LatLng(e_lat, e_lon),
            zoom: 15,
            panControl: false,
            zoomControl: true,
            mapTypeControl: false,
            streetViewControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false,
        });
        
        // Create the main marker
        var mainmarker = new google.maps.Marker({
            map: map,
            draggable:false,
            position: new google.maps.LatLng(e_lat, e_lon),
            //icon: siteurl + 'themes/' + sitetheme + '/images/marker3.png',
        });

        $('#action_map').html(txt_hide_map);
        see_map = 1;
    } else {
        $('#map_event').hide();
        $('#action_map').html(txt_see_map);
        see_map = 0;
    }
    $('#preload_map').hide();
    return false;
});

<?php } ?>

<?php } ?>

</script>