<!DOCTYPE html>
<html lang="ru">
<?php
session_start();
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Страница Авторизации</title>
</head>
<body>
    <div class="container justify-content-center align-items-center d-flex flex-column gap-4 min-vh-100">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">Авторизация</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Регистрация</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="card card-body flex-grow-0" style="width: 400px;">
                    <form action="/authorization.php" method="POST" type="log">
                        <h2>Вход</h2>
                        <input type="text" name="type" value="log" style="display: none;">
                        <div class="mb-3">
                            <label for="logUsername" class="form-label">Логин</label>
                            <input type="text" class="form-control" name="username" id="logUsername">
                        </div>
                        <div class="mb-3 d-none">
                            <label for="regPassword" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="logEmail">
                        </div>
                        <div class="mb-3">
                            <label for="logPassword" class="form-label">Пароль</label>
                            <input type="password" class="form-control" name="password" id="logPassword">
                        </div>
                        <button type="submit" class="btn btn-info">Войти</button>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="card card-body flex-grow-0" style="width: 400px;">
                    <form action="/authorization.php" method="POST" type="reg">
                        <h2>Регистрация</h2>
                        <input type="text" name="type" value="reg" style="display: none;">
                        <div class="mb-3">
                            <label for="regUsername" class="form-label">Логин</label>
                            <input type="text" class="form-control" name="username" id="regUsername">
                        </div>
                        <div class="mb-3">
                            <label for="regPassword" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="regEmail">
                        </div>
                        <div class="mb-3">
                            <label for="regPassword" class="form-label">Пароль</label>
                            <input type="password" class="form-control" name="password" id="regPassword">
                        </div>
                        <button type="submit" class="btn btn-info">Зарегистрироваться</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>