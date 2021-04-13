<?php
/**
 * 二分查找
 * 数组必须是有序的
 */
function binarySearch($ary, $value)
{
    $len = count($ary);
    return dealBinarySearch($ary, $value, 0, $len - 1);
}

/**
 * 递归实现二分查找
 */
function dealBinarySearch($ary, $value, $left, $right)
{
    //如果右侧索引小于左侧索引，说明已经无中间索引，没查找到要查的值，返回-1
    if ($right < $left) {
        return -1;
    }

    $middle = floor(($left + $right) / 2);
    if ($value > $ary[$middle]) {
        //要查找的值在中间索引的右侧
        return dealBinarySearch($ary, $value, $middle + 1, $right);
    } else if ($value < $ary[$middle]) {
        //要查找的值在中间索引的右侧
        return dealBinarySearch($ary, $value, $left, $middle - 1);
    } else {
        return $middle;
    }
}

$ary = [1, 2, 3, 4, 5, 6];
$index = binarySearch($ary, 5);
print '5的索引值为：'.$index;

