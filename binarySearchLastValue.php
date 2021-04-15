<?php
/**
 * 二分查找，数组中有多个相同的要查找的值，取最后一个
 */
function binarySearchLastValue($ary, $value) 
{
    $len = count($ary);
    if ($len == 0 || ($len == 1 && $ary[0] != $value)) {
        return -1;
    } elseif ($len == 1 && $ary[0] == $value) {
        return 0;
    }

    return dealBinarySearchLastValue($ary, $value, 0, $len - 1);
}

function dealBinarySearchLastValue($ary, $value, $left, $right)
{
    //如果右侧索引小于左侧索引，说明已经无中间索引，没查找到要查的值，返回-1
    if ($right < $left) {
        return -1;
    }

    $middle = floor(($left + $right) / 2);
    if ($value > $ary[$middle]) {
        //要查找的值在中间索引的右侧
        return dealBinarySearchLastValue($ary, $value, $middle + 1, $right);
    } elseif ($value < $ary[$middle]) {
        //要查找的值在中间索引的左侧
        return dealBinarySearchLastValue($ary, $value, $left, $middle - 1);
    } else {
        //走到这里，说明找到了，但是有多个相同的值，需要根据判断结果看是否继续递归
        //有两种情况终止递归，1：如果中间索引已经到了最右侧，说明已经找到最后一个要找的值的索引，即为count($ary)-1
        //                  2：如果中间索引的右侧一个索引对应的值与要找的值不相等（非最右侧索引且前提条件是数组是有序的），
        //                      说明当前中间索引$middle右侧的值大于要查找的值$value，$middle索引对应的值即为最后一个查找值
        if ($middle == (count($ary) - 1) || $ary[$middle + 1] != $value) {
            return $middle;
        } else {
            return dealBinarySearchLastValue($ary, $value, $middle + 1, $right);
        }
    }
}

$ary = [1, 2, 3, 3, 4, 5, 6];
$index = binarySearchLastValue($ary, 3);
print '查找值的最后一个的索引：'.$index;