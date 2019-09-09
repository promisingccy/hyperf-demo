<?php
/**
 * Created by PhpStorm.
 * User: ccy
 * Date: 2019/9/5
 * Time: 11:40
 */

declare(strict_types=1);

namespace App\Job;

use Hyperf\AsyncQueue\Job;
use Swoole\Coroutine;
use Hyperf\Guzzle\RingPHP\PoolHandler;
use Elasticsearch\ClientBuilder;


class ExampleJob extends Job
{
    public $params;

    public function __construct($params)
    {
        // 这里最好是普通数据，不要使用携带 IO 的对象，比如 PDO 对象
        $this->params = $params;
    }

    public function handle()
    {
        // 根据参数处理具体逻辑
        var_dump($this->params);
        $host = 'http://10.0.84.237:9200';
        //自行创建客户端
        $builder = ClientBuilder::create();
        if (Coroutine::getCid() > 0) {
            $handler = make(PoolHandler::class, [
                'option' => [
                    'max_connections' => 50,
                ],
            ]);
            $builder->setHandler($handler);
        }
        $client = $builder->setHosts([$host])->build();
        $info = $client->info();
        var_dump($info);
    }
}