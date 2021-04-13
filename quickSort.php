<?php
/**
 * 快速排序
 */
function quickSort($ary)
{
    $len = count($ary);
    if ($len <= 1) {
        return $ary;
    }

    dealQuickSort($ary, 0, $len - 1);
    return $ary;
}

/**
 * 处理快速排序
 */
function dealQuickSort(&$ary, $s, $e)
{
    if ($e <= $s) {
        return;
    }

    //寻找中间索引位置
    $m = dealPivotIndex($ary, $s, $e);
    //中间索引位置左侧数据继续排序处理
    dealQuickSort($ary, $s, $m - 1);
    //中间索引位置右侧数据继续排序处理
    dealQuickSort($ary, $m + 1, $e);
}

/**
 * 处理并获取中间位置索引的值
 */
function dealPivotIndex(&$ary, $s, $e)
{
    //默认数组的最后一个索引（即$e）为中间索引位置
    $pivot = $ary[$e];//默认为中间索引位置对应的值
    //索引开始位置，只有在有值小于默认中间索引位置的值的时候，该值向前移动，否则不移动；
    //该值最终的索引位置即为中间索引位置（不一定是中间，应该是$pivot真正的索引位置（左侧小于$pivot，右侧大于$pivot，此时$pivot的索引位置））
    $i = $s;
    for ($j = $s; $j < $e; $j++) {
        // 原理：将比$pivot小的数丢到[$s...$i-1]中，剩下的[$i..$e]区间都是比$pivot大的
        //如果有值（即此时$j对应的值$ary[$j]）小于默认中间索引位置的值（即$pivot），那么说明该值在$pivot的左侧
        //交换$i和$j索引位置的值，$i索引位置左侧的所有值都一定小于$pivot
        if ($ary[$j] < $pivot) {
            $tmp = $ary[$i];
            $ary[$i] = $ary[$j];
            $ary[$j] = $tmp;
            $i++;
        }
    }

    //此时的$i索引位置左侧的值都小于$pivot，$i索引位置右侧的值都大于$pivot，这时才能真正确定$pivot对应的索引位置
    $tmp = $ary[$i];
    $ary[$i] = $pivot;
    $ary[$e] = $tmp;

    return $i;
}

$ary = [8, 4, 5, 6, 3, 2, 1, 7];
$endAry = quickSort($ary);
print_r($endAry);