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

var NUM_CHATS_ALL = 0;
var NUM_CHATS_HIDE = 0;
var NUM_CHATS_VISIBLE = 0;
var NUM_BOX_ALLOW = 3;
var SPACE_AREA_CHAT;
var WIDTH_ONE_CHAT;
var SPACE_RIGHT_BOX_CHATS;
var ALL_BOXS_IN_CHAT = new Array();
var STATUS_BOX_IN_CHAT = new Array();

var BOXS_IN_CHAT_VISIBLE = new Array();
var BOXS_IN_CHAT_HIDDEN = new Array();
var CODESCHATS = '';

function getHTMLBoxChat(codechat, namefriend, username) {
    
    var smile_string = [':-)', ':-D', ':-O', ':-P', ';-)', ':((', ':-(', ':-|', ':-$', '(H)', ':-@', '(A)', '(6)', '8o|', '8-|', '^o)', '+o(', '*-)', '8-)', '|-)', '(C)', '(Y)', '(N)', '(B)', '(D)', '({)', '(})', '(^)', '(L)', '(U)', '(K)', '(G)', '(F)', '(S)', '(*)', '(E)', '(pl)', '(pi)', '(so)', '(mo)'];
    
    var smile_images = ['regular.png', 'teeth.png', 'omg.png', 'tongue.png', 'wink.png', 'cry.png', 'sad.png', 'what.png', 'red.png', 'shades.png', 'angry.png', 'angel.png', 'devil.png', 'growl.png', 'nerd.png', 'sarcastic.png', 'sick.png', 'pensive.png', 'eyesrolled.png', 'sleepy.png', 'coffee.png', 'thumbs_up.png', 'thumbs_down.png', 'beer_mug.png', 'martini.png', 'guy_hug.png', 'girl_hug.png', 'cake.png', 'heart.png', 'broken_heart.png', 'kiss.png', 'present.png', 'rose.png', 'moon.png', 'star.png', 'envelope.png', 'dish.png', 'pizza.png', 'ball.png', 'money.png'];

    cad_smiles = '';
    for (i = 0; i < smile_string.length; i++) {
        cad_smiles = cad_smiles + '<span class="onesmile"><img onclick="insertSmiles(\'t_input_chat-' + codechat + '\', \'' + smile_string[i] + '\');" class="hand" title="' + smile_string[i] + '" src="' + _SITE_URL + 'themes/' + _THEME + '/imgs/smiles/' + smile_images[i] + '" height="16" width="16" style="padding:4px;" /></span>';
    }

    cad_stickers = '';
    for (ii=0; ii <= 44; ii++) {
        thefile = ('0' + ii).slice(-2);
        cad_stickers = cad_stickers + '<div class="onesticker"><img onclick="insertSticker(\'' + codechat + '\', \'' + thefile + '\');" class="hand" src="' + _SITE_URL + 'themes/' + _THEME + '/imgs/stickers/min/' + thefile + '.png" height="62" width="62" style="" /></div>';
    }
    cad_stickers = cad_stickers + '<div class="clear"></div>';
    
    cadHtml = '';
    cadHtml = cadHtml + '<div id="bch_' + codechat + '" class="one-box-chat">';
    cadHtml = cadHtml + '    <div class="in-mini">';
    cadHtml = cadHtml + '        <div class="title-bar" onClick=maximizeBoxChat("' + codechat + '");>';
    cadHtml = cadHtml + '            <div class="title-bar-icodel" id="del_bch_' + codechat + '" onClick=closeBoxChat("'+ codechat +'");>X</div>';
    cadHtml = cadHtml + '            <div class="title-bar-name">' + namefriend + '</div>';
    cadHtml = cadHtml + '        </div>';
    cadHtml = cadHtml + '    </div>';
    
    cadHtml = cadHtml + '    <div class="in-maxi">';
    cadHtml = cadHtml + '        <div id="title-bar-boxchat-' + codechat + '" class="title-bar">';
    cadHtml = cadHtml + '            <div class="title-bar-icodel" id="del_bch_' + codechat + '" onClick=closeBoxChat("'+ codechat +'");>X</div>';
    cadHtml = cadHtml + '            <div class="ico-in-box-chat"><span id="bshow_bch_' + codechat + '" class="the-icon"><img src="' + _SITE_URL + 'themes/' + _THEME + '/imgs/more-option-chat.png"></span>';

    cadHtml = cadHtml + '            <div id="bmich-' + codechat + '" class="box-menu-in-chat _emerged">';
    
    cadHtml = cadHtml + '                <a href="' + _SITE_URL + 'messages/' + username + '" rel="phantom-all" target="dashboard-main-area"  onClick=stopMin();><div class="one_option">' + txt_box_chat_opc1 + '</div></a>';
    cadHtml = cadHtml + '                <div id="chat_menu_opc_2_' + codechat + '" class="one_option" onClick=stopMin();>' + txt_box_chat_opc2 + '</div>';
    cadHtml = cadHtml + '                <div id="chat_menu_opc_3_' + codechat + '" class="one_option" onClick=stopMin();>' + txt_box_chat_opc3 + '</div>';
    
    cadHtml = cadHtml + '            </div>';
    
    cadHtml = cadHtml + '        </div>';
    cadHtml = cadHtml + '            <div class="title-bar-name"><a href="' + _SITE_URL + username + '" rel="phantom-all" target="dashboard-main-area" class="undecorated" onClick=stopMin();>' + namefriend + '</a></div>';
    cadHtml = cadHtml + '        </div>';
    cadHtml = cadHtml + '        <div id="the-list-messages-chat-' + codechat + '" class="slimscrollers space-conversation-chat"></div>';

    cadHtml = cadHtml + '        <div class="space-input-text">';
    cadHtml = cadHtml + '            <div id="areainputch-' + codechat + '" class="the_input_chat">';
    cadHtml = cadHtml + '                <textarea name="t_input_chat-' + codechat + '" id="t_input_chat-' + codechat + '" rows="1" class="action_autosize textarea_input_chat" placeholder="' + txt_write_message + '"></textarea>';
    cadHtml = cadHtml + '            </div>';
    cadHtml = cadHtml + '        </div>';

    cadHtml = cadHtml + '        <div class="bar-tools">';

    cadHtml = cadHtml + '            <div id="tool-photo-chat-' + codechat + '" class="one-tool-chat">';
    cadHtml = cadHtml + '                <img id="bphoto_chat_' + codechat + '" class="ico-tool-chat" src="' + _SITE_URL + 'themes/' + _THEME + '/imgs/cha-ico-photo.png" title="' + txt_chat_alt_photo + '">';
    cadHtml = cadHtml + '                <form id="form_photo_chat_' + codechat + '" name="form_photo_chat_' + codechat + '" action="" method="POST" enctype="multipart/form-data">';
    cadHtml = cadHtml + '                <input id="chat_photo_' + codechat + '" name="chat_photo_' + codechat + '" accept="image/*" type="file"  class="hide">';
    cadHtml = cadHtml + '                </form>';
    
    cadHtml = cadHtml + '            </div>';

    cadHtml = cadHtml + '            <div class="one-tool-chat the-smiles-chat">';
    cadHtml = cadHtml + '                <img class="ico-tool-chat" src="' + _SITE_URL + 'themes/' + _THEME + '/imgs/cha-ico-smile.png" title="' + txt_chat_alt_smile + '">';
    cadHtml = cadHtml + '            </div>';
    cadHtml = cadHtml + '            <div class="menusmiles-chat">' + cad_smiles + '</div>';

    cadHtml = cadHtml + '            <div id="tool-file-chat-' + codechat + '" class="one-tool-chat">';
    cadHtml = cadHtml + '                <img id="bfile_chat_' + codechat + '" class="ico-tool-chat" src="' + _SITE_URL + 'themes/' + _THEME + '/imgs/cha-ico-attach.png" title="' + txt_chat_alt_file + '">';
    cadHtml = cadHtml + '                <form id="form_attachfile_chat_' + codechat + '" name="form_attachfile_chat_' + codechat + '" action="" method="POST" enctype="multipart/form-data">';
    cadHtml = cadHtml + '                <input id="chat_attachfile_' + codechat + '" name="chat_attachfile_' + codechat + '" accept="i*" type="file"  class="hide">';
    cadHtml = cadHtml + '                </form>';

    cadHtml = cadHtml + '            </div>';

    cadHtml = cadHtml + '            <div id="bstick-' + codechat + '" class="one-tool-chat the-stickers-chat">';
    cadHtml = cadHtml + '                <img class="ico-tool-chat" src="' + _SITE_URL + 'themes/' + _THEME + '/imgs/cha-ico-sticker.png" title="' + txt_chat_alt_sticker + '">';
    cadHtml = cadHtml + '            </div>';
    cadHtml = cadHtml + '            <div class="menustickers-chat"><div id="box-stickrs-' + codechat + '" class="slimscrollers">' + cad_stickers + '</div></div>';
    
    cadHtml = cadHtml + '            <div class="one-tool-chat tright">';
    cadHtml = cadHtml + '                <img onclick="insertSticker(\'' + codechat + '\', \'00\');" class="ico-tool-chat" src="' + _SITE_URL + 'themes/' + _THEME + '/imgs/cha-ico-ok.png">';
    cadHtml = cadHtml + '            </div>';

    cadHtml = cadHtml + '            <div class="clear"></div>';

    cadHtml = cadHtml + '        </div>';

    cadHtml = cadHtml + '        <script>';
    cadHtml = cadHtml + '        $("#t_input_chat-'+ codechat +'").on("keydown", function (event) {';
    cadHtml = cadHtml + '            if (event.keyCode == 13 && event.shiftKey == 0) {';
    cadHtml = cadHtml + '                event.preventDefault();';
    cadHtml = cadHtml + '                var message = $(this).val();';
    cadHtml = cadHtml + '                if (is_empty(message)) return;';
    cadHtml = cadHtml + '                sendMessageChat("' + codechat + '");';
    cadHtml = cadHtml + '            }';
    cadHtml = cadHtml + '        });';

    cadHtml = cadHtml + '        $("#the-list-messages-chat-' + codechat + '").slimScroll({';
    cadHtml = cadHtml + '            width: "260px",';
    cadHtml = cadHtml + '            height: "240px",';
    cadHtml = cadHtml + '            start : "bottom",';
    cadHtml = cadHtml + '        });';

    cadHtml = cadHtml + '        $("#box-stickrs-' + codechat + '").slimScroll({';
    cadHtml = cadHtml + '            width: "260px",';
    cadHtml = cadHtml + '            height: "240px",';
    cadHtml = cadHtml + '            start : "top",';
    cadHtml = cadHtml + '        });';

    cadHtml = cadHtml + '        $("#title-bar-boxchat-' + codechat + '").click(function(){';
    cadHtml = cadHtml + '           minimizeBoxChat("' + codechat + '");';
    cadHtml = cadHtml + '        });';

    cadHtml = cadHtml + '        $("#bshow_bch_' + codechat + '").click(function(e) {';
    cadHtml = cadHtml + '            e.stopPropagation();';
    cadHtml = cadHtml + '            if ($("#bmich-' + codechat + '").is (":hidden")) $("#bmich-' + codechat + '").show();';
    cadHtml = cadHtml + '            else $("#bmich-' + codechat + '").hide();';
    cadHtml = cadHtml + '        });';
    
    cadHtml = cadHtml + '        $(".action_autosize").each(function(){';
    cadHtml = cadHtml + '            autosize(this);';
    cadHtml = cadHtml + '        });';
    
    cadHtml = cadHtml + '        document.querySelector("#t_input_chat-' + codechat + '").addEventListener("autosize:resized", function(){';

    cadHtml = cadHtml + '            value_new_height = 256 - $("#areainputch-' + codechat + '").height();';

    cadHtml = cadHtml + '            $("#the-list-messages-chat-' + codechat + '").slimScroll({';
    cadHtml = cadHtml + '                height: value_new_height,';
    cadHtml = cadHtml + '                start : "bottom",';
    cadHtml = cadHtml + '            });';
    
    cadHtml = cadHtml + '            $("#the-list-messages-chat-' + codechat + '").height(value_new_height);';
    
    cadHtml = cadHtml + '        });';


    cadHtml = cadHtml + '        $("#chat_menu_opc_2_' + codechat + '").click(function(){';
    cadHtml = cadHtml + '            $("#chat_photo_' + codechat + '").click();';
    cadHtml = cadHtml + '        });';
    
    cadHtml = cadHtml + '        $("#bphoto_chat_' + codechat + '").click(function(){';
    cadHtml = cadHtml + '            $("#chat_photo_' + codechat + '").click();';
    cadHtml = cadHtml + '        });';    

    cadHtml = cadHtml + '        $("#chat_photo_' + codechat + '").change(function(){';
    cadHtml = cadHtml + '            insertPhotoInChat("' + codechat + '", this.files[0]);';
    cadHtml = cadHtml + '        });'; 


    cadHtml = cadHtml + '        $("#chat_menu_opc_3_' + codechat + '").click(function(){';
    cadHtml = cadHtml + '            $("#chat_attachfile_' + codechat + '").click();';
    cadHtml = cadHtml + '        });';
    
    cadHtml = cadHtml + '        $("#bfile_chat_' + codechat + '").click(function(){';
    cadHtml = cadHtml + '            $("#chat_attachfile_' + codechat + '").click();';
    cadHtml = cadHtml + '        });';    

    cadHtml = cadHtml + '        $("#chat_attachfile_' + codechat + '").change(function(){';
    cadHtml = cadHtml + '            insertFileInChat("' + codechat + '", this.files[0]);';
    cadHtml = cadHtml + '        });'; 


    cadHtml = cadHtml + '        </script>';
    
    cadHtml = cadHtml + '    </div>';
    cadHtml = cadHtml + '    <div class="clear"></div>';
    cadHtml = cadHtml + '</div>';
    
    return cadHtml;
}

