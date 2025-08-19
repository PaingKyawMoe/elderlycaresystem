<?php

function findthird($array)
{
    $first = $second = $third = null;

    foreach ($array as $x) {
        if ($x === $first || $x === $second || $x === $third) {
            continue; //avoid to duplicate
        } elseif ($first === null || $x > $first) {
            $third = $second;
            $second = $first;
            $first = $x;
        } elseif ($second === null || $x > $second) {
            $third = $second;
            $second = $x;
        } elseif ($third === null || $x > $third) {
            $third = $x;
        }
    }
    return $third ?? -1;
}

$array = [1, 2, 3, 4, 5  ];
echo "Third Largest Num is:" . findthird($array);
