<?php

session_start();

include_once 'util.php';

$db = include_once 'database.php';
$stmt = $db->prepare('SELECT * FROM moves WHERE id = '.$_SESSION['last_move']);
$stmt->execute();
$result = $stmt->get_result()->fetch_array();
$_SESSION['last_move'] = $result[5];
undo();
//print_r($_SESSION['last_move']);
set_state($result[6]);
header('Location: index.php');


