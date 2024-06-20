'use strict';
//Function load ring media call
function ringMedia(muted, autoplay) {
    document.getElementById('gum-local-incoming').muted = muted;
    document.getElementById('gum-local-incoming').autoplay = autoplay;
    document.getElementById('gum-local-incoming').load();
}
// Put variables in global scope to make them available to the browser console.
const remoteAudio = document.querySelector('#gum-local');
// Create our JsSIP instance and run it:
var socket = new JsSIP.WebSocketInterface('wss://' + configPhone.url + ':' + configPhone.port);
//JsSIP.debug.enable('JsSIP:*');
var configuration = {
    sockets: [socket],
    uri: 'sip:' + configPhone.exten + '@' + configPhone.domain,
    //register: true,
    //authorization_user: configPhone.exten,
    password: configPhone.password,
    //session_timers: false,
    //contact_uri : 'sip:' + configPhone.exten + '@' + configPhone.domain + ';transport=wss'
    session_timers: false,
    session_timers_refresh_method: 'invite',
    register_expires: 60
};
var ua = new JsSIP.UA(configuration);
ua.start();
//Register callbacks to tell us SIP Registration events
ua.on("registered", () => console.log('SIPPhone Registered with SIP Server'));
ua.on("unregistered", () => console.log('SIPPhone Unregistered with SIP Server'));
ua.on("registrationFailed", () => console.log('SIPPhone Failed Registeration with SIP Server'));
ua.on('newRTCSession', function(data) {
    console.log('News RTC session');
    let session = data.session;
    console.log('##################################');
    console.log('CONSOLE: ' + session.direction);
    console.log('##################################');
    if (session.direction === "incoming") {
        ringMedia(false, true);
        console.log('##################################');
        console.log('CONSOLE: ' + session.remote_identity.uri);
        console.log('##################################');
        //GET INFO CALLER
        $.ajax({
            url: configPhone.url_info_caller,
            type: "GET",
            data: {
                phone: session.remote_identity.uri.user,
                department: configPhone.department,
                userid: configPhone.userid
            },
            success: function(response) {
                //console.log(response);
                if (response.success == 1) {
                    let infoCaller = response.htmlCaller;
                    console.log('Session - User Incoming All ' + infoCaller);
                    $(".txt_show_call_number").html(infoCaller);
                    //Show modal customer when edit
                    $("#edit-in-calling-popup").modal('show');
                    $("#edit-in-calling-popup").css("z-index", "9993");
                    $(".setnull_textarea").val('');
                } else {
                    let infoCaller = response.htmlCaller;
                    console.log('Session - User Incoming All ' + infoCaller);
                    $(".txt_show_call_number").html(infoCaller);
                    //Hide add customer
                    $('#btn_customer_phone_popup').hide();
                    //Show modal customer when create
                    $("#customer-create").modal('show');
                    $("#customer-create").css("z-index", "9993");
                    $(".setnull_textarea").val('');
                }
            },
            error: function(error) {
                let infoCaller = 'Chưa rõ (' + session.remote_identity.uri.user + ')';
                console.log('Session - User Incoming All ' + infoCaller);
                $(".txt_show_call_number").html(infoCaller);
                //Show modal customer when create
                $("#customer-create").modal('show');
                $("#customer-create").css("z-index", "9993");
                $('#customer-create #phone').val(session.remote_identity.uri.user);
                $(".setnull_textarea").val('');
            }
        });
        //END GET INFO CALLER
        console.log('Session - Incoming call from ' + session.remote_identity);
        console.log('Session - User Incoming call from ' + session.remote_identity.uri.user);
        $(".p_call_incoming").show();
        $('.txt_show_call_time').html('Đang đổ chuông');
        $("#value_phone_call").val(session.remote_identity.uri.user);
        let acceptCallBtn = document.getElementById('btn-accept-call');
        let endlessCallBtn = document.getElementById('btn-endless-call');
        /*let rejectCallBtn = document.getElementById('btn-reject-call');   
        let makeCallBtn = document.getElementById('btn-make-call');     
        makeCallBtn.style.display = 'none';
        acceptCallBtn.style.display = 'inline-flex';
        rejectCallBtn.style.display = 'inline-flex';     */
        //Register for various incoming call session events
        session.on("accepted", () => {
            console.log('Incoming - call accepted');
            acceptCallBtn.style.display = 'none';
            ringMedia(true, true);
        });
        session.on("confirmed", (data) => {
            console.log('call confirmed');
            console.log('################HHHHHHHHHHHH##################');
            console.log('DATA: ' + data.cause);
            console.log('################HHHHHHHHHHHH##################');
            //Show timer run
            startTime();
            //$('.txt_show_call_time').html('Đang trò chuyện');
            ringMedia(true, true);
        });
        session.on("ended", () => {
            console.log('call ended');
            $(".p_call_incoming").hide();
            $(".p_call_outcalling").hide();
            //Pause run timer
            stopTime();
            //Add null text
            $('#call_timer').html('');
            $('.txt_show_call_time').html('Đã kết thúc');
            acceptCallBtn.style.display = 'inline-block';
            endlessCallBtn.style.display = 'inline-block';
            ringMedia(true, true);
            let callOptions = {
                mediaConstraints: {
                    audio: true,
                    video: false
                },
                sessionTimersExpires: 120
            };
            //session.answer(callOptions);
            if (!session.isEnded()) {
                session.terminate();
            }
        });
        session.on("failed", () => {
            console.log('call failed');
            $('.txt_show_call_time').html('Đã kết thúc');
            $(".p_call_incoming").hide();
            acceptCallBtn.style.display = 'inline-block';
            endlessCallBtn.style.display = 'inline-block';
            ringMedia(true, true);
            //Add null text
            $('#call_timer').html('');
            let callOptions = {
                mediaConstraints: {
                    audio: true,
                    video: false
                },
                sessionTimersExpires: 120
            };
            session.answer(callOptions);
            stopTime();
            if (!session.isEnded()) {
                session.terminate();
            }
        });
        session.on("peerconnection", () => {
            console.log('Incoming - Peer Connection');
            session.connection.addEventListener("track", (e) => {
                console.log('adding audio track');
                // set remote audio stream (to listen to remote audio)
                // remoteAudio is <audio> element on page
                remoteAudio.srcObject = e.streams[0];
                remoteAudio.play();
            })
        });
        acceptCallBtn.addEventListener('click', () => {
            let callOptions = {
                mediaConstraints: {
                    audio: true,
                    video: false
                },
                sessionTimersExpires: 120
            };
            session.answer(callOptions);
            startTime();
        });
        endlessCallBtn.addEventListener('click', () => {
            $(".p_call_incoming").hide();
            stopTime();
            if (!session.isEnded()) {
                session.terminate();
            }
        });
        /*rejectCallBtn.addEventListener('click', () => {
            session.answer(callOptions);
            setTimeout(() => {
                session.terminate();
            }, 1000);
        });*/
    }
    if (session.direction === "outgoing") {
        console.log('Session - Outgoing Call Event');
        console.log('##################################');
        console.log('CONSOLE OUTGOING: ' + session.status);
        console.log('##################################');
        let endCallBtn = document.getElementById('btn-end-call');
        let makeCallBtn = document.getElementById('btn-make-call');
        /*makeCallBtn.style.display = 'none';
        endCallBtn.style.display = 'inline-flex';*/
        //endCallBtn.addEventListener('click', () => session.terminate());
        //Register for various call session events:
        session.on('progress', function(e) {
            console.log('Outgoing - call is in progress');
            $("#call_status").show();
            $("#call_progress").show();
            $("#call_confirmed").hide();
            $("#phone_call_now").hide();
            $("#phone_call_end").show();
            //Modal
            $("#call_status_modal").show();
            $("#call_progress_modal").show();
            $("#call_confirmed_modal").hide();
            //Add null text
            $('#call_timer_dashboard').html('00:00:00');
            $('#call_timer_dashboard_modal').html('00:00:00');
        });
        session.on('failed', function(e) {
            if (!session.isEnded()) {
                session.terminate();
            }
            console.log('Outgoing - call failed with cause: ' + e.cause);
            if (e.cause === JsSIP.C.causes.SIP_FAILURE_CODE) {
                console.log('  Called party may not be reachable');
            };
            $("#call_status").hide();
            $("#call_progress").hide();
            $("#call_confirmed").hide();
            $("#phone_call_now").show();
            $("#phone_call_end").hide();
            $(".content_dashbroad_phone").css("visibility", "hidden");
            //Modal
            $("#call_status_modal").hide();
            $("#call_progress_modal").hide();
            $("#call_confirmed_modal").hide();
            $(".p_call_outcalling").hide();
            //Pause run timer
            stopTime();
            //Add null text
            $('#call_timer_dashboard').html('00:00:00');
            $('#call_timer_dashboard_modal').html('00:00:00');
        });
        session.on('confirmed', function(e) {
            console.log('Outgoing - call confirmed');
            $("#call_status").show();
            $("#call_confirmed").show();
            $("#call_progress").hide();
            $("#phone_call_now").hide();
            $("#phone_call_end").show();
            //Modal
            $("#call_status_modal").show();
            $("#call_confirmed_modal").show();
            $("#call_progress_modal").hide();
            //Show timer run
            //Add null text
            $('#call_timer_dashboard').html('00:00:00');
            $('#call_timer_dashboard_modal').html('00:00:00');
            startTime();
        });
        session.on('ended', function(e) {
            console.log('Outgoing - call ended with cause: ' + e.cause);
            $("#call_status").hide();
            $("#call_progress").hide();
            $("#call_confirmed").hide();
            $("#phone_call_now").show();
            $("#phone_call_end").hide();
            //Modal
            $("#call_status_modal").hide();
            $("#call_progress_modal").hide();
            $("#call_confirmed_modal").hide();
            $(".p_call_outcalling").hide();
            //Pause run timer
            stopTime();
            //Add null text
            $('#call_timer_dashboard').html('00:00:00');
            $('#call_timer_dashboard_modal').html('00:00:00');
            //session.terminate();
            if (!session.isEnded()) {
                session.terminate();
            }
        });
        //Note: peerconnection never fires for outoing, but I'll leave it here anyway.
        session.on('peerconnection', () => console.log('Outgoing - Peer Connection'));
        //Note: 'connection' is the RTCPeerConnection instance - set after calling ua.call().
        //    From this, use a WebRTC API for registering event handlers.
        session.connection.addEventListener("track", (e) => {
            console.log('add outgoing audio track');
            remoteAudio.srcObject = e.streams[0];
            remoteAudio.play();
        });
        //Handle Browser not allowing access to mic and speaker
        session.on('getusermediafailed', function(DOMError) {
            console.log('Get User Media Failed Call Event ' + DOMError)
        });
    }
    $("#phone_call_end_modal").click(function(event) {
        event.preventDefault();
        $("#call_status").hide();
        $("#call_progress").hide();
        $("#call_confirmed").hide();
        $("#phone_call_now").show();
        $("#phone_call_end").hide();
        $('#display_phone').val('');
        $(".p_call_outcalling").hide();
        //Add null text
        $('#call_timer_dashboard').html('00:00:00');
        $('#call_timer_dashboard_modal').html('00:00:00');
        //session.terminate();
        stopTime();
        if (!session.isEnded()) {
            session.terminate();
        }
    });
});
let MakeCallBtn = document.getElementById('phone_call_now');
MakeCallBtn.addEventListener('click', () => {
    console.log('Making Call...');
    let numberPhoneCusomerNow = $('#display_phone').val();
    //Add null text 
    $('#call_timer_dashboard').html('00:00:00');
    $('#call_timer_dashboard_modal').html('00:00:00');
    //Hide phone dashbroash
    $(".content_dashbroad_phone").css("visibility", "hidden");
    //Display Call Out Modal
    $(".p_call_outcalling").show();
    //Show phone number to modal 
    $('.txt_show_call_number_modal').html(numberPhoneCusomerNow);
    //GET INFO CALLER
    $.ajax({
        url: configPhone.url_info_caller,
        type: "GET",
        data: {
            phone: numberPhoneCusomerNow,
            department: 0,
            userid: configPhone.userid
        },
        success: function(response) {
            //console.log(response);
            if (response.success == 1) {
                let infoCaller = response.htmlCaller;
                console.log('Session - User Incoming All ' + infoCaller);
                $(".txt_show_call_number").html(infoCaller);
                $('.txt_show_call_number_modal').html(infoCaller);
                //Show modal customer when edit
                //$("#edit-in-calling-popup").modal('show');
                $("#edit-in-calling-popup").css("z-index", "9993");
                $(".setnull_textarea").val('');
            } else {
                let infoCaller = response.htmlCaller;
                console.log('Session - User Incoming All ' + infoCaller);
                $(".txt_show_call_number").html(infoCaller);
                $('.txt_show_call_number_modal').html(infoCaller);
                //Hide add customer
                $('#btn_customer_phone_popup').hide();
                //Show modal customer when create
                //$("#customer-create").modal('show');
                $("#customer-create").css("z-index", "9993");
                $(".setnull_textarea").val('');
            }
        },
        error: function(error) {
            let infoCaller = 'Chưa rõ (' + numberPhoneCusomerNow + ')';
            console.log('Session - User Incoming All ' + infoCaller);
            $(".txt_show_call_number").html(infoCaller);
            $('.txt_show_call_number_modal').html(infoCaller);
            //Show modal customer when create
            //$("#customer-create").modal('show');
            $("#customer-create").css("z-index", "9993");
            $('#customer-create #phone').val(numberPhoneCusomerNow);
            $(".setnull_textarea").val('');
        }
    });
    //END GET INFO CALLER
    //startTime();
    /*if(numberPhoneCusomerNow.length > 10 || numberPhoneCusomerNow.length < 10){
        $('#error-message').html('Bạn hãy nhập đúng số điện thoại.');
        return false;
    }else{
        $('#error-message').html('');
    }*/
    let callOptions = {
        mediaConstraints: {
            audio: true,
            video: false
        },
        sessionTimersExpires: 120
    };
    ua.call('sip:' + numberPhoneCusomerNow + '@' + configPhone.domain, callOptions);
});
//Enter call phone
var inputPhone = document.getElementById("display_phone");
inputPhone.addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        event.preventDefault();
        console.log('Making Call...');
        let numberPhoneCusomerNow = $('#display_phone').val();
        //Add null text
        $('#call_timer_dashboard').html('00:00:00');
        $('#call_timer_dashboard_modal').html('00:00:00');
        //Hide phone dashbroash
        $(".content_dashbroad_phone").css("visibility", "hidden");
        //Display Call Out Modal
        $(".p_call_outcalling").show();
        //GET INFO CALLER
        $.ajax({
            url: configPhone.url_info_caller,
            type: "GET",
            data: {
                phone: numberPhoneCusomerNow,
                department: 0,
                userid: configPhone.userid
            },
            success: function(response) {
                //console.log(response);
                if (response.success == 1) {
                    let infoCaller = response.htmlCaller;
                    console.log('Session - User Incoming All ' + infoCaller);
                    $(".txt_show_call_number").html(infoCaller);
                    $('.txt_show_call_number_modal').html(infoCaller);
                    //Show modal customer when edit
                    //$("#edit-in-calling-popup").modal('show');
                    $("#edit-in-calling-popup").css("z-index", "9993");
                    $(".setnull_textarea").val('');
                } else {
                    let infoCaller = response.htmlCaller;
                    console.log('Session - User Incoming All ' + infoCaller);
                    $(".txt_show_call_number").html(infoCaller);
                    $('.txt_show_call_number_modal').html(infoCaller);
                    //Hide add customer
                    $('#btn_customer_phone_popup').hide();
                    //Show modal customer when create
                    //$("#customer-create").modal('show');
                    $("#customer-create").css("z-index", "9993");
                    $(".setnull_textarea").val('');
                }
            },
            error: function(error) {
                let infoCaller = 'Chưa rõ (' + numberPhoneCusomerNow + ')';
                console.log('Session - User Incoming All ' + infoCaller);
                $(".txt_show_call_number").html(infoCaller);
                $('.txt_show_call_number_modal').html(infoCaller);
                //Show modal customer when create
                //$("#customer-create").modal('show');
                $("#customer-create").css("z-index", "9993");
                $('#customer-create #phone').val(numberPhoneCusomerNow);
                $(".setnull_textarea").val('');
            }
        });
        //END GET INFO CALLER
        let callOptions = {
            mediaConstraints: {
                audio: true,
                video: false
            },
            sessionTimersExpires: 120
        };
        ua.call('sip:' + numberPhoneCusomerNow + '@' + configPhone.domain, callOptions);
    }
});
$(document).ready(function() {
    $(".call_jssip_customer_now").click(function(event) {
        event.preventDefault();
        //Reset value text area #note_in_calling
        //alert(333444);
        let numberPhoneCusomerNow = $(this).attr("data-phone");
        let nameCusomerNow = $(this).attr("data-name");
        let nameDisplay = '';
        //Check display name && phone
        if (nameCusomerNow) {
            nameDisplay = 'Khách hàng: ' + nameCusomerNow + ' - Điện thoại: ' + numberPhoneCusomerNow;
            //Show phone number to modal
            $('.txt_show_call_number_modal').html(nameDisplay);
        } else {
            nameDisplay = 'Khách hàng: ' + numberPhoneCusomerNow;
            //Show phone number to modal
            $('.txt_show_call_number_modal').html(nameDisplay);
        }
        //Add null text
        $('#call_timer_dashboard').html('00:00:00');
        $('#call_timer_dashboard_modal').html('00:00:00');
        //Hide phone dashbroash
        $(".content_dashbroad_phone").css("visibility", "hidden");
        //Display Call Out Modal
        $(".p_call_outcalling").show();
        //Show call interface
        //$(".content_dashbroad_phone").show();
        $("#call_status").show();
        $("#call_progress").show();
        $("#call_confirmed").hide();
        $("#phone_call_now").hide();
        $("#phone_call_end").show();
        let callOptions = {
            mediaConstraints: {
                audio: true,
                video: false
            },
            sessionTimersExpires: 120
        } // mediaStream: window.stream
        //ua.call(numberPhoneCusomerNow, callOptions);
        ua.call('sip:' + numberPhoneCusomerNow + '@' + configPhone.domain, callOptions);
    });
    /*End Phone call now*/
    /*Stop Call*/
    $(".close_call_modal").click(function(event) {
        event.preventDefault();
        if (!session.isEnded()) {
            session.terminate();
        }
        $("#call_status_modal").hide();
        $("#call_progress_modal").hide();
        $("#call_confirmed_modal").hide();
    });
    $("#phone_call_end").click(function(event) {
        event.preventDefault();
        if (!session.isEnded()) {
            session.terminate();
        }
        $("#call_status").hide();
        $("#call_progress").hide();
        $("#call_confirmed").hide();
        $("#phone_call_now").show();
        $("#phone_call_end").hide();
        $('#display_phone').val('');
        //Add null text
        $('#call_timer_dashboard').html('00:00:00');
        $('#call_timer_dashboard_modal').html('00:00:00');
    });
    /*End Stop Call*/
    $(".call_jssip_customer_header_now").click(function(event) {
        event.preventDefault();
        //scrollTop
        //
        let numberPhoneCusomerNow = $(this).attr("data-phone");
        let nameCusomerNow = $(this).attr("data-name");
        let nameDisplay = '';
        //Check display name && phone
        if (nameCusomerNow) {
            nameDisplay = 'Khách hàng: ' + nameCusomerNow + ' - Điện thoại: ' + numberPhoneCusomerNow;
            //Show phone number to modal
            $('.txt_show_call_number_modal').html(nameDisplay);
        } else {
            nameDisplay = 'Khách hàng: ' + numberPhoneCusomerNow;
            //Show phone number to modal
            $('.txt_show_call_number_modal').html(nameDisplay);
        }
        //Add null text
        $('#call_timer_dashboard').html('00:00:00');
        $('#call_timer_dashboard_modal').html('00:00:00');
        //Hide phone dashbroash
        $(".content_dashbroad_phone").css("visibility", "hidden");
        //Display Call Out Modal
        $(".p_call_outcalling").show();
        //Show call interface
        //$(".content_dashbroad_phone").show();
        $("#call_status").show();
        $("#call_progress").show();
        $("#call_confirmed").hide();
        $("#phone_call_now").hide();
        $("#phone_call_end").show();
        let callOptions = {
            mediaConstraints: {
                audio: true,
                video: false
            },
            sessionTimersExpires: 120
        } // mediaStream: window.stream
        ua.call(numberPhoneCusomerNow, callOptions);
        window.scrollTo(0, 0);
    });
});