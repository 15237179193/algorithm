<?php
function bubbleSort($ary) {
    $len = count($ary);
    if ($len <= 1) {
        return $ary;
    }
    for ($i = 0; $i < $len; $i++) { 
        $flag = false;
        for ($j = 0; $j < $len - $i - 1; $j++) { 
            if ($ary[$j] > $ary[$j+1]) {
                $tmp = $ary[$j+1];
                $ary[$j+1] = $ary[$j];
                $ary[$j] = $tmp;
                $flag = true;
            }
        }
        if (!$flag) {
            break;
        }
    }
    return $ary;
}

$ary = [8, 7, 4, 5, 6, 3, 2, 1, 9, 10];
$endAry = bubbleSort($ary);
print_r($endAry);