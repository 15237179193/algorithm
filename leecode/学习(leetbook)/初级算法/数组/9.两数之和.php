<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum1($nums, $target) {
        $keys = [];
        foreach ($nums as $k => $v) {
            unset($nums[$k]);

            $sub = $target - $v;
            if (in_array($sub, $nums)) {
                $sub_key = array_search($sub, $nums);
                $keys = [$k, $sub_key];
                break;
            }
        }
        return $keys;
    }

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum2($nums, $target) {
        $keys = [];
        for ($i = 0; $i < count($nums); $i++) {
            $sub = $target - $nums[$i];
            $sub_key = array_search($sub, $nums);
            if (!is_bool($sub_key) && $i != $sub_key) {
                $keys = [$i, $sub_key];
                break;
            }
        }
        return $keys;
    }

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum($nums, $target) {
        $count = count($nums);
        for ($i=0; $i < $count; $i++) {
            $result = $target - $nums[$i];
            for ($j=$i+1; $j < $count; $j++) {
                if ($nums[$j] == $result) {
                    return [$i, $j];
                }
            }
        }
    }
}

$obj = new Solution();
$nums = [2,7,11,15];
$target = 9;
$nums = [3,2,4];
$target = 6;
$nums = [3,3];
$target = 6;
$nums = [1,6142,8192,10239];
$target = 18431;
$res = $obj->twoSum($nums, $target);
echo '<pre>';
var_dump($res);