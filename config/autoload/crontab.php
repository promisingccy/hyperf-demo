<?php
/**
 * Created by PhpStorm.
 * User: ccy
 * Date: 2019/9/5
 * Time: 15:59
 */

use Hyperf\Crontab\Crontab;
return [
    'enable' => false,
    // 通过配置文件定义的定时任务
//    'crontab' => [
//        (new Crontab())->setName('Foo')->setRule('* * * * *')->setCallback([App\Task\FooTask::class, 'execute'])->setMemo('这是一个示例的定时任务'),
//    ],
];