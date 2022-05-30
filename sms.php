<?php
    session_start();
    include_once 'database.php';
    include 'get_data.php';
    
    $message = $_POST['message'];
    $hashtag = $_POST['hashtag'];
    $channel = $_POST['channel'];
    $check = $_POST['check'];
    if ($check!=1){$check=0;}

    if (!in_array($hashtag, $_SESSION['hashtag'])) {
        array_push($_SESSION['hashtag'], $hashtag);
    }
    
    if (sql_query('SELECT * FROM hashtag WHERE name =' . add_quotes($hashtag))->num_rows == 0) {
        sql_query('INSERT INTO hashtag VALUES (NULL,' . add_quotes($hashtag) . ', '. add_quotes($hashtag).')');
    }
    
    
    $hashtagId = sql_query('SELECT id FROM hashtag WHERE name = ' . add_quotes($hashtag))->fetch_assoc()['id'];
    $userId = sql_query('SELECT id FROM Users WHERE name = ' . add_quotes($_SESSION['username']))->fetch_assoc()['id'];
    $channelsTable = sql_query('SELECT * FROM Channel WHERE name =' . add_quotes($channel));
    $channelId = sql_query('SELECT id FROM Channel WHERE name = ' . add_quotes($channel))->fetch_assoc()['id'];
    $relateHashtagIdCount = sql_query('SELECT id_h FROM HF WHERE id_h = ' . add_quotes($hashtagId))->num_rows;
    
    
    // if ($channelsTable->num_rows == 1) {
    //     if ($relateHashtagIdCount == 0) {
    //         sql_query('INSERT INTO HF VALUES (' . add_quotes($hashtagId) . ',' . add_quotes($channelId) . ')');
    //     }
    // }
    
    
    if ($message != '') {
        sql_query("INSERT INTO `SMS` (`id`, `h_id`, `User_id`, `channel_id`, `Description`, `Data`, `save`) VALUES (NULL,". add_quotes($hashtagId) .", ". add_quotes($userId) .",". add_quotes($channelId) .", '',". add_quotes($message) .",".add_quotes($check).")");
    }
    
    header('Location: main.php');
?>