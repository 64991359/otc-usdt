<?php
//declare (strict_types = 1);

namespace app\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;

class RunTask extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('index')
            ->setDescription('the index command');
    }

    protected function execute(Input $input, Output $output)
    {
        // 指令输出
        set_time_limit(0);

        $output->writeln('run task 1' . 'seconds');

    }

}
