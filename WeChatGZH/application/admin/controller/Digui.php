<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/18
 * Time: 13:33
 */
namespace app\admin\controller;
use think\controller;

class Digui
{

    /**
     * 数据排序（多维数组）
     */
    function cat_tree($list,$parent_id=0)
    {
        $temp = array();
        foreach ($list as $k => $v) {
            if ($v['relation'] == $parent_id) {
                $temp[$k] = $v;
                $temp[$k]['child'] = $this->cat_tree($list, $v['userid']);
                //增加配偶数据
                if ($v['peiou'] != 0) {
                    $temp[$k]['peiouArr'] = $this->peiou($list, $v['peiou']);
                    unset($list[$k]);
                }
            }
        }
        return $temp;
    }
    /**
     * 数据排序（二维数组）
     */
    function cat_arr($list,$parent_id,$level)
    {
        static $temp = array();
        foreach ($list as $v) {
            if ($parent_id == $v['relation']) {
                $v['level'] = $level;
                $temp[] = $v;
                $this->cat_arr($list, $v['userid'], $level + 1);
            }
        }
        return $temp;
    }
}
