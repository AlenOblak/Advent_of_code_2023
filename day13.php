<?php

$lines = file('day13_input.txt', FILE_IGNORE_NEW_LINES);

$patterns = array();
$pattern = array();
foreach ($lines as $line) {
    if($line == '') {
        $patterns[] = $pattern;
        $pattern = array();
    } else {
        $pattern[] = str_split($line);
    }
}
$patterns[] = $pattern;

$sum1 = 0;
$sum2 = 0;
foreach ($patterns as $pattern) {
    $sum1 += calc($pattern);
    $sum2 += calc2($pattern);
}
echo $sum1."\n";
echo $sum2."\n";

function calc($pattern)
{
    $x = count($pattern[0]);
    $y = count($pattern);

    // try x
    for($xx = 1; $xx < $x; $xx++) {
        $is_mirror = true;
        $length = min($xx, $x - $xx);
        for($i = 1; $i <= $length; $i++)
            for($j = 0; $j < $y; $j++) {
                if($pattern[$j][$xx-$i] != $pattern[$j][$xx+$i-1] ) {
                    $is_mirror = false;
                    break 2;
                }
            }
        if($is_mirror)
            return $xx;
    }

    // try y
    for($yy = 1; $yy < $y; $yy++) {
        $is_mirror = true;
        $length = min($yy, $y - $yy);
        for($i = 0; $i < $x; $i++)
            for($j = 1; $j <= $length; $j++) {
                if($pattern[$yy-$j][$i] != $pattern[$yy+$j-1][$i] ) {
                    $is_mirror = false;
                    break 2;
                }
            }
        if($is_mirror)
            return $yy * 100;
    }
}

function calc2($pattern)
{
    $x = count($pattern[0]);
    $y = count($pattern);

    // try x
    for($xx = 1; $xx < $x; $xx++) {
        $diff = 0;
        $length = min($xx, $x - $xx);
        for($i = 1; $i <= $length; $i++)
            for($j = 0; $j < $y; $j++) {
                if($pattern[$j][$xx-$i] != $pattern[$j][$xx+$i-1] ) {
                    $diff++;
                    if($diff > 1)
                        break 2;
                }
            }
        if($diff == 1)
            return $xx;
    }

    // try y
    for($yy = 1; $yy < $y; $yy++) {
        $diff = 0;
        $length = min($yy, $y - $yy);
        for($i = 0; $i < $x; $i++)
            for($j = 1; $j <= $length; $j++) {
                if($pattern[$yy-$j][$i] != $pattern[$yy+$j-1][$i] ) {
                    $diff++;
                    if($diff > 1)
                        break 2;
                }
            }
        if($diff == 1)
            return $yy * 100;
    }
}