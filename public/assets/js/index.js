/**
 * Ajax отправка формы
 */
$(document).ready(function () {
    var MAIL_RESPONSE = '/php/ajax.php';

    $('[name="mailSubject"]').attr('data-msg', 'Заголовок письма обязателен');
    $('[name="mailEmail"]').attr('data-msg', 'Email обязателен');
    $('[name="mailText"]').attr('data-msg', 'Введите содержимое письма');


    var formName = '#emailForm';
    var formBtn = '#submitForm';
    var currentForm = $(formName);

    $(formBtn).click(function () {
        //Очищаем скрытое поле
        currentForm.find('#mailFiles').val('');

        var $filesArray = [];

        $('.dz-success .dz-details .dz-filename span').each(function () {
            $filesArray.push($(this).html());
            currentForm.find('#mailFiles').val($filesArray);
        });

        tinyMCE.triggerSave();
        currentForm.submit();
    });

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
                    $('.content').hide().delay(5000).fadeIn();
                    currentForm.next('.response').delay(4500).fadeOut();
                }

            });
            return false;
        }

    });


});

/**
 * Настройки Drag and Drop зоны
 */
Dropzone.options.filesUpload = {
    maxFiles: 5,
    autoDiscover: false,
    addRemoveLinks: true,
    dictDefaultMessage: 'Перетяните сюда ваши файлы или кликнете в эту область для выбора\n',
    dictRemoveFile: 'Удалить файл',
    dictMaxFilesExceeded: 'Извините, превышен лимит файлов'
};

/**
 * Редактор TinyMCE
 */
tinymce.init({
    selector: 'textarea', height: 300,
    theme: 'modern',
    language: 'ru',
    plugins: 'print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount  imagetools contextmenu colorpicker textpattern help',
    toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ],
    content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css'
    ]
});