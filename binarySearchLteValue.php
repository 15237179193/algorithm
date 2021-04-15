<?php

/**
 * 二分查找变形版：查找最后一个小于等于给定值的元素（数组中包含重复数据）
 * @param array $ary
 * @param $value
 * @return int
 */
function binarySearchLteValue(array $ary, $value)
{
    $len = count($ary);
    if ($len == 0 || ($len == 1 && $ary[0] == $value)) {
        return 0;
    } elseif ($len == 1 && $ary[0] != $value) {
        return -1;
    }

    return dealBinarySearchLteValue($ary, $value, 0, $len - 1);
}

/**
 * 执行二分查找处理
 * @param array $ary
 * @param $value
 * @param $left
 * @param $right
 * @return int
 */
function dealBinarySearchLteValue(array $ary, $value, $left, $right)
{
    //右侧索引小于左侧索引，说明到头了
    if ($left > $right) {
        return -1;
    }

    $middle = floor(($left + $right) / 2);
    if ($ary[$middle] <= $value) {
        if ($middle == count($ary) - 1) {
            if ($ary[count($ary) - 1] == $value) {
                return count($ary) - 1;
            } else {
                return -1;
            }
        } elseif ($ary[$middle + 1] > $value) {
            return $middle;
        } else {
            return dealBinarySearchLteValue($ary, $value, $middle + 1, $right);
        }
    } else {
        return dealBinarySearchLteValue($ary, $value, 0, $middle - 1);
    }
}

$ary = [1, 2, 3, 3, 4, 5, 6];
$index = binarySearchLteValue($ary, 3);
print '最后一个小于等于查找值的索引：'.$index;