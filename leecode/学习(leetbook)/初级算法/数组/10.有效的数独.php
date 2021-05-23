<?php

class Solution {

    /**
     * @param String[][] $board
     * @return Boolean
     */
    function isValidSudoku($board) {
        //默认数独符合规则
        $res = true;

        //判断行
        for ($i = 0; $i < count($board); $i++) {
            $subRowAryCount = array_count_values($board[$i]);
            foreach ($subRowAryCount as $k => $v) {
                if ($k != '.' && $v >= 2) {
                    $res = false;
                    return $res;
                }
            }
        }
        //判断列
        for ($i = 0; $i < 9; $i++) {
            $subColAry = array_column($board, $i);
            $subColAryCounts = array_count_values($subColAry);
            foreach ($subColAryCounts as $k => $v) {
                if ($k != '.' && $v >= 2) {
                    $res = false;
                    return $res;
                }
            }
        }
        //判断3x3方形
        for ($i = 0; $i < 3; $i++) {
            $subAry = array_slice($board, $i * 3, 3);
            for ($j = 0; $j < 3; $j++) {
                $subChildAry = [];

                $subChildAry = array_merge($subChildAry, array_column($subAry, $j * 3 + 0));
                $subChildAry = array_merge($subChildAry, array_column($subAry, $j * 3 + 1));
                $subChildAry = array_merge($subChildAry, array_column($subAry, $j * 3 + 2));

                $subChildAryCounts = array_count_values($subChildAry);
                foreach ($subChildAryCounts as $k => $v) {
                    if ($k != '.' && $v >= 2) {
                        $res = false;
                        return $res;
                    }
                }
            }
        }

        return $res;
    }
}

$obj = new Solution();
//正常的数独
$board =
    [
         ["5","3",".",".","7",".",".",".","."]
        ,["6",".",".","1","9","5",".",".","."]
        ,[".","9","8",".",".",".",".","6","."]
        ,["8",".",".",".","6",".",".",".","3"]
        ,["4",".",".","8",".","3",".",".","1"]
        ,["7",".",".",".","2",".",".",".","6"]
        ,[".","6",".",".",".",".","2","8","."]
        ,[".",".",".","4","1","9",".",".","5"]
        ,[".",".",".",".","8",".",".","7","9"]
    ];
//异常的数独
$board =
    [
         ["8","3",".",".","7",".",".",".","."]
        ,["6",".",".","1","9","5",".",".","."]
        ,[".","9","8",".",".",".",".","6","."]
        ,["8",".",".",".","6",".",".",".","3"]
        ,["4",".",".","8",".","3",".",".","1"]
        ,["7",".",".",".","2",".",".",".","6"]
        ,[".","6",".",".",".",".","2","8","."]
        ,[".",".",".","4","1","9",".",".","5"]
        ,[".",".",".",".","8",".",".","7","9"]
    ];
$board =
    [
         [".",".","5",".",".",".",".",".","6"]
        ,[".",".",".",".","1","4",".",".","."]
        ,[".",".",".",".",".",".",".",".","."]
        ,[".",".",".",".",".","9","2",".","."]
        ,["5",".",".",".",".","2",".",".","."]
        ,[".",".",".",".",".",".",".","3","."]
        ,[".",".",".","5","4",".",".",".","."]
        ,["3",".",".",".",".",".","4","2","."]
        ,[".",".",".","2","7",".","6",".","."]
    ];
$res = $obj->isValidSudoku($board);
echo '<pre>';
var_dump($res);