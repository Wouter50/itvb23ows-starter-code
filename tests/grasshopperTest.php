<?php

use PHPUnit\Framework\TestCase;
include_once 'app\util.php';


final class GrasshopperTest extends TestCase {

    //test if normal move is valid

    public function testIfValidMove(){
        $player = 0;
        $board = [
            "0,0" => [[0, 'Q']],
            "0,1" => [[1, 'Q']],
            "0,-1" => [[0, 'G']],
            "0,2" => [[1, 'B']]
        ];
        $from = "0,-1";
        $to = "0,3";
        $valid = checkValidGrasshopper($board, $player, $from, $to);
        $this ->assertEquals(true, $valid);

    }
    //test if grasshopper doesn't move to same tile as previous
    public function testIfNotPreviousTile(){
        $player = 0;
        $board = [
            "0,0" => [[0, 'Q']],
            "0,1" => [[1, 'Q']],
            "0,-1" => [[0, 'G']],
            "1,1" => [[1, 'B']]
        ];
        $from = "0,-1";
        $to = "0,-1";
        $valid = checkValidGrasshopper($board, $player, $from, $to);
        $this ->assertEquals(false, $valid);

    }
    
    //test if grasshopper jumps over at least 1 tile
    public function testIfJumpedOverOneTile(){
        $player = 0;
        $board = [
            "0,0" => [[0, 'Q']],
            "0,1" => [[1, 'Q']],
            "0,-1" => [[0, 'G']],
            "1,1" => [[1, 'B']]
        ];
        $from = "0,-1";
        $to = "-1,0";
        $valid = checkValidGrasshopper($board, $player, $from, $to);
        $this ->assertEquals(false, $valid);

    }

    // test if grasshopper doesn't land on occupied tile
    public function testIfNotLandingOnOccupied(){
        $player = 0;
        $board = [
            "0,0" => [[0, 'Q']],
            "0,1" => [[1, 'Q']],
            "0,-1" => [[0, 'G']],
            "1,1" => [[1, 'B']]
        ];
        $from = "0,-1";
        $to = "0,1";
        $valid = checkValidGrasshopper($board, $player, $from, $to);
        $this ->assertEquals(false, $valid);

    }

    //test if grasshopper doesn't jump over empty tiles
    public function testIfNotJumpOverEmpty(){
        $player = 0;
        $board = [
            "0,0" => [[0, 'Q']],
            "0,1" => [[1, 'Q']],
            "0,-1" => [[0, 'G']],
            "1,1" => [[1, 'B']]
        ];
        $from = "0,-1";
        $to = "0,3";
        $valid = checkValidGrasshopper($board, $player, $from, $to);
        $this ->assertEquals(false, $valid);
    }
}
