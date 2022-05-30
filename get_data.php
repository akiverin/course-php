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
    $db = sql_query('SELECT * FROM hashtag');
    $res = [];
    while ($row = $db->fetch_assoc()) {
        $res[] = $row['name'];
    }

    return $res;
}

function getTableMessages() {
    $res = sql_query('SELECT SMS.`id`, SMS.`h_id`, SMS.`User_id`, SMS.`channel_id`, SMS.`Description`, SMS.`Data`, SMS.`save`, hashtag.`name` FROM SMS, hashtag WHERE hashtag.`id`=SMS.`h_id` ORDER BY hashtag.`name`');
    if ($_SESSION['sort']=='DESC'){$res = sql_query('SELECT SMS.`id`, SMS.`h_id`, SMS.`User_id`, SMS.`channel_id`, SMS.`Description`, SMS.`Data`, SMS.`save`, hashtag.`name` FROM SMS, hashtag WHERE hashtag.`id`=SMS.`h_id` ORDER BY hashtag.`name` DESC');}
    if ($_SESSION['sort']=='ASC'){$res = sql_query('SELECT SMS.`id`, SMS.`h_id`, SMS.`User_id`, SMS.`channel_id`, SMS.`Description`, SMS.`Data`, SMS.`save`, hashtag.`name` FROM SMS, hashtag WHERE hashtag.`id`=SMS.`h_id` ORDER BY hashtag.`name` ASC');}
    if ($_SESSION['sort']=='RAND'){$res = $res = sql_query('SELECT SMS.`id`, SMS.`h_id`, SMS.`User_id`, SMS.`channel_id`, SMS.`Description`, SMS.`Data`, SMS.`save`, hashtag.`name` FROM SMS, hashtag WHERE hashtag.`id`=SMS.`h_id` ORDER BY RAND() ');}
    return $res;
}

?>