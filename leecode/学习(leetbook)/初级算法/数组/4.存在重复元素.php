<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @return Boolean
     */
    function containsDuplicate1($nums) {
        $nums_counts = array_count_values($nums);
        $res = false;
        foreach ($nums_counts as $v) {
            if ($v >= 2) {
                $res = true;
                break;
            }
        }
        return $res;
    }

    /**
     * @param Integer[] $nums
     * @return Boolean
     */
    function containsDuplicate2($nums) {
        $nums_counts = array_count_values($nums);
        $res = false;
        if (
            (count($nums_counts) == 1 && array_values($nums_counts)[0] >= 2) ||
            count(array_unique(array_values($nums_counts))) >= 2
        ) {
            $res = true;
        }
        return $res;
    }

    /**
     * @param Integer[] $nums
     * @return Boolean
     */
    function containsDuplicate($nums) {
        $newNums = array_unique($nums);
        $res = false;
        if (count($nums) != count($newNums)) {
            $res = true;
        }
        return $res;
    }
}

$obj = new Solution();
$nums = [3,3];
$res = $obj->containsDuplicate($nums);
echo '<pre>';
var_dump($res);