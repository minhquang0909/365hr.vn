var lang = $('html').attr('lang');
$(document).ready(function(){
    $("#scroll-to-bottom").click(function() {
        $position = $("#section-1").offset().top - 20;
        $("body").animate({
            scrollTop : $position + "px",
            duration : 1000
        });
    });
});
