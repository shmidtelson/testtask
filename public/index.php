<html>
<head>
    <title>Тестовое задание</title>
    <link rel="stylesheet"
          href="/assets/libs/bootstrap/css/bootstrap-material-design.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/basic.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.css" />
    <link rel="stylesheet" href="/assets/css/custom.css"/>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col col-md-12">
            <div class="content">
                <h1>Форма отправки Email</h1>

                <form id="emailForm">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="bmd-label-floating">Email получателя</label>
                        <input name="mailEmail" type="email" class="form-control" id="exampleInputEmail1" required>
                        <span class="bmd-help">We'll never share your email with anyone else.</span>
                    </div>

                    <div class="form-group">
                        <label for="exampleInput" class="bmd-label-floating">Тема письма</label>
                        <input name="mailSubject" type="text" class="form-control" id="exampleInput" required>
                    </div>
                    <div class="form-group">
                        <label for="Textarea" class="bmd-label-floating">Текст сообщения</label>
                        <textarea name="mailText" class="form-control" id="Textarea" rows="6" required></textarea>
                    </div>

                </form>

                <form action="/upload.php" enctype="multipart/form-data" class="dropzone" id="files-upload"></form>

                <button type="submit" class="btn btn-primary btn-raised" id="submitForm">Отправить</button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.0.1/jquery-migrate.min.js"></script>
<script src="/assets/libs/bootstrap/js/bootstrap-material-design.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script src="/assets/libs/tinymce/tinymce.min.js"></script>
<script src="/assets/libs/tinymce/jquery.tinymce.min.js"></script>
<script src="/assets/js/index.js"></script>
</body>
</html>