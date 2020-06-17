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

/*************************************/
// FOR MENU TOP
// Necessary for the management of the top menu, the dashboard

var isVisibleMenuMore=false;
var isVisibleNotifPeople = false;
var isVisibleNotifMessage = false;
var isVisibleNotif = false;

var numNotificationsPeople, numNotificationsMessages, numNotificationsGlobal, theNotificationsPeople, theNotificationsMessage, theNotificationsGlobal;

/**************************************************************************/
/**************************************************************************/

function openMenuMore() {
    closeEmerged();
    $('#ico-more').removeClass('luminity');
    $('#area-menu-more').show();
    isVisibleMenuMore = true;
}

function closeMenuMore() {
    $('#ico-more').addClass('luminity');
    $('#area-menu-more').hide();
    isVisibleMenuMore = false;
}

/**************************************************************************/
/**************************************************************************/

var isVisibleMenuResponsive=false;
function openMenuResponsive() {
    closeEmerged();
    $('#dash-menu-responsive').show();
    isVisibleMenuResponsive = true;
}

function closeMenuResponsive() {
    $('#dash-menu-responsive').hide();
    isVisibleMenuResponsive = false;
}

/**************************************************************************/
/**************************************************************************/

function openNotifPeople_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            $('#area-notif-people #inside-info').html(response.html_notifications);
            $('#area-notif-people').show();
            break;            
   }
}

function openNotifPeople_Error(response) {
}

function openNotifPeople() {
    
    clearTimeout(theNotificationsPeople);
    $('#num_notif_people').hide();

    closeEmerged();

    $('#ico-not-people').removeClass('luminity');
    $('#area-notif-people').show();
    isVisibleNotifPeople = true;

    var data = {
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'getnotifications',
            action: 'people',
            data: data
    };

    invoke(params, openNotifPeople_Ok, openNotifPeople_Error);

}

function closeNotifPeople() {
    $('#ico-not-people').addClass('luminity');
    $('#area-notif-people').hide();
    isVisibleNotifPeople = false;
    checkNotificationsPeople();
}

/**************************************************************************/
/**************************************************************************/

function openNotifMessage_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            $('#area-notif-message #inside-info').html(response.htmlmessages);
            $('#area-notif-message').show();
            break;            
   }
}

function openNotifMessage_Error(response) {
}

function openNotifMessage() {
    
    clearTimeout(theNotificationsMessage);
    $('#num_notif_message').hide();
    $('#left-num-messages').hide();

    closeEmerged();

    $('#ico-not-message').removeClass('luminity');
    $('#area-notif-message').show();
    isVisibleNotifMessage = true;

    var data = {
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'getnotifications',
            action: 'messages',
            data: data
    };

    invoke(params, openNotifMessage_Ok, openNotifMessage_Error);

}

function closeNotifMessage() {
    $('#ico-not-message').addClass('luminity');
    $('#area-notif-message').hide();
    isVisibleNotifMessage = false;
    checkNotificationsMessages();
}

/**************************************************************************/
/**************************************************************************/

function openNotifGlobal_Ok(response) {
   switch (response.status) {
        case 'ERROR':
            break;

        case 'OK':
            $('#area-notif-global #inside-info').html(response.html_notifications);
            $('#area-notif-global').show();
            break;            
   }
}

function openNotifGlobal_Error(response) {
}

function openNotifGlobal() {
    
    clearTimeout(theNotificationsGlobal);
    $('#num_notif_global').hide();

    closeEmerged();

    $('#ico-not-global').removeClass('luminity');
    $('#area-notif-global').show();
    isVisibleNotif = true;

    var data = {
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'getnotifications',
            action: 'global',
            data: data
    };

    invoke(params, openNotifGlobal_Ok, openNotifGlobal_Error);

}

function closeNotifGlobal() {
    $('#ico-not-global').addClass('luminity');
    $('#area-notif-global').hide();
    isVisibleNotif = false;
    checkNotificationsGlobal();
}

/**************************************************************************/
/**************************************************************************/

function checkNotificationsPeople_Ok(response) {
    switch (response.status) {
        case 'ERROR':
            numNotificationsPeople = parseInt(response.message);
            if (numNotificationsPeople <= 0) {
                $('#num_notif_people').hide();
                $('#num_notif_people span').html(0);
                numNotificationsPeople = 0;
                $('#ico-not-people').addClass('luminity');
            }
            break;
    
        case 'OK':
            numNotificationsPeople = parseInt(response.html);
            if ( numNotificationsPeople > 0 ) {
                $('#num_notif_people span').html(numNotificationsPeople);
                $('#num_notif_people').show();
                $('#ico-not-people').removeClass('luminity');
            }
            break;            
    }
    if (_WITH_NOTIFIER) {
        if (!document.hasFocus()) {
            titlenotifier.set(numNotificationsPeople + numNotificationsMessages + numNotificationsGlobal);
        }
    }

    theNotificationsPeople = setTimeout(checkNotificationsPeople, interval_notifications_people);
}

