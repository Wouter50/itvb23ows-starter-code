<?php

use PHPUnit\Framework\TestCase;
include_once 'app\util.php';


final class AntTest extends TestCase {

    //test if ant can do unlimited moves
    public function testIfUnlimitedSlides(){
        $player = 0;
        $board = [
            "0,0" => [[0, 'Q']],
            "0,1" => [[1, 'Q']],
            "0,-1" => [[0, 'A']],
            "1,1" => [[1, 'B']]
        ];
        $from = "0,-1";
        $to = "0,2";
        $valid = checkValidAnt($board, $player, $from, $to);
        $this ->assertEquals(true, $valid);
        

    }

    //test if ant can slide like queen
    public function testIfSlideLikeQueen(){
        $player = 0;
        $board = [
            "0,0" => [[0, 'Q']],
            "0,1" => [[1, 'Q']],
            "0,-1" => [[0, 'A']],
            "1,1" => [[1, 'B']]
        ];
        $from = "0,-1";
        $to = "1,-1";
        $valid = checkValidAnt($board, $player, $from, $to);
        $this ->assertEquals(true, $valid);

    }

    //test if ant can do unlimited moves
    public function testIfNotPreviousTile(){
        $player = 0;
        $board = [
            "0,0" => [[0, 'Q']],
            "0,1" => [[1, 'Q']],
            "0,-1" => [[0, 'A']],
            "1,1" => [[1, 'B']]
        ];
        $from = "0,-1";
        $to = "0,-1";
        $valid = checkValidAnt($board, $player, $from, $to);
        $this ->assertEquals(false, $valid);
    }

    //test if ant not moving to occupied Tile
    public function testIfNotOccupied(){
        $player = 0;
        $board = [
            "0,0" => [[0, 'Q']],
            "0,1" => [[1, 'Q']],
            "0,-1" => [[0, 'A']],
            "1,1" => [[1, 'B']]
        ];
        $from = "0,-1";
        $to = "0,1";
        $valid = checkValidAnt($board, $player, $from, $to);
        $this ->assertEquals(false, $valid);
    }

    
}
