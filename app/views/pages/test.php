<?php

function findSecond($array)
{
    $first = $second = null;

    foreach ($array as $x) {
        if ($first === null || $x > $first) {
            if ($first != null && $x != $first) {
                $second = $first;
            }
            $first = $x;
        } elseif ($x < $first && ($second === null || $x > $second)) {
            $second = $x;
        }
    }
    return $second ?? -1;
}

$array = [12, 3, 4, 5, 6, 7];

echo "The seconde largest Num is:" . findSecond($array);
