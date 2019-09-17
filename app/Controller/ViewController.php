<?php
/**
 * Created by PhpStorm.
 * User: ccy
 * Date: 2019/9/9
 * Time: 19:50
 */
declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\View\RenderInterface;

/**
 * @AutoController
 * 视图控制器
 */
class ViewController
{
    public function index(RenderInterface $render)
    {
        return $render->render('index', ['name' => 'Hyperf']);
    }
}