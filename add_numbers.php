#!/usr/bin/php
<?php

/**
 * Hey fellows, do not EVER use this shitty algorhythm! It's slower than a snail!
 * Use ASM! Chuck Norris uses only ASM! There is a Carry Flag CF (0x0001)
 * in a flags register  in Your x86 CPU. Go ahead, use it! Be a man!
 */

    list($a, $b) = get_args($argv);
    debug_regular_addition($a, $b);
    echo "{$a} + {$b} = " . large_numbers_sum($a, $b) . "\n";

    function get_args(array $argv) : array
    {
        if(!isset($argv[1]) || !isset($argv[2])) {
            echo "I want two arguments! Mi piacciono gli argomenti molto!\n";
            die();
        }
        if(!is_numeric($argv[1]) || !is_numeric($argv[2])) {
            echo "Numbers, please!\n";
            die();
        }
        return [(int)$argv[1], (int)$argv[2]];
    }

    function large_numbers_sum(int $a, int $b) : string
    {
        $rev_a = strrev(strval($a));
        $rev_b = strrev(strval($b));

        $length = max(strlen($rev_a), strlen($rev_b)) + 1;

        $rev_b = str_pad($rev_b, $length, "0");
        $rev_a = str_pad($rev_a, $length, "0");

        $result = array_fill(0, $length, 0);

        $carry_flag = false;
        for ($i = 0; $i < $length; $i++)
        {
            $result[$i] = (int)$rev_b[$i] + (int)$rev_a[$i];
            if($carry_flag) {
                $result[$i]++;
                $carry_flag = false;
            }
            if($result[$i] > 9) {
                $carry_flag = true;
                $result[$i] %= 10;
            }
        }

        return (int)implode(array_reverse($result));
    }

    function debug_regular_addition(int $a, int $b) : void
    {
        $bitDepth = strlen(decbin(~0));
        $result = $a + $b;
        echo "REGULAR {$bitDepth}bit ADDITION RESULT: {$result}\n";
        if(is_float($result)) {
            echo "Yes, now it's a float and the result would be much more interesting in C ;-)\n";
        }
        echo "\n";
    }

?>
