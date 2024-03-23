<?php

session_start();

$moveNumber = 0;

$db = include_once 'database.php';
$stmt = $db->prepare('SELECT * FROM moves WHERE game_id = '.$_SESSION['game_id']);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_array()) {
    echo $row[2];
    $moveNumber = $row[2];
}


$board = $_SESSION['board'];
$player = $_SESSION['player'];
$hand = $_SESSION['hand'];

getAIMove($moveNumber, $player, $hand);

    function getAIMove($moveNumber ,$board, $hand){

        // https://www.php.net/manual/en/context.http.php

        
    
        $postData = [
                'move_number' => $moveNumber,
                'hand' => $hand,
                'board' => $board
        ];
    
        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => "Content-type: application/json\r\n",
                'content' => json_encode($postData),
            )
        );
    
        $url = 'http://localhost:5000/';
    
        $context = stream_context_create($opts);
        $result = file_get_contents($url, false, $context);
    
        $result = json_decode($result, true);

        print_r($result);
    
        return $result;
    
    
    

}