function getHTMLUserHidden(codechat) {
    namefriend = $('#bch_' + codechat + ' .title-bar-name').html();

    cadHtml = '';
    cadHtml = cadHtml + '<div id="oneitemhidden_' + codechat + '" class="one-in-list">';
    cadHtml = cadHtml + '   <div class="thedelete"><span onClick=closeBoxChat("'+ codechat +'");>x</span></div>';
    cadHtml = cadHtml + '   <div class="thename"><span onClick=openBoxHidden("'+ codechat +'");>' + namefriend + '</span></div>';
    cadHtml = cadHtml + '   <div class="clear"></div>';
    cadHtml = cadHtml + '</div>';

    return cadHtml;
}

function startChat(codechat, namefriend, username) {

    theposition = ALL_BOXS_IN_CHAT.indexOf(codechat);
    if (theposition == -1) {
        
        CODESCHATS = CODESCHATS + '|' + codechat + '|';

        if (NUM_CHATS_VISIBLE < NUM_BOX_ALLOW) {

            BOXS_IN_CHAT_VISIBLE.push(codechat);
            
            $('#group-chats').prepend(getHTMLBoxChat(codechat, namefriend, username));
            
            NUM_CHATS_VISIBLE = NUM_CHATS_VISIBLE + 1;
            
            ALL_BOXS_IN_CHAT.push(codechat);
            
        } else {
            
            thecode = BOXS_IN_CHAT_VISIBLE.pop();
            
            /*****************************/
            BOXS_IN_CHAT_HIDDEN.push(thecode);
            $('#inside-list-hidden').prepend(getHTMLUserHidden(thecode));
            /*****************************/
            
            $('#bch_' + thecode).addClass('invisible');
            
            BOXS_IN_CHAT_VISIBLE.push(codechat);
            
            $('#group-chats').prepend(getHTMLBoxChat(codechat, namefriend, username));
            
            NUM_CHATS_HIDE = NUM_CHATS_HIDE + 1;
            
            ALL_BOXS_IN_CHAT.push(codechat);

            $('#the-counter-hidden').show();
            $('#button-counter').html(NUM_CHATS_HIDE);
            
        }

        getMessagesChat(codechat);
    
        NUM_CHATS_ALL = NUM_CHATS_ALL + 1;         

    } else {
        
        ishidden = BOXS_IN_CHAT_HIDDEN.indexOf(codechat); 
        if (ishidden != -1) {

            thecode_visible = BOXS_IN_CHAT_VISIBLE.pop();
            
            BOXS_IN_CHAT_HIDDEN.splice(ishidden, 1);

            /*****************************/            
            BOXS_IN_CHAT_HIDDEN.push(thecode_visible);
            $('#inside-list-hidden').prepend(getHTMLUserHidden(thecode_visible));
            /*****************************/
            
            /*****************************/
            $('#bch_' + codechat).removeClass('invisible');
            $('#oneitemhidden_' + codechat).remove();
            /*****************************/

            
            BOXS_IN_CHAT_VISIBLE.push(codechat);
            
            $('#bch_' + thecode_visible).addClass('invisible');

        }
        
        // if it is in mini
        maximizeBoxChat(codechat);
        
    }
    
    $('#t_input_chat-' + codechat).focus();
    
    // hide box min of user in movil
    if (NUM_CHATS_ALL > 0) {
        if (widthWindow < 750) {
            $('#users-box-chat-bottom').hide();
        }
    }
    
    return false;
}

