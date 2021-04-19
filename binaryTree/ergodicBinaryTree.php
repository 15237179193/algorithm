<?php
class Node {
    public $data;
    public $left = null;
    public $right = null;

    public function __construct($data)
    {
        $this->data = $data;
    }
}

/**
 * 前序遍历
 * @param $tree
 */
function preOrderErgodic($tree)
{
    if ($tree == null) {
        return;
    }

    printf("%s \n", $tree->data);
    preOrderErgodic($tree->left);
    preOrderErgodic($tree->right);
}

/**
 * 中序遍历
 * @param $tree
 */
function midOrderErgodic($tree)
{
    if ($tree == null) {
        return;
    }

    midOrderErgodic($tree->left);
    printf("%s \n", $tree->data);
    midOrderErgodic($tree->right);
}

/**
 * 后序遍历
 * @param $tree
 */
function afterOrderErgodic($tree)
{
    if ($tree == null) {
        return;
    }

    afterOrderErgodic($tree->left);
    afterOrderErgodic($tree->right);
    printf("%s \n", $tree->data);
}

$node1 = new Node('A');
$node2 = new Node('B');
$node3 = new Node('C');
$node1->left = $node2;
$node1->right = $node3;

//前序遍历调用
preOrderErgodic($node1);
echo '<hr>';
//中序遍历调用
midOrderErgodic($node1);
echo '<hr>';
//后序遍历调用
afterOrderErgodic($node1);