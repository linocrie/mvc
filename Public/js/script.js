$('#myAvatar').on('change', function (e) {
    if (!$(this).val().length) return false;
    $(this).parents('form').submit();
})

$("#send").click(function(event){
    event.preventDefault();
    let text = $('#text').val();
    let url = $(this).parents('form').attr('action');
    if(text.length > 0){
        $.ajax({
            type: 'POST',
            url,
            dataType: "json",
            data: {
                chat : text
            },
            success(response) {
                console.log(response)
                $("#chatList").append("<span class = 'ml-4 mt-3'>Me</span>")
                $("#chatList").append("<div class='d-flex my-msg m-3 bg-dark text-light flex-row p-2'><h5 class = 'ml-3 mb-0 bg-dark p-1 text-light' style = 'border-radius: 20px;'>" + response['body'] + "</h5></div>");
                $("#chatList").append("<span class = 'ml-4 mb-1'>" + response['date'] + "</span>")
                $("#text").val("");
            }
        });
    }

});
