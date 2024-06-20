var display_phone = {
    operation: "",
    evaluation: "",
    answer: ""
};

// default display values
$('#ua-uri').val("");

// Digits
$('#phone_zero').on('click', function () {
    display_phone.operation = display_phone.operation + "0";
    $('#ua-uri').val($('#ua-uri').val() + '\u0030');
})

$('#phone_one').on('click', function () {
    display_phone.operation = display_phone.operation + "1";
    $('#ua-uri').val($('#ua-uri').val() + '\u0031');
})

$('#phone_two').on('click', function () {
    display_phone.operation = display_phone.operation + "2";
    $('#ua-uri').val($('#ua-uri').val() + '\u0032');
})

$('#phone_three').on('click', function () {
    display_phone.operation = display_phone.operation + "3";
    $('#ua-uri').val($('#ua-uri').val() + '\u0033');
})

$('#phone_four').on('click', function () {
    display_phone.operation = display_phone.operation + "4";
    $('#ua-uri').val($('#ua-uri').val() + '\u0034');
})

$('#phone_five').on('click', function () {
    display_phone.operation = display_phone.operation + "5";
    $('#ua-uri').val($('#ua-uri').val() + '\u0035');
})

$('#phone_six').on('click', function () {
    display_phone.operation = display_phone.operation + "6";
    $('#ua-uri').val($('#ua-uri').val() + '\u0036');
})

$('#phone_seven').on('click', function () {
    display_phone.operation = display_phone.operation + "7";
    $('#ua-uri').val($('#ua-uri').val() + '\u0037');
})

$('#phone_eight').on('click', function () {
    display_phone.operation = display_phone.operation + "8";
    $('#ua-uri').val($('#ua-uri').val() + '\u0038');
})

$('#phone_nine').on('click', function () {
    display_phone.operation = display_phone.operation + "9";
    $('#ua-uri').val($('#ua-uri').val() + '\u0039');
})

$('#phone_sao').on('click', function () {
    display_phone.operation = display_phone.operation + "*";
    $('#ua-uri').val($('#ua-uri').val() + '*');
})

$('#phone_thang').on('click', function () {
    display_phone.operation = display_phone.operation + "#";
    $('#ua-uri').val($('#ua-uri').val() + '#');
})
              

// Clear
$('#clear').on('click', function () {
    display_phone.operation = "",
    display_phone.evaluation = "",
    $('#ua-uri').val("");
})

// Backspace
$('#backspace').on('click', function () {    
    display_phone.operation = display_phone.operation.slice(0, display_phone.operation.length-1);
    $('#ua-uri').val($('#ua-uri').val().slice(0, $('#ua-uri').val().length-1));
    
    
})





/*ACTION CALL*/
$(document).ready(function(){
    $(".phone_call_icon").click(function(event){
            event.preventDefault();
            $('.content_dashbroad_phone').toggle();
    });

   let inputPhone = $('#ua-uri');
   let button = document.querySelector("#ua-invite-submit");
    button.disabled = true;

     $("#backspace").click(function(){
           if(inputPhone.val() == '' || inputPhone.val().length < 10) {
                button.disabled = true;
            } else {
                button.disabled = false;
            }
    });

     $(".c-push-number button").click(function(){
           if(inputPhone.val() == '' || inputPhone.val().length < 10) {
                button.disabled = true;
            } else {
                button.disabled = false;
            }
    });

     inputPhone.on('input change', function() {
        if(inputPhone.val() == '' || inputPhone.val().length < 10) {
            button.disabled = true;
        } else {
            button.disabled = false;
        }
    });


    


});