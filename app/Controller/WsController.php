<?php
/**
 * Created by PhpStorm.
 * User: ccy
 * Date: 2019/9/9
 * Time: 16:48
 */
declare(strict_types=1);

namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\WebSocketClient\ClientFactory;
use Hyperf\WebSocketClient\Frame;

class WsController
{
    /**
     * @Inject
     * @var ClientFactory
     * websocket客户端控制器
     */
    protected $clientFactory;

    public function index()
    {
        // 对端服务的地址，如没有提供 ws:// 或 wss:// 前缀，则默认补充 ws://
        $host = '127.0.0.1:9502';
        // 通过 ClientFactory 创建 Client 对象，创建出来的对象为短生命周期对象
        $autoClose = false;
        $client = $this->clientFactory->create($host, $autoClose);
        // 向 WebSocket 服务端发送消息
        $client->push('HttpServer 中使用 WebSocket Client 发送数据。');
        // 获取服务端响应的消息，服务端需要通过 push 向本客户端的 fd 投递消息，才能获取；以下设置超时时间 2s，接收到的数据类型为 Frame 对象。
        /** @var Frame $msg */
        $msg = $client->recv(2);
        // 获取文本数据：$res_msg->data
        return $msg->data;
    }
}