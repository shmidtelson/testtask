# Тестовое задание 1
Нужно сделать форму отправки email  c возможностью вложения файлов, отправляющую письма в html формате, отправленные письма должны сохраняться в MongoDB с атачментами и нужно сохранять статус доставлено письмо или нет, также нужна админка ( паролем можно не закрывать ) в которой будет список писем по 10 на странице и возможность посмотреть как письма так и атачи к ним. Как плюс Вы можете добавить WYSIWYG редактор и возможность отправки неограниченного количества файлов, делать не обязательно, на усмотрение кандидата.

Параметры локального сервера:
Apache 2.4, PHP 5.6, MongoDB 3.4

Composer
"phpmailer/phpmailer": "^6.0",
"alcaeus/mongo-php-adapter": "^1.1"

`/public/`- корневой каталог проекта<br/>
`/public/web/` - Мини админка <br/>
`/public/index.php` - форма
