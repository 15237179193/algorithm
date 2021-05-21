<?php

class Solution {

    /**
     * @param Integer[] $digits
     * @return Integer[]
     */
    function plusOne($digits) {
        for ($i = count($digits) - 1; $i >= 0; $i--) {
            if ($digits[$i] == 9) {
                $digits[$i] = 0;
                //数组第一个位置为9的情况
                if ($i == 0) {
                    array_unshift($digits, 1);
                }
            } else {
                //$digits[$i] += 1;
                $digits[$i]++;
                break;
            }
        }
        return $digits;
    }
}

$obj = new Solution();
//$digits = [7,2,8,5,0,9,1,2,9,5,3,6,6,7,3,2,8,4,3,7,9,5,7,7,4,7,4,9,4,7,0,1,1,1,7,4,0,0,6];
$digits = [1,2];
$res = $obj->plusOne($digits);
echo '<pre>';
var_dump($res);