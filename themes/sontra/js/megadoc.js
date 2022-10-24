var scrollTop = $("html").offset().top;
$('.top').click(function () {
    $("html, body").animate({scrollTop: scrollTop}, 100);
});
$(window).scroll(function () {
    $(window).scrollTop() >= (scrollTop + 200) ? $('.top').fadeIn('fast') : $('.top').fadeOut('fast');
});
function like(link, uId, o, oId, o1, o2) {
    $.ajax({
        url: link,
        data: 'action=like&user_id=' + uId + '&object=' + o + '&object_id=' + oId,
        type: "POST",
        success: function (data) {
            data = jQuery.parseJSON(data);
            if (data.error == 0) {
                o1.each(function () {
                    $(this).text(data.value);
                });
                o2.each(function () {
                    $(this).text(data.text);
                });
            } else {
                alert('Tài liệu đang chờ duyệt! Các chức năng hiện chưa thể sử dụng!');
            }
        }
    });
}
function comment(link, uId, oId) {
    var comment = $('#comment').val();
    if (comment == '') {
        alert('Vui lòng nhập nội dung!');
    } else {
        $.ajax({
            url: link,
            data: 'user_id=' + uId + '&object_id=' + oId + '&content=' + comment,
            type: "POST",
            success: function (data) {
                data = jQuery.parseJSON(data);
                if (data.error == 0) {
                    $('#comment').val('');
                    $('#comment-div').after(data.text);
                    $("html, body").animate({scrollTop: $(".comment:first").offset().top}, 500);
                } else {
                    alert('Tài liệu đang chờ duyệt! Các chức năng hiện chưa thể sử dụng!');
                }
            }
        });
    }
}
function btnDesMore(e) {
    var o = $(".doc-detail-description-container");
    o.hasClass("active") ? ($(e).text("— Xem thêm —"), o.removeClass("active"), $("html, body").animate({scrollTop: $(".doc-detail-description-container").offset().top}, 500)) : ($(e).text("— Thu gọn —"), o.addClass("active"))
}
function getStringEmbed() {
    var e = '<a target="_blank" title="' + docName + '" href="' + link + '" style="margin: 12px auto 6px auto; font-family: Helvetica,Arial,Sans-serif; font-style: normal; font-variant: normal; font-weight: normal; font-size: 14px; line-height: normal; font-size-adjust: none; font-stretch: normal; -x-system-font: none; display: block; text-decoration: underline;">' + docName + "</a>", t = $("#select_copy").val(), n = "100%", r = "600";
    switch (t) {
        case"600x800":
            n = "600";
            r = "800";
            break;
        case"400x600":
            n = "400";
            r = "600";
            break;
        case"auto":
            n = "100%";
            r = "600";
        default:
            break;
    }
    var i = '<iframe src="' + linkEmbed + '" width="' + n + '" height="' + r + '" data-auto-height="true" scrolling="true" name="megadoc-embed" id="megadoc-embed" frameborder="0" style="border: 1px solid #dfdfdf" allowfullscreen webkitallowfullscreen mozallowfullscreen></iframe>';
    $("#text_copy").val(e + i);
}
function follow(url, id) {
    $.ajax({
        cache: false,
        type: "POST",
        url: url + '?' + 'YII_CSRF_TOKEN=' + CSRF_TOKEN,
        data: 'id=' + id,
        success: function (data) {
            data = jQuery.parseJSON(data);
            if (data.error == 0) {
                $('#button-follow-same-' + id).html(data.text);
                $('#button-follow-' + id).html(data.text);
                $('#value-follow-same-' + id).html('(' + data.value + ' người theo dõi)');
                $('#value-follow-' + id).html('(' + data.value + ' người theo dõi)');
            } else {
                alert(data.error);
            }
        }
    });
}
function collectionSave() {
    var collectionId = $("#collection").val();
    if (collectionId == 0) {
        var col_image = $("#jcrop_image").attr('src'), col_name = $("#collectionName").val(), col_desc = $("#collectionDescription").val(), col_status = $("#collectionStatus").val(), col_tags = $("#txtKeyword").val();
        if ($.trim(col_name) == '') {
            alert('vui lòng nhập tên bộ sưu tập');
            return;
        }
        if ($.trim(col_desc) == '') {
            alert('vui lòng nhập mô tả');
            return;
        }
        $.ajax({
            cache: false,
            type: 'POST',
            url: linkCollectionCreate,
            data: 'type=create&name=' + col_name + '&description=' + col_desc + '&status=' + col_status + '&image=' + col_image + '&tags=' + col_tags + '&document_id=' + objectId + '&YII_CSRF_TOKEN=' + CSRF_TOKEN,
            success: function (data) {
                data = jQuery.parseJSON(data);
                if (data.error == 0) {
                    alert('Lưu vào bộ sưu tập thành công!');
                    window.location.reload();
                } else {
                    alert(data.error);
                }
            }
        });
    } else {
        $.ajax({
            cache: false,
            type: 'POST',
            url: linkCollectionCreate,
            data: 'type=update&collection_id=' + collectionId + '&document_id=' + objectId,
            success: function (data) {
                data = jQuery.parseJSON(data);
                if (data.error == 0) {
                    alert('Lưu vào bộ sưu tập thành công!');
                    window.location.reload();
                } else {
                    alert(data.error);
                }
            }
        });
    }
}
function collectionAdd(id) {
    if (id == 0) {
    } else {
        $.ajax({
            cache: false,
            type: 'POST',
            url: linkCollectionAdd,
            data: 'type=add&name=' + '&collection_id=' + id + '&document_id=' + objectId + '&YII_CSRF_TOKEN=' + CSRF_TOKEN,
            success: function (data) {
                data = jQuery.parseJSON(data);
                if (data.error == 0) {
                    alert('Lưu vào bộ sưu tập thành công!');
                    window.location.reload();
                } else {
                    alert(data.error);
                }
            }
        });
    }
}
$('a#boxBuy').click(function () {
    $.ajax({type: 'POST', url: jQuery(this).attr('href')});
});
$("#widget_buy_form").validate({
    errorElement: "span", submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: linkBuyDocument,
            data: "docId=" + objectId + '&' + 'YII_CSRF_TOKEN=' + CSRF_TOKEN,
            success: function (data) {
                var return_data = jQuery.parseJSON(data);
                $('div.message').fadeIn('normal', function () {
                    if (return_data.status_code == 1) {
                        window.location.href = return_data.link_download;
                    } else {
                        $(this).html(return_data.message);
                    }
                });
            }
        });
        return false;
    }
});
$(".user-notify-drop").click(function () {
    var th = $(this);
    $('.list-form-user').each(function () {
        $(this).addClass('hide');
    });
    th.find('ul').removeClass('hide');
});
$(document).mouseup(function (e) {
    var container = $(".user-notify-drop");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.find('ul').addClass('hide');
    }
});