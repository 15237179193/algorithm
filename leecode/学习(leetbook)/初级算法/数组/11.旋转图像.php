<?php

class Solution {

    /**
     * @param Integer[][] $matrix
     * @return NULL
     */
    function rotate(&$matrix) {
        $len = count($matrix);
        for ($i = 0; $i < $len / 2; $i++) {
            for ($j = $i; $j < $len - $i - 1; $j++) {
                //当前位置$matrix[$i][$j]的值
                $tmp = $matrix[$i][$j];

                $m = $len - $j -1;//行
                $n = $len - $i - 1;//列

                //当前位置$matrix[$i][$j]的前一个替换位置$matrix[$m][$i]的值，依次逆时针往前推
                $matrix[$i][$j] = $matrix[$m][$i];
                $matrix[$m][$i] = $matrix[$n][$m];
                $matrix[$n][$m] = $matrix[$j][$n];
                $matrix[$j][$n] = $tmp;
            }
        }
        return $matrix;
    }
}

$obj = new Solution();
$matrix = [
    [1,2,3],
    [4,5,6],
    [7,8,9]
];
$matrix = [
    [5,1,9,11],
    [2,4,8,10],
    [13,3,6,7],
    [15,14,12,16]
];
$res = $obj->rotate($matrix);
echo '<pre>';
var_dump($res);