<?php

class Solution {

    /**
     * @param Integer[] $prices
     * @return Integer
     */
    function maxProfit($prices) {
        $len = count($prices);
        $max = 0;
        if ($len < 2) {
            return $max;
        }

        for ($i = 1; $i < $len; $i++) {
            if ($prices[$i - 1] < $prices[$i]) {
                $max += $prices[$i] - $prices[$i - 1];
            }
        }
        return $max;
    }
}

$obj = new Solution();
$prices = [1, 2, 3 , 4, 10];
$max = $obj->maxProfit($prices);
echo '<pre>';
var_dump($prices, $max);