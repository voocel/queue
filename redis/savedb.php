<?php
include '../server/db.php';

$redis = new Redis();
$redis->connect('127.0.0.1',6379);
$redis_name = 'miaosha';
$db = DB::getIntance();

// 死循环
while(1){
    //从队列最左侧取出一个值
    $user = $redis->lPop($redis_name);
    if(!$user||$redis=='nil'){
        sleep(2);
        continue;
    }
    //切割出时间和uid
    $user_arr = explode('%',$user);
    $data = array(
        'uid'  => $user_arr[0],
        'time_stamp'  => $user_arr[1],
    );
    //插入数据库
    $res = $db->insert('redis_queue',$data);

    //数据库插入失败的回滚机制
    if(!$res){
        $redis->lPush($redis_name,$user);
    }

    sleep(2);
}

//释放redis
$redis->close();