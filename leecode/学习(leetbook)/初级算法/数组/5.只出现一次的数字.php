<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function singleNumber1($nums) {
        $nums_counts = array_count_values($nums);
        $num = 0;
        foreach ($nums_counts as $k => $v) {
            if ($v == 1) {
                $num = $k;
            }
        }
        return $num;
    }

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function singleNumber($nums) {
        $num = 0;
        for ($i = 0; $i < count($nums); $i++) {
            $num ^= $nums[$i];//异或运算特点计算
        }
        return $num;
    }
}

$obj = new Solution();
$nums = [2,2,1];
$res = $obj->singleNumber($nums);
echo '<pre>';
var_dump($res);