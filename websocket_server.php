<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/12
 * Time: 13:19
 */

//创建服务器
$server =  new swoole_websocket_server('0.0.0.0', 9501);

//服务器上注册事件
$server->on('open', function (){
    echo "连接上了";
});


$server->on('message', function ($server, $frame){
    var_dump($frame);
    echo "收到消息";
});


$server->on('close', function (){
    echo "断开连接";
});


//启动服务器
$server->start();