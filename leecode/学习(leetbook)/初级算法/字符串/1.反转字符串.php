<?php

class Solution {

    /**
     * @param String[] $s
     * @return NULL
     */
    function reverseString1(&$s) {
        for ($i = 0; $i < count($s) / 2; $i++) {
            $tmp = $s[$i];
            $j = count($s) - 1 - $i;
            $s[$i] = $s[$j];
            $s[$j] = $tmp;
        }
        return $s;
    }

    /**
     * @param String[] $s
     * @return NULL
     */
    function reverseString(&$s) {
        $s = array_reverse($s);
        return $s;
    }
}

$obj = new Solution();
$s = ["h","e","l","l","o"];
$res = $obj->reverseString($s);
echo '<pre>';
var_dump($res);