<?php

$GLOBALS['OFFSETS'] = [[0, 1], [0, -1], [1, 0], [-1, 0], [-1, 1], [1, -1]];

function isNeighbour($a, $b) {
    $a = explode(',', $a);
    $b = explode(',', $b);
    if ($a[0] == $b[0] && abs($a[1] - $b[1]) == 1) {
        return true;
    }
    if ($a[1] == $b[1] && abs($a[0] - $b[0]) == 1) {
        return true;
    }
    if ($a[0] + $a[1] == $b[0] + $b[1]) {
        return true;
    }
    return false;
}

function hasNeighBour($a, $board) {
    foreach (array_keys($board) as $b) {
        if (isNeighbour($a, $b)) {
            return true;
        }
    }
}

function countNeighBours($a, $board) {
    $counter = 0;
    foreach (array_keys($board) as $b) {
        if (isNeighbour($a, $b)) {
            $counter++;
        }
    }
    return $counter -1;
}

function neighboursAreSameColor($player, $a, $board) {
    foreach ($board as $b => $st) {
        if (!$st) {
            continue;
        }
        $c = $st[count($st) - 1][0];
        if ($c != $player && isNeighbour($a, $b)) {
            return false;
        }
    }
    return true;
}

function len($tile) {
    return $tile ? count($tile) : 0;
}

function slide($board, $from, $to) {
    if (!hasNeighBour($to, $board)) {
        return false;
    }
    if (!isNeighbour($from, $to)) {
        return false;
    }
    $b = explode(',', $to);
    $common = [];
    foreach ($GLOBALS['OFFSETS'] as $pq) {
        $p = $b[0] + $pq[0];
        $q = $b[1] + $pq[1];
        if (isNeighbour($from, $p.",".$q)) {
            $common[] = $p.",".$q;
        }
    }
    
    if (!array_key_exists($common[0], $board) || !array_key_exists($common[1], $board)) {
        return true;
    }
    return false;
}

function checkIfPositionAvailable($board, $hand, $player, $to){
    
    if (isset($board[$to])){
        return false;
    }
    if (count($board) && !hasNeighBour($to, $board)){
        return false;
    }
    if (array_sum($hand) < 11 && !neighboursAreSameColor($player, $to, $board) ){
        return false;
    }
    return true;
}

function getNeighbours($pos){
    $posNeighbours = [];
    [$x, $y] = explode(',', $pos);
    foreach($GLOBALS['OFFSETS'] as [$dx,$dy]){
        $nx = $x + $dx;
        $ny = $y + $dy;
        $posNeighbours = "$nx,$ny";
    }
    return $posNeighbours;
}

function checkValidGrasshopper($board, $player, $from, $to) {
    //check of niet naar zelfde positie plaatst
    if ($from == $to || isset($board[$to])) {
        return false;
    }
    
    if (count($board) && !hasNeighBour($to, $board)) {
        return false;
    }
    
    
    //check of beide buren hebben
    //$toHasNeigbours = hasNeighBour($to, $board);
    //$fromHasNeighbours = hasNeighBour($from, $board);

    //if(!$toHasNeigbours || !$fromHasNeighbours){
    //    return false;
    //}

    //check of niet over lege tiles wordt gesprongen
    $f = explode(',', $from);
    $fx = $f[0];
    $fy = $f[1];
    $t = explode(',', $to);
    $tx = $t[0];
    $ty = $t[1];


    if ($fx != $tx) {
        if ($fx < $tx) {
            $inc = 1;
        } else {
            $inc = -1;
        }

        while ($fx != $tx) {
            $fx = $fx + $inc;
            $cords = "$fx,$fy";
            if ($cords == $to) {
                break;
            }
            if (!isset($board[$cords])) {
                return false;
            }
        }
    } elseif ($fy != $ty) {
        if ($fy < $ty) {
            $inc = 1;
        } else {
            $inc = -1;
        }
        while ($fy != $ty) {
            $fy = $fy + $inc;
            $cords = "$fx,$fy";
            if ($cords == $to) {
                break;
            }
            if (!isset($board[$cords])) {
                return false;
            }
        }
    }


    //check of over minstens 1 steen wordt gesprongen
    $toNeigbours = getNeighbours($to);
    $fromNeighbours = getNeighbours($from);

    foreach ($fromNeighbours as $neighbour){
        if (!in_array($neighbour, $toNeigbours)){
            return true;
        }
    }



    return true;

}

function checkValidAnt($board, $player, $from, $to) {
    if ($from == $to) {
        return false;
    }
    if (isset($board[$to])){
        return false;
    }
    if (count($board) && !hasNeighBour($to, $board)) {
        return false;
    }
    return true;
}

function checkValidSpider($board, $player, $from, $to) {
    if ($from == $to) {
        return false;
    }
    if (isset($board[$to])){
        return false;
    }
    if (count($board) && !hasNeighBour($to, $board)) {
        return false;
    }
    if (!checkIfMovingThreeTiles($to, $from)){
        return false;
    }
    return true;
}

function checkIfMovingThreeTiles($to, $from){
   //check if spider moves three tiles away
   $count = 0;
   return true;

}

function checkifPassable($board, $player){
    //check if allowed to pass or not
    $amountStuck = 0;
    foreach(array_keys($board) as $pos){
        $tile = array_pop($board[$pos]);
        if($tile[0] == $player && $tile[1] != 'G'){
            echo "$tile[0] op $pos \n";
            echo countNeighBours($pos, $board);
            if(countNeighBours($pos, $board) != 5){
                return false;
            } else {
                $amountStuck++;
            }
        }
    }
    if ($amountStuck > 0){
        return true;
    }
}
function checkifWin($board, $player){
    //check if filled in player loses, and other player wins
    foreach(array_keys($board) as $pos){
        $tile = array_pop($board[$pos]);
        if($tile[0] == $player && $tile[1] == 'Q'){
            echo "$tile[0] op $pos \n";
            //echo countNeighBours($pos, $board);
            if(countNeighBours($pos, $board) == 6){
                return true;
            } 
        }
    }
    return false;
}
function checkifDraw($board){
    //check if both players have queen surrounded at the same time.
    $amountStuck = 0;
    foreach(array_keys($board) as $pos){
        $tile = array_pop($board[$pos]);
        if($tile[0] == 0 && $tile[1] == 'Q'){
            if(countNeighBours($pos, $board) == 6){
                //queen stuck for p1
                $amountStuck++;
            }
        }
        if($tile[0] == 1 && $tile[1] == 'Q'){
            if(countNeighBours($pos, $board) == 6){
                //queen stuck for p2
                $amountStuck++;
            }
        }
    }
    if ($amountStuck == 2){
        //echo " vast = $amountStuck \n";
        return true;
    } else {
        //echo "vast = $amountStuck \n";
        return false;
    }
}




