<?php
include_once 'database.php';
include_once 'index.php';
session_start();

// $id = $_POST['id'];
$type = $_POST['type'];
$login = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$_SESSION['hashtag'] = [];

if($type == 'log'){
    $userDB = sql_query('SELECT * FROM Users WHERE name = '.add_quotes($login));
    if ($userDB -> num_rows > 0){
        $user = $userDB -> fetch_assoc();
        if($user['password'] == $password){
            $_SESSION['username'] = $login;
            $_SESSION['id'] = $row['id'];
            $_SESSION['type'] = 'log';
            header('Location: main.php');
        } else {
            header('Location: index.php');
        }
    } else {
        header('Location: index.php');
    }
} else if ($type == 'reg'){
    if (sql_query('SELECT * FROM Users WHERE name = '.add_quotes($login))->num_rows > 0) {
        header('Location: index.php');
    } else {
        sql_query('INSERT INTO Users VALUES (NULL,'. add_quotes($login).','. add_quotes($email).',' . add_quotes($password).')');
        $_SESSION['username'] = $login;
        $_SESSION['id'] = $row['id'];
        $_SESSION['type'] = 'reg';
        header('Location: main.php');
    }
}

?>