var display_phone = {
    operation: "",
    evaluation: "",
    answer: ""
};

function autoFocusInputPhone() {
    document.getElementById('display_phone').focus();
}
// default display values
$('#display_phone').val("");
// Digits
$('#phone_zero').on('click', function() {
    display_phone.operation = display_phone.operation + "0";
    $('#display_phone').val($('#display_phone').val() + '\u0030');
    autoFocusInputPhone();
})
$('#phone_one').on('click', function() {
    autoFocusInputPhone();
    display_phone.operation = display_phone.operation + "1";
    $('#display_phone').val($('#display_phone').val() + '\u0031');
})
$('#phone_two').on('click', function() {
    autoFocusInputPhone();
    display_phone.operation = display_phone.operation + "2";
    $('#display_phone').val($('#display_phone').val() + '\u0032');
})
$('#phone_three').on('click', function() {
    autoFocusInputPhone();
    display_phone.operation = display_phone.operation + "3";
    $('#display_phone').val($('#display_phone').val() + '\u0033');
})
$('#phone_four').on('click', function() {
    autoFocusInputPhone();
    display_phone.operation = display_phone.operation + "4";
    $('#display_phone').val($('#display_phone').val() + '\u0034');
})
$('#phone_five').on('click', function() {
    autoFocusInputPhone();
    display_phone.operation = display_phone.operation + "5";
    $('#display_phone').val($('#display_phone').val() + '\u0035');
})
$('#phone_six').on('click', function() {
    autoFocusInputPhone();
    display_phone.operation = display_phone.operation + "6";
    $('#display_phone').val($('#display_phone').val() + '\u0036');
})
$('#phone_seven').on('click', function() {
    autoFocusInputPhone();
    display_phone.operation = display_phone.operation + "7";
    $('#display_phone').val($('#display_phone').val() + '\u0037');
})
$('#phone_eight').on('click', function() {
    autoFocusInputPhone();
    display_phone.operation = display_phone.operation + "8";
    $('#display_phone').val($('#display_phone').val() + '\u0038');
})
$('#phone_nine').on('click', function() {
    autoFocusInputPhone();
    display_phone.operation = display_phone.operation + "9";
    $('#display_phone').val($('#display_phone').val() + '\u0039');
})
$('#phone_sao').on('click', function() {
    autoFocusInputPhone();
    display_phone.operation = display_phone.operation + "*";
    $('#display_phone').val($('#display_phone').val() + '*');
})
$('#phone_thang').on('click', function() {
    autoFocusInputPhone();
    display_phone.operation = display_phone.operation + "#";
    $('#display_phone').val($('#display_phone').val() + '#');
})
// Clear
$('#clear').on('click', function() {
    autoFocusInputPhone();
    display_phone.operation = "",
        display_phone.evaluation = "",
        $('#display_phone').val("");
})
// Backspace
$('#backspace').on('click', function() {
    autoFocusInputPhone();
    display_phone.operation = display_phone.operation.slice(0, display_phone.operation.length - 1);
    $('#display_phone').val($('#display_phone').val().slice(0, $('#display_phone').val().length - 1));
})
/*ACTION CALL*/
$(document).ready(function() {
    $(".phone_call_icon").click(function(event) {
        event.preventDefault;
        if ($(".content_dashbroad_phone").css("visibility") === "hidden") {
            $(".content_dashbroad_phone").css("visibility", "visible");
            $("#display_phone").focus();
        } else {
            $(".content_dashbroad_phone").css("visibility", "hidden");
        }
    });
});