var minBoxChat = true;
function stopMin(){
    minBoxChat = false;
}

function minimizeBoxChat(codechat) {
    if (minBoxChat == true) {
        $('#bch_' + codechat + ' .in-maxi').hide();
        $('#bch_' + codechat + ' .in-mini').show();
    } else minBoxChat = true;
}

function maximizeBoxChat(codechat) {
    $('#bch_' + codechat + ' .in-mini').hide();
    $('#bch_' + codechat + ' .in-maxi').show();
}

function openBoxHidden(codechat) {

    ishidden = BOXS_IN_CHAT_HIDDEN.indexOf(codechat); 
    if (ishidden != -1) {

        thecode_visible = BOXS_IN_CHAT_VISIBLE.pop();
        
        BOXS_IN_CHAT_HIDDEN.splice(ishidden, 1);
    
        /*****************************/            
        BOXS_IN_CHAT_HIDDEN.push(thecode_visible);
        $('#inside-list-hidden').prepend(getHTMLUserHidden(thecode_visible));
        /*****************************/
        
        /*****************************/
        $('#bch_' + codechat).removeClass('invisible');
        $('#oneitemhidden_' + codechat).remove();
        /*****************************/
        
        BOXS_IN_CHAT_VISIBLE.push(codechat);
        
        $('#bch_' + thecode_visible).addClass('invisible');    
        
    }

}

