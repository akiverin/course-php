<?php
    // session_destroy();
    session_start();
    include_once 'database.php';

    $type = $_POST['sort'];
    if ($type=='1'){$_SESSION['sort'] = 'ASC';}
    if ($type=='2'){$_SESSION['sort'] = 'DESC';}
    if ($type=='3'){$_SESSION['sort'] = 'RAND';}
    // $_SESSION['message'] = getTableMessages();
    header('Location: main.php');
?>