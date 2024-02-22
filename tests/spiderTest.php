<?php

use PHPUnit\Framework\TestCase;
include_once 'app\util.php';


final class SpiderTest extends TestCase {

    //test if spider does 3 moves
    public function testSpiderMoveThree(){
        $board = [
            "0,0" => [[0, 'Q']],
            "0,1" => [[1, 'Q']],
            "0,-1" => [[0, 'S']],
            "1,1" => [[1, 'B']]
        ];
        $from = "0,-1";
        $to = "2,0";
        $valid = checkValidspider($board, $player, $from, $to);
        $this ->assertEquals(true, $valid);
    }

    //test if spider can't do less than 3 moves
    public function testSpiderNotMoveThree(){
        $board = [
            "0,0" => [[0, 'Q']],
            "0,1" => [[1, 'Q']],
            "0,-1" => [[0, 'S']],
            "1,1" => [[1, 'B']]
        ];
        $from = "0,-1";
        $to = "-1,1";
        $valid = checkValidspider($board, $player, $from, $to);
        $this ->assertEquals(false, $valid);
    }

    //test if spider can slide like queen
    public function testIfSlideLikeQueen(){
        $board = [
            "0,0" => [[0, 'Q']],
            "0,1" => [[1, 'Q']],
            "0,-1" => [[0, 'S']],
            "1,1" => [[1, 'B']]
        ];
        $from = "0,-1";
        $to = "2,0";
        $valid = checkValidSpider($board, $player, $from, $to);
        $this ->assertEquals(true, $valid);

    }

    //test if spider can do unlimited moves
    public function testIfNotPreviousTile(){
        $board = [
            "0,0" => [[0, 'Q']],
            "0,1" => [[1, 'Q']],
            "0,-1" => [[0, 'S']],
            "1,1" => [[1, 'B']]
        ];
        $from = "0,-1";
        $to = "0,-1";
        $valid = checkValidspider($board, $player, $from, $to);
        $this ->assertEquals(false, $valid);
    }

    //test if spider not moving to occupied Tile
    public function testIfNotOccupied(){
        $board = [
            "0,0" => [[0, 'Q']],
            "0,1" => [[1, 'Q']],
            "1,-1" => [[0, 'S']],
            "1,1" => [[1, 'B']]
        ];
        $from = "1,-1";
        $to = "1,1";
        $valid = checkValidspider($board, $player, $from, $to);
        $this ->assertEquals(false, $valid);
    }

    //test if spider doesn't move over already visited tiles
    //here situation where moving one tile, by moving over and back
    public function testNotMovingToVisited(){
        $board = [
            "0,0" => [[0, 'Q']],
            "0,1" => [[1, 'Q']],
            "0,-1" => [[0, 'S']],
            "1,1" => [[1, 'B']]
        ];
        $from = "0,-1";
        $to = "1,0";
        $valid = checkValidspider($board, $player, $from, $to);
        $this ->assertEquals(false, $valid);
    }

    
}