function closeBoxChat(codechat) {
    
    CODESCHATS = CODESCHATS.replace('|' + codechat + '|', '');
    
    ishidden = BOXS_IN_CHAT_HIDDEN.indexOf(codechat);
    if (ishidden != -1) {
        
        BOXS_IN_CHAT_HIDDEN.splice(ishidden, 1); //sacamos el elemento de los visibles
        $('#bch_' + codechat).remove(); // eliminamos de la vista al box chat del elemento
        
        $('#oneitemhidden_' + codechat).remove();
        
        theposition = ALL_BOXS_IN_CHAT.indexOf(codechat);
        ALL_BOXS_IN_CHAT.splice(theposition, 1);

        NUM_CHATS_HIDE = NUM_CHATS_HIDE - 1;
        
        NUM_CHATS_ALL = NUM_CHATS_ALL - 1;
        
    } else {

        isvisible = BOXS_IN_CHAT_VISIBLE.indexOf(codechat);
        if (isvisible != -1) {

            BOXS_IN_CHAT_VISIBLE.splice(isvisible, 1);
            $('#bch_' + codechat).remove();
            
            if (NUM_CHATS_HIDE > 0) {
                thecode_hidden = BOXS_IN_CHAT_HIDDEN.pop();
                BOXS_IN_CHAT_VISIBLE.push(thecode_hidden); 
                $('#oneitemhidden_' + thecode_hidden).remove();
                $('#bch_' + thecode_hidden).removeClass('invisible');
            }

            theposition = ALL_BOXS_IN_CHAT.indexOf(codechat);
            ALL_BOXS_IN_CHAT.splice(theposition, 1);
            
            if (NUM_CHATS_HIDE == 0) {
                NUM_CHATS_VISIBLE = NUM_CHATS_VISIBLE - 1;                
            } else {
                NUM_CHATS_HIDE = NUM_CHATS_HIDE - 1;                
            }

            NUM_CHATS_ALL = NUM_CHATS_ALL - 1;

        }
    
    }
    
    if (NUM_CHATS_HIDE > 0) {
        $('#button-counter').html(NUM_CHATS_HIDE);
    } else {
        $('#the-counter-hidden').hide();
    }
    
    // show box min of user in movil
    if (NUM_CHATS_ALL == 0) {
        if (widthWindow < 750) {
            $('#users-box-chat-bottom').show();
            $('#space-for-chat').css('right', SPACE_RIGHT_BOX_CHATS);
        }
    }

}


