<?php

$board = array_fill(0, 5, array_fill(0, 5, ' '));
$players = ['X', 'O'];
$turn = 0;
$gameOver = false;

function printBoard($board) {
    for ($row = 0; $row < 5; $row++) {
        echo implode(' | ', $board[$row]) . "\n";
        if ($row < 4) {
            echo str_repeat('--+', 4) . "--\n";
        }
    }
}

function checkWin($board, $player, $row, $col) {
    $directions = [
        [0, 1], [1, 0], [1, 1], [-1, 1]
    ];

    foreach ($directions as $dir) {
        $count = 1;
        list($dx, $dy) = $dir;

        for ($i = 1; $i < 4; $i++) {
            $newRow = $row + $i * $dx;
            $newCol = $col + $i * $dy;

            if ($newRow < 0 || $newRow >= 5 || $newCol < 0 || $newCol >= 5 || $board[$newRow][$newCol] !== $player) {
                break;
            }

            $count++;
        }

        for ($i = 1; $i < 4; $i++) {
            $newRow = $row - $i * $dx;
            $newCol = $col - $i * $dy;

            if ($newRow < 0 || $newRow >= 5 || $newCol < 0 || $newCol >= 5 || $board[$newRow][$newCol] !== $player) {
                break;
            }

            $count++;
        }

        if ($count >= 4) {
            return true;
        }
    }

    return false;
}

while (!$gameOver) {
    printBoard($board);
    $player = $players[$turn % 2];

    echo "Player $player's turn\n";
    echo "Enter row (0-4): ";
    $row = intval(readline());
    echo "Enter column (0-4): ";
    $col = intval(readline());

    if ($row < 0 || $row >= 5 || $col < 0 || $col >= 5 || $board[$row][$col] !== ' ') {
        echo "Invalid move. Try again.\n";
        continue;
    }

    $board[$row][$col] = $player;
    if (checkWin($board, $player, $row, $col)) {
        printBoard($board);
        echo "Player $player wins!\n";
        $gameOver = true;
    }

    $turn++;
}

?>
