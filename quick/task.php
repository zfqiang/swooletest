<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/12
 * Time: 11:00
 */


$serv = new swoole_server('0.0.0.0', 9501);

$serv->set(array('task_worker_num' => 4));

$serv->on('receive', function ($serv, $fd, $from_id, $data){
    $task_id = $serv->task($data);
    echo "yi bu ID:" . $task_id.PHP_EOL;
});

$serv->on('task', function ($serv, $task_id, $from_id, $data){
    echo "zhi xing yibu ID:" . $task_id.PHP_EOL;
    $serv->finish("$data -> OK");
});

$serv->on("finish", function ($serv, $task_id, $data){
    echo "finish" . $task_id.PHP_EOL;
});

$serv->start();