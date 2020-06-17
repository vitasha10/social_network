/*
********************************************************
* @author Santos Montano B. (Lito Santos M.)
* @author_url 1: http://www.kanorika.com
* @author_url 2: http://codecanyon.net/user/kanorika
* @author_email: info@kanorika.com   
********************************************************
* iSocial - Social Networking Platform
* Copyright (c) 2018 iSocial. All rights reserved.
********************************************************
*/

/******************************************************/

function pre_actions() {
    // hide pointers
    $('#p01').hide();
    $('#p02').hide();
    $('#p03').hide();        

    // blue all
    $('#tab-editor-01 .txt_opc_editor').css('color','#3B5998');
    $('#tab-editor-02 .txt_opc_editor').css('color','#3B5998');
    $('#tab-editor-03 .txt_opc_editor').css('color','#3B5998');

    // cursor pointer all
    $('#tab-editor-01').css('cursor','pointer');
    $('#tab-editor-02').css('cursor','pointer');
    $('#tab-editor-03').css('cursor','pointer');

    // input video and audio to blank
    $('#input-video').hide();
    filevideo = null;
    
    $('#input-audio').hide();
    fileaudio = null;
}    

function hide_attach_file() {
    $('#b-opc-attach-files').hide();
    $('#b-opc-attach-people').css('border-radius', '0px 0px 0px 4px');
}

function show_attach_file() {
    $('#b-opc-attach-files').show();
    $('#b-opc-attach-people').css('border-radius', '0px');
}

function reset_all_files() {
    $('#msg-photos').hide();
    $('#typeattach').val('');
    resetFile("#photos_selected_new");   
}

function reset_video() {
    filevideo = null;
    $('#selected_file_video').html('');
    $('#action_upload_video').show();
    $('#info_upload_video').hide();
}

function reset_audio() {
    fileaudio = null;
    $('#selected_file_audio').html('');
    $('#action_upload_audio').show();
    $('#info_upload_audio').hide();
}


/******************************************************/

function sendNewPost_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            $('#space-bottom-editor').show();
            $('#space-preload-editor').hide();
            _alert(response.message);
            break;

        case 'OK':
            $('#space-bottom-editor').show();
            $('#space-preload-editor').hide();
            $('#msg-photos').hide();
            resetFile("#photos_selected_new");
            
            // reinit editor
            $('#text-new-activity').val('');
            $('#text-new-activity').attr('placeholder', placeholder_editor_status);
            $('#text-new-activity').height('63px');

            reset_video();
            
            reset_audio();
            
            pre_actions();
            show_attach_file();

            $('#infoembed').val('');
            $('#typeembed').val('0');
            $('#typeattach').val('');
            $('#content-embed').html('').fadeOut()
            
            $('#tab-editor-01 .txt_opc_editor').css('color','#333');
            $('#tab-editor-01').css('cursor','default');
            $('#p01').show();
            
            ///////////////////////////
            
            attach_people = 0;
            $('#withp').hide();
            $('#input_withp').val('');

            attach_feeling = 0;
            $('#filling').hide();
            $('#input_feeling').val('');

            attach_location = 0;
            $('#insitu').hide();
            $('#input_insitu').val('');
            
            ///////////////////////////
            
            newactivity = response.html;
            $('#new-activity').prepend(newactivity);
            
            $('video.js_video-js').each(function(){ videojs($(this)[0], {}, function() {}); });
            $('audio.mep_audio').mediaelementplayer();
            activeSlimScrollers();
            
            $('.action_autosize').each(function(){
                autosize(this);
            });
            break;            
   }
}

function sendNewPost_Error(response) {
    $('#space-bottom-editor').show();
    $('#space-preload-editor').hide();
    alert('An error has occurred. It not saved the post.');
}