/*__________________________________________________________________*/
/*__________________________________________________________________*/

function getMessagesChat_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            code = response.code;
            $('#the-list-messages-chat-' + code).append(response.themessageschat);
            $('#the-list-messages-chat-' + code).slimScroll({ scrollTo: $('#the-list-messages-chat-' + code)[0].scrollHeight + 'px' });
            break;
   }
}

function getMessagesChat_Error(response) {
}

function getMessagesChat(code) {

    var data = {
        cdus : code,
    };
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'chat',
            action: 'getmessagechat',
            data: data
    };

    invoke(params, getMessagesChat_Ok, getMessagesChat_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function restoreSpaceBox(codebox) {

    value_new_height = 256 - $("#areainputch-" + codebox).height();

    $("#the-list-messages-chat-" + codebox).slimScroll({
        height: value_new_height,
        start : "bottom",
    });
}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function insertPhotoInChat_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            _alert(response.msgalert);
            break;

        case 'OK':
            $('#' + thedivpreload).remove();
            code = response.code;
            $('#the-list-messages-chat-' + code).append(response.newmessagechat);
            $('#the-list-messages-chat-' + code).scrollTop($('#the-list-messages-chat-' + code)[0].scrollHeight);
            $('#tool-photo-chat-' + code).show();
            break;
   }
}

function insertPhotoInChat_Error(response) {
}

function insertPhotoInChat(code, thephotofile) {
    
    thefile = $('#chat_photo_' + code).val();
    var ext = thefile.split('.').pop().toLowerCase();
    if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
        _alert(msg_chat_error_photo_format);
        return;
    }

    if (thephotofile.size > sizePhotoMessage) {
        _alert(msg_chat_error_photo_large);
        return;
    }
    
    $('#tool-photo-chat-' + code).hide();

    thedivpreload = code + Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5);
    thepreload_html = '<div id="' + thedivpreload + '" class="burblu_chat"><div class="in_me"><div class="message"><img src="' + _SITE_URL + 'themes/' + _THEME + '/imgs/preload.gif"></div><div class="clear"></div></div></div><div class="clear"></div>';
    $('#the-list-messages-chat-' + code).append(thepreload_html);
    $('#the-list-messages-chat-' + code).scrollTop($('#the-list-messages-chat-' + code)[0].scrollHeight);

    var formData = new FormData($("#form_photo_chat_" + code)[0]);
    formData.append("photo_chat", thephotofile);
    formData.append("cdus", code);

    var params = {
            type: 'POST',
            withFile: true,
            module: 'chat',
            action: 'insertphotoinchat',
            data: formData
    };

    invoke(params, insertPhotoInChat_Ok, insertPhotoInChat_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function insertFileInChat_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            _alert(response.msgalert);
            break;

        case 'OK':
            $('#' + thedivpreload).remove();
            code = response.code;
            $('#the-list-messages-chat-' + code).append(response.newmessagechat);
            $('#the-list-messages-chat-' + code).scrollTop($('#the-list-messages-chat-' + code)[0].scrollHeight);
            $('#tool-file-chat-' + code).show();
            break;
   }
}

function insertFileInChat_Error(response) {
}

function insertFileInChat(code, theattachfile) {
    
    thefile = $('#chat_attachfile_' + code).val();
    var ext = thefile.split('.').pop().toLowerCase();
    if($.inArray(ext, bad_ext_files.split(',')) != -1) {
        _alert(msg_chat_error_file_format);
        return;
    }

    if (theattachfile.size > sizeAttachMessage) {
        _alert(msg_chat_error_file_large);
        return;
    }
    
    $('#tool-file-chat-' + code).hide();

    thedivpreload = code + Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5) + 'file';
    thepreload_html = '<div id="' + thedivpreload + '" class="burblu_chat"><div class="in_me"><div class="message"><img src="' + _SITE_URL + 'themes/' + _THEME + '/imgs/preload.gif"></div><div class="clear"></div></div></div><div class="clear"></div>';
    $('#the-list-messages-chat-' + code).append(thepreload_html);
    $('#the-list-messages-chat-' + code).scrollTop($('#the-list-messages-chat-' + code)[0].scrollHeight);

    var formData = new FormData($("#form_attachfile_chat_" + code)[0]);
    formData.append("attach_chat", theattachfile);
    formData.append("cdus", code);

    var params = {
            type: 'POST',
            withFile: true,
            module: 'chat',
            action: 'insertfileinchat',
            data: formData
    };

    invoke(params, insertFileInChat_Ok, insertFileInChat_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function sendMessageChat_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            code = response.code;
            $('#the-list-messages-chat-' + code).append(response.newmessagechat);
            $('#the-list-messages-chat-' + code).scrollTop($('#the-list-messages-chat-' + code)[0].scrollHeight);
            $('#t_input_chat-' + code).val('');
            $('#t_input_chat-' + code).height('16px');
            restoreSpaceBox(code);
            break;
   }
}

