<?php
/**
 * Created by PhpStorm.
 * User: ccy
 * Date: 2019/9/9
 * Time: 16:04
 */

namespace App\Controller;

use Hyperf\Contract\OnCloseInterface;
use Hyperf\Contract\OnMessageInterface;
use Hyperf\Contract\OnOpenInterface;
use Swoole\Http\Request;
use Swoole\Server;
//use Swoole\WebSocket\Server as WsServer;
use Swoole\Websocket\Frame;

class WebSocketController implements OnMessageInterface, OnOpenInterface, OnCloseInterface
{
//    public function onMessage(Server $server, Frame $frame): void
//    {
//        $server->push($frame->fd, 'Recv: ' . $frame->data);
//    }
//
//    public function onClose(Server $server, int $fd, int $reactorId): void
//    {
//        var_dump('closed');
//    }
//
//    public function onOpen(Server $server, Request $request): void
//    {
//        $server->push($request->fd, 'Opened');
//    }

    public function onMessage(Server $server, Frame $frame): void
    {
//        $server->push($frame->fd, 'Recv: ' . $frame->data);
        if ($frame->data == '图片') {
            $server->push($frame->fd, file_get_contents('https://www.baidu.com/img/baidu_jgylogo3.gif'), WEBSOCKET_OPCODE_BINARY);
        } elseif ($frame->data == '百度') {
            $mmpic = [
                'https://www.baidu.com/img/baidu_jgylogo3.gif',
                'https://www.baidu.com/img/baidu_jgylogo3.gif',
                'https://www.baidu.com/img/baidu_jgylogo3.gif'
            ];
            $picKey = array_rand($mmpic);
            $server->push($frame->fd, file_get_contents($mmpic[$picKey]), WEBSOCKET_OPCODE_BINARY);
        } else {
            $server->push($frame->fd, $this->reply($frame->data));
        }
    }

    public function onClose(Server $server, int $fd, int $reactorId): void
    {
        var_dump('closed');
        echo "client {$fd} closed\n";
        foreach ($server->connections as $fdd) {
            $server->push($fd, $fdd. '已离开！');
        }
    }

    public function onOpen(Server $server, Request $request): void
    {
        $server->push($request->fd, 'Opened');
    }

//    public function start(Server $server)
//    {
//        // Run worker
//        $server->start();
//    }

    private function reply($str) {
        $str = mb_strtolower($str);
        switch ($str) {
            case 'hello':
                $res = 'Hello, Friend.';
                break;
            case 'ping':
                $res = 'PONG.';
                break;
            case 'time':
                $res = date('H:i:s');
                break;

            default:
                $res = $str;
                break;
        }
        return $res;
    }
}