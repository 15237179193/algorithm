<?php
/**
 * 归并排序
 */
function mergeSort($ary)
{
    $len = count($ary);
    if ($len <= 1) {
        return $ary;
    }
    //调用归并排序
    dealMergeSort($ary, 0, $len - 1);

    return $ary;
}

/**
 * 处理归并排序
 */
function dealMergeSort(&$ary, $s, $e)
{
    //开始下表索引大于结束下标索引，说明到头了
    if ($s >= $e) {
        return;
    }

    //取中间位置索引
    $m = floor(($s + $e) / 2);
    //左侧归并排序递归处理
    dealMergeSort($ary, $s, $m);
    //右侧归并排序递归处理
    dealMergeSort($ary, $m + 1, $e);

    //合并并排序处理
    dealMerge($ary, ['start'=>$s, 'end'=>$m], ['start'=>$m + 1, 'end'=>$e]);
}

/**
 * 合并数组处理
 */
function dealMerge(&$ary, array $indexS, array $indexE)
{
    $tmp = [];
    $i = $indexS['start'];//前一部分开始索引
    $j = $indexE['start'];//后一部分开始索引
    $k = 0;
    //前一部分开始索引小于等于前一部分结束索引 且 后一部分开始索引小于等于后一部分结束索引时，执行while，否则结束循环
    //这里是对两部分数组排序合并的过程
    while ($i <= $indexS['end'] && $j <= $indexE['end']) {
        //前一部分索引位置的值小于等于后一部分索引位置的值时，说明此次二者的顺序是对的，
        //将小的（$i对应的）值放到$tmp数组中，否则说明$j索引对应的值更小，将其对应的值先放到$tmp数组中
        //i++为先赋值，后++，$k++等价于$tmp[$k] = $ary[$i];$k++;$i++;
        if ($ary[$i] <= $ary[$j]) {
            $tmp[$k++] = $ary[$i++];
        } else {
            $tmp[$k++] = $ary[$j++];
        }
    }

    //while循环结束之后可能依然有未排序完成的数据，因为要满足$i <= $indexS['end'] && $j <= $indexE['end']就会继续下去
    //当有一个条件不满足条件时，另外一个条件可能满足条件但被迫终止
    //此时，必定有一组已经完成排序，未完成排序的一组只需后面追加即可完成排序
    if ($i <= $indexS['end']) {
        for (; $i <= $indexS['end']; $i++) { 
            $tmp[$k++] = $ary[$i];
        }
    }
    if ($j <= $indexE['end']) {
        for (; $j <= $indexE['end']; $j++) { 
            $tmp[$k++] = $ary[$j];
        }
    } 

    //到这里就完成了对本次两个递归数组的合并（连续的数据），那么，只需替换到原数组对应的顺序即可
    /*for ($m = 0; $m < $k; $m++) { 
        $ary[$indexS['start'] + $m] = $tmp[$m];
    }*/
    //此时$k不需要再加 1 了，因为在上面while循环或两个for循环中最后一步的时候已经执行过$k++了
    array_splice($ary, $indexS['start'], $k, $tmp);
}

$ary = [4, 5, 6, 3, 2, 1];
$endAry = mergeSort($ary);
print_r($endAry);