function sendMessageChat_Error(response) {
}

function sendMessageChat(code) {

    var data = {
        cdus : code,
        msg: $('#t_input_chat-' + code).val(),
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'chat',
            action: 'sendmessage',
            data: data
    }

    invoke(params, sendMessageChat_Ok, sendMessageChat_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function insertSticker_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            code = response.code;
            $('#the-list-messages-chat-' + code).append(response.newmessagechat);
            $('#the-list-messages-chat-' + code).scrollTop($('#the-list-messages-chat-' + code)[0].scrollHeight);
            break;
   }
}

function insertSticker_Error(response) {
}

function insertSticker(code, sticker) {
    
    $('#bstick-' + code).next('.menustickers-chat').toggle();

    var data = {
        cdus : code,
        stk: sticker,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'chat',
            action: 'sendsticker',
            data: data
    }

    invoke(params, insertSticker_Ok, insertSticker_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function sendMessageChatAlone_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            code = response.code;
            $('#list_messages_talk_alone').append(response.newmessagechat);
            $('#space-talk-messages').scrollTop($('#space-talk-messages')[0].scrollHeight);
            $('#input_chat_in_talk').val('');
            $('#input_chat_in_talk').height('16px');
            break;
   }
}

function sendMessageChatAlone_Error(response) {
}

function sendMessageChatAlone(code) {

    var data = {
        cdus : code,
        msg: message_talk_alone,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'chat',
            action: 'sendmessage',
            data: data
    }

    invoke(params, sendMessageChatAlone_Ok, sendMessageChatAlone_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function insertStickerAlone_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            code = response.code;
            $('#list_messages_talk_alone').append(response.newmessagechat);
            $('#space-talk-messages').scrollTop($('#space-talk-messages')[0].scrollHeight);
            break;
   }
}

function insertStickerAlone_Error(response) {
}

function insertStickerAlone(code, sticker) {
    
    $('#bstick-alone').next('.menustickers-chat').toggle();

    var data = {
        cdus : code,
        stk: sticker,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'chat',
            action: 'sendsticker',
            data: data
    }

    invoke(params, insertStickerAlone_Ok, insertStickerAlone_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function insertPhotoInChatAlone_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            _alert(response.msgalert);
            break;

        case 'OK':
            $('#' + thedivpreload).remove();
            code = response.code;
            $('#list_messages_talk_alone').append(response.newmessagechat);
            $('#space-talk-messages').scrollTop($('#space-talk-messages')[0].scrollHeight);
            $('#tool-photo-chat-alone').show();
            break;
   }
}

function insertPhotoInChatAlone_Error(response) {
}

function insertPhotoInChatAlone(code, thephotofile) {

    thefile = $('#chat_photo_alone').val();
    var ext = thefile.split('.').pop().toLowerCase();
    if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
        _alert(msg_chat_error_photo_format);
        return;
    }

    if (thephotofile.size > sizePhotoMessage) {
        _alert(msg_chat_error_photo_large);
        return;
    }
    
    $('#tool-photo-chat-alone').hide();

    thedivpreload = code + Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5) + 'alone';
    thepreload_html = '<div id="' + thedivpreload + '" class="burblu_chat"><div class="in_me"><div class="message"><img src="' + _SITE_URL + 'themes/' + _THEME + '/imgs/preload.gif"></div><div class="clear"></div></div></div><div class="clear"></div>';
    
    $('#list_messages_talk_alone').append(thepreload_html);
    $('#space-talk-messages').scrollTop($('#space-talk-messages')[0].scrollHeight);

    var formData = new FormData($("#form_photo_chat_alone")[0]);
    formData.append("photo_chat", thephotofile);
    formData.append("cdus", code);
    
    var params = {
            type: 'POST',
            withFile: true,
            module: 'chat',
            action: 'insertphotoinchat',
            data: formData
    }

    invoke(params, insertPhotoInChatAlone_Ok, insertPhotoInChatAlone_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function insertFileInChatAlone_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            _alert(response.msgalert);
            break;

        case 'OK':
            $('#' + thedivpreload).remove();
            code = response.code;
            $('#list_messages_talk_alone').append(response.newmessagechat);
            $('#space-talk-messages').scrollTop($('#space-talk-messages')[0].scrollHeight);
            $('#tool-file-chat-alone').show();
            break;
   }
}

function insertFileInChatAlone_Error(response) {
}

