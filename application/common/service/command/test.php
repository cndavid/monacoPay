<?php
namespace app\common\service\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use app\api\logic\DoPay;

class test extends Command
{
    protected function configure()
    {
        $this->setName('test')->setDescription('Here is the remark ');
    }

    protected function execute(Input $input, Output $output)
    {
        $pay = new DoPay();
        $pay->pay('B20190126163755126244');
        $output->writeln("TestCommand:");
    }
}