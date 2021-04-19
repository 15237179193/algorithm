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

class BinarySortTree {
    private $tree;

    /**
     * 获取树
     * @return mixed
     */
    public function getTree()
    {
        return $this->tree;
    }

    /**
     * 前序遍历
     * @param $tree
     */
    public function preOrderErgodic($tree)
    {
        if ($tree == null) {
            return;
        }

        printf("%s \n", $tree->data);
        $this->preOrderErgodic($tree->left);
        $this->preOrderErgodic($tree->right);
    }

    /**
     * 中序遍历
     * @param $tree
     */
    public function midOrderErgodic($tree)
    {
        if ($tree == null) {
            return;
        }

        $this->midOrderErgodic($tree->left);
        printf("%s \n", $tree->data);
        $this->midOrderErgodic($tree->right);
    }

    /**
     * 后序遍历
     * @param $tree
     */
    public function afterOrderErgodic($tree)
    {
        if ($tree == null) {
            return;
        }

        $this->afterOrderErgodic($tree->left);
        $this->afterOrderErgodic($tree->right);
        printf("%s \n", $tree->data);
    }

    /**
     * 插入节点
     * @param $data
     */
    public function insert($data)
    {
        if (!$this->tree) {
            $this->tree = new Node($data);
            return;
        }

        $p = $this->tree;
        while ($p) {
            if ($p->data > $data) {//左边
                if (!$p->left) {
                    $p->left = new Node($data);
                    return;
                }
                $p = $p->left;
            } elseif ($p->data < $data) {//右边
                if (!$p->right) {
                    $p->right = new Node($data);
                    return;
                }
                $p = $p->right;
            }
        }
    }

    /**
     * 查找
     * @param $data
     * @return null
     */
    public function find($data)
    {
        $p = $this->tree;
        while ($p) {
            if ($p->data > $data) {
                $p = $p->left;
            } elseif ($p->data < $data) {
                $p = $p->right;
            } else {
                return $p;
            }
        }
        return null;
    }

    public function delete($data)
    {
        if (!$this->tree) {
            return;
        }

        $p = $this->tree;//当前节点，默认从根节点开始
        $pp = null;//当前节点的父节点，默认null
        //查找待删除的节点
        while ($p && $p->data != $data) {//当前节点的值不是要查找的值，就继续循环
            $pp = $p;
            if ($p->data > $data) {
                $p = $p->left;
            } else {
                $p = $p->right;
            }
        }

        //树中未找到范删除的节点
        if (!$p) {
            return;
        }

        //待删除的节点有两个子节点
        if ($p->left && $p->right) {
            $minP = $p->right;//默认右子树最小子节点
            $minPp = $p;//默认最小子节点的父节点
            while ($minP->left) {
                $minP = $minP->left;
                $minPp = $minP;
            }
            $p->data = $minP->data;//确定了最小子节点，将$minp中的值放到$p中，此时$p节点内容被替换，相当于删除
            $p = $minP;//下面就变成删除 $minP 了
            $pp = $minPp;
        }

        $children = null;
        if ($p->left) {
            $children = $p->left;
        } elseif ($p->right) {
            $children = $p->right;
        }

        if (!$pp) {
            $this->tree = $children;
        } elseif ($pp->left == $p) {
            //待删除节点有左右子节点，且最小子节点为（左）叶子结点，
            //此时$children为null，即删除$pp的左子节点（因为$pp->left节点==$p放到了被删除节点的位置）
            $pp->left = $children;
        } else {
            //当待删除的节点有两个子节点，但最小子节点非叶子结点，这里相当于把替补节点的内容放到其父节点的右侧
            //当带删除的节点非两个子节点（一个或没有），这里是覆盖操作，相当于删除
            $pp->right = $children;
        }
    }
}

$tree = new BinarySortTree();
$tree->insert(3);
$tree->insert(2);
$tree->insert(5);
$tree->insert(1);
$tree->insert(4);
$tree->insert(10);
$tree->insert(7);
$tree->insert(6);
$tree->insert(8);
$tree->insert(9);
echo "前序遍历结果：";
$tree->preOrderErgodic($tree->getTree());
echo '<hr>';
echo "中序遍历结果：";
$tree->midOrderErgodic($tree->getTree());
echo '<hr>';
echo "后序遍历结果：";
$tree->afterOrderErgodic($tree->getTree());

echo '<hr>';
echo "查找结果：";
echo '<pre>';
var_dump($tree->find(2));

echo '<hr>';
$tree->delete(10);
echo "删除10后前序遍历结果：";
$tree->preOrderErgodic($tree->getTree());
echo "删除10后中序遍历结果：";
$tree->midOrderErgodic($tree->getTree());
echo "删除10后后序遍历结果：";
$tree->afterOrderErgodic($tree->getTree());
//var_dump($tree->getTree());
echo '<hr>';
$tree->delete(7);
echo "删除7后中序遍历结果：";
$tree->midOrderErgodic($tree->getTree());
echo '<hr>';
$tree->delete(9);
echo "删除9后中序遍历结果：";
$tree->midOrderErgodic($tree->getTree());
echo '<hr>';
$tree->delete(6);
echo "删除6后中序遍历结果：";
$tree->midOrderErgodic($tree->getTree());