function insertFileInChatAlone(code, theattachfile) {

    thefile = $('#chat_attachfile_alone').val();
    var ext = thefile.split('.').pop().toLowerCase();
    if($.inArray(ext, bad_ext_files.split(',')) != -1) {
        _alert(msg_chat_error_file_format);
        return;
    }

    if (theattachfile.size > sizeAttachMessage) {
        _alert(msg_chat_error_file_large);
        return;
    }
    
    $('#tool-file-chat-alone').hide();

    thedivpreload = code + Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5) + 'file' + 'alone';
    thepreload_html = '<div id="' + thedivpreload + '" class="burblu_chat"><div class="in_me"><div class="message"><img src="' + _SITE_URL + 'themes/' + _THEME + '/imgs/preload.gif"></div><div class="clear"></div></div></div><div class="clear"></div>';

    $('#list_messages_talk_alone').append(thepreload_html);
    $('#space-talk-messages').scrollTop($('#space-talk-messages')[0].scrollHeight);

    var formData = new FormData($("#form_attachfile_chat_alone")[0]);
    formData.append("attach_chat", theattachfile);
    formData.append("cdus", code);
    
    var params = {
            type: 'POST',
            withFile: true,
            module: 'chat',
            action: 'insertfileinchat',
            data: formData
    }

    invoke(params, insertFileInChatAlone_Ok, insertFileInChatAlone_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function reduceBoxes() {
    numreduce = NUM_CHATS_VISIBLE - NUM_BOX_ALLOW;

    thecode = BOXS_IN_CHAT_VISIBLE.pop();
    
    /*****************************/
    BOXS_IN_CHAT_HIDDEN.push(thecode);
    $('#inside-list-hidden').prepend(getHTMLUserHidden(thecode));
    /*****************************/
    
    $('#bch_' + thecode).addClass('invisible');
                
    NUM_CHATS_HIDE = NUM_CHATS_HIDE + 1;
    
    NUM_CHATS_VISIBLE = NUM_CHATS_VISIBLE - 1;

    $('#the-counter-hidden').show();
    $('#button-counter').html(NUM_CHATS_HIDE);

}

function extendBoxes() {
    numextend = NUM_BOX_ALLOW - NUM_CHATS_VISIBLE;
            
    boxchattoview = BOXS_IN_CHAT_HIDDEN[0];
    
    BOXS_IN_CHAT_HIDDEN.splice(0, 1);
    
    /*****************************/
    $('#bch_' + boxchattoview).removeClass('invisible');
    $('#oneitemhidden_' + boxchattoview).remove();
    /*****************************/
    
    BOXS_IN_CHAT_VISIBLE.push(boxchattoview);

    NUM_CHATS_HIDE = NUM_CHATS_HIDE - 1;
    
    NUM_CHATS_VISIBLE = NUM_CHATS_VISIBLE + 1;

    
    $('#button-counter').html(NUM_CHATS_HIDE);
    if (NUM_CHATS_HIDE <= 0) $('#the-counter-hidden').hide();
      
}

function resetNumBoxsChat(widthWin) {
    
    if (widthWindow >= 1014) NUM_BOX_ALLOW = 3;
    
    if (widthWindow < 1014 && widthWindow >= 785) NUM_BOX_ALLOW = 2;

    if (widthWindow < 785) NUM_BOX_ALLOW = 1;
    
    if (NUM_CHATS_VISIBLE > NUM_BOX_ALLOW) {
        reduceBoxes();
    } else {
        if (NUM_CHATS_VISIBLE < NUM_BOX_ALLOW) {
            if (NUM_CHATS_HIDE > 0) {
                extendBoxes();
            }
        }
    }
    
    if (widthWindow < 750) {
        SPACE_RIGHT_BOX_CHATS = 5;
    }
    
    if (widthWindow < 750 || widthWindow >= 1014) {
        $('#users-box-chat-bottom').hide();
        $('#space-for-chat').css('right', 0);
    } else {
        $('#users-box-chat-bottom').show();
        $('#space-for-chat').css('right', SPACE_RIGHT_BOX_CHATS);
    }
    
    // show box min of user in movil
    if (NUM_CHATS_ALL == 0) {
        if (widthWindow < 750) {
            $('#users-box-chat-bottom').show();
            $('#space-for-chat').css('right', SPACE_RIGHT_BOX_CHATS);
        }
    }

}

$(function() {
    
    widthBarChat = $('#sidebar-chat').width();
    SPACE_RIGHT_BOX_CHATS = widthBarChat;
    
    widthWindow = $(window).width();
    if (widthWindow >= 750 && widthWindow < 1014) {
        widthBoxUsers = $('#users-box-chat-bottom').width();
        SPACE_RIGHT_BOX_CHATS = widthBoxUsers;
    }
    
    resetNumBoxsChat(widthWindow);
    
    $('#space-for-chat').css('right', SPACE_RIGHT_BOX_CHATS);
    
    $(window).resize(function() {
    
        widthBarChat = $('#sidebar-chat').width();
        SPACE_RIGHT_BOX_CHATS = widthBarChat;

        widthWindow = $(window).width();
        if (widthWindow >= 750 && widthWindow < 1014) {
            widthBoxUsers = $('#users-box-chat-bottom').width();
            SPACE_RIGHT_BOX_CHATS = widthBoxUsers;
        }
        
        resetNumBoxsChat(widthWindow);
        
        $('#space-for-chat').css('right', SPACE_RIGHT_BOX_CHATS);

        widthWindow = $(window).width();

    });
    
    var viewListHides = false;
    $('#button-counter').click(function(){
        if (!viewListHides) {
            $('#button-counter').addClass('with-click');
            $('#list-hidden').show();
            viewListHides = true;
        } else {
            $('#button-counter').removeClass('with-click');
            $('#list-hidden').hide();
            viewListHides = false;
        }
        
    });
    
});



/*__________________________________________________________________*/
/*__________________________________________________________________*/

var handlerChatMax;
function loadFriendsOnline_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            $('#boxlist .area_online_chat').html(response.html_user_chat);
            $('#boxlist2bottom .area_online_chat').html(response.html_user_chat_bottom);
            
            handlerChatMax = setTimeout(loadFriendsOnline, _INTERVAL_CHECK_USER_ONLINE);
            break;
   }
}

