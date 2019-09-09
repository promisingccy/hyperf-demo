<?php

declare(strict_types=1);

namespace App\Command;

use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Command\Annotation\Command;
use Symfony\Component\Console\Input\InputArgument;

use Hyperf\DbConnection\Db;

/**
 * @Command
 */
class MysqlInitCommand extends HyperfCommand
{
    /**
     * 执行的命令行
     *
     * @var string
     */
    protected $name = 'mysql:init';

    public function handle()
    {
        // 从 $input 获取 name 参数
//        $argument = $this->input->getArgument('name') ?? 'World';
//        $this->line('Hello ' . $argument, 'info');

        $sql = "INSERT INTO `prs_user` (`status`, `role`, `username`, `password_hash`, `email`, `mobile`, `nickname`, `access_token`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $params = [1, 0, 'prsadmin', '$2y$10\$JKTrjyc3sTGHY23oU9e0/ed0Ln2FJXt7Wu3X0RQkL8XhxsYI9tvRy', '', '', '', 'KhkaebEP', date('Y-m-d H:i:s', time()), date('Y-m-d H:i:s', time())];
        $inserted = Db::insert($sql, $params); // 返回是否成功 bool
        $this->line('执行结果：'.$inserted);
    }

//    protected function getArguments()
//    {
//        return [
//            ['name', InputArgument::OPTIONAL, '名称参数']
//        ];
//    }
}
