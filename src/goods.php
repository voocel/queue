<?php

//配送系统处理队列中的订单并进行标记
include '../server/db.php';

$db = DB::getIntance();

//先把要处理的记录更新为等待处理，防止冲突
$data = ['status'=>2];
$where = ['status'=>0];
$res_lock = $db->update('order_queue',$data,$where,2);

//选择刚刚更新的数据，然后进行配送系统的处理
if($res_lock){
    //选择出要处理的订单
    $res = $db->selectAll('order_queue',$where);
    //然后又配送系统进行退货等处理
    //。。。
    //处理完成后把订单更新为已处理
    $success = array(
        'status'   => 1,
        'updated_at'  => date('Y-m-d H:i:s',time())
    );
    $res_last = $db->update('order_queue',$success,$where);
    if($res_last){
        echo 'success'.$res_last;
    }else{
        echo 'error';
    }
}else{
    echo 'all ok';
}