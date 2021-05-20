<?php

class Solution {

    /**
     * 这种在Leecode中会超时
     * @param Integer[] $nums
     * @param Integer $k
     * @return NULL
     */
    function rotate1(&$nums, $k) {
        $len = count($nums);
        for ($i = 0; $i < $k; $i++) {
            /*$end = $len - 1;
            $num = $nums[$end];
            unset($nums[$end]);
            array_unshift($nums, $num);*/
            array_unshift($nums, $nums[count($nums) - 1]);
            unset($nums[count($nums) - 1]);
        }
        return $nums;
    }

    /**
     * 可
     * @param Integer[] $nums
     * @param Integer $k
     * @return NULL
     */
    function rotate2(&$nums, $k) {
        if (!$k || count($nums) == 1) {
            return $nums;
        }
        if ($k > count($nums)) {
            $k = $k % count($nums);
            if ($k / floor(count($nums)) == 1) {
                $nums = array_reverse($nums);
            }
        }
        $tmp = array_slice($nums, -$k);
        $nums = array_splice($nums, 0, count($nums) - $k);
        $nums = array_merge($tmp, $nums);
        return $nums;
    }
}

$obj = new Solution();
$nums = [1,2,3,4,5,6,7];
$step = 3;
$res = $obj->rotate($nums, $step);
echo '<pre>';
var_dump($res);