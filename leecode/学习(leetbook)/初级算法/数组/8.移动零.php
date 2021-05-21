<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @return NULL
     */
    function moveZeroes(&$nums) {
        $len1 = count($nums);
        $nums = array_filter($nums);
        $len2 = count($nums);
        for ($i = 0; $i < ($len1 - $len2); $i++) {
            array_push($nums, 0);
        }
        return $nums;
    }
}

$obj = new Solution();
$nums = [0,1,0,3,12];
$res = $obj->moveZeroes($nums);
echo '<pre>';
var_dump($res);