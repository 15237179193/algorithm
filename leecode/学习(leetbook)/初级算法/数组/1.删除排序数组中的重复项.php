<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function removeDuplicates(&$nums) {
        $len = count($nums);
        $i = 0;
        for ($j = 1; $j < $len; $j++) {
            if ($nums[$i] < $nums[$j]) {
                $nums[$i+1] = $nums[$j];
                $i++;
            }
        }
        return $i + 1;
    }
}

$obj = new Solution();
$nums = [1,1,1,2];
echo '<pre>';
var_dump($nums);

$len = $obj->removeDuplicates($nums);
echo '<pre>';
var_dump($len, $nums);