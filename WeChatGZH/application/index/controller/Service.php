<?php
///**
// * Created by PhpStorm.
// * User: Administrator
// * Date: 2018/4/23
// * Time: 11:01
// */
//namespace App\Service;
//
//use App\Base\Service as BaseService;
//
////通常来说一个稍大型的 PHP 项目，都有有一个仓储层 Repository
//
//use App\Service\StudentService as StudentRepository;
//
//class StudentService extends BaseService{
//
//    public static function getTop10Students(){
//
//        $config = App::getConfig();
//
//        $cacheKeyGenerator = CacheKeyGenerator::getInstance();
//
//        //使用通用的缓存键生成器去获取缓存新键，方便增加统一的前缀（可用于包含 app 名字和版本信息）
//
//        $top10StuduentsCacheKey = $cacheKeyGenerator->generate($config["cacheKeyAlias"]["top10Students"]["key"]);
//
//        //下面是常见的缓存获取代码
//
//        //从 redis client 连接池实例中获取一个可用的 client 连接，保持连接复用的连接池技术
//
//        $redisInstance = RedisInstancePool::getInstance();
//
//        //直接从缓存中获取，若为 null ，则更新缓存
//
//        $top10StuduentsCache = $redisInstance->get($top10StuduentsCacheKey );
//
//        //这里使用 === null 判断是为了避免空数据导致的缓存穿透
//
//        if ($top10StuduentsCache === null){
//
//            //从 db 中获取一份最新的缓存数据
//
//            //加一个访问锁，最多锁 20 秒，因为一个并发 1000 左右的单秒访问此接口时，若不加锁
//
//            //必然会导致直接多个请求直接命中数据库，也就是下面的 “StudentRepository::getTop10Students()”，明显可能会导致数据库瓶颈出现
//
//            if($lockForTop10Students = LockUtility::lock($config["cacheKeyAlias"]["top10Students"]["key"]),20){
//
//                $top10StudentsFromDb = StudentRepository::getTop10Students();
//
//                if(empty($top10StudentsFromDb) {
//
//                    //防止空数据穿透到数据库
//
//                    $top10StudentsFromDb = [];
//
//                }
//
//                $top10StuduentsCache = $top10StudentsFromDb;
//
//                //设置缓存
//
//                //ttl 是保存在全局 config 中的 redis key 生命周期
//
//                $redisInstance->set($config["cacheKeyAlias"]["top10Students"]["key"],$top10StudentsFromDb,$config["cacheKeyAlias"]["top10Students"]["ttl"]);
//
//                LockUtility::unlock($config["cacheKeyAlias"]["top10Students"]["key"]);
//
//                return $top10StuduentsCache;
//
//            } else {
//
//                //没有获取到访问锁，直接返回空结果
//
//                return [];
//
//            }
//
//     }
//
//        return $top10StuduentsCache;
//
//    }
//
//}