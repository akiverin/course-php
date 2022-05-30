<?php

include_once 'database.php';

function getFields() {
    $db = sql_query('SELECT * FROM Field');
    $res = [];
    while ($row = $db->fetch_assoc()) {
        $res[] = $row['name'];
    }

    return $res;
}

function getChannel() {
    $db = sql_query('SELECT * FROM Channel');
    $res = [];
    while ($row = $db->fetch_assoc()) {
        $res[] = $row['name'];
    }

    return $res;
}

function getHashtags() {
    $db = sql_query('SELECT * FROM hashtag ORDER BY name');
    $res = [];
    while ($row = $db->fetch_assoc()) {
        $res[] = $row['name'];
    }

    return $res;
}

function getTableMessages() {
    $res = sql_query('SELECT * FROM SMS ORDER BY h_id');
    return $res;
}

?>