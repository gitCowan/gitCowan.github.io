<?php
namespace app\admin\controller;

//use app\admin\controller\Index;
use think\controller;
class Test {
    public function index()
    {
//        $da = [
//            'user_id'=>1,
//            'store_id'=>1,
//        ];
        $arr = array(
            'id'=>1,
            'name'=>'a',
        );
        session('user_info',$arr);
        dump(session('user_info'));
        dump(session_id());
//        $test = model("Test");
//        $a = db('test')->where('id',1)->find();;
//        dump($a);exit();
//        $test->getStatusAttr('store_id');
//        exit();
//        $index = new Index();
//        return $index->index();
//        return 12312;
    }
}