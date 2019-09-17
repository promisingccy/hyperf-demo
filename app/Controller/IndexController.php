<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Controller;

use Hyperf\Elasticsearch\ClientBuilderFactory;
use Elasticsearch\ClientBuilder;
use Hyperf\Guzzle\RingPHP\PoolHandler;
use Swoole\Coroutine;
use Hyperf\DbConnection\Db;

class IndexController extends Controller
{

    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello Hyperf.",
            'name' => $user
        ];
    }


    //Redis操作示例
    public function redis()
    {
        $redis = $this->container->get(\Redis::class);
        $redis->set('ccy'.time(), time());
        $result = $redis->keys('*');
        return [
            'code' => 200,
            'message' => '操作成功',
            'data' => $result,
        ];
    }

    //Mysql操作示例
    public function mysql()
    {

        // default
        $data = Db::selectOne('SELECT * FROM prs_user;');
//        $data = Db::connection('default')->select('SELECT * FROM prs_user;');
//        Db::connection('test')->select('SELECT * FROM user;');// test

        return [
            'code' => 200,
            'message' => '操作成功',
            'data' => $data,
        ];
    }

    //Es操作示例
    public function es()
    {
        $host = 'http://10.0.84.237:9200';

        $type = $this->request->input('es_type', 1);
        $info = null;
        if($type){
            //使用 ClientBuilderFactory 创建客户端
            // 如果在协程环境下创建，则会自动使用协程版的 Handler，非协程环境下无改变
            $builder = $this->container->get(ClientBuilderFactory::class)->create();
            $client = $builder->setHosts([$host])->build();
            $info = $client->info();
        }else{
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
        }
//        var_dump($info);
        return [
            'code' => 200,
            'message' => '操作成功',
            'data' => $info,
        ];
    }
}
