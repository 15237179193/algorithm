<?php
/**
 * 二分查找，查找第一个大于等于给定值的元素（数组中包含重复数据）
 */
function binarySearchGteValue($ary, $value)
{
    $len = count($ary);
    if ($len == 0 || ($len == 1 && $ary[0] != $value)) {
        return -1;
    } elseif ($len == 1 && $ary[0] == $value) {
        return 0;
    }

    return dealBinarySearchGteValue($ary, $value, 0, $len - 1);
}

function dealBinarySearchGteValue($ary, $value, $left, $right)
{
    //如果右侧索引小于左侧索引，说明已经无中间索引，没查找到要查的值，返回-1
    if ($right < $left) {
        return -1;
    }

    $middle = floor(($left + $right) / 2);
    if ($ary[$middle] >= $value) {
        if ($middle == 0) {
            if ($ary[$middle] == $value) {
                return $middle;
            } else {
                return  -1;
            }
        } else if ($ary[$middle - 1] < $value) {
            return $middle;
        } else {
            return dealBinarySearchGteValue($ary, $value, $left, $middle - 1);
        }
    } elseif ($ary[$middle] < $value) {
        return dealBinarySearchGteValue($ary, $value, $middle + 1, $right);
    }
}

$ary = [1, 2, 3, 3, 4, 5, 6];
$index = binarySearchGteValue($ary, -2);
print '第一个大于等于查找值的索引：'.$index;