<?php

use PHPUnit\Framework\TestCase;
include_once 'app\util.php';


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
        $answer = HasNeighbour($posToCheck, $board);
        $this ->assertEquals(true, $answer);
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
    public function testIfisNotNeighbour(): void
    {
        $a = '0,0';
        $b = '1,-2';

        $answer = isNeighbour($a, $b);

        
        $this->assertEquals(false, $answer);
    }

    public function testIfIsNeighbour(): void
    {
        $a = '0,0';
        $b = '1,-1';

        $answer = isNeighbour($a,$b);

        // wel neighbours
        $this->assertEquals(true, $answer);
    }

    public function testIfPassWhenAble(): void{
        //test if player is able to pass when they are allowed to
        $player = 0;
        $hand = [];
        $board = [
            "0,0" => [[0, 'Q']],
            "0,1" => [[1, 'Q']],
            "-1,1" => [[1, 'G']],
            "1,-1" => [[1, 'B']],
            "-1,0" => [[1, 'A']],
            "0,-1" => [[1, 'A']]
        ];
        $passAllowed = checkifPassable($board, $player, $hand);
        $this->assertEquals(true, $passAllowed);
    }

    public function testIfNotPassWhenUnable(): void{
        //test if player is unable to pass when they are not allowed to
        $player = 0;
        $hand = [];
        $board = [
            "0,0" => [[0, 'Q']],
            "0,1" => [[1, 'Q']],
            "-1,1" => [[1, 'G']],
            "1,0" => [[1, 'B']],
            "-1,0" => [[1, 'A']],
            "0,2" => [[1, 'A']]
        ];
        $passAllowed = checkifPassable($board, $player, $hand);
        $this->assertEquals(false, $passAllowed);
    }
    public function testIfWinResult(): void{
        //test if win is detected
        $player = 0;
        $board = [
            "0,0" => [[0, 'Q']],
            "0,1" => [[1, 'Q']],
            "-1,1" => [[1, 'G']],
            "1,0" => [[1, 'B']],
            "-1,0" => [[1, 'A']],
            "0,-1" => [[1, 'A']],
            "1,-1" => [[1, 'A']]
        ];
        $iswin = checkifWin($board, $player);
        $this->assertEquals(true, $iswin);
    }
    public function testIfNotWinResult(): void{
        //test if win is detected
        $player = 0;
        $board = [
            "0,0" => [[0, 'Q']],
            "0,1" => [[1, 'Q']],
            "-1,1" => [[1, 'G']],
            "1,0" => [[1, 'B']],
            "-1,0" => [[1, 'A']],
            "0,-1" => [[1, 'A']],
        ];
        $iswin = checkifWin($board, $player);
        $this->assertEquals(false, $iswin);
    }
    public function testIfDrawResult(): void{
        //test if draw is detected, built is situation where there is a draw
        //since it doesn't matter when the last tile is placed, because this would trigger checkifwin first.
        //forgot placing tile at 0,2 at previous commit
        $board = [
            "0,0" => [[0, 'Q']],
            "0,1" => [[1, 'Q']],
            "-1,1" => [[1, 'G']],
            "1,0" => [[1, 'B']],
            "-1,0" => [[1, 'A']],
            "0,-1" => [[1, 'A']],
            "1,-1" => [[1, 'A']],
            "-1,2" => [[0, 'A']],
            "1,1" => [[0, 'A']],
            "0,2" => [[0, 'A']]
        ];
        $isdraw = checkifDraw($board);
        $this->assertEquals(true, $isdraw);
    }

    public function testIfGetAIMove(): void {
        $turnNumber = 2;
        $board = [
            "0,0" => [[0, 'Q']],
        ];

        $hand = [["Q"=>0,"B"=>2,"S"=>2,"A"=>3,"G"=>3],["Q"=>1,"B"=>2,"S"=>2,"A"=>3,"G"=>3]];

        $canGetAIMove = getAIMove($turnNumber, $board, $hand);
        $this->assertNotNull($canGetAIMove);
    }

}
