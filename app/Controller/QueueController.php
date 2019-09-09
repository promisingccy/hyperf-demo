<?php
/**
 * Created by PhpStorm.
 * User: ccy
 * Date: 2019/9/5
 * Time: 11:43
 */

declare(strict_types=1);

namespace App\Controller;

use App\Service\QueueService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;

/**
 * @AutoController
 */
class QueueController extends Controller
{
    /**
     * @Inject
     * @var QueueService
     */
    protected $service;

    public function index()
    {
        $params = $this->request->input('user', 'Hyperf');
        $this->service->push($params, 10);

        return [
            'code' => 200,
            'message' => '任务已下发，请稍后...',
        ];
    }
}