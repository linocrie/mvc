$(document).ready(function () {
    if ($('#chatList').length) scrollToView();
})

$('#myAvatar').on('change', function (e) {
    if (!$(this).val().length) return false;
    $(this).parents('form').submit();
})//sa kap chuni

$("#chatForm").submit(function(event){
    event.preventDefault();
    let text = $('#text').val();
    if(!text.length) return;
    $.ajax({
        type: 'POST',
        url: `/account/send_msg/${toUserId}`,
        dataType: "json",
        data: {
            chat : text
        },
        success(response) {
            $('#text').val('');
        }
    })
})
$('#text').on('keyup', function (e) {
    e.preventDefault();
    if (e.keyCode === 13) $("#chatForm").submit();
})

function check_msg_id () {
    $.ajax({
        type:'GET',
        url: `/account/get_last_msg_id/${toUserId}`,
        dataType: "json",
        success: function(response){
            if(response > lastId){
                get_msgs();
            }
        }
    })
}
setInterval(check_msg_id,500);

function get_msgs() {
    let last_id = $('.msgItem').last().data('id');
    let url = `/account/get_msgs_ajax/${toUserId}/${last_id || lastId}`;
    $.ajax({
        type:'GET',
        url,
        dataType: "json",
        success: function(response){
            for (let i = 0; i < response.length; i++) {
                printMsg(response[i])
            }
            lastId = response[response.length - 1].id;
        }
    })
}


function printMsg(msg) {
    if(userId !== Number(msg.from_id)){
        $("#chatList").append("<span class='text-secondary ml-3 mt-3' style='font-size: 15px'>"+toUserName+"</span>")
        $("#chatList").append("<div class='msg-part ml-3 msgItem' data-id='"+msg['id']+"'><p class='mb-0 float-left bg-light' style='font-size: 20px; padding: 0 15px 5px 15px;border-radius: 25px;'>"+msg['body']+"</p></div>")
        $("#chatList").append("<span class='ml-3 mb-1 text-secondary' style='font-size: 10px'>"+msg['date'].slice(11,-3)+"</span>")
    } else {
        $("#chatList").append("<div class='mr-3'><span class='text-secondary float-right' style='font-size: 15px'>"+userName+"</span></div>")
        $("#chatList").append("<div class='msg-part mr-3 msgItem' data-id='"+msg['id']+"'><p class='mb-0 float-right bg-light' style='font-size: 20px; padding: 0 15px 5px 15px;border-radius: 25px;'>"+msg['body']+"</p></div>")
        $("#chatList").append("<div class='mr-3'><span class='mb-1 text-secondary float-right' style='font-size: 10px'>"+msg['date'].slice(11,-3)+"</span></div>")
    }
    scrollToView();
}

function scrollToView() {
    let chatList = $('#chatList');
    let elem = $(chatList).find('.msgItem').last()[0];
    elem.scrollIntoView({behavior: "smooth"});
}