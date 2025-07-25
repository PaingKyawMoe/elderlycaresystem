<?php
function missingNum($arr)
{
    $n = count($arr) + 1;


    for ($i = 1; $i <= $n; $i++) {
        $found = false;

        for ($j = 0; $j < $n - 1; $j++) {
            if ($arr[$j] == $i) {
                $found = true;
                break;
            }
        }

        if (!$found) {
            return $i;
        }
    }
}


$arr = [8, 2, 4, 6, 3, 7, 1];
echo "Missing Nmber is : " . missingNum($arr);
