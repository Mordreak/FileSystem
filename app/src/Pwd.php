<?php


namespace Sourcecode;


class Pwd extends Command
{
    public function run($arg = '')
    {
        echo Prompt::getInstance()->getPwd() . "\n";
    }
}
