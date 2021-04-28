$('#myAvatar').on('change', function (e) {
    if (!$(this).val().length) return false;
    $(this).parents('form').submit();
})