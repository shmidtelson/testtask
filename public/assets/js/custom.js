$(document).ready(function ($) {
    var MAIL_RESPONSE = '/include/ajax.php';

    $('[name="mailSubject"]').attr('data-msg', 'Заголовок письма обязателен');
    $('[name="mailEmail"]').attr('data-msg', 'Email обязателен');
    $('[name="mailText"]').attr('data-msg', 'Введите содержимое письма');

    $('#emailForm').each(function () {
        var currentForm = $(this);
        currentForm.validate({
            errorElement: "em",

            submitHandler: function (form) {
                $.ajax({
                    url: MAIL_RESPONSE,
                    data: $(form).serialize(),
                    type: "POST",
                    dataType: "html",
                    success: function (response) {
                        currentForm.after('<div class="response">' + response + '</div>');
                        currentForm.hide().delay(5000).fadeIn();
                        currentForm.next('.response').delay(4500).fadeOut();
                    }

                });
                return false;
            }

        });
    });


});


Dropzone.options.filesUpload = {
    maxFiles: 5,
    autoDiscover: false,
    addRemoveLinks:true,
    dictDefaultMessage: 'Перетяните сюда ваши файлы или кликнете в эту область для выбора\n',
    dictRemoveFile: 'Удалить файл',
    dictMaxFilesExceeded: 'Извините, превышен лимит файлов'
};
