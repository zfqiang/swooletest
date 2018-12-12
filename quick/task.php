<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/12
 * Time: 11:00
 */


$serv = new swoole_server('0.0.0.0', 9501);

$serv->set(array('task_worker_num' => 4));

$serv->on('connect', function ($serv, $fd){
    echo "链接上了: ".PHP_EOL;
});

$serv->on('receive', function ($serv, $fd, $from_id, $data){
    $task_id = $serv->task($data);
    echo "异步 ID: " . $task_id.PHP_EOL;
});

$serv->on('task', function ($serv, $task_id, $from_id, $data){
    echo "执行异步 ID: " . $task_id.PHP_EOL;
    $serv->finish("$data -> OK");
});

$serv->on("finish", function ($serv, $task_id, $data){
    echo "处理完成：" . $task_id.PHP_EOL;
});

$serv->start();