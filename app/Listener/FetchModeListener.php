<?php

declare(strict_types=1);

namespace App\Listener;

use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Database\Events\StatementPrepared;
use PDO;

/**
 * @Listener
 *
 * 在某些场景下，您可能会希望查询出来的结果内采用 数组(Array) 而不是 stdClass 对象结构时，
 * 而 Eloquent 又去除了通过配置的形式配置默认的 FetchMode，
 * 那么此时可以通过监听器来监听 Hyperf\Database\Events\StatementPrepared 事件来变更该配置
 */
class FetchModeListener implements ListenerInterface
{
    public function listen(): array
    {
        return [
            StatementPrepared::class,
        ];
    }

    public function process(object $event)
    {
        if ($event instanceof StatementPrepared) {
            $event->statement->setFetchMode(PDO::FETCH_ASSOC);
        }
    }
}
