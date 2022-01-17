$(function () {

    $('#mostrar').on('click', function () {
        let password = $('#password');
        if (password.attr('type') === 'text') {
            password.attr('type', 'password')
        } else {
            password.attr('type', 'text')
        }
    });

});
