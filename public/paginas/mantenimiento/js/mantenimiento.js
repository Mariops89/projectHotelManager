$(function () {

    $('.card').on('click', function () {
        let id = $(this).attr('id');
        location.href = BASE_URL + 'mantenimiento/' + id;
    });


});
