<?php
/**
 * 选择排序
 */
function selectSort($ary)
{
    $len = count($ary);
    if ($len <= 1) {
        return $ary;
    }
    for ($i = 0; $i < $len; $i++) { 
        $min = $i;
        for ($j = $i + 1; $j < $len; $j++) { 
            if ($ary[$j] < $ary[$min]) {
                $min = $j;
            }
        }
        if ($min != $i) {
            $tmp = $ary[$i];
            $ary[$i] = $ary[$min];
            $ary[$min] = $tmp;
        }
    }
    return $ary;
}

$ary = [4, 5, 6, 3, 2, 1];
$endAry = selectSort($ary);
print_r($endAry);