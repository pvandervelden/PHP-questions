<?php

/* 
How about a nice game of chess:

Given:
- a chessboard has N by N possible places where N >= 8
- a Queen can move an arbitrary amount of steps in all directions, until stopped by the chessboard boundary or another queen
- a Knight can move in all directions in an L shape fashion ( 2up/down 1left/right or 2left/right 1 up/down)

Assignment 1/2:
- Write a PHP program which outputs all possible placements of exactly N Queens on the chessboard in 
  such a way they don't "check" each other. BEWARE! If a placement _only differs from another by 
  rotation or reflection of the board_, it isn't considered a different possibility

Assignment 2/2:
- Write a PHP similar php algorithm which does the same for the maximum possible amount of Knight pieces, only 
  this time it also needs te determine on it's own how many Knight pieces can be ultimately placed on 
  the NxN sized board, without "checking" each other

Requirement:
- N needs to be an integer which needs to be entered at runtime.
- When outputting (on screen or to a browser), please make sure output is nicely & human readable formatted

Best of luck!
  
*/

/*
 * =========
 * Oplossing
 * =========
 *
 * Idee:
 *   Backtracking gebruiken om zoveel mogelijk ongeldige stellingen zo snel mogelijk uit te kunnen sluiten.
 *   Dit in tegenstelling tot brute force (alle stellingen proberen).
 */


/**
 * NxN Chess Board
 */
class ChessBoard
{
    /** @const string */
    const QUEEN = 'Q';
    
    /** @var array[] */
    private $board;
    
    /**
     * ChessBoard constructor.
     * @param int $n dimension
     */
    public function __construct($n = 8)
    {
        // create empty board
        $this->board = array_fill(0, $n, array_fill(0, $n, 0));
    }

    /**
     * @param int $x column
     * @param int $y row
     */
    private function placeQueen($x, $y)
    {
        // queen location
        $this->board[$x][$y] = self::QUEEN;
        // increase coverage
        $this->updateQueenCoverage($x, $y, 1);
    }

    /**
     * @param int $x column
     * @param int $y row
     */
    private function removeQueen($x, $y)
    {
        if ($this->board[$x][$y] == self::QUEEN) {
            // reset queen location
            $this->board[$x][$y] = 0;
            // decrease coverage
            $this->updateQueenCoverage($x, $y, -1);
        }
    }
    
    /**
     * Keep track of all queen attack lines (horizontal, vertical, diagonal)
     *
     * @param int $x column
     * @param int $y row
     * @param int $d 1 or -1
     */
    private function updateQueenCoverage($x, $y, $d)
    {
        foreach ($this->board as $i => $row) {
            foreach ($row as $j => $value) {
                if (!($x == $i && $y == $j)) {
                    // piece can't hit itself
                    if ($x == $i || $y == $j || abs($x - $i) == abs($y - $j)) {
                        // increase vertical, horizontal and diagonal coverage
                        $this->board[$i][$j] += $d;
                    }
                }
            }
        }
    }

    /**
     * Try to add a queen to a column or move a queen forward in a column
     *
     * @param int $x
     * @return bool
     */
    public function moveQueenForColumn($x)
    {
        $placed = false;

        $currentPosition = array_search(self::QUEEN, $this->board[$x], true);
        if ($currentPosition !== false) {
            $this->removeQueen($x, $currentPosition);
        } else {
            $currentPosition = -1;
        } 
            
        for ($j = $currentPosition + 1; $j < count($this->board[$x]); $j++)
        {
            if ($this->board[$x][$j] === 0) {
                $this->placeQueen($x, $j);
                $placed = true;
                break;
            }
        }

        return $placed;
    }

    /**
     * print board representation to the terminal
     */
    public function printIt() 
    {
        $lines = [];
        foreach ($this->board as $i => $row) {
            foreach ($row as $j => $value) {
                $lines[$i] .= ' ' . ($value !== self::QUEEN ? '-' : $value);
            }
        }
        $lines = array_reverse($lines);
        foreach ($lines as $line) {
            echo $line . PHP_EOL;
        }
        echo PHP_EOL;
    }
}

/**
 * Queens Puzzle Solve Class
 */
class QueensPuzzle
{
    /** @var ChessBoard */
    private $chessboard;

    /** @var int */
    private $dimension = 8;

    /**
     * @param int $n dimension
     */
    public function __construct($n = 8)
    {
        $this->dimension = $n;
        $this->chessboard = new ChessBoard($n);
    }

    /**
     * Solve
     */
    public function solve()
    {
        // Go!
        $startTime  = microtime(true);
        $column     = 0;
        $moves      = 0;
        $solutions  = 0;

        while ($column >= 0) {
            // count moves
            $moves++;

            // try to place next queen
            $placed = $this->chessboard->moveQueenForColumn($column);

            if ($placed) {
                // succeeded, proceed to next column.
                $column++;
                if ($column == $this->dimension) {
                    // Final column: Solution \o/
                    $solutions++;
                    $this->chessboard->printIt();
                    // backtracking
                    $column--;
                }
            } else {
                // backtracking
                $column--;
            }
        }

        // Done.
        $endTime = microtime(true);
        $duration = $endTime - $startTime;
        echo PHP_EOL . "For a {$this->dimension}x{$this->dimension} board, I found $solutions solutions in $moves moves in $duration seconds.";
    }
}

/*
 * Main routine 
 */
$chess = new QueensPuzzle(8);
$chess->solve();