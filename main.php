<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сообщения</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <header class="p-1 bg-dark text-white">
        <div class="container">
            <nav class="navbar">
                <div class="container-fluid">
                    <a class="navbar-brand text-white" href="#">
                        <?php 
                            session_start();
                            include 'get_data.php';
                            echo 'Логин: '.$_SESSION['username'];
                        ?>
                    </a>
                    <h1 class="fs-4 p-0 m-0">Хэштег сортер</h1>
                    <a type="button" href="../index.php" class="btn btn-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z">
                            </path>
                            <path fill-rule="evenodd"
                                d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z">
                            </path>
                        </svg>
                        Выход
                    </a>
                </div>
            </nav>
        </div>
    </header>
    <main class="container d-flex mt-4">
        <div class="d-flex justify-content-center mb-4 w-100">
            <form action="sms.php" method="POST">
                <h2>Создать сообщение</h2>
                <div class="mb-3">
                    <label for="message" class="form-label">Текст сообщения</label>
                    <textarea name="message" id="message" cols="30" rows="9" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="hashtag" class="form-label">Hashtag</label>
                    <input type="search" id="hashtag" name="hashtag" list="list" placeholder="example: cook"
                        class="form-control" autocomplete="off">
                    <datalist id="list">
                        <?php 
                            $hashtags = getHashtags();
                            for ($i = 0; $i < count($hashtags); $i++) {
                                echo '<option value="' . $hashtags[$i] . '">'. $hashtags[$i] . '</option>';
                            }
                        ?>
                    </datalist>
                </div>
                <div class="mb-3">
                    <label for="channel" class="form-label">Канал</label>
                    <select name="channel" id="channel" class="form-select">
                        <?php
                            $channels = getChannel();
                            for ($i = 0; $i < count($channels); $i++) {
                                echo '<option value="' . $channels[$i] . '">' . $channels[$i] . '</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="form-check form-switch">
                    <label for="check" class="form-check-label" data-color="info" tabindex="7">Сделать сообщение
                        приватным</label>
                    <input type="checkbox" name="check" id="check" class="form-check-input" value="1">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Добавить</button>
            </form>
        </div>
        <div class="container">
            <h2 class="mb-3 text-center">Сообщения</h2>
            <form class="change-form" action="sort.php" method="POST">
                <div class="form-floating d-flex flex-wrap">
                    <select class="form-select" id="floatingSelect" aria-label="Сортировка по хэштегу"
                        name="sort" onblur="submit();">
                        <option value="1">От А до Я</option>
                        <option value="2">От Я до А</option>
                        <option value="3">Случайно</option>
                    </select>
                    <label for="floatingSelect">Сортировка по хэштегу</label>
                    <button type="submit" class="d-none btn btn-info ms-5">Отсортировать</button>
                </div>
            </form>
            <div class="list-group list-group-flush border-bottom scrollarea mt-3 p-0"
                style="height: 490px; overflow-y: scroll;">
                <?php
                    $message = getTableMessages();
                    while($row = $message->fetch_assoc()){
                        $channel = sql_query('SELECT `name` FROM Channel WHERE id ='.$row['channel_id'])->fetch_assoc()['name'];
                        $like = sql_query('SELECT `like` FROM Channel WHERE id ='.$row['channel_id'])->fetch_assoc()['like'];
                        $author = sql_query('SELECT `name` FROM Users WHERE id ='.$row['User_id'])->fetch_assoc()['name'];
                        $hashtag = sql_query('SELECT `name` FROM hashtag WHERE id = '.$row['h_id'])->fetch_assoc()['name'];
                        $flag = $row['save'];
                        $text = $row['Data'];
                        if(!$flag Or $author==$_SESSION['username']){
                        ?>
                <div class="list-group-item list-group-item-action lh-sm card p-0 mb-2">
                    <div class="d-flex w-100 align-items-center justify-content-between mb-1 card-header">
                        <p class="mt-1 card-title">Канал: <?= $channel ?></p>
                        <p class="mt-1 card-title">Автор: <?= $author ?></p>
                        <p class="card-subtitle text-info"><?= '#'.$hashtag ?></p>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?= $text ?></p>
                    </div>
                    <div class="card-footer">
                        <?php if($like){?>
                        <p class="m-0 p-0"><small class="text-success">Данный канал является доверенным.</small></p>
                        <?php } ?>
                        <?php if($flag){?>
                        <p class="m-0 p-0"><small class="text-danger">Только вы видите данное сообщение.</small></p>
                        <?php } ?>
                    </div>


                </div>
                <?php
                        }}
                ?>
            </div>
        </div>
    </main>
    <footer class="pt-3 my-4 border-top">
        <p class="text-center text-muted">© 2022 Андрей Киверин, 211-321</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script>
        $(".auto_submit_item").change(function () {
            $(this).parents("form").submit();
        });
    </script>
</body>

</html>