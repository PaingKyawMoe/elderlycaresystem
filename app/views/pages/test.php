<?php


function findSecond($array)
{
    $first = null;
    $second = null;

    foreach ($array as $x) {
        if ($first === null || $x > $first) {
            if ($first !== null && $x !== $first) {
                $second = $first;
            }
            $first = $x;
        } elseif ($x < $first && ($second !== null || $x > $second)) {
            $second = $x;
        }
    }
    return $second ?? -1;
}

$array = [1, 2, 3, 4, 6, 9];
echo "The second Number is:" . findSecond($array);
