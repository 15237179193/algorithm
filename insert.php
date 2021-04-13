<?php
function insertSort($ary)
{
    $len = count($ary);
    if ($len <= 1) {
        return $ary;
    }
    for ($i = 0; $i < $len; $i++) { 
        $iValue = $ary[$i];
        for ($j = $i - 1; $j >= 0; $j--) { 
            if ($iValue < $ary[$j]) {
                $ary[$j + 1] = $ary[$j];
            } else {
                break;
            }
        }
        $ary[$j + 1] = $iValue;
    }
    return $ary;
}

$ary = [4, 5, 6, 3, 2, 1];
$endAry = insertSort($ary);
print_r($endAry);