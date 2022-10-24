function addFormError(form_id,result) {
    $('#'+form_id+' input,  select, textarea, input[type=checkbox]').each(function(){
        var _this = $(this);
        $(this).removeClass('error');
        $(this).next('.errorMessage').remove();
        $(this).parent().find('.errorMessage').remove();
        if($(this).attr('name') && result.errors[$(this).attr('name').replace(/.*\[/,'').replace(/\].*/,'')]){
            if($(_this).attr('type')=='checkbox'){
                $(this).addClass('error');
                if($(this).parent().find('.errorMessage').length <= 0) {
                    $(this).parent().find('label').after('<div class="errorMessage two">' + result.errors[$(this).attr('name').replace(/.*\[/, '').replace(/\].*/, '')] + '</div>');
                }
            }else {
                $(this).addClass('error');
                $(this).after('<div class="errorMessage">' + result.errors[$(this).attr('name').replace(/.*\[/, '').replace(/\].*/, '')] + '</div>');
            }
        }
    });
}

$(document).ready(function () {
    $('.mava_pagination .disabled a, .mava_pagination .active a').on('click', function(e) {
        e.preventDefault();
    });
});