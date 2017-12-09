<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CalculateActiveUser extends Command
{
    /**
     * 调用命令
     *
     * @var string
     */
    protected $signature = 'larabbs:calculate-active-user';

    /**
     * 命令描述
     *
     * @var string
     */
    protected $description = '生成活跃用户';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 最终执行的方法
     *
     * @return mixed
     */
    public function handle(User $user)
    {
        $this->info("开始计算...");

        $user->calculateAndCacheActiveUsers();

        $this->info("成功计算！");
    }
}
