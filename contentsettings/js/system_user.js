function ChangePassword() {
    var data = $('#system-user-form-change-password').serialize();
    var loadUrl = "index.php?r=aSystemUser/changePassword";
    $.ajax({
        url: loadUrl,
        dataType: 'json',
        type: 'POST',
        data: data,
        success: function (json) {
            if (json.status = true) {
                $('#display_message_area').html(json.msg);
            } else {
                $('#display_message_area').html(json.msg);
            }
        }
    });
}
