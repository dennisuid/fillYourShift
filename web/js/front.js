$(function () {
    $( "#male" ).click(function() {
        $(this).toggleClass('btn-primary');
        // $('#gender').attr("checked", true);
        $("#female").removeClass('btn-primary').addClass('btn-default');
    });
    $( "#female" ).click(function() {
        $(this).toggleClass('btn-primary');
        // $('#gender').attr("checked", true);
        $("#male").removeClass('btn-primary');
    });

    $('.btn-toggle').click(function() {
        $(this).find('.btn').toggleClass('active');

        if ($(this).find('.btn-primary').size()>0) {
            $(this).find('.btn').toggleClass('btn-primary');
        }
        if ($(this).find('.btn-danger').size()>0) {
            $(this).find('.btn').toggleClass('btn-danger');
        }
        if ($(this).find('.btn-success').size()>0) {
            $(this).find('.btn').toggleClass('btn-success');
        }
        if ($(this).find('.btn-info').size()>0) {
            $(this).find('.btn').toggleClass('btn-info');
        }

        $(this).find('.btn').toggleClass('btn-default');

    });

});