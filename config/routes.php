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

use Hyperf\HttpServer\Router\Router;

//IndexController
Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');
Router::addRoute(['GET', 'POST', 'HEAD'], '/es', 'App\Controller\IndexController@es');
Router::addRoute(['GET', 'POST', 'HEAD'], '/mysql', 'App\Controller\IndexController@mysql');
Router::addRoute(['GET', 'POST', 'HEAD'], '/redis', 'App\Controller\IndexController@redis');

//MysqlController
Router::get('/mysql/{name}', 'App\Controller\MysqlController::index');

//ws测试
//Router::addServer('ws', function () {
//    Router::get('/', 'App\Controller\WebSocketController');
//});
