<?php
/**
 * Created by PhpStorm.
 * User: ccy
 * Date: 2019/9/4
 * Time: 15:41
 */

declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;

/**
 * @Controller()
 */
class TestController
{
    // Hyperf 会自动为此方法生成一个 /test/index 的路由，允许通过 GET 或 POST 方式请求
    /**
     * @RequestMapping(path="index", methods="get,post")
     */
    public function index(RequestInterface $request)
    {
        // 从请求中获得 id 参数
        $id = $request->input('id', 1);
        return (string)$id;
//        throw new BusinessException(ErrorCode::SERVER_ERROR);
    }
}