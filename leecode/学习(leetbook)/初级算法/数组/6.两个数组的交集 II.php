<?php

class Solution {

    /**
     * @param Integer[] $nums1
     * @param Integer[] $nums2
     * @return Integer[]
     */
    function intersect1($nums1, $nums2) {
        $nums = [];
        if (count($nums1) >= count($nums2)) {
            foreach ($nums2 as $num2) {
                $num1_k = array_search($num2, $nums1);
                if (!is_bool($num1_k) && $num1_k !== false) {
                    $nums[] = $num2;
                    unset($nums1[$num1_k]);
                }
            }
        } elseif (count($nums1) < count($nums2)) {
            foreach ($nums1 as $num1) {
                $num2_k = array_search($num1, $nums2);
                if (!is_bool($num2_k) && $num2_k !== false) {
                    $nums[] = $num1;
                    unset($nums2[$num2_k]);
                }
            }
        }
        return $nums;
    }

    /**
     * @param Integer[] $nums1
     * @param Integer[] $nums2
     * @return Integer[]
     */
    function intersect($nums1, $nums2) {
        $nums = [];
        if (count($nums1) >= count($nums2)) {
            $tmp = $nums2;
            $nums2 = $nums1;
            $nums1 = $tmp;
        }
        foreach ($nums1 as $num1) {
            $num2_k = array_search($num1, $nums2);
            if (!is_bool($num2_k) && $num2_k !== false) {
                $nums[] = $num1;
                unset($nums2[$num2_k]);
            }
        }
        return $nums;
    }
}

$obj = new Solution();
$nums1 = [1,2];
$nums2 = [1,1];
$res = $obj->intersect($nums1, $nums2);
echo '<pre>';
var_dump($res);