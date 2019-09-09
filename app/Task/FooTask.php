<?php
/**
 * Created by PhpStorm.
 * User: ccy
 * Date: 2019/9/5
 * Time: 16:01
 */

namespace App\Task;

use Hyperf\Crontab\Annotation\Crontab;

/**
 * @Crontab(name="Foo", rule="*\/5 * * * * *", callback="execute", memo="这是一个示例的定时任务")
 */
class FooTask
{
    public function execute()
    {
        $data = date('Y-m-d H:i:s', time());
        var_dump($data);
    }
}