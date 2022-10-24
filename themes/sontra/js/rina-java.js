(function (e, t, n) {
    "use strict";
    var r = function () {
        var n = this;
        this.container = t("#contentDocument");
        this.repl = t("#new_page");
        this.r = 1;
        this.mz();
        t(e).resize(function () {

            var e = document.webkitIsFullScreen || document.mozFullScreen || document.msFullscreenElement;
            if (typeof e == "undefined") t("body").removeClass("full-width"); else t("body").addClass("full-width");
            n.mz()
        })
    };
    r.prototype = {
        mz: function () {
            this.arrT = [];
            var e = this.container.find("li");
            for (var n = 0; n < e.length; n++) {
                var r = t(e[n]);
                this.r = this.container.width() / r.find(".pc").width();
                this.z(r)
            }
        }, z: function (e) {
            //alert('ab2');
            var t = {msTransform: "scale(" + this.r.toFixed(3) + ")", webkitTransform: "scale(" + this.r.toFixed(3) + ")", transform: "scale(" + this.r.toFixed(3) + ")"};
            //console.log(e.find(".pc").width()*this.r);

            e.find(".pc").css(t);
            e.find(".pf").height(e.find(".pc").height() * this.r);
            e.find(".pf").width(e.find(".pc").width() * this.r);
            this.arrT.push(e.offset().top)
        }, lp: function (n) {
            var r = n.data("token"), i = parseInt(n.attr("data-current")), s = parseInt(n.data("page-view")), o, u = this;
            if (i >= s) return;
            o = i + 5;
            o = o > s ? s : o;
            i++;
            t.post("/tai-lieu/loadpage", {p: i, token: r}, function (e) {
                t("#new_page").replaceWith(e);
                if (o == s) {
                    n.remove();
                    t("#ddjfiwerhugysfdfw").show()
                }
                n.attr("data-current", o);
                u.mz();
            })
        }, stb: function () {
            /*var n = t(e).height(), r = t(e).scrollTop(), i = r - this.container.parent().parent().offset().top;
            for (var s = 0; s < this.arrT.length; s++) {
                if (this.arrT[s] < r + n / 2 && r + n / 2 < this.arrT[s + 1]) {
                    t("#pagenum").val(s + 1);
                }
            }*/
        }, fz: function (t) {
            var n = t.requestFullScreen || t.webkitRequestFullScreen || t.mozRequestFullScreen || t.msRequestFullscreen;
            if (n) {
                n.call(t)
            } else if (typeof e.ActiveXObject !== "undefined") {
                var r = new ActiveXObject("WScript.Shell");
                if (r !== null) {
                    r.SendKeys("{F11}");
                }
            }
        }
    };
    t(e.document).ready(function () {
        var n = new r;
        t("#sdjfiwerhugysfdfw").click(function (e) {
            e.preventDefault();
            n.lp(t(this));
        });
        t(e).scroll(function () {
            n.stb();
        });
        t("#btnFS").click(function () {
           //n.fz(e.document.body);
            ///console.log(e.document.body);
        });
        t(".dasdjfiwerhugysfdfw").click(function (ev) {
            ev.preventDefault();
            if (!lrthg) {
                alert('Bạn cần đăng nhập để tải v�? tài liệu này.');
                window.location.href = '/dang-nhap.html?next=' + t(this).data("next");
                return;
            }
            var n = t(this).data("token");
            $.post(e.root + "download/check", {token: n}, function (res) {
                if (res.status == 'free') {
                    window.location.href = "/download?token=" + res.token;
                } else {
                    $('#priceBuy').text(res.price);
                    $('#btnBuy').attr('href', '/download/YWtlIHVwIHRoZSA2NCBjaGF?token=' + res.token);
                    $('#buymodal').modal();
                }
            }, 'json');
        })
    })
})(window, window.jQuery)