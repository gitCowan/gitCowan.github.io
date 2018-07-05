<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/19
 * Time: 10:18
 */
namespace app\admin\model;
use think\Model;
class Test extends Model
{
//    protected $resultSetType = 'collection';
//    protected $readonly = ['name','email'];/s/限制只读字段
//    protected $autoWriteTimestamp = true;//如果开启，数据表内必须有create_time字段
    public function getStatusAttr($value)
    {
        $status = [-1=>'删除',0=>'禁用',1=>'正常',2=>'待审核'];
        return $status[$value];
    }
    public function getAdds($data)
    {
        $res = $this->save($data);
        return $res;
    }
}