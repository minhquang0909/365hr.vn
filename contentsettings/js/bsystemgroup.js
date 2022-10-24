function selectAllPermission(checkbox) {
    var subfix = $(checkbox).val();
    if ($('#all_id_' + subfix).is(':checked')) {
        $('#view_id_' + subfix).attr('checked', true);
        $('#publish_id_' + subfix).attr('checked', true);
        $('#edit_id_' + subfix).attr('checked', true);
        $('#add_id_' + subfix).attr('checked', true);
        $('#del_id_' + subfix).attr('checked', true);
    } else {
        $('#view_id_' + subfix).attr('checked', false);
        $('#publish_id_' + subfix).attr('checked', false);
        $('#edit_id_' + subfix).attr('checked', false);
        $('#add_id_' + subfix).attr('checked', false);
        $('#del_id_' + subfix).attr('checked', false);
    }
}

function changeStatus(id, status) {
    var loadUrl = ADM_HOST_PATH + "index.php?r=aSystemuser/active";
    var data = {'status': status, 'userId': id};
    if (status == 1) {
        var message = INACTIVE;
    } else {
        var message = ACTIVE;
    }
    jConfirm(
        message,
        COMFIRM,
        function (r) {
            if (r == true) {
                $.ajax({
                    url: loadUrl,
                    dataType: 'json',
                    type: 'POST',
                    data: data,
                    success: function (json) {
                        if (json.status == true) {
                            if (status == 0) {
                                $("#active_status" + id).html('');
                                $("#inactive_status" + id).html('');
                                $("#active_status" + id).html("<img onclick='changeStatus(\"" + id + "\",1);' class='active_status' title='' src='" + ADM_HOST_PATH + "/images/icons/tick.png' />");
                            } else {
                                $("#active_status" + id).html('');
                                $("#active_status" + id).html('');
                                $("#active_status" + id).html("<img onclick='changeStatus(\"" + id + "\",0);' class='active_status' title='' src='" + ADM_HOST_PATH + "/images/icons/publish_x.png' />");
                            }

                        } else {
                        }
                    }
                });
            }
        });
}

function changeActiveGroup(id, status) {
    var csrf = $("#csrf").val();
    var loadUrl = ADM_HOST_PATH + "index.php?r=aSystemgroup/active";
    var data = {'status': status, 'id': id, 'YII_CSRF_TOKEN': csrf};
    if (status == 1) {
        var message = INACTIVE_GROUP;
    } else {
        var message = ACTIVE_GROUP;
    }
    jConfirm(
        message,
        COMFIRM,
        function (r) {
            if (r == true) {
                $.ajax({
                    url: loadUrl,
                    dataType: 'json',
                    type: 'POST',
                    data: data,
                    success: function (json) {
                        if (json.status == true) {
                            if (status == 0) {
                                $("#active_status" + id).html('');
                                $("#inactive_status" + id).html('');
                                $("#active_status" + id).html("<img onclick='changeActiveGroup(" + id + ",1);' class='active_status' title='' src='" + ADM_HOST_PATH + "/images/icons/tick.png' />");
                            } else {
                                $("#active_status" + id).html('');
                                $("#active_status" + id).html('');
                                $("#active_status" + id).html("<img onclick='changeActiveGroup(" + id + ",0);' class='active_status' title='' src='" + ADM_HOST_PATH + "/images/icons/publish_x.png' />");
                            }

                        } else {
                        }
                    }
                });
            }
        });
}