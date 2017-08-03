<?php
$redis = new Redis();
$redis->connect('127.0.0.1',6379);
$redis_name = 'miaosha';

//模拟用户访问
for($i=0;$i<100;$i++){
$uid = rand(10000,99999);
//接收用户 uid
//$uid = $_GET['uid'];

//获取redis已有的数量
$num = 10;
//如果当天人数少于10则加入队列
if($redis->lLen($redis_name)<10){
$redis->rPush($redis_name,$uid.'%'.microtime());
echo $uid.'秒杀成功!</br>';
} else{
// 如果当天人数大于10人,则秒杀完成
  echo "秒杀已结束!</br>";
}

}

$redis->close();
