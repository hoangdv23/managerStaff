$(".apps-menu .nk-menu-item").click(function(){
    $(".nk-menu-content-admin").hide();
});

function checkAll(elm, parent){
    const _checked = $(elm).is(':checked') ? 1 : 0                
    $(elm).closest(parent).find(':checkbox').not(elm).prop('checked', _checked)
}


$(function() {
    $('.money-edit').simpleMoneyFormat();
    $('.convert_second_to_minutes').simpleMoneyFormat();
});

Livewire.on('scrollChatBottom',()=>{
    $(document).ready(function() {
        //alert('Hello World!');
        $(".nk-chat-panel").animate({ scrollTop: $('.nk-chat-panel').prop("scrollHeight")}, 1000);
    });
});

Livewire.on('removedataInboxConversationPutToSession',()=>{
    $(document).ready(function() {
        //alert('Hello World!');
        $("#removedataInboxConversationPutToSession").html("");
    });
});

var offsetUser = 0;
function userLoadOAZaloChat() {
    // Lấy phần tử có thể cuộn
    var scrollableDiv = document.getElementById('userLoadOAZaloChat');
    // Event bottom
    if (scrollableDiv.scrollTop + scrollableDiv.clientHeight === scrollableDiv.scrollHeight){
      console.log('Emit Success!');
      offsetUser = offsetUser + 10;
      Livewire.emit('userLoadOAZaloChat', offsetUser);
    }
  }

//Format date JS
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [day, month, year].join('_');
}  