function loadFriendsOnline_Error(response) {
}

function loadFriendsOnline() {

    var data = {
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'chat',
            action: 'friendschatonline',
            data: data
    }

    invoke(params, loadFriendsOnline_Ok, loadFriendsOnline_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

var handlerChatLive;
var activitiesChat;
function pulseChat_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            if (response.num_activities > 0) {

                var json_activities = JSON.parse(response.activities_chat);
                $.each(json_activities, function(i,item){

                    $('#the-list-messages-chat-' + json_activities[i].code).append(json_activities[i].html);
                    $('#the-list-messages-chat-' + json_activities[i].code).scrollTop($('#the-list-messages-chat-' + json_activities[i].code)[0].scrollHeight);                            
                });
            }
            handlerChatLive = setTimeout(pulseChat, _INTERVAL_PULSE_CHAT);
            break;
   }
}

function pulseChat_Error(response) {
}

function pulseChat() {

    var data = {
        lbox: CODESCHATS,
    }
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'chat',
            action: 'pulsechat',
            data: data
    }

    invoke(params, pulseChat_Ok, pulseChat_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function getChatAlone_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            if (response.num_activities > 0) {    
                $('#list_messages_talk_alone').append(response.html_chat);
                $('#space-talk-messages').scrollTop($('#space-talk-messages')[0].scrollHeight);
            }
            break;
   }
   handler_chat_alone = setTimeout(function(){
       getChatAlone(paramsArray[0]); 
   }, _INTERVAL_PULSE_CHAT);
}

function getChatAlone_Error(response) {
    alert(msg_error_conection); 
}

// En el chat activo alone, busca nuevos mensajes de chat y lo muestra en el chat alone.
function getChatAlone(code) {

    var data = {
        code: code,
    }
 
    paramsArray[0] = code;
    
    var params = {
            type: 'POST',
            withFile: false,
            module: 'chat',
            action: 'chatalone',
            data: data
    }

    invoke(params, getChatAlone_Ok, getChatAlone_Error);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function searchUserBox_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            $('#boxlist .area_online_chat').html(response.html_user_chat);
            break;
   }
}

function searchUserBox_Error(response) {
}

function searchUserBox() {
    
    clearInterval(handlerChatMax);
    
    var query = $.trim($('#inputsf').val());

    // If no letters remove the div not helpful
    if (query == '') {
        loadFriendsOnline();
        var milliseconds = 0;
    } else {
        clearInterval(handlerChatMax);
        $('#boxlist .area_online_chat').html('');
        var milliseconds = 100;
    }
    
    // It took us a few milliseconds so that more letters are entered to the consultation
    setTimeout(function() {
        if(query == $('#inputsf').val()) {
            if($.trim(query) == '') {
                //loadFriendsOnline();
            } else {
                
                var data = {
                    qry: query,
                }
                
                var params = {
                        type: 'POST',
                        withFile: false,
                        module: 'searchfriendchat',
                        action: 'searchfriendschat',
                        data: data,
                }
            
                invoke(params, searchUserBox_Ok, searchUserBox_Error);

            }
        }
    }, milliseconds);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/

function searchUserBox2_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            $('#boxlist2bottom .area_online_chat').html(response.html_user_chat);
            break;
   }
}

function searchUserBox2_Error(response) {
}

function searchUserBox2() {
    
    clearInterval(handlerChatMax);
    
    var query = $.trim($('#inputsf2').val());

    // If no letters remove the div not helpful
    if (query == '') {
        loadFriendsOnline();
        var milliseconds = 0;
    } else {
        clearInterval(handlerChatMax);
        $('#boxlist2bottom .area_online_chat').html('');
        var milliseconds = 100;
    }
    
    // It took us a few milliseconds so that more letters are entered to the consultation
    setTimeout(function() {
        if(query == $('#inputsf2').val()) {
            if($.trim(query) == '') {
                //loadFriendsOnline();
            } else {
                
                var data = {
                    qry: query,
                }
                
                var params = {
                        type: 'POST',
                        withFile: false,
                        module: 'searchfriendchat',
                        action: 'searchfriendschat2',
                        data: data,
                }
            
                invoke(params, searchUserBox2_Ok, searchUserBox2_Error);

            }
        }
    }, milliseconds);

}

/*__________________________________________________________________*/
/*__________________________________________________________________*/
