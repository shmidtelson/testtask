<html>
<head>
    <title>Тестовое задание</title>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/4.0.2/bootstrap-material-design.min.css"/>
    <link rel="stylesheet" href="/assets/css/custom.css"/>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col col-md-12">
            <div class="content">
                <h1>Форма отправки Email</h1>

                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="bmd-label-floating">Email получателя</label>
                        <input type="email" class="form-control" id="exampleInputEmail1">
                        <span class="bmd-help">We'll never share your email with anyone else.</span>
                    </div>

                    <div class="form-group">
                        <label for="exampleInput" class="bmd-label-floating">Тема письма</label>
                        <input type="text" class="form-control" id="exampleInput">
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea" class="bmd-label-floating">Текст сообщения</label>
                        <textarea class="form-control" id="exampleTextarea" rows="6"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile" class="bmd-label-floating">Файлы</label>
                        <input type="file" class="form-control-file" id="exampleInputFile">
                        <small class="text-muted">Дополнительный файлы.</small>
                    </div>
                    <button type="submit" class="btn btn-primary btn-raised">Отправить</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.0.1/jquery-migrate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/4.0.2/bootstrap-material-design.umd.min.js"></script>
<script src="/assets/js/custom.js"></script>
</body>
</html>