function sendNewPost() {

    typeattach = $('#typeattach').val();
    
    if (typeattach == 'photos') {
        thefile = $('#photos_selected_new').val();
        if (thefile != '') {
            var ext = thefile.split('.').pop().toLowerCase();
            if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
                _alert(msg_alert_format);
                return;
            }
        }
    }

    if (typeattach == '' && $.trim($('#infoembed').val()) == '' && $.trim($('#text-new-activity').val()) == '') {
        _alert(msg_alert_status_empty);
        return;
    }

    if (typeattach == 'video') {
        thefile = filevideo;
        if (thefile == null) {
            _alert(msg_alert_video_empty);
            return;
        }

        if (thefile != '') {
            var ext = thefile.name.split('.').pop().toLowerCase();
            if($.inArray(ext, ['mp4', 'mov','webm']) == -1) {
                _alert(msg_alert_video_wrong);
                return;
            }
        }
        
        if (thefile.size > sizeVideo) {
            _alert(msg_alert_video_large);
            return;
        }
    }

    if (typeattach == 'audio') {
        thefile = fileaudio;
        if (thefile == null) {
            _alert(msg_alert_audio_empty);
            return;
        }

        if (thefile != '') {
            var ext = thefile.name.split('.').pop().toLowerCase();
            if($.inArray(ext, ['mp3', 'wav']) == -1) {
                _alert(msg_alert_audio_wrong);
                return;
            }
        }
        
        if (thefile.size > sizeAudio) {
            _alert(msg_alert_audio_large);
            return;
        }
    }
    
    $('#space-bottom-editor').hide();
    $('#space-preload-editor').show();
    
    var formData = new FormData(document.getElementById("activity-new"));
    formData.append("video_activity_new", filevideo);
    formData.append("audio_activity_new", fileaudio);
    formData.append("posted_in", posted_in);
    formData.append("code_wall", code_wall);
    formData.append("code_writer", code_writer);
    formData.append("type_writer", type_writer);
    formData.append("for_who", for_who);
    
    var params = {
            type: 'POST',
            withFile: true,
            module: 'newpost',
            action: 'new',
            data: formData
    }

    invoke(params, sendNewPost_Ok, sendNewPost_Error);

}

/******************************************************/

function resetFile(idFile) {
    var $fileInput = $(idFile);
    $fileInput.val('');        
    var inputClone = $fileInput.clone(true);
    $fileInput.after(inputClone);
    $fileInput.remove();
    $fileInput = inputClone;        
}

/******************************************************/

function goTab1() {
    pre_actions();
    show_attach_file();
    reset_video();
    reset_audio();

    $('#text-new-activity').attr('placeholder', placeholder_editor_status);
    $('#typeattach').val('');
    $('#tab-editor-01 .txt_opc_editor').css('color','#333');
    $('#tab-editor-01').css('cursor','default');
    $('#p01').show();
    return false;
}

function goTab2() {
    pre_actions();
    hide_attach_file();
    reset_all_files();
    reset_audio();
    
    $('#infoembed').val('');
    $('#typeembed').val('0');
    $('#content-embed').html('').fadeOut();
    
    $('#input-video').show();
    $('#text-new-activity').attr('placeholder', placeholder_editor_status_video);
    $('#typeattach').val('video');
    $('#tab-editor-02 .txt_opc_editor').css('color','#333');
    $('#tab-editor-02').css('cursor','default');
    $('#p02').show();
    return false;
}

function goTab3() {
    pre_actions();
    hide_attach_file();
    reset_all_files();
    reset_video();

    $('#infoembed').val('');
    $('#typeembed').val('0');
    $('#content-embed').html('').fadeOut();
    
    $('#input-audio').show();
    $('#text-new-activity').attr('placeholder', placeholder_editor_status_audio);
    $('#typeattach').val('audio');
    $('#tab-editor-03 .txt_opc_editor').css('color','#333');
    $('#tab-editor-03').css('cursor','default');
    $('#p03').show();
    return false;
}

/******************************************************/

function getEmbed_Ok(response) {
    if (typeof(response) != "undefined") {
        switch (response.status) {
            case 'ERROR':
                break;
            case 'OK':
                $('#infoembed').val(JSON.stringify(response.infoembed));
                $('#typeembed').val(response.embedtype);
                $('#content-embed').html(response.html).fadeIn();
                hide_attach_file();
                break;            
        }
    }
    $('#preload-editor').hide();
}

function getEmbed_Error(response) {
    $('#preload-editor').hide();
}

function getEmbed(url){
    
    $('#preload-editor').show();

    var data = { url: url }
    var params = {
            type: 'POST',
            withFile: false,
            module: 'getEmbed',
            action: 'post',
            data: data
    };

    invoke(params, getEmbed_Ok, getEmbed_Error);
    
}

/******************************************************/