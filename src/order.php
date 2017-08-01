<?php

//接受用户的订单信息并写入队列
include '../server/db.php';

if(!empty($_GET['mobile'])){
    //订单中心处理。。。
    //...
    //...
    $order_id = rand(10000,99999);  //订单号
    //把生成的订单信息存入到队列表中

    $data = array(
        'order_id'   => $order_id,
        'mobile'     => $_GET['mobile'],
        'created_at' => date('Y-m-d H:i:s',time()),
        'status'     => 0,
    );

    //入库
    $db = DB::getIntance();
    $res = $db->insert('order_queue',$data);
    if($res){
        echo $data['order_id'].'保存成功!';
    }else{
        echo '保存失败!';
    }
}