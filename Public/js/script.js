

$('#myAvatar').on('change', function (e) {
    if (!$(this).val().length) return false;
    let url = $(this).parents('form').attr('action');
    let method = $(this).parents('form').attr('method');
    // console.log($(this).val())
    let formData = new FormData;
    formData.append('avatar', $(this).prop('files')[0]);
    $.ajax({
        url: url,
        method: method,
        data: formData,
        processData: false,
        contentType: false,
        success(response) {
            $('#userAvatar').attr('src', response)
            console.log(response);
        }
    })
})
