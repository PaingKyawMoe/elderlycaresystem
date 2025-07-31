<?php

function findMissandRepeat($arr)
{

    $freq = [];
    $repeating = null;
    $missing = [];


    $minVal = min($arr);
    $maxVal = max($arr);

    foreach ($arr as $num) {
        if (!isset($freq[$num])) {
            $freq[$num] = 0;
        }
        $freq[$num]++;
    }

    for ($i = $minVal; $i <= $maxVal; $i++) {
        if (!isset($freq[$i])) {
            $missing[] = $i;
        } elseif ($freq[$i] > 1) {
            $repeating = $i;
        }
    }

    return [$repeating, $missing];
}


$arr = [0, 1, 2, 2, 4, 9, 6];  // 3 and 5 are missing, 2 is repeating
list($repeating, $missing) = findMissandRepeat($arr);

echo "Repeating: " . $repeating . "\n";
echo "Missing: " . implode(', ', $missing) . "\n";




// $paing = new DateTime('20.6.2001');
// $mya = new DateTime('22.3.2001');

// if ($paing < $mya) {
//     echo "you are less than mya";
// } else {
//     echo "mya is greather than you";
// }

// $diff = $paing->diff($mya);

// echo $diff->format('Mya is %y year and %m and %d order than you');
