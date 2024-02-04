<?php

use PHPUnit\Framework\TestCase;
include_once('app\util.php');


final class BugTest extends TestCase {
    //run with "vendor/bin/phpunit tests"
    

    //Queen bug being bug where queen can't move to 0,1 from 0,0
    public function testForQueenBug() {
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

}
