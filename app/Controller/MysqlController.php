<?php
/**
 * Created by PhpStorm.
 * User: ccy
 * Date: 2019/9/17
 * Time: 14:46
 */

namespace App\Controller;

use App\Model\User;
use Hyperf\DbConnection\Db;

class MysqlController extends Controller
{
    public function index(string $name)
    {
        $data = Db::table('user')->updateOrInsert(
            ['username' => $name], //条件
            ['nickname' => '2222']  //更改或写入内容
        );
        return [
            'code' => 200,
            'message' => '操作成功',
            'data' => $data,
        ];
    }
}