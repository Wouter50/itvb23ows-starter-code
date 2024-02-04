<?php

use PHPUnit\Framework\TestCase;

final class BugsTest extends TestCase {

    //Queen bug being bug where queen can't move to 0,1 from 0,0
    public function testForQueenBug(): void {
        $board = [
            '0,0' => ['W', 'Q'],
            '0,1' => ['B', 'Q']

        ];
        $hand = $_SESSION['hand'];
        $player = 0;
        $to = '1,1';
        $valid = checkIfPositionAvailable($board, $hand[$player], $player, $to);
        $this ->assertTrue($valid);
    }

}
