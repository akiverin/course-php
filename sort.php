<?php
    include_once 'database.php';
    session_start();

    $type = $_POST['sort'];
    if ($type=='1'){$_SESSION['sort'] = 'ASC';}
    if ($type=='2'){$_SESSION['sort'] = 'DESC';}
    if ($type=='3'){$_SESSION['sort'] = 'RAND';}
    $_SESSION['message'] = getTableMessages();
    header('Location: main.php');
?>