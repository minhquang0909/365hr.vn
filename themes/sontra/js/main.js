var translateMessages, lang = $("html").attr("lang");
jwplayer.key = "SPO3wyn+RYBnL5aOiiX0FF15vm2ofmpsaiKUNA==", $(document).ready(function() {
    function a(a) {
        if ($("#room-detail-slider .homepage-price").addClass("hidden"), $("#room-detail-slider .homepage-priceVND").addClass("hidden"), $(".sp-loader").removeClass("hidden"), "en" == lang) var b = "/index/change-date";
        else var b = "/" + lang + "/index/change-date";
        $.ajax({
            url: b,
            data: {
                data: a
            },
            type: "post",
            dataType: "json",
            success: function(b) {
                null == b ? ($(".text-error-homepage").removeClass("hidden"), $(".text-error-booking").removeClass("hidden"), $(".check-datetime-homepage").val(a), $(".datepicker-from").val(a), $(".datepicker-to").val(a), $(".sp-loader").addClass("hidden"), $("#room-detail-slider .homepage-price").removeClass("hidden"), $("#room-detail-slider .homepage-priceVND").removeClass("hiditem-priceden")) : ($(".text-error-homepage").hasClass("hidden") || ($(".text-error-homepage").addClass("hidden"), $(".text-error-booking").addClass("hidden")), $(".check-datetime-homepage").val(b[0].date), $(".datepicker-from").val(b[0].date), $(".datepicker-to").val(b[0].date), $.each(b, function(a, b) {
                    $("#section-2 .hp-" + a).text("$" + b.price), $("#section-2 .hpVND-" + a).text(b.priceVND)
                }), $(".sp-loader").addClass("hidden"), $("#room-detail-slider .homepage-price").removeClass("hidden"), $("#room-detail-slider .homepage-priceVND").removeClass("hidden"))
            }
        })
    }

    function b(a) {
        $(".sp-loader").removeClass("hidden"), $("#accommodation-detail .acc-detail-price").addClass("hidden"), $("#accommodation-detail .acc-detail-priceVND").addClass("hidden"), $("#see-more-title .none-loader").addClass("hidden");
        var b = $(".check-datetime-detail-id").val();
        if ("en" == lang) var c = "/index/change-date-detail";
        else var c = "/" + lang + "/index/change-date-detail";
        $.ajax({
            url: c,
            data: {
                data: a,
                id: b
            },
            type: "post",
            dataType: "json",
            success: function(b) {
                null == b ? ($(".text-error-detail").removeClass("hidden"), $(".text-error-booking").removeClass("hidden"), $(".check-datetime-other").val(a), $(".datepicker-from").val(a), $(".datepicker-to").val(a), $("#accommodation-detail .acc-detail-price").removeClass("hidden"), $("#accommodation-detail .acc-detail-priceVND").removeClass("hidden"), $("#see-more-title .none-loader").removeClass("hidden"), $(".sp-loader").addClass("hidden")) : ($(".text-error-detail").hasClass("hidden") || ($(".text-error-detail").addClass("hidden"), $(".text-error-booking").addClass("hidden")), $(".acc-detail-price").text("$" + b.price), $(".acc-detail-priceVND").text(b.priceVND), $(".check-datetime-detail").val(b.date), $(".check-datetime-other").val(b.date), $(".datepicker-from").val(b.date), $(".datepicker-to").val(b.date), $.each(b.random, function(a, b) {
                    $("#see-more-title .show-price-" + a).text("$" + b.price), $("#see-more-title .show-priceVND-" + a).text(b.priceVND)
                }), $("#accommodation-detail .acc-detail-price").removeClass("hidden"), $("#accommodation-detail .acc-detail-priceVND").removeClass("hidden"), $("#see-more-title .none-loader").removeClass("hidden"), $(".sp-loader").addClass("hidden"))
            }
        })
    }

    function c(a) {
        if ($("#accommodation .sp-loader").removeClass("hidden"), $("#accommodation .none-loader").addClass("hidden"), "en" == lang) var b = "/index/change-date";
        else var b = "/" + lang + "/index/change-date";
        $.ajax({
            url: b,
            data: {
                data: a
            },
            type: "post",
            dataType: "json",
            success: function(b) {
                null == b ? ($(".title-checktime p").removeClass("hidden"), $(".text-error-booking").removeClass("hidden"), $(".datepicker-from").val(a), $(".datepicker-to").val(a), $("#accommodation .sp-loader").addClass("hidden"), $("#accommodation .none-loader").removeClass("hidden")) : ($(".title-checktime p").hasClass("hidden") || ($(".title-checktime p").addClass("hidden"), $(".text-error-booking").addClass("hidden")), $(".check-datetime").val(b[0].date), $(".datepicker-from").val(b[0].date), $(".datepicker-to").val(b[0].date), $.each(b, function(a, b) {
                    $("#accommodation .show-price-" + a).text("$" + b.price), $("#accommodation .show-priceVND-" + a).text(b.priceVND)
                }), $("#accommodation .sp-loader").addClass("hidden"), $("#accommodation .none-loader").removeClass("hidden"))
            }
        })
    }
    $(".lazy-image").unveil({
        offset: 200,
        throttle: 200,
        loading: function() {},
        loaded: function() {}
    });
    var d = $(".datepicker-from").val();
    $(".datepicker-from").datetimepicker({
        minDate: 0,
        format: "DD-MM-YYYY"
    }), $(".datepicker-to").datetimepicker({
        format: "DD-MM-YYYY",
        minDate: moment(d, "DD-MM-YYYY").add(1, "day")
    }), $(".datepicker-from").on("dp.change", function(d) {
        var e = $(d.currentTarget),
            f = e.attr("id"),
            g = f.replace("from", "to"),
            h = d.target.value,
            i = $(".routeInfo").val(),
            j = $(".routeInfo-action").val();
        if ("en" == lang) var k = "/index/check-session";
        else var k = "/" + lang + "/index/check-session";
        $.ajax({
            url: k,
            data: {
                data: h
            },
            type: "post",
            dataType: "json",
            success: function(a) {}
        }), "index" == i && ($(".check-datetime-homepage").val(h), a(h)), "accommodation" == i && ("index" == j && ($(".check-datetime").val(h), c(h)), "detail" == j && ($(".check-datetime-detail").val(h), b(h))), $("#" + g).data("DateTimePicker").minDate(d.date.add(1, "day")), $("#" + g).focus()
    }), $(".spinner .btn:first-of-type").on("click", function() {
        $parent = $(this).closest(".spinner"), $value = $(".spinner input").val(), $newValue = parseInt($value) + 1, "undefined" != typeof $parent.data("max") && ($newValue = Math.min(parseInt($parent.data("max")), $newValue)), $(".spinner input").val($newValue)
    }), $(".spinner .btn:last-of-type").on("click", function() {
        $parent = $(this).closest(".spinner"), $value = $(".spinner input").val(), $newValue = parseInt($value) - 1, "undefined" != typeof $parent.data("min") && ($newValue = Math.max(parseInt($parent.data("min")), $newValue)), $(".spinner input").val($newValue)
    }), $("#contact-form").validate({
        ignore: !1,
        rules: {
            title: {
                required: !0
            },
            fullname: {
                required: !0
            },
            email: {
                required: !0,
                email: !0
            },
            phone: {
                required: !0,
                digits: !0
            },
            message: {
                required: !0
            }
        },
        errorPlacement: function(a, b) {
            $element = $(b), $type = $element.attr("type"), "checkbox" != $type && "radio" != $type ? $element.after($(a)) : $element.closest(".radio-area").append($(a))
        },
        submitHandler: function(a) {
            $("#submit-contact-form").button("loading"), dataLayer.push({
                event: "GAevent",
                eventCategory: "Contact",
                eventAction: "Send Contact"
            }), $.ajax({
                type: "post",
                data: $(a).serialize(),
                url: $(a).attr("action"),
                beforeSending: function() {},
                success: function(a) {
                    alert(a.message)
                },
                complete: function() {
                    $("#contact-form").trigger("reset"), $("#submit-contact-form").button("reset")
                }
            })
        }
    }), $("form.booking-form").on("submit", function(a) {
            dataLayer.push({
                event: "GAevent",
                eventCategory: "Booking",
                eventAction: "Submit"
            })
        // $this = $(this), $datepickerFrom = $this.find(".datepicker-from").val(), $datepickerTo = $this.find(".datepicker-to").val(), $checkInDate = moment($datepickerFrom, "DD-MM-YYYY"), $checkOutDate = moment($datepickerTo, "DD-MM-YYYY"), $inputCheckIn = $("<input/>").attr({
        //     type: "hidden",
        //     name: "checkIn",
        //     value: $checkInDate.format("YYYY-MM-DD")
        // }), $inputStayLength = $("<input/>").attr({
        //     type: "hidden",
        //     name: "stayLength",
        //     value: $checkOutDate.diff($checkInDate, "days")
        // }), $this.append($inputCheckIn), $this.append($inputStayLength)
        // var $bed_date = $this.find('.datepicker-from').data('DateTimePicker').date().format('D');
        // var $bed_year_month = $this.find('.datepicker-from').data('DateTimePicker').date().format('YYYY-MM');
        // var $moment_from = moment($this.find('.datepicker-from').data('DateTimePicker').date());
        // var $moment_to = moment($this.find('.datepicker-to').data('DateTimePicker').date());
        // var $bed_night = $moment_to.diff($moment_from, 'days');
        // var $bed_action = $this.attr('action');
        // $this.attr('action', $bed_action+'&fdate_date='+$bed_date+'&fdate_monthyear='+$bed_year_month+'&numnight='+$bed_night);
    }), $(".btn-book-now").click(function() {
        $("form.booking-form").eq(0).submit()
    }), $(".menu-tab").change(function(a) {
        $tab = $(this).val(), $('[href="' + $tab + '"]').tab("show")
    }), $("#gallery .gallery-item").colorbox({
        rel: "gallery-item",
        maxWidth: "80%",
        maxHeight: "60%",
        photo: !0
    }), $("#accommodation-pictures .pictures-item").colorbox({
        rel: "pictures-item",
        maxWidth: "80%",
        maxHeight: "60%",
        photo: !0
    }), $(".check-datetime").datetimepicker({
        format: "DD-MM-YYYY"
    }), $(".check-datetime").on("dp.change", function(a) {
        var b = a.target.value;
        if ($("#accommodation .sp-loader").removeClass("hidden"), $("#accommodation .none-loader").addClass("hidden"), "en" == lang) var c = "/index/change-date";
        else var c = "/" + lang + "/index/change-date";
        $.ajax({
            url: c,
            data: {
                data: b
            },
            type: "post",
            dataType: "json",
            success: function(a) {
                null == a ? ($(".title-checktime p").removeClass("hidden"), $(".text-error-booking").removeClass("hidden"), $(".datepicker-from").val(b), $(".datepicker-to").val(b), $("#accommodation .sp-loader").addClass("hidden"), $("#accommodation .none-loader").removeClass("hidden")) : ($(".title-checktime p").hasClass("hidden") || ($(".title-checktime p").addClass("hidden"), $(".text-error-booking").addClass("hidden")), $(".check-datetime").val(a[0].date), $(".datepicker-from").val(a[0].date), $(".datepicker-to").val(a[0].date), $.each(a, function(a, b) {
                    $("#accommodation .show-price-" + a).text("$" + b.price), $("#accommodation .show-priceVND-" + a).text(b.priceVND)
                }), $("#accommodation .sp-loader").addClass("hidden"), $("#accommodation .none-loader").removeClass("hidden"))
            }
        })
    }), $(".check-datetime-detail, .check-datetime-other").datetimepicker({
        format: "DD-MM-YYYY"
    }), $(".check-datetime-detail, .check-datetime-other").on("dp.change", function(a) {
        $(".sp-loader").removeClass("hidden"), $("#accommodation-detail .acc-detail-price").addClass("hidden"), $("#accommodation-detail .acc-detail-priceVND").addClass("hidden"), $("#see-more-title .none-loader").addClass("hidden");
        var b = a.target.value,
            c = $(".check-datetime-detail-id").val();
        if ("en" == lang) var d = "/index/change-date-detail";
        else var d = "/" + lang + "/index/change-date-detail";
        $.ajax({
            url: d,
            data: {
                data: b,
                id: c
            },
            type: "post",
            dataType: "json",
            success: function(a) {
                null == a ? ($(".text-error-detail").removeClass("hidden"), $(".text-error-booking").removeClass("hidden"), $(".check-datetime-other").val(b), $(".datepicker-from").val(b), $(".datepicker-to").val(b), $("#accommodation-detail .acc-detail-price").removeClass("hidden"), $("#accommodation-detail .acc-detail-priceVND").removeClass("hidden"), $("#see-more-title .none-loader").removeClass("hidden"), $(".sp-loader").addClass("hidden")) : ($(".text-error-detail").hasClass("hidden") || ($(".text-error-detail").addClass("hidden"), $(".text-error-booking").addClass("hidden")), $(".acc-detail-price").text("$" + a.price), $(".acc-detail-priceVND").text(a.priceVND), $(".check-datetime-detail").val(a.date), $(".check-datetime-other").val(a.date), $(".datepicker-from").val(a.date), $(".datepicker-to").val(a.date), $.each(a.random, function(a, b) {
                    $("#see-more-title .show-price-" + a).text("$" + b.price), $("#see-more-title .show-priceVND-" + a).text(b.priceVND)
                }), $("#accommodation-detail .acc-detail-price").removeClass("hidden"), $("#accommodation-detail .acc-detail-priceVND").removeClass("hidden"), $("#see-more-title .none-loader").removeClass("hidden"), $(".sp-loader").addClass("hidden"))
            }
        })
    }), $(".check-datetime-homepage").datetimepicker({
        format: "DD-MM-YYYY"
    }), $(".check-datetime-homepage").on("dp.change", function(a) {
        $("#room-detail-slider .homepage-price").addClass("hidden"), $("#room-detail-slider .homepage-priceVND").addClass("hidden"), $(".sp-loader").removeClass("hidden");
        var b = a.target.value;
        if ("en" == lang) var c = "/index/change-date";
        else var c = "/" + lang + "/index/change-date";
        $.ajax({
            url: c,
            data: {
                data: b
            },
            type: "post",
            dataType: "json",
            success: function(a) {
                null == a ? ($(".text-error-homepage").removeClass("hidden"), $(".text-error-booking").removeClass("hidden"), $(".check-datetime-homepage").val(b), $(".datepicker-from").val(b), $(".datepicker-to").val(b), $(".sp-loader").addClass("hidden"), $("#room-detail-slider .homepage-price").removeClass("hidden"), $("#room-detail-slider .homepage-priceVND").removeClass("hidden")) : ($(".text-error-homepage").hasClass("hidden") || ($(".text-error-homepage").addClass("hidden"), $(".text-error-booking").addClass("hidden")), $(".check-datetime-homepage").val(a[0].date), $(".datepicker-from").val(a[0].date), $(".datepicker-to").val(a[0].date), $.each(a, function(a, b) {
                    $("#section-2 .hp-" + a).text("$" + b.price), $("#section-2 .hpVND-" + a).text(b.priceVND)
                }), $(".sp-loader").addClass("hidden"), $("#room-detail-slider .homepage-price").removeClass("hidden"), $("#room-detail-slider .homepage-priceVND").removeClass("hidden"))
            }
        })
    })
});
$(".item-room img").on('error', function () {
    $(this).attr("src", baseUrl + 'uploads/no-img.png')
});