<?php

session_start();

include_once 'database.php';
include_once 'util.php';

if(checkifPassable($_SESSION['board'], $_SESSION['player'], $_SESSION['hand'])){
    $db = database();
    $stmt = $db->prepare('insert into moves (game_id, type, move_from, move_to, previous_id, state)
    values (?, "pass", null, null, ?, ?)');
    $stmt->bind_param('iis', $_SESSION['game_id'], $_SESSION['last_move'], get_state());
    $stmt->execute();
    $_SESSION['last_move'] = $db->insert_id;
    $_SESSION['player'] = 1 - $_SESSION['player'];
}


header('Location: index.php');

