<?php

use PHPUnit\Framework\TestCase;
include_once('app\util.php');


final class GameFunctionTest extends TestCase {
    //run with "vendor/bin/phpunit tests"
    

    //Queen bug being bug where queen can't move to 0,1 from 0,0
    public function testForQueenBug() {
        $board = [
            "0,0" => [[0, 'Q']],
            "1,0" => [[1, 'Q']]

        ];
        $from = "0,0";
        $to = "0,1";
        $valid = slide($board, $from, $to);
        $this ->assertEquals(true, $valid);
    }

    public function testForInvalidMove(){
        $board = [
            "0,0" => [[0, 'Q']],
            "1,0" => [[1, 'Q']]

        ];
        $hand = [["Q"=>0,"B"=>2,"S"=>2,"A"=>3,"G"=>3],["Q"=>0,"B"=>2,"S"=>2,"A"=>3,"G"=>3]];
        $player = 0;
        $to = "0,1";
        $valid = checkIfPositionAvailable($board, $hand[$player], $player, $to);
        $this ->assertFalse($valid);
    }

    public function testIfEmptyHasNeighbour(){
        $board = [
            "0,0" => [[0, 'Q']],
            "1,0" => [[1, 'Q']]

        ];
        $posToCheck = "0,1";
        $this ->assertEquals(true, HasNeighbour($posToCheck, $board));
    }

    public function testForDropdownHasOccupiedPosition(){
        $board = [
            "0,0" => [[0, 'Q']],
            "1,0" => [[1, 'Q']]

        ];
        $hand = [["Q"=>0,"B"=>2,"S"=>2,"A"=>3,"G"=>3],["Q"=>0,"B"=>2,"S"=>2,"A"=>3,"G"=>3]];
        $player = 0;
        $to = "1,0";
        $valid = checkIfPositionAvailable($board, $hand[$player], $player, $to);
        $this ->assertFalse($valid);
    }
    public function testIfIsNeighbour(): void
    {
        $a = '0,0';
        $b = '1,-1';
        $c = '1,-2';

        // wel neighbours
        $this->assertEquals(true, isNeighbour($a, $b));
        // niet neighbours
        $this->assertEquals(false, isNeighbour($a, $c));
    }

}