function checkNotificationsPeople_Error(response) {
}

function checkNotificationsPeople() {

    var data = {
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'checknotifications',
            action: 'people',
            data: data
    };

    invoke(params, checkNotificationsPeople_Ok, checkNotificationsPeople_Error);

}

/**************************************************************************/
/**************************************************************************/

function checkNotificationsGlobal_Ok(response) {
    switch (response.status) {
        case 'ERROR':
            numNotificationsGlobal = parseInt(response.message);
            if (numNotificationsGlobal <= 0) {
                $('#num_notif_global').hide();
                $('#num_notif_global span').html(0);
                numNotificationsGlobal = 0;
                $('#ico-not-global').addClass('luminity');
            }
            break;
    
        case 'OK':
            numNotificationsGlobal = parseInt(response.html);
            if ( numNotificationsGlobal > 0 ) {
                $('#num_notif_global span').html(numNotificationsGlobal);
                $('#num_notif_global').show();
                $('#ico-not-global').removeClass('luminity');
            }
            break;            
    }
    if (_WITH_NOTIFIER) {
        if (!document.hasFocus()) {
            titlenotifier.set(numNotificationsPeople + numNotificationsMessages + numNotificationsGlobal);
        }
    }

    theNotificationsGlobal = setTimeout(checkNotificationsGlobal, interval_notifications_global);
}

function checkNotificationsGlobal_Error(response) {
}

function checkNotificationsGlobal() {

    var data = {
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'checknotifications',
            action: 'global',
            data: data
    };

    invoke(params, checkNotificationsGlobal_Ok, checkNotificationsGlobal_Error);

}

/**************************************************************************/
/**************************************************************************/

function checkNotificationsMessages_Ok(response) {
    switch (response.status) {
        case 'ERROR':
            numNotificationsMessages = parseInt(response.message);
            if (numNotificationsMessages <= 0) {
                $('#num_notif_message').hide();
                $('#num_notif_message span').html(0);
                numNotificationsMessages = 0;
                $('#ico-not-message').addClass('luminity');

                // too in menu left
                $('#left-num-messages').hide();
                $('#left-num-messages').html('');
            }
            break;
    
        case 'OK':
            numNotificationsMessages = parseInt(response.html);
            if ( numNotificationsMessages > 0 ) {
                $('#num_notif_message span').html(numNotificationsMessages);
                $('#num_notif_message').show();
                $('#ico-not-message').removeClass('luminity');

                // too in menu left
                $('#left-num-messages').html(numNotificationsMessages);
                $('#left-num-messages').show();
            }
            break;            
    }
    if (_WITH_NOTIFIER) {
        if (!document.hasFocus()) {
            titlenotifier.set(numNotificationsPeople + numNotificationsMessages + numNotificationsGlobal);
        }
    }

    theNotificationsMessage = setTimeout(checkNotificationsMessages, interval_notifications_messages);
}

function checkNotificationsMessages_Error(response) {
}

function checkNotificationsMessages() {

    var data = {
    };

    var params = {
            type: 'POST',
            withFile: false,
            module: 'checknotifications',
            action: 'messages',
            data: data
    };

    invoke(params, checkNotificationsMessages_Ok, checkNotificationsMessages_Error);

}


/**************************************************************************/
/**************************************************************************/

function markMenuLeft(section) {
    switch (section) {
        case 'settings':
            $('.opc-menu-left').removeClass('active');
            $('#'+ _ID_MENU_LEFT+ ' .opc-menu-left').addClass('active');
            break;

        case 'admin':
            $('.opc-menu-left').removeClass('active');
            $('#'+ _ID_MENU_LEFT+ ' .opc-menu-left').addClass('active');
            break;

        case 'dashboard':
            $('.opc-menu-left').removeClass('active');
            $('#'+ _ID_MENU_LEFT+ ' .opc-menu-left').addClass('active');
            break;

    }
}

/**************************************************************************/
/**************************************************************************/


function makeMenuResp(section) {
    switch (section) {
        case 'settings':        
            html_inside_menu_responsive = _menu_resp_settings;
            break;

        case 'admin':
            html_inside_menu_responsive = _menu_resp_admin;
            break;

        case 'dashboard':
            html_inside_menu_responsive = _menu_resp_dashboard;
            break;

    }
}

/**************************************************************************/
/**************************